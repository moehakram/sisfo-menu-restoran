<?php

namespace App\Service;

use App\Core\Database\Database;
use App\Exception\ValidationException;
use App\Models\{TambahMenuRequest, EditMenuRequest};
use App\Domain\Menu;
use App\Repository\MenuRepository;

class EntriReferensiService{

    private MenuRepository $menuRepository;

    public function __construct()
    {
        $connection = Database::getConnection();
        $this->menuRepository = new MenuRepository($connection);
        
    }


    public function saveMenu(TambahMenuRequest $tambahMenuRequest){

        $this->validasitambahMenuRequest($tambahMenuRequest);

        try {
            Database::beginTransaction();
            $this->uploadImage($tambahMenuRequest);
            if($tambahMenuRequest->gambar !== null){
                $menu = new Menu();
                $menu->id = $tambahMenuRequest->id;
                $menu->nama = $tambahMenuRequest->nama;
                $menu->jenis = $tambahMenuRequest->jenis;
                $menu->harga = $tambahMenuRequest->harga;
                $menu->stok = $tambahMenuRequest->stok;
                $menu->status = $tambahMenuRequest->status;
                $menu->gambar = $tambahMenuRequest->gambar;
                $this->menuRepository->save($menu);
                Database::commitTransaction();
                return "Data berhasil di simpan";
            }else{
                throw new \Exception("Data gagal di simpan");
            }
        } catch (\Exception $exception) {
            Database::rollbackTransaction();
            return $exception->getMessage();
        }


    }


    private function validasitambahMenuRequest(TambahMenuRequest $request){
        if($request->nama==null || $request->harga==null || $request->stok == null || $request->status ==  null){
            throw new ValidationException("Semua field harus di isi");
        }
    }


    private function uploadImage(TambahMenuRequest $tambahMenuRequest)
    {
            $image = $tambahMenuRequest->gambar;

            
            if(empty($tambahMenuRequest->gambar['tmp_name'])){
                throw new ValidationException("gambar tidak boleh kosong");
            }
            // Get file extension
            $file_ext = explode('.', $image['name']);
            $file_ext = strtolower(end($file_ext));
            
            // White list extensions
            $extensions = array("jpeg","jpg","png");
            
            // Check it's valid file for upload
            if(in_array($file_ext, $extensions) === false) {
               throw new ValidationException("Ekstensi tidak diizinkan, harap pilih file JPEG atau PNG.");
            }
            
            // Check file size
            if($image['size'] > 2097152) {
               throw new ValidationException('Ukuran file maksimum 2 MB.');
            }

            $targetDirectory = UPLOAD .'entri-' . $tambahMenuRequest->jenis . '/';
            $targetFileName  = uniqid() . '_' . $tambahMenuRequest->nama. '.' .$file_ext;
            
            if(move_uploaded_file($image['tmp_name'], $targetDirectory . $targetFileName)) {
               $tambahMenuRequest->gambar = $targetFileName;
            } else {
                $tambahMenuRequest->gambar = null;
            }
         
    }

    public function updateMenu(EditMenuRequest $editMenuRequest) {
        
        // Validasi bahwa semua field diisi
        $this->validasiEditMenuRequest($editMenuRequest);
        
        $menu = new Menu();
        $menu->id = $editMenuRequest->id;
        $menu->nama = $editMenuRequest->nama;
        $menu->jenis = $editMenuRequest->jenis;
        $menu->harga = $editMenuRequest->harga;
        $menu->stok = $editMenuRequest->stok;
        $menu->status = $editMenuRequest->status;
        try {
                Database::beginTransaction();
                $this->updateImage($editMenuRequest);
                if($editMenuRequest->gambar !== null){
                    $menu->gambar = $editMenuRequest->gambar;
                    $this->menuRepository->update($menu);
                }else{
                    $this->menuRepository->updateNoGambar($menu);
                }
                Database::commitTransaction();
                return "Data berhasil di update";
            } catch (\Exception $exception) {
                Database::rollbackTransaction();
                return $exception->getMessage();
            }  
    }

    private function validasiEditMenuRequest(EditMenuRequest $request){
        if($request->nama==null || $request->harga==null || $request->stok == null || $request->status ==  null){
            throw new ValidationException("Semua field harus di isi");
        }
    }


    private function updateImage(EditMenuRequest $editMenuRequest)
    {
            $image = $editMenuRequest->gambar;

            if(empty($image['tmp_name'])){
               $editMenuRequest->gambar = null;
               return;
            }
            
            // Get file extension
            $file_ext = explode('.', $image['name']);
            $file_ext = strtolower(end($file_ext));
            
            // White list extensions
            $extensions = array("jpeg","jpg","png");
            
            // Check it's valid file for upload
            if(in_array($file_ext, $extensions) === false) {
               throw new ValidationException("Ekstensi tidak diizinkan, harap pilih file JPEG atau PNG.");
            }
            
            // Check file size
            if($image['size'] > 2097152) {
               throw new ValidationException('Ukuran file maksimum 2 MB.');
            }

            $targetDirectory = UPLOAD .'entri-'. $editMenuRequest->jenis . '/';
            $targetFileName  = uniqid() . '_' . $editMenuRequest->nama. '.' .$file_ext;
            
            if(move_uploaded_file($image['tmp_name'], $targetDirectory . $targetFileName)) {
                    $oldImagePath = $targetDirectory . $editMenuRequest->old_gambar;
                    if (file_exists($oldImagePath)) {
                        unlink($oldImagePath);
                    }
               $editMenuRequest->gambar = $targetFileName;
            } else {
                $editMenuRequest->gambar = null;
            }
    }

    public function hapus($data)
    {   
        $this->menuRepository->delete($data['id']);
        $oldImagePath = PUBLIK . $data['path_img'];
        if (file_exists($oldImagePath)) {
            unlink($oldImagePath);
        }
    }
}