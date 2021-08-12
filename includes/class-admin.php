<?php

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

class Easylgpd_Admin
{
    public function __construct()
    {
        add_action('admin_menu', array($this, 'menu_page'));
        add_action('admin_init', array($this, 'register_settings'));
    }

    public function menu_page()
    {
        add_menu_page(__('Easy LGPD', 'easylgpd'), 'LGPD', 'manage_options', 'easy-lgpd', array($this, 'configs'), 'dashicons-analytics');
    }

    public function configs()
    {
        if (is_file(EASY_LGPD_PATH . 'templates/admin/config-geral.php'))
            require_once EASY_LGPD_PATH . 'templates/admin/config-geral.php';
    }

    public function register_settings()
    {
        register_setting('easylgpd-settings-group', 'modal_title');
        register_setting('easylgpd-settings-group', 'btn_text');
        register_setting('easylgpd-settings-group', 'modal_info');
    }
}

new Easylgpd_Admin();
