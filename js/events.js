$(function() {
    $('a[href]').click(function(e) {
        if($(this).find('button').hasClass('addtocart')) return;
        $('a[href]').removeClass('active');
        $(this).addClass('active');
        $('.anix').css('transition', 'all 0.3s ease');
        $('.anix').css('opacity', 0);
    });
    $('.modal-wrapper').click(function(e) {
        if($(e.target).hasClass('modal-wrapper')) {
            HideModal($(this));
        }
    });
    $('.cabinet .actions .changename').click(function() {
        ShowModal($('.modal-wrapper.changename'));
    });
    $('.cabinet .actions .changepassword').click(function() {
        ShowModal($('.modal-wrapper.changepassword'));
    });
    $('.modal-wrapper .modal .close').click(function() {
        var $target = $(this).parent().parent();
        HideModal($target);
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
    $('.piclist .pic').on('click',function(event){
        $('.piclist .pic').removeClass('active');
        $(this).addClass('active');
        $('.picZoomer .rt').css('background-image', $(this).css('background-image'));
    });
    $('button.addtocart').click(async function(e) {
        e.preventDefault();
        
        var id = $(this).attr('data-id');

        if(!$(this).hasClass('already')) {
            var sizeID = $('.product-info [name=SizeSelect]:checked').attr('value');
            var colorID = $('.product-info [name=ColorSelect]:checked').attr('value');

            if(sizeID == undefined) sizeID = 0;
            if(colorID == undefined) colorID = 0;

            const response = await api.AddItemToCart(id, sizeID, colorID);
            if(response.ok) {
                $(this).addClass('already');
                $(this).find('.text').text('Убрать из корзины');
                $(this).find('.icon').text('remove_shopping_cart');
            }
        } else {
            const response = await api.RemoveItemFromCart(id);
            if(response.ok) {
                $(this).removeClass('already');
                $(this).find('.text').text('В корзину');
                $(this).find('.icon').text('add_shopping_cart');
            }
        }
    });
    $('.cart-item .remove button').click(async function() {
        $(this).parent().parent().detach();
        const response = await api.GetCartTotalPrice();
        if(response.ok) {
            $('.cart-page .bottom .summ').text('Сумма: ' + response.totalPriceString);
        }
        
        if($('.cart-page .cart-item').length == 0) {
            $('.cart-page').addClass('empty');
            $('.cart-page').html('');
        }
    });
    $('.cart-item .decrease').click(function() {
        var id = $(this).attr('data-id');
        var value = parseInt($(this).parent().find('.amount').text()) - 1;
        if(value < 1) value = 1;
        $(this).parent().find('.amount').text(value);
        setTimeout(async function() {
            await api.UpdateAmount(value, id);
            const response = await api.GetCartTotalPrice();
            if(response.ok) {
                $('.cart-page .bottom .summ').text('Сумма: ' + response.totalPriceString);
            }
        }, 0);
    });
    $('.cart-item .increase').click(function() {
        var id = $(this).attr('data-id');
        var value = parseInt($(this).parent().find('.amount').text()) + 1;
        $(this).parent().find('.amount').text(value);
        setTimeout(async function() {
            await api.UpdateAmount(value, id);
            const response = await api.GetCartTotalPrice();
            if(response.ok) {
                $('.cart-page .bottom .summ').text('Сумма: ' + response.totalPriceString);
            }
        }, 0);
    });
    $('.collapsible .header, .collapsible .sub.hidden .header').click(function() {
        $(this).parent().toggleClass('hidden');
    });
});