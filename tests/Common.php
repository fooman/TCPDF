<?php

class Common extends \PHPUnit\Framework\TestCase
{

    protected $tmpFileName = false;

    const MEAN_SQUARE_ALLOWED_DIFF = 0.00003;

    const EXAMPLE_NR = '';
    const NR_PDF_PAGES = 1;

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
