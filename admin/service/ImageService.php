<?php


interface ImageService {
	/**
	 * 判断图片是否存在
	 */
	public function existsByOriginUrl( $origin_url );

	/**
	 * 插入采集到的的图片
	 */
	public function insert( $params );

	/**
	 * 保存到本地
	 */
	public function saveToLocal( $url );

	/**
	 * 获取图片信息
	 */
	public function getById( $id );

	/**
	 * 修改信息
	 */

	public function update( $params );

}