<?php
namespace App\Controllers;

use App\Core\Database\Database;
use App\Core\MVC\{Controller, View};
use App\Repository\MenuRepository;

class HomeController extends Controller {

    public function index() {
        if($this->user == null){
            $menuRepository = new MenuRepository(Database::getConnection());
            $dataMakanan = $menuRepository->getMenuByJenis('Makanan');
            $dataMinuman = $menuRepository->getMenuByJenis('Minuman');
            $view = View::renderViewOnly('index', [
                "title" => "Login Management",
                "makanan" => $dataMakanan,
                "minuman" => $dataMinuman
            ]);
            $this->response->setContent($view);
        }else{
            if($this->model('HomeModel')->is_admin($this->user->id)){
                $this->dashboard();
            }else{
                $this->response->redirect('/home');
            }
        }
    }

    public function dashboard() {
        $model = $this->model('HomeModel')->dataDashboard($this->user);
        $view = View::renderView('admin/dashboard', $model);
        $this->response->setContent($view);
    }
    
}
