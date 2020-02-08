<?php

class Example047Test extends Common
{

    const EXAMPLE_NR = '047';
    const NR_PDF_PAGES = 1;

    public function testPdfOutput()
    {
// create new PDF document
        $pdf = new Fooman\Tcpdf\Tcpdf(self::PDF_PAGE_ORIENTATION, self::PDF_UNIT, self::PDF_PAGE_FORMAT, true, 'UTF-8', false, false, $this->config);

// set document information
        $pdf->SetCreator(self::PDF_CREATOR);
        $pdf->SetAuthor('Nicola Asuni');
        $pdf->SetTitle('TCPDF Example 047');
        $pdf->SetSubject('TCPDF Tutorial');
        $pdf->SetKeywords('TCPDF, PDF, example, test, guide');

// set default header data
        $pdf->SetHeaderData($this->config->getPdfHeaderLogo(), $this->config->getPdfHeaderLogoWidth(), self::PDF_HEADER_TITLE.' 047', self::PDF_HEADER_STRING);

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
        $pdf->SetFont('helvetica', '', 16);

// add a page
        $pdf->AddPage();

        $txt = 'Example of Transactions.
TCPDF allows you to undo some operations using the Transactions.
Check the source code for further information.';
        $pdf->Write(0, $txt, '', 0, 'L', true, 0, false, false, 0);

        $pdf->Ln(5);

        $pdf->SetFont('times', '', 12);

// start transaction
        $pdf->startTransaction();

        $pdf->Write(0, "LINE 1\n");
        $pdf->Write(0, "LINE 2\n");

// restarts transaction
        $pdf->startTransaction();

        $pdf->Write(0, "LINE 3\n");
        $pdf->Write(0, "LINE 4\n");

// rolls back to the last (re)start
        $pdf = $pdf->rollbackTransaction();

        $pdf->Write(0, "LINE 5\n");
        $pdf->Write(0, "LINE 6\n");

// start transaction
        $pdf->startTransaction();

        $pdf->Write(0, "LINE 7\n");

// commit transaction (actually just frees memory)
        $pdf->commitTransaction();



        $this->comparePdfs($pdf);

    }
}
