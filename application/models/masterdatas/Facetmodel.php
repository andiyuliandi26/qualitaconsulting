<?php

class Facetmodel extends Basemodel{    

    public $selectedColumn = 'md_facet.Nama as FacetDesc, md_facet.RedaksiLow, md_facet.RedaksiAverage, md_facet.RedaksiHigh';
    public function get_data()
    {
        $big5 = new Big5Model;
        $this->db->select('md_facet.*,'.$big5->selectedColumn);
        $this->db->from('md_facet');
        $this->db->join('md_big5', 'md_facet.Big5ID = md_big5.ID');
        
        $query = $this->db->get();
        return $query->result_object();
    }
}

?>