<?php

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

class Easyap_Request
{
    public function __construct()
    {
        add_action('admin_enqueue_scripts', array($this, 'admin_enqueue_scripts'));

        add_action('wp_ajax_save_tag', array($this, 'save_tag'));
        add_action('wp_ajax_load_table_tag', array($this, 'load_table_tag'));
    }

    public function admin_enqueue_scripts()
    {
        wp_enqueue_script('easyap-admin-http', EASYAP_URL . 'assets/js/admin-request.js', array('jquery'), '1.0.0', true);
        wp_localize_script('easyap-admin-http', 'easyap_obj', array('ajax_url' => admin_url('admin-ajax.php')));
    }

    public function save_tag()
    {
        global $wpdb;

        $table = $wpdb->prefix . 'easyap_tag_manager';
        $format = array('%s', '%s', '%s');

        $scripts = filter_input(INPUT_POST, 'scripts', FILTER_SANITIZE_SPECIAL_CHARS);

        $data = [
            'title' => sanitize_text_field($_POST['title']),
            'category' => sanitize_text_field($_POST['category']),
            'tag' => $scripts == '[]' ? null : $scripts,
        ];

        $wpdb->insert($table, $data, $format);

        echo 'ok';

        wp_die();
    }

    public function load_table_tag()
    {
        // html_entity_decode($data['scripts'], ENT_QUOTES, "utf-8");
    }
}

new Easyap_Request();
