<?php

class Style_parametermodel extends BaseModel{
    const table = 'md_style_parameter';
    public $selectedColumn = "md_style_parameter.Style as StyleDesc";
    public $Nama;
    public $MatriksLow;
    public $MatriksAverage;
    public $MatriksHigh;
    public $IsActive;

    public function get_data()
    {
        $big5 = new Big5Model;
        $this->db->select(self::table.'.*, big5left.Kode as Big5LeftKode, big5right.Kode as Big5RightKode');
        $this->db->from(self::table);
        $this->db->join('md_big5 as big5left', self::table.'.Big5LeftID = big5left.ID');
        $this->db->join('md_big5 as big5right', self::table.'.Big5RightID = big5right.ID');
        
        $query = $this->db->get();
        return $query->result_object();
    }
}
?>