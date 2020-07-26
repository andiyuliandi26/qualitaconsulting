<?php

class Results extends MY_Controller
{
    public function index()
    {
        $getAnswer = $this->resultsmodel->get_peserta_answer(1);
        $getScore = $this->resultsmodel->generate_score($getAnswer);
        $big5result = $this->resultsmodel->generate_big5_result($getScore);
        $facetresult = $this->resultsmodel->generate_facet_result($getScore);
        $facetsummaryresult = $this->resultsmodel->generate_facet_summary_result($facetresult);
        $styleresult = $this->resultsmodel->generate_style_result($big5result);

        $data['answer'] = $getAnswer;
        $data['getScore'] = $getScore;
        $data['result_big5'] = $big5result;
        $data['result_facet'] = $facetresult;
        $data['result_facet_summary'] = $facetsummaryresult;
        $data['result_style'] = $styleresult;

        $this->load_administrator_view('/administrator/peserta/results/main', $data);
    }

    public function check_result($pesertaID)
    {
        $getAnswer = $this->resultsmodel->get_peserta_answer($pesertaID);
        $getScore = $this->resultsmodel->generate_score($getAnswer);
        $big5result = $this->resultsmodel->generate_big5_result($getScore);
        $facetresult = $this->resultsmodel->generate_facet_result($getScore);
        $facetsummaryresult = $this->resultsmodel->generate_facet_summary_result($facetresult);
        $styleresult = $this->resultsmodel->generate_style_result($big5result);

        $data['answer'] = $getAnswer;
        $data['getScore'] = $getScore;
        $data['result_big5'] = $big5result;
        $data['result_facet'] = $facetresult;
        $data['result_facet_summary'] = $facetsummaryresult;
        $data['result_style'] = $styleresult;

        $this->load_administrator_view('/administrator/peserta/results/main', $data);
    }

    public function additional_report($pesertaID)
    {
        $getPeserta = $this->pesertamodel->get_data_byid($pesertaID);
        $getDataPeserta = $this->additionalreportmodel->get_data($pesertaID);

        $data['data'] = $getDataPeserta;
        $data['dataPeserta'] = $getPeserta;

        $this->load_administrator_view('/administrator/peserta/results/additionalreport/main', $data);
    }

    public function generate_report($pesertaID){
        $getPeserta = $this->resultsmodel->get_peserta($pesertaID);
        $resultBig5 = $this->resultsmodel->get_result_big5($pesertaID);
        $resultFacet = $this->resultsmodel->get_result_facet($pesertaID);        
        $facetSummaryResult = $this->resultsmodel->generate_facet_summary_result($resultFacet);
        $resultStyle = $this->resultsmodel->get_result_style($pesertaID);
        $resultAdditoinalReport = $this->resultsmodel->get_result_additional_report($pesertaID);
        //var_dump($resultStyle);
        $data['peserta'] = $getPeserta;                
        $data['big5'] = $resultBig5;
        $data['facet'] = $resultFacet;
        $data['result_facet_summary'] = $facetSummaryResult;
        $data['style'] = $resultStyle;
        $data['additional'] = $resultAdditoinalReport;
        
        $this->load_administrator_view("administrator/peserta/results/reportforadmin", $data);
    }

    public function export_pdf($pesertaID){
        $getPeserta = $this->resultsmodel->get_peserta($pesertaID);
        $resultBig5 = $this->resultsmodel->get_result_big5($pesertaID);
        $resultFacet = $this->resultsmodel->get_result_facet($pesertaID);        
        $facetSummaryResult = $this->resultsmodel->generate_facet_summary_result($resultFacet);
        $resultStyle = $this->resultsmodel->get_result_style($pesertaID);
        $resultAdditoinalReport = $this->resultsmodel->get_result_additional_report($pesertaID);
        //var_dump($resultStyle);
        $data['peserta'] = $getPeserta;                
        $data['big5'] = $resultBig5;
        $data['facet'] = $resultFacet;
        $data['result_facet_summary'] = $facetSummaryResult;
        $data['style'] = $resultStyle;
        $data['additional'] = $resultAdditoinalReport;
        //var_dump($data);
        $html = $this->load->view("administrator/peserta/results/reportforadminpdf", $data, true);
        //$this->pdfgenerator->generate_html2pdf($html,'Hasil Tes');;
        $this->pdfgenerator->generate($html,'Hasil Tes');;
    }
}

?>