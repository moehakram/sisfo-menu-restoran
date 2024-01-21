<?php

namespace App\Service;

use App\Core\Database\Database;
use App\Exception\ValidationException;
use App\Models\{TambahMenuRequest, EditMenuRequest};
use App\Domain\Menu;
use App\Repository\MenuRepository;

class EntriReferensiService
{
    private MenuRepository $menuRepository;

    public function __construct()
    {
        $connection = Database::getConnection();
        $this->menuRepository = new MenuRepository($connection);
    }

    public function saveMenu(TambahMenuRequest $tambahMenuRequest)
    {
        $this->validateTambahMenuRequest($tambahMenuRequest);
        $this->uploadImage($tambahMenuRequest);
        try {
            Database::beginTransaction();
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
            return ['status' => 'success', 'pesan' => "Data berhasil disimpan"];
        } catch (\Exception $exception) {
            Database::rollbackTransaction();
            $imagePath = UPLOAD . 'entri-' . $tambahMenuRequest->jenis . '/' . $tambahMenuRequest->gambar;
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
            return ['status' => 'gagal', 'pesan' => $exception->getMessage()];
        }
    }

    private function validateTambahMenuRequest(TambahMenuRequest $request)
    {
        if ($request->nama == null || $request->harga == null || $request->stok == null) {
            throw new ValidationException("Semua field harus di isi");
        }

        if ($request->gambar['error'] == 4) {
            throw new ValidationException("Gambar tidak boleh kosong");
        }elseif($request->gambar['error'] > 0){
            throw new ValidationException("Terjadi kesalahan saat mengupload gambar");
        }
    }

    private function uploadImage(TambahMenuRequest $tambahMenuRequest)
    {
        $image = $tambahMenuRequest->gambar;

        $this->validateImage($image);

        $targetDirectory = UPLOAD . 'entri-' . $tambahMenuRequest->jenis . '/';
        $targetFileName = uniqid() . '_' . $tambahMenuRequest->nama . '.' . $this->getImageExtension($image);

        if (move_uploaded_file($image['tmp_name'], $targetDirectory . $targetFileName)) {
            $tambahMenuRequest->gambar = $targetFileName;
        } else {
            $tambahMenuRequest->gambar = null;
        }
    }

    private function validateImage($image)
    {
        $file_ext = $this->getImageExtension($image);

        $extensions = array("jpeg", "jpg", "png");

        if (in_array($file_ext, $extensions) === false) {
            throw new ValidationException("Ekstensi tidak diizinkan, harap pilih file JPEG atau PNG.");
        }

        if ($image['size'] > 2097152) {
            throw new ValidationException('Ukuran file maksimum 2 MB.');
        }
    }

    private function getImageExtension($image)
    {
        $file_ext = explode('.', $image['name']);
        return strtolower(end($file_ext));
    }

  

    public function updateMenu(EditMenuRequest $editMenuRequest)
    {
        $this->validateEditMenuRequest($editMenuRequest);
        $menu = new Menu();
        $menu->id = $editMenuRequest->id;
        $menu->nama = $editMenuRequest->nama;
        $menu->jenis = $editMenuRequest->jenis;
        $menu->harga = $editMenuRequest->harga;
        $menu->stok = $editMenuRequest->stok;
        $menu->status = $editMenuRequest->status;
        
        try {
            Database::beginTransaction();
            
            if ($editMenuRequest->gambar['error'] == 4) {
                $this->menuRepository->updateNoGambar($menu);
            } else {
                $this->updateImage($editMenuRequest);
                $menu->gambar = $editMenuRequest->gambar;
                $this->menuRepository->update($menu);
            }
            Database::commitTransaction();
            return ['status' => 'success', 'pesan' => "Data berhasil diupdate"];
        } catch (\Exception $exception) {
            Database::rollbackTransaction();
            return ['status' => 'gagal', 'pesan' => $exception->getMessage()];
        }
    }

    private function validateEditMenuRequest(EditMenuRequest $request)
    {
        if ($request->nama == null && $request->harga == null && $request->stok == null) {
            throw new ValidationException("'nama', 'harga', atau 'stok' harus di isi");
        }
        
    }

    private function updateImage(EditMenuRequest $editMenuRequest)
    {
        $image = $editMenuRequest->gambar;

        $this->validateImage($image);

        $targetDirectory = UPLOAD . 'entri-' . $editMenuRequest->jenis . '/';
        $targetFileName = uniqid() . '_' . $editMenuRequest->nama . '.' . $this->getImageExtension($image);

        if (move_uploaded_file($image['tmp_name'], $targetDirectory . $targetFileName)) {
            $targetDirectory = $targetDirectory . $editMenuRequest->old_gambar;

            if (file_exists($targetDirectory)) {
                unlink($targetDirectory);
            }
            $editMenuRequest->gambar = $targetFileName;
        } else {
            $editMenuRequest->gambar = null;
        }
    }

    public function hapus($data)
    {
        try{
            Database::beginTransaction();
            $oldImagePath = PUBLIK . trim($data['path_img'], '/');
            $this->menuRepository->delete($data['id']);
            
            if(!unlink($oldImagePath)) throw new \Exception();
            
            Database::commitTransaction();
            return ['status' => 'success', 'pesan' => 'Data berhasil di hapus '. $oldImagePath];
        }catch(\Exception $e){
            Database::rollbackTransaction();
            return ['status' => 'error', 'pesan' => 'Data gagal di hapus'];
        }

    }
}
