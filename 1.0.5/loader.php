<?php
/*
* Plugin Name: tinychat-group-chat
* Plugin URI: https://www.ruddernation.com/downloads/wordpress-plugins/tinychat-group-chat
* Author: Ruddernation Designs
* Author URI: http://profiles.wordpress.org/ruddernation
* Description: This plugin is used for BuddyPress to all Group creators to allow the use of TinyChat in groups,
* The Chat also include youtube/soundcloud for all users, Even if you're a moderator or not.
* Version: 1.0.5
* Requires at least: WordPress 3.6.0, BuddyPress 1.8.1
* Tested up to: WordPress 3.9.1 / BuddyPress 2.0.1
* Site Wide Only: true
* Date: 10th July 2014
* License: GPL
* License URI: http://www.gnu.org/licenses/gpl-2.0.html
* Important - Only load the component if BuddyPress is activated! 
*/

function bp_tinychat_group_chat_init() {

	require( dirname( __FILE__ ) . '/includes/bp-tinychat-group-chat-core.php' );

}

add_action( 'bp_init', 'bp_tinychat_group_chat_init' );

function bp_tinychat_group_chat_activate() {

	global $wpdb;

	if ( !empty($wpdb->charset) )

		$charset_collate = "DEFAULT CHARACTER SET $wpdb->charset";

	$sql[] = "CREATE TABLE {$wpdb->base_prefix}bp_tinychat_group_chat (

		  		id bigint(20) NOT NULL AUTO_INCREMENT PRIMARY KEY,

		  		group_id bigint(20) NOT NULL,

		  		user_id bigint(20) NOT NULL,

		  		message_content text

		 	   ) {$charset_collate};";

	$sql[] = "CREATE TABLE {$wpdb->base_prefix}bp_tinychat_group_chat_online (

		  		id bigint(20) NOT NULL AUTO_INCREMENT PRIMARY KEY,

		  		group_id bigint(20) NOT NULL,

		  		user_id bigint(20) NOT NULL,

		  		timestamp int(11) NOT NULL

		 	   ) {$charset_collate};";

	require_once( ABSPATH . 'wp-admin/upgrade-functions.php' );

	dbDelta($sql);

	update_site_option( 'bp-tinychat-group-chat-db-version', BP_TINYCHAT_GROUP_CHAT_DB_VERSION );

}

register_activation_hook( __FILE__, 'bp_tinychat_group_chat_activate' ); ?>