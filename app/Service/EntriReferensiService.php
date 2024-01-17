<?php

namespace App\Service;

use App\Core\Database\Database;
use App\Exception\ValidationException;
use App\Models\TambahMenuRequest;
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
            if($this->uploadImage($tambahMenuRequest)){
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
        if(empty($request->gambar['tmp_name'])){
            throw new ValidationException("gambar tidak boleh kosong");
        }
    }


    private function uploadImage(TambahMenuRequest $tambahMenuRequest)
    {
            $image = $tambahMenuRequest->gambar;

            $file_type = $image['type'];

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

            $targetDirectory = __DIR__."/../../public/upload/entri-". $tambahMenuRequest->jenis . '/';
            $targetFileName  = uniqid() . '_' . $tambahMenuRequest->nama. '.' .$file_ext;
            
            if(move_uploaded_file($image['tmp_name'], $targetDirectory . $targetFileName)) {
               $tambahMenuRequest->gambar = $targetFileName;
               return true;
            } else {
               return false;
            }
         
    }
}