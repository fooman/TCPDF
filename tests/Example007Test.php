<?php

class Example007Test extends Common
{

    const EXAMPLE_NR = '007';
    const NR_PDF_PAGES = 2;

    public function testPdfOutput()
    {
// create new PDF document
        $pdf = new Fooman\Tcpdf\Tcpdf(self::PDF_PAGE_ORIENTATION, self::PDF_UNIT, self::PDF_PAGE_FORMAT, true, 'UTF-8', false, false, $this->config);

// set document information
        $pdf->SetCreator(self::PDF_CREATOR);
        $pdf->SetAuthor('Nicola Asuni');
        $pdf->SetTitle('TCPDF Example 007');
        $pdf->SetSubject('TCPDF Tutorial');
        $pdf->SetKeywords('TCPDF, PDF, example, test, guide');

// set default header data
        $pdf->SetHeaderData($this->config->getPdfHeaderLogo(), $this->config->getPdfHeaderLogoWidth(), self::PDF_HEADER_TITLE . ' 007', self::PDF_HEADER_STRING);

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
        $pdf->SetAutoPageBreak(true, self::PDF_MARGIN_BOTTOM);

// set image scale factor
        $pdf->setImageScale(self::PDF_IMAGE_SCALE_RATIO);

        // set some language-dependent strings (optional)
        $pdf->setLanguageArray($this->langSettings);

// ---------------------------------------------------------

// set font
        $pdf->SetFont('times', '', 12);

// add a page
        $pdf->AddPage();

// create columns content
        $left_column = '<b>LEFT COLUMN</b> left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column';

        $right_column = '<b>RIGHT COLUMN</b> right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column';

// writeHTMLCell($w, $h, $x, $y, $html='', $border=0, $ln=0, $fill=0, $reseth=true, $align='', $autopadding=true)

// get current vertical position
        $y = $pdf->getY();

// set color for background
        $pdf->SetFillColor(255, 255, 200);

// set color for text
        $pdf->SetTextColor(0, 63, 127);

// write the first column
        $pdf->writeHTMLCell(80, '', '', $y, $left_column, 1, 0, 1, true, 'J', true);

// set color for background
        $pdf->SetFillColor(215, 235, 255);

// set color for text
        $pdf->SetTextColor(127, 31, 0);

// write the second column
        $pdf->writeHTMLCell(80, '', '', '', $right_column, 1, 1, 1, true, 'J', true);

// reset pointer to the last page
        $pdf->lastPage();

        $this->comparePdfs($pdf);
    }

}
