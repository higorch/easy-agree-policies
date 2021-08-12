<?php

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

class Easylgpd_Frontend
{
    public function __construct()
    {
        add_action('wp_enqueue_scripts', array($this, 'enqueue_scripts'));
        add_action('wp_footer', array($this, 'frontend'));
    }

    public function enqueue_scripts()
    {
        wp_enqueue_style('easy-frontend', EASY_LGPD_URL . '/assets/css/frontend.css', null, '1.0.0');
        wp_enqueue_script('easy-frontend', EASY_LGPD_URL . '/assets/js/frontend.js', array('jquery'), '1.0.0', true);
    }

    public function frontend()
    {
        if (is_file(EASY_LGPD_PATH . 'templates/frontend/modal-accept.php'))
            require_once EASY_LGPD_PATH . 'templates/frontend/modal-accept.php';

        if (is_file(EASY_LGPD_PATH . 'templates/frontend/modal-cookies.php'))
            require_once EASY_LGPD_PATH . 'templates/frontend/modal-cookies.php';
    }
}

new Easylgpd_Frontend();
