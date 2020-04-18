$(function() {
    $('a[href]').click(function() {
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
});