<?php

if (!defined('WP_UNINSTALL_PLUGIN')) {
    exit();
}

global $wpdb;

$wpdb->query("DROP_TABLE_IF_EXISTS_" . $wpdb->prefix . "deals");