<?php

class Resultsmodel extends Basemodel{

    public function get_peserta($pesertaID){

        $this->db->select(self::TABLE_PESERTA.'.*,'.self::TABLE_CLIENT.'.*, '.self::TABLE_CLIENT_BATCH.'.*');
                        $this->db->from(self::TABLE_PESERTA);
                        $this->db->join(self::TABLE_CLIENT_BATCH, self::TABLE_CLIENT_BATCH.'.ID = '.self::TABLE_PESERTA.'.BatchID');
                        $this->db->join(self::TABLE_CLIENT, self::TABLE_CLIENT.'.ID = '.self::TABLE_CLIENT_BATCH.'.ClientID');
                        $this->db->where(self::TABLE_PESERTA.'.ID = '.$pesertaID);

        $query = $this->db->get();

        return $query->result_object();        
    }

    public function get_result_big5($pesertaID){

        $this->db->select(self::TABLE_RESULT_BIG5.'.*,'.self::TABLE_PESERTA.'.NamaPeserta,'.self::TABLE_PESERTA.'.JenisKelamin,'.self::TABLE_PESERTA.'.TestDate,'.
                        self::TABLE_BIG5.'.Nama as Big5Desc,'.self::TABLE_BIG5.'.Kode');
                        $this->db->from(self::TABLE_RESULT_BIG5);
                        $this->db->join(self::TABLE_PESERTA, self::TABLE_PESERTA.'.ID = '.self::TABLE_RESULT_BIG5.'.PesertaID');
                        $this->db->join(self::TABLE_BIG5, self::TABLE_BIG5.'.ID = '.self::TABLE_RESULT_BIG5.'.Big5ID');
                        $this->db->where(self::TABLE_RESULT_BIG5.'.PesertaID = '.$pesertaID);
                        $this->db->order_by(self::TABLE_RESULT_BIG5.'.Big5ID');

        $query = $this->db->get();

        return $query->result_object();        
    }

    public function get_result_facet($pesertaID){

        $this->db->select(self::TABLE_RESULT_FACET.'.*,'.self::TABLE_PESERTA.'.NamaPeserta,'.self::TABLE_PESERTA.'.JenisKelamin,'.self::TABLE_PESERTA.'.TestDate,'.
                        self::TABLE_FACET.'.Nama as FacetDesc,'.self::TABLE_FACET.'.Big5ID,'.self::TABLE_FACET.'.RedaksiLow,'.self::TABLE_FACET.'.RedaksiAverage,'.self::TABLE_FACET.'.RedaksiHigh');
                        $this->db->from(self::TABLE_RESULT_FACET);
                        $this->db->join(self::TABLE_PESERTA, self::TABLE_PESERTA.'.ID = '.self::TABLE_RESULT_FACET.'.PesertaID');
                        $this->db->join(self::TABLE_FACET, self::TABLE_FACET.'.ID = '.self::TABLE_RESULT_FACET.'.FacetID');
                        $this->db->where(self::TABLE_RESULT_FACET.'.PesertaID = '.$pesertaID);
                        $this->db->order_by(self::TABLE_RESULT_FACET.'.FacetID');

        $query = $this->db->get();

        return $query->result_object();        
    }

    public function get_result_style($pesertaID){

        $this->db->select(self::TABLE_RESULT_STYLE.'.*,'.self::TABLE_PESERTA.'.NamaPeserta,'.self::TABLE_PESERTA.'.JenisKelamin,'.self::TABLE_PESERTA.'.TestDate,'.
                        self::TABLE_STYLE_PARAMETER.'.Style');
                        $this->db->from(self::TABLE_RESULT_STYLE);
                        $this->db->join(self::TABLE_PESERTA, self::TABLE_PESERTA.'.ID = '.self::TABLE_RESULT_STYLE.'.PesertaID');
                        $this->db->join(self::TABLE_STYLE_PARAMETER, self::TABLE_STYLE_PARAMETER.'.ID = '.self::TABLE_RESULT_STYLE.'.NormaStyleID');
                        $this->db->where(self::TABLE_RESULT_STYLE.'.PesertaID = '.$pesertaID);
                        $this->db->order_by(self::TABLE_RESULT_STYLE.'.NormaStyleID');

        $query = $this->db->get();

        return $query->result_object();        
    }

    public function get_peserta_answer($pesertaID)
    {
        $this->db->select(self::TABLE_PESERTA_ANSWER.'.*, '.self::TABLE_PESERTA.'.JenisKelamin')
                ->from(self::TABLE_PESERTA_ANSWER)
                ->join(self::TABLE_PESERTA, self::TABLE_PESERTA_ANSWER.'.PesertaID = '.self::TABLE_PESERTA.'.ID')
                ->where(self::TABLE_PESERTA_ANSWER.'.PesertaID = '.$pesertaID);

        return  $this->db->get()->result_object();  
    }

    public function get_norma_facet_list()
    {
        $this->db->select(self::TABLE_NORMA_FACET.'.*')
                ->from(self::TABLE_NORMA_FACET);

        return  $this->db->get()->result_object();  
    }

    public function get_big5_lfsresult($big5ID, $score, $jenisKelamin)
    {
        $where = "Big5ID = {$big5ID} AND BatasBawah <= {$score} AND BatasAtas >= {$score} AND JenisKelamin = '{$jenisKelamin}'";
        $this->db->select(self::TABLE_NORMA_BIG5.'.*')
                ->from(self::TABLE_NORMA_BIG5)
                ->where($where);
        $query = $this->db->get()->result_object();
        //var_dump($query);
        return  $query[0];  
    }

    public function get_style_result($styleID, $big5LeftValue, $big5RightValue)
    {
        $where = "StyleID = {$styleID} AND Big5LeftValue = '{$big5LeftValue}' AND Big5RightValue = '{$big5RightValue}'";
        $this->db->select(self::TABLE_NORMA_STYLE.'.*, '.self::TABLE_STYLE_PARAMETER.'.Style')
                ->from(self::TABLE_NORMA_STYLE)
                ->join(self::TABLE_STYLE_PARAMETER, self::TABLE_STYLE_PARAMETER.'.ID = '.self::TABLE_NORMA_STYLE.'.StyleID')
                ->where($where);
        $query = $this->db->get()->result_object();
        //var_dump($where);
        return  $query[0];   
    }
    

    public function convert_array_to_string($array)
    {
        $join = join(",", $array);

        return $join;
    }

    public function convert_string_to_array($string)
    {
        $explode = explode(',', $string);

        return $explode;
    }

    public function generate_results($peserta_answer)
    {
        $summary = array();
        $pernyataanID = explode(",", $peserta_answer->PernyataanID);
        $jawaban = explode(",", $peserta_answer->Jawaban);

        $this->db->select(self::TABLE_PERNYATAAN.'.*')
                ->from(self::TABLE_PERNYATAAN)
                ->order_by(self::TABLE_PERNYATAAN.'.ID');
        
        $md_pernyataan = $this->db->get()->result_array();
        //var_dump(array_column($md_pernyataan, 'ID'));
        
        for($i = 0; $i < count($pernyataanID); $i++)
        {
            $search = array_search($pernyataanID[$i], array_column($md_pernyataan, 'ID'));
            array_push($summary, array(
                'Big5ID' => $md_pernyataan[$search]['Big5ID'],
                'FacetID' => $md_pernyataan[$search]['FacetID'],
                'Score' => $md_pernyataan[$search]['Score'.$jawaban[$i]],
                
            ));
            //echo 'facetID '.$md_pernyataan[$search]['FacetID']. ' Score : '.$md_pernyataan[$search]['Score'.$jawaban[$i]].'<br>';
        }
        
        //array_group_by($summary, 'Big5ID');
        //var_dump($this->calculate_by_big5($summary));
        //var_dump($this->calculate_by_facet('1', $summary));
        //var_dump($search);
        //return $summary;
        return $this->calculate_by_big5($peserta_answer->PesertaID, $summary, $peserta_answer->JenisKelamin);
    }

    public function generate_style_results($big5Result)
    {
        $style_assignment = array();

        $this->db->select(self::TABLE_STYLE_PARAMETER.'.*')
                ->from(self::TABLE_STYLE_PARAMETER)
                ->order_by(self::TABLE_STYLE_PARAMETER.'.ID');
        
        $md_style = $this->db->get()->result_array();
        //var_dump(array_column($md_pernyataan, 'ID'));
        
        for($i = 0; $i < count($md_style); $i++)
        {
            $big5LeftValue = array_search($md_style[$i]['Big5LeftID'], array_column($big5Result, 'Big5ID'));
            $big5RightValue = array_search($md_style[$i]['Big5RightID'], array_column($big5Result, 'Big5ID'));

            //$search = array_search($pernyataanID[$i], array_column($md_pernyataan, 'ID'));
            if($big5Result[$big5LeftValue]['LfsResult'] != 'Average' && $big5Result[$big5RightValue]['LfsResult'] != 'Average')
            {
                array_push($style_assignment, array(
                    'PesertaID' => $big5Result[$big5LeftValue]['PesertaID'],
                    'StyleID' => $md_style[$i]['ID'],
                    'Big5LeftID' => $md_style[$i]['Big5LeftID'],
                    'Big5LeftValue' => $big5Result[$big5LeftValue]['Matriks'],
                    'Big5RightID' => $md_style[$i]['Big5RightID'],
                    'Big5RightValue' => $big5Result[$big5RightValue]['Matriks'],
                    //'Score' => $md_pernyataan[$search]['Score'.$jawaban[$i]],
                    
                ));
            }
            
            //echo 'facetID '.$md_pernyataan[$search]['FacetID']. ' Score : '.$md_pernyataan[$search]['Score'.$jawaban[$i]].'<br>';
        }
        
        //array_group_by($summary, 'Big5ID');
        //var_dump($this->calculate_by_big5($summary));
        //var_dump($this->calculate_by_facet('1', $summary));
        //var_dump($search);
        //return $summary;
        return $this->calculate_by_style($big5Result[$big5LeftValue]['PesertaID'], $style_assignment);
    }

    private function _array_group_by($arr, $fldName) {
        $groups = array();
        foreach ($arr as $rec) {
            $groups[$rec[$fldName]] = $rec;
        }
        return $groups;
    }

    private function calculate_by_big5($pesertaID, $summary, $jenisKelamin)
    {
        $grouped = $this->_array_group_by($summary, 'Big5ID');
        $return = array();
        $score = array();
        foreach ($summary as $items) {
            $score[$items['Big5ID']] = 0;
        }

        foreach ($summary as $items) {
            $score[$items['Big5ID']] += $items['Score'];
        }

        foreach($grouped as $items)
        {
            $getLfs = $this->get_big5_lfsresult($items['Big5ID'], $score[$items['Big5ID']], $jenisKelamin);
            array_push($return, array(
                'PesertaID' => $pesertaID,
                'Big5ID' => $items['Big5ID'],
                'TotalScore' => $score[$items['Big5ID']],
                'LfsResult' => "$getLfs->Lfs",
                'Matriks' => $getLfs->Matriks
                
            ));
        }

        return $return;
    }

    private function calculate_by_facet($pesertaID, $summary, $jenisKelamin)
    {
        $grouped = $this->_array_group_by($summary, 'FacetID');

        $return = array();
        $score = array();
        foreach ($summary as $items) {
            $score[$items['FacetID']] = 0;
        }

        foreach ($summary as $items) {
            $score[$items['FacetID']] += $items['Score'];
        }

        foreach($grouped as $items)
        {
            $getLfs = $this->get_facet_lfsresult($items['FacetID'], $score[$items['FacetID']], $jenisKelamin);
            array_push($return, array(
                'PesertaID' => $pesertaID,
                'FacetID' => $items['FacetID'],
                'TotalScore' => $score[$items['FacetID']],
                'LfsResult' => $getLfs
            ));
        }

        return $return;
    }

    private function calculate_by_style($pesertaID, $summary)
    {
        $return = array();

        foreach($summary as $items)
        {
            $getResult = $this->get_style_result($items['StyleID'], $items['Big5LeftValue'], $items['Big5RightValue']);
            array_push($return, array(
                'PesertaID' => $pesertaID,
                'StyleID' => $getResult->StyleID,
                'Style' => $getResult->Style,
                'NormaStyleID' => $getResult->ID,
                'Big5LeftValue' => $getResult->Big5LeftValue,
                'Big5RightValue' => $getResult->Big5RightValue,
                'Redaksi' => $getResult->Redaksi,
            ));
        }

        return $return;
    }
}

?>