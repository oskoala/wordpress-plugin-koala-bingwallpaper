<?php
/* template name: 你的页面模板命名
description: template for Git theme
*/
?>
<?php
global $PLUGIN_ROUTER;
$imageService = new ImageServiceImpl();
$id           = isset( $_GET['id'] ) ? abs( (int) $_GET['id'] ) : 1;
$action       = isset( $_GET['action'] ) ? $_GET['action'] : "";
$cpage        = isset( $_GET['cpage'] ) ? $_GET['cpage'] : 1;
$item         = $imageService->getById( $id );

$view_session_name     = "img_view_" . $id;
$download_session_name = "img_download_" . $id;

if ( $action == "view" ) {
	if ( ! $_SESSION[ $view_session_name ] ) {
		$item['view'] += 1;
		$imageService->update( $item );
		$_SESSION[ $view_session_name ] = true;
	}
} else if ( $action == "download" ) {
	if ( ! $_SESSION[ $download_session_name ] ) {
		$item['download'] += 1;
		$imageService->update( $item );
	}
	$_SESSION[ $download_session_name ] = true;

	$path = wp_upload_dir()['basedir'] . "/bing/";

	$download_url = $path . $item['self_url'];

	//以只读和二进制模式打开文件
	$file = fopen( $download_url, "rb" );

	//告诉浏览器这是一个文件流格式的文件
	Header( "Content-type: application/octet-stream" );
	//请求范围的度量单位
	Header( "Accept-Ranges: bytes" );
	//Content-Length是指定包含于请求或响应中数据的字节长度
	Header( "Accept-Length: " . filesize( $download_url ) );
	//用来告诉浏览器，文件是可以当做附件被下载，下载后的文件名称为$file_name该变量的值。
	Header( "Content-Disposition: attachment; filename=" . $item['self_url'] );

	//读取文件内容并直接输出到浏览器
	echo fread( $file, filesize( $download_url ) );
	fclose( $file );
	return;
}

get_header();

$date       = substr( $item['created_at'], 0, 10 );
$like_style = $_SESSION[ 'img_like_' . $item['id'] ] ? 'color: #f15656' : '';
$html       = <<< HTML
<div class="koala_bing_img_content_box">
    <div class="koala_bing_img_img_mask_box"
         style="background-image: url('{$item['origin_url']}');filter: blur(0px);">
    </div>
    <div class="koala_bing_img_desc_box koala_bing_img_desc_detail_box">
        <h3>
            {$item['info']}
        </h3>
        <div class="d-flex">
            <span class="koala_bing_img_mb_0 koala_bing_img_mr4"><i class="icon icon-calendar"></i>{$date}</span>
            <span class="koala_bing_img_mb_0"><i class="icon icon-eye"> </i>{$item['view']}</span>
        </div>
    </div>
    <div class="koala_bing_img_options_box">
        <a onclick="back()" class="koala_bing_img_options_left"><i class="fa fa-chevron-left"></i> BACK</a>
        <div class="koala_bing_img_options_right_box">
        
        <div onclick="image_like({$item['id']})" class="koala_bing_img_like_count">
            <i class="fa fa-heart" id="like_heart{$item['id']}" style="$like_style"></i>
            <span id="like{$item['id']}">{$item['like']}</span>
        </div>
        
        <a href="{$PLUGIN_ROUTER}?id={$item['id']}&action=download&route=detail" class="koala_bing_img_like_count"><i class="fa fa-cloud-download"></i> {$item['download']}</a>
        </div>
    </div>
</div>
HTML;
echo $html;
?>

<script>
    window.scrollTo(0, document.documentElement.clientHeight);

    function back() {
        let cpage = <?php echo $cpage ?>;
        window.location.href = "<?php echo $PLUGIN_ROUTER?>?cpage=" + cpage
    }
</script>