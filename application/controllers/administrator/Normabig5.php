<?php

class Normabig5 extends MY_Controller{
    public function __construct()
    {
         parent::__construct();
    }

    public function index()
    {
        $data['data'] = $this->normabig5model->get_data();
      
        $this->load_administrator_view("administrator/normabig5/main", $data);
    }

    public function update($id){
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->form_validation->set_rules('BatasBawah', 'Batas Bawah', 'required');

        $data['data'] = $this->normabig5model->get_data_byid($id);

        if ($this->form_validation->run() === FALSE)
        {
            $this->load_administrator_view('/administrator/normabig5/update', $data);
        }
        else
        {
           if( $this->normabig5model->update_data($id)){
                redirect(base_url("/administrator/normabig5/"));
           }
        }
    }
}

?>