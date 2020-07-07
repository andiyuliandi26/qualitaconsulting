<?php

class Resultsmodel extends Basemodel{

    public function get_peserta($pesertaID){

        $this->db->select(self::table_peserta.'.*,'.self::table_client.'.*');
                        $this->db->from(self::table_peserta);
                        $this->db->join(self::table_client, self::table_client.'.ID = '.self::table_peserta.'.ClientID');
                        $this->db->where(self::table_peserta.'.ID = '.$pesertaID);

        $query = $this->db->get();

        return $query->result_object();        
    }

    public function get_result_big5($pesertaID){

        $this->db->select(self::table_result_big5.'.*,'.self::table_peserta.'.NamaPeserta,'.self::table_peserta.'.JenisKelamin,'.self::table_peserta.'.TestDate,'.
                        self::table_big5.'.Nama as Big5Desc,'.self::table_big5.'.Kode');
                        $this->db->from(self::table_result_big5);
                        $this->db->join(self::table_peserta, self::table_peserta.'.ID = '.self::table_result_big5.'.PesertaID');
                        $this->db->join(self::table_big5, self::table_big5.'.ID = '.self::table_result_big5.'.Big5ID');
                        $this->db->where(self::table_result_big5.'.PesertaID = '.$pesertaID);
                        $this->db->order_by(self::table_result_big5.'.Big5ID');

        $query = $this->db->get();

        return $query->result_object();        
    }

    public function get_result_facet($pesertaID){

        $this->db->select(self::table_result_facet.'.*,'.self::table_peserta.'.NamaPeserta,'.self::table_peserta.'.JenisKelamin,'.self::table_peserta.'.TestDate,'.
                        self::table_facet.'.Nama as FacetDesc,'.self::table_facet.'.Big5ID,'.self::table_facet.'.RedaksiLow,'.self::table_facet.'.RedaksiAverage,'.self::table_facet.'.RedaksiHigh');
                        $this->db->from(self::table_result_facet);
                        $this->db->join(self::table_peserta, self::table_peserta.'.ID = '.self::table_result_facet.'.PesertaID');
                        $this->db->join(self::table_facet, self::table_facet.'.ID = '.self::table_result_facet.'.FacetID');
                        $this->db->where(self::table_result_facet.'.PesertaID = '.$pesertaID);
                        $this->db->order_by(self::table_result_facet.'.FacetID');

        $query = $this->db->get();

        return $query->result_object();        
    }

    public function get_result_style($pesertaID){

        $this->db->select(self::table_result_style.'.*,'.self::table_peserta.'.NamaPeserta,'.self::table_peserta.'.JenisKelamin,'.self::table_peserta.'.TestDate,'.
                        self::table_style_parameter.'.Style');
                        $this->db->from(self::table_result_style);
                        $this->db->join(self::table_peserta, self::table_peserta.'.ID = '.self::table_result_style.'.PesertaID');
                        $this->db->join(self::table_style_parameter, self::table_style_parameter.'.ID = '.self::table_result_style.'.NormaStyleID');
                        $this->db->where(self::table_result_style.'.PesertaID = '.$pesertaID);
                        $this->db->order_by(self::table_result_style.'.NormaStyleID');

        $query = $this->db->get();

        return $query->result_object();        
    }
}

?>