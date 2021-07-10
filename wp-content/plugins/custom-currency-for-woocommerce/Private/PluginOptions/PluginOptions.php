<?php

namespace IamProgrammerLK\CustomCurrencyForWooCommerce\PluginOptions;

// If this file is called directly, abort. for the security purpose.
if ( ! defined( 'WPINC' ) )
{
    die; 
}

class PluginOptions
{

    private static $instance = null;
    private $pluginOptions   = [];

    private function __construct()
    {
        $this->pluginOptions = include_once 'DefaultPluginOptions.php';
    }

    public function getPluginOptions()
    {
        return $this->pluginOptions;
    }

    public static function getInstance()
    {
        if( ! self::$instance )
        {
            self::$instance = new PluginOptions();
        }
        return self::$instance;
    }

}