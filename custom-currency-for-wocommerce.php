<?php

/*
** @project
** Project Name:        Custom Currency For WooCommerce
** Project Description: Custom Currency For WooCommerce allows you to change the currency symbol used in WooCommerce and you can add a new custom currency type to the WooCommerce.
** Project Version:     5.5.2
** File Name:           custom-currency-for-woocommerce.php
** File Description:    This file is read by WordPress to generate the plugin information in the plugin admin area.
**                      This file also includes all of the dependencies used by the plugin, registers the activation
**                      and deactivation functions, and defines a function that starts the plugin.
** File Version:        5.5.2
** Last Change:         2021-08-04
**
** @wordpress-plugin
** Plugin Name:         Custom Currency For WooCommerce
** Short Name:          Custom Currency
** Plugin Slug:         customcurrency
** Plugin Namespace:    IamProgrammerLK\CustomCurrencyForWooCommerce
** Title:               Custom Currency For WooCommerce
** Plugin URI:          https://wordpress.org/plugins/custom-currency-for-woocommerce/
** Version:             5.5.1
** Description:         Custom Currency For WooCommerce allows you to change the currency symbol used in WooCommerce and you can add a new custom currency type to the WooCommerce.
** Text Domain:         customcurrency
** Domain Path:         /Common/Languages
** Network:             
** Author:              I am Programmer
** Author URI:          https://iamprogrammer.lk
** Requires PHP:        7.0.0
** Requires at least:   5.0.0
** WP tested up to:     5.8.0
** WC requires at least:5.0.0
** WC tested up to:     5.5.2
** License:             GNU GENERAL PUBLIC LICENSE
** License URI:         https://github.com/IamProgrammerLK/CustomCurrencyForWooCommerce/blob/main/LICENSE
**
** @copyrights
** Copyright:           Copyright (C) IamProgrammerLK - All Rights Reserved
** Copyright Note:      |
**
** @authors
** Author:              I am Programmer
** Author URL:          https://iamprogrammer.lk
** Since                1.0.0 (2020-08-19)
*/

namespace IamProgrammerLK\CustomCurrencyForWooCommerce;

// If this file is called directly, abort. for the security purpose.
if( ! defined( 'WPINC' ) )
{
    die;
}

// Dynamically include the classes.
require_once trailingslashit( dirname( __FILE__ ) ) . 'vendor/autoload.php';

// initiate the plugin
if( ! class_exists( 'CustomCurrencyForWooCommerce' ) )
{
    // $string - absolute path of the primary plugin file
    // $string - absolute path of the plugin config file
    $custom_currency = new CustomCurrencyForWooCommerce( __FILE__, plugin_dir_path( __FILE__ ) . 'Configs/PluginOptions.php' );
    $custom_currency->init();
}
