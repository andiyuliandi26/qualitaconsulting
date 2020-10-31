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

    /// generate report versi awal dengan menampilkanya terlebih dahulu di browser
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
            $data['peserta'] = $getPesertaID;
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

    #region Process generate report dalam bentuk PDF dan langsung di kirim ke email peserta
    public function procced_to_report(){
        $this->load->library('email');

        $tokenPeserta = $this->input->post('tokenPeserta', true);
        if($tokenPeserta !== NULL){
            $getPesertaByToken = $this->pesertamodel->get_data_bytoken($tokenPeserta);
            $pesertaID = $getPesertaByToken->ID;
            $getDomain = $this->big5model->get_data();
            $getFacet = $this->facetmodel->get_data();
            $getPeserta = $this->pesertamodel->get_data_byid($pesertaID);
            $resultBig5 = $this->resultsmodel->get_result_big5($pesertaID);
            $resultFacet = $this->resultsmodel->get_result_facet($pesertaID);
            $facetSummaryResult = $this->resultsmodel->generate_facet_summary_result($resultFacet);
            $resultStyle = $this->resultsmodel->get_result_style($pesertaID);
            $resultAdditoinalReport = $this->resultsmodel->get_result_additional_report($pesertaID);

            $getNormaFacet = $this->normafacetmodel->get_data_bygender($getPeserta->JenisKelamin);
            $data['peserta'] = $getPeserta;
            $data['domainResult'] = $resultBig5;
            $data['facetResult'] = $resultFacet;
            $data['result_facet_summary'] = $facetSummaryResult;
            $data['styleResult'] = $resultStyle;
            $data['additionalResult'] = $resultAdditoinalReport;
            $data['md_domain'] = $getDomain;
            $data['md_facet'] = $getFacet;
            $data['md_normafacet'] = $getNormaFacet;

            $cover = $this->load->view("administrator/peserta/results/report/cover", $data, true);
            $data_peserta = $this->load->view("administrator/peserta/results/report/data-peserta", $data, true);
            $data_glosary = $this->load->view("administrator/peserta/results/report/data-glosary", NULL, true);
            $data_body = $this->load->view("administrator/peserta/results/report/data-body", $data, true);
            $data_style = $this->load->view("administrator/peserta/results/report/data-style", $data, true);

			$stylesheet = file_get_contents('assets/css/report.css');
			$mpdf = new \Mpdf\Mpdf();
			$mpdf->SetTitle("Profiling {$getPeserta->NamaPeserta}");
			$mpdf->SetAuthor("Qualita Consulting");
			$mpdf->SetCreator("Qualita Consulting");
			$mpdf->showImageErrors = true;
			$mpdf->imageVars['qasimage'] = file_get_contents('assets/images/Logo QAS.png');

			$mpdf->WriteHTML($stylesheet,\Mpdf\HTMLParserMode::HEADER_CSS);
			$mpdf->AddPage('','','','','on');

			$mpdf->SetFooter('Qualita Consulting | '.$getPeserta->NamaPeserta.' - Profiling Qualita | {PAGENO}');
			$mpdf->WriteHTML($cover,\Mpdf\HTMLParserMode::HTML_BODY);
			$mpdf->AddPage('','','1','','off');
			$mpdf->WriteHTML($data_peserta,\Mpdf\HTMLParserMode::HTML_BODY);
			$mpdf->AddPage();
			$mpdf->WriteHTML($data_glosary,\Mpdf\HTMLParserMode::HTML_BODY);
			$mpdf->AddPage();
			$mpdf->WriteHTML($data_body,\Mpdf\HTMLParserMode::HTML_BODY);
			$mpdf->AddPage();
			$mpdf->WriteHTML($data_style,\Mpdf\HTMLParserMode::HTML_BODY);

			$filename = "application/reporttemp/report_profiling_{$getPeserta->Email}.pdf";
			$testDate = date_format(new DateTime($getPeserta->TestDate), 'd_m_Y');

			$mpdf->Output($filename,\Mpdf\Output\Destination::FILE);  /// -->> Gengerate PDF Report

			$messageBody = $this->load->view("administrator/peserta/results/report/email-view", $data, TRUE);
			$this->email->clear(TRUE);

			$this->email->from($this->config->item("adminEmail"), $this->config->item("nameEmail"));
			$this->email->to($getPeserta->Email);
			$this->email->bcc($this->config->item("adminEmail"));
			$this->email->subject('Hasil Profiling Qualita');
			$this->email->message($messageBody);
			$this->email->attach($filename, "attachement", "Profiling {$getPeserta->NamaPeserta}_{$testDate}.pdf");

            if($this->email->send(FALSE)){
                $this->logging->email_sent($getPeserta->NamaPeserta, $getPeserta->Email, "Hasil Profiling | Success");
			}else{
                $this->logging->email_sent($getPeserta->NamaPeserta, $getPeserta->Email, "Hasil Profiling | Gagal", $this->email->print_debugger());
			}

			if(file_exists($filename)){
			    unlink($filename);
			}

            $this->load_view("administrator/peserta/results/report/email-sent-success", $data);
		    //echo $this->email->print_debugger();
		}else{
		    $data['heading'] = 'Forbiden';
		    $data['message'] = 'Halaman tidak dapat diakses...!!';
		    $this->load_view("errors/html/error_general", $data);
		}
    }
    #endregion

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
