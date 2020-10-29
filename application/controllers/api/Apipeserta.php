<?php
// import library dari REST_Controller
require APPPATH . 'libraries/RestController.php';
require APPPATH . 'libraries/Format.php';

// use namespace
use chriskacerguis\RestServer\RestController;

class Apipeserta extends RestController
{
    public function __construct(){
        parent::__construct();
        $this->load->helper('jwt');
        $this->load->library('email');
    }

    public function index_get()
    {// testing respons
        $response['status']=200;
        $response['error']=false;
        $response['message']='Hai from response';// tampilkan response
        $this->response($response);
    }

    #region Peserta Test
    public function peserta_update_answer_post(){
        if($this->post('pesertaID') !== NULL && $this->post('jawaban') !== NULL && $this->post('currentTestDuration') !== NULL){
            $pesertaID = $this->post('pesertaID');
            $jawabanNew = $this->post('jawaban');
            $currentPage = $this->post('currentPage');
            $currentTestDuration = $this->post('currentTestDuration');

            $getPeserta = $this->pesertamodel->get_data_byid($pesertaID);
            $getCurrentPage = $this->pesertamodel->get_page_test($getPeserta->Jawaban);
            $getCurrentIndex = ($getCurrentPage - 1) * 3;
            $jawaban = explode(",", $getPeserta->Jawaban);
            $totalDuration = round($currentTestDuration/1000,0);

            //$jawabanNew = $jawaban;

            $response['objectSend'] = array('PesertaID' => $pesertaID , 'Jawaban' => $jawaban , 'currentTestDuration' => $currentTestDuration);
            $response['objectResult'] = "";
            array_splice($jawaban, $getCurrentIndex, 3, $jawabanNew);

            $testStatus = $currentPage == 40 ? 'Completed' : 'Progress';
            $getPeserta->Jawaban = join(',', $jawaban);
            $getPeserta->TestDuration = $totalDuration;
            $getPeserta->TestStatus = $testStatus;

            if($this->pesertamodel->update_data_jawaban_peserta($pesertaID, $getPeserta)){
                if($testStatus == 'Completed'){
                    if($this->resultsmodel->peserta_result_updatedb($pesertaID)){
                        $response['objectResult'] = array('PesertaID' => $pesertaID , 'JawabanNew' => $jawaban , 'TotalDurration' => $totalDuration);
                        $response['TestStatus'] = $testStatus;
                        $response['status']=self::HTTP_OK;
                        $response['error'] = FALSE;
                        $response['message']='Pembuatan data hasil tes berhasil.';
                    }else{
                        $response['status'] =self::HTTP_BAD_REQUEST;
                        $response['error'] = TRUE;
                        $response['message'] ='Pembuatan data hasil tes gagal, silahkan hubungi Administrator.';
                    }
                }else{
                    $response['objectResult'] = array('PesertaID' => $pesertaID , 'JawabanNew' => $jawaban , 'TotalDurration' => $totalDuration);
                    $response['TestStatus'] = $testStatus;
                    $response['status']=self::HTTP_OK;
                    $response['error'] = FALSE;
                    $response['message']='Update data jawaban berhasil.';
                }
            }else{
                $response['status']=self::HTTP_BAD_REQUEST;
                $response['error'] = TRUE;
                $response['message']='Update data jawaban gagal, silahkan hubungi Administrator.';
            }

        }else{
            $response['status'] = self::HTTP_BAD_REQUEST;
            $response['error'] = TRUE;
            $response['message'] = 'Akses API tidak diijinkan.';
        }

        $this->response($response);
    }
    #endregion

    #region Peserta Result
    public function update_result_post(){
        if($this->post('pesertaID') !== NULL){
            if($this->resultsmodel->peserta_result_updatedb($this->post('pesertaID'))){
                $response['error'] = FALSE;
                $response['message']='Update data result peserta berhasil.';
            }else{

                $response['error']=TRUE;
                $response['message']='Update data result peserta gagal.';
            }

            $response['status']=self::HTTP_OK;

        }else{
            $response['status'] = self::HTTP_BAD_REQUEST;
            $response['error'] = TRUE;
            $response['message'] = 'Akses API tidak diijinkan.';
        }

        $this->response($response);
    }

    public function update_result_bytoken_post(){
        $tokenPeserta = $this->post('tokenPeserta');
        if($tokenPeserta !== NULL){
            if($this->resultsmodel->peserta_result_updatedb_bytoken($tokenPeserta)){
                $response['error'] = FALSE;
                $response['message']='Update data result peserta berhasil.';
            }else{

                $response['error']=TRUE;
                $response['message']='Update data result peserta gagal.';
            }

            $response['status']=self::HTTP_OK;

        }else{
            $response['status'] = self::HTTP_BAD_REQUEST;
            $response['error'] = TRUE;
            $response['message'] = 'Akses API tidak diijinkan.';
        }

        $this->response($response);
    }
    #endregion

    public function token_validation_post()
    {
        $jwt = JWT::decode($this->post('token'), 'rahasi', true);

        $this->response([
            'status' => self::HTTP_OK,
            'error' => FALSE,
            'jwt' => $this->post('token'),
            'json_decode' => $jwt
        ]);
    }

    #region Pengiriman email ke peserta
    public function send_email_peserta_post(){
        $pesertaID = $this->post('pesertaID');
        if($pesertaID !== NULL){
            $getPeserta = $this->pesertamodel->get_data_byid($pesertaID);

            if($this->pesertamodel->send_email_peserta($pesertaID)){
                $this->pesertamodel->update_data_email_peserta($pesertaID);
                $response['error'] = FALSE;
                $response['message']= "Pengiriman data perserta ke {$getPeserta->Email} berhasil.";
                $response['emailMessage']= $this->email->print_debugger();

            }else{

                $response['error']=TRUE;
                $response['message']= "Pengiriman data perserta ke {$getPeserta->Email} gagal.";
                $response['emailMessage']= $this->email->print_debugger();
            }

            $response['status']=self::HTTP_OK;

        }else{
            $response['status'] = self::HTTP_BAD_REQUEST;
            $response['error'] = TRUE;
            $response['message'] = 'Akses API tidak diijinkan.';
        }

        $this->response($response);
    }

    public function send_email_hasil_peserta_post(){
        $pesertaID = $this->post('pesertaID');
        if($pesertaID !== NULL){
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

		    if(file_exists($filename)){
		        unlink($filename);
		    }

            if($this->email->send(FALSE)){
                $this->logging->email_sent($getPeserta->NamaPeserta, $getPeserta->Email, "Hasil Profiling | Success");
                $response['error'] = FALSE;
                $response['message']= "Pengiriman hasil profiling ke {$getPeserta->Email} berhasil.";
                $response['emailMessage'] = $this->email->print_debugger();
            }else{
                $this->logging->email_sent($getPeserta->NamaPeserta, $getPeserta->Email, "Hasil Profiling | Gagal", $this->email->print_debugger());
                $response['error']=TRUE;
                $response['message']='Pengiriman hasil profiling ke {$getPeserta->Email} gagal.';
                $response['emailMessage'] = $this->email->print_debugger();
            }

            $response['status']=self::HTTP_OK;

        }else{
            $response['status'] = self::HTTP_BAD_REQUEST;
            $response['error'] = TRUE;
            $response['message'] = 'Akses API tidak diijinkan.';
        }

        $this->response($response);
    }
    #endregion

    #region Additional Report
    public function additional_report_byid_get()
    {
        if($this->get('id') !== NULL){
            $getData = $this->additionalreportmodel->get_data_byid($this->get('id'));

            $response['error'] = FALSE;
            $response['message']='Get data result berhasil.';
            $response['status']=self::HTTP_OK;
            $response['data'] = $getData;

        }else{
            $response['status'] = self::HTTP_BAD_REQUEST;
            $response['error'] = TRUE;
            $response['message'] = 'Akses API tidak diijinkan.';
        }

        $this->response($response);
    }

    public function additional_report_create_post()
    {
        if($this->post('pesertaID') !== NULL){
            if($this->additionalreportmodel->create_data($this->post('pesertaID'),$this->post('item'),$this->post('itemdescription'))){
                $response['error'] = FALSE;
                $response['message']='Tambah data additional report berhasil.';
            }else{

                $response['error']=TRUE;
                $response['message']='Tambah data additional report gagal.';
            }

            $response['status']=self::HTTP_OK;

        }else{
            $response['status'] = self::HTTP_BAD_REQUEST;
            $response['error'] = TRUE;
            $response['message'] = 'Akses API tidak diijinkan.';
        }

        $this->response($response);
    }

    public function additional_report_update_post()
    {
        if($this->post('id') !== NULL){
            if($this->additionalreportmodel->update_data($this->post('id'),$this->post('item'),$this->post('itemdescription'))){
                $response['error'] = FALSE;
                $response['message']='Update data additional report berhasil.';
            }else{

                $response['error']=TRUE;
                $response['message']='Update data additional report gagal.';
            }

            $response['status']=self::HTTP_OK;

        }else{
            $response['status'] = self::HTTP_BAD_REQUEST;
            $response['error'] = TRUE;
            $response['message'] = 'Akses API tidak diijinkan.';
        }

        $this->response($response);
    }

    public function additional_report_delete_post()
    {
        if($this->post('id') !== NULL){
            if($this->additionalreportmodel->delete_data($this->post('id'))){
                $response['error'] = FALSE;
                $response['message']='Delete data additional report berhasil.';
            }else{

                $response['error']=TRUE;
                $response['message']='Update data additional report gagal.';
            }

            $response['status']=self::HTTP_OK;

        }else{
            $response['status'] = self::HTTP_BAD_REQUEST;
            $response['error'] = TRUE;
            $response['message'] = 'Akses API tidak diijinkan.';
        }

        $this->response($response);
    }

    #endregion

}

?>
