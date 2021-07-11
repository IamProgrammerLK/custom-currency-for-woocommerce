<?php

/*
 * @project
 * Project Name:        Custom Currency For WooCommerce
 * Project Description: Custom Currency For WooCommerce allows you to change the currency symbol used in WooCommerce and you can add a new custom currency type to the WooCommerce.
 * Project Version:     5.4.0
 * File Name:           CustomCurrencyForWooCommerce.php
 * File Description:    This file is read by WordPress to generate the plugin information in the plugin admin area.
 *                      This file also includes all of the dependencies used by the plugin, registers the activation
 *                      and deactivation functions, and defines a function that starts the plugin.
 * File Version:        5.4.0
 * Last Change:         2021-07-11
 * 
 * @copyright
 * Copyright:           Copyright (C) IamProgrammerLK - All Rights Reserved
 * Copyright Note:      
 * License:             GNU GENERAL PUBLIC LICENSE
 * License URI:         https://www.gnu.org/licenses/gpl-3.0.html
 * 
 * @authors
 * Author:              I am Programmer
 * Author URI:          https://iamprogrammer.lk
 * Since                1.0.0 (2020-08-19)
 * 
 * @wordpress-plugin
 * Plugin Name:         Custom Currency For WooCommerce
 * Plugin URI:          https://iamprogrammer.lk/custom-currency-for-woocommerce/
 * Description:         Custom Currency For WooCommerce allows you to change the currency symbol used in WooCommerce and you can add a new custom currency type to the WooCommerce.
 * Requires at least:   5.0.0
 * Requires PHP:        7.0.0
 * WC requires at least:4.0.0
 * WC tested up to: 	5.4.0
 * Text Domain:         CC4WC
 * Domain Path:         /Public/Languages
 * Version:             5.4.0
 * Author:              I am Programmer
 * Author URI:          https://iamprogrammer.lk
 * License:             GNU GENERAL PUBLIC LICENSE
 * License URI:         https://www.gnu.org/licenses/gpl-3.0.html
*/

namespace IamProgrammerLK\CustomCurrencyForWooCommerce;

use IamProgrammerLK\CustomCurrencyForWooCommerce\PluginActivator\PluginActivator;

// If this file is called directly, abort. for the security purpose.
if( ! defined( 'WPINC' ) )
{
    die;
}

// Dynamically include the classes.
require_once trailingslashit( dirname( __FILE__ ) ) . 'vendor/autoload.php';

// triggers when the plugin is activated
function pluginActivationHook()
{
    $PluginActivator = new PluginActivator();
    $PluginActivator->activate();
}
register_activation_hook ( __file__, 'IamProgrammerLK\CustomCurrencyForWooCommerce\pluginActivationHook' );

// triggers when the plugin is deactivated
function pluginDeactivationHook ()
{
    $PluginActivator = new PluginActivator ();
    $PluginActivator->deactivate ();
}

register_deactivation_hook( __FILE__, 'IamProgrammerLK\CustomCurrencyForWooCommerce\pluginDeactivationHook' );

// initiate the plugin
if( ! class_exists('CustomCurrencyForWooCommerce') )
{

    $customCurrencyForWooCommerce = new CustomCurrencyForWooCommerce();
    $customCurrencyForWooCommerce->init();

}