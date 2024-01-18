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
        
        // $this->response->setHeader('Content-Type: application/json; charset=UTF-8');
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
            $this->index($response);
        }catch(ValidationException $e){
            $this->index($e->getMessage());
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

            try{
                $service = new EntriReferensiService();
                $response = $service->updateMenu($request);
                $this->index($response);
            }catch(ValidationException $e){
                $this->index($e->getMessage());
            }
        }

    public function getubah()
    {
        $menuRepository = new MenuRepository(Database::getConnection());
        $data = $menuRepository->getById($_POST['id']);
        echo json_encode($data);
    }
    
    public function hapus()
    {   
        $menuRepository = new MenuRepository(Database::getConnection());
        $menuRepository->delete($_GET['id']);
        $this->response->redirect('/entri-referensi');
    }

}
