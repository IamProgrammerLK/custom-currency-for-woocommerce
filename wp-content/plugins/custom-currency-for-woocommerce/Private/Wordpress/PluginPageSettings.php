<?php

namespace IamProgrammerLK\CustomCurrencyForWooCommerce\Wordpress;

// If this file is called directly, abort. for the security purpose.
if( ! defined( 'WPINC' ) )
{
    die;
}

class PluginPageSettings
{

    private $PluginOptions;

    public function __construct( $PluginOptions )
    {
        $this->PluginOptions = $PluginOptions;
    }

    public function init()
    {
        add_filter( 'plugin_action_links_' . $this->PluginOptions[ 'basename' ], [ $this , 'renderPluginsPageLinks' ] );
        add_filter( 'plugin_row_meta', [ $this , 'renderPluginRowMetaLinks'], 10, 2 );
        do_action( 'in_plugin_update_message-' . $this->PluginOptions['basename']);
    }

    public function renderPluginsPageLinks( $links )
    {
        $settingsLink      = '<a href="' . $this->PluginOptions[ 'settings_url' ] .
            '"><span class="dashicons-before dashicons-admin-generic"></span>Settings</a>';
        $supportLink       = '<a href="' . $this->PluginOptions[ 'support_url' ] .
            '" target="_blank" style="color:#2B8C69;"><span class="dashicons-before dashicons-sos"></span>Support</a>';
        $leaveFeedbackLink = '<a href="' . $this->PluginOptions[ 'feedback_url' ] .
            '" target="_blank" style="color:#D97D0D;"><span class="dashicons-before dashicons-star-half"></span>Feedback</a>';

        array_push( $links, $settingsLink, $supportLink, $leaveFeedbackLink );
        return $links;
    }

    public function renderPluginRowMetaLinks( $links, $file )
    {
        if( $this->PluginOptions[ 'basename' ] == $file )
        {
            $rowMetaLinks = [
                'settingslink' => '<a href="' . $this->PluginOptions[ 'settings_url' ] .
                    '"><span class="dashicons-before dashicons-admin-generic"></span>Settings</a>',
                'supportLink' => '<a href="' . $this->PluginOptions[ 'support_url' ] .
                    '" target="_blank" style="color:#2B8C69;"><span class="dashicons-before dashicons-sos"></span>Support</a>',
                'leaveFeedbackLink' => '<a href="' . $this->PluginOptions[ 'feedback_url' ] .
                    '" target="_blank" style="color:#D97D0D;"><span class="dashicons-before dashicons-star-half"></span>Feedback</a>',
            ];

            if( isset( $this->PluginOptions[ 'donate_url' ] ) && ! ( $this->PluginOptions[ 'donate_url' ] == '' ) )
            {
                $rowMetaLinks = array_merge(
                    $rowMetaLinks,
                    [
                        'donateLink' => '<a href="' . $this->PluginOptions[ 'donate_url' ] .
                            '" target="_blank" style="color:#BF8069;"><span class="dashicons-before dashicons-heart"></span>Donate</a>',
                    ]
                );
            }

            if( isset( $this->PluginOptions[ 'upgrade_url' ] ) && ! ( $this->PluginOptions[ 'upgrade_url' ] == '' ) )
            {

                $rowMetaLinks = array_merge(
                    $rowMetaLinks,
                    [
                        'upgradeLink' => '<a href="' . $this->PluginOptions[ 'upgrade_url' ] .
                            '" target="_blank" style="color:#A66D97;"><span class="dashicons-before dashicons-awards"></span>Upgrade</a>',
                    ]
                );

            }

            return array_merge( $links, $rowMetaLinks );

        }
        return (array) $links;
    }

}