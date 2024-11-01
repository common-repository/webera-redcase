<?php

function redcase_create_db() {
	get_charset_collate();
	require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
	
	//* Create the teams table
	$table_name = $wpdb->prefix . 'redcase_key';
	
	$sql = "CREATE TABLE $table_name (
	id INTEGER NOT NULL AUTO_INCREMENT,
	private_key TEXT NOT NULL,
	PRIMARY KEY (team_id)
	) $charset_collate;";
	dbDelta( $sql );
}