<?php

namespace App\Service;

use App\Core\Database\Database;
use App\Repository\{SessionRepository, UserRepository};
use App\Exception\ValidationException;
use App\Domain\User;
use App\Models\{UserRegisterRequest, UserLoginRequest, UserProfileUpdateRequest, UserPasswordUpdateRequest};
use App\Models\{UserRegisterResponse, UserLoginResponse, UserProfileUpdateResponse, UserPasswordUpdateResponse};

class UserService{

    private UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function register(UserRegisterRequest $request): UserRegisterResponse
    {
        $this->validateUserRegistrationRequest($request);

        try {
            Database::beginTransaction();
            $user = $this->userRepository->findById($request->id);
            if ($user != null) {
                $_SESSION['error']['username'] = "Id Pengguna sudah ada";
                throw new ValidationException();
            }

            $user = new User();
            $user->id = $request->id;
            $user->name = $request->name;
            $user->password = password_hash($request->password, PASSWORD_BCRYPT);
            $user->level = $request->level;
            $user->status = $request->status;

            $this->userRepository->save($user);

            $response = new UserRegisterResponse();
            $response->user = $user;

            Database::commitTransaction();
            return $response;
        } catch (\Exception $exception) {
            Database::rollbackTransaction();
            throw $exception;
        }
    }
    
    private function validateUserRegistrationRequest(UserRegisterRequest $request)
    {
        $error = [];
    
        if (empty($request->name)) {
            $error['name'] = "Nama tidak boleh kosong";
        } elseif (!$this->validateName($request->name)) {
            $error['name'] = "Nama tidak valid, hanya huruf alfabet yang diizinkan";
        }
    
        if (empty($request->id)) {
            $error['username'] = "Username tidak boleh kosong";
        } elseif (!$this->validateUsername($request->id)) {
            $error['username'] = "Username tidak valid, minimal 4 karakter (kombinasi angka atau huruf)";
        }
    
        if (empty($request->password)) {
            $error['password'] = "Password tidak boleh kosong";
        } elseif (!$this->validatePassword($request->password)) {
            $error['password'] = "Password tidak valid, minimal 8 karakter (kombinasi angka, huruf, atau karakter khusus)";
        }
    
        if (!empty($error)) {
            // Sesuaikan penanganan kesalahan sesuai kebutuhan aplikasi Anda
            $_SESSION["error"] = $error;
            throw new ValidationException();
        }
    }
    
    private function validateName($nama) {
        $allowedCharacters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $validCharacters = preg_match('/^[' . preg_quote($allowedCharacters, '/') . ']+$/', $nama);
        return $validCharacters;
    }
    
    private function validateUsername($username) {
        $allowedCharacters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890_';
        $validCharacters = preg_match('/^[' . preg_quote($allowedCharacters, '/') . ']+$/', $username);
        $validLength = strlen($username) >= 4;
    
        return $validCharacters && $validLength;
    }
    
    private function validatePassword($password) {
        $allowedCharacters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890!@#$%^&*()_-+=<>?';
        $validCharacters = preg_match('/^[' . preg_quote($allowedCharacters, '/') . ']+$/', $password);
        $validLength = strlen($password) >= 8;
    
        return $validCharacters && $validLength;
    }
    
  
    
    
    public function login(UserLoginRequest $request): UserLoginResponse
    {
        $this->validateUserLoginRequest($request);

        $user = $this->userRepository->findById($request->id);
        if ($user == null) {
            throw new ValidationException("Id or password Anda salah !");
        }
        
        if (password_verify($request->password, $user->password)) {
            $response = new UserLoginResponse();
            $response->user = $user;
            return $response;
        } else {
            throw new ValidationException("Id or password Anda Salah !");
        }
    }    
        private function validateUserLoginRequest(UserLoginRequest $request)
        {
            if ($request->id == null || $request->password == null ||
                trim($request->id) == "" || trim($request->password) == "") {
                    throw new ValidationException("Id and Password or level can not blank");
                }
        }
        

        public function updateProfile(UserProfileUpdateRequest $request): UserProfileUpdateResponse
        {
            $this->validateUserProfileUpdateRequest($request);
    
            try {
                Database::beginTransaction();
    
                $user = $this->userRepository->findById($request->id);
                if ($user == null) {
                    throw new ValidationException("User is not found");
                }
    
                $user->name = $request->name;
                $this->userRepository->update($user);
    
                Database::commitTransaction();
    
                $response = new UserProfileUpdateResponse();
                $response->user = $user;
                return $response;
            } catch (\Exception $exception) {
                Database::rollbackTransaction();
                throw $exception;
            }
        }
    
        private function validateUserProfileUpdateRequest(UserProfileUpdateRequest $request)
        {
            if ($request->id == null || $request->name == null ||
                trim($request->id) == "" || trim($request->name) == "") {
                throw new ValidationException("Id, Name can not blank");
            }
        }

        public function updatePassword(UserPasswordUpdateRequest $request): UserPasswordUpdateResponse
    {
        $this->validateUserPasswordUpdateRequest($request);

        try {
            Database::beginTransaction();

            $user = $this->userRepository->findById($request->id);
            if ($user == null) {
                throw new ValidationException("User is not found");
            }

            if (!password_verify($request->oldPassword, $user->password)) {
                throw new ValidationException("Old password is wrong");
            }

            $user->password = password_hash($request->newPassword, PASSWORD_BCRYPT);
            $this->userRepository->update($user);

            Database::commitTransaction();

            $response = new UserPasswordUpdateResponse();
            $response->user = $user;
            return $response;
        } catch (\Exception $exception) {
            Database::rollbackTransaction();
            throw $exception;
        }
    }

    private function validateUserPasswordUpdateRequest(UserPasswordUpdateRequest $request)
    {
        if ($request->id == null || $request->oldPassword == null || $request->newPassword == null ||
            trim($request->id) == "" || trim($request->oldPassword) == "" || trim($request->newPassword) == "") {
            throw new ValidationException("Id, Old Password, New Password can not blank");
        }
    }
}