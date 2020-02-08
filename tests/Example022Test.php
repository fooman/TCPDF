<?php

class Example022Test extends Common
{

    const EXAMPLE_NR = '022';

    public function testPdfOutput()
    {

// create new PDF document
        $pdf = new Fooman\Tcpdf\Tcpdf(self::PDF_PAGE_ORIENTATION, self::PDF_UNIT, self::PDF_PAGE_FORMAT, true, 'UTF-8', false, false, $this->config);

// set document information
        $pdf->SetCreator(self::PDF_CREATOR);
        $pdf->SetAuthor('Nicola Asuni');
        $pdf->SetTitle('TCPDF Example 022');
        $pdf->SetSubject('TCPDF Tutorial');
        $pdf->SetKeywords('TCPDF, PDF, example, test, guide');

// set default header data
        $pdf->SetHeaderData($this->config->getPdfHeaderLogo(), $this->config->getPdfHeaderLogoWidth(), self::PDF_HEADER_TITLE.' 022', self::PDF_HEADER_STRING);

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

// check also the following methods:
// SetDrawColorArray()
// SetFillColorArray()
// SetTextColorArray()

// set font
        $pdf->SetFont('helvetica', 'B', 18);

// add a page
        $pdf->AddPage();

        $pdf->Write(0, 'Example of CMYK, RGB and Grayscale colours', '', 0, 'L', true, 0, false, false, 0);

// define style for border
        $border_style = array('all' => array('width' => 2, 'cap' => 'square', 'join' => 'miter', 'dash' => 0, 'phase' => 0));

// --- CMYK ------------------------------------------------

        $pdf->SetDrawColor(50, 0, 0, 0);
        $pdf->SetFillColor(100, 0, 0, 0);
        $pdf->SetTextColor(100, 0, 0, 0);
        $pdf->Rect(30, 60, 30, 30, 'DF', $border_style);
        $pdf->Text(30, 92, 'Cyan');

        $pdf->SetDrawColor(0, 50, 0, 0);
        $pdf->SetFillColor(0, 100, 0, 0);
        $pdf->SetTextColor(0, 100, 0, 0);
        $pdf->Rect(70, 60, 30, 30, 'DF', $border_style);
        $pdf->Text(70, 92, 'Magenta');

        $pdf->SetDrawColor(0, 0, 50, 0);
        $pdf->SetFillColor(0, 0, 100, 0);
        $pdf->SetTextColor(0, 0, 100, 0);
        $pdf->Rect(110, 60, 30, 30, 'DF', $border_style);
        $pdf->Text(110, 92, 'Yellow');

        $pdf->SetDrawColor(0, 0, 0, 50);
        $pdf->SetFillColor(0, 0, 0, 100);
        $pdf->SetTextColor(0, 0, 0, 100);
        $pdf->Rect(150, 60, 30, 30, 'DF', $border_style);
        $pdf->Text(150, 92, 'Black');

// --- RGB -------------------------------------------------

        $pdf->SetDrawColor(255, 127, 127);
        $pdf->SetFillColor(255, 0, 0);
        $pdf->SetTextColor(255, 0, 0);
        $pdf->Rect(30, 110, 30, 30, 'DF', $border_style);
        $pdf->Text(30, 142, 'Red');

        $pdf->SetDrawColor(127, 255, 127);
        $pdf->SetFillColor(0, 255, 0);
        $pdf->SetTextColor(0, 255, 0);
        $pdf->Rect(70, 110, 30, 30, 'DF', $border_style);
        $pdf->Text(70, 142, 'Green');

        $pdf->SetDrawColor(127, 127, 255);
        $pdf->SetFillColor(0, 0, 255);
        $pdf->SetTextColor(0, 0, 255);
        $pdf->Rect(110, 110, 30, 30, 'DF', $border_style);
        $pdf->Text(110, 142, 'Blue');

// --- GRAY ------------------------------------------------

        $pdf->SetDrawColor(191);
        $pdf->SetFillColor(127);
        $pdf->SetTextColor(127);
        $pdf->Rect(30, 160, 30, 30, 'DF', $border_style);
        $pdf->Text(30, 192, 'Gray');

        $this->comparePdfs($pdf);

    }
}
