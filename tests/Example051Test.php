<?php

class Example051Test extends Common
{

    const EXAMPLE_NR = '051';
    const NR_PDF_PAGES = 3;

    const MEAN_SQUARE_ALLOWED_DIFF = 0.0002;

    public function testPdfOutput()
    {


// create new PDF document
        $pdf = new MYPDF051(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('Nicola Asuni');
        $pdf->SetTitle('TCPDF Example 051');
        $pdf->SetSubject('TCPDF Tutorial');
        $pdf->SetKeywords('TCPDF, PDF, example, test, guide');

// set header and footer fonts
        $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));

// set default monospaced font
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
        $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
        $pdf->SetHeaderMargin(0);
        $pdf->SetFooterMargin(0);

// remove default footer
        $pdf->setPrintFooter(false);

// set auto page breaks
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

        // set some language-dependent strings (optional)
        $pdf->setLanguageArray($this->langSettings);

// ---------------------------------------------------------

// set font
        $pdf->SetFont('times', '', 48);

// add a page
        $pdf->AddPage();

// Print a text
        $html = '<span style="background-color:yellow;color:blue;">&nbsp;PAGE 1&nbsp;</span>
<p stroke="0.2" fill="true" strokecolor="yellow" color="blue" style="font-family:helvetica;font-weight:bold;font-size:26pt;">You can set a full page background.</p>';
        $pdf->writeHTML($html, true, false, true, false, '');


// add a page
        $pdf->AddPage();

// Print a text
        $html = '<span style="background-color:yellow;color:blue;">&nbsp;PAGE 2&nbsp;</span>';
        $pdf->writeHTML($html, true, false, true, false, '');

// --- example with background set on page ---

// remove default header
        $pdf->setPrintHeader(false);

// add a page
        $pdf->AddPage();


// -- set new background ---

// get the current page break margin
        $bMargin = $pdf->getBreakMargin();
// get current auto-page-break mode
        $auto_page_break = $pdf->getAutoPageBreak();
// disable auto-page-break
        $pdf->SetAutoPageBreak(false, 0);
// set bacground image
        $img_file = K_PATH_IMAGES.'image_demo.jpg';
        $pdf->Image($img_file, 0, 0, 210, 297, '', '', '', false, 300, '', false, false, 0);
// restore auto-page-break status
        $pdf->SetAutoPageBreak($auto_page_break, $bMargin);
// set the starting point for the page content
        $pdf->setPageMark();


// Print a text
        $html = '<span style="color:white;text-align:center;font-weight:bold;font-size:80pt;">PAGE 3</span>';
        $pdf->writeHTML($html, true, false, true, false, '');

        $this->comparePdfs($pdf);

    }
}

// Extend the TCPDF class to create custom Header and Footer
class MYPDF051 extends TCPDF {
    //Page header
    public function Header() {
        // get the current page break margin
        $bMargin = $this->getBreakMargin();
        // get current auto-page-break mode
        $auto_page_break = $this->AutoPageBreak;
        // disable auto-page-break
        $this->SetAutoPageBreak(false, 0);
        // set bacground image
        $img_file = K_PATH_IMAGES.'image_demo.jpg';
        $this->Image($img_file, 0, 0, 210, 297, '', '', '', false, 300, '', false, false, 0);
        // restore auto-page-break status
        $this->SetAutoPageBreak($auto_page_break, $bMargin);
        // set the starting point for the page content
        $this->setPageMark();
    }
}
