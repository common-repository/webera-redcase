<?php

function d_generate_daily_deals() {
    global $wpdb;
    $deals_id           =  $wpdb->get_var("SELECT `ID` FROM `" . $wpdb->post . "` 
                                           WHERE post_status='publish' AND post_type='deals'
                                           ORDER BY rand() LIMIT 1");

    set_transient( 'd_daily_deals', $deals_id, 60 * 60 * 24 );
}