<?php

class Clientmodel extends Basemodel{    

    public $kategoriList = array(
        'Perusahaan', 'Individu'
    );
    
    public function get_data()
    {
        $this->db->select(self::TABLE_CLIENT.'.*');
        $this->db->from(self::TABLE_CLIENT);
        
        $query = $this->db->get();
        return $query->result_object();
    }

    public function get_data_byid($id)
    {
        $this->db->select(self::TABLE_CLIENT.'.*')
            ->from(self::TABLE_CLIENT)
            ->where(self::TABLE_CLIENT.'.ID = '.$id);
        
        return $this->db->get()->row_object();
    }

    public function get_data_for_selector(){
        $returnValue = array();
        $this->db->select(self::TABLE_CLIENT.'.*');
        $this->db->from(self::TABLE_CLIENT);

        $query = $this->db->get()->result_object();

        foreach($query as $items){
            $returnValue += [$items->ID => $items->NamaClient];
        }
        //print_r($returnValue);
        return $returnValue;
    }

    public function create_client(){
        $this->load->helper('url');

        $data = array(
            'KodeClient' => $this->input->post('KodeClient'),
            'NamaClient' => $this->input->post('NamaClient'),
            'Alamat' => $this->input->post('Alamat'),
            'Kategori' => $this->input->post('Kategori')
        );

        return $this->db->insert(self::TABLE_CLIENT, $data);
    }

    public function update_client(){
        $this->load->helper('url');
        $id = $this->input->post('ID');

        $data = array(
            'KodeClient' => $this->input->post('KodeClient'),
            'NamaClient' => $this->input->post('NamaClient'),
            'Alamat' => $this->input->post('Alamat'),
            'Kategori' => $this->input->post('Kategori')
        );
        
        return $this->db->update(self::TABLE_CLIENT, $data, "ID = {$id}");
    }
}

?>