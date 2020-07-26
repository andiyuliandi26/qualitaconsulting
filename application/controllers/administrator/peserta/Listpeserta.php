<?php

class Listpeserta extends MY_Controller{
    public function index(){  
        $data['data'] = NULL;
        if($this->ion_auth->is_admin()){
            $data['data'] = $this->pesertamodel->get_data();
        }else{ 
            if ($this->ion_auth->logged_in())
		    {           
                    $data['data'] = $this->pesertamodel->get_data_current_user($this->current_user()->id);
            }
        }

        $this->load_administrator_view('/administrator/peserta/listpeserta/main', $data);
    }

    public function update_result()
    {
        if($this->input->post('pesertaID') !== NULL && $this->input->is_ajax_request()){
            $updateData = $this->resultsmodel->peserta_result_updatedb($this->input->post('pesertaID'));
            
            return ($updateData) ? 'TRUE' : 'FALSE';
        }else{
            return 'FALSE';
        }
    }

    public function assignment_additional_report($pesertaIDGet)
    {
        //$pesertaIDGet = $this->input->get_post('id');
        $userID = $this->input->get('userid');
        $pesertaIDPost = $this->input->get('pesertaID');
        //var_dump($pesertaIDGet);
        if($userID === NULL){
            $getPeserta = $this->pesertamodel->get_data_byid($pesertaIDGet);
            $getUserList = $this->ion_auth->get_data_for_selector();

            $data['peserta'] = $getPeserta;
            $data['userlist'] = $getUserList;

            $this->load_administrator_view('/administrator/peserta/listpeserta/assignmentpeserta', $data);
        }else{
            $getPeserta = $this->pesertamodel->get_data_pesertaonly_byid($pesertaIDPost);
            $getPeserta->AdminAssignment = $userID;

            if($this->pesertamodel->update_data_peserta($getPeserta)){
                redirect('administrator/peserta');
            }
        }
    }
}

?>