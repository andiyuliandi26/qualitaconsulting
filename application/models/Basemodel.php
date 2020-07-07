<?php

class Basemodel extends CI_Model{
    protected const table_big5 = 'md_big5';
    protected const table_facet = 'md_facet';
    protected const table_style_parameter = 'md_style_parameter';
    protected const table_client = 'md_client';
    protected const table_peserta = 'peserta';
    protected const table_result_big5 = 'peserta_result_big5';
    protected const table_result_facet = 'peserta_result_facet';
    protected const table_result_style = 'peserta_result_style';

    public $ID;
    public $CreatedDate;
    public $LastModifiedDate;

    public function __construct()
    {
        $this->load->database();
    }

    protected function get_all_data($table){
        $query = $this->db->get($table);
        return $query->result_object();
    }

    protected function generate_column_selected($table,array $column){
        $selectedColumn = '';

        for($i = 0; $i < array_count_values($column); $i++){
            $selectedColumn .= $table.'.'.$column[$i];
        }

        return $selectedColumn;
    }
}

?>