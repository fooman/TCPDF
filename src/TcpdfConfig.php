<?php

namespace Fooman\Tcpdf;

class TcpdfConfig
{
    private $config = [];

    public function __construct(array $config) 
    {
        $this->config = $config;

        $defaultConfig = [
            'PDF_FONT_NAME_MAIN' => 'helvetica'
        ];

        $this->config = $config + $defaultConfig;
    }

    public function getPdfFontNameMain()
    {
        return $this->config['PDF_FONT_NAME_MAIN'];
    }
}