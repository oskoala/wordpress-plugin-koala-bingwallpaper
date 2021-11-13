<?php

function koala_bing_img_collection_cron()
{
    $imageService = new ImageServiceImpl();

    $res = file_get_contents("https://cn.bing.com/hp/api/model");

    $images = json_decode($res)->MediaContents;
    for ($i = count($images) - 1; $i >= 0; $i--) {
        $url  = koala_bing_img_collection_url($images[$i]);
        $info = koala_bing_img_collection_info($images[$i]);
//        $url  = $url . mt_rand(1000, 9999);
        if (!$imageService->existsByOriginUrl($url) && $url != "https://cn.bing.com") {
            $self_url = $imageService->saveToLocal($url);
            $imageService->insert([
                "origin_url" => $url,
                "self_url"   => $self_url,
                "info"       => $info,
                "created_at" => date("Y-m-d H:i:s", time()),
            ]);
        }
    }
}