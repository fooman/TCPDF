<?php

class Example035Test extends Common
{

    const EXAMPLE_NR = '035';

    public function testPdfOutput()
    {
// create new PDF document
        $pdf = new Fooman\Tcpdf\Tcpdf(self::PDF_PAGE_ORIENTATION, self::PDF_UNIT, self::PDF_PAGE_FORMAT, true, 'UTF-8', false, false, $this->config);

// set document information
        $pdf->SetCreator(self::PDF_CREATOR);
        $pdf->SetAuthor('Nicola Asuni');
        $pdf->SetTitle('TCPDF Example 035');
        $pdf->SetSubject('TCPDF Tutorial');
        $pdf->SetKeywords('TCPDF, PDF, example, test, guide');

// set default header data
        $pdf->SetHeaderData($this->config->getPdfHeaderLogo(), $this->config->getPdfHeaderLogoWidth(), self::PDF_HEADER_TITLE.' 035', self::PDF_HEADER_STRING);

// set header and footer fonts
        $pdf->setHeaderFont(Array(self::PDF_FONT_NAME_MAIN, '', self::PDF_FONT_SIZE_MAIN));
        $pdf->setFooterFont(Array(self::PDF_FONT_NAME_DATA, '', self::PDF_FONT_SIZE_DATA));

// set default monospaced font
        $pdf->SetDefaultMonospacedFont(self::PDF_FONT_MONOSPACED);

// set margins
        $pdf->SetMargins(self::PDF_MARGIN_LEFT, self::PDF_MARGIN_TOP, self::PDF_MARGIN_RIGHT);
        $pdf->SetHeaderMargin(self::PDF_MARGIN_HEADER);
        $pdf->SetFooterMargin(self::PDF_MARGIN_FOOTER);

// set auto page breaks
        $pdf->SetAutoPageBreak(TRUE, self::PDF_MARGIN_BOTTOM);

// set image scale factor
        $pdf->setImageScale(self::PDF_IMAGE_SCALE_RATIO);

        // set some language-dependent strings (optional)
        $pdf->setLanguageArray($this->langSettings);

// ---------------------------------------------------------

// set font
        $pdf->SetFont('times', 'BI', 16);

// add a page
        $pdf->AddPage();

        $pdf->Write(0, 'Example of SetLineStyle() method', '', 0, 'L', true, 0, false, false, 0);

        $pdf->Ln();

        $pdf->SetLineStyle(array('width' => 0.5, 'cap' => 'butt', 'join' => 'miter', 'dash' => 4, 'color' => array(255, 0, 0)));
        $pdf->SetFillColor(255,255,128);
        $pdf->SetTextColor(0,0,128);

        $text="DUMMY";

        $pdf->Cell(0, 0, $text, 1, 1, 'L', 1, 0);

        $pdf->Ln();

        $pdf->SetLineStyle(array('width' => 0.5, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 0, 255)));
        $pdf->SetFillColor(255,255,0);
        $pdf->SetTextColor(0,0,255);
        $pdf->MultiCell(60, 4, $text, 1, 'C', 1, 0);

        $pdf->SetLineStyle(array('width' => 0.5, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(255, 255, 0)));
        $pdf->SetFillColor(0,0,255);
        $pdf->SetTextColor(255,255,0);
        $pdf->MultiCell(60, 4, $text, 'TB', 'C', 1, 0);

        $pdf->SetLineStyle(array('width' => 0.5, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(255, 0, 255)));
        $pdf->SetFillColor(0,255,0);
        $pdf->SetTextColor(255,0,255);
        $pdf->MultiCell(60, 4, $text, 1, 'C', 1, 1);

        $this->comparePdfs($pdf);

    }
}
