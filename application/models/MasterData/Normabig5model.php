<?php

class Normabig5model extends Basemodel{    

    const table = 'md_norma_big5';

    public function get_data()
    {
        $big5 = new Big5Model;
        $this->db->select(self::table.'.*,'.$big5->selectedColumn);
        $this->db->from(self::table);
        $this->db->join('md_big5', self::table.'.Big5ID = md_big5.ID');
        
        $query = $this->db->get();
        return $query->result_object();
    }
}


?>