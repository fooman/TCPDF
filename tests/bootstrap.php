<?php

require_once('tcpdf_config.php');
require_once('Common.php');

call_user_func(
    function () {
        if (!is_file($autoloadFile = __DIR__ . '/../vendor/autoload.php')) {
            throw new \RuntimeException('Did not find vendor/autoload.php. Did you run "composer install"?');
        }

        require_once $autoloadFile;

    }
);
