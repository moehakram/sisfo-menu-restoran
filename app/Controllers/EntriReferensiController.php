<?php

namespace App\Controllers;
use App\Core\MVC\{Controller, View};

use App\Core\Database\Database;
use App\Exception\ValidationException;
use App\Repository\MenuRepository;
use App\Service\EntriReferensiService;
use App\Models\{TambahMenuRequest, EditMenuRequest};

class EntriReferensiController extends Controller {

    public function index($pesan = '') {
        $menuRepository = new MenuRepository(Database::getConnection());
        $dataMakanan = $menuRepository->getByJenis('Makanan');
        $dataMinuman = $menuRepository->getByJenis('Minuman');
        $html = View::renderView('admin/entri-referensi', [
            "title" => "Entri Referensi",
            "pesan" => $pesan,
            "user" => [
                "name" => $this->user->name
            ],
            "makanan" => $dataMakanan,
            "minuman" => $dataMinuman
        ]);
        
        $this->response->setContent($html);
    }
 
    public function tambahMenu() {
        $request = new TambahMenuRequest();
        $request->nama = $this->request->post('nama');
        $request->jenis = $this->request->post('jenis');
        $request->harga = (int)$this->request->post('harga');
        $request->stok = (int)$this->request->post('stok');
        $request->status = (int)$this->request->post('status');
        $request->gambar = $this->request->files['gambar'];
        
        try{
            $service = new EntriReferensiService();
            $response = $service->saveMenu($request);    
            // header('HTTP/1.1 200 OK');
            $this->response->setContent($response)->JSON();
        }catch(ValidationException $exception){
            // header('HTTP/1.1 500 Internal Server Error');
            $this->response->setContent(['status' => 'gagal', 'pesan' => $exception->getMessage()])->JSON();
        }
    }

  
    public function editMenu() {
            
        $request = new EditMenuRequest();
        $request->id = $this->request->post('id');
        $request->nama = $this->request->post('nama');
        $request->harga = $this->request->post('harga');
        $request->stok = $this->request->post('stok');
        $request->status = $this->request->post('status');
        $request->jenis = $this->request->post('jenis');
        $request->gambar = $this->request->files['gambar'];
        $request->old_gambar = $this->request->post('oldImage');
        
        try{
            $service = new EntriReferensiService();
            $response = $service->updateMenu($request);
            
            $this->response->setContent($response)->JSON();
        }catch(ValidationException $exception){
            $this->response->setContent(['status' => 'gagal', 'pesan' => $exception->getMessage()])->JSON();
        }
    }

    public function getubah()
    {
        $menuRepository = new MenuRepository(Database::getConnection());
        $data = $menuRepository->getById($this->request->post('id'));
        $this->response->setContent($data)->JSON();
    }
    
    public function hapus()
    {   $data = [
        'id' => $this->request->post('id'),
        'path_img' => $this->request->post('pathImage')
     ];
        $service = new EntriReferensiService();
        $response = $service->hapus($data);
        $this->response->setContent($response)->JSON();
    }

}
