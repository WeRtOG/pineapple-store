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
async function UpdateCart() {
    const response = await api.GetCartItemsCount();
    if(response.ok) {
        $('html').find('header a.cart .count').text(response.count);
        if(response.count > 0)
            $('html').find('header a.cart .count').removeClass('hidden');
        else
        $('html').find('header a.cart .count').addClass('hidden');
    }
}