<?php

class Styleparameter extends MY_Controller{
    public function __construct()
    {
         parent::__construct();
    }

    public function index()
    {
        $data['data'] = $this->style_parametermodel->get_data();
      
        $this->load_administrator_view("administrator/styleparameter/main", $data);
    }

    public function update($id){
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->form_validation->set_rules('Style', 'Style', 'required');

        $data['data'] = $this->style_parametermodel->get_data_byid($id);

        if ($this->form_validation->run() === FALSE)
        {
            $this->load_administrator_view('/administrator/styleparameter/update', $data);
        }
        else
        {
           if( $this->style_parametermodel->update_data($id)){
                redirect(base_url("/administrator/styleparameter/"));
           }
        }
    }
}

?>