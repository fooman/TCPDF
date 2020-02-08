<?php

class Example025Test extends Common
{

    const EXAMPLE_NR = '025';

    public function testPdfOutput()
    {
// create new PDF document
        $pdf = new Fooman\Tcpdf\Tcpdf(self::PDF_PAGE_ORIENTATION, self::PDF_UNIT, self::PDF_PAGE_FORMAT, true, 'UTF-8', false, false, $this->config);

// set document information
        $pdf->SetCreator(self::PDF_CREATOR);
        $pdf->SetAuthor('Nicola Asuni');
        $pdf->SetTitle('TCPDF Example 025');
        $pdf->SetSubject('TCPDF Tutorial');
        $pdf->SetKeywords('TCPDF, PDF, example, test, guide');

// set default header data
        $pdf->SetHeaderData($this->config->getPdfHeaderLogo(), $this->config->getPdfHeaderLogoWidth(), self::PDF_HEADER_TITLE.' 025', self::PDF_HEADER_STRING);

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
        $pdf->SetFont('helvetica', '', 12);

// add a page
        $pdf->AddPage();

        $txt = 'You can set the transparency of PDF objects using the setAlpha() method.';
        $pdf->Write(0, $txt, '', 0, '', true, 0, false, false, 0);

        /*
         * setAlpha() gives transparency support. You can set the
         * alpha channel from 0 (fully transparent) to 1 (fully
         * opaque). It applies to all elements (text, drawings,
         * images).
         */

        $pdf->SetLineWidth(2);

// draw opaque red square
        $pdf->SetFillColor(255, 0, 0);
        $pdf->SetDrawColor(127, 0, 0);
        $pdf->Rect(30, 40, 60, 60, 'DF');

// set alpha to semi-transparency
        $pdf->SetAlpha(0.5);

// draw green square
        $pdf->SetFillColor(0, 255, 0);
        $pdf->SetDrawColor(0, 127, 0);
        $pdf->Rect(50, 60, 60, 60, 'DF');

// draw blue square
        $pdf->SetFillColor(0, 0, 255);
        $pdf->SetDrawColor(0, 0, 127);
        $pdf->Rect(70, 80, 60, 60, 'DF');

// draw jpeg image
        $pdf->Image('tests/images/image_demo.jpg', 90, 100, 60, 60, '', 'http://www.tcpdf.org', '', true, 72);

// restore full opacity
        $pdf->SetAlpha(1);

        $this->comparePdfs($pdf);

    }
}
