<?php

/**
 * 启动插件
 */
function koala_bing_img_register_activation_hook() {
	global $wpdb;
	$table_name = BING_IMAGES_TABLE_NAME;
	if ( $wpdb->get_var( "show tables like '$table_name'" ) != $table_name ) {
		$sql = "CREATE TABLE IF NOT EXISTS `$table_name` (
                `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT ,
                `origin_url` VARCHAR(191) NULL DEFAULT NULL , 
                `self_url` VARCHAR(191) NULL DEFAULT NULL , 
                `info` LONGTEXT NULL DEFAULT NULL , 
                `view` BIGINT NOT NULL DEFAULT '0' , 
                `download` BIGINT NOT NULL DEFAULT '0' , 
                `like` BIGINT NOT NULL DEFAULT '0' , 
                `created_at` TIMESTAMP NULL DEFAULT NULL , 
                PRIMARY KEY (`id`)
			) ENGINE = InnoDB;";

		require_once( ABSPATH . 'wp-admin/upgrade-functions.php' );
		dbDelta( $sql );
	}
}


/**
 * 卸载插件
 */
function koala_bing_img_register_uninstall_hook() {
//	global $wpdb;
//	$table_name = BING_IMAGES_TABLE_NAME;
//	if ( $wpdb->get_var( "show tables like '$table_name'" ) == $table_name ) {
//		$sql = 'DROP TABLE  `' . $table_name . '`';
//		$wpdb->query( $sql );
//	}

	if ( wp_next_scheduled( 'koala_bing_img_daily_function_hook' ) ) {
		wp_unschedule_event( wp_next_scheduled( 'koala_bing_img_daily_function_hook' ), "koala_bing_img_daily_function_hook" );
	}
}