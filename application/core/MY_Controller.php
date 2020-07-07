<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url_helper');
    }

    protected function load_view($path, $data = NULL){
        $this->load->view("administrator/header");
        $this->load->view("administrator/nav");        
        $this->load->view($path, $data);        
        //$view;
        $this->load->view("administrator/footer");
    }
}


?>