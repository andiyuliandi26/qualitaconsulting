<?php

class Big5model extends BaseModel{
    const table = 'md_big5';
    public $selectedColumn = "md_big5.Nama as Big5Desc, md_big5.MatriksLow, md_big5.MatriksAverage, md_big5.MatriksHigh";
    public $Nama;
    public $MatriksLow;
    public $MatriksAverage;
    public $MatriksHigh;
    public $IsActive;

    public function get_data()
    {
        return $this->get_all_data(self::table);
    }
}
?>