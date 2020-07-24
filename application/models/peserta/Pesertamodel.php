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
}
?>