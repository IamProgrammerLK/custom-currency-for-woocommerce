<?php

namespace IamProgrammerLK\CustomCurrencyForWooCommerce;

use IamProgrammerLK\CustomCurrencyForWooCommerce\PluginOptions\PluginOptions;
use IamProgrammerLK\CustomCurrencyForWooCommerce\Wordpress\PluginPageSettings;

// If this file is called directly, abort. for the security purpose.
if( ! defined('WPINC') )
{
    die;
}

class CustomCurrencyForWooCommerce
{

    private $PluginOptions;
    private $PluginDisabled = false;

    public function __construct()
    {
        $this->PluginOptions = PluginOptions::getInstance()->getPluginOptions();
    }

    public function init() : void
    {
        $pluginPageSettings = new PluginPageSettings( $this->PluginOptions );
        $pluginPageSettings->init();

        add_action( 'plugins_loaded', [ $this, 'isPluginCompatible'], 11 );
        add_action( 'admin_init', [ $this, 'isFieldsEmpty'] );
        add_filter( 'woocommerce_currencies', [ $this, 'addCustomCurrency' ] );
        add_filter( 'woocommerce_currency_symbol', [ $this, 'setCustomCurrencySymbol' ], 10, 2 );
        add_filter( 'woocommerce_general_settings', [ $this, 'addCustomCurrencySettings' ] );
    }

    public function isPluginCompatible()
    {
        global $wp_version;

        if( version_compare( $wp_version, '4.9.9', '<' ) )
        {
            add_action( 'admin_notices', [ $this, 'noticeWordpressIncompatible' ] );
            add_action( 'network_admin_notices', [ $this, 'noticeWordpressIncompatible' ] );
            $this->PluginDisabled = true;
            return;
        }

        if( ! class_exists( 'WooCommerce' ) )
        {
            add_action( 'admin_notices', [ $this, 'noticeWooCommerceInactive' ], 11 );
            add_action( 'network_admin_notices', [ $this, 'noticeWooCommerceInactive' ] );
            $this->PluginDisabled = true;
            return;
        }
        else
        {
            if( version_compare( WC_VERSION, '3.9.9', "<" ) )
            {
                add_action( 'admin_notices', [ $this, 'noticeWooCommerceIncompatible' ], 12 );
                add_action( 'network_admin_notices', [ $this, 'noticeWooCommerceIncompatible' ] );
                $this->PluginDisabled = true;
                return;
            }
        }
    }

    public function noticeWordpressIncompatible()
    {
        global $wp_version;
        ?>
            <div class="notice notice-error">
                <p>
                    <?php
                        echo
                            '<strong>Oops! </strong><a href="' . $this->PluginOptions[ 'url' ] . '" target="_blank">Custom Currency For WooCommerce</a> ' .
                            __( 'is installed but not active. You are using', $this->PluginOptions[ 'text_domain' ] ) .
                            '<a href="https://wordpress.org" target="_blank">Wordpress</a> v' . $wp_version . '. ' . 
                            __( 'Please upgrade to the latest version of ', $this->PluginOptions[ 'text_domain' ] ) .
                            '<a href="https://wordpress.org" target="_blank">Wordpress</a> ' .
                            __( 'to activate ', $this->PluginOptions[ 'text_domain' ] ) . '<a href="' . $this->PluginOptions[ 'url' ] .
                            '" target="_blank">Custom Currency For WooCommerce</a>.';
                    ?>
                </p>
            </div>
        <?php
    }

    public function noticeWooCommerceInactive()
    {
        ?>
            <div class="notice notice-error">
                <p>
                    <?php
                        echo
                            '<strong>Oops! </strong><a href="' . $this->PluginOptions[ 'url' ] . '" target="_blank">Custom Currency For WooCommerce' .
                            '</a> ' . __( 'is enabled but not effective. It requires ', $this->PluginOptions[ 'text_domain' ] ) .
                            '<a href="https://wordpress.org/plugins/woocommerce/" target="_blank">WooCommerce</a> ' .
                            __( 'in order to work.', $this->PluginOptions[ 'text_domain' ] );
                    ?>
                </p>
            </div>
        <?php
    }

    public function noticeWooCommerceIncompatible()
    {
        ?>
            <div class="notice notice-error">
                <p>
                    <?php
                        echo
                            '<strong>Oops! </strong>' . __( 'You are using ', $this->PluginOptions[ 'text_domain' ] ) .
                            '<a href="https://wordpress.org/plugins/woocommerce/" target="_blank">WooCommerce</a> v' . WC_VERSION .
                            '. <a href="' . $this->PluginOptions[ 'url' ] . '" target="_blank">Custom Currency For WooCommerce</a> ' .
                            __( 'does not support older versions. Please upgrade to the latest version of ', $this->PluginOptions[ 'text_domain' ] ) .
                            '<a href="https://wordpress.org/plugins/woocommerce/" target="_blank">WooCommerce</a> ' .
                            __( 'to use ', $this->PluginOptions[ 'text_domain' ] ) .
                            '<a href="' . $this->PluginOptions[ 'url' ] . '" target="_blank">Custom Currency For WooCommerce</a>';
                    ?>
                </p>
            </div>
        <?php
    }

    public function isFieldsEmpty()
    {
        $customCurrencyCode  = get_option( 'custom_currency_code' );
        $customCurrencyLabel = get_option( 'custom_currency_label' );

        if( $customCurrencyCode != '' xor $customCurrencyLabel != '' ) {
            add_action(
                'admin_notices',
                function ()
                {
                    ?>
                        <div class="notice notice-error">
                            <p>
                                <?php
                                    echo vsprintf(
                                        '<strong>%s </strong> %s <a href="https://wordpress.org/plugins/woocommerce/" target="_blank">WooCommerce</a>, ' .
                                        '<label for="custom_currency_code" style="vertical-align:baseline;"><strong>Custom Currency Code</strong></label>' .
                                        ' %s ' .
                                        '<label for="custom_currency_label"style="vertical-align:baseline;"><strong>Custom Currency Label</strong></label>' .
                                        ' %s'
                                        ,
                                        [
                                        __( 'Oops!', $this->PluginOptions[ 'text_domain' ] ),
                                        __( 'When you add a new custom currency type to the ', $this->PluginOptions[ 'text_domain' ] ),
                                        __( 'and', $this->PluginOptions[ 'text_domain' ] ),
                                        __( 'is required. or Leave both empty to use original ', $this->PluginOptions[ 'text_domain' ] ),
                                        __( 'When you add a new custom currency type to the ', $this->PluginOptions[ 'text_domain' ] )
                                        ]
                                    );
                                ?>
                            </p>
                        </div>
                    <?php
                }
            );
        }
    }

    // '<strong>Oops! </strong>' .
    // __( 'When you add a new custom currency type to the ', $this->PluginOptions[ 'text_domain' ] ) .
    // '<a href="https://wordpress.org/plugins/woocommerce/" target="_blank">WooCommerce</a>, ' .
    // '<label for="custom_currency_code" style="vertical-align:baseline;"><strong>Custom Currency Code</strong></label> ' .
    // __ ( 'and', $this->PluginOptions[ 'text_domain' ] ) .
    // ' <label for="custom_currency_label"style="vertical-align:baseline;"><strong>Custom Currency Label</strong></label> ' .
    // __( 'is required. or Leave both empty to use original ', $this->PluginOptions[ 'text_domain' ] ) .
    // '<label for="woocommerce_currency" style="vertical-align:baseline;"><strong>WooCommerce Currency</strong></label> ' .
    // __( 'with a ', $this->PluginOptions[ 'text_domain' ] ) .
    // '<label for="custom_currency_symbol"style="vertical-align:baseline;"><strong>Custom Currency Symbol</strong></label>.';


    // Adding a custom currency to the WooCommerce that saved in wp-settings.
    public function addCustomCurrency( $wooCurrency )
    {
        if( $this->PluginDisabled == true )
        {
            return $wooCurrency;
        }

        $customCurrencyCode  = get_option( 'custom_currency_code' );
        $customCurrencyLabel = get_option( 'custom_currency_label' );

        if( $customCurrencyCode != '' && $customCurrencyLabel != '' )
        {
            $wooCurrency[ $customCurrencyCode ] = $customCurrencyLabel;
        }

        return $wooCurrency;
    }

    // Adding a custom currency symbol to the WooCommerce that saved in wp-settings.
    public function setCustomCurrencySymbol( $customCurrencySymbol, $wooCurrency )
    {
        if( $this->PluginDisabled == true )
        {
            return $customCurrencySymbol;
        }

        $currencySymbol = get_option( 'custom_currency_symbol' );

        if( $currencySymbol != '' )
        {
            switch( $wooCurrency )
            {
                case get_woocommerce_currency():
                    $customCurrencySymbol = $currencySymbol;
                    break;
            }
        }

        return $customCurrencySymbol;
    }

    // Creating settings elements on the WooCommerce setting page, so the user can change the settings.
    public function addCustomCurrencySettings( $wooSettings )
    {
        if( $this->PluginDisabled == true )
        {
            return $wooSettings;
        }

        $newSettings = [];

        foreach( $wooSettings as $section )
        {
            if( isset( $section[ 'title' ] ) && $section[ 'title' ] == 'Currency' )
            {

                $section[ 'desc' ]     = __( 'If you wish to change the currency symbol only,', $this->PluginOptions[ 'text_domain' ] ) .
                    __( ' select the currency type here then add a new symbol in ', $this->PluginOptions[ 'text_domain' ] ) .
                    '<label for="custom_currency_symbol" style="vertical-align: baseline;"><strong>Custom Currency Symbol</strong></label> ' .
                    __( 'Box, and then hit the ', $this->PluginOptions[ 'text_domain' ] ) .
                    '<label for="submit" style="vertical-align: baseline;"><strong>Save changes</strong></label> button, 
                        and make sure <label for="custom_currency_code" style="vertical-align: baseline;"><strong>Custom Currency Code</strong></label> and <label for="custom_currency_label" 
                        style="vertical-align: baseline;"><strong>Custom Currency Label</strong></label> fields are empty. 

                    ';
                $section[ 'desc_tip' ] = __(
                    'This controls what currency prices are listed at in the catalog and which currency gateways will take payments in.',
                    $this->PluginOptions[ 'text_domain' ]
                );
            }

            if( isset( $section[ 'id' ] ) && $section[ 'id' ] == 'pricing_options' && isset( $section[ 'type' ] ) && $section[ 'type' ] == 'sectionend' )
            {

                $__1 = __( 'IMPORTANT:' );
                $__2 = __( 'Make sure this currency code supports your payment gateway. otherwise, payments will NOT be processed.' );
                $__3 = __( 'leave empty to use the original currency type. or use the' );
                $__4 = __( 'international currency code' );
                $__5 = __( 'ex. "USD" for the United States Dollar or "LKR" for the Sri Lankan Rupees.' );

                $newSettings[] = [
                    'name'     => 'Custom Currency Code',
                    'desc'     => vsprintf(
                        '<strong>%s</strong> %s %s '
                        // ' <a href="https://gist.github.com/IamProgrammerLK/0fd6f95d42ac17b906fe2c1e7a177b4d" target="_BLANK">' . $__4 . '</a>. '. $__5
                        , 
                        [
                            __( 'IMPORTANT:', $this->PluginOptions[ 'text_domain' ] )
                        , __( 'Make sure this currency code supports your payment gateway. otherwise, payments will NOT be processed.', $this->PluginOptions[ 'text_domain' ] )
                        , __( 'leave empty to use the original currency type. or use the', $this->PluginOptions[ 'text_domain' ] )
                        ]
                        ),
                    'desc_tip' => __(
                                        '
                                            Enter a custom currency name here. If you set make sure you set the custom symbol for this currency type. If empty, the default for the selected currency 
                                            will be used instead.
                                        ',
                                        $this->PluginOptions[ 'text_domain' ]
                                    ),
                    'id'       => 'custom_currency_code',
                    'type'     => 'text',
                    'css'      => 'width:400px;',
                    'default'  => '',
                ];

                $newSettings[]
                = 
                [
                    'name'     => 'Custom Currency Label',
                    'desc'     => __(
                                        '
                                            Set a label for the <label for="custom_currency_code" style="vertical-align: baseline;"><strong>Custom Currency</strong></label>. this will NOT change default 
                                            currency labels that came with WooCommerce, adds a new label instead. leave empty to use the original currency label.
                                        ',
                                        $this->PluginOptions[ 'text_domain' ]
                                    ),
                    'desc_tip' => __(
                                        'Label for the custom currency code',
                                        $this->PluginOptions[ 'text_domain' ]
                                    ),
                    'id'       => 'custom_currency_label',
                    'type'     => 'text',
                    'css'      => 'width:400px;',
                    'default'  => '',
                ];

                $newSettings[]
                =
                [
                    'name'     => 'Custom Currency Symbol',
                    'desc'     => __(
                                        'Set a symbol for the <label for="woocommerce_currency" style="vertical-align: baseline;"><strong>Currency</strong></label>, this symbol will apply to whatever currency 
                                        you select from the <label for="woocommerce_currency" style="vertical-align: baseline;"><strong>Currency</strong></label> box and this symbol will display on your site. 
                                        leave empty to use the original currency symbol.',
                                        $this->PluginOptions[ 'text_domain' ]
                                    ),
                    'desc_tip' => __(
                                        'Enter a currency symbol here. If empty, the default for the selected currency will be used instead.',
                                        $this->PluginOptions[ 'text_domain' ]
                                    ),
                    'id'       => 'custom_currency_symbol',
                    'type'     => 'text',
                    'css'      => 'width:400px;',
                    'default'  => '',
                ];

            }
            $newSettings[] = $section;

        }
        return $newSettings;
    }

}