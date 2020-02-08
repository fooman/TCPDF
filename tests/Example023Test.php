<?php

class Example023Test extends Common
{

    const EXAMPLE_NR = '023';
    const NR_PDF_PAGES = 6;


    public function testPdfOutput()
    {

// create new PDF document
        $pdf = new Fooman\Tcpdf\Tcpdf(self::PDF_PAGE_ORIENTATION, self::PDF_UNIT, self::PDF_PAGE_FORMAT, true, 'UTF-8', false, false, $this->config);

// set document information
        $pdf->SetCreator(self::PDF_CREATOR);
        $pdf->SetAuthor('Nicola Asuni');
        $pdf->SetTitle('TCPDF Example 023');
        $pdf->SetSubject('TCPDF Tutorial');
        $pdf->SetKeywords('TCPDF, PDF, example, test, guide');

// set default header data
        $pdf->SetHeaderData($this->config->getPdfHeaderLogo(), $this->config->getPdfHeaderLogoWidth(), self::PDF_HEADER_TITLE.' 023', self::PDF_HEADER_STRING);

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
        $pdf->SetFont('times', 'BI', 14);

// Start First Page Group
        $pdf->startPageGroup();

// add a page
        $pdf->AddPage();

// set some text to print
        $txt = <<<EOD
Example of page groups.
Check the page numbers on the page footer.

This is the first page of group 1.
EOD;

// print a block of text using Write()
        $pdf->Write(0, $txt, '', 0, 'L', true, 0, false, false, 0);

// add second page
        $pdf->AddPage();
        $pdf->Cell(0, 10, 'This is the second page of group 1', 0, 1, 'L');

// Start Second Page Group
        $pdf->startPageGroup();

// add some pages
        $pdf->AddPage();
        $pdf->Cell(0, 10, 'This is the first page of group 2', 0, 1, 'L');
        $pdf->AddPage();
        $pdf->Cell(0, 10, 'This is the second page of group 2', 0, 1, 'L');
        $pdf->AddPage();
        $pdf->Cell(0, 10, 'This is the third page of group 2', 0, 1, 'L');
        $pdf->AddPage();
        $pdf->Cell(0, 10, 'This is the fourth page of group 2', 0, 1, 'L');


        $this->comparePdfs($pdf);

    }
}
