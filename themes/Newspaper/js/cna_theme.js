/*
 *   CNA - CUSTOM SCRIPTS
 *  ----------------------------------
 *   Aqui cargan los scripts para CNA
 *   Esta version de Wp usa la version jQuery 1.12.3
 *   Información de Jquery en Wp: https://www.codigonexo.com/blog/programacion/javascript/usar-dolar-en-lugar-de-jquery-en-wordpress/
 *   Usar Jquery en modo Seguro (no usar dolar, usar jQuery)
 */




jQuery(document).ready(function () {
    setTrendingNews();
    // Delete Hours
    deleteHours(document.getElementsByClassName("wpcna-polls-dates"), 'Resultados: No Expiry', "@", "Encuesta Vigente");
    displayIframe();
    addIdApps();
    addIdPolls();
    // Resize plugin de Facebook
    (function (d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s);
        js.id = id;
        js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.5&appId=443271375714375";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));

    jQuery(document).ready(function ($) {
        $(window).bind("load resize", function () {
            setTimeout(function () {
                var container_width = $('#container').width();
                $('#container').html('<div class="fb-page" ' +
                    'data-href="http://www.facebook.com/IniciativaAutoMat"' +
                    ' data-width="' + container_width + '" data-tabs="timeline" data-small-header="true" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"><div class="fb-xfbml-parse-ignore"><blockquote cite="http://www.facebook.com/IniciativaAutoMat"><a href="http://www.facebook.com/IniciativaAutoMat">Auto*Mat</a></blockquote></div></div>');
                FB.XFBML.parse();
            }, 100);
        });
    });
});

jQuery('.open_popup').on('click',function(e) { 
    console.log("new tab"); 
    e.preventDefault(); 
    var tab = window.open('https://cna.pe/cna-radio-en-vivo/', 'mywin', 'toolbar=0 , location=0 , status=0 , menubar=0 , scrollbars=0 , resizable=0, width=400px,height=380px'); 
    if(tab){ 
        tab.focus();//ir a la pestaña 
    } else { 
        alert('Pestañas bloqueadas, activa las ventanas emergentes (Popups) ');
        return false; 
    }
});
function deleteHours(dates, element, point, replace) {
    var dates = dates;
    var text = "";
    var index = 0;
    if (dates.length > 0) {
        for (var i in dates) {
            text = dates[i].innerHTML;
            if (text != element) {
                index = text.indexOf(point);
                dates[i].innerHTML = text.slice(0, index);
            } else {
                dates[i].innerHTML = replace;
            }
        }
    }
}

// Change class 
function changeClass(question) {
    let questionID = question.id;
    let answer = question.nextElementSibling;
    let dates = question.parentNode.nextElementSibling;
    if (answer.classList.contains("wpcna-hide")) {
        answer.classList.remove("wpcna-hide");
        answer.classList.add("wpcna-show");
        dates.classList.remove("wpcna-hide");
        dates.classList.add("wpcna-show");
        question.classList.remove("wpcna-isHide");
        question.classList.add("wpcna-isShow");
    } else if (answer.classList.contains("wpcna-show")) {
        answer.classList.remove("wpcna-show");
        answer.classList.add("wpcna-hide");
        dates.classList.remove("wpcna-show");
        dates.classList.add("wpcna-hide");
        question.classList.remove("wpcna-isShow");
        question.classList.add("wpcna-isHide");
    } else {
        answer.classList.add("wpcna-show");
        dates.classList.add("wpcna-show");
        question.classList.add("wpcna-isShow");
    }
}

// bxSlider videos CNA 
jQuery(function () {
    jQuery('#videos-bxslider').bxSlider({
        mode: 'horizontal',
        captions: false,
        maxSlides: 4,
        minSlides: 1,
        slideWidth: 197,
        pager: false,
        infiniteLoop: false,
        hideControlOnEnd: true
    });
});

var flag = 0;

function changeHandler() {
    if (flag === 0) {
        jQuery("a").addClass("removePointerEvent")
        screen.orientation.lock('landscape');
        flag += 1;
    } else if (flag === 1) {
        removeIframe();
        jQuery("a").removeClass("removePointerEvent")
        flag = 0
    }
}

function displayIframe() {
    if ( jQuery(window).width() < 600) {
        jQuery('.textSub').click(function() {
            jQuery('body').append('<div id="cnaenvivo-mobile"><div class="lds-ring"><div></div><div></div><div></div><div></div></div><iframe id="iframeFS" src="http://iblups.com/e_cnapet" width="100%" height="100%" frameborder="0" scrolling="no" allowfullscreen="allowfullscreen"></iframe></div>')
            launchFullScreen(document.getElementById("iframeFS"))
        })
    }
}

function removeIframe(){
    jQuery('#cnaenvivo-mobile').remove();
}

function addIdPolls(){
    let divWebPolls = jQuery('div[name=encuestas-web]');
    let divMobilePolls = jQuery('div[name=encuestas-mobile]');
    if ( jQuery(window).width() >= 768) {
        if (divMobilePolls[0].id == "") {
            divWebPolls.attr('id', 'encuestas-en-cna');
        } else {
            divMobilePolls.removeAttr("id");
            divWebPolls.attr('id', 'encuestas-en-cna');
        }
    } else {
        if (divWebPolls[0].id == "") {
            divMobilePolls.attr('id', 'encuestas-en-cna');
        } else {
            divWebPolls.removeAttr("id");
            divMobilePolls.attr('id', 'encuestas-en-cna');
        }
    } 
}

function addIdApps(){
    let divWeb = jQuery('div[name=apps-web]');
    let divMobile = jQuery('div[name=apps-mobile]');
    if ( jQuery(window).width() >= 768) {
        if (divMobile[0].id == "") {
            divWeb.attr('id', 'apps');
        } else {
            divMobile.removeAttr("id");
            divWeb.attr('id', 'apps');
        }
    } else {
        if (divWeb[0].id == "") {
            divMobile.attr('id', 'apps');
        } else {
            divWeb.removeAttr("id");
            divMobile.attr('id', 'apps');
        }
    } 
}

function launchFullScreen(element) {
    if(element.requestFullScreen) {
      element.requestFullScreen();
    } else if(element.mozRequestFullScreen) {
      element.mozRequestFullScreen();
    } else if(element.webkitRequestFullScreen) {
      element.webkitRequestFullScreen();
    }
}

function changePhoneFormat(){
    let phoneNumber = document.getElementById('socialWhatsapp').textContent.slice(2);
    let arrPhoneNumber = phoneNumber.split('');
    arrPhoneNumber.splice( 3, 0, ' ');
    arrPhoneNumber.splice( 6, 0, ' ');
    arrPhoneNumber.splice( 9, 0, ' ');
    document.getElementById('socialWhatsapp').textContent = arrPhoneNumber.join('');
}

function setTrendingNews () {
    let trending = document.getElementById('trendingNews')
    let space = document.getElementById('trending-xs')
    space.append(trending)
}

document.addEventListener("fullscreenchange", changeHandler);
document.addEventListener("webkitfullscreenchange", changeHandler);
document.addEventListener("mozfullscreenchange", changeHandler);