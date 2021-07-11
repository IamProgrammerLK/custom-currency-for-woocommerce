<?php

// If this file is called directly, abort. for the security purpose.
if( ! defined( 'WPINC' ) )
{
    die;
}

if( ! function_exists( 'get_plugin_data' ) )
{

    include_once ABSPATH . 'wp-admin/includes/plugin.php';

}
    $PluginData = get_plugin_data( ABSPATH . 'wp-content/plugins/custom-currency-for-woocommerce/custom-currency-for-woocommerce.php', false );

    return [

        // Plugin name.
        'name' => $PluginData[ 'Name' ],

        // Title of the plugin and link to the plugin's site (if set).
        'title' => $PluginData[ 'Title' ],
        
        // Plugin description
        'description' => $PluginData[ 'Description' ],

        // Plugin Short name. Max 20 Char
        'shortname' => 'CC4WC',

        // Plugin text domain. Max 20 Char
        'text_domain' => $PluginData[ 'TextDomain' ],

        // Plugin namespace. sanitize_key( 'namespace' )
        'namespace' => 'IamProgrammerLK\CustomCurrencyForWooCommerce',

        // Plugin prefix/slug name. case sensitive and no spaces. Max 20 char
        'slug' => 'cc4wc',

        // Plugin basename. sanitize_key( 'basename' )
        'basename' => 'custom-currency-for-woocommerce/custom-currency-for-woocommerce.php',

        // Plugin dir url
        'dir_url' => str_replace( 'Private/PluginOptions/', '', plugin_dir_url( __FILE__ ) ) ,

        // Current plugin version. update it as you release new versions.
        'version' => $PluginData[ 'Version' ],

        // Plugin DIR path
        'path' => str_replace( 'Private/PluginOptions/', '', str_replace( '\\', '/', plugin_dir_path( __FILE__ ) ) ),

        // Plugins relative directory path to .mo files.
        'domain_path' => $PluginData[ 'DomainPath' ],

        // Whether the plugin can only be activated network-wide.
        'network' => $PluginData[ 'Network' ],

        // Minimum required version of WordPress.
        'requires_wp' => $PluginData[ 'RequiresWP' ],

        // Minimum required version of PHP.
        'requires_php' => $PluginData[ 'RequiresPHP' ],

        // Plugin author name
        'author_name' => $PluginData[ 'Author' ],

        // Plugin author url
        'author_url' => $PluginData[ 'AuthorURI' ],

        // Plugin url
        'url' => 'https://wordpress.org/plugins/custom-currency-for-woocommerce/',

        // Plugin settings page url
        'settings_url' => 'admin.php?page=wc-settings&tab=general',

        // Plugin feedback url
        'feedback_url' => 'https://wordpress.org/plugins/custom-currency-for-woocommerce/#reviews',

        // Plugin support url
        'support_url' => 'https://wordpress.org/support/plugin/custom-currency-for-woocommerce/',

        // Plugin donate url
        'donate_url' => 'https://sponsors.iamprogrammer.lk/',

        // Plugin upgrade url
        'upgrade_url' => '',

        // Displays at the end of the update message container in row of the plugins list table.
        'update_notice_url' => 'http://plugins.svn.wordpress.org/custom-currency-for-woocommerce/NOTE.txt',

    ];