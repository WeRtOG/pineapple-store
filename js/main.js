const api = new API();

$(async function() {
    await UpdateCart();
    setInterval(async function() {
        await UpdateCart();
    }, 2000);
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