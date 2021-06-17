function image_like(id) {
    $.post("/wp-admin/admin-ajax.php?action=koala_bing_img_image_like&id=" + id, function (res) {
        let likeCount = parseInt($("#like" + id).html()) + res.data.like
        $("#like" + id).html(likeCount)

        $("#like_heart" + id).css("color", "#f15656")
    })
}
