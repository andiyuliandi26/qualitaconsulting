<?php

class Pesertamodel extends Basemodel{
    public $selectedColumn = self::TABLE_PESERTA.'.NamaPeserta';
    private $defaultPernyataanID = "1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31,32,33,34,35,36,37,38,39,40,41,42,43,44,45,46,47,48,49,50,51,52,53,54,55,56,57,58,59,60,61,62,63,64,65,66,67,68,69,70,71,72,73,74,75,76,77,78,79,80,81,82,83,84,85,86,87,88,89,90,91,92,93,94,95,96,97,98,99,100,101,102,103,104,105,106,107,108,109,110,111,112,113,114,115,116,117,118,119,120";
    private $defaultAnswer = ",,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,";
    //private $currentDate = date('y-m-d');
    private $defaultTestStatus = 'Profile';
    private $defaultTestDuration = 0;
    public $jabatanList = array(
        'Pelajar','Mahasiswa','Trainiee/Magang','Staff','Supervisor','Manager','Lainnya'
    );

    public function get_data()
    {
        $client = new Clientmodel;
        $clientbatch = new Clientbatchmodel;
        $this->db->select(self::TABLE_PESERTA.'.*,'.$client->selectedColumn.','.$clientbatch->selectedColumn.', users.username')
            ->from(self::TABLE_PESERTA)
            ->join(self::TABLE_CLIENT_BATCH, self::TABLE_CLIENT_BATCH.'.ID = '.self::TABLE_PESERTA.'.BatchID')
            ->join(self::TABLE_CLIENT, self::TABLE_CLIENT.'.ID = '.self::TABLE_CLIENT_BATCH.'.ClientID')
            ->join('users', 'users.id = '.self::TABLE_PESERTA.'.AdminAssignment', 'LEFT OUTER')
            ->order_by(self::TABLE_CLIENT_BATCH.'.ClientID','ASC')
            ->order_by(self::TABLE_PESERTA.'.BatchID','ASC')
            ->order_by(self::TABLE_PESERTA.'.ID','ASC');
        //var_dump($this->db->get_compiled_select());
        return $this->db->get()->result_object();
    }

    public function get_data_byfilterpage($page, $pageSize, $filterColumn, $filterValue, $filterOperator, $sortBy, $sortOrder)
    {
        $client = new Clientmodel;
        $clientbatch = new Clientbatchmodel;
        $fieldList = (object)array(
            "NamaPeserta" => 'Nama Peserta',
            "NamaBatch" => 'Nama Batch',
            "NamaClient" => 'Nama Client',
            "JenisKelamin" => 'Jenis Kelamin',
            "TestDate" => 'Tanggal Tes',
            "TestStatus" => 'Status Tes'
        );

        $this->db->select(self::TABLE_PESERTA.'.*,'.$client->selectedColumn.','.$clientbatch->selectedColumn.', users.username')
            ->from(self::TABLE_PESERTA)
            ->join(self::TABLE_CLIENT_BATCH, self::TABLE_CLIENT_BATCH.'.ID = '.self::TABLE_PESERTA.'.BatchID')
            ->join(self::TABLE_CLIENT, self::TABLE_CLIENT.'.ID = '.self::TABLE_CLIENT_BATCH.'.ClientID')
            ->join('users', 'users.id = '.self::TABLE_PESERTA.'.AdminAssignment', 'LEFT OUTER');

        return $this->return_data_filtered($page, $pageSize, $filterColumn, $filterValue, $filterOperator, $sortBy, $sortOrder, $fieldList, $fieldList);
    }

    public function get_data_current_user($userid)
    {
        $client = new Clientmodel;
        $clientbatch = new Clientbatchmodel;
        $this->db->select(self::TABLE_PESERTA.'.*,'.$client->selectedColumn.','.$clientbatch->selectedColumn.', users.username')
            ->from(self::TABLE_PESERTA)
            ->join(self::TABLE_CLIENT_BATCH, self::TABLE_CLIENT_BATCH.'.ID = '.self::TABLE_PESERTA.'.BatchID')
            ->join(self::TABLE_CLIENT, self::TABLE_CLIENT.'.ID = '.self::TABLE_CLIENT_BATCH.'.ClientID')
            ->join('users', 'users.id = '.self::TABLE_PESERTA.'.AdminAssignment', 'LEFT OUTER')
            ->order_by(self::TABLE_CLIENT_BATCH.'.ClientID','ASC')
            ->order_by(self::TABLE_PESERTA.'.BatchID','ASC')
            ->order_by(self::TABLE_PESERTA.'.ID','ASC')
            ->where(self::TABLE_PESERTA.'.AdminAssignment', $userid);
        //var_dump($this->db->get_compiled_select());
        return $this->db->get()->result_object();
    }

    public function get_data_byid($id)
    {
        $client = new Clientmodel;
        $clientbatch = new Clientbatchmodel;
        $this->db->select(self::TABLE_PESERTA.'.*,'.$client->selectedColumn.','.$clientbatch->selectedColumn)
            ->from(self::TABLE_PESERTA)
            ->join(self::TABLE_CLIENT_BATCH, self::TABLE_CLIENT_BATCH.'.ID = '.self::TABLE_PESERTA.'.BatchID')
            ->join(self::TABLE_CLIENT, self::TABLE_CLIENT.'.ID = '.self::TABLE_CLIENT_BATCH.'.ClientID')
            ->where(self::TABLE_PESERTA.'.ID', $id);

        return $this->db->get()->row_object();
    }

    public function get_data_pesertaonly_byid($id)
    {
        $this->db->select(self::TABLE_PESERTA.'.*')
            ->from(self::TABLE_PESERTA)
            ->where(self::TABLE_PESERTA.'.ID', $id);

        return $this->db->get()->row_object();
    }

    public function get_data_bytoken($token)
    {
        $client = new Clientmodel;
        $clientbatch = new Clientbatchmodel;
        $this->db->select(self::TABLE_PESERTA.'.*,'.$client->selectedColumn.','.$clientbatch->selectedColumn)
            ->from(self::TABLE_PESERTA)
            ->join(self::TABLE_CLIENT_BATCH, self::TABLE_CLIENT_BATCH.'.ID = '.self::TABLE_PESERTA.'.BatchID')
            ->join(self::TABLE_CLIENT, self::TABLE_CLIENT.'.ID = '.self::TABLE_CLIENT_BATCH.'.ClientID')
            ->where(self::TABLE_PESERTA.'.Token', $token);

        return $this->db->get()->row_object();
    }

    public function get_jumlah_peserta_bybatch($clientBatchID){
        $query = $this->db->select('*')
            ->from(self::TABLE_PESERTA)
            ->where('BatchID', $clientBatchID);

        return $query->get()->num_rows();
    }

    public function get_peserta_by_batchid($batchID) {
        $this->db->select("*")
            ->from(self::TABLE_PESERTA)
            ->where("BatchID", $batchID);

        return $this->db->get()->result_object();
    }

    public function create_data_peserta($object){
        $generatedToken = random_string('alnum',20);

        $this->db->set('BatchID', $object->BatchID);
        $this->db->set('Token', $generatedToken);
        $this->db->set('TokenGenerateDate', date('Y-m-d H:i:s'));
        $this->db->set('NamaPeserta', $object->NamaPeserta);
        $this->db->set('Email', $object->Email);
        $this->db->set('Handphone', $object->Handphone);
        $this->db->set('JenisKelamin', $object->JenisKelamin);
        $this->db->set('Usia', $object->Usia);
        $this->db->set('JabatanPekerjaan', $object->JabatanPekerjaan);
        $this->db->set('BidangPekerjaan', $object->BidangPekerjaan);
        $this->db->set('PernyataanID', $this->defaultPernyataanID);
        $this->db->set('Jawaban', $this->defaultAnswer);
        $this->db->set('TestDate', date('Y-m-d'));
        $this->db->set('TestStatus', $this->defaultTestStatus);
        $this->db->set('TestDuration', $this->defaultTestDuration);
        $this->db->set('CreatedDate', date('Y-m-d H:i:s'));

        //var_dump($this->db->get_compiled_insert(self::TABLE_PESERTA));
        if($this->db->insert(self::TABLE_PESERTA)){
            return $this->get_data_bytoken($generatedToken);
        }else{
            show_error("Terjadi kesalahan pada simpan data");
            return NULL;
        }
    }

    public function update_data_peserta($object){
        //$this->db->set('LastModifiedDate', date('Y-m-d H:i:s'));
        $object->LastModifiedDate = date('Y-m-d H:i:s');
        $this->db->where('ID', $object->ID);
        if($this->db->update(self::TABLE_PESERTA, $object)){
            return TRUE;
        }else{
            $this->session->set_flashdata('message', 'Terjadi kesalahan saat penyimpanan data.');
            $this->session->set_flashdata('message_type', 'danger');
            return FALSE;
        }
    }

    public function update_data_jawaban_peserta($id, $object){
        $this->db->set('Jawaban', $object->Jawaban);
        $this->db->set('TestDuration', $object->TestDuration);
        $this->db->set('TestStatus', $object->TestStatus);
        $this->db->set('LastModifiedDate', date('Y-m-d H:i:s'));
        $this->db->where('ID', $id);
        if($this->db->update(self::TABLE_PESERTA)){
            return TRUE;
        }else{
            show_error("Terjadi kesalahan pada simpan data");
            return FALSE;
        }
    }

    public function update_data_email_peserta($id){
        $this->db->set('EmailSent', true);
        $this->db->set('LastModifiedDate', date('Y-m-d H:i:s'));
        $this->db->where('ID', $id);
        if($this->db->update(self::TABLE_PESERTA)){
            return TRUE;
        }else{
            show_error("Terjadi kesalahan pada simpan data");
            return FALSE;
        }
    }

    public function get_jmlpeserta_by_batchid($batchID) {
        $this->db->from(self::TABLE_PESERTA)
            ->where("BatchID", $batchID);

        return $this->db->count_all_results();
    }

    public function get_peserta_by_pesertatoken($token) {
        $this->db->select('*')
            ->from(self::TABLE_PESERTA)
            ->where("Token", $token)
            ->limit(1);

        return $this->db->get()->row_object();
    }

    public function get_page_test($jawaban){
        $jawabanExplode = explode(",", $jawaban);
        $returnPage = 0;

        for($i = 0; $i < count($jawabanExplode); $i++){
            if($jawabanExplode[$i] == ''){
                $returnPage = ($i / 3) + 1;
                break;
            }
        }

        return $returnPage;
    }

    public function validasi_token($token) {
        $this->db->select('*')
            ->from(self::TABLE_PESERTA)
            ->where('Token', $token)
            ->limit(1);

        return $this->db->get()->row_object();
    }

    public function send_email_peserta($pesertaID){
        $this->load->library('email');

        $getPeserta = $this->get_data_byid($pesertaID);
        $tokenDateExpired = new DateTime($getPeserta->TestDate);
        $tokenDateExpired->add(new DateInterval('P6M'));
        $data['getPeserta'] = $getPeserta;
        $html = $this->load->view("peserta/email-profile", $data, TRUE);

        $this->email->from($this->config->item("adminEmail"), $this->config->item("nameEmail"));
        $this->email->to($getPeserta->Email);
        $this->email->bcc($this->config->item("adminEmail"));
        $this->email->subject('Data Peserta Profiling Qualita');
        $this->email->message($html);

        if($this->email->send(FALSE)){
			$this->logging->email_sent($getPeserta->NamaPeserta, $getPeserta->Email, "Data Peserta | Success");
            return TRUE;
		}else{
		    $this->logging->email_sent($getPeserta->NamaPeserta, $getPeserta->Email, "Data Peserta | Gagal", $this->email->print_debugger());
		    return FALSE;
		}
    }
}
?>
