<?php

class Example038Test extends Common
{

    const EXAMPLE_NR = '038';

    public function testPdfOutput()
    {
        $this->markTestIncomplete("Missing system fonts");

// create new PDF document
        $pdf = new Fooman\Tcpdf\Tcpdf(self::PDF_PAGE_ORIENTATION, self::PDF_UNIT, self::PDF_PAGE_FORMAT, true, 'UTF-8', false, false, $this->config);

// set document information
        $pdf->SetCreator(self::PDF_CREATOR);
        $pdf->SetAuthor('Nicola Asuni');
        $pdf->SetTitle('TCPDF Example 038');
        $pdf->SetSubject('TCPDF Tutorial');
        $pdf->SetKeywords('TCPDF, PDF, example, test, guide');

// set default header data
        $pdf->SetHeaderData(self::PDF_HEADER_LOGO, self::PDF_HEADER_LOGO_WIDTH, self::PDF_HEADER_TITLE.' 038', self::PDF_HEADER_STRING);

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

        $txt = 'Example of CID-0 CJK unembedded font.
To display extended text you must have CJK fonts installed for your PDF reader:';
        $pdf->Write(0, $txt, '', 0, 'L', true, 0, false, false, 0);

// set font
        $pdf->SetFont('cid0jp', '', 40);

        $txt = 'ã“ã‚“ã«ã¡ã¯ä¸–ç•Œ';
        $pdf->Write(0, $txt, '', 0, 'L', true, 0, false, false, 0);

        $this->comparePdfs($pdf);

    }
}
