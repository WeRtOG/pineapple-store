const api = new API();

$(function() {
    $('a[href]').click(function() {
        $('a[href]').removeClass('active');
        $(this).addClass('active');
        $('.anix').css('transition', 'all 0.3s ease');
        $('.anix').css('opacity', 0);
    });
    $('#AvatarUpload').on('change', async function() {
        if(this.files && this.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('label[for=AvatarUpload]').removeClass('default');
                $('label[for=AvatarUpload]').css('background-image', 'url(' + e.target.result + ')');
            }
            reader.readAsDataURL(this.files[0]);
            const result = await api.UploadAvatar(this.files[0]);

            if(!result.ok) {
                if(result.code == 403) {
                    location.reload();
                    return;
                }
                alert("Ошибка загрузки!\nИзображение должно быть в формате JPG, JPEG, PNG или GIF");
            }
        }
    });
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
        centerMode: true,
        slidesToShow: 3,
        slidesToScroll: 3,
        infinite: true,
        variableWidth: true,
        variableHeight: true,
        arrows: false,
        swipeToSlide: true,
    });
});