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
        add_action('admin_notices', array($this, 'general_admin_notice'));
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

        add_settings_section('easyap_setting_geral_modal_consent',  __('Modal consentimento', 'easyap'),  array($this, 'print_section_info'),  'easyap-setting-geral');
        add_settings_field('modal_consent_title', __('Título', 'easyap'), array($this, 'modal_consent_title_input'), 'easyap-setting-geral', 'easyap_setting_geral_modal_consent');
        add_settings_field('modal_consent_info', __('Informações', 'easyap'), array($this, 'modal_consent_info_input'), 'easyap-setting-geral', 'easyap_setting_geral_modal_consent');
        add_settings_field('modal_consent_btn_accept_label', __('Label botão "aceito"', 'easyap'), array($this, 'modal_consent_btn_accept_label_input'), 'easyap-setting-geral', 'easyap_setting_geral_modal_consent');
        add_settings_field('modal_consent_btn_decline_label', __('Label botão "não aceito"', 'easyap'), array($this, 'modal_consent_btn_decline_label_input'), 'easyap-setting-geral', 'easyap_setting_geral_modal_consent');

        add_settings_section('easyap_setting_geral_modal_cookies', __('Modal cookies', 'easyap'),  array($this, 'print_section_info'),  'easyap-setting-geral');
        add_settings_field('modal_cookies_title', __('Título', 'easyap'), array($this, 'modal_cookies_title_input'), 'easyap-setting-geral', 'easyap_setting_geral_modal_cookies');

        register_setting('easyap_links', 'easyap_links', array($this, 'sanitize'));
    }

    public function sanitize($input)
    {
        $inputs = array();

        if (isset($input['modal_consent_title']))
            $inputs['modal_consent_title'] = sanitize_text_field($input['modal_consent_title']);

        if (isset($input['modal_consent_info']))
            $inputs['modal_consent_info'] = sanitize_text_field($input['modal_consent_info']);

        if (isset($input['modal_consent_btn_accept_label']))
            $inputs['modal_consent_btn_accept_label'] = sanitize_text_field($input['modal_consent_btn_accept_label']);

        if (isset($input['modal_consent_btn_decline_label']))
            $inputs['modal_consent_btn_decline_label'] = sanitize_text_field($input['modal_consent_btn_decline_label']);

        if (isset($input['modal_cookies_title']))
            $inputs['modal_cookies_title'] = sanitize_text_field($input['modal_cookies_title']);

        return $inputs;
    }

    public function print_section_info($args)
    {
        if (esc_html($args['id']) == 'easyap_setting_geral_modal_consent') {
            printf('<p class="description">%s</p>', __('Configurações para o modal de consentimento', 'easyap'));
        }

        if (esc_html($args['id']) == 'easyap_setting_geral_modal_cookies') {
            printf('<p class="description">%s</p>',  __('Configurações para o modal de cookies', 'easyap'));
        }
    }

    public function modal_consent_title_input()
    {
        printf('<input class="regular-text" type="text" name="easyap_geral[modal_consent_title]" value="%s">', get_option_easyap('easyap_geral', 'modal_consent_title'));
    }

    public function modal_consent_info_input()
    {
        printf('<textarea class="regular-text" name="easyap_geral[modal_consent_info]">%s</textarea>', get_option_easyap('easyap_geral', 'modal_consent_info'));
    }

    public function modal_consent_btn_accept_label_input()
    {
        printf('<input class="regular-text" type="text" name="easyap_geral[modal_consent_btn_accept_label]" value="%s">', get_option_easyap('easyap_geral', 'modal_consent_btn_accept_label'));
    }

    public function modal_consent_btn_decline_label_input()
    {
        printf('<input class="regular-text" type="text" name="easyap_geral[modal_consent_btn_decline_label]" value="%s">', get_option_easyap('easyap_geral', 'modal_consent_btn_decline_label'));
    }

    public function modal_cookies_title_input()
    {
        printf('<input class="regular-text" type="text" name="easyap_geral[modal_cookies_title]" value="%s">', get_option_easyap('easyap_geral', 'modal_cookies_title'));
    }

    public function general_admin_notice()
    {
        $screen = get_current_screen();

        if ($screen->id != 'toplevel_page_easy-agree-policies') return;

        if (isset($_GET['settings-updated'])) {
            if ($_GET['settings-updated'] === 'true') {
                printf('<div class="%1$s"><p>%2$s</p></div>', 'notice notice-success is-dismissible', __('Configurações salvas com sucesso', 'easyap'));
            } else {
                printf('<div class="%1$s"><p>%2$s</p></div>', 'notice notice-error is-dismissible', __('Não foi possível salvar as configurações', 'easyap'));
            }
        }
    }
}

new Easyap_Admin();
