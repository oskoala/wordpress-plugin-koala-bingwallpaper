<?php

// https://cn.bing.com/hp/api/model
function koala_bing_img_collection_url($image)
{
    $img_url = $image->ImageContent->Image->Url;
    if (str_starts_with($img_url, "http")) {
        return $img_url;
    } else {
        return "https://cn.bing.com" . $img_url;
    }
}


function koala_bing_img_collection_info($image)
{
    $info = $image->ImageContent->Title;
    return $info;
}


//print_r( koala_bing_img_collection_info());
//print_r(koala_bing_img_collection_url());

