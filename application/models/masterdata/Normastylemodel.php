<?php

class Normastylemodel extends Basemodel{    

    public function get_data()
    {
        $style = new Style_parametermodel;
        $this->db->select(self::TABLE_NORMA_STYLE.'.*,'.$style->selectedColumn)
            ->from(self::TABLE_NORMA_STYLE)
            ->join(self::TABLE_STYLE_PARAMETER, self::TABLE_NORMA_STYLE.'.StyleID = '.self::TABLE_STYLE_PARAMETER.'.ID');

        return $this->db->get()->result_object();
    }

    public function get_data_byid($id)
    {
        $style = new Style_parametermodel;
        $this->db->select(self::TABLE_NORMA_STYLE.'.*,'.$style->selectedColumn)
            ->from(self::TABLE_NORMA_STYLE)
            ->join(self::TABLE_STYLE_PARAMETER, self::TABLE_NORMA_STYLE.'.StyleID = '.self::TABLE_STYLE_PARAMETER.'.ID')
            ->where(self::TABLE_NORMA_STYLE.".ID = {$id}");

        return $this->db->get()->row_object();
    }

    public function update_data($id){
        $data = array(
            'Redaksi' => $this->input->post('Redaksi')
        );
        
        $this->db->where('ID', $id);

        if($this->db->update(self::TABLE_NORMA_STYLE, $data)){
            return true;
        }else{
            show_error("Terjadi kesalahan pada simpan data");
            var_dump("test");
            return false;
        }
    }

    public function get_big5_matriks($big5Data, $big5ID, $lfsValue)
    {
        $returnMatriks = "";
        $getIndex = array_search($big5ID, array_column($big5Data, 'ID'));

        switch($lfsValue){
            case 'Low':
                $returnMatriks = $big5Data[$getIndex]->MatriksLow;
                break;
            case 'Average':
                $returnMatriks = $big5Data[$getIndex]->MatriksAverage;
                break;
            case 'High':
                $returnMatriks = $big5Data[$getIndex]->MatriksHigh;
                break;           
        }

        return $returnMatriks;
    }
}


?>