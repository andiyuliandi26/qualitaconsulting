<?php

class NormaBig5 extends CI_Controller{
    public function __construct()
    {
         parent::__construct();
        $this->load->helper('url_helper');
    }

    public function index()
    {
        $data['data'] = $this->normabig5model->get_data();

        $this->load->view("administrator/header");
        $this->load->view("administrator/nav");        
        $this->load->view("administrator/normabig5/main", $data);
        $this->load->view("administrator/footer");
    }
}

?>