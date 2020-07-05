<?php

class Normastylemodel extends Basemodel{    

    const table = 'md_norma_style';

    public function get_data()
    {
        $style = new Style_parametermodel;
        $this->db->select(self::table.'.*,'.$style->selectedColumn);
        $this->db->from(self::table);
        $this->db->join('md_style_parameter', self::table.'.StyleID = md_style_parameter.ID');
        
        $query = $this->db->get();
        return $query->result_object();
    }
}


?>