<?php

class Clientbatchmodel extends Basemodel{
    #region Attributes
    public $Client; 
    public $ClientID;
    public $NamaBatch;
    public $TanggalTest;
    public $JamAwalTest;
    public $JamAkhirTest;
    public $TotalPeserta;
    public $DurasiTest;
    public $Token;
    public $LinkTest;
    public $selectedColumn = self::TABLE_CLIENT_BATCH.'.ClientID,'.self::TABLE_CLIENT_BATCH.'.NamaBatch,';
    #endregion

    public function get_data(){
        $this->db->select(self::TABLE_CLIENT_BATCH.'.*, '.self::TABLE_CLIENT.'.NamaClient')
            ->from(self::TABLE_CLIENT_BATCH)
            ->join(self::TABLE_CLIENT, self::TABLE_CLIENT.'.ID = '.self::TABLE_CLIENT_BATCH.'.ClientID');

        return $this->db->get()->result_object();
    }

    public function get_data_byid($id)
    {
        $this->db->select(self::TABLE_CLIENT_BATCH.'.*, '.self::TABLE_CLIENT.'.NamaClient')
            ->from(self::TABLE_CLIENT_BATCH)
            ->join(self::TABLE_CLIENT, self::TABLE_CLIENT.'.ID = '.self::TABLE_CLIENT_BATCH.'.ClientID')
            ->where(self::TABLE_CLIENT_BATCH.".ID = {$id}");

        return $this->db->get()->row_object();
    }

    public function check_namabatch_data($clientID, $namaBatch, $id)
    {
        $this->db->select('*')
            ->from(self::TABLE_CLIENT_BATCH)
            ->where("ClientID = {$clientID} AND NamaBatch = '{$namaBatch}' AND ID != {$id}");

        $num_rows = $this->db->get()->num_rows();
        if($num_rows > 0){
            return FALSE;
        }else{
            return TRUE;
        }
    }

    public function check_token_data($clientID, $token, $id)
    {
        $this->db->select('*')
            ->from(self::TABLE_CLIENT_BATCH)
            ->where("ClientID = {$clientID} AND Token = '{$token}' AND ID != {$id}");

        $num_rows = $this->db->get()->num_rows();
        if($num_rows > 0){
            return FALSE;
        }else{
            return TRUE;
        }
    }

    public function create_data(){
        $this->load->helper('url');

        $data = array(
            'ClientID' => $this->input->post('ClientID'),
            'NamaBatch' => $this->input->post('NamaBatch'),
            'TanggalTest' => $this->input->post('TanggalTest'),
            'JamAwalTest' => $this->input->post('JamAwalTest'),
            'JamAkhirTest' => $this->input->post('JamAkhirTest'),
            'TotalPeserta' => $this->input->post('TotalPeserta'),
            'DurasiTest' => $this->input->post('DurasiTest'),
            'Token' => $this->input->post('Token')
        );

        //$generateToken = JWT::encode($data, self::JWT_SECRET);

        // $data += [
        //     'TanggalTest' => $this->input->post('TanggalTest'),
        //     'JamAwalTest' => $this->input->post('JamAwalTest'),
        //     'JamAkhirTest' => $this->input->post('JamAkhirTest'),
        //     'TotalPeserta' => $this->input->post('TotalPeserta'),
        //     'DurasiTest' => $this->input->post('DurasiTest'),
        //     'Token' => $this->input->post('Token'), 
        //     'LinkTest' => $this->link_test.$this->input->post('Token')
        // ];

        if($this->db->insert(self::TABLE_CLIENT_BATCH, $data)){
            return true;
        }else{
            show_error("Terjadi kesalahan pada simpan data");
            return false;
        }
    }

    public function update_data($id){
        $this->load->helper('url');

        $data = array(
            'ClientID' => $this->input->post('ClientID'),
            'NamaBatch' => $this->input->post('NamaBatch'),
            'TanggalTest' => $this->input->post('TanggalTest'),
            'JamAwalTest' => $this->input->post('JamAwalTest'),
            'JamAkhirTest' => $this->input->post('JamAkhirTest'),
            'TotalPeserta' => $this->input->post('TotalPeserta'),
            'DurasiTest' => $this->input->post('DurasiTest'),
            'Token' => $this->input->post('Token')
        );

        // $generateToken = JWT::encode($data, self::JWT_SECRET);

        // $data += [
        //     'TanggalTest' => $this->input->post('TanggalTest'),
        //     'JamAwalTest' => $this->input->post('JamAwalTest'),
        //     'JamAkhirTest' => $this->input->post('JamAkhirTest'),
        //     'TotalPeserta' => $this->input->post('TotalPeserta'),
        //     'DurasiTest' => $this->input->post('DurasiTest'),
        //     'Token' => $generateToken, 
        //     'LinkTest' => $this->link_test.$generateToken
        // ];
        
        $this->db->where('ID', $id);
        if($this->db->update(self::TABLE_CLIENT_BATCH, $data)){
            return true;
        }else{
            show_error("Terjadi kesalahan pada simpan data");
            return false;
        }
    }

    public function validasi_token($token) {
        $this->db->select('*')
            ->from(self::TABLE_CLIENT_BATCH)
            ->where('Token', $token)
            ->limit(1);
        
        return $this->db->get()->row_object();
    }
}

?>