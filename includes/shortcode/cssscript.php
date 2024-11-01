<?php
	
	function callback_for_setting_up_scripts() {
	    wp_register_style( 'namespace', plugins_url('assets/css/style/style.css', DEALS_PLUGIN_URL ) );
	    wp_enqueue_style( 'namespace' );
	    wp_enqueue_script( 'namespaceformyscript', 'http://locationofscript.com/myscript.js', array( 'jquery' ) );
	}