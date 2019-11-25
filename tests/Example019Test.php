<?php

class Example019Test extends Common
{

    const EXAMPLE_NR = '019';

    public function testPdfOutput()
    {
// create new PDF document
        $pdf = new Fooman\Tcpdf\Tcpdf(self::PDF_PAGE_ORIENTATION, self::PDF_UNIT, self::PDF_PAGE_FORMAT, false, 'ISO-8859-1', false);

// Set document information dictionary in unicode mode
        $pdf->SetDocInfoUnicode(true);

// set document information
        $pdf->SetCreator(self::PDF_CREATOR);
        $pdf->SetAuthor('Nicola Asuni [â‚¬]');
        $pdf->SetTitle('TCPDF Example 019');
        $pdf->SetSubject('TCPDF Tutorial');
        $pdf->SetKeywords('TCPDF, PDF, example, test, guide');

// set default header data
        $pdf->SetHeaderData(self::PDF_HEADER_LOGO, self::PDF_HEADER_LOGO_WIDTH, self::PDF_HEADER_TITLE.' 019', self::PDF_HEADER_STRING);

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

// set some language dependent data:
        $lg = Array();
        $lg['a_meta_charset'] = 'ISO-8859-1';
        $lg['a_meta_dir'] = 'ltr';
        $lg['a_meta_language'] = 'en';
        $lg['w_page'] = 'page';

// set some language-dependent strings (optional)
        $pdf->setLanguageArray($lg);

// ---------------------------------------------------------

// set font
        $pdf->SetFont('helvetica', '', 12);

// add a page
        $pdf->AddPage();

// set color for background
        $pdf->SetFillColor(200, 255, 200);

        $txt = 'An alternative configuration file is used on this example.
Check the definition of the K_TCPDF_EXTERNAL_CONFIG constant on the source code.';

// print some text
        $pdf->MultiCell(0, 0, $txt."\n", 1, 'J', 1, 1, '', '', true, 0, false, true, 0);


        $this->comparePdfs($pdf);

    }
}

