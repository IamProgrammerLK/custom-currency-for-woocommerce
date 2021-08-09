<?php

namespace IamProgrammerLK\CustomCurrencyForWooCommerce;

use IamProgrammerLK\PluginPressAPI\PluginOptions\PluginOptions;
use IamProgrammerLK\PluginPressAPI\Admin\AdminPages;

// If this file is called directly, abort. for the security purpose.
if( ! defined( 'WPINC' ) )
{
    die;
}

class CreateAdminPages
{

    protected $plugin_options;

    public function __construct( PluginOptions $plugin_options )
    {
        $this->plugin_options = $plugin_options;
    }

    public function init()
    {
        $this->create_option_page();
        // $this->create_option_pages();
        // $this->create_admin_welcome_page();

    }

    private function create_option_page()
    {
        $option_page_01 = new AdminPages( $this->plugin_options );
        $option_page_01->add_option_pages(
            [
                'page_title'                    => 'Test Options Page 01',
                'page_menu_title'               => 'Test Options Page 01',
                'page_description'              => 'This is the test option page 01 description',
                'page_capabilities'             => 'manage_options',
                'page_slug'                     => 'test_options_page_01',
                'page_ui'                       => '',      // default empty || valid callback function || absolute path to the template file
            ]
        );
        $option_page_01->add_tabs(
            [
                'tab_parent_page_slug'          => 'test_options_page_01',
                'tab_slug'                      => 'test_tab_01',
                'tab_title'                     => 'Test Tab 01',
                'tab_description'               => 'Test tab 01 description',
                // 'tab_before_icon'               => 'dashicons dashicons-admin-generic',
                // 'tab_after_icon'                => 'dashicons dashicons-admin-generic',
                'tab_default'                   => true,
            ]
        );
        $option_page_01->add_sections(
            [
                'section_parent_page_slug'      => 'test_options_page_01',
                'section_parent_tab_slug'       => 'test_tab_01',
                'section_slug'                  => 'test_section_01',
                'section_title'                 => 'Test Section 01 Title',
                'section_description'           => 'This is the description for the test section 01',
            ]
        );
        $option_page_01->add_fields(
            [
                'option_parent_page_slug'       => 'test_options_page_01',      // Required
                'option_parent_tab_slug'        => 'test_tab_01',       // Optional
                'option_parent_section_slug'    => 'test_section_01',       // Optional
                'option_slug'                   => 'test_option_01',        // Required
                'option_title'                  => 'Test Option 01',        // Required
                'option_data_type'              => 'string',        // Optional
                'option_type'                   => 'text',      // Optional
                'option_default_value'          => false,       // Optional
                'option_description'            => 'This is the description for the test option 01',        // Optional
                'option_sanitize_callback'      => '',      // Optional
                'option_show_in_rest'           => false,       // Optional
                'option_ui'                     => '',      // Optional
                'option_class'                  => 'test-css-class',        // Optional
                'option_placeholder'            => 'Test option placeholder',       // Optional
            ]
        );
        $option_page_01->init();
    }

    private function create_option_pages()
    {
        $option_pages = new AdminPages( $this->plugin_options );
        $option_pages->add_option_pages(
            [
                [
                    'page_title'       => 'Test Options Page 02',
                    'page_menu_title'       => 'Test Options Page 02',
                    'page_description' => 'This is the test option page 02',
                    'page_capabilities'     => 'manage_options',
                    'page_slug'        => 'test_options_page_02',
                ],
                [
                    'page_title'       => 'Test Options Page 03',
                    'page_menu_title'       => 'Test Options Page 03',
                    'page_description' => 'This is the test option page 03',
                    'page_capabilities'     => 'manage_options',
                    'page_slug'        => 'test_options_page_03',
                ],
                // more pages
            ]
        );
        $option_pages->add_tabs(
            [
                [
                    'tab_parent_page_slug' => 'test_options_page_02',
                    'tab_slug'         => 'test_tab_01',
                    'tab_title'        => 'Page 02 Test Tab 01',
                    'tab_description'  => 'Test Tab description 01',
                    // 'tab_before_icon' => 'dashicons dashicons-admin-generic',
                    // 'tab_after_icon' => 'dashicons dashicons-admin-generic',
                    // 'tab_default' => true,
                ],
                [
                    'tab_parent_page_slug' => 'test_options_page_02',
                    'tab_slug'         => 'test_tab_02',
                    'tab_title'        => 'Page 02 Test Tab 02',
                    'tab_description'  => 'Test Tab description 02',
                    // 'tab_before_icon' => 'dashicons dashicons-admin-generic',
                    // 'tab_after_icon' => 'dashicons dashicons-admin-generic',
                    // 'tab_default' => true,
                ],
                [
                    'tab_parent_page_slug' => 'test_options_page_03',
                    'tab_slug'         => 'test_tab_01',
                    'tab_title'        => 'Page 03 Test Tab 01',
                    'tab_description'  => 'Test Tab description 01',
                    // 'tab_before_icon' => 'dashicons dashicons-admin-generic',
                    // 'tab_after_icon' => 'dashicons dashicons-admin-generic',
                    // 'tab_default' => true,
                ],
                [
                    'tab_parent_page_slug' => 'test_options_page_03',
                    'tab_slug'         => 'test_tab_02',
                    'tab_title'        => 'Page 03 Test Tab 02',
                    'tab_description'  => 'Test Tab description 02',
                    // 'tab_before_icon' => 'dashicons dashicons-admin-generic',
                    // 'tab_after_icon' => 'dashicons dashicons-admin-generic',
                    // 'tab_default' => true,
                ],
                // more tabs

            ]
        );
        $option_pages->add_sections(
            [
                [
                    'section_parent_page_slug'    => 'test_options_page_02',
                    'section_parent_tab_slug'     => 'test_tab_01',
                    'section_slug'        => 'test_section_01',
                    'section_title'       => 'Test Section Title 01',
                    'section_description' => 'This is the description for the test section 01',
                ],
                [
                    'section_parent_page_slug'    => 'test_options_page_02',
                    'section_parent_tab_slug'     => 'test_tab_02',
                    'section_slug'        => 'test_section_02',
                    'section_title'       => 'Test Section Title 02',
                    'section_description' => 'This is the description for the test section 02',
                ],
                [
                    'section_parent_page_slug'    => 'test_options_page_03',
                    'section_parent_tab_slug'     => 'test_tab_02',
                    'section_slug'        => 'test_section_03',
                    'section_title'       => 'Test Section Title 03',
                    'section_description' => 'This is the description for the test section 03',
                ],
                // more sections

            ]
        );
        $option_pages->add_fields(
            [
                [
                    'option_parent_page_slug'    => 'test_options_page_02',
                    'option_parent_tab_slug'     => 'test_tab_01',
                    'option_parent_section_slug' => 'test_section_01',
                    'option_slug'         => 'test_option_01',
                    'option_title'        => 'Test Option 01',
                    'option_data_type'    => 'string',
                    'option_type'         => 'text',
                    // 'option_default_value' => false,
                    'option_description'  => 'This is the description for the test option 01',
                    // 'option_sanitize_callback' => '',
                    // 'option_show_in_rest' => false,
                    // 'option_ui' => '',
                    // 'option_class' => 'test-css-class',
                    // 'option_placeholder' => 'Test option placeholder',
                ],
                [
                    'option_parent_page_slug' => 'test_options_page_02', // Required
                    'option_parent_tab_slug' => 'test_tab_02', // Optional
                    'option_parent_section_slug' => 'test_section_02', // Optional
                    'option_slug' => 'test_option_02', // Required
                    'option_title' => 'Test Option 02', // Required
                    'option_data_type' => 'string', // Optional
                    'option_type' => 'text', // Optional
                    // 'option_default_value' => false,                                            // Optional
                    'option_description' => 'This is the description for the test option 02', // Optional
                    // 'option_sanitize_callback' => '',                                           // Optional
                    // 'option_show_in_rest' => false,                                             // Optional
                    // 'option_ui' => '',                                                          // Optional
                    // 'option_class' => 'test-css-class',                                         // Optional
                    // 'option_placeholder' => 'Test option placeholder',                          // Optional
                ],
                [
                    'option_parent_page_slug' => 'test_options_page_03', // Required
                    'option_parent_tab_slug' => 'test_tab_02', // Optional
                    'option_parent_section_slug' => 'test_section_03', // Optional
                    'option_slug' => 'test_option_03', // Required
                    'option_title' => 'Test Option 03', // Required
                    'option_data_type' => 'string', // Optional
                    'option_type' => 'text', // Optional
                    // 'option_default_value' => false,                                            // Optional
                    'option_description' => 'This is the description for the test option 03', // Optional
                    // 'option_sanitize_callback' => '',                                           // Optional
                    // 'option_show_in_rest' => false,                                             // Optional
                    // 'option_ui' => '',                                                          // Optional
                    // 'option_class' => 'test-css-class',                                         // Optional
                    // 'option_placeholder' => 'Test option placeholder',                          // Optional
                ],
            ]
        );
        $option_pages->init();
    }

    // user will redirected to the welcome page when plugin is activated.
    // If a plugin is silently activated (such as during an update, multisite, or multiple plugin activation), this does not redirect to the welcome page.
    private function create_admin_welcome_page()
    {
        $admin_welcome_page = new AdminPages( $this->plugin_options );
        $admin_welcome_page->add_admin_welcome_page(
            [
                'page_title' => 'Welcome',
                'page_ui' => plugin_dir_path( __FILE__ ) . 'Templates/AdminWelcomePageTemplate.php',        // valid callback function || absolute path to the template file
                // 'page_show_always' => true,     // default false
            ] 
        );
        $admin_welcome_page->init();
    }

}
