<?php

class Client extends MY_Controller{
    
    public function index(){
        $filterColumn = $this->input->post('filterColumn');
        $filterOperator = $this->input->post('filterOperator');
        $filterValue = $this->input->post('filterValue');
        $sortBy = $this->input->post('sortBy');
        $sortOrder = $this->input->post('sortOrder');
        $pageSelected = $this->input->post('pageSelected');
        $pageSizeSelected = $this->input->post('pageSizeSelected');

        if($filterColumn && $pageSelected && $pageSizeSelected){
            $data['dataInfo'] = $this->clientmodel->get_data_byfilterpage($pageSelected, $pageSizeSelected, $filterColumn, $filterValue, $filterOperator, $sortBy, $sortOrder);
        }else{
            $data['dataInfo'] = $this->clientmodel->get_data_byfilterpage(1,10,'','','','', '');
        }
        
        $this->load_administrator_view('/administrator/peserta/client/main', $data);
    }

    public function create(){
        $this->load->helper('form');
        $this->load->library('form_validation');

        $this->form_validation->set_rules('KodeClient', 'Kode Client', 'required');
        $this->form_validation->set_rules('NamaClient', 'Nama Client', 'required');
        $data['data'] = '';
        $data['kategori'] = $this->clientmodel->kategoriList;

        if ($this->form_validation->run() === FALSE)
        {
            $this->load_administrator_view('/administrator/peserta/client/create', $data);
        }
        else
        {
            $this->clientmodel->create_client();
            redirect(base_url()."/administrator/peserta/client");
        }
    }

    public function update($id){
        $this->load->helper('form');
        $this->load->library('form_validation');

        $this->form_validation->set_rules('KodeClient', 'Kode Client', 'required');
        $this->form_validation->set_rules('NamaClient', 'Nama Client', 'required');
        $data['data'] = $this->clientmodel->get_data_byid($id);
        $data['kategori'] = $this->clientmodel->kategoriList;
        
        if ($this->form_validation->run() === FALSE)
        {
            $this->load_administrator_view('/administrator/peserta/client/update', $data);
        }
        else
        {
            $this->clientmodel->update_client();
            $this->index();
        }
    }
}



?>