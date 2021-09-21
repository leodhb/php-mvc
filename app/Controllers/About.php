<?php
namespace Controllers;
use \Libraries\Controller;

class About extends Controller{

    private $userModel;

    public function __construct()
    {
     //  $this->userModel = $this->model('User'); 
    }

    public function index() {
        $this->view('pages/about');
    }
}