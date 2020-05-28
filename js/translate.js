//$('.loading-screen').removeClass('hidden');
async function DoTranslate() {
    var page_title = document.title;
    document.title = "Завантаження...";
    var result = await api.TranslateUA(page_title);
    if(result.ok) {
        document.title = result.result;
    }
    var pending = 0;
    var finished = 0;
    $('[data-translate]').each(async function(i) {
        const variant = $(this).data('translate');
        var result;
        pending++;
        switch(variant) {
            case 'content':
                const content = $(this).text().trim();
                result = await api.TranslateUA(content);
                
                if(result.ok) {
                    $(this).text(result.result);
                }
                break;
            case 'value':
                const value = $(this).val().trim();
                result = await api.TranslateUA(value);
                
                if(result.ok) {
                    $(this).val(result.result);
                }
                break;
            case 'placeholder':
                const placeholder = $(this).attr('placeholder');
                result = await api.TranslateUA(placeholder);
                
                if(result.ok) {
                    $(this).attr('placeholder', result.result);
                }
                break;
            case 'title':
                const title = $(this).attr('title');
                result = await api.TranslateUA(title);
                
                if(result.ok) {
                    $(this).attr('title', result.result);
                }
                break;
            case 'confirm':
                const confirm = $(this).attr('data-confirm');
                result = await api.TranslateUA(confirm);
                
                if(result.ok) {
                    $(this).attr('data-confirm', result.result);
                }
                break;
        }
        finished++;
        if(pending == finished) {
            $('.loading-screen').addClass('hidden');
            setTimeout(function() {
                $('.loading-screen').addClass('collapsed');
            }, 300);
        }
    });
}
// возвращает куки с указанным name,
// или undefined, если ничего не найдено
function getCookie(name) {
    let matches = document.cookie.match(new RegExp(
      "(?:^|; )" + name.replace(/([\.$?*|{}\(\)\[\]\\\/\+^])/g, '\\$1') + "=([^;]*)"
    ));
    return matches ? decodeURIComponent(matches[1]) : undefined;
  }
  function setCookie(name, value, options = {}) {

    options = {
      path: '/',
      // при необходимости добавьте другие значения по умолчанию
      ...options
    };
  
    if (options.expires instanceof Date) {
      options.expires = options.expires.toUTCString();
    }
  
    let updatedCookie = encodeURIComponent(name) + "=" + encodeURIComponent(value);
  
    for (let optionKey in options) {
      updatedCookie += "; " + optionKey;
      let optionValue = options[optionKey];
      if (optionValue !== true) {
        updatedCookie += "=" + optionValue;
      }
    }
  
    document.cookie = updatedCookie;
  }
var lang;
$(function() {
    lang = getCookie('lang');
    if(lang == 'ua') {
        DoTranslate();
    } else if(lang == undefined) {
        lang = 'ru';
    }
    setCookie('lang', lang);

    $('.change-lang-ru').click(function() {
        setCookie('lang', 'ru');
        location.reload();
    });
    $('.change-lang-ua').click(function() {
        setCookie('lang', 'ua');
        location.reload();
    });
});