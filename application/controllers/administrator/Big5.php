<?php

class Big5 extends MY_Controller{
    public function __construct()
    {
         parent::__construct();
    }

    public function index()
    {
        $filterColumn = $this->input->post('filterColumn');
        $filterOperator = $this->input->post('filterOperator');
        $filterValue = $this->input->post('filterValue');
        $sortBy = $this->input->post('sortBy');
        $sortOrder = $this->input->post('sortOrder');
        $pageSelected = $this->input->post('pageSelected');
        $pageSizeSelected = $this->input->post('pageSizeSelected');

        if($filterColumn && $pageSelected && $pageSizeSelected){
            $data['dataInfo'] = $this->big5model->get_data_byfilterpage($pageSelected, $pageSizeSelected, $filterColumn, $filterValue, $filterOperator, $sortBy, $sortOrder);
        }else{
            $data['dataInfo'] = $this->big5model->get_data_byfilterpage(1,10,'','','','', '');
        }
      
        $this->load_administrator_view("administrator/big5/main", $data);
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