<?php

class Example065Test extends Common
{

    const EXAMPLE_NR = '065';
    const NR_PDF_PAGES = 1;


    public function testPdfOutput()
    {

// create new PDF document
        $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false, true);

// set document information
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('Nicola Asuni');
        $pdf->SetTitle('TCPDF Example 065');
        $pdf->SetSubject('TCPDF Tutorial');
        $pdf->SetKeywords('TCPDF, PDF, example, test, guide');

// set default header data
        $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 065', PDF_HEADER_STRING);

// set header and footer fonts
        $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
        $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

        // set some language-dependent strings (optional)
        $pdf->setLanguageArray($this->langSettings);

// ---------------------------------------------------------

// set default font subsetting mode
        $pdf->setFontSubsetting(true);

// Set font
        $pdf->SetFont('helvetica', '', 14, '', true);

// Add a page
// This method has several options, check the source code documentation for more information.
        $pdf->AddPage();

// Set some content to print
        $html = <<<EOD
<h1>Example of <a href="http://www.tcpdf.org" style="text-decoration:none;background-color:#CC0000;color:black;">&nbsp;<span style="color:black;">TC</span><span style="color:white;">PDF</span>&nbsp;</a> document in <span style="background-color:#99ccff;color:black;"> PDF/A-1b </span> mode.</h1>
<i>This document conforms to the standard <b>PDF/A-1b (ISO 19005-1:2005)</b>.</i>
<p>Please check the source code documentation and other examples for further information (<a href="http://www.tcpdf.org">http://www.tcpdf.org</a>).</p>
<p style="color:#CC0000;">TO IMPROVE AND EXPAND TCPDF I NEED YOUR SUPPORT, PLEASE <a href="http://sourceforge.net/donate/index.php?group_id=128076">MAKE A DONATION!</a></p>
EOD;

// Print text using writeHTMLCell()
        $pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);

// ---------------------------------------------------------

        //$this->comparePdfs($pdf); we don't use the same font so visual difference is quite big

        $this->tmpFileName = sprintf(__DIR__ . '/example_%s_%s.pdf', static::EXAMPLE_NR, uniqid());
        $this->expectedPdf = sprintf(__DIR__ . '/_expected_pdfs/example_%s.pdf', static::EXAMPLE_NR);

        $pdf->Output($this->tmpFileName, 'F');
        $this->assertFileExists($this->tmpFileName);
    }
}
