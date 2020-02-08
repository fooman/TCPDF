<?php

class Example055Test extends Common
{

    const EXAMPLE_NR = '055';
    const NR_PDF_PAGES = 14;


    public function testPdfOutput()
    {
// create new PDF document
        $pdf = new Fooman\Tcpdf\Tcpdf(self::PDF_PAGE_ORIENTATION, self::PDF_UNIT, self::PDF_PAGE_FORMAT, true, 'UTF-8', false, false, $this->config);

// set document information
        $pdf->SetCreator(self::PDF_CREATOR);
        $pdf->SetAuthor('Nicola Asuni');
        $pdf->SetTitle('TCPDF Example 055');
        $pdf->SetSubject('TCPDF Tutorial');
        $pdf->SetKeywords('TCPDF, PDF, example, test, guide');

// set default header data
        $pdf->SetHeaderData($this->config->getPdfHeaderLogo(), $this->config->getPdfHeaderLogoWidth(), self::PDF_HEADER_TITLE.' 055', self::PDF_HEADER_STRING);

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
        $pdf->SetFont('helvetica', '', 14);

// array of font names
        $core_fonts = array('courier', 'courierB', 'courierI', 'courierBI', 'helvetica', 'helveticaB', 'helveticaI', 'helveticaBI', 'times', 'timesB', 'timesI', 'timesBI', 'symbol', 'zapfdingbats');

// set fill color
        $pdf->SetFillColor(221,238,255);

// create one HTML table for each core font
        foreach($core_fonts as $font) {
            // add a page
            $pdf->AddPage();

            // Cell($w, $h=0, $txt='', $border=0, $ln=0, $align='', $fill=false, $link='', $stretch=0, $ignore_min_height=false, $calign='T', $valign='M')

            // set font for title
            $pdf->SetFont('helvetica', 'B', 16);

            // print font name
            $pdf->Cell(0, 10, 'FONT: '.$font, 1, 1, 'C', true, '', 0, false, 'T', 'M');

            // set font for chars
            $pdf->SetFont($font, '', 16);

            // print each character
            for ($i = 0; $i < 256; ++$i) {
                if (($i > 0) AND (($i % 16) == 0)) {
                    $pdf->Ln();
                }
                $pdf->Cell(11.25, 11.25, \Fooman\Tcpdf\Fonts::unichr($i), 1, 0, 'C', false, '', 0, false, 'T', 'M');
            }

            $pdf->Ln(20);

            // print a pangram
            $pdf->Cell(0, 0, 'The quick brown fox jumps over the lazy dog', 0, 1, 'C', false, '', 0, false, 'T', 'M');
        }

// ---------------------------------------------------------

        $this->comparePdfs($pdf);

    }
}
