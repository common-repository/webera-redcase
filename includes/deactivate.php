<?php

function d_deactive_plugin() {
    wp_clear_scheduled_hook( 'd_daily_deals_hook' );
}