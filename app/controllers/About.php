<?php 
require_once '../app/core/Controller.php';

// Controller = about, Method = index
class About extends Controller{
    // Default index
    public function index($nama = 'zulhusni', $pekerjaan = 'programmer', $umur = 21)
    {
        $data['nama']=$nama;
        $data['pekerjaan']=$pekerjaan;
        $data['umur']=$umur;
        $data['title'] = 'about';
        $this->view('template/header', $data);
        $this->view('about/index', $data); // folder view -> about -> index.php
        $this->view('template/footer');
    }

    public function page()
    {
        $data['title'] = 'pages';
        $this->view('template/header', $data);
        $this->view('about/page'); // folder view -> about -> index.php
        $this->view('template/footer');
    }
}
