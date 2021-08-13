<?php

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

class Easylgpd_Admin
{
    private $options_geral;
    private $options_links;

    public function __construct()
    {
        add_action('admin_menu', array($this, 'menu_page'));
        add_action('admin_init', array($this, 'register_settings'));

        $this->options_geral = get_option('easylgpd_geral');
        $this->options_links = get_option('easylgpd_links');
    }

    public function menu_page()
    {
        add_menu_page(__('Easy LGPD', 'easylgpd'), 'LGPD', 'manage_options', 'easy-lgpd', array($this, 'configs'), 'dashicons-analytics');
    }

    public function configs()
    {
        if (is_file(EASY_LGPD_PATH . 'templates/admin/config-admin.php'))
            require_once EASY_LGPD_PATH . 'templates/admin/config-admin.php';
    }

    public function register_settings()
    {
        register_setting('easylgpd_geral', 'easylgpd_geral',  array($this, 'sanitize'));

        add_settings_section('easylgpd_setting_geral_modal_confirm',  'Modal confirmação',  array($this, 'print_section_info'),  'easylgpd-setting-geral');
        add_settings_field('modal_confirm_title', 'Título', array($this, 'modal_confirm_title_callback'), 'easylgpd-setting-geral', 'easylgpd_setting_geral_modal_confirm');
        add_settings_field('modal_confirm_info', 'Informações', array($this, 'modal_confirm_info_callback'), 'easylgpd-setting-geral', 'easylgpd_setting_geral_modal_confirm');
        add_settings_field('modal_confirm_btn_label', 'Texto do botão', array($this, 'modal_confirm_btn_label_callback'), 'easylgpd-setting-geral', 'easylgpd_setting_geral_modal_confirm');

        add_settings_section('easylgpd_setting_geral_modal_cookies',  'Modal cookies',  array($this, 'print_section_info'),  'easylgpd-setting-geral');
        add_settings_field('modal_cookies_title', 'Título', array($this, 'modal_cookies_title_callback'), 'easylgpd-setting-geral', 'easylgpd_setting_geral_modal_cookies');

        register_setting('easylgpd_links', 'easylgpd_links',  array($this, 'sanitize'));
    }

    public function sanitize($input)
    {
        $new_input = array();

        if (isset($input['modal_confirm_title']))
            $new_input['modal_confirm_title'] = sanitize_text_field($input['modal_confirm_title']);

        if (isset($input['modal_confirm_info']))
            $new_input['modal_confirm_info'] = sanitize_text_field($input['modal_confirm_info']);

        if (isset($input['modal_confirm_btn_label']))
            $new_input['modal_confirm_btn_label'] = sanitize_text_field($input['modal_confirm_btn_label']);

        if (isset($input['modal_cookies_title']))
            $new_input['modal_cookies_title'] = sanitize_text_field($input['modal_cookies_title']);

        return $new_input;
    }

    public function print_section_info($args)
    {
        if (esc_html($args['id']) == 'easylgpd_setting_geral_modal_confirm') {
            printf('<p class="description">%s</p>', 'Configurações principais para o modal de confirmação');
        }

        if (esc_html($args['id']) == 'easylgpd_setting_geral_modal_cookies') {
            printf('<p class="description">%s</p>', 'Configurações principais para o modal de cookies');
        }
    }

    public function modal_confirm_title_callback()
    {
        printf('<input class="regular-text" type="text" name="easylgpd_geral[modal_confirm_title]" value="%s">', $this->get_option('options_geral', 'modal_confirm_title'));
    }

    public function modal_confirm_info_callback()
    {
        printf('<textarea class="regular-text" name="easylgpd_geral[modal_confirm_info]">%s</textarea>', $this->get_option('options_geral', 'modal_confirm_info'));
    }

    public function modal_confirm_btn_label_callback()
    {
        printf('<input class="regular-text" type="text" name="easylgpd_geral[modal_confirm_btn_label]" value="%s">', $this->get_option('options_geral', 'modal_confirm_btn_label'));
    }

    public function modal_cookies_title_callback()
    {
        printf('<input class="regular-text" type="text" name="easylgpd_geral[modal_cookies_title]" value="%s">', $this->get_option('options_geral', 'modal_cookies_title'));
    }

    public function get_option($option, $key, $value = null, $defaul = '')
    {
        if ($value) {
            return isset($this->$option[$key]) && esc_attr($this->$option[$key]) == $value ? esc_attr($this->$option[$key]) : $defaul;
        }

        return isset($this->$option[$key]) ? esc_attr($this->$option[$key]) : $defaul;
    }
}

new Easylgpd_Admin();
