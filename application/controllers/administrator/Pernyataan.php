<?php

class Pernyataan extends CI_Controller{
    public function __construct()
    {
         parent::__construct();
        //$this->load->model('big5model');
        $this->load->helper('url_helper');
    }

    public function index()
    {
        $data['data'] = $this->pernyataanmodel->get_data();

        $this->load->view("administrator/header");
        $this->load->view("administrator/nav");        
        $this->load->view("administrator/pernyataan/main", $data);
        $this->load->view("administrator/footer");
    }
}

?>