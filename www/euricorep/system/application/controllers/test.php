<?php


class Test extends Controller {
    function Test() {
        parent::Controller();
    }

    function index() {
        $caminho = APPPATH.'marco.pdf';
        $this->load->library('pdfConvert');
        $pdf = new pdfConvert();
        $pdf->setFilename($caminho);
        $pdf->decodePDF();
        $pdf->createMyDocument($caminho . "copy.txt");
    }
}

?>
