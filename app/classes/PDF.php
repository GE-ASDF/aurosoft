<?php

namespace app\classes;
use Dompdf\Dompdf;
use Dompdf\Options;

// Classe para gerar PDFs usando a biblioteca DOMPdf

class PDF {
    public $dompdf;
    private $html;
    private $escola_info;
    public function __construct(){
        $options = new Options();
        $options->set('isRemoteEnabled', TRUE);
        $options->set('defaultFont', 'sans-serif');
        $this->dompdf = new Dompdf($options);
    }

    public function custom($html, $useDefaultHeader = false, string $titleReport = 'Relatório'){
        $this->html.= $html;
        return $this;
    }

    public function portrait(){
        $this->dompdf->loadHtml($this->html);
        $this->dompdf->setPaper('A4', 'portrait');
        return $this;
    }

    public function landscape(){
        $this->dompdf->loadHtml($this->html);
        $this->dompdf->setPaper('A4', 'landscape');
        return $this;
    }

    public function export(string $filename = 'document', int $attachment = 0){
        $this->dompdf->render();
        $this->dompdf->stream("$filename.pdf", ['Attachment' => $attachment]);
    }

    public function output(){
        $this->dompdf->render();
        return $this->dompdf->output();
    }

}