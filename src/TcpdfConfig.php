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
        ];

        $this->config = $config + $defaultConfig;
    }

    public function getPdfFontNameMain()
    {
        return $this->config['PDF_FONT_NAME_MAIN'];
    }
}
