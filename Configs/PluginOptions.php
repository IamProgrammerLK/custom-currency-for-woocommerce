<?php

// If this file is called directly, abort. for the security purpose.
if( ! defined( 'WPINC' ) )
{
    die;
}

return [
    // Displays at the end of the update message container in row of the plugins list table.
    'plugin_update_notice_url' => 'http://plugins.svn.wordpress.org/custom-currency-for-woocommerce/trunk/updatenotice.txt',
    // Plugin settings page url
    'plugin_settings_url'      => 'admin.php?page=testplugin_default_option_page',
    // Plugin help and support url
    'plugin_support_url'       => 'https://wordpress.org/support/plugin/custom-currency-for-woocommerce/',
    // Plugin feedback url
    'plugin_feedback_url'      => 'https://wordpress.org/plugins/custom-currency-for-woocommerce/#reviews',
    // Social profile links
    'plugin_social_urls'       => [
        [
            'name'                  => 'donations',
            'title'                 => 'Donate',
            'link'                  => 'https://sponsors.iamprogrammer.lk',
            'color'                 => '#A66D97',
            'icon'                  => 'dashicons-before dashicons-heart',
        ],
        [
            'name'                  => 'upgrade',
            'title'                 => 'Upgrade',
            'link'                  => 'https://www.buymeacoffee.com/IamProgrammerLK/e/7620',
            'color'                 => '',
            'icon'                  => 'dashicons-before dashicons-awards',
        ],
        [
            'name'                  => 'github_profile',
            'title'                 => 'Github',
            'link'                  => 'https://github.com/IamProgrammerLK',
            'color'                 => '#2B8C69',
            'icon'                  => 'dashicons-before dashicons-editor-code',
        ],
        [
            'name'                  => 'twitter_profile',
            'title'                 => 'Twitter',
            'link'                  => 'https://twitter.com/IamProgrammerLK',
            'color'                 => '',
            'icon'                  => 'dashicons-before dashicons-twitter',
        ],
        [
            'name'                  => 'youtube_profile',
            'title'                 => 'Youtube',
            'link'                  => 'https://www.youtube.com/user/IamProgrammerLK',
            'color'                 => '',
            'icon'                  => 'dashicons-before dashicons-youtube',
        ],
        [
            'name'                  => 'linkedin_profile',
            'title'                 => 'Linkedin',
            'link'                  => 'https://www.linkedin.com/company/iamprogrammerlk',
            'color'                 => '',
            'icon'                  => 'dashicons-before dashicons-linkedin',
        ],
    ],
    'plugin_requires'         => [
        [
            'required'       => true,
            'id'             => 'WooCommerce',
            'name'           => 'WooCommerce',
            'class_name'     => 'WooCommerce',
            'url'            => 'https://wordpress.org/plugins/woocommerce/',
            'min_version'    => '3.9.9',
            'max_version'    => '',
        ],
        [
            'required'       => false,
            'id'             => 'LearnPress',
            'name'           => 'LearnPress',
            'class_name'     => 'LearnPress',
            'url'            => 'https://wordpress.org/plugins/learnpress/',
            'min_version'    => '3.9.9',
            'max_version'    => '',
        ],

    ],
];