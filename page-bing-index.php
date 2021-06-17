<?php
/* template name: 你的页面模板命名
description: template for Git theme
*/
?>
<?php
global $PLUGIN_ROUTER;
global $wpdb;
$table = BING_IMAGES_TABLE_NAME;
$wpdb->query( "SELECT * FROM {$table}" );
$total    = $wpdb->num_rows;
$per_page = 9;
$page     = isset( $_GET['cpage'] ) ? abs( (int) $_GET['cpage'] ) : 1;

$start_page = ( $page - 1 ) * $per_page;
$results    = $wpdb->get_results( "SELECT * FROM {$table} order by created_at desc LIMIT $start_page,$per_page" );
get_header();
?>
<div class="koala_bing_img_zw"></div>
<div class="row koala_bing_img_m_0">
	<?php
	foreach ( $results as $result ) {
		$date       = substr( $result->created_at, 0, 10 );
		$like_style = $_SESSION[ 'img_like_' . $result->id ] ? 'color: #f15656' : '';
		$img_html   = <<< HTML
<div class="koala_bing_img_item_box col-lg-4 col-md-6 col-xs-12 koala_bing_img_m_0 koala_bing_img_p_0">
        <img src="{$result->origin_url}">
        <a href="{$PLUGIN_ROUTER}?id={$result->id}&cpage={$page}&action=view&route=detail" class="koala_bing_img_mark"></a>
        <div class="koala_bing_img_desc_box">
            <h3>{$result->info}</h3>
            <div class="d-flex">
                <span class="koala_bing_img_mb_0 koala_bing_img_mr4"><i class="icon icon-calendar"></i> {$date} </span>
                <span class="koala_bing_img_mb_0"><i class="icon icon-eye"> </i>{$result->view}</span>
            </div>
        </div>
        <div class="koala_bing_img_like_box">
            <div onclick="image_like({$result->id})" class="koala_bing_img_like_count">
                <i class="fa fa-heart" id="like_heart{$result->id}" style="$like_style"></i> 
                <span id="like{$result->id}">{$result->like}</span>
            </div>
            <a href="{$PLUGIN_ROUTER}?id={$result->id}&action=download&route=detail&route=detail" class="koala_bing_img_like_count"><i class="fa fa-cloud-download"></i> {$result->download}</a>
        </div>
    </div>
HTML;
		echo $img_html;
	}
	?>
</div>

<div class="posts-nav">
	<?php
	echo paginate_links( array(
		'base'      => add_query_arg( 'cpage', '%#%' ),
		'format'    => '',
		'prev_text' => __( '&laquo;' ),
		'next_text' => __( '&raquo;' ),
		'total'     => ceil( $total / $per_page ),
		'current'   => $page
	) );
	?>
</div>

<footer class="pt-4 pb-4">
    <div class="koala_bing_img_footer_text">
        本站所有图片均来自<a rel='nofollow' href="#" target="_blank">必应搜索</a>
    </div>
    <div class="koala_bing_img_footer_text">
        Copyright © 2014 - <?php echo date( 'Y', time() ) ?><a rel='nofollow' href="https://www.oskoala.com/biyingbizhi"
                                                               target="_blank">考拉开源</a>
    </div>
</footer>

