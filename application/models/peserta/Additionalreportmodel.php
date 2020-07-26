<?php

class Additionalreportmodel extends Basemodel{

    public function get_data($pesertaID)
    {
        $peserta = new Pesertamodel;
        $this->db->select(self::TABLE_ADDITIONAL_REPORT.'.*,'.$peserta->selectedColumn)
            ->from(self::TABLE_ADDITIONAL_REPORT)
            ->join(self::TABLE_PESERTA, self::TABLE_PESERTA.'.ID = '.self::TABLE_ADDITIONAL_REPORT.'.PesertaID')
            ->where(self::TABLE_PESERTA.'.ID', $pesertaID)
            ->order_by(self::TABLE_ADDITIONAL_REPORT.'.ID','ASC');

        return $this->db->get()->result_object();
    }

    public function get_data_byid($id)
    {
        $peserta = new Pesertamodel;
        $this->db->select(self::TABLE_ADDITIONAL_REPORT.'.*,'.$peserta->selectedColumn)
            ->from(self::TABLE_ADDITIONAL_REPORT)
            ->join(self::TABLE_PESERTA, self::TABLE_PESERTA.'.ID = '.self::TABLE_ADDITIONAL_REPORT.'.PesertaID')
            ->where(self::TABLE_ADDITIONAL_REPORT.'.ID', $id)
            ->order_by(self::TABLE_ADDITIONAL_REPORT.'.ID','ASC');

        return $this->db->get()->row_object();
    }

    public function create_data($pesertaID, $item, $itemDescription){
        $this->load->helper('url');

        $data = array(
            'PesertaID' => $pesertaID,
            'Item' => $item,
            'ItemDescription' => $itemDescription,
        );

        if($this->db->insert(self::TABLE_ADDITIONAL_REPORT, $data)){
            return TRUE;
        }else{
            show_error("Terjadi kesalahan pada simpan data");
            return FALSE;
        }
    }

    public function update_data($id, $item, $itemDescription){
        $this->load->helper('url');

        $data = array(
            'Item' => $item,
            'ItemDescription' => $itemDescription,
        );
        
        $this->db->where('ID', $id);
        if($this->db->update(self::TABLE_ADDITIONAL_REPORT, $data)){
            return TRUE;
        }else{
            show_error("Terjadi kesalahan pada simpan data");
            return FALSE;
        }
    }

    public function delete_data($id){
        $this->load->helper('url');
        
        $this->db->where('ID', $id);
        if($this->db->delete(self::TABLE_ADDITIONAL_REPORT)){
            return TRUE;
        }else{
            show_error("Terjadi kesalahan pada simpan data");
            return FALSE;
        }
    }
}
?>