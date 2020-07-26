<?php

class Big5 extends MY_Controller{
    public function __construct()
    {
         parent::__construct();
    }

    public function index()
    {
        if (!$this->ion_auth->logged_in())
		{
			// redirect them to the login page
			redirect('auth/login', 'refresh');
		}else{

            $data['data'] = $this->big5model->get_data();
      
            $this->load_administrator_view("administrator/big5/main", $data);
        }
    }

    public function update($id){
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->form_validation->set_rules('RedaksiLow', 'Redaksi Low', 'required');

        $data['data'] = $this->big5model->get_data_byid($id);

        if ($this->form_validation->run() === FALSE)
        {
            $this->load_administrator_view('/administrator/big5/update', $data);
        }
        else
        {
           if( $this->big5model->update_data($id)){
                redirect(base_url("/administrator/big5/"));
           }
        }
    }
}

?>