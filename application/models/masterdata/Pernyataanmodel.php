<?php

class Pernyataanmodel extends BaseModel{

    public function get_data()
    {
        $this->db->select(self::TABLE_PERNYATAAN.'.*, '.self::TABLE_BIG5.'.Nama as Big5Desc, '.self::TABLE_FACET.'.Nama as FacetDesc')
                ->from(self::TABLE_PERNYATAAN)
                ->join(self::TABLE_BIG5, self::TABLE_PERNYATAAN.'.Big5ID = '.self::TABLE_BIG5.'.ID')
                ->join(self::TABLE_FACET, self::TABLE_PERNYATAAN.'.FacetID = '.self::TABLE_FACET.'.ID')
                ->order_by('Sequence');

        return $this->db->get()->result_object();
    }

    public function get_data_byid($id)
    {
        $this->db->select(self::TABLE_PERNYATAAN.'.*, '.self::TABLE_BIG5.'.Nama as Big5Desc, '.self::TABLE_BIG5.'.Nama as FacetDesc')
                ->from(self::TABLE_PERNYATAAN)
                ->join(self::TABLE_BIG5, self::TABLE_PERNYATAAN.'.Big5ID = '.self::TABLE_BIG5.'.ID')
                ->join(self::TABLE_FACET, self::TABLE_PERNYATAAN.'.FacetID = '.self::TABLE_FACET.'.ID')
                ->where(self::TABLE_PERNYATAAN.".ID = {$id}");

        return $this->db->get()->row_object();
    }

    public function update_data($id){
        $data = array(
            'Sequence' => $this->input->post('Sequence'),
            'Redaksi' => $this->input->post('Redaksi'),
            'Score1' => $this->input->post('Score1'),
            'Score2' => $this->input->post('Score2'),
            'Score3' => $this->input->post('Score3'),
            'Score4' => $this->input->post('Score4'),
            'Score5' => $this->input->post('Score5')
        );
        
        $this->db->where('ID', $id);
        
        if($this->db->update(self::TABLE_PERNYATAAN, $data)){
            return true;
        }else{
            show_error("Terjadi kesalahan pada simpan data");
            var_dump("test");
            return false;
        }
    }
}
?>