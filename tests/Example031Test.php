<?php

class Example031Test extends Common
{

    const EXAMPLE_NR = '031';

    public function testPdfOutput()
    {

// create new PDF document
        $pdf = new Fooman\Tcpdf\Tcpdf(self::PDF_PAGE_ORIENTATION, self::PDF_UNIT, self::PDF_PAGE_FORMAT, true, 'UTF-8', false, false, $this->config);

// set document information
        $pdf->SetCreator(self::PDF_CREATOR);
        $pdf->SetAuthor('Nicola Asuni');
        $pdf->SetTitle('TCPDF Example 031');
        $pdf->SetSubject('TCPDF Tutorial');
        $pdf->SetKeywords('TCPDF, PDF, example, test, guide');

// set default header data
        $pdf->SetHeaderData(self::PDF_HEADER_LOGO, self::PDF_HEADER_LOGO_WIDTH, self::PDF_HEADER_TITLE.' 031', self::PDF_HEADER_STRING);

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
        $pdf->SetFont('helvetica', 'B', 20);

// add a page
        $pdf->AddPage();

        $pdf->Write(0, 'Example of PieSector() method.');

        $xc = 105;
        $yc = 100;
        $r = 50;

        $pdf->SetFillColor(0, 0, 255);
        $pdf->PieSector($xc, $yc, $r, 20, 120, 'FD', false, 0, 2);

        $pdf->SetFillColor(0, 255, 0);
        $pdf->PieSector($xc, $yc, $r, 120, 250, 'FD', false, 0, 2);

        $pdf->SetFillColor(255, 0, 0);
        $pdf->PieSector($xc, $yc, $r, 250, 20, 'FD', false, 0, 2);

// write labels
        $pdf->SetTextColor(255,255,255);
        $pdf->Text(105, 65, 'BLUE');
        $pdf->Text(60, 95, 'GREEN');
        $pdf->Text(120, 115, 'RED');

        $this->comparePdfs($pdf);

    }
}
