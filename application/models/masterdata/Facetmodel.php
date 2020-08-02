<?php

class Facetmodel extends Basemodel{    

    public $selectedColumn = self::TABLE_FACET.".Nama as FacetDesc, ".self::TABLE_FACET.".RedaksiLow, ".self::TABLE_FACET.".RedaksiAverage, ".self::TABLE_FACET.".RedaksiHigh";
    public function get_data()
    {
        $big5 = new Big5Model;
        $this->db->select(self::TABLE_FACET.'.*,'.$big5->selectedColumn)
                ->from(self::TABLE_FACET)
                ->join(self::TABLE_BIG5, self::TABLE_FACET.".Big5ID = ".self::TABLE_BIG5.".ID");

        return $this->db->get()->result_object();
    }

    public function get_data_byfilterpage($page, $pageSize, $filterColumn, $filterValue, $filterOperator, $sortBy, $sortOrder)
    {
        $big5 = new Big5Model;
        $fieldList = (object)array(
            self::TABLE_FACET.".Nama" => 'Nama Facet', 
            self::TABLE_BIG5.".Nama" => 'Nama Domain'
        );
        
        $this->db->select(self::TABLE_FACET.'.*,'.$big5->selectedColumn)
                ->from(self::TABLE_FACET)
                ->join(self::TABLE_BIG5, self::TABLE_FACET.".Big5ID = ".self::TABLE_BIG5.".ID");

        return $this->return_data_filtered($page, $pageSize, $filterColumn, $filterValue, $filterOperator, $sortBy, $sortOrder, $fieldList, $fieldList);
    }

    public function get_data_byid($id)
    {
        $big5 = new Big5Model;
        $this->db->select(self::TABLE_FACET.'.*,'.$big5->selectedColumn)
            ->from(self::TABLE_FACET)
            ->join(self::TABLE_BIG5, self::TABLE_FACET.".Big5ID = ".self::TABLE_BIG5.".ID")
            ->where(self::TABLE_FACET.".ID = {$id}");

        return $this->db->get()->row_object();
    }

    public function update_data($id){
        $data = array(
            'Nama' => $this->input->post('Nama'),
            'RedaksiAwal' => $this->input->post('RedaksiAwal'),
            'RedaksiLow' => $this->input->post('RedaksiLow'),
            'RedaksiAverage' => $this->input->post('RedaksiAverage'),
            'RedaksiHigh' => $this->input->post('RedaksiHigh'),
        );
        
        $this->db->where('ID', $id);

        if($this->db->update(self::TABLE_FACET, $data)){
            return true;
        }else{
            show_error("Terjadi kesalahan pada simpan data");
            return false;
        }
    }
}

?>