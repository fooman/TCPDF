<?php

class Common extends \PHPUnit\Framework\TestCase
{

    protected $tmpFileName = false;
    protected $expectedPdf;

    protected $config;

    const MEAN_SQUARE_ALLOWED_DIFF = 0.00003;

    const EXAMPLE_NR = '';
    const NR_PDF_PAGES = 1;

    const PDF_PAGE_ORIENTATION = 'P';
    const PDF_UNIT = 'mm';
    const PDF_PAGE_FORMAT ='A4';
    const PDF_CREATOR = 'TCPDF';
    const PDF_HEADER_LOGO = 'tcpdf_logo.jpg';
    const PDF_HEADER_LOGO_WIDTH = 30;
    const PDF_HEADER_TITLE = 'TCPDF Example';
    const PDF_HEADER_STRING = "by Nicola Asuni - Tecnick.com\nwww.tcpdf.org";

    const PDF_FONT_NAME_MAIN = 'helvetica';
    const PDF_FONT_SIZE_MAIN = 10;
    const PDF_FONT_NAME_DATA ='helvetica';
    const PDF_FONT_SIZE_DATA = 8;
    const PDF_FONT_MONOSPACED = 'courier';

    const PDF_MARGIN_HEADER = 5;
    const PDF_MARGIN_FOOTER = 10;
    const PDF_MARGIN_TOP = 27;
    const PDF_MARGIN_BOTTOM =25;
    const PDF_MARGIN_LEFT = 15;
    const PDF_MARGIN_RIGHT =15;

    const PDF_IMAGE_SCALE_RATIO = 1.25;

    protected $langSettings = [
            'a_meta_charset'  => 'UTF-8',
            'a_meta_dir'      => 'ltr',
            'a_meta_language' => 'en',
            'w_page'          => 'page'
        ];

    protected function setUp()
    {
        $this->tmpFileName = sprintf(__DIR__ . '/example_%s_%s.pdf', static::EXAMPLE_NR, uniqid());
        $this->expectedPdf = sprintf(__DIR__ . '/_expected_pdfs/example_%s.pdf', static::EXAMPLE_NR);
        $this->config = new \Fooman\Tcpdf\TcpdfConfig(
            [
                'PDF_HEADER_LOGO'=> self::PDF_HEADER_LOGO,
                'K_PATH_IMAGES'=>__DIR__ .'/images/',
                'K_PATH_CACHE' => sys_get_temp_dir().'/',
                'K_CELL_HEIGHT_RATIO' => 1.25,
                'HEAD_MAGNIFICATION' => 1.1,
                'K_TITLE_MAGNIFICATION'=> 1.3
            ]
        );
    }


    public function comparePdfs($pdf)
    {
        $pdf->Output($this->tmpFileName, 'F');
        $this->_comparePdfs($this->tmpFileName, $this->expectedPdf, static::NR_PDF_PAGES);
    }

    protected function _comparePdfs($actual, $expected, $pages)
    {
        for ($i = 0; $i < $pages; $i++) {
            $actualPage = $this->_pdfPageToImage($actual, $i);
            $expectedPage = $this->_pdfPageToImage($expected, $i);
            $result = $actualPage->compareImages($expectedPage, \Imagick::METRIC_MEANSQUAREERROR);
            $this->assertTrue(
                $result[1] < static::MEAN_SQUARE_ALLOWED_DIFF, 'Mean Square Error in page comparison ' . $result[1] . ' on page ' . ($i + 1)
            );
        }
        $this->removeTmpFile();
    }

    protected function _pdfPageToImage($input, $page)
    {
        $path = $input . '[' . $page . ']';
        if (!extension_loaded('imagick')) {
            $this->markTestIncomplete('The Php Imagick extension is needed to perform this test');
        }
        $image = new \Imagick();
        $image->readImage($path);
        return $image;
    }

    /**
     *
     */
    public function removeTmpFile()
    {
        if ($this->tmpFileName && file_exists($this->tmpFileName)) {
            unlink($this->tmpFileName);
        }
    }

    public function tearDown()
    {
        //$this->removeTmpFile();
    }

}
