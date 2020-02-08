<?php

class Example042Test extends Common
{

    const EXAMPLE_NR = '042';
    const MEAN_SQUARE_ALLOWED_DIFF = 0.00008;
    //TODO check transparency ->shadow

    public function testPdfOutput()
    {
        $this->markTestIncomplete(
            'Travis failure needs further investigation. '
        );

// create new PDF document
        $pdf = new Fooman\Tcpdf\Tcpdf(self::PDF_PAGE_ORIENTATION, self::PDF_UNIT, self::PDF_PAGE_FORMAT, true, 'UTF-8', false, false, $this->config);

// set document information
        $pdf->SetCreator(self::PDF_CREATOR);
        $pdf->SetAuthor('Nicola Asuni');
        $pdf->SetTitle('TCPDF Example 042');
        $pdf->SetSubject('TCPDF Tutorial');
        $pdf->SetKeywords('TCPDF, PDF, example, test, guide');

// set default header data
        $pdf->SetHeaderData($this->config->getPdfHeaderLogo(), $this->config->getPdfHeaderLogoWidth(), self::PDF_HEADER_TITLE.' 042', self::PDF_HEADER_STRING);

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

// set JPEG quality
//$pdf->setJPEGQuality(75);

        $pdf->SetFont('helvetica', '', 18);

// add a page
        $pdf->AddPage();

// create background text
        $background_text = str_repeat('TCPDF test PNG Alpha Channel ', 50);
        $pdf->MultiCell(0, 5, $background_text, 0, 'J', 0, 2, '', '', true, 0, false);

// --- Method (A) ------------------------------------------
// the Image() method recognizes the alpha channel embedded on the image:
        $pdf->SetAlpha(0.71);
        $pdf->Image('tests/images/image_with_alpha.png', 50, 50, 100, '', '', 'http://www.tcpdf.org', '', false, 300);
        $pdf->SetAlpha(1);

// --- Method (B) ------------------------------------------
// provide image + separate 8-bit mask

// first embed mask image (w, h, x and y will be ignored, the image will be scaled to the target image's size)
        $mask = $pdf->Image('tests/images/alpha.png', 50, 140, 100, '', '', '', '', false, 300, '', true);

// embed image, masked with previously embedded mask
        $pdf->Image('tests/images/img.png', 50, 140, 100, '', '', 'http://www.tcpdf.org', '', false, 300, '', false, $mask);


        $this->comparePdfs($pdf);

    }
}
