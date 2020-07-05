<?php

class Normafacetmodel extends Basemodel{    

    const table = 'md_norma_facet';

    public function get_data()
    {
        $facet= new Facetmodel;
        $this->db->select(self::table.'.*,'.$facet->selectedColumn);
        $this->db->from(self::table);
        $this->db->join('md_facet', self::table.'.FacetID = md_facet.ID');
        
        $query = $this->db->get();
        return $query->result_object();
    }
}


?>