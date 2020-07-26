<?php

class Clientbatch extends MY_Controller{
    public function index(){
        $data['data'] = $this->clientbatchmodel->get_data();

        $this->load_administrator_view('/administrator/peserta/clientbatch/main', $data);
    }

    public function create(){
        $this->load->helper('form');
        $this->load->library('form_validation');

        $this->form_validation->set_rules('ClientID', 'Client', 'required');        
        $this->form_validation->set_rules('NamaBatch', 'Nama Batch', 'required|callback_namabatch_check');
        $this->form_validation->set_rules('TanggalTest', 'Tanggal Test', 'required');
        $this->form_validation->set_rules('JamAwalTest', 'Jam Awal Test', 'required');
        $this->form_validation->set_rules('JamAkhirTest', 'Jam Akhir Test', 'required');
        $this->form_validation->set_rules('TotalPeserta', 'Total Peserta', 'required|greater_than[0]');
        $this->form_validation->set_rules('DurasiTest', 'Durasi Test', 'required|greater_than[0]');
        $this->form_validation->set_rules('Token', 'Token', 'required|min_length[10]|callback_token_check', array(
                        'required' => '%s wajib diisi',
                        'min_length' => 'Jumlah karakter %s minimum 10',
                        'is_unique' => '%s harus unique'
        ));

        $data['data'] = '';
        $data['client_list'] = $this->clientmodel->get_data_for_selector();

        if ($this->form_validation->run() === FALSE)
        {
            $this->load_administrator_view('/administrator/peserta/clientbatch/create', $data);
        }
        else
        {
           if( $this->clientbatchmodel->create_data()){
                //$this->index();
                redirect(base_url("/administrator/peserta/clientbatch"));
           }
        }
    }

    public function update($id){
        $this->load->helper('form');
        $this->load->library('form_validation');

        $this->form_validation->set_rules('ClientID', 'Client', 'required');
        $this->form_validation->set_rules('NamaBatch', 'Nama Batch', 'required|callback_namabatch_check');
        $this->form_validation->set_rules('TanggalTest', 'Tanggal Test', 'required');
        $this->form_validation->set_rules('JamAwalTest', 'Jam Awal Test', 'required');
        $this->form_validation->set_rules('JamAkhirTest', 'Jam Akhir Test', 'required');
        $this->form_validation->set_rules('TotalPeserta', 'Total Peserta', 'required|greater_than[0]');
        $this->form_validation->set_rules('DurasiTest', 'Durasi Test', 'required|greater_than[0]');
        $this->form_validation->set_rules('Token', 'Token', 'required|min_length[10]|callback_token_check', array(
                        'required' => '%s wajib diisi',
                        'min_length' => 'Jumlah karakter %s minimum 10',
                        'is_unique' => '%s harus unique'
        ));

        $data['data'] = $this->clientbatchmodel->get_data_byid($id);
        $data['client_list'] = $this->clientmodel->get_data_for_selector();

        if ($this->form_validation->run() === FALSE)
        {
            $this->load_administrator_view('/administrator/peserta/clientbatch/update', $data);
        }
        else
        {
           if( $this->clientbatchmodel->update_data($id)){
                redirect(base_url("/administrator/peserta/clientbatch"));
           }
        }
    }

    function namabatch_check()
    {
        if(!$this->clientbatchmodel->check_namabatch_data($this->input->post('ClientID'), $this->input->post('NamaBatch'), $this->input->post('ID'))){
            $this->form_validation->set_message('namabatch_check', '{field} dengan Client tersebut sudah ada.');
            return FALSE;
        }else{
            return TRUE;
        }
    }

    function token_check()
    {
        if(!$this->clientbatchmodel->check_token_data($this->input->post('ClientID'), $this->input->post('Token'), $this->input->post('ID'))){
            $this->form_validation->set_message('token_check', '{field} tersebut sudah ada.');
            return FALSE;
        }else{
            return TRUE;
        }
    }
}



?>