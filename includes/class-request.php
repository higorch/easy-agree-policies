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
        add_action('wp_ajax_edit_tag', array($this, 'edit_tag'));
        add_action('wp_ajax_remove_tag', array($this, 'remove_tag'));
    }

    public function admin_enqueue_scripts()
    {
        wp_enqueue_script('easyap-admin-http', EASYAP_URL . 'assets/js/admin-request.js', array('jquery'), '1.0.2', true);
        wp_localize_script('easyap-admin-http', 'easyap_obj', array('ajax_url' => admin_url('admin-ajax.php')));
    }

    public function save_tag()
    {
        global $wpdb;

        $table = $wpdb->prefix . 'easyap_tag_manager';

        $id = (int) sanitize_text_field($_POST['id']);
        $cookies = maybe_serialize(json_decode(stripslashes($_POST['cookies'])));

        $data = [
            'title' => sanitize_text_field($_POST['title']),
            'category' => sanitize_text_field($_POST['category']),
            'cookies' => $cookies == '[]' ? null : $cookies,
        ];

        $format = array('%s', '%s', '%s');

        if ($id) {
            $where_format = array('%d');
            $where = array('id' => $id);
            echo $wpdb->update($table, $data, $where, $format, $where_format);
        } else {
            $wpdb->insert($table, $data, $format);
            echo $wpdb->insert_id;
        }

        wp_die();
    }

    public function load_table_tag()
    {
        global $wpdb;

        $data = [];

        $table = $wpdb->prefix . 'easyap_tag_manager';
        $results = $wpdb->get_results("SELECT * FROM {$table}", ARRAY_A);

        if ($results) {
            foreach ($results as $result) {
                $data[$result['category']][] = [
                    'id' => $result['id'],
                    'title' => $result['title']
                ];
            }
        }

        echo json_encode($data, JSON_UNESCAPED_UNICODE);

        wp_die();
    }

    public function edit_tag()
    {
        global $wpdb;

        $id = (int) sanitize_text_field($_GET['id']);

        $table = $wpdb->prefix . 'easyap_tag_manager';
        $tag = $wpdb->get_row($wpdb->prepare("SELECT * FROM $table WHERE id = %d", $id), ARRAY_A);

        $data['id'] = $tag['id'];
        $data['title'] = $tag['title'];
        $data['category'] = $tag['category'];
        $data['cookies'] = maybe_unserialize($tag['cookies']);

        echo json_encode($data, JSON_UNESCAPED_UNICODE);

        wp_die();
    }

    public function remove_tag()
    {
        global $wpdb;

        echo $wpdb->delete(
            $wpdb->prefix . 'easyap_tag_manager',
            ['id' => (int) sanitize_text_field($_POST['id'])],
            ['%d'],
        );
    }
}

new Easyap_Request();
