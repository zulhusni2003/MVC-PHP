<?php 
require_once '../app/core/Controller.php';

// Controller = Home, Method = index
class Home extends Controller {
    public function index()
    {
        // Call view method
        $data['title'] = 'home';
        $this->view('template/header', $data);
        $this->view('home/index'); // folder view -> home -> index.php
        $this->view('template/footer');
    }
}
