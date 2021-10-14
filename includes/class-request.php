<?php

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

class Easyap_Request
{
    public function __construct()
    {
        add_action('wp_ajax_save_tag', array($this, 'save_tag'));

        add_action('admin_enqueue_scripts', array($this, 'admin_enqueue_scripts'));
    }

    public function admin_enqueue_scripts()
    {
        wp_enqueue_script('easyap-admin-http', EASYAP_URL . 'assets/js/admin-request.js', array('jquery'), '1.0.0', true);
        wp_localize_script('easyap-admin-http', 'easyap_obj', array('ajax_url' => admin_url('admin-ajax.php')));
    }

    public function save_tag()
    {
        $title = sanitize_text_field($_POST['title']);
        $category = sanitize_text_field($_POST['category']);
        $scripts = filter_input(INPUT_POST, 'scripts', FILTER_SANITIZE_SPECIAL_CHARS);

        var_dump($title, $category, html_entity_decode($scripts, ENT_QUOTES, "utf-8"));

        echo 'ok';

        wp_die();
    }
}

new Easyap_Request();
