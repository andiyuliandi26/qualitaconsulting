<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Test extends MY_Controller {
    public function __construct()
    {
        parent::__construct();
    }

    public function index() {
        $token = $this->input->get('token', true);
        $tokenPost = $this->input->post('token', true);
        $tokenPeserta = $this->input->post('tokenPeserta', true);

        if($tokenPost && $tokenPeserta){
            $getClientBatch = $this->clientbatchmodel->get_data_bytoken($token);
            $peserta = $this->pesertamodel->get_peserta_by_pesertatoken($tokenPeserta);
            $data['tokenTest'] = $tokenPost;
            $data['tokenPeserta'] = $tokenPeserta;
            $data['peserta'] = $peserta;
            switch ($peserta->TestStatus) {
                case 'Profile':
                    $data['buttonStartTitle'] = 'Mulai Tes!';
                    $this->load_view('peserta/profile', $data);
                    break;
                case 'Progress':
                    $data['buttonStartTitle'] = 'Lanjutkan Tes!';
                    $this->load_view('peserta/profile', $data);
                    break;
                case 'Completed':
                    # code...
                    break;
            }

        }elseif ($token || $tokenPost) {
            
            if($token){
                $currentToken = $token;
            }else{
                $currentToken = $tokenPost;
            }

            $tokenIsValid = $this->_cekToken($currentToken);
            if ($tokenIsValid) {
                $getClientBatch = $this->clientbatchmodel->get_data_bytoken($currentToken);
                $token_peserta = $this->input->cookie('token');
                if ($token_peserta) {
                    $peserta = $this->pesertamodel->get_peserta_by_pesertatoken($token_peserta);
                    $testStatus = $peserta->TestStatus;
                    switch ($testStatus) {
                        case 'Profile':
                            
                            break;
                        case 'Progress':
                            # code...
                            break;
                        case 'Completed':
                            # code...
                            break;
                    }
                    return;
                }
                
                $data['jabatanList'] = $this->pesertamodel->jabatanList;
                $data['clientBatch'] = $getClientBatch;
                $this->load_view('peserta/input-profile', $data);

                //$this->_inputProfile($token);
            } else {
                redirect('test', 'refresh');
            }
        } else {
            $this->load_view('peserta/input-token');
        }
    }

    public function registerpeserta() {
        if ($this->input->post('iNama')) {
            $pesertaNew = (object) array(
                'NamaPeserta' => $this->input->post('iNama'),
                'Email' => $this->input->post('iEmail'),
                'JenisKelamin' => $this->input->post('iJenisKelamin'),
                'Usia' => $this->input->post('iUsia'),
                'JabatanPekerjaan' => $this->input->post('iJabatansSelected'),
                'BidangPekerjaan' => $this->input->post('iPekerjaan'),
                'BatchID' => $this->input->post('iBatchID'),
                'Handphone' => $this->input->post('iHandphone'),
            );

            //var_dump($pesertaNew);
            $insertDataPeserta = $this->pesertamodel->create_data_peserta($pesertaNew);

            if($insertDataPeserta !== NULL){
                $data['tokenTest'] = $insertDataPeserta->TokenTest;                
                $data['tokenPeserta'] = $insertDataPeserta->Token;
                $data['peserta'] = $insertDataPeserta;
                $data['buttonStartTitle'] = 'Mulai Tes!';

                if($this->pesertamodel->send_email_peserta($insertDataPeserta->ID)){
                    $this->pesertamodel->update_data_email_peserta($insertDataPeserta->ID);
                }
                
                $this->load_view('peserta/profile', $data);
            }else{
                redirect('test');
                //$this->load_view('peserta/input-profile');
            }
            
        }
        else {
            redirect('test');
        }
    }

    public function progress(){
        $tokenPeserta = $this->input->post('tokenPeserta', true);
        if($tokenPeserta !== NULL){
            $getPeserta = $this->pesertamodel->get_data_bytoken($tokenPeserta);  
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
            $this->load->view("peserta/progress", $data);       
            $this->load->view("layouts/footer");
        }else{
            $data['heading'] = 'Forbiden';
            $data['message'] = 'Halaman tidak dapat diakses...!!';
            $this->load_view("errors/html/error_general", $data); 
        }
        
    }

    public function generate_report(){
        $tokenPeserta = $this->input->post('tokenPeserta', true);
        if($tokenPeserta !== NULL){
            $getPesertaID = $this->pesertamodel->get_data_bytoken($tokenPeserta);  
            $getPeserta = $this->resultsmodel->get_peserta($getPesertaID->ID);
            $resultBig5 = $this->resultsmodel->get_result_big5($getPesertaID->ID);
            $resultFacet = $this->resultsmodel->get_result_facet($getPesertaID->ID);        
            $facetSummaryResult = $this->resultsmodel->generate_facet_summary_result($resultFacet);
            $resultStyle = $this->resultsmodel->get_result_style($getPesertaID->ID);
            $resultAdditoinalReport = $this->resultsmodel->get_result_additional_report($getPesertaID->ID);
            //var_dump($resultStyle);
            $data['peserta'] = $getPeserta;                
            $data['big5'] = $resultBig5;
            $data['facet'] = $resultFacet;
            $data['result_facet_summary'] = $facetSummaryResult;
            $data['style'] = $resultStyle;
            $data['additional'] = $resultAdditoinalReport;
            
            $this->load_view("peserta/hasiltest", $data);
        }else{
            $data['heading'] = 'Forbiden';
            $data['message'] = 'Halaman tidak dapat diakses...!!';
            $this->load_view("errors/html/error_general", $data); 
        }        
    }

    public function result() {
        $tokenGet = $this->input->get('token', true);
        $tokenPost = $this->input->post('tokenPeserta', true);

        if ($tokenGet || $tokenPost) {
            if($tokenGet){
                $currentToken = $tokenGet;
            }else{
                $currentToken = $tokenPost;
            }

            $tokenIsValid = $this->_cekTokenPeserta($currentToken);
            if ($tokenIsValid) {
                $getPesertaData = $this->pesertamodel->get_data_bytoken($currentToken); 

                //$getPeserta = $this->pesertamodel->get_peserta($getPesertaData->ID);
                $resultBig5 = $this->resultsmodel->get_result_big5($getPesertaData->ID);
                $resultFacet = $this->resultsmodel->get_result_facet($getPesertaData->ID);        
                $facetSummaryResult = $this->resultsmodel->generate_facet_summary_result($resultFacet);
                $resultStyle = $this->resultsmodel->get_result_style($getPesertaData->ID);
                $resultAdditoinalReport = $this->resultsmodel->get_result_additional_report($getPesertaData->ID);
                //var_dump($getPeserta);
                //var_dump($resultStyle);
                $data['peserta'] = $getPesertaData;                
                $data['big5'] = $resultBig5;
                $data['facet'] = $resultFacet;
                $data['result_facet_summary'] = $facetSummaryResult;
                $data['style'] = $resultStyle;
                $data['additional'] = $resultAdditoinalReport;
                $data['tokenTest'] = $getPesertaData->TokenTest;                
                $data['tokenPeserta'] = $getPesertaData->Token;
                
                switch ($getPesertaData->TestStatus) {
                    case 'Profile':
                        //$data['peserta'] = $getPesertaData; 
                        $data['buttonStartTitle'] = 'Mulai Tes!';
                        $this->load_view('peserta/profile', $data);
                        break;
                    case 'Progress':
                        $data['buttonStartTitle'] = 'Lanjutkan Tes!';
                        $this->load_view('peserta/profile', $data);
                        break;
                    case 'Completed':
                        $this->load_view("peserta/hasiltest", $data);  
                        break;
                }    
            } else {
                redirect('test/result', 'refresh');
            }
        } else {
            $this->load_view('peserta/input-hasiltest');
        }
    }
    
    #region Validation
    private function _cekTokenPeserta($token) {
        // cek token
        $data = $this->pesertamodel->validasi_token($token);

        //var_dump($tokenDateExpired->format('d/m/Y'));
        if (!$data) {
            $this->session->set_flashdata('message', 'Hey, Anda memasukkan token yang salah!');
            $this->session->set_flashdata('message_type', 'warning');
            return FALSE;
        }

        $tokenDateExpired = new DateTime($data->TestDate);
        $tokenDateExpired->add(new DateInterval('P6M'));
        //$tokenDateExpired->add(new DateInterval('P1D'));


        //validasi status progress peserta
        if($data->TestStatus != 'Completed'){
            //$this->session->set_flashdata('message', 'Anda belum menyelesaikan tes, <a href="/test" class="btn btn-link text-decoration-none">klik disini</a> untuk melanjutkan kembali.');
            //$this->session->set_flashdata('message_type', 'warning');
            //return FALSE;
        }

        // cek validasi waktu test
        if (time() > strtotime($tokenDateExpired->format('Y-m-d'))) {
            $this->session->set_flashdata('message', 'Maaf, token yang Anda masukan <strong>sudah expired</strong>, Anda tidak bisa melihat hasil tes kembali.');
            $this->session->set_flashdata('message_type', 'info');
            return FALSE;
        }
        return TRUE;
    }

    private function _cekToken($token) {
        // cek token
        $data = $this->clientbatchmodel->validasi_token($token);
        if (!$data) {
            $this->session->set_flashdata('message', 'Hey, kamu memasukkan token yang salah!');
            $this->session->set_flashdata('message_type', 'warning');
            return FALSE;
        }
        // cek validasi waktu test
        if (time() < strtotime($data->TanggalTest ." ".$data->JamAwalTest)) {
            $this->session->set_flashdata('message', 'Waktu tes belum dimulai.. Coba lagi nanti ya.');
            $this->session->set_flashdata('message_type', 'info');
            return FALSE;
        } elseif (time() > strtotime($data->TanggalTest ." ".$data->JamAkhirTest)) {
            $this->session->set_flashdata('message', 'Maaf, waktu tes sudah selesai. Kamu sudah tidak bisa mengikutinya.');
            $this->session->set_flashdata('message_type', 'info');
            return FALSE;
        }
        // cek jumlah peserta
        $pesertaTerdaftar = $this->pesertamodel->get_jmlpeserta_by_batchid($data->ID);
        if ($pesertaTerdaftar >= $data->TotalPeserta) {
            $this->session->set_flashdata('message', 'Maaf, jumlah peserta tes sudah memenuhi kuota.');
            $this->session->set_flashdata('message_type', 'info');
            return FALSE;
        }
        return TRUE;
    }

    private function _showProfile($pesertaNew) {
        $data['peserta'] = $pesertaNew;
        $this->load_view('peserta/profile', $data);
    }
    #endregion
}