<?php

class Example026Test extends Common
{

    const EXAMPLE_NR = '026';

    public function testPdfOutput()
    {
// create new PDF document
        $pdf = new Fooman\Tcpdf\Tcpdf(self::PDF_PAGE_ORIENTATION, self::PDF_UNIT, self::PDF_PAGE_FORMAT, true, 'UTF-8', false, false, $this->config);

// set document information
        $pdf->SetCreator(self::PDF_CREATOR);
        $pdf->SetAuthor('Nicola Asuni');
        $pdf->SetTitle('TCPDF Example 026');
        $pdf->SetSubject('TCPDF Tutorial');
        $pdf->SetKeywords('TCPDF, PDF, example, test, guide');

// set default header data
        $pdf->SetHeaderData(self::PDF_HEADER_LOGO, self::PDF_HEADER_LOGO_WIDTH, self::PDF_HEADER_TITLE.' 026', self::PDF_HEADER_STRING);

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
        $pdf->SetFont('helvetica', '', 22);

// add a page
        $pdf->AddPage();

// set color for text stroke
        $pdf->SetDrawColor(255,0,0);


        $pdf->setTextRenderingMode($stroke=0, $fill=true, $clip=false);
        $pdf->Write(0, 'Fill text', '', 0, '', true, 0, false, false, 0);

        $pdf->setTextRenderingMode($stroke=0.2, $fill=false, $clip=false);
        $pdf->Write(0, 'Stroke text', '', 0, '', true, 0, false, false, 0);

        $pdf->setTextRenderingMode($stroke=0.2, $fill=true, $clip=false);
        $pdf->Write(0, 'Fill, then stroke text', '', 0, '', true, 0, false, false, 0);

        $pdf->setTextRenderingMode($stroke=0, $fill=false, $clip=false);
        $pdf->Write(0, 'Neither fill nor stroke text (invisible)', '', 0, '', true, 0, false, false, 0);


// * * * CLIPPING MODES  * * * * * * * * * * * * * * * * * *

        $pdf->StartTransform();
        $pdf->setTextRenderingMode($stroke=0, $fill=true, $clip=true);
        $pdf->Write(0, 'Fill text and add to path for clipping', '', 0, '', true, 0, false, false, 0);
        $pdf->Image('tests/images/image_demo.jpg', 15, 65, 170, 10, '', '', '', true, 72);
        $pdf->StopTransform();

        $pdf->StartTransform();
        $pdf->setTextRenderingMode($stroke=0.3, $fill=false, $clip=true);
        $pdf->Write(0, 'Stroke text and add to path for clipping', '', 0, '', true, 0, false, false, 0);
        $pdf->Image('tests/images/image_demo.jpg', 15, 75, 170, 10, '', '', '', true, 72);
        $pdf->StopTransform();

        $pdf->StartTransform();
        $pdf->setTextRenderingMode($stroke=0.3, $fill=true, $clip=true);
        $pdf->Write(0, 'Fill, then stroke text and add to path for clipping', '', 0, '', true, 0, false, false, 0);
        $pdf->Image('tests/images/image_demo.jpg', 15, 85, 170, 10, '', '', '', true, 72);
        $pdf->StopTransform();

        $pdf->StartTransform();
        $pdf->setTextRenderingMode($stroke=0, $fill=false, $clip=true);
        $pdf->Write(0, 'Add text to path for clipping', '', 0, '', true, 0, false, false, 0);
        $pdf->Image('tests/images/image_demo.jpg', 15, 95, 170, 10, '', '', '', true, 72);
        $pdf->StopTransform();

// reset text rendering mode
        $pdf->setTextRenderingMode($stroke=0, $fill=true, $clip=false);

// * * * HTML MODE * * * * * * * * * * * * * * * * * * * * *

// The following attributes were added to HTML:
// stroke : stroke width
// strokecolor : stroke color
// fill : true (default) to fill the font, false otherwise


// create some HTML content with text rendering modes
        $html  = '<span stroke="0" fill="true">HTML Fill text</span><br />';
        $html .= '<span stroke="0.2" fill="false">HTML Stroke text</span><br />';
        $html .= '<span stroke="0.2" fill="true" strokecolor="#FF0000" color="#FFFF00">HTML Fill, then stroke text</span><br />';
        $html .= '<span stroke="0" fill="false">HTML Neither fill nor stroke text (invisible)</span><br />';

// output the HTML content
        $pdf->writeHTML($html, true, 0, true, 0);

        $this->comparePdfs($pdf);

    }
}
