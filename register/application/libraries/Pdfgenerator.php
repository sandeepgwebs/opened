<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once("application/third_party/dompdf/autoload.inc.php");
//require_once("application/third_party/dompdf/dompdf/dompdf_config.inc.php");
use Dompdf\Dompdf;

class Pdfgenerator {

    public function generate($html, $filename='', $stream=TRUE, $paper = 'A4', $orientation = "portrait"){
        /*var_dump($paper);
        var_dump($orientation);die;*/

        $dompdf = new DOMPDF();
        $dompdf->loadHtml($html);
        $dompdf->setPaper($paper, $orientation);
        $dompdf->render();
        if ($stream) {
            $dompdf->stream($filename.".pdf", array("Attachment" => 0));
        } else {
            return $dompdf->output();
        }
    }
}
?>