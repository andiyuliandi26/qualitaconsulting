<?php

class Basemodel extends CI_Model{
    public $totalSize;
    public $totalPage;
    public $currentPage;
    public $currentPageSize;
    public $dataItems;
    public $columnFilterList;
    public $filterColumn;
    public $filterOperator;
    public $filterValue;
    public $sortBy;
    public $sortOrder;
    public $columnSortList;

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
    protected const TABLE_ADDITIONAL_REPORT = 'peserta_additional_report';

    protected const LFS_VERY_LOW = "Very Low";
    protected const LFS_LOW = "Low";
    protected const LFS_AVERAGE = "Average";
    protected const LFS_HIGH = "High";
    protected const LFS_VERY_HIGH = "Very High";
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

    protected function get_all_data_byfilterpage($table, $page, $pageSize, $filterColumn, $filterValue,$selectedColumn = '*')
    {
        $totalData = $this->db->count_all($table);
        $fieldList = $this->db->list_fields($table);
        $totalPage = round($totalData / $pageSize);

        $returnValue = new Basemodel();
        $returnValue->currentPage = $page;
        $returnValue->totalSize = $totalData;
        $returnValue->totalPage = $totalPage;
        $returnValue->columnFilterList = $fieldList;
        $returnValue->filterColumn = $filterColumn;
        $returnValue->filterValue = $filterValue;

        $this->db->select($selectedColumn);
        $this->db->from($table);

        if($filterColumn != ''){
            $this->db->like($filterColumn, $filterValue);
        }

        $this->db->limit($pageSize, $page); 

        $returnValue->dataItems = $this->db->get()->result_object();

        return $returnValue;
    }

    protected function generate_column_selected($table,array $column)
    {
        $selectedColumn = '';

        for($i = 0; $i < array_count_values($column); $i++){
            $selectedColumn .= $table.'.'.$column[$i];
        }

        return $selectedColumn;
    }
    
    protected function _array_group_by($arr, $fldName) {
        $groups = array();
        foreach ($arr as $rec) {
            $groups[$rec[$fldName]] = $rec;
        }
        return $groups;
    }

    protected function return_data_filtered($page, $pageSize, $filterColumn, $filterValue, $filterOperator, $sortBy, $sortOrder, $filterColumnList, $sortColumnList){        
        $returnValue = new Basemodel;
        $currentPageforLimit = ($page - 1) * $pageSize;

        if($filterColumn != '' && $filterValue != '' && $filterOperator != ''){
            switch($filterOperator){
                case "Equal":
                    $this->db->where($filterColumn, $filterValue);
                    break; 
                case "NotEqual":
                    $this->db->where($filterColumn.' !=', $filterValue);
                    break; 
                case "Like":
                    $this->db->like($filterColumn, $filterValue);
                    break; 
                case "NotLike":
                    $this->db->not_like($filterColumn, $filterValue);
                    break; 
            }
        }

        if($sortBy != '' && $sortOrder != ''){
            $this->db->order_by($sortBy,$sortOrder);
        }else{
            $this->db->order_by('ID','DESC');
        }
        //Get query result
        $query = $this->db->get()->result_object();
        
        //var_dump($this->db->last_query());
        $totalData = count($query);
        $totalPage = ceil($totalData / $pageSize);

        //$this->db->limit($pageSize, $currentPageforLimit); 

        $returnValue->currentPage = ($totalData > 0) ? $page : 1;
        $returnValue->currentPageSize = $pageSize;
        $returnValue->totalSize = $totalData;
        $returnValue->totalPage = ($totalData > 0) ? $totalPage : 1;
        $returnValue->columnFilterList = $filterColumnList;
        $returnValue->filterColumn = $filterColumn;
        $returnValue->filterOperator = $filterOperator;        
        $returnValue->filterValue = $filterValue;
        $returnValue->sortBy = $sortBy;
        $returnValue->sortOrder = $sortOrder;
        $returnValue->columnSortList = $sortColumnList;
        $returnValue->dataItems = array_slice($query,$currentPageforLimit, $pageSize);

        return $returnValue;
    }
}

?>