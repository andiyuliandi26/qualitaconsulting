<?php

class NormaStyle extends CI_Controller{
    public function __construct()
    {
         parent::__construct();
        $this->load->helper('url_helper');
    }

    public function index()
    {
        $data['data'] = $this->normastylemodel->get_data();

        $this->load->view("administrator/header");
        $this->load->view("administrator/nav");        
        $this->load->view("administrator/normastyle/main", $data);
        $this->load->view("administrator/footer");
    }
}

?>