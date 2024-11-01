<?php
/**
 * Plugin Name: Redcase Deals
 * Description: A Deals Wordpress plugin that allows users to create  deals
 * Version: 4.2
 * Author: Webera: 
 * Author: URI: 
 * Text
 */

 if( !function_exists( 'add_action' ) ) {
    echo 'Not allowed!';
    exit();
 }

 // Setup
 define( 'DEALS_PLUGIN_URL', __FILE__ );


 // Includes
include( 'includes/activate.php' );
include( 'includes/deactivate.php' );
include('includes/shortcode/show.php');
include('includes/shortcode/show_single.php');
include( 'includes/init.php' );

include( 'includes/admin/config.php' );

 // Hooks
register_activation_hook( __FILE__, 'd_activate_plugin' );
register_deactivation_hook( __FILE__, 'd_deactive_plugin' );

add_action( 'init', 'deals_init' );
add_filter('rewrite_rules_array', 'add_rewrite_rules');
add_filter('query_vars', 'redcase_query_vars');
//add_action( 'admin_init', 'deals_admin_init' );

 // shortcodes
 add_shortcode('show_deals', 'd_show_deals_shortcode');
 add_shortcode('show_single_deal', 'd_show_single_deal_shortcode');
