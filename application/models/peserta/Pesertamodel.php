<?php

class Pesertamodel extends Basemodel{
    public $selectedColumn = self::TABLE_PESERTA.'.NamaPeserta';
    public function get_data()
    {
        $client = new Clientmodel;
        $clientbatch = new Clientbatchmodel;
        $this->db->select(self::TABLE_PESERTA.'.*,'.$client->selectedColumn.','.$clientbatch->selectedColumn)
            ->from(self::TABLE_PESERTA)
            ->join(self::TABLE_CLIENT_BATCH, self::TABLE_CLIENT_BATCH.'.ID = '.self::TABLE_PESERTA.'.BatchID')
            ->join(self::TABLE_CLIENT, self::TABLE_CLIENT.'.ID = '.self::TABLE_CLIENT_BATCH.'.ClientID')
            ->order_by(self::TABLE_CLIENT_BATCH.'.ClientID','ASC')
            ->order_by(self::TABLE_PESERTA.'.BatchID','ASC')
            ->order_by(self::TABLE_PESERTA.'.ID','ASC');

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

    public function get_peserta_by_batchid($batchID) {
        $this->db->select("*")
            ->from(self::TABLE_PESERTA)
            ->where("BatchID", $batchID);
        
        return $this->db->get()->result_object();
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
}
?>