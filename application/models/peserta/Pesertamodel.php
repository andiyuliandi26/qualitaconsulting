<?php

class Pesertamodel extends Basemodel{
    public $selectedColumn = "md_big5.Nama as Big5Desc, md_big5.MatriksLow, md_big5.MatriksAverage, md_big5.MatriksHigh";

    public function get_data()
    {
        return $this->get_all_data(self::table_peserta);
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