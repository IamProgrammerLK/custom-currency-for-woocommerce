<?php

namespace IamProgrammerLK\CustomCurrencyForWooCommerce;

use IamProgrammerLK\PluginPressAPI\PluginPressAPI;

// If this file is called directly, abort. for the security purpose.
if( ! defined( 'WPINC' ) )
{
    die;
}

class CustomCurrencyForWooCommerce extends PluginPressAPI
{

    public function __construct( string $plugin_file_path, string $config_file_path )
    {
        parent::__construct( $plugin_file_path, $config_file_path );
    }

    public function init()
    {
        // triggers when the plugin is activated. If a plugin is silently activated (such as during an update), this hook does not fire.
        add_action( 'activation_hook_' . $this->plugin_options->get( 'plugin_slug' ), [ $this, 'activation_hook'] );
        // triggers when the plugin is deactivated. If a plugin is silently deactivated (such as during an update), this hook does not fire.
        add_action( 'deactivation_hook_' . $this->plugin_options->get( 'plugin_slug' ), [ $this, 'deactivation_hook'] );
        
        ( new CreateAdminPages( $this->plugin_options ) )->init();
    }

    // triggers when the plugin is activated. If a plugin is silently activated (such as during an update), this hook does not fire.
    public function activation_hook()
    {
        ( new PluginActivationSequence( $this->plugin_options ) )->init();
    }

    // triggers when the plugin is deactivated. If a plugin is silently deactivated (such as during an update), this hook does not fire.
    public function deactivation_hook()
    {
        ( new PluginDeactivationSequence( $this->plugin_options ) )->init();
    }

}
