<?php

class Example009Test extends Common
{

    const EXAMPLE_NR = '009';

    const MEAN_SQUARE_ALLOWED_DIFF = 0.00008; //lots of images

    public function testPdfOutput()
    {
// create new PDF document
        $pdf = new Fooman\Tcpdf\Tcpdf(self::PDF_PAGE_ORIENTATION, self::PDF_UNIT, self::PDF_PAGE_FORMAT, true, 'UTF-8', false, false, $this->config);

// set document information
        $pdf->SetCreator(self::PDF_CREATOR);
        $pdf->SetAuthor('Nicola Asuni');
        $pdf->SetTitle('TCPDF Example 009');
        $pdf->SetSubject('TCPDF Tutorial');
        $pdf->SetKeywords('TCPDF, PDF, example, test, guide');

// set default header data
        $pdf->SetHeaderData(self::PDF_HEADER_LOGO, self::PDF_HEADER_LOGO_WIDTH, self::PDF_HEADER_TITLE.' 009', self::PDF_HEADER_STRING);

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

// -------------------------------------------------------------------

// add a page
        $pdf->AddPage();

// set JPEG quality
        $pdf->setJPEGQuality(75);

// Image method signature:
// Image($file, $x='', $y='', $w=0, $h=0, $type='', $link='', $align='', $resize=false, $dpi=300, $palign='', $ismask=false, $imgmask=false, $border=0, $fitbox=false, $hidden=false, $fitonpage=false)

// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -

// Example of Image from data stream ('PHP rules')
        $imgdata = base64_decode('iVBORw0KGgoAAAANSUhEUgAAABwAAAASCAMAAAB/2U7WAAAABlBMVEUAAAD///+l2Z/dAAAASUlEQVR4XqWQUQoAIAxC2/0vXZDrEX4IJTRkb7lobNUStXsB0jIXIAMSsQnWlsV+wULF4Avk9fLq2r8a5HSE35Q3eO2XP1A1wQkZSgETvDtKdQAAAABJRU5ErkJggg==');

// The '@' character is used to indicate that follows an image data stream and not an image file name
        $pdf->Image('@'.$imgdata);

// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -

// Image example with resizing
        $pdf->Image('./tests/images/image_demo.jpg', 15, 140, 75, 113, 'JPG', 'http://www.tcpdf.org', '', true, 150, '', false, false, 1, false, false, false);

// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -

// test fitbox with all alignment combinations

        $horizontal_alignments = array('L', 'C', 'R');
        $vertical_alignments = array('T', 'M', 'B');

        $x = 15;
        $y = 35;
        $w = 30;
        $h = 30;
// test all combinations of alignments
        for ($i = 0; $i < 3; ++$i) {
            $fitbox = $horizontal_alignments[$i].' ';
            $x = 15;
            for ($j = 0; $j < 3; ++$j) {
                $fitbox[1] = $vertical_alignments[$j];
                $pdf->Rect($x, $y, $w, $h, 'F', array(), array(128,255,128));
                $pdf->Image('./tests/images/image_demo.jpg', $x, $y, $w, $h, 'JPG', '', '', false, 300, '', false, false, 0, $fitbox, false, false);
                $x += 32; // new column
            }
            $y += 32; // new row
        }

        $x = 115;
        $y = 35;
        $w = 25;
        $h = 50;
        for ($i = 0; $i < 3; ++$i) {
            $fitbox = $horizontal_alignments[$i].' ';
            $x = 115;
            for ($j = 0; $j < 3; ++$j) {
                $fitbox[1] = $vertical_alignments[$j];
                $pdf->Rect($x, $y, $w, $h, 'F', array(), array(128,255,255));
                $pdf->Image('./tests/images/image_demo.jpg', $x, $y, $w, $h, 'JPG', '', '', false, 300, '', false, false, 0, $fitbox, false, false);
                $x += 27; // new column
            }
            $y += 52; // new row
        }

// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -

// Stretching, position and alignment example

        $pdf->SetXY(110, 200);
        $pdf->Image('./tests/images/image_demo.jpg', '', '', 40, 40, '', '', 'T', false, 300, '', false, false, 1, false, false, false);
        $pdf->Image('./tests/images/image_demo.jpg', '', '', 40, 40, '', '', '', false, 300, '', false, false, 1, false, false, false);

        $this->comparePdfs($pdf);

    }


}
