<?php

class Basemodel extends CI_Model{
    #region Constanta    
    protected const JWT_SECRET = "qualitaconsulting";
    protected $link_test;
    protected const TABLE_BIG5 = 'md_big5';
    protected const TABLE_FACET = 'md_facet';
    protected const TABLE_STYLE_PARAMETER = 'md_style_parameter';
    protected const TABLE_CLIENT = 'md_client';
    protected const TABLE_CLIENT_BATCH = 'client_batch';
    protected const TABLE_NORMA_BIG5 = 'md_norma_big5';
    protected const TABLE_NORMA_FACET = 'md_norma_facet';
    protected const TABLE_NORMA_STYLE = 'md_norma_style';
    protected const TABLE_PERNYATAAN = 'md_pernyataan';
    protected const TABLE_PESERTA_ANSWER = 'peserta_answer';
    protected const TABLE_PESERTA = 'peserta';
    protected const TABLE_RESULT_BIG5 = 'peserta_result_big5';
    protected const TABLE_RESULT_FACET = 'peserta_result_facet';
    protected const TABLE_RESULT_STYLE = 'peserta_result_style';
    protected const TABLE_RESULT_ADDITIONAL = 'peserta_result_additional';
    #endregion

    #region Attributes    
    public $ID;
    public $CreatedDate;
    public $LastModifiedDate;
    #endregion

    public function __construct()
    {
        $this->link_test = $this->config->item('base_url')."/starttest?token=";
        $this->load->database();
        $this->load->helper('string');
    }

    protected function get_all_data($table)
    {
        $query = $this->db->get($table);
        return $query->result_object();
    }

    protected function generate_column_selected($table,array $column)
    {
        $selectedColumn = '';

        for($i = 0; $i < array_count_values($column); $i++){
            $selectedColumn .= $table.'.'.$column[$i];
        }

        return $selectedColumn;
    }
}

?>