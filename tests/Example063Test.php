<?php

class Example063Test extends Common
{

    const EXAMPLE_NR = '063';
    const NR_PDF_PAGES = 10;


    public function testPdfOutput()
    {
// create new PDF document
        $pdf = new Fooman\Tcpdf\Tcpdf(self::PDF_PAGE_ORIENTATION, self::PDF_UNIT, self::PDF_PAGE_FORMAT, true, 'UTF-8', false, false, $this->config);

// set document information
        $pdf->SetCreator(self::PDF_CREATOR);
        $pdf->SetAuthor('Nicola Asuni');
        $pdf->SetTitle('TCPDF Example 063');
        $pdf->SetSubject('TCPDF Tutorial');
        $pdf->SetKeywords('TCPDF, PDF, example, test, guide');

// set default header data
        $pdf->SetHeaderData($this->config->getPdfHeaderLogo(), $this->config->getPdfHeaderLogoWidth(), self::PDF_HEADER_TITLE.' 063', self::PDF_HEADER_STRING);

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
        $pdf->SetFont('helvetica', 'B', 16);

// add a page
        $pdf->AddPage();

        $pdf->Write(0, 'Example of Text Stretching and Spacing (tracking)', '', 0, 'L', true, 0, false, false, 0);
        $pdf->Ln(5);

// create several cells to display all cases of stretching and spacing combinations.

        $fonts = array('times', 'dejavuserif');
        $alignments = array('L' => 'LEFT', 'C' => 'CENTER', 'R' => 'RIGHT', 'J' => 'JUSTIFY');


// Test all cases using direct stretching/spacing methods
        foreach ($fonts as $fkey => $font) {
            $pdf->SetFont($font, '', 14);
            foreach ($alignments as $align_mode => $align_name) {
                for ($stretching = 90; $stretching <= 110; $stretching += 10) {
                    for ($spacing = -0.254; $spacing <= 0.254; $spacing += 0.254) {
                        $pdf->setFontStretching($stretching);
                        $pdf->setFontSpacing($spacing);
                        $txt = $align_name.' | Stretching = '.$stretching.'% | Spacing = '.sprintf('%+.3F', $spacing).'mm';
                        $pdf->Cell(0, 0, $txt, 1, 1, $align_mode);
                    }
                }
            }
            $pdf->AddPage();
        }


// Test all cases using CSS stretching/spacing properties
        foreach ($fonts as $fkey => $font) {
            $pdf->SetFont($font, '', 11);
            foreach ($alignments as $align_mode => $align_name) {
                for ($stretching = 90; $stretching <= 110; $stretching += 10) {
                    for ($spacing = -0.254; $spacing <= 0.254; $spacing += 0.254) {
                        $html = '<span style="font-stretch:'.$stretching.'%;letter-spacing:'.$spacing.'mm;"><span style="color:red;">'.$align_name.'</span> | <span style="color:green;">Stretching = '.$stretching.'%</span> | <span style="color:blue;">Spacing = '.sprintf('%+.3F', $spacing).'mm</span><br />Lorem ipsum dolor sit amet, consectetur adipiscing elit. In sed imperdiet lectus. Phasellus quis velit velit, non condimentum quam. Sed neque urna, ultrices ac volutpat vel, laoreet vitae augue. Sed vel velit erat. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos.</span>';
                        $pdf->writeHTMLCell(0, 0, '', '', $html, 1, 1, false, true, $align_mode, false);
                    }
                }
                if (!(($fkey == 1) AND ($align_mode == 'J'))) {
                    $pdf->AddPage();
                }
            }
        }


// reset font stretching
        $pdf->setFontStretching(100);

// reset font spacing
        $pdf->setFontSpacing(0);

// ---------------------------------------------------------
        $this->comparePdfs($pdf);

    }
}
