<?php

class Normastyle extends MY_Controller{
    public function __construct()
    {
         parent::__construct();
    }

    public function index()
    {
        $data['data'] = $this->normastylemodel->get_data();
        $data['dataBig5'] = $this->big5model->get_data();
      
        $this->load_administrator_view("administrator/normastyle/main", $data);
    }

    public function update($id){
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->form_validation->set_rules('Redaksi', 'Redaksi', 'required');

        $data['data'] = $this->normastylemodel->get_data_byid($id);

        if ($this->form_validation->run() === FALSE)
        {
            $this->load_administrator_view('/administrator/normastyle/update', $data);
        }
        else
        {
           if( $this->normastylemodel->update_data($id)){
                redirect(base_url("/administrator/normastyle/"));
           }
        }
    }

    
}

?>