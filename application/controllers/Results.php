<?php

class Results extends MY_Controller{


    public function index($id){
        $resultBig5 = $this->resultsmodel->get_result_big5(1);
        $data['big5'] = $this->big5model->get_data();
        $data['peserta'] = $this->resultsmodel->get_peserta(1);
        $big5Summary = array();
        
        $resultFacet = $this->resultsmodel->get_result_facet(1);
        $resultStyle = $this->resultsmodel->get_result_style(1);
        
        foreach($resultBig5 as $items){
            $facetResult = '';
            foreach($resultFacet as $items2){
                if($items2->Big5ID == $items->Big5ID){
                    switch($items2->LfsResult){
                        case 'Very Low':
                            $facetResult .= $items2->RedaksiLow.'. ';
                            break;
                        case 'Low':
                            $facetResult .= $items2->RedaksiLow.'. ';
                            break;
                        case 'Average':
                            $facetResult .= $items2->RedaksiAverage.'. ';
                            break;
                        case 'High':
                            $facetResult .= $items2->RedaksiHigh.'. ';
                            break;
                        case 'Very High':
                            $facetResult .= $items2->RedaksiHigh.'. ';
                            break;
                        
                    }
                    
                }
            }
            array_push($big5Summary, [ $items->Big5Desc => $facetResult ]);
        }

        $data['resultbig5'] =  $resultBig5;
        $data['resultStyle'] =  $resultStyle;
        $data['big5Summary'] =  $big5Summary;
        //$view = '';
        //$view = $this->load->view("peserta/results/main", $data);
        $this->load_view("peserta/results/main", $data);
        // $this->load->view("administrator/header");
        // $this->load->view("administrator/nav");        
        // $this->load->view("peserta/results/main", $data);
        // $this->load->view("administrator/footer");
    }
}



?>