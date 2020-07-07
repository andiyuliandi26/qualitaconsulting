<?php

class Clientmodel extends Basemodel{    
    const table = 'md_client';
    //array('KodeClient', 'NamaClient', 'Alamat', 'Kategori')
    //public $selectedColumn = $this->generate_column_selected('est', array("KodeClient", "NamaClient", "Alamat", "Kategori"));

    public function get_data()
    {
        $tst = $this->generate_column_selected(self::table, array("KodeClient", "NamaClient", "Alamat", "Kategori"));
        $big5 = new Big5Model;
        $this->db->select('md_facet.*,'.$big5->selectedColumn);
        $this->db->from('md_facet');
        $this->db->join('md_big5', 'md_facet.Big5ID = md_big5.ID');
        
        $query = $this->db->get();
        return $query->result_object();
    }
}

?>