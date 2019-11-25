<?php

class Example024Test extends Common
{

    const EXAMPLE_NR = '024';

    public function testPdfOutput()
    {
// create new PDF document
        $pdf = new Fooman\Tcpdf\Tcpdf(self::PDF_PAGE_ORIENTATION, self::PDF_UNIT, self::PDF_PAGE_FORMAT, true, 'UTF-8', false, false, $this->config);

// set document information
        $pdf->SetCreator(self::PDF_CREATOR);
        $pdf->SetAuthor('Nicola Asuni');
        $pdf->SetTitle('TCPDF Example 024');
        $pdf->SetSubject('TCPDF Tutorial');
        $pdf->SetKeywords('TCPDF, PDF, example, test, guide');

// set default header data
        $pdf->SetHeaderData(self::PDF_HEADER_LOGO, self::PDF_HEADER_LOGO_WIDTH, self::PDF_HEADER_TITLE.' 024', self::PDF_HEADER_STRING);

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
        $pdf->SetFont('times', '', 18);

// add a page
        $pdf->AddPage();

        /*
         * setVisibility() allows to restrict the rendering of some
         * elements to screen or printout. This can be useful, for
         * instance, to put a background image or color that will
         * show on screen but won't print.
         */

        $txt = 'You can limit the visibility of PDF objects to screen or printer by using the setVisibility() method.
Check the print preview of this document to display the alternative text.';

        $pdf->Write(0, $txt, '', 0, '', true, 0, false, false, 0);

// change font size
        $pdf->SetFontSize(40);

// change text color
        $pdf->SetTextColor(0,63,127);

// set visibility only for screen
        $pdf->setVisibility('screen');

// write something only for screen
        $pdf->Write(0, '[This line is for display]', '', 0, 'C', true, 0, false, false, 0);

// set visibility only for print
        $pdf->setVisibility('print');

// change text color
        $pdf->SetTextColor(127,0,0);

// write something only for print
        $pdf->Write(0, '[This line is for printout]', '', 0, 'C', true, 0, false, false, 0);

// restore visibility
        $pdf->setVisibility('all');

// ---------------------------------------------------------

// LAYERS

// start a new layer
        $pdf->startLayer('layer1', true, true);

// change font size
        $pdf->SetFontSize(18);

// change text color
        $pdf->SetTextColor(0,127,0);

        $txt = 'Using the startLayer() method you can group PDF objects into layers.
This text is on "layer1".';

// write something
        $pdf->Write(0, $txt, '', 0, 'L', true, 0, false, false, 0);

// close the current layer
        $pdf->endLayer();

        $this->comparePdfs($pdf);

    }
}
