<?php

function deals_admin_init() {
    include( 'create-metaboxes.php' );
    include( 'deals-options.php' );
    include( 'enqueue.php' );
    
    add_action( 'add_meta_boxes_deals', 'd_create_metaboxes' );
    add_action( 'admin_enqueue_scripts', 'd_admin_enqueue' );
    add_filter( 'manage_edit-deals_columns', 'add_new_recipe_columns' );
}