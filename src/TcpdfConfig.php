<?php

namespace Fooman\Tcpdf;

class TcpdfConfig
{
    private $config = [];

    public function __construct(array $config) 
    {
        $this->config = $config;

        $defaultConfig = [
            'PDF_FONT_NAME_MAIN' => 'helvetica',
            'K_TCPDF_EXTERNAL_CONFIG' => true,
            'PDF_HEADER_LOGO' => '',
            'PDF_HEADER_LOGO_WIDTH' => 30,
            'K_BLANK_IMAGE' => '_blank.png',
            'K_TCPDF_CALLS_IN_HTML' => true,
            'K_TCPDF_THROW_EXCEPTION_ERROR' => true,
            'K_PATH_MAIN' => __DIR__ .'/',
            'K_THAI_TOPCHARS' => true,
            'K_SMALL_RATIO' => 2/3
        ];

        $this->config = $config + $defaultConfig;
    }

    public function getKPathCache()
    {
        $kPathCache = ini_get('upload_tmp_dir') ? ini_get('upload_tmp_dir') : sys_get_temp_dir();
        if (substr($kPathCache, -1) != '/') {
            $kPathCache .= '/';
        }
        return $kPathCache;
    }

    public function getPdfFontNameMain()
    {
        return $this->config['PDF_FONT_NAME_MAIN'];
    }

    public function getKPathMain()
    {
        return $this->config['K_PATH_MAIN'];
    }

    public function getKPathUrl()
    {
        return $this->getKPathMain();
    }

    public function getKBlankImage()
    {
        return $this->config['K_BLANK_IMAGE'];
    }

    public function getKThaiTopchars()
    {
        return $this->config['K_THAI_TOPCHARS'];
    }

    public function getKTcpdfCallsInHtml()
    {
        return $this->config['K_TCPDF_CALLS_IN_HTML'];
    }

    public function getKSmallRatio()
    {
        return $this->config['K_SMALL_RATIO'];
    }

    public function getKPathImages()
    {
        $kPathMain = $this->getKPathMain();
        $tcpdfImagesDirs = array(
            $kPathMain . 'examples/images/',
            $kPathMain . 'images/',
            '/usr/share/doc/php-tcpdf/examples/images/',
            '/usr/share/doc/tcpdf/examples/images/',
            '/usr/share/doc/php/tcpdf/examples/images/',
            '/var/www/tcpdf/images/',
            '/var/www/html/tcpdf/images/',
            '/usr/local/apache2/htdocs/tcpdf/images/',
            $kPathMain
        );

        foreach ($tcpdfImagesDirs as $tcpdfImagesDir) {
            if (@file_exists($tcpdfImagesDir)) {
                return $tcpdfImagesDir;
            }
        }
    }
}
