<?php

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

if (!function_exists('get_option_easyap')) {

    function get_option_easyap($option, $key, $value = null, $defaul = '')
    {
        $opt = get_option($option);

        if ($value) {
            return isset($opt[$key]) && !empty($opt[$key]) && esc_attr($opt[$key]) == $value ? esc_attr($opt[$key]) : $defaul;
        }

        return isset($opt[$key]) && !empty($opt[$key]) ? esc_attr($opt[$key]) : $defaul;
    }
}
