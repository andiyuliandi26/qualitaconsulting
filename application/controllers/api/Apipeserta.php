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

    public function send_email_peserta_post(){
        if($this->post('pesertaID') !== NULL){
            if($this->pesertamodel->send_email_peserta($this->post('pesertaID'))){
                $this->pesertamodel->update_data_email_peserta($this->post('pesertaID'));
                $response['error'] = FALSE;
                $response['message']='Pengiriman email berhasil.';
                $response['emailMessage']= $this->email->print_debugger();
            }else{

                $response['error']=TRUE;
                $response['message']='Pengiriman email gagal.';
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