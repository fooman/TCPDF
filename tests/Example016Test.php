<?php

class Example016Test extends Common
{

    const EXAMPLE_NR = '016';

    public function testPdfOutput()
    {
// create new PDF document
        $pdf = new Fooman\Tcpdf\Tcpdf(self::PDF_PAGE_ORIENTATION, self::PDF_UNIT, self::PDF_PAGE_FORMAT, true, 'UTF-8', false, false, $this->config);


// *** Set PDF protection (encryption) *********************

        /*
          The permission array is composed of values taken from the following ones (specify the ones you want to block):
            - print : Print the document;
            - modify : Modify the contents of the document by operations other than those controlled by 'fill-forms', 'extract' and 'assemble';
            - copy : Copy or otherwise extract text and graphics from the document;
            - annot-forms : Add or modify text annotations, fill in interactive form fields, and, if 'modify' is also set, create or modify interactive form fields (including signature fields);
            - fill-forms : Fill in existing interactive form fields (including signature fields), even if 'annot-forms' is not specified;
            - extract : Extract text and graphics (in support of accessibility to users with disabilities or for other purposes);
            - assemble : Assemble the document (insert, rotate, or delete pages and create bookmarks or thumbnail images), even if 'modify' is not set;
            - print-high : Print the document to a representation from which a faithful digital copy of the PDF content could be generated. When this is not set, printing is limited to a low-level representation of the appearance, possibly of degraded quality.
            - owner : (inverted logic - only for public-key) when set permits change of encryption and enables all other permissions.

         If you don't set any password, the document will open as usual.
         If you set a user password, the PDF viewer will ask for it before displaying the document.
         The master (owner) password, if different from the user one, can be used to get full document access.

         Possible encryption modes are:
             0 = RSA 40 bit
             1 = RSA 128 bit
             2 = AES 128 bit
             3 = AES 256 bit

         NOTES:
         - To create self-signed signature: openssl req -x509 -nodes -days 365000 -newkey rsa:1024 -keyout tcpdf.crt -out tcpdf.crt
         - To export crt to p12: openssl pkcs12 -export -in tcpdf.crt -out tcpdf.p12
         - To convert pfx certificate to pem: openssl pkcs12 -in tcpdf.pfx -out tcpdf.crt -nodes

        */

        $pdf->SetProtection(array('print', 'copy'), '', null, 0, null);

// Example with public-key
// To open the document you need to install the private key (tcpdf.p12) on the Acrobat Reader. The password is: 1234
//$pdf->SetProtection($permissions=array('print', 'copy'), $user_pass='', $owner_pass=null, $mode=1, $pubkeys=array(array('c' => 'file://../config/cert/tcpdf.crt', 'p' => array('print'))));

// *********************************************************


// set document information
        $pdf->SetCreator(self::PDF_CREATOR);
        $pdf->SetAuthor('Nicola Asuni');
        $pdf->SetTitle('TCPDF Example 016');
        $pdf->SetSubject('TCPDF Tutorial');
        $pdf->SetKeywords('TCPDF, PDF, example, test, guide');

// set default header data
        $pdf->SetHeaderData($this->config->getPdfHeaderLogo(), $this->config->getPdfHeaderLogoWidth(), self::PDF_HEADER_TITLE.' 016', self::PDF_HEADER_STRING);

// set header and footer fonts
        $pdf->setHeaderFont(Array('helvetica', '', self::PDF_FONT_SIZE_MAIN));
        $pdf->setFooterFont(Array('helvetica', '', self::PDF_FONT_SIZE_DATA));

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
        $pdf->SetFont('times', '', 16);

// add a page
        $pdf->AddPage();

// set some text to print
        $txt = <<<EOD
Encryption Example

Consult the source code documentation for the SetProtection() method.
EOD;

// print a block of text using Write()
        $pdf->Write(0, $txt, '', 0, 'L', true, 0, false, false, 0);

        $this->comparePdfs($pdf);

    }
}

