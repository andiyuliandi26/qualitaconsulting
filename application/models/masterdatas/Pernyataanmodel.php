<?php

class Pernyataanmodel extends BaseModel{
    const table = 'md_pernyataan';
    public $selectedColumn = "md_big5.Nama as Big5Desc, md_big5.MatriksLow, md_big5.MatriksAverage, md_big5.MatriksHigh";

    public function get_data()
    {
        $this->db->select(self::table.'.*, md_big5.Nama as Big5Desc, md_facet.Nama as FacetDesc');
        $this->db->from(self::table);
        $this->db->join('md_big5', self::table.'.Big5ID = md_big5.ID');
        $this->db->join('md_facet', self::table.'.FacetID = md_facet.ID');
        $this->db->order_by('Sequence');
        $query = $this->db->get();
        return $query->result_object();
    }
}
?>