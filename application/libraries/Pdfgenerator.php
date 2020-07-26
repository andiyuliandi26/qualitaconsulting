<?php
require './vendor/autoload.php';

use Dompdf\Dompdf;
use Spipu\Html2Pdf\Html2Pdf;

class PdfGenerator
{
  public function generate($html,$filename)
  {
    // define('DOMPDF_ENABLE_AUTOLOAD', false);
 
    $dompdf = new Dompdf();
    $dompdf->set_option('isHtml5ParserEnabled', true);
    $dompdf->loadHtml($html,'utf-8');
    $dompdf->setPaper('A4', 'portrait');
    $dompdf->render();
    $dompdf->stream($filename.'.pdf',array("Attachment"=>1));
  }

  public function generate_html2pdf($html,$filename)
  {
      
    $html2pdf = new Html2Pdf('P', 'A4', 'en');
    $html2pdf->writeHTML($html);
    $html2pdf->output();
  }
}

?>



