<?php

namespace App\Controllers;
use App\Core\MVC\{Controller, View};

use App\Core\Database\Database;
use App\Exception\ValidationException;
use App\Repository\MenuRepository;
use App\Service\EntriReferensiService;
use App\Models\TambahMenuRequest;

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
            try{
                $request = new TambahMenuRequest();
                $request->nama = $this->request->post('nama');
                $request->jenis = $this->request->post('jenis');
                $request->harga = (int)$this->request->post('harga');
                $request->stok = (int)$this->request->post('stok');
                $request->status = (int)$this->request->post('status');
                $request->gambar = $this->request->files['gambar'];
    
                $service = new EntriReferensiService();
                $response = $service->saveMenu($request);
                $this->index($response);
                
            }catch(ValidationException $e){
                $this->index($e->getMessage());
            }
    }

  
//     public function editMenu() {
            
//             $request = [];
//             $request['id'] = $this->request->post('id');
//             $request['nama'] = $this->request->post('nama');
//             $request['harga'] = $this->request->post('harga');
//             $request['stok'] = $this->request->post('stok');
//             $request['status'] = $this->request->post('status');
//             $request['jenis'] = $this->request->post('jenis');

//             try { 
//                 $this->entrimodel->updateData($request);
//                 $this->response->redirect('/entri-referensi');
//             } catch (ValidationException $exception) {
//                 $data = $this->entrimodel->showData($this->user->name, $exception->getMessage());
//                 $view = View::renderView('admin/entri-referensi', $data);
//                 $this->response->setContent($view);
//         }
//     }
//     public function getubah()
//     {
//         $model = $this->entrimodel->getDataById($_POST['id']);
//         echo json_encode($model);
//     }
    
//     public function hapus()
//     {        
//         $this->entrimodel->hapusData($_GET['id']);
//         $this->response->redirect('/entri-referensi');
//     }

//     public function ubah() {        
//         $request = [];
//         $request['id'] = $this->request->post('id');
//         $request['nama'] = $this->request->post('nama');
//         $request['harga'] = $this->request->post('harga');
//         $request['stok'] = $this->request->post('stok');
//         $request['status'] = $this->request->post('status');
//         $request['jenis'] = $this->request->post('jenis');

//         try { 
//             $this->entrimodel->updateData($request);
//             $this->response->redirect('/entri-referensi');
//         } catch (ValidationException $exception) {
//             $data = $this->entrimodel->showData($this->user->name, $exception->getMessage());
//             $view = View::renderView('admin/entri-referensi', $data);
//             $this->response->setContent($view);
//     }
// }
}
