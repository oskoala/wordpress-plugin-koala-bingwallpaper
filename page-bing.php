<?php
/* template name: 你的页面模板命名
description: template for Git theme
*/
?>
<?php
session_start();

$route = isset( $_GET['route'] ) ? $_GET['route'] : "index";


$PLUGIN_ROUTER = $_SERVER['DOCUMENT_URI'];

switch ( $route ) {
	case "index":
		include "page-bing-index.php";
		break;
	case "detail":
		include "page-bing-detail.php";
		break;
	default:
		include "page-bing-index.php";
}