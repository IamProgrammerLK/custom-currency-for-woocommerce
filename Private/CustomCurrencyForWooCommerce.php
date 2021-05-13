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
                        echo vsprintf(
                            __(
                                '%sOops%s %sCustom Currency For WooCommerce%s is installed but not active. You are using %sWordpress%s. Please upgrade to the latest version of %sWordpress%s to activate %sCustom Currency For WooCommerce%s'
                            ),
                            [
                                '<strong>',
                                '!</strong>',
                                '<a href="' . $this->PluginOptions[ 'url' ] . '" target="_blank">',
                                '</a>',
                                '<a href="https://wordpress.org" target="_blank">',
                                '</a> ' . $wp_version,
                                '<a href="https://wordpress.org" target="_blank">',
                                '</a>',
                                '<a href="' . $this->PluginOptions[ 'url' ] . '" target="_blank">',
                                '</a>',
                            ]
                        );
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
                        echo vsprintf(
                            __(
                                '%sOops%s %sCustom Currency For WooCommerce%s is enabled but not effective. It requires %sWooCommerce%s in order to work.',
                                $this->PluginOptions[ 'text_domain' ]
                            ),
                            [
                                '<strong>',
                                '!</strong>',
                                '<a href="' . $this->PluginOptions[ 'url' ] . '" target="_blank">',
                                '</a>',
                                '<a href="https://wordpress.org/plugins/woocommerce/" target="_blank">',
                                '</a>',
                            ]
                        );
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
                        echo vsprintf(
                            __(
                                '%sOops%s You are using %sWooCommerce%s %sCustom Currency For WooCommerce%s does not support older versions. Please upgrade to the latest version of %sWooCommerce%s to use %sCustom Currency For WooCommerce%s',
                                $this->PluginOptions[ 'text_domain' ]
                            ),
                            [
                                '<strong>',
                                '!</strong>',
                                '<a href="https://wordpress.org/plugins/woocommerce/" target="_blank">',
                                '</a> v' . WC_VERSION,
                                '<a href="' . $this->PluginOptions[ 'url' ] . '" target="_blank">',
                                '</a>',
                                '<a href="https://wordpress.org/plugins/woocommerce/" target="_blank">',
                                '</a>',
                                '<a href="' . $this->PluginOptions[ 'url' ] . '" target="_blank">',
                                '</a>',
                            ]
                        );
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
                                        __(
                                            '%sOops%s When you add a new custom currency type to the %sWooCommerce%s, %sCustom Currency Code%s and %sCustom Currency Label%s is required. or Leave both empty to use original %sWooCommerce Currency%s with a %sCustom Currency Symbol%s.',
                                            $this->PluginOptions[ 'text_domain' ] 
                                        ),
                                        [
                                            '<strong>',
                                            '!</strong>',
                                            '<a href="https://wordpress.org/plugins/woocommerce/" target="_blank">',
                                            '</a>',
                                            '<label for="custom_currency_code" style="vertical-align:baseline;"><strong>',
                                            '</strong></label>',
                                            '<label for="custom_currency_label"style="vertical-align:baseline;"><strong>',
                                            '</strong></label>',
                                            '<label for="woocommerce_currency" style="vertical-align:baseline;"><strong>',
                                            '</strong></label>',
                                            '<label for="custom_currency_symbol"style="vertical-align:baseline;"><strong>',
                                            '</strong></label>',
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

                $section[ 'desc' ] = vsprintf(
                    __( 
                        'If you wish to change the currency symbol only, select the currency type here then add a new symbol in %sCustom Currency Symbol%s Box, and then hit the %sSave changes%s button, and make sure %sCustom Currency Code%s  and %sCustom Currency Label%s fields are empty.',
                        $this->PluginOptions[ 'text_domain' ]
                    ),
                    [
                        '<label for="custom_currency_symbol" style="vertical-align: baseline;"><strong>',
                        '</strong></label> ',
                        '<label for="submit" style="vertical-align: baseline;"><strong>',
                        '</strong></label>',
                        '<label for="custom_currency_code" style="vertical-align: baseline;"><strong>',
                        '</strong></label>',
                        '<label for="custom_currency_label" style="vertical-align: baseline;"><strong>',
                        '</strong></label>',
                    ]
                );
                $section[ 'desc_tip' ] = __(
                    'This controls what currency prices are listed at in the catalog and which currency gateways will take payments in.',
                    $this->PluginOptions[ 'text_domain' ]
                );
            }

            if( isset( $section[ 'id' ] ) && $section[ 'id' ] == 'pricing_options' && isset( $section[ 'type' ] ) && $section[ 'type' ] == 'sectionend' )
            {
                $newSettings[] = [
                    'name'     => 'Custom Currency Code',
                    'desc'     => vsprintf(
                        __( 
                            '%sIMPORTANT%s Make sure this currency code supports your payment gateway. otherwise, payments will NOT be processed. leave empty to use the original currency type. or use the %sInternational Currency Code%s. Ex. "USD" for the United States Dollar or "LKR" for the Sri Lankan Rupees.',
                            $this->PluginOptions[ 'text_domain' ]
                        ),
                        [
                            '<strong>',
                            ':</strong>',
                            '<a href="https://gist.github.com/IamProgrammerLK/0fd6f95d42ac17b906fe2c1e7a177b4d" target="_BLANK">',
                            '</a>',
                        ]
                    ),
                    'desc_tip' => __(
                        'Enter a custom currency name here. If you set make sure you set the custom symbol for this currency type. If empty, the default for the selected currency will be used instead.',
                        $this->PluginOptions[ 'text_domain' ]
                    ),
                    'id'       => 'custom_currency_code',
                    'type'     => 'text',
                    'css'      => 'width:400px;',
                    'default'  => '',
                ];

                $newSettings[] = [
                    'name'     => 'Custom Currency Label',
                    'desc'     => vsprintf(
                        __(
                            'Set a label for the %sCustom Currency%s. this will NOT change default currency labels that came with WooCommerce, adds a new label instead. leave empty to use the original currency label.',
                            $this->PluginOptions[ 'text_domain' ]
                        ),
                        [
                            '<label for="custom_currency_code" style="vertical-align: baseline;"><strong>',
                            '</strong></label>',
                        ]
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

                $newSettings[] = [
                    'name'     => 'Custom Currency Symbol',
                    'desc'     => vsprintf(
                        __(
                            'Set a symbol for the %sCurrency%s, this symbol will apply to whatever currency you select from the %sCurrency%s box and this symbol will display on your site. leave empty to use the original currency symbol.',
                            $this->PluginOptions[ 'text_domain' ]
                        ),
                        [
                            '<label for="woocommerce_currency" style="vertical-align: baseline;"><strong>',
                            '</strong></label>',
                            '<label for="woocommerce_currency" style="vertical-align: baseline;"><strong>',
                            '</strong></label>',
                        ]
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