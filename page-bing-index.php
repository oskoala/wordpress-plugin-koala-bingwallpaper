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
$order    = isset( $_GET['order'] ) ? $_GET['order'] : "time";

$start_page = ( $page - 1 ) * $per_page;

$sql = "SELECT * FROM {$table} where origin_url != 'https://cn.bing.com'";

if ( $order == "time" ) {
	$sql .= " order by created_at desc";
} else if ( $order == "download" ) {
	$sql .= " order by download desc";
}

$sql .= " LIMIT $start_page,$per_page";

$results     = $wpdb->get_results( $sql );
$plugins_url = plugins_url( '', __FILE__ );
$title = get_the_title();
include "header.php";
?>
<header>
    <div class="row m-0">
        <a href="#" class="logo col-lg-3 col-md-6 col-xs-12">
            <span><?php echo $title?></span>
        </a>
        <nav class="col-lg-9 col-md-6 col-xs-12">
            <ul class="menu d-flex justify-content-end">
                <li>
                    <a href="<?php global $PLUGIN_ROUTER;
					echo $PLUGIN_ROUTER ?>">
                        <p class="text">首页</p>
                    </a>
                </li>
                <li>
                    <a href="<?php global $PLUGIN_ROUTER;
					echo $PLUGIN_ROUTER . '?order=download' ?>">
                        <p class="text">下载榜</p>
                    </a>
                </li>
            </ul>
        </nav>

    </div>
</header>
<div class="koala_bing_img_zw"></div>
<div class="row koala_bing_img_m_0">
	<?php
	foreach ( $results as $result ) {
		$date        = substr( $result->created_at, 0, 10 );
		$heart_image = $_SESSION[ 'img_like_' . $result->id ] ? '/public/images/xin1.png' : '/public/images/xin2.png';
		$img_html    = <<< HTML
<div class="koala_bing_img_item_box col-lg-4 col-md-6 col-xs-12 koala_bing_img_m_0 koala_bing_img_p_0">
        <img src="{$result->origin_url}">
        <a href="{$PLUGIN_ROUTER}?id={$result->id}&cpage={$page}&action=view&route=detail" class="koala_bing_img_mark"></a>
        <div class="koala_bing_img_desc_box">
            <h3>{$result->info}</h3>
            <div class="d-flex">
                <span class="koala_bing_img_mb_0 koala_bing_img_mr4 koala_bing_img_qi_box"><img src="{$plugins_url}/public/images/riqi.png"> {$date} </span>
                <span class="koala_bing_img_mb_0 koala_bing_img_qi_box"><img src="{$plugins_url}/public/images/liulan.png">{$result->view}</span>
            </div>
        </div>
        <div class="koala_bing_img_like_box">
            <div onclick="image_like({$result->id})" class="koala_bing_img_like_count koala_bing_img_count">
                <img src="{$plugins_url}{$heart_image}" id="like_heart{$result->id}">
                <span id="like{$result->id}">{$result->like}</span>
            </div>
            <a href="{$PLUGIN_ROUTER}?id={$result->id}&action=download&route=detail&route=detail" class="koala_bing_img_like_count koala_bing_img_count"><img src="{$plugins_url}/public/images/xz.png"> {$result->download}</a>
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
<script>
    function image_like(id) {
        $.post("/wp-admin/admin-ajax.php?action=koala_bing_img_image_like&id=" + id, function (res) {
            let likeCount = parseInt($("#like" + id).html()) + res.data.like;
            $("#like" + id).html(likeCount);
            $("#like_heart" + id).attr("src", "<?php echo $plugins_url?>/public/images/xin1.png");
        })
    }
</script>

<?php
include "footer.php";
?>
