<?php

class Pretest extends MY_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->helper('url_helper');
        $this->load->helper('form');
    }

    public function index($pesertaID){
        $getPeserta = $this->pesertamodel->get_data_byid($pesertaID);  
        $getDefaultAnswer = $this->pernyataanmodel->get_default_answer();    
        
        $getCurrentPage = $this->pesertamodel->get_page_test($getPeserta->Jawaban);
        $getCurrentIndex = ($getCurrentPage - 1) * 3;
        $getPernyataan = $this->pernyataanmodel->get_data_bypage($getCurrentPage);
        
        //var_dump($getDefaultAnswer);
        $pernyataanID = explode(",", $getPeserta->PernyataanID);
        $jawaban = explode(",", $getPeserta->Jawaban);        
        $jawabanNew = array(4,5,2);

        $data['peserta'] = $getPeserta;
        $data['pernyataan'] = $getPernyataan;
        $data['defaultAnswer'] = $getDefaultAnswer;
        $data['currentPage'] = $getCurrentPage;

        $this->load->view("layouts/header");
        $this->load->view("layouts/nav_global");        
        $this->load->view("peserta/pretest/main", $data);       
        $this->load->view("layouts/footer");
    }

    public function update_data_test(){
        if($this->input->post('jawaban0') && $this->input->post('jawaban1') && $this->input->post('jawaban2')){
            $getPeserta = $this->pesertamodel->get_data_byid($this->input->post('pesertaID'));
            $getCurrentPage = $this->get_page_test($getPeserta->Jawaban);
            $getCurrentIndex = ($getCurrentPage - 1) * 3;
            $jawaban = explode(",", $getPeserta->Jawaban);        
            $jawabanNew = array($this->input->post('jawaban0'),$this->input->post('jawaban1'),$this->input->post('jawaban2'));

            array_splice($jawaban, $getCurrentIndex, 3, $jawabanNew);

            $getPeserta->Jawaban = join(',', $jawaban);

            print_r($getPeserta);
            echo '<br/>';
            echo '<br/>';
            print_r($getPeserta);
        }

        //redirect(base_url("/pretest/2"));
    }
}
?>