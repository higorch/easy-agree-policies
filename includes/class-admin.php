<?php

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

class Easyap_Admin
{
    public function __construct()
    {
        add_action('admin_menu', array($this, 'menu_page'));
        add_action('admin_init', array($this, 'register_settings'));
    }

    public function menu_page()
    {
        add_menu_page(__('Easy agree policies', 'easyap'), 'Easy agree policies', 'manage_options', 'easy-agree-policies', array($this, 'configs'), 'dashicons-analytics');
    }

    public function configs()
    {
        if (is_file(EASYAP_PATH . 'templates/admin/config-admin.php'))
            require_once EASYAP_PATH . 'templates/admin/config-admin.php';
    }

    public function register_settings()
    {
        register_setting('easyap_geral', 'easyap_geral',  array($this, 'sanitize'));

        add_settings_section('easyap_setting_geral_modal_confirm',  'Modal confirmação',  array($this, 'print_section_info'),  'easyap-setting-geral');
        add_settings_field('modal_confirm_title', 'Título', array($this, 'modal_confirm_title_callback'), 'easyap-setting-geral', 'easyap_setting_geral_modal_confirm');
        add_settings_field('modal_confirm_info', 'Informações', array($this, 'modal_confirm_info_callback'), 'easyap-setting-geral', 'easyap_setting_geral_modal_confirm');
        add_settings_field('modal_confirm_btn_label', 'Texto do botão', array($this, 'modal_confirm_btn_label_callback'), 'easyap-setting-geral', 'easyap_setting_geral_modal_confirm');

        add_settings_section('easyap_setting_geral_modal_cookies',  'Modal cookies',  array($this, 'print_section_info'),  'easyap-setting-geral');
        add_settings_field('modal_cookies_title', 'Título', array($this, 'modal_cookies_title_callback'), 'easyap-setting-geral', 'easyap_setting_geral_modal_cookies');

        register_setting('easyap_links', 'easyap_links',  array($this, 'sanitize'));
    }

    public function sanitize($input)
    {
        $inputs = array();

        if (isset($input['modal_confirm_title']))
            $inputs['modal_confirm_title'] = sanitize_text_field($input['modal_confirm_title']);

        if (isset($input['modal_confirm_info']))
            $inputs['modal_confirm_info'] = sanitize_text_field($input['modal_confirm_info']);

        if (isset($input['modal_confirm_btn_label']))
            $inputs['modal_confirm_btn_label'] = sanitize_text_field($input['modal_confirm_btn_label']);

        if (isset($input['modal_cookies_title']))
            $inputs['modal_cookies_title'] = sanitize_text_field($input['modal_cookies_title']);

        return $inputs;
    }

    public function print_section_info($args)
    {
        if (esc_html($args['id']) == 'easyap_setting_geral_modal_confirm') {
            printf('<p class="description">%s</p>', __('Configurações para o modal de confirmação', 'easyap'));
        }

        if (esc_html($args['id']) == 'easyap_setting_geral_modal_cookies') {
            printf('<p class="description">%s</p>',  __('Configurações para o modal de cookies', 'easyap'));
        }
    }

    public function modal_confirm_title_callback()
    {
        printf('<input class="regular-text" type="text" name="easyap_geral[modal_confirm_title]" value="%s">', get_option_easyap('easyap_geral', 'modal_confirm_title'));
    }

    public function modal_confirm_info_callback()
    {
        printf('<textarea class="regular-text" name="easyap_geral[modal_confirm_info]">%s</textarea>', get_option_easyap('easyap_geral', 'modal_confirm_info'));
    }

    public function modal_confirm_btn_label_callback()
    {
        printf('<input class="regular-text" type="text" name="easyap_geral[modal_confirm_btn_label]" value="%s">', get_option_easyap('easyap_geral', 'modal_confirm_btn_label'));
    }

    public function modal_cookies_title_callback()
    {
        printf('<input class="regular-text" type="text" name="easyap_geral[modal_cookies_title]" value="%s">', get_option_easyap('easyap_geral', 'modal_cookies_title'));
    }
}

new Easyap_Admin();
