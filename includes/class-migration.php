<?php

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

class Easyap_Migration
{
    public function __construct()
    {
        register_activation_hook(EASYAP_FILE, array($this, 'easyap_install'));
    }

    public function easyap_install()
    {
        $this->create_table_easyap_tag_manager();

        update_option('easyap_db_vesion', EASYAP_DB_VERSION);
    }

    public function create_table_easyap_tag_manager()
    {
        global $wpdb;

        $table = $wpdb->prefix . 'easyap_tag_manager';
        $charset_collate = $wpdb->get_charset_collate();

        $sql = "CREATE TABLE $table (
            id mediumint(9) NOT NULL AUTO_INCREMENT,
            title VARCHAR(255) NOT NULL,
            category VARCHAR(50) NOT NULL,
            cookies TEXT,
            PRIMARY KEY (id)
        ) $charset_collate;";

        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
        dbDelta($sql);
    }
}

new Easyap_Migration();
