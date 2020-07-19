<?php

class Style_parametermodel extends Basemodel{
    public $selectedColumn = self::TABLE_STYLE_PARAMETER.".Style as StyleDesc";

    public function get_data()
    {
        $this->db->select(self::TABLE_STYLE_PARAMETER.'.*, big5left.Kode as Big5LeftKode, big5right.Kode as Big5RightKode');
        $this->db->from(self::TABLE_STYLE_PARAMETER);
        $this->db->join(self::TABLE_BIG5.' as big5left', self::TABLE_STYLE_PARAMETER.'.Big5LeftID = big5left.ID');
        $this->db->join(self::TABLE_BIG5.' as big5right', self::TABLE_STYLE_PARAMETER.'.Big5RightID = big5right.ID');
        
        return $this->db->get()->result_object();
    }
}
?>