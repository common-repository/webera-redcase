<?php 

function d_admin_enqueue() {
    global $typenow;

    if( $typenow !== 'deals' ) {
        return;
    }

    wp_register_style( 'd_bootstrap', plugins_url('assets/css/style/style.css', DEALS_PLUGIN_URL ) );
    wp_enqueue_style( 'd_bootstrap' );
}