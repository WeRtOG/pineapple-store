function ShowModal($target) {
    $target.removeClass('hidden');
    setTimeout(function() {
        $target.addClass('active');
    }, 0);
}
function HideModal($target) {
    $target.removeClass('active');
    setTimeout(function() {
        $target.addClass('hidden');
    }, 300);
}