$(document).on('keydown', function (e) {
    e = e.event || window.event;
    if (e.keyCode === 123 || (e.ctrlKey && e.shiftKey && e.keyCode === 73) || (e.ctrlKey && e
        .keyCode === 85)) return false
})

$(document).bind("contextmenu", function (e) {
    return false;
});
