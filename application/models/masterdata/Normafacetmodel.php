<?php

class Normafacetmodel extends Basemodel{    

    public function get_data()
    {
        $facet = new Facetmodel;
        $this->db->select(self::TABLE_NORMA_FACET.'.*,'.$facet->selectedColumn)
            ->from(self::TABLE_NORMA_FACET)
            ->join(self::TABLE_FACET, self::TABLE_NORMA_FACET.'.FacetID = '.self::TABLE_FACET.'.ID');

        return $this->db->get()->result_object();
    }

    public function get_data_byfilterpage($page, $pageSize, $filterColumn, $filterValue, $filterOperator, $sortBy, $sortOrder)
    {
        $facet = new Facetmodel;
        $fieldList = (object)array(
            self::TABLE_FACET.'.Nama' => 'Nama Facet',
            'JenisKelamin' => 'Jenis Kelamin'
        );

        $this->db->select(self::TABLE_NORMA_FACET.'.*,'.$facet->selectedColumn)
            ->from(self::TABLE_NORMA_FACET)
            ->join(self::TABLE_FACET, self::TABLE_NORMA_FACET.'.FacetID = '.self::TABLE_FACET.'.ID');

        return $this->return_data_filtered($page, $pageSize, $filterColumn, $filterValue, $filterOperator, $sortBy, $sortOrder, $fieldList, $fieldList);
    }

    public function get_data_byid($id)
    {
        $facet = new Facetmodel;
        $this->db->select(self::TABLE_NORMA_FACET.'.*,'.$facet->selectedColumn)
            ->from(self::TABLE_NORMA_FACET)
            ->join(self::TABLE_FACET, self::TABLE_NORMA_FACET.'.FacetID = '.self::TABLE_FACET.'.ID')
            ->where(self::TABLE_NORMA_FACET.".ID = {$id}");

        return $this->db->get()->row_object();
    }

    public function update_data($id){
        $data = array(
            'BatasBawah' => $this->input->post('BatasBawah'),
            'BatasAtas' => $this->input->post('BatasAtas')
        );
        
        $this->db->where('ID', $id);

        if($this->db->update(self::TABLE_NORMA_FACET, $data)){
            return true;
        }else{
            show_error("Terjadi kesalahan pada simpan data");
            var_dump("test");
            return false;
        }
    }
}


?>