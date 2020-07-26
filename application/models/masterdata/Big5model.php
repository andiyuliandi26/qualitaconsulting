<?php

class Big5model extends Basemodel{
    public $selectedColumn = self::TABLE_BIG5.".Nama as Big5Desc, ".self::TABLE_BIG5.".MatriksLow, ".self::TABLE_BIG5.".MatriksAverage, ".self::TABLE_BIG5.".MatriksHigh";

    public function get_data()
    {
        return $this->get_all_data(self::TABLE_BIG5);
    }

    public function get_data_byid($id)
    {
        $this->db->select(self::TABLE_BIG5.'.*')
            ->from(self::TABLE_BIG5)
            ->where(self::TABLE_BIG5.".ID = {$id}");

        return $this->db->get()->row_object();
    }

    public function update_data($id){
        $data = array(
            'Nama' => $this->input->post('Nama'),
            'Kode' => $this->input->post('Kode'),
            'MatriksLow' => $this->input->post('MatriksLow'),
            'MatriksAverage' => $this->input->post('MatriksAverage'),
            'MatriksHigh' => $this->input->post('MatriksHigh'),
            'RedaksiLow' => $this->input->post('RedaksiLow'),
            'RedaksiAverage' => $this->input->post('RedaksiAverage'),
            'RedaksiHigh' => $this->input->post('RedaksiHigh'),
        );
        
        $this->db->where('ID', $id);

        if($this->db->update(self::TABLE_BIG5, $data)){
            return true;
        }else{
            show_error("Terjadi kesalahan pada simpan data");
            return false;
        }
    }
}
?>