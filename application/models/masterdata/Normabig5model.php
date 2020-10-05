<?php

class Normabig5model extends Basemodel{    

    public function get_data()
    {
        $big5 = new Big5Model;
        $this->db->select(self::TABLE_NORMA_BIG5.'.*,'.$big5->selectedColumn)
            ->from(self::TABLE_NORMA_BIG5)
            ->join(self::TABLE_BIG5, self::TABLE_NORMA_BIG5.'.Big5ID = '.self::TABLE_BIG5.'.ID');

        return $this->db->get()->result_object();
    }

    public function get_data_byfilterpage($page, $pageSize, $filterColumn, $filterValue, $filterOperator, $sortBy, $sortOrder)
    {
        $big5 = new Big5Model;
        $returnValue = new Basemodel;
        $fieldList = (object)array(
            self::TABLE_BIG5.".Nama" => 'Nama Domain',
            "JenisKelamin" => 'Jenis Kelamin'
        );
        
        $currentPageforLimit = ($page - 1) * $pageSize;
        
        $this->db->select(self::TABLE_NORMA_BIG5.'.*,'.$big5->selectedColumn)
            ->from(self::TABLE_NORMA_BIG5)
            ->join(self::TABLE_BIG5, self::TABLE_NORMA_BIG5.'.Big5ID = '.self::TABLE_BIG5.'.ID');

            return $this->return_data_filtered($page, $pageSize, $filterColumn, $filterValue, $filterOperator, $sortBy, $sortOrder, $fieldList, $fieldList);
    }

    public function get_data_byid($id)
    {
        $big5 = new Big5Model;
        $this->db->select(self::TABLE_NORMA_BIG5.'.*,'.$big5->selectedColumn)
            ->from(self::TABLE_NORMA_BIG5)
            ->join(self::TABLE_BIG5, self::TABLE_NORMA_BIG5.'.Big5ID = '.self::TABLE_BIG5.'.ID')
            ->where(self::TABLE_NORMA_BIG5.".ID = {$id}");

        return $this->db->get()->row_object();
    }

    public function update_data($id){
        $data = array(
            'BatasBawah' => $this->input->post('BatasBawah'),
            'BatasAtas' => $this->input->post('BatasAtas'),
            'Definisi' => $this->input->post('Definisi')
        );
        
        $this->db->where('ID', $id);

        if($this->db->update(self::TABLE_NORMA_BIG5, $data)){
            return true;
        }else{
            show_error("Terjadi kesalahan pada simpan data");
            var_dump("test");
            return false;
        }
    }
}


?>