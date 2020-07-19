<?php

class Facet extends MY_Controller{
    public function __construct()
    {
         parent::__construct();
        $this->load->helper('url_helper');
    }

    public function index()
    {
        $data['data'] = $this->facetmodel->get_data();
      
        $this->load_administrator_view("administrator/facet/main", $data);
    }

    public function update($id){
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->form_validation->set_rules('RedaksiLow', 'Redaksi Low', 'required');

        $data['data'] = $this->facetmodel->get_data_byid($id);

        if ($this->form_validation->run() === FALSE)
        {
            $this->load_administrator_view('/administrator/facet/update', $data);
        }
        else
        {
           if( $this->facetmodel->update_data($id)){
                redirect(base_url("/administrator/facet/"));
           }
        }
    }
}

?>