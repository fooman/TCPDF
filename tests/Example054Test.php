<?php

class Example054Test extends Common
{

    const EXAMPLE_NR = '054';
    const NR_PDF_PAGES = 1;


    public function testPdfOutput()
    {
// create new PDF document
        $pdf = new Fooman\Tcpdf\Tcpdf(self::PDF_PAGE_ORIENTATION, self::PDF_UNIT, self::PDF_PAGE_FORMAT, true, 'UTF-8', false, false, $this->config);

// set document information
        $pdf->SetCreator(self::PDF_CREATOR);
        $pdf->SetAuthor('Nicola Asuni');
        $pdf->SetTitle('TCPDF Example 054');
        $pdf->SetSubject('TCPDF Tutorial');
        $pdf->SetKeywords('TCPDF, PDF, example, test, guide');

// set default header data
        $pdf->SetHeaderData($this->config->getPdfHeaderLogo(), $this->config->getPdfHeaderLogoWidth(), self::PDF_HEADER_TITLE.' 054', self::PDF_HEADER_STRING);

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

// IMPORTANT: disable font subsetting to allow users editing the document
        $pdf->setFontSubsetting(false);

// set font
        $pdf->SetFont('helvetica', '', 10, '', false);

// add a page
        $pdf->AddPage();

// create some HTML content
        $html = <<<EOD
<h1>XHTML Form Example</h1>
<form method="post" action="http://localhost/printvars.php" enctype="multipart/form-data">
<label for="name">name:</label> <input type="text" name="name" value="" size="20" maxlength="30" /><br />
<label for="password">password:</label> <input type="password" name="password" value="" size="20" maxlength="30" /><br /><br />
<label for="infile">file:</label> <input type="file" name="userfile" size="20" /><br /><br />
<input type="checkbox" name="agree" value="1" checked="checked" /> <label for="agree">I agree </label><br /><br />
<input type="radio" name="radioquestion" id="rqa" value="1" /> <label for="rqa">one</label><br />
<input type="radio" name="radioquestion" id="rqb" value="2" checked="checked"/> <label for="rqb">two</label><br />
<input type="radio" name="radioquestion" id="rqc" value="3" /> <label for="rqc">three</label><br /><br />
<label for="selection">select:</label>
<select name="selection" size="0">
    <option value="0">zero</option>
    <option value="1">one</option>
    <option value="2">two</option>
    <option value="3">three</option>
</select><br /><br />
<label for="selection">select:</label>
<select name="multiselection" size="2" multiple="multiple">
    <option value="0">zero</option>
    <option value="1">one</option>
    <option value="2">two</option>
    <option value="3">three</option>
</select><br /><br /><br />
<label for="text">text area:</label><br />
<textarea cols="40" rows="3" name="text">line one
line two</textarea><br />
<br /><br /><br />
<input type="reset" name="reset" value="Reset" />
<input type="submit" name="submit" value="Submit" />
<input type="button" name="print" value="Print" onclick="print()" />
<input type="hidden" name="hiddenfield" value="OK" />
<br />
</form>
EOD;

// output the HTML content
        $pdf->writeHTML($html, true, 0, true, 0);

// reset pointer to the last page
        $pdf->lastPage();

// ---------------------------------------------------------

        $this->comparePdfs($pdf);

    }
}
