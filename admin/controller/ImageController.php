<?php
session_start();
function koala_bing_img_image_like() {
	$image_id          = $_GET['id'];
	$like_session_name = "img_like_" . $image_id;

	if ( ! $_SESSION[ $like_session_name ] ) {
		$imageService  = new ImageServiceImpl();
		$image         = $imageService->getById( $image_id );
		$image['like'] = $image['like'] + 1;
		$imageService->update( $image );
		$_SESSION[ $like_session_name ] = true;
		wp_send_json_success( [
			"like"    => 1,
			"session" => $_SESSION
		], 200 );
	}

	wp_send_json_success( [
		"like" => 0,
	], 200 );
}

