<?php

class Example040Test extends Common
{

    const EXAMPLE_NR = '040';
    const NR_PDF_PAGES = 4;

    public function testPdfOutput()
    {
// create new PDF document
        $pdf = new Fooman\Tcpdf\Tcpdf(self::PDF_PAGE_ORIENTATION, self::PDF_UNIT, self::PDF_PAGE_FORMAT, true, 'UTF-8', false, false, $this->config);

// set document information
        $pdf->SetCreator(self::PDF_CREATOR);
        $pdf->SetAuthor('Nicola Asuni');
        $pdf->SetTitle('TCPDF Example 040');
        $pdf->SetSubject('TCPDF Tutorial');
        $pdf->SetKeywords('TCPDF, PDF, example, test, guide');

// set default header data
        $pdf->SetHeaderData($this->config->getPdfHeaderLogo(), $this->config->getPdfHeaderLogoWidth(), self::PDF_HEADER_TITLE.' 040', self::PDF_HEADER_STRING);

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

// set display mode
        $pdf->SetDisplayMode($zoom='fullpage', $layout='TwoColumnRight', $mode='UseNone');

// set pdf viewer preferences
        $pdf->setViewerPreferences(array('Duplex' => 'DuplexFlipLongEdge'));

// set booklet mode
        $pdf->SetBooklet(true, 10, 30);

// set core font
        $pdf->SetFont('helvetica', '', 18);

// add a page (left page)
        $pdf->AddPage();

        $pdf->Write(0, 'Example of booklet mode', '', 0, 'L', true, 0, false, false, 0);

// print a line using Cell()
        $pdf->Cell(0, 0, 'PAGE 1', 1, 1, 'C');


// add a page (right page)
        $pdf->AddPage();

// print a line using Cell()
        $pdf->Cell(0, 0, 'PAGE 2', 1, 1, 'C');


// add a page (left page)
        $pdf->AddPage();

// print a line using Cell()
        $pdf->Cell(0, 0, 'PAGE 3', 1, 1, 'C');

// add a page (right page)
        $pdf->AddPage();

// print a line using Cell()
        $pdf->Cell(0, 0, 'PAGE 4', 1, 1, 'C');

        $this->comparePdfs($pdf);

    }
}
