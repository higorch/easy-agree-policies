<?php

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

class Easyap_Request
{
    public function __construct()
    {
        add_action('admin_enqueue_scripts', array($this, 'admin_enqueue_scripts'));
    }

    public function admin_enqueue_scripts()
    {
        wp_enqueue_script('easyap-admin-http', EASYAP_URL . 'assets/js/admin-request.js', array('jquery'), '1.0.0', true);
        wp_localize_script('easyap-admin-http', 'easyap_obj', array('ajax_url' => admin_url('admin-ajax.php')));
    }
}

new Easyap_Request();
