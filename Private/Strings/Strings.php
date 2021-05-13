<?php

namespace IamProgrammerLK\CustomCurrencyForWooCommerce\Strings;

// If this file is called directly, abort. for the security purpose.
if( ! defined( 'WPINC' ) )
{
    die;
}

class Strings
{

    private $PluginOptions;
    private $strings = [];

    public function __construct( $PluginOptions )
    {
        $this->PluginOptions = $PluginOptions;
        $this->setStrings;

    }

    public function init()
    {
        add_filter( 'plugin_action_links_' . $this->PluginOptions[ 'basename' ], [ $this , 'renderPluginsPageLinks' ] );
        add_filter( 'plugin_row_meta', [ $this , 'renderPluginRowMetaLinks'], 10, 2 );
        do_action( 'in_plugin_update_message-' . $this->PluginOptions['basename']);
    }

    public function getStrings( $StringsName )
    {
        return $this->strings[ $StringsName ];
    }

    public function setStrings()
    {
        $this->strings[ '' ] = vsprintf(
            '<strong>%s</strong> %s %s '
            // ' <a href="https://gist.github.com/IamProgrammerLK/0fd6f95d42ac17b906fe2c1e7a177b4d" target="_BLANK">' . $__4 . '</a>. '. $__5
            ,
            [
                __( 'IMPORTANT:', $this->PluginOptions[ 'text_domain' ] )
            , __( 'Make sure this currency code supports your payment gateway. otherwise, payments will NOT be processed.', $this->PluginOptions[ 'text_domain' ] )
            , __( 'leave empty to use the original currency type. or use the', $this->PluginOptions[ 'text_domain' ] )
            ]
            );

    }

}