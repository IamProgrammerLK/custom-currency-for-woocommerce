<?php

namespace IamProgrammerLK\CustomCurrencyForWooCommerce\PluginActivator;

// If this file is called directly, abort. for the security purpose.
if ( ! defined( 'WPINC' ) )
{
    die;
}

class PluginActivator
{

    private $ActivationSequence;
    private $DeactivationSequence;

    public function __construct()
    {
        $this->ActivationSequence   = new ActivationSequence();
        $this->DeactivationSequence = new DeactivationSequence();
    }

    public function activate()
    {
        $this->ActivationSequence->init();
    }

    public function deactivate()
    {
        $this->DeactivationSequence->init();
    }

}