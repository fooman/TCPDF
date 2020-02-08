<?php

class Example053Test extends Common
{

    const EXAMPLE_NR = '053';
    const NR_PDF_PAGES = 1;


    public function testPdfOutput()
    {

// create new PDF document
        $pdf = new Fooman\Tcpdf\Tcpdf(self::PDF_PAGE_ORIENTATION, self::PDF_UNIT, self::PDF_PAGE_FORMAT, true, 'UTF-8', false, false, $this->config);

// set document information
        $pdf->SetCreator(self::PDF_CREATOR);
        $pdf->SetAuthor('Nicola Asuni');
        $pdf->SetTitle('TCPDF Example 053');
        $pdf->SetSubject('TCPDF Tutorial');
        $pdf->SetKeywords('TCPDF, PDF, example, test, guide');

// set default header data
        $pdf->SetHeaderData($this->config->getPdfHeaderLogo(), $this->config->getPdfHeaderLogoWidth(), self::PDF_HEADER_TITLE.' 053', self::PDF_HEADER_STRING);

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
        $pdf->SetFont('times', '', 14);

// add a page
        $pdf->AddPage();

// print a some of text
        $text = 'This is an example of <strong>JavaScript</strong> usage on PDF documents.<br /><br />For more information check the source code of this example, the source code documentation for the <i>IncludeJS()</i> method and the <i>JavaScript for Acrobat API Reference</i> guide.<br /><br /><a href="http://www.tcpdf.org">www.tcpdf.org</a>';
        $pdf->writeHTML($text, true, 0, true, 0);

// write some JavaScript code
        $js = <<<EOD
app.alert('JavaScript Popup Example', 3, 0, 'Welcome');
var cResponse = app.response({
    cQuestion: 'How are you today?',
    cTitle: 'Your Health Status',
    cDefault: 'Fine',
    cLabel: 'Response:'
});
if (cResponse == null) {
    app.alert('Thanks for trying anyway.', 3, 0, 'Result');
} else {
    app.alert('You responded, "'+cResponse+'", to the health question.', 3, 0, 'Result');
}
EOD;

// force print dialog
        $js .= 'print(true);';

// set javascript
        $pdf->IncludeJS($js);

// ---------------------------------------------------------


        $this->comparePdfs($pdf);

    }
}
