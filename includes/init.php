<?php 

function deals_init() {

	add_rewrite_rule( '^deal/([^/]*)/?', '\/deal(|\/|\/?\?.+)$','top' );

	if ( is_admin() )
		return;
	wp_register_style( 'd_icon', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css' );
	wp_enqueue_style( 'd_icon' );
	
    wp_register_style( 'd_bootstrap', 'https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css' );
	wp_enqueue_style( 'd_bootstrap' );
	
	wp_register_style( 'd_style', plugins_url('assets/css/style.css', DEALS_PLUGIN_URL ) );
	wp_enqueue_style( 'd_style' );

	wp_register_script( 'sheerid_script_jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js' );
	wp_enqueue_script( 'sheerid_script_jquery' );
	
	wp_register_script( 'sheerid_script_popper', 'https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js' );
	wp_enqueue_script( 'sheerid_script_popper' );
	
	wp_register_script( 'sheerid_script_bootstrap', 'https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js' );
	wp_enqueue_script( 'sheerid_script_bootstrap' );
		
	wp_register_script( 'sheerid_script', 'https://services-sandbox.sheerid.com/jsapi/SheerID.js' );
	wp_enqueue_script( 'sheerid_script' );	
		
	wp_register_script( 'd_script', plugins_url('assets/js/script.js', DEALS_PLUGIN_URL ) );
	wp_enqueue_script( 'd_script' );
}