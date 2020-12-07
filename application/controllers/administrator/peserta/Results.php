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
        $resultBig5 = $this->resultsmodel->get_result_big5($pesertaID);
        $resultFacet = $this->resultsmodel->get_result_facet($pesertaID);
        $facetSummaryResult = $this->resultsmodel->generate_facet_summary_result($resultFacet);
        $resultStyle = $this->resultsmodel->get_result_style($pesertaID);
        $resultAdditoinalReport = $this->resultsmodel->get_result_additional_report($pesertaID);

        $data['dataAdditional'] = $getDataPeserta;
        $data['peserta'] = $getPeserta;
        $data['laporanData']['peserta'] = $getPeserta;
        $data['laporanData']['big5'] = $resultBig5;
        $data['laporanData']['facet'] = $resultFacet;
        $data['laporanData']['result_facet_summary'] = $facetSummaryResult;
        $data['laporanData']['style'] = $resultStyle;
        $data['laporanData']['additional'] = $resultAdditoinalReport;

        $this->load_administrator_view('/administrator/peserta/results/additionalreport/main', $data);
    }

    public function generate_report($pesertaID){
        $getPeserta = $this->pesertamodel->get_data_byid($pesertaID);
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

        $this->load_administrator_view("administrator/peserta/results/reportfinalforadmin", $data);
    }

    public function export_pdf($pesertaID){
        $this->load->library('email');
        //require_once('report.css');
        $getDomain = $this->big5model->get_data();
        $getFacet = $this->facetmodel->get_data();
        $getPeserta = $this->pesertamodel->get_data_byid($pesertaID);
        $resultBig5 = $this->resultsmodel->get_result_big5($pesertaID);
        $resultFacet = $this->resultsmodel->get_result_facet($pesertaID);
        $facetSummaryResult = $this->resultsmodel->generate_facet_summary_result($resultFacet);
        $resultStyle = $this->resultsmodel->get_result_style($pesertaID);
        $resultAdditoinalReport = $this->resultsmodel->get_result_additional_report($pesertaID);

        $getNormaFacet = $this->normafacetmodel->get_data_bygender($getPeserta->JenisKelamin);
        //var_dump($resultStyle);
        $data['peserta'] = $getPeserta;
        $data['domainResult'] = $resultBig5;
        $data['facetResult'] = $resultFacet;
        $data['result_facet_summary'] = $facetSummaryResult;
        $data['styleResult'] = $resultStyle;
        $data['additionalResult'] = $resultAdditoinalReport;
        $data['md_domain'] = $getDomain;
        $data['md_facet'] = $getFacet;
        $data['md_normafacet'] = $getNormaFacet;
        //var_dump($data);
        //$html = $this->load->view("layouts/header", true);
        //$html = $this->load->view("administrator/peserta/results/reportfinalforadminpdf", $data, true);
        $cover = $this->load->view("administrator/peserta/results/report/cover", $data, true);
        $data_peserta = $this->load->view("administrator/peserta/results/report/data-peserta", $data, true);
        $data_glosary = $this->load->view("administrator/peserta/results/report/data-glosary", NULL, true);
        $data_body = $this->load->view("administrator/peserta/results/report/data-body", $data, true);
        $data_style = $this->load->view("administrator/peserta/results/report/data-style", $data, true);
        $data_additional = $this->load->view("administrator/peserta/results/report/data-additional", $data, true);
        $stylesheet = file_get_contents('assets/css/report.css');
        //var_dump($stylesheet);

        //$this->load_administrator_view("administrator/peserta/results/report/cover", $data);
		//$this->load->view("administrator/peserta/results/report/email-view", $data);
		$mpdf = new \Mpdf\Mpdf();
		$mpdf->SetTitle("Profiling {$getPeserta->NamaPeserta}");
		$mpdf->SetAuthor("Qualita Consulting");
		$mpdf->SetCreator("Qualita Consulting");
		$mpdf->showImageErrors = true;
		$mpdf->imageVars['qasimage'] = file_get_contents('assets/images/Logo QAS.png');

		// $mpdf->SetDisplayMode('fullpage');

		$mpdf->WriteHTML($stylesheet,\Mpdf\HTMLParserMode::HEADER_CSS);
		$mpdf->addpage('','','','','on');

		$mpdf->SetFooter('Qualita Consulting | '.$getPeserta->NamaPeserta.' - Profiling Qualita | {PAGENO}');
		$mpdf->WriteHTML($cover,\Mpdf\HTMLParserMode::HTML_BODY);
		$mpdf->AddPage('','','1','','off');
		$mpdf->WriteHTML($data_peserta,\Mpdf\HTMLParserMode::HTML_BODY);
		$mpdf->AddPage();
		$mpdf->WriteHTML($data_glosary,\Mpdf\HTMLParserMode::HTML_BODY);
		$mpdf->AddPage();
		$mpdf->WriteHTML($data_body,\Mpdf\HTMLParserMode::HTML_BODY);
		$mpdf->AddPage();
		$mpdf->WriteHTML($data_style,\Mpdf\HTMLParserMode::HTML_BODY);

        if(count($resultAdditoinalReport) > 0){            
		    $mpdf->AddPage();
		    $mpdf->WriteHTML($data_additional,\Mpdf\HTMLParserMode::HTML_BODY);
        }

		////$mpdf->Output();

		$filename = "report_profiling_{$getPeserta->Email}.pdf";
		//$testDate = date_format(new DateTime($getPeserta->TestDate), 'd_m_Y');
		//$content = $mpdf->Output($filename,\Mpdf\Output\Destination::FILE);
		$mpdf->Output($filename,\Mpdf\Output\Destination::DOWNLOAD);

		//$messageBody = $this->load->view("administrator/peserta/results/report/email-view", $data, TRUE);
		//$this->email->clear(TRUE);

		//$this->email->from('admin@qualitaconsulting.co.id', 'Admin Qualita Consulting');
		//$this->email->to("andiyuliandi26@gmail.com");
		//$this->email->bcc("edyfish23@gmail.com");
		//$this->email->subject('Data Hasil Profiling Qualita');
		//$this->email->message($messageBody);
		//$this->email->attach($filename, "attachement", "Profiling {$getPeserta->NamaPeserta}_{$testDate}.pdf");

		//if($this->email->send(FALSE)){
		//    unlink($filename);
		//    //echo "Success";
		//    $mpdf->Output();
		//   // return TRUE;
		//}else{
		//    echo "Something Error";
		//}
		//echo $this->email->print_debugger();
    }
}

?>
