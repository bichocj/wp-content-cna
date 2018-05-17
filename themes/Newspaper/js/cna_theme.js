/*
 *   CNA - CUSTOM SCRIPTS
 *  ----------------------------------
 *   Aqui cargan los scripts para CNA
 *   Esta version de Wp usa la version jQuery 1.12.3
 *   Información de Jquery en Wp: https://www.codigonexo.com/blog/programacion/javascript/usar-dolar-en-lugar-de-jquery-en-wordpress/
 *   Usar Jquery en modo Seguro (no usar dolar, usar jQuery)
 */




jQuery(document).ready(function () {
    // Delete Hours
    deleteHours(document.getElementsByClassName("wpcna-polls-dates"), 'Resultados: No Expiry', "@", "Encuesta Vigente");
    // addIframe();
    // addIframeNews();
    displayIframe();
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
            jQuery('body').append('<div id="cnaenvivo-mobile"><div id="cnaenvivo-close" onclick="removeIframe()"><i class="td-icon-close"></i></div><div class="lds-ring"><div></div><div></div><div></div><div></div></div><iframe id="iframeFS" src="http://iblups.com/e_cnapet" width="100%" height="100%" frameborder="0" scrolling="no" allowfullscreen="allowfullscreen"></iframe></div>')
            launchFullScreen(document.getElementById("iframeFS"))
        })
    }
}

function removeIframe(){
    jQuery('#cnaenvivo-mobile').remove();
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

document.addEventListener("fullscreenchange", changeHandler);
document.addEventListener("webkitfullscreenchange", changeHandler);
document.addEventListener("mozfullscreenchange", changeHandler);