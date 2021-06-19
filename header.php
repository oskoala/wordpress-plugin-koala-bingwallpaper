<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo get_option("blogname")?></title>
    <link href="<?php echo plugins_url( '', __FILE__ ) ?>/public/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo plugins_url( '', __FILE__ ) ?>/public/css/style.css" rel="stylesheet">
    <script src="<?php echo plugins_url( '', __FILE__ ) ?>/public/js/bootstrap.bundle.min.js "></script>
    <script src="<?php echo plugins_url('',__FILE__) ?>/public/js/jquery-1.12.4.min.js"></script>
    <script src="<?php echo plugins_url('',__FILE__) ?>/public/js/disable.js"></script>
</head>

<body oncontextmenu="self.event.returnValue=false">

<header>
    <div class="row m-0">
        <a href="#" class="logo col-lg-3 col-md-6 col-xs-12">
            <span>必应壁纸</span>
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