<?php

function koala_bing_img_collection_cron() {
	$imageService = new ImageServiceImpl();

	$url          = koala_bing_img_collection_url();
//	$url = koala_bing_img_collection_url() . mt_rand( 1000, 9999 );

	$info = koala_bing_img_collection_info();
	if ( ! $imageService->existsByOriginUrl( $url ) ) {
		$self_url = $imageService->saveToLocal( $url );
		$imageService->insert( [
			"origin_url" => $url,
			"self_url"   => $self_url,
			"info"       => $info,
			"created_at" => date( "Y-m-d H:i:s", time() ),
		] );
	}
}