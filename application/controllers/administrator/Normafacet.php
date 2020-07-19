<?php

class Normafacet extends MY_Controller{
    public function __construct()
    {
         parent::__construct();
    }

    public function index()
    {
        $data['data'] = $this->normafacetmodel->get_data();
      
        $this->load_administrator_view("administrator/normafacet/main", $data);
    }

    public function update($id){
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->form_validation->set_rules('BatasBawah', 'Batas Bawah', 'required');

        $data['data'] = $this->normafacetmodel->get_data_byid($id);

        if ($this->form_validation->run() === FALSE)
        {
            $this->load_administrator_view('/administrator/normafacet/update', $data);
        }
        else
        {
           if( $this->normafacetmodel->update_data($id)){
                redirect(base_url("/administrator/normafacet/"));
           }
        }
    }
}

?>