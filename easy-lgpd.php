<?php

/**
 * Plugin Name:       Easy agree policies
 * Plugin URI:        https://example.com/plugins/the-basics/
 * Description:       Suitability to policies.
 * Version:           1.0.0
 * Requires at least: 5.2
 * Requires PHP:      7.2
 * Author:            Higor Christian
 * Author URI:        https://www.linkedin.com/in/higorch/
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       easylgpd
 * Domain Path:       /languages
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

define('EASY_LGPD_URL', plugin_dir_url(__FILE__));
define('EASY_LGPD_PATH', plugin_dir_path(__FILE__));

require_once EASY_LGPD_PATH . 'includes/helpers.php';
require_once EASY_LGPD_PATH . 'includes/class-admin.php';
require_once EASY_LGPD_PATH . 'includes/class-frontend.php';
