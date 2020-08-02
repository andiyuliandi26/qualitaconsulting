<?php

class Style_parametermodel extends Basemodel{
    public $selectedColumn = self::TABLE_STYLE_PARAMETER.".Style as StyleDesc, Big5LeftID, Big5RightID";

    public function get_data()
    {
        $this->db->select(self::TABLE_STYLE_PARAMETER.'.*, big5left.Kode as Big5LeftKode, big5right.Kode as Big5RightKode')
            ->from(self::TABLE_STYLE_PARAMETER)
            ->join(self::TABLE_BIG5.' as big5left', self::TABLE_STYLE_PARAMETER.'.Big5LeftID = big5left.ID')
            ->join(self::TABLE_BIG5.' as big5right', self::TABLE_STYLE_PARAMETER.'.Big5RightID = big5right.ID');
        
        return $this->db->get()->result_object();
    }

    public function get_data_byfilterpage($page, $pageSize, $filterColumn, $filterValue, $filterOperator, $sortBy, $sortOrder)
    {
        $style = new Style_parametermodel;
        $fieldList = (object)array(
            'Style' => 'Nama Style',
            'Big5LeftKode' => 'Kode Domain Kiri',
            'Big5RightKode' => 'Kode Domain Kanan'
        );
        
        $this->db->select(self::TABLE_STYLE_PARAMETER.'.*, big5left.Kode as Big5LeftKode, big5right.Kode as Big5RightKode')
            ->from(self::TABLE_STYLE_PARAMETER)
            ->join(self::TABLE_BIG5.' as big5left', self::TABLE_STYLE_PARAMETER.'.Big5LeftID = big5left.ID')
            ->join(self::TABLE_BIG5.' as big5right', self::TABLE_STYLE_PARAMETER.'.Big5RightID = big5right.ID');

        return $this->return_data_filtered($page, $pageSize, $filterColumn, $filterValue, $filterOperator, $sortBy, $sortOrder, $fieldList, $fieldList);
    }

    public function get_data_byid($id)
    {
        $this->db->select(self::TABLE_STYLE_PARAMETER.'.*, big5left.Kode as Big5LeftKode, big5right.Kode as Big5RightKode')
            ->from(self::TABLE_STYLE_PARAMETER)
            ->join(self::TABLE_BIG5.' as big5left', self::TABLE_STYLE_PARAMETER.'.Big5LeftID = big5left.ID')
            ->join(self::TABLE_BIG5.' as big5right', self::TABLE_STYLE_PARAMETER.'.Big5RightID = big5right.ID')
            ->where(self::TABLE_STYLE_PARAMETER.".ID = {$id}");

        return $this->db->get()->row_object();
    }

    public function update_data($id){
        $data = array(
            'Style' => $this->input->post('Style')
        );
        
        $this->db->where('ID', $id);

        if($this->db->update(self::TABLE_STYLE_PARAMETER, $data)){
            return true;
        }else{
            show_error("Terjadi kesalahan pada simpan data");
            return false;
        }
    }
}
?>