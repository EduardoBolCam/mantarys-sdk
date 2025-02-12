<?php

namespace DevDizs\MantarysSdk\Handlers;

class Config
{
    protected $config;

    public function __construct()
    {
        // Load default configuration
        $defaultConfig = require __DIR__ . '/../../config/mantarys.php';

        $publishedConfigPath = getcwd() . '/config/mantarys.php';
        $publishedConfig = file_exists( $publishedConfigPath ) ? require $publishedConfigPath : [];

        $this->config = array_merge( $defaultConfig, $publishedConfig );
    }

    public function getConfig( $key )
    {
        return $this->config[ $key ] ?? null;
    }
}