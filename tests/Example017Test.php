<?php

class Example017Test extends Common
{

    const EXAMPLE_NR = '017';
    const NR_PDF_PAGES = 2;

    public function testPdfOutput()
    {
// create new PDF document
        $pdf = new Fooman\Tcpdf\Tcpdf(self::PDF_PAGE_ORIENTATION, self::PDF_UNIT, self::PDF_PAGE_FORMAT, true, 'UTF-8', false, false, $this->config);

// set document information
        $pdf->SetCreator(self::PDF_CREATOR);
        $pdf->SetAuthor('Nicola Asuni');
        $pdf->SetTitle('TCPDF Example 017');
        $pdf->SetSubject('TCPDF Tutorial');
        $pdf->SetKeywords('TCPDF, PDF, example, test, guide');

// set default header data
        $pdf->SetHeaderData($this->config->getPdfHeaderLogo(), $this->config->getPdfHeaderLogoWidth(), self::PDF_HEADER_TITLE.' 017', self::PDF_HEADER_STRING);

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
        $pdf->SetFont('helvetica', '', 20);

// add a page
        $pdf->AddPage();

        $pdf->Write(0, 'Example of independent Multicell() columns', '', 0, 'L', true, 0, false, false, 0);

        $pdf->Ln(5);

        $pdf->SetFont('times', '', 12);

// create columns content
// create columns content
        $left_column = '[LEFT COLUMN] left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column left column'."\n";

        $right_column = '[RIGHT COLUMN] right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column'."\n";

// MultiCell($w, $h, $txt, $border=0, $align='J', $fill=0, $ln=1, $x='', $y='', $reseth=true, $stretch=0, $ishtml=false, $autopadding=true, $maxh=0)

// set color for background
        $pdf->SetFillColor(255, 255, 200);

// set color for text
        $pdf->SetTextColor(0, 63, 127);

// write the first column
        $pdf->MultiCell(80, 0, $left_column, 1, 'J', 1, 0, '', '', true, 0, false, true, 0);

// set color for background
        $pdf->SetFillColor(215, 235, 255);

// set color for text
        $pdf->SetTextColor(127, 31, 0);

// write the second column
        $pdf->MultiCell(80, 0, $right_column, 1, 'J', 1, 1, '', '', true, 0, false, true, 0);

// reset pointer to the last page
        $pdf->lastPage();


        $this->comparePdfs($pdf);

    }
}

