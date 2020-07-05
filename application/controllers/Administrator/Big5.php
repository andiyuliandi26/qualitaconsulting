<?php

class Big5 extends CI_Controller{
    public function __construct()
    {
         parent::__construct();
        //$this->load->model('big5model');
        $this->load->helper('url_helper');
    }

    public function index()
    {
        $data['big5'] = $this->big5model->get_data();

        $this->load->view("administrator/header");
        $this->load->view("administrator/nav");        
        $this->load->view("administrator/big5/main", $data);
        $this->load->view("administrator/footer");
    }
}

?>