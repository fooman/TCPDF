<?php

class Example062Test extends Common
{

    const EXAMPLE_NR = '062';
    const NR_PDF_PAGES = 1;


    public function testPdfOutput()
    {
// create new PDF document
        $pdf = new Fooman\Tcpdf\Tcpdf(self::PDF_PAGE_ORIENTATION, self::PDF_UNIT, self::PDF_PAGE_FORMAT, true, 'UTF-8', false, false, $this->config);

// set document information
        $pdf->SetCreator(self::PDF_CREATOR);
        $pdf->SetAuthor('Nicola Asuni');
        $pdf->SetTitle('TCPDF Example 062');
        $pdf->SetSubject('TCPDF Tutorial');
        $pdf->SetKeywords('TCPDF, PDF, example, test, guide');

// set default header data
        $pdf->SetHeaderData($this->config->getPdfHeaderLogo(), $this->config->getPdfHeaderLogoWidth(), self::PDF_HEADER_TITLE.' 062', self::PDF_HEADER_STRING);

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

        $pdf->Write(0, 'XObject Templates', '', 0, 'C', 1, 0, false, false, 0);

        /*
         * An XObject Template is a PDF block that is a self-contained
         * description of any sequence of graphics objects (including path
         * objects, text objects, and sampled images).
         * An XObject Template may be painted multiple times, either on
         * several pages or at several locations on the same page and produces
         * the same results each time, subject only to the graphics state at
         * the time it is invoked.
         */


// start a new XObject Template and set transparency group option
        $template_id = $pdf->startTemplate(60, 60, true);

// create Template content
// ...................................................................
//Start Graphic Transformation
        $pdf->StartTransform();

// set clipping mask
        $pdf->StarPolygon(30, 30, 29, 10, 3, 0, 1, 'CNZ');

// draw jpeg image to be clipped
        $pdf->Image('tests/images/image_demo.jpg', 0, 0, 60, 60, '', '', '', true, 72, '', false, false, 0, false, false, false);

//Stop Graphic Transformation
        $pdf->StopTransform();

        $pdf->SetXY(0, 0);

        $pdf->SetFont('times', '', 40);

        $pdf->SetTextColor(255, 0, 0);

// print a text
        $pdf->Cell(60, 60, 'Template', 0, 0, 'C', false, '', 0, false, 'T', 'M');
// ...................................................................

// end the current Template
        $pdf->endTemplate();


// print the selected Template various times using various transparencies

        $pdf->SetAlpha(0.4);
        $pdf->printTemplate($template_id, 15, 50, 20, 20, '', '', false);

        $pdf->SetAlpha(0.6);
        $pdf->printTemplate($template_id, 27, 62, 40, 40, '', '', false);

        $pdf->SetAlpha(0.8);
        $pdf->printTemplate($template_id, 55, 85, 60, 60, '', '', false);

        $pdf->SetAlpha(1);
        $pdf->printTemplate($template_id, 95, 125, 80, 80, '', '', false);

// ---------------------------------------------------------
        
        $this->comparePdfs($pdf);

    }
}
