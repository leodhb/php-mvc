<?php
namespace Libraries;
use \Helpers\Component;

class Controller {

    private $provider = '\\Models\\';

    public function model($model) {
        $model = $this->provider . $model;
        return new $model;
    }
    
    public function view($view, $data = []) {
        $path = '../app/Views/'.$view.'.php';
        if(file_exists($path)) {
            Component::render('header');
            require_once $path;
            Component::render('footer');
        } else {
            die('View not found');
        }
    }
    
    public function error_404() {
        $this->view('pages/errors/404');
    }
    
}