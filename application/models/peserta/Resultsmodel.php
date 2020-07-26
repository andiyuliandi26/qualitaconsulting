<?php

class Resultsmodel extends Basemodel{

    #region Get Result for Chart
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

    // public function get_result_facet($pesertaID){

    //     $this->db->select(self::TABLE_RESULT_FACET.'.*,'.self::TABLE_PESERTA.'.NamaPeserta,'.self::TABLE_PESERTA.'.JenisKelamin,'.self::TABLE_PESERTA.'.TestDate,'.
    //                     self::TABLE_FACET.'.Nama as FacetDesc,'.self::TABLE_FACET.'.Big5ID,'.self::TABLE_FACET.'.RedaksiLow,'.self::TABLE_FACET.'.RedaksiAverage,'.self::TABLE_FACET.'.RedaksiHigh');
    //                     $this->db->from(self::TABLE_RESULT_FACET);
    //                     $this->db->join(self::TABLE_PESERTA, self::TABLE_PESERTA.'.ID = '.self::TABLE_RESULT_FACET.'.PesertaID');
    //                     $this->db->join(self::TABLE_FACET, self::TABLE_FACET.'.ID = '.self::TABLE_RESULT_FACET.'.FacetID');
    //                     $this->db->where(self::TABLE_RESULT_FACET.'.PesertaID = '.$pesertaID);
    //                     $this->db->order_by(self::TABLE_RESULT_FACET.'.FacetID');
    //     var_dump($this->db->get_compiled_select());
    //     $query = $this->db->get();

    //     return $query->result_object();        
    // }

    public function get_result_facet($pesertaID){

        $this->db->select(self::TABLE_RESULT_FACET.'.*')
                ->from(self::TABLE_RESULT_FACET)
                ->where(self::TABLE_RESULT_FACET.'.PesertaID = '.$pesertaID)
                ->order_by(self::TABLE_RESULT_FACET.'.FacetID');
        //var_dump($this->db->get_compiled_select());

        return $this->db->get()->result_array();        
    }

    public function get_result_style($pesertaID){
        
        $this->db->select(self::TABLE_RESULT_STYLE.'.*,'.self::TABLE_PESERTA.'.NamaPeserta,'.self::TABLE_PESERTA.'.JenisKelamin,'.self::TABLE_PESERTA.'.TestDate,');
                        $this->db->from(self::TABLE_RESULT_STYLE);
                        $this->db->join(self::TABLE_PESERTA, self::TABLE_PESERTA.'.ID = '.self::TABLE_RESULT_STYLE.'.PesertaID');
                        $this->db->join(self::TABLE_NORMA_STYLE, self::TABLE_NORMA_STYLE.'.ID = '.self::TABLE_RESULT_STYLE.'.NormaStyleID');
                        $this->db->where(self::TABLE_RESULT_STYLE.'.PesertaID = '.$pesertaID);
                        $this->db->order_by(self::TABLE_RESULT_STYLE.'.NormaStyleID');
        
        return $this->db->get()->result_object();        
    }

    public function get_result_additional_report($pesertaID){

        $this->db->select(self::TABLE_ADDITIONAL_REPORT.'.*')
                ->from(self::TABLE_ADDITIONAL_REPORT)
                ->where(self::TABLE_ADDITIONAL_REPORT.'.PesertaID = '.$pesertaID)
                ->order_by(self::TABLE_ADDITIONAL_REPORT.'.Item', 'Asc');

        return $this->db->get()->result_object();        
    }
    #endregion
    
    #region Get Peserta Info
    public function get_peserta($pesertaID){

        $this->db->select(self::TABLE_PESERTA.'.*,'.self::TABLE_CLIENT.'.NamaClient, '.self::TABLE_CLIENT_BATCH.'.NamaBatch');
                        $this->db->from(self::TABLE_PESERTA);
                        $this->db->join(self::TABLE_CLIENT_BATCH, self::TABLE_CLIENT_BATCH.'.ID = '.self::TABLE_PESERTA.'.BatchID');
                        $this->db->join(self::TABLE_CLIENT, self::TABLE_CLIENT.'.ID = '.self::TABLE_CLIENT_BATCH.'.ClientID');
                        $this->db->where(self::TABLE_PESERTA.'.ID = '.$pesertaID);

        $query = $this->db->get();

        return $query->result_object();        
    }

    public function get_peserta_bytoken($tokenPeserta){

        $this->db->select(self::TABLE_PESERTA.'.*,'.self::TABLE_CLIENT.'.*, '.self::TABLE_CLIENT_BATCH.'.*');
                        $this->db->from(self::TABLE_PESERTA);
                        $this->db->join(self::TABLE_CLIENT_BATCH, self::TABLE_CLIENT_BATCH.'.ID = '.self::TABLE_PESERTA.'.BatchID');
                        $this->db->join(self::TABLE_CLIENT, self::TABLE_CLIENT.'.ID = '.self::TABLE_CLIENT_BATCH.'.ClientID');
                        $this->db->where(self::TABLE_PESERTA.".Token = '".$tokenPeserta."'");

        $query = $this->db->get();

        return $query->result_object();        
    }

    public function get_peserta_answer($pesertaID)
    {
        $this->db->select(self::TABLE_PESERTA.'.*')
                ->from(self::TABLE_PESERTA)
                ->where(self::TABLE_PESERTA.'.ID = '.$pesertaID);

        return  $this->db->get()->row_object();  
    }
    #endregion    

    #region Generate Jawaban dan Score
    public function generate_score($peserta)
    {
        $big5 = new Big5model;
        $facet = new Facetmodel;
        $summary = array();
        $pernyataanID = explode(",", $peserta->PernyataanID);
        $jawaban = explode(",", $peserta->Jawaban);

        $this->db->select(self::TABLE_PERNYATAAN.'.*,'.$big5->selectedColumn.','.$facet->selectedColumn)
                ->from(self::TABLE_PERNYATAAN)
                ->join(self::TABLE_BIG5, self::TABLE_BIG5.'.ID = '.self::TABLE_PERNYATAAN.'.Big5ID')
                ->join(self::TABLE_FACET, self::TABLE_FACET.'.ID = '.self::TABLE_PERNYATAAN.'.FacetID')
                ->order_by(self::TABLE_PERNYATAAN.'.ID');
        
        $md_pernyataan = $this->db->get()->result_array();
        
        for($i = 0; $i < count($pernyataanID); $i++)
        {
            $search = array_search($pernyataanID[$i], array_column($md_pernyataan, 'ID'));
            array_push($summary, array(
                'PesertaID' => $peserta->ID,
                'JenisKelamin' => $peserta->JenisKelamin,
                'Big5ID' => $md_pernyataan[$search]['Big5ID'],
                'Big5Desc' => $md_pernyataan[$search]['Big5Desc'],
                'FacetID' => $md_pernyataan[$search]['FacetID'],
                'FacetDesc' => $md_pernyataan[$search]['FacetDesc'],
                'PernyataanID' => $pernyataanID[$i],
                'Jawaban' => $jawaban[$i],
                'Score' => $md_pernyataan[$search]['Score'.$jawaban[$i]],
                
            ));
        }
        //var_dump($summary);
        return $summary;
    }
    #endregion
    
    #region Generate Big5 Result
    public function generate_big5_result($scoreData)
    {   
        $grouped = $this->_array_group_by($scoreData, 'Big5ID');
        $return = array();
        $score = array();
        $index = 0;
        foreach ($scoreData as $items) {
            $score[$items['Big5ID']] = 0;
        }

        foreach ($scoreData as $items) {
            $score[$items['Big5ID']] += $items['Score'];
        }

        foreach($grouped as $items)
        {
            $getLfs = $this->get_big5_lfsresult($items['Big5ID'], $score[$items['Big5ID']], $scoreData[$index]['JenisKelamin']);
            array_push($return, array(
                'PesertaID' => $scoreData[$index]['PesertaID'],
                'Big5ID' => $items['Big5ID'],
                'Big5Desc' => $items['Big5Desc'],
                'TotalScore' => $score[$items['Big5ID']],
                'LfsResult' => $getLfs->Lfs,
                'MatriksResult' => $this->get_big5_matriksresult($items['Big5ID'], $getLfs->Lfs) ,
                'RedaksiResult' => $this->get_big5_redaksiresult($items['Big5ID'], $getLfs->Lfs)                
            ));
        }

        return $return;
    }

    private function get_big5_lfsresult($big5ID, $score, $jenisKelamin)
    {
        $where = "Big5ID = {$big5ID} AND BatasBawah <= {$score} AND BatasAtas >= {$score} AND JenisKelamin = '{$jenisKelamin}'";
        $this->db->select(self::TABLE_NORMA_BIG5.'.*')
                ->from(self::TABLE_NORMA_BIG5)
                ->where($where);

        return  $this->db->get()->row_object();  
    }

    private function get_big5_redaksiresult($big5ID, $lfs)
    {
        $returnRedaksi = "";
        $where = "ID = {$big5ID}";
        $this->db->select(self::TABLE_BIG5.'.*')
                ->from(self::TABLE_BIG5)
                ->where($where);

        $query = $this->db->get()->row_object(); 
        switch($lfs){
            case self::LFS_VERY_LOW:
                $returnRedaksi = $query->RedaksiLow;
                break;
            case self::LFS_LOW:
                $returnRedaksi = $query->RedaksiLow;
                break;
            case self::LFS_AVERAGE:
                $returnRedaksi = $query->RedaksiAverage;
                break;
            case self::LFS_HIGH:
                $returnRedaksi = $query->RedaksiHigh;
                break;
            case self::LFS_VERY_HIGH:
                $returnRedaksi = $query->RedaksiHigh;
                break;            
        }

        return $returnRedaksi;
    }

    private function get_big5_matriksresult($big5ID, $lfs)
    {
        $returnMatriks = "";
        $where = "ID = {$big5ID}";
        $this->db->select(self::TABLE_BIG5.'.*')
                ->from(self::TABLE_BIG5)
                ->where($where);

        $query = $this->db->get()->row_object(); 
        switch($lfs){
            case self::LFS_VERY_LOW:
                $returnMatriks = $query->MatriksLow;
                break;
            case self::LFS_LOW:
                $returnMatriks = $query->MatriksLow;
                break;
            case self::LFS_AVERAGE:
                $returnMatriks = $query->MatriksAverage;
                break;
            case self::LFS_HIGH:
                $returnMatriks = $query->MatriksHigh;
                break;
            case self::LFS_VERY_HIGH:
                $returnMatriks = $query->MatriksHigh;
                break;            
        }

        return $returnMatriks;
    }
    #endregion
    
    #region Generate Facet Result
    public function generate_facet_summary_result($facetResult)
    {   
        $grouped = $this->_array_group_by($facetResult, 'Big5ID');
        $return = array();
        $score = array();
        $index = 0;
        foreach ($facetResult as $items) {
            $score[$items['Big5ID']] = "";
        }

        foreach ($facetResult as $items) {
            $score[$items['Big5ID']] .= $items['RedaksiResult'].'. ';
        }

        foreach($grouped as $items)
        {
            array_push($return, array(
                'PesertaID' => $facetResult[$index]['PesertaID'],
                'Big5ID' => $items['Big5ID'],
                'Big5Desc' => $items['Big5Desc'],
                'RedaksiResult' => $score[$items['Big5ID']]                
            ));
            $index++;
        }

        return $return;
    }

    public function generate_facet_result($scoreData)
    {   
        $grouped = $this->_array_group_by($scoreData, 'FacetID');
        $return = array();
        $score = array();
        $index = 0;
        foreach ($scoreData as $items) {
            $score[$items['FacetID']] = 0;
        }

        foreach ($scoreData as $items) {
            $score[$items['FacetID']] += $items['Score'];
        }

        foreach($grouped as $items)
        {
            $getLfs = $this->get_facet_lfsresult($items['FacetID'], $score[$items['FacetID']], $scoreData[$index]['JenisKelamin']);
            array_push($return, array(
                'PesertaID' => $scoreData[$index]['PesertaID'],
                'Big5ID' => $items['Big5ID'],
                'Big5Desc' => $items['Big5Desc'],
                'FacetID' => $items['FacetID'],
                'FacetDesc' => $items['FacetDesc'],
                'TotalScore' => $score[$items['FacetID']],
                'LfsResult' => $getLfs->Lfs,
                'RedaksiResult' => $this->get_facet_redaksiresult($items['FacetID'], $getLfs->Lfs)                
            ));
            $index++;
        }

        return $return;
    }

    private function get_facet_lfsresult($facetID, $score, $jenisKelamin)
    {
        $where = "FacetID = {$facetID} AND BatasBawah <= {$score} AND BatasAtas >= {$score} AND JenisKelamin = '{$jenisKelamin}'";
        $this->db->select(self::TABLE_NORMA_FACET.'.*')
                ->from(self::TABLE_NORMA_FACET)
                ->where($where);

        return  $this->db->get()->row_object();  
    }

    private function get_facet_redaksiresult($facetID, $lfs)
    {
        $returnRedaksi = "";
        $where = "ID = {$facetID}";
        $this->db->select(self::TABLE_FACET.'.*')
                ->from(self::TABLE_FACET)
                ->where($where);

        $query = $this->db->get()->row_object(); 
        switch($lfs){
            case self::LFS_VERY_LOW:
                $returnRedaksi = $query->RedaksiLow;
                break;
            case self::LFS_LOW:
                $returnRedaksi = $query->RedaksiLow;
                break;
            case self::LFS_AVERAGE:
                $returnRedaksi = $query->RedaksiAverage;
                break;
            case self::LFS_HIGH:
                $returnRedaksi = $query->RedaksiHigh;
                break;
            case self::LFS_VERY_HIGH:
                $returnRedaksi = $query->RedaksiHigh;
                break;            
        }

        return $returnRedaksi;
    }
    #endregion

    #region Generate Style Result
    public function generate_style_result($big5Result)
    {
        $style_assignment = array();
        $return = array();
        $this->db->select(self::TABLE_STYLE_PARAMETER.'.*')
                ->from(self::TABLE_STYLE_PARAMETER)
                ->order_by(self::TABLE_STYLE_PARAMETER.'.ID');
        
        $md_style = $this->db->get()->result_array();
        
        for($i = 0; $i < count($md_style); $i++)
        {
            $big5LeftValue = array_search($md_style[$i]['Big5LeftID'], array_column($big5Result, 'Big5ID'));
            $big5RightValue = array_search($md_style[$i]['Big5RightID'], array_column($big5Result, 'Big5ID'));

            if($big5Result[$big5LeftValue]['LfsResult'] != self::LFS_AVERAGE && $big5Result[$big5RightValue]['LfsResult'] != self::LFS_AVERAGE)
            {
                array_push($style_assignment, array(
                    'PesertaID' => $big5Result[$big5LeftValue]['PesertaID'],
                    'StyleID' => $md_style[$i]['ID'],
                    'Big5LeftID' => $md_style[$i]['Big5LeftID'],
                    'Big5LeftValue' => $big5Result[$big5LeftValue]['MatriksResult'],
                    'Big5LeftLfs' => $this->convert_lfs_to_lfsdb($big5Result[$big5LeftValue]['LfsResult']),
                    'Big5RightID' => $md_style[$i]['Big5RightID'],
                    'Big5RightValue' => $big5Result[$big5RightValue]['MatriksResult'],
                    'Big5RightLfs' => $this->convert_lfs_to_lfsdb($big5Result[$big5RightValue]['LfsResult']),
                    
                ));
            }
        }

        foreach($style_assignment as $items)
        {
            $getResult = $this->get_style_result($items['StyleID'], $items['Big5LeftLfs'], $items['Big5RightLfs']);
            array_push($return, array(
                'PesertaID' => $items['PesertaID'],
                //'StyleID' => $getResult->StyleID,
                'StyleDesc' => $getResult->Style,
                'NormaStyleID' => $getResult->ID,
                'Big5LeftValue' => $getResult->Big5LeftValue,
                'Big5RightValue' => $getResult->Big5RightValue,
                'RedaksiResult' => $getResult->Redaksi,
            ));
        }

        return $return;
    }

    private function get_style_result($styleID, $big5LeftValue, $big5RightValue)
    {
        $where = "StyleID = {$styleID} AND ".self::TABLE_NORMA_STYLE.".Big5LeftLfs = '{$big5LeftValue}' AND ".self::TABLE_NORMA_STYLE.".Big5RightLfs = '{$big5RightValue}'";
        $this->db->select(self::TABLE_NORMA_STYLE.'.*, '.self::TABLE_STYLE_PARAMETER.'.Style')
                ->from(self::TABLE_NORMA_STYLE)
                ->join(self::TABLE_STYLE_PARAMETER, self::TABLE_STYLE_PARAMETER.'.ID = '.self::TABLE_NORMA_STYLE.'.StyleID')
                ->where($where);

        return $this->db->get()->row_object();   
    }

    #endregion
    
    #region Helper
    private function convert_lfs_to_lfsdb($lfs){
        $return = "";
        switch($lfs){
            case self::LFS_VERY_LOW:
                $return = self::LFS_LOW;
                break;
            case self::LFS_LOW:
                $return = self::LFS_LOW;
                break;
            case self::LFS_AVERAGE:
                $return = self::LFS_AVERAGE;
                break;
            case self::LFS_HIGH:
                $return = self::LFS_HIGH;
                break;
            case self::LFS_VERY_HIGH:
                $return = self::LFS_VERY_HIGH;
                break;            
        }

        return $return;
    }
    #endregion
    
    #region For Action
    public function peserta_result_updatedb($pesertaID)
    {
        $getAnswer = $this->get_peserta_answer($pesertaID);
        $getScore = $this->generate_score($getAnswer);

        $big5result = $this->generate_big5_result($getScore);
        $facetresult = $this->generate_facet_result($getScore);
        $styleresult = $this->resultsmodel->generate_style_result($big5result);

        $this->db->trans_begin();
        foreach($big5result as $items){
            if($this->peserta_result_big5_isnewrecord($items)){
                $this->db->insert(self::TABLE_RESULT_BIG5, $items);
            }else{
                $this->db->where("PesertaID = ".$items['PesertaID']." AND Big5ID = ".$items['Big5ID']);
                $this->db->update(self::TABLE_RESULT_BIG5, $items);
            }
        }

        foreach($facetresult as $items){
            if($this->peserta_result_facet_isnewrecord($items)){
                $this->db->insert(self::TABLE_RESULT_FACET, $items);
            }else{
                $this->db->where("PesertaID = ".$items['PesertaID']." AND FacetID = ".$items['FacetID']);
                $this->db->update(self::TABLE_RESULT_FACET, $items);
            }
        }

        foreach($styleresult as $items){
            if($this->peserta_result_style_isnewrecord($items)){
                $this->db->insert(self::TABLE_RESULT_STYLE, $items);
            }else{
                $this->db->where("PesertaID = ".$items['PesertaID']." AND NormaStyleID = ".$items['NormaStyleID']);
                $this->db->update(self::TABLE_RESULT_STYLE, $items);
            }
        }

        if($this->db->trans_status() === FALSE){
            $this->db->trans_rollback();
            return FALSE;
        }else{
            $this->db->trans_commit();
            return TRUE;
        }
    }

    public function peserta_result_updatedb_bytoken($tokenPeserta)
    {
        $getPeserta = $this->pesertamodel->get_data_bytoken($tokenPeserta);
        $getAnswer = $this->get_peserta_answer($getPeserta->ID);
        $getScore = $this->generate_score($getAnswer);

        $big5result = $this->generate_big5_result($getScore);
        $facetresult = $this->generate_facet_result($getScore);
        $styleresult = $this->resultsmodel->generate_style_result($big5result);

        $this->db->trans_begin();
        foreach($big5result as $items){
            if($this->peserta_result_big5_isnewrecord($items)){
                $this->db->insert(self::TABLE_RESULT_BIG5, $items);
            }else{
                $this->db->where("PesertaID = ".$items['PesertaID']." AND Big5ID = ".$items['Big5ID']);
                $this->db->update(self::TABLE_RESULT_BIG5, $items);
            }
        }

        foreach($facetresult as $items){
            if($this->peserta_result_facet_isnewrecord($items)){
                $this->db->insert(self::TABLE_RESULT_FACET, $items);
            }else{
                $this->db->where("PesertaID = ".$items['PesertaID']." AND FacetID = ".$items['FacetID']);
                $this->db->update(self::TABLE_RESULT_FACET, $items);
            }
        }

        foreach($styleresult as $items){
            if($this->peserta_result_style_isnewrecord($items)){
                $this->db->insert(self::TABLE_RESULT_STYLE, $items);
            }else{
                $this->db->where("PesertaID = ".$items['PesertaID']." AND NormaStyleID = ".$items['NormaStyleID']);
                $this->db->update(self::TABLE_RESULT_STYLE, $items);
            }
        }

        if($this->db->trans_status() === FALSE){
            $this->db->trans_rollback();
            return FALSE;
        }else{
            $this->db->trans_commit();
            return TRUE;
        }
    }

    private function peserta_result_big5_isnewrecord($record){
        
        $this->db->select('*')
                ->from(self::TABLE_RESULT_BIG5)
                ->where("PesertaID = ".$record['PesertaID']." AND Big5ID = ".$record['Big5ID']);
        $countData = $this->db->count_all_results();
        //var_dump($countData);
        if($countData > 0){
            return FALSE;
        }else{
            return TRUE;
        }
    }

    private function peserta_result_facet_isnewrecord($record){
        
        $this->db->select('*')
                ->from(self::TABLE_RESULT_FACET)
                ->where("PesertaID = ".$record['PesertaID']." AND FacetID = ".$record['FacetID']);
        $countData = $this->db->count_all_results();
        //var_dump($countData);
        if($countData > 0){
            return FALSE;
        }else{
            return TRUE;
        }
    }

    private function peserta_result_style_isnewrecord($record){
        
        $this->db->select('*')
                ->from(self::TABLE_RESULT_STYLE)
                ->where("PesertaID = ".$record['PesertaID']." AND NormaStyleID = ".$record['NormaStyleID']);
        $countData = $this->db->count_all_results();
        //var_dump($countData);
        if($countData > 0){
            return FALSE;
        }else{
            return TRUE;
        }
    }
    #endregion
}

?>