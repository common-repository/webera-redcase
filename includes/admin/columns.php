<?php

function add_new_deals_columns( $columns ) {
    $new_columns                 = array();
    $new_columns['cb']           = '<input type="checkbox" />';
    $new_columns['title']        = __('Title', 'deals');
    $new_columns['author']       = __('Author', 'deals');
    $new_columns['categories']   = __('Categories', 'deals');
    $new_columns['date']         = __('Date', 'deals');

    return $new_columns;
}
