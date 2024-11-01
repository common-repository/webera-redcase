<?php

function d_save_post_admin( $post_id, $post, $update ) {
    if( !$update ) {
        return;
    }

    $deals_data              =  array();
    $deals['url_deals']        =  sanitize_text_field( $_POST['d_inputSheer'] );

    update_post_meta( $post_id, 'deals_data', $deals_data );
}