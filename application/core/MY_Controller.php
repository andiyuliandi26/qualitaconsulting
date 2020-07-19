<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url_helper');
        $this->load->helper('form');
        $this->load->helper('jwt');
    }

    protected function load_view($path, $data = NULL){
        $this->load->view("administrator/header");
        $this->load->view("administrator/nav");        
        $this->load->view($path, $data);        
        //$view;
        $this->load->view("administrator/footer");
    }

    protected function load_administrator_view($path, $data = NULL){
        $this->load->view("layouts/header");
        $this->load->view("layouts/nav");        
        $this->load->view($path, $data);        
        //$view;
        $this->load->view("layouts/footer");
    }
}


?>