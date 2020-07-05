<?php

class Basemodel extends CI_Model{
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
}

?>