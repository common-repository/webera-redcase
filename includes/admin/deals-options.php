<?php

function d_deals_options_mb( $post ) {
    $deals_data         =  get_post_meta( $post->ID, 'deals_data', true );

    if( !$deals_data ) {
        $deals_data     =  array(
            'url_deals' => ''
        );
    }

    ?>
    <div class="form-group">
        <label>SheerID URL</label>
        <input type="text" class="form-control" name="d_inputSheer">
    </div>
    <?php
}