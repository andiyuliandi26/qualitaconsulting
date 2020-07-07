<?php

class Pesertamodel extends Basemodel{
    public $selectedColumn = "md_big5.Nama as Big5Desc, md_big5.MatriksLow, md_big5.MatriksAverage, md_big5.MatriksHigh";

    public function get_data()
    {
        return $this->get_all_data(self::table_peserta);
    }
}
?>