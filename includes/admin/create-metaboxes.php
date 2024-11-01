<?php

function d_create_metaboxes() {
    add_meta_box(
        'd_deals_options_mb',
        __( 'Deals options', 'deals' ),
        'd_deals_options_mb',
        'deals',
        'normal',
        'high'
    );
}