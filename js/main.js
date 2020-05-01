const api = new API();

$(async function() {
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
    if($('.order-page #region').attr('id') == 'region') {
        const result = await api.GetRegionList();
        if(result.ok) {
            result.result.forEach(element => {
                $('.order-page #region').append('<option value="' + element + '">' + element + '</option>');
            });
        }
    }
    await UpdateCart();
    setInterval(async function() {
        await UpdateCart();
    }, 2000);
});