<?php

const PLUGIN_URL = "https://www.oskoala.com/wordpress-plugin-koala-bingwallpaper";

/**
 * Plugin Name: 必应壁纸
 * Plugin URI: https://www.oskoala.com/wordpress-plugin-koala-bingwallpaper
 * Description: WordPress 必应壁纸 插件
 * Version: 1.0.0
 * Author: 考拉开源
 * Author URI: https://www.oskoala.com/
 */


/**
 * 函数命名规则
 * 函数名称： koala_bing_img_{function_name}
 */
define( 'koala_bing_img_dir', plugin_dir_path( __FILE__ ) );

require_once "admin/index.php";

date_default_timezone_set( "PRC" );
show_admin_bar( false );
register_activation_hook( __FILE__, "koala_bing_img_register_activation_hook" );
register_uninstall_hook( __FILE__, 'koala_bing_img_register_uninstall_hook' );


function koala_bing_img_more_recurrences() {
	return array(
		'minute' => array( 'interval' => 60, 'display' => 'one minute' ),
	);
}

add_filter( 'cron_schedules', 'koala_bing_img_more_recurrences' );

//if ( wp_next_scheduled( 'koala_bing_img_daily_function_hook' ) ) {
//	wp_unschedule_event( wp_next_scheduled( 'koala_bing_img_daily_function_hook' ), "koala_bing_img_daily_function_hook" );
//}

if ( ! wp_next_scheduled( 'koala_bing_img_daily_function_hook' ) ) {
	wp_schedule_event( time(), 'hourly', 'koala_bing_img_daily_function_hook' );
}

add_action( 'koala_bing_img_daily_function_hook', "koala_bing_img_collection_cron" );


$koala_bing_img_templates_new = [
	"page-bing.php" => "必应壁纸",
];


function koala_bing_img_add_template( $posts_templates ) {
	global $koala_bing_img_templates_new;

	return array_merge( $koala_bing_img_templates_new, $posts_templates );
}

function koala_bing_img_view_template( $template ) {
	global $post;
	global $koala_bing_img_templates_new;
	if ( ! isset( $post ) ) {
		return $template;
	}

	$t_template_name = get_post_meta( $post->ID, '_wp_page_template', true );

	//页面模板不在自定义列表中，直接返回
	if ( ! isset( $koala_bing_img_templates_new[ $t_template_name ] ) ) {
		return $template;
	}
	$file = koala_bing_img_dir . $t_template_name;
	if ( file_exists( $file ) ) {
		return $file;
	}

	return $template;
}


function koala_bing_img_register_page() {
	add_filter( 'theme_page_templates', 'koala_bing_img_add_template' );
	add_filter( 'template_include', 'koala_bing_img_view_template' );
}

add_action( "plugins_loaded", "koala_bing_img_register_page" );


//function bl_print_tasks() {
//	echo '<pre>';
//	var_dump( _get_cron_array() );
//	echo '</pre>';
//}

//bl_print_tasks();

//print_r( wp_get_schedules() );

//print_r(wp_upload_dir("bing")['url'] . "2021/06/465871.jpg");

