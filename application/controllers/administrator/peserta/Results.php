<?php

class Results extends MY_Controller
{
    public function index()
    {
        $array = array();
        $getAnswer = $this->resultsmodel->get_peserta_answer(1);
        $big5result = $this->resultsmodel->generate_results($getAnswer[0]);
        //$styleResult = $this->resultsmodel->generate_style_results($big5result);

        $data['data'] = $this->resultsmodel->generate_results($getAnswer[0]);
        $data['data_style'] = $this->resultsmodel->generate_style_results($big5result);
        //$data['data_result_style'] = $this->resultsmodel->calculate_by_style($styleResult['PesertaID'], $styleResult);

        $this->load_view('/peserta/results/main2', $data);
    }
}

?>