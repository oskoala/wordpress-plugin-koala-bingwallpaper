<?php

class ImageServiceImpl implements ImageService {

	/**
	 * 判断图片是否存在
	 */
	public function existsByOriginUrl( $origin_url ) {
		global $wpdb;
		$table_name = BING_IMAGES_TABLE_NAME;
		if ( $wpdb->get_row( "select * from {$table_name} where origin_url = '{$origin_url}'", ARRAY_A ) ) {
			return true;
		}

		return false;
	}

	/**
	 * 获取图片信息
	 */
	public function getById( $id ) {
		global $wpdb;
		$table_name = BING_IMAGES_TABLE_NAME;
		$item       = $wpdb->get_row( "select * from {$table_name} where id = {$id}", ARRAY_A );

		return $item;
	}

	/**
	 * 插入采集到的的图片
	 */
	public function insert( $params ) {
		global $wpdb;
		$table_name = BING_IMAGES_TABLE_NAME;
		$wpdb->insert( $table_name, $params );
	}

	/**
	 * 保存到本地
	 */
	public function saveToLocal( $url ) {
		//保存网络图片
		$path  = wp_upload_dir()['basedir'] . "/bing/";
		$state = file_get_contents( $url, 0, null, 0, 1 );//获取网络资源的字符内容
		if ( $state ) {
			$folder   = date( "Y/m/", time() );
			$filename = $folder . mt_rand( 100000, 999999 ) . '.jpg';//文件名称与路径

			if ( ! is_dir( $path . $folder ) ) {
				mkdir( $path . $folder, 0777, true );
			}

			ob_start();
			//打开输出
			readfile( $url );//输出图片文件
			$img = ob_get_contents();//得到浏览器输出
			ob_end_clean();//清除输出并关闭
			$fp2 = fopen( $path . $filename, "a" );
			fwrite( $fp2, $img );//向当前目录写入图片文件，并重新命名
			fclose( $fp2 );

			return $filename;
		} else {
			return 0;
		}
	}

	public function update( $params ) {
		global $wpdb;
		$table_name = BING_IMAGES_TABLE_NAME;
		$wpdb->update( $table_name, $params, [
			"id" => $params['id'],
		] );
	}
}