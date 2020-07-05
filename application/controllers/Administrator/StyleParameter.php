<?php

class StyleParameter extends CI_Controller{
    public function __construct()
    {
         parent::__construct();
        $this->load->helper('url_helper');
    }

    public function index()
    {
        $data['facet'] = $this->style_parametermodel->get_data();

        $this->load->view("administrator/header");
        $this->load->view("administrator/nav");        
        $this->load->view("administrator/styleparameter/main", $data);
        $this->load->view("administrator/footer");
    }
}

?>