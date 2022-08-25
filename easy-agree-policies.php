<?php

/**
 * Plugin Name:       Easy agree policies
 * Plugin URI:        https://example.com/plugins/the-basics/
 * Description:       Suitability to policies!
 * Version:           1.0.0
 * Requires at least: 5.8
 * Requires PHP:      7.2
 * Author:            Higor Christian
 * Author URI:        https://www.linkedin.com/in/higorch/
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       easyap
 * Domain Path:       /languages
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

define('EASYAP_DB_VERSION', '1.0');
define('EASYAP_FILE', __FILE__);
define('EASYAP_URL', plugin_dir_url(EASYAP_FILE));
define('EASYAP_PATH', plugin_dir_path(EASYAP_FILE));

require_once EASYAP_PATH . 'includes/helpers.php';
require_once EASYAP_PATH . 'includes/class-migration.php';
require_once EASYAP_PATH . 'includes/class-request.php';
require_once EASYAP_PATH . 'includes/class-admin.php';
require_once EASYAP_PATH . 'includes/class-frontend.php';
