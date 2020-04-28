$(function() {
    $('[data-confirm]').submit(function(e) {
        const text = $(this).attr('data-confirm');
        const result = window.confirm(text);

        if(!result) e.preventDefault();
    });
    $('form.edit').click(function(e) {
        const oldtext = $(this).find('input[name="name"]').attr('value');
        const newtext = window.prompt('Введите новое название', oldtext);
        $(this).find('input[name="name"]').attr('value', newtext);
        $(this).submit();
        e.preventDefault();
    });
});