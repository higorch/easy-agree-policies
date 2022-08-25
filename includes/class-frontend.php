<?php

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

class Easyap_Frontend
{
    public function __construct()
    {
        add_action('wp_enqueue_scripts', array($this, 'enqueue_scripts'));
        add_action('wp_footer', array($this, 'frontend'));
    }

    public function enqueue_scripts()
    {
        wp_enqueue_style('easyap-frontend', EASYAP_URL . '/assets/css/frontend.css', null, '2.0.2');
        wp_enqueue_script('easyap-frontend', EASYAP_URL . '/assets/js/frontend.js', array('jquery'), '2.0.2', true);
    }

    public function frontend()
    {
        if (is_file(EASYAP_PATH . 'templates/frontend/modal-consent.php'))
            require_once EASYAP_PATH . 'templates/frontend/modal-consent.php';

        if (is_file(EASYAP_PATH . 'templates/frontend/modal-cookies.php'))
            require_once EASYAP_PATH . 'templates/frontend/modal-cookies.php';
    }
}

new Easyap_Frontend();
