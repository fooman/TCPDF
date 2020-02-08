<?php

class Example050Test extends Common
{

    const EXAMPLE_NR = '050';
    const NR_PDF_PAGES = 1;

    public function testPdfOutput()
    {

        $this->markTestIncomplete('QRCODE uses a random mask which can\'t be set.');


// create new PDF document
        $pdf = new Fooman\Tcpdf\Tcpdf(self::PDF_PAGE_ORIENTATION, self::PDF_UNIT, self::PDF_PAGE_FORMAT, true, 'UTF-8', false, false, $this->config);

// set document information
        $pdf->SetCreator(self::PDF_CREATOR);
        $pdf->SetAuthor('Nicola Asuni');
        $pdf->SetTitle('TCPDF Example 050');
        $pdf->SetSubject('TCPDF Tutorial');
        $pdf->SetKeywords('TCPDF, PDF, example, test, guide');

// set default header data
        $pdf->SetHeaderData($this->config->getPdfHeaderLogo(), $this->config->getPdfHeaderLogoWidth(), self::PDF_HEADER_TITLE.' 050', self::PDF_HEADER_STRING);

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

// NOTE: 2D barcode algorithms must be implemented on 2dbarcode.php class file.

// set font
        $pdf->SetFont('helvetica', '', 11);

// add a page
        $pdf->AddPage();

// print a message
        $txt = "You can also export 2D Barcodes in other formats (PNG, SVG, HTML). Check the examples inside the barcode directory.\n";
        $pdf->MultiCell(70, 50, $txt, 0, 'J', false, 1, 125, 30, true, 0, false, true, 0, 'T', false);


        $pdf->SetFont('helvetica', '', 10);

// - - - - - - - - - - - - - - - - - - - - - - - - - - - - -

// set style for barcode
        $style = array(
            'border' => true,
            'vpadding' => 'auto',
            'hpadding' => 'auto',
            'fgcolor' => array(0,0,0),
            'bgcolor' => false, //array(255,255,255)
            'module_width' => 1, // width of a single module in points
            'module_height' => 1 // height of a single module in points
        );

// write RAW 2D Barcode

        $code = '111011101110111,010010001000010,010011001110010,010010000010010,010011101110010';
        $pdf->write2DBarcode($code, 'RAW', 80, 30, 30, 20, $style, 'N');

// write RAW2 2D Barcode
        $code = '[111011101110111][010010001000010][010011001110010][010010000010010][010011101110010]';
        $pdf->write2DBarcode($code, 'RAW2', 80, 60, 30, 20, $style, 'N');

// - - - - - - - - - - - - - - - - - - - - - - - - - - - - -

// set style for barcode
        $style = array(
            'border' => 2,
            'vpadding' => 'auto',
            'hpadding' => 'auto',
            'fgcolor' => array(0,0,0),
            'bgcolor' => false, //array(255,255,255)
            'module_width' => 1, // width of a single module in points
            'module_height' => 1 // height of a single module in points
        );

// QRCODE,L : QR-CODE Low error correction
        $pdf->write2DBarcode('www.tcpdf.org', 'QRCODE,L', 20, 30, 50, 50, $style, 'N');
        $pdf->Text(20, 25, 'QRCODE L');

// QRCODE,M : QR-CODE Medium error correction
        $pdf->write2DBarcode('www.tcpdf.org', 'QRCODE,M', 20, 90, 50, 50, $style, 'N');
        $pdf->Text(20, 85, 'QRCODE M');

// QRCODE,Q : QR-CODE Better error correction
        $pdf->write2DBarcode('www.tcpdf.org', 'QRCODE,Q', 20, 150, 50, 50, $style, 'N');
        $pdf->Text(20, 145, 'QRCODE Q');

// QRCODE,H : QR-CODE Best error correction
        $pdf->write2DBarcode('www.tcpdf.org', 'QRCODE,H', 20, 210, 50, 50, $style, 'N');
        $pdf->Text(20, 205, 'QRCODE H');

// -------------------------------------------------------------------
// PDF417 (ISO/IEC 15438:2006)

        /*

         The $type parameter can be simple 'PDF417' or 'PDF417' followed by a
         number of comma-separated options:

         'PDF417,a,e,t,s,f,o0,o1,o2,o3,o4,o5,o6'

         Possible options are:

             a  = aspect ratio (width/height);
             e  = error correction level (0-8);

             Macro Control Block options:

             t  = total number of macro segments;
             s  = macro segment index (0-99998);
             f  = file ID;
             o0 = File Name (text);
             o1 = Segment Count (numeric);
             o2 = Time Stamp (numeric);
             o3 = Sender (text);
             o4 = Addressee (text);
             o5 = File Size (numeric);
             o6 = Checksum (numeric).

         Parameters t, s and f are required for a Macro Control Block, all other parametrs are optional.
         To use a comma character ',' on text options, replace it with the character 255: "\xff".

        */

        $pdf->write2DBarcode('www.tcpdf.org', 'PDF417', 80, 90, 0, 30, $style, 'N');
        $pdf->Text(80, 85, 'PDF417 (ISO/IEC 15438:2006)');

// -------------------------------------------------------------------
// DATAMATRIX (ISO/IEC 16022:2006)

        $pdf->write2DBarcode('http://www.tcpdf.org', 'DATAMATRIX', 80, 150, 50, 50, $style, 'N');
        $pdf->Text(80, 145, 'DATAMATRIX (ISO/IEC 16022:2006)');

// -------------------------------------------------------------------

// new style
        $style = array(
            'border' => 2,
            'padding' => 'auto',
            'fgcolor' => array(0,0,255),
            'bgcolor' => array(255,255,64)
        );

// QRCODE,H : QR-CODE Best error correction
        $pdf->write2DBarcode('www.tcpdf.org', 'QRCODE,H', 80, 210, 50, 50, $style, 'N');
        $pdf->Text(80, 205, 'QRCODE H - COLORED');

// new style
        $style = array(
            'border' => false,
            'padding' => 0,
            'fgcolor' => array(128,0,0),
            'bgcolor' => false
        );

// QRCODE,H : QR-CODE Best error correction
        $pdf->write2DBarcode('www.tcpdf.org', 'QRCODE,H', 140, 210, 50, 50, $style, 'N');
        $pdf->Text(140, 205, 'QRCODE H - NO PADDING');

// ---------------------------------------------------------

        $this->comparePdfs($pdf);

    }
}
