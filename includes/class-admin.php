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
        add_action('admin_enqueue_scripts', array($this, 'enqueue_scripts'));

        add_shortcode('easyp_link', array($this, 'easyp_link_shortcode'));
    }

    public function easyp_link_shortcode($atts, $content = null)
    {
        $a = shortcode_atts(array(
            'text' => '',
            'href' => '',
            'target' => '',
        ), $atts);

        ob_start();

        echo "<a href='{$a['href']}' target='{$a['target']}'>{$a['text']}</a>";
        return ob_get_clean();
    }

    public function enqueue_scripts($page)
    {
        if ('toplevel_page_easy-agree-policies' != $page) return;

        wp_enqueue_style('wp-color-picker');
        wp_enqueue_style('easyap-admin', EASYAP_URL . 'assets/css/admin.css', null, '1.0.4');

        wp_enqueue_script('wp-color-picker-alpha', EASYAP_URL . 'assets/plugins/wp-color-picker-alpha/wp-color-picker-alpha.min.js', array('wp-color-picker'), '1.0.0', true);
        wp_enqueue_script('easyap-admin', EASYAP_URL . 'assets/js/admin.js', array('jquery'), '1.0.4', true);
    }

    public function menu_page()
    {
        add_menu_page(__('Easy agree policies', 'easyap'), 'Agree policies', 'manage_options', 'easy-agree-policies', array($this, 'configs'), 'dashicons-analytics');
    }

    public function configs()
    {
        if (is_file(EASYAP_PATH . 'templates/admin/config-admin.php'))
            require_once EASYAP_PATH . 'templates/admin/config-admin.php';
    }

    public function register_settings()
    {
        // Geral
        register_setting('easyap_geral', 'easyap_geral',  array($this, 'easyap_geral_sanitize'));

        add_settings_section('easyap_setting_geral_modal_consent',  __('Modal consentimento', 'easyap'),  array($this, 'print_section_info'),  'easyap-setting-geral');
        add_settings_field('modal_consent_title', __('Título', 'easyap'), array($this, 'modal_consent_title'), 'easyap-setting-geral', 'easyap_setting_geral_modal_consent');
        add_settings_field('modal_consent_info', __('Informações', 'easyap'), array($this, 'modal_consent_info'), 'easyap-setting-geral', 'easyap_setting_geral_modal_consent');
        add_settings_field('modal_consent_btn_accept_label', __('Label botão "aceito"', 'easyap'), array($this, 'modal_consent_btn_accept_label'), 'easyap-setting-geral', 'easyap_setting_geral_modal_consent');
        add_settings_field('modal_consent_btn_options_details_label', __('Label botão "opções"', 'easyap'), array($this, 'modal_consent_btn_options_details_label'), 'easyap-setting-geral', 'easyap_setting_geral_modal_consent');
        add_settings_field('modal_consent_defalt', __('Consentimento por default', 'easyap'), array($this, 'modal_consent_defalt'), 'easyap-setting-geral', 'easyap_setting_geral_modal_consent');

        add_settings_section('easyap_setting_geral_modal_options', __('Modal opções', 'easyap'),  array($this, 'print_section_info'),  'easyap-setting-geral');
        add_settings_field('modal_options_title', __('Título', 'easyap'), array($this, 'modal_options_title_input'), 'easyap-setting-geral', 'easyap_setting_geral_modal_options');
        add_settings_field('modal_options_save_preferences_label', __('Label botão "salvar"', 'easyap'), array($this, 'modal_options_save_preferences_label'), 'easyap-setting-geral', 'easyap_setting_geral_modal_options');

        // Styles
        register_setting('easyap_styles', 'easyap_styles', array($this, 'easyap_styles_sanitize'));

        add_settings_section('easyap_setting_styles_modal_consent_position', __('Posição modal consentimento', 'easyap'),  array($this, 'print_section_info'),  'easyap-setting-styles');
        add_settings_field('modal_consent_position_horizontal', __('Alinhamento horizontal', 'easyap'), array($this, 'modal_consent_position_horizontal'), 'easyap-setting-styles', 'easyap_setting_styles_modal_consent_position');

        add_settings_section('easyap_setting_styles_modal_consent_colors', __('Cores modal consentimento', 'easyap'),  array($this, 'print_section_info'),  'easyap-setting-styles');
        add_settings_field('modal_consent_text_color', __('Textos', 'easyap'), array($this, 'modal_consent_text_color'), 'easyap-setting-styles', 'easyap_setting_styles_modal_consent_colors');
        add_settings_field('modal_consent_link_color', __('Links', 'easyap'), array($this, 'modal_consent_link_color'), 'easyap-setting-styles', 'easyap_setting_styles_modal_consent_colors');
        add_settings_field('modal_consent_bg_color', __('Fundo', 'easyap'), array($this, 'modal_consent_bg_color'), 'easyap-setting-styles', 'easyap_setting_styles_modal_consent_colors');
        add_settings_field('modal_consent_btn_aceept_text_color', __('Texto botão "aceito"', 'easyap'), array($this, 'modal_consent_btn_aceept_text_color'), 'easyap-setting-styles', 'easyap_setting_styles_modal_consent_colors');
        add_settings_field('modal_consent_btn_aceept_bg_color', __('Fundo botão "aceito"', 'easyap'), array($this, 'modal_consent_btn_aceept_bg_color'), 'easyap-setting-styles', 'easyap_setting_styles_modal_consent_colors');
        add_settings_field('modal_consent_btn_options_details_text_color', __('Texto botão "opções"', 'easyap'), array($this, 'modal_consent_btn_options_details_text_color'), 'easyap-setting-styles', 'easyap_setting_styles_modal_consent_colors');
        add_settings_field('modal_consent_btn_options_details_bg_color', __('Fundo botão "opções"', 'easyap'), array($this, 'modal_consent_btn_options_details_bg_color'), 'easyap-setting-styles', 'easyap_setting_styles_modal_consent_colors');
    }

    public function easyap_geral_sanitize($input)
    {
        $inputs = array();

        if (isset($input['modal_consent_title']))
            $inputs['modal_consent_title'] = sanitize_text_field($input['modal_consent_title']);

        if (isset($input['modal_consent_info']))
            $inputs['modal_consent_info'] = sanitize_text_field($input['modal_consent_info']);

        if (isset($input['modal_consent_btn_accept_label']))
            $inputs['modal_consent_btn_accept_label'] = sanitize_text_field($input['modal_consent_btn_accept_label']);

        if (isset($input['modal_consent_btn_options_details_label']))
            $inputs['modal_consent_btn_options_details_label'] = sanitize_text_field($input['modal_consent_btn_options_details_label']);

        if (isset($input['modal_options_title']))
            $inputs['modal_options_title'] = sanitize_text_field($input['modal_options_title']);

        if (isset($input['modal_options_save_preferences_label']))
            $inputs['modal_options_save_preferences_label'] = sanitize_text_field($input['modal_options_save_preferences_label']);

        if (isset($input['modal_consent_defalt']))
            $inputs['modal_consent_defalt'] = sanitize_text_field($input['modal_consent_defalt']);

        return $inputs;
    }

    public function easyap_styles_sanitize($input)
    {
        $inputs = array();

        if (isset($input['modal_consent_position_horizontal']))
            $inputs['modal_consent_position_horizontal'] = sanitize_text_field($input['modal_consent_position_horizontal']);

        if (isset($input['modal_consent_text_color']))
            $inputs['modal_consent_text_color'] = sanitize_text_field($input['modal_consent_text_color']);

        if (isset($input['modal_consent_link_color']))
            $inputs['modal_consent_link_color'] = sanitize_text_field($input['modal_consent_link_color']);

        if (isset($input['modal_consent_bg_color']))
            $inputs['modal_consent_bg_color'] = sanitize_text_field($input['modal_consent_bg_color']);

        if (isset($input['modal_consent_btn_aceept_text_color']))
            $inputs['modal_consent_btn_aceept_text_color'] = sanitize_text_field($input['modal_consent_btn_aceept_text_color']);

        if (isset($input['modal_consent_btn_aceept_bg_color']))
            $inputs['modal_consent_btn_aceept_bg_color'] = sanitize_text_field($input['modal_consent_btn_aceept_bg_color']);

        if (isset($input['modal_consent_btn_options_details_text_color']))
            $inputs['modal_consent_btn_options_details_text_color'] = sanitize_text_field($input['modal_consent_btn_options_details_text_color']);

        if (isset($input['modal_consent_btn_options_details_bg_color']))
            $inputs['modal_consent_btn_options_details_bg_color'] = sanitize_text_field($input['modal_consent_btn_options_details_bg_color']);

        return $inputs;
    }

    public function print_section_info($args)
    {
        if (esc_html($args['id']) == 'easyap_setting_geral_modal_consent') {
            printf('<p class="description">%s</p>', __('Configurações para o modal de consentimento', 'easyap'));
        }

        if (esc_html($args['id']) == 'easyap_setting_geral_modal_options') {
            printf('<p class="description">%s</p>',  __('Configurações para o modal de opções', 'easyap'));
        }
    }

    public function modal_consent_title()
    {
        printf('<input class="regular-text" type="text" name="easyap_geral[modal_consent_title]" value="%s">', get_option_easyap('easyap_geral', 'modal_consent_title'));
    }

    public function modal_consent_info()
    {
        printf('<textarea class="regular-text" name="easyap_geral[modal_consent_info]">%s</textarea>', get_option_easyap('easyap_geral', 'modal_consent_info'));
    }

    public function modal_consent_btn_accept_label()
    {
        printf('<input class="regular-text" type="text" name="easyap_geral[modal_consent_btn_accept_label]" value="%s">', get_option_easyap('easyap_geral', 'modal_consent_btn_accept_label'));
    }

    public function modal_consent_btn_options_details_label()
    {
        printf('<input class="regular-text" type="text" name="easyap_geral[modal_consent_btn_options_details_label]" value="%s">', get_option_easyap('easyap_geral', 'modal_consent_btn_options_details_label'));
    }

    public function modal_consent_defalt()
    {
        $op = get_option_easyap('easyap_geral', 'modal_consent_defalt');

        $no = $op == 'no' ? "selected" : "";
        $yes = $op == 'yes' ? "selected" : "";

        echo '<select name="easyap_geral[modal_consent_defalt]">';
        echo '<option ' . $no . ' value="no">' . __('Não', 'easyap') . '</option>';
        echo '<option ' . $yes . ' value="yes">' . __('Sim', 'easyap') . '</option>';
        echo '</select>';
    }

    public function modal_options_title_input()
    {
        printf('<input class="regular-text" type="text" name="easyap_geral[modal_options_title]" value="%s">', get_option_easyap('easyap_geral', 'modal_options_title'));
    }

    public function modal_options_save_preferences_label()
    {
        printf('<input class="regular-text" type="text" name="easyap_geral[modal_options_save_preferences_label]" value="%s">', get_option_easyap('easyap_geral', 'modal_options_save_preferences_label'));
    }

    public function modal_consent_position_horizontal()
    {
        $op = get_option_easyap('easyap_styles', 'modal_consent_position_horizontal', null);

        $left = $op == 'left' || $op == null ? "selected" : "";
        $right = $op == 'right' ? "selected" : "";

        echo '<select name="easyap_styles[modal_consent_position_horizontal]">';
        echo '<option ' . $left . ' value="left">' . __('Esquerda', 'easyap') . '</option>';
        echo '<option ' . $right . ' value="right">' . __('Direita', 'easyap') . '</option>';
        echo '</select>';
    }

    public function modal_consent_text_color()
    {
        $color = 'rgb(232, 241, 242)';
        printf('<input class="color-picker" data-alpha-enabled="true" type="text" name="easyap_styles[modal_consent_text_color]" value="%s">', get_option_easyap('easyap_styles', 'modal_consent_text_color', null, $color));
    }

    public function modal_consent_link_color()
    {
        $color = 'rgb(27, 152, 224)';
        printf('<input class="color-picker" data-alpha-enabled="true" type="text" name="easyap_styles[modal_consent_link_color]" value="%s">', get_option_easyap('easyap_styles', 'modal_consent_link_color', null, $color));
    }

    public function modal_consent_bg_color()
    {
        $color = 'rgb(19, 41, 61)';
        printf('<input class="color-picker" data-alpha-enabled="true" type="text" name="easyap_styles[modal_consent_bg_color]" value="%s">', get_option_easyap('easyap_styles', 'modal_consent_bg_color', null, $color));
    }

    public function modal_consent_btn_aceept_text_color()
    {
        $color = 'rgb(232, 241, 242)';
        printf('<input class="color-picker" data-alpha-enabled="true" type="text" name="easyap_styles[modal_consent_btn_aceept_text_color]" value="%s">', get_option_easyap('easyap_styles', 'modal_consent_btn_aceept_text_color', null, $color));
    }

    public function modal_consent_btn_aceept_bg_color()
    {
        $color = 'rgb(36, 123, 160)';
        printf('<input class="color-picker" data-alpha-enabled="true" type="text" name="easyap_styles[modal_consent_btn_aceept_bg_color]" value="%s">', get_option_easyap('easyap_styles', 'modal_consent_btn_aceept_bg_color', null,  $color));
    }

    public function modal_consent_btn_options_details_text_color()
    {
        $color = 'rgb(36, 123, 160)';
        printf('<input class="color-picker" data-alpha-enabled="true" type="text" name="easyap_styles[modal_consent_btn_options_details_text_color]" value="%s">', get_option_easyap('easyap_styles', 'modal_consent_btn_options_details_text_color', null, $color));
    }

    public function modal_consent_btn_options_details_bg_color()
    {
        $color = 'rgb(232, 241, 242)';
        printf('<input class="color-picker" data-alpha-enabled="true" type="text" name="easyap_styles[modal_consent_btn_options_details_bg_color]" value="%s">', get_option_easyap('easyap_styles', 'modal_consent_btn_options_details_bg_color', null, $color));
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
