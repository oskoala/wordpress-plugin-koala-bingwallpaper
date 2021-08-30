<?php
require 'phpQuery.php';
require 'QueryList.php';
use QL\QueryList;


function koala_bing_img_collection_url() {
	$imgs     = QueryList::Query( 'https://cn.bing.com/', array( "url" => array( '#preloadBg', 'href' ) ) );
	$img_urls = $imgs->getData( function ( $x ) {
		return $x['url'];
	} );
	$img_url  = $img_urls[0];

	return "https://cn.bing.com" . $img_url;
}


function koala_bing_img_collection_info() {

	$infos       = QueryList::Query( "https://cn.bing.com/", array( "info" => array( '#vs_cont > div.mc_caro > div > div.musCardCont > a', 'text' ) ) );
	$info_titles = $infos->getData( function ( $x ) {
		return $x['info'];
	} );
	$info        = $info_titles[0];
	return $info;
}


//print_r( koala_bing_img_collection_info());
//print_r( koala_bing_img_collection_url());

