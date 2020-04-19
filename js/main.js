const api = new API();

$(function() {
    setInterval(async function() {
        const response = await api.GetCartItemsCount();
        if(response.ok) {
            $('html').find('header a.cart .count').text(response.count);
            if(response.count > 0)
                $('html').find('header a.cart .count').removeClass('hidden');
            else
            $('html').find('header a.cart .count').addClass('hidden');
        }
    }, 1000);
    $('.catalog .carousel').slick({
        centerMode: true,
        slidesToShow: 3,
        slidesToScroll: 3,
        infinite: true,
        variableWidth: true,
        variableHeight: true,
        autoplay: true,
        autoplaySpeed: 5000,
        arrows: false,
        focusOnSelect: true,
        swipeToSlide: true,
    });
    $('.catalog .seasonal-offer').slick({
        slidesToShow: 2,
        slidesToScroll: 2,
        infinite: false,
        variableWidth: true,
        variableHeight: true,
        arrows: false,
        swipeToSlide: true,
    });
    if($('.picZoomer').hasClass('picZoomer')) {
        $('.picZoomer').picZoomer({
            picWidth: 500,
            picHeight: 500,
            scale: 2.5,
            zoomerPosition: {top: '0', left: '0px'}
        });
    }
});