// AddToAny Подключаем скрипт после загрузки страницы
var s = document.createElement("script");
s.type = "text/javascript";
s.src = "//static.addtoany.com/menu/page.js";
// Use any selector
$("head").append(s);


var a2a_config = a2a_config || {};



a2a_config.thanks = {
postShare: true,
ad: false,
// Указываем свой GoogleAdsence если хотим что бы отображался блок рекламы в окне
// ad: '<ins class=\"adsbygoogle\"\
//         style=\"display:inline-block;width:300px;height:250px\"\
//         data-ad-client=\"ca-pub-xxxxxxxxxxxxxxxx\"\
//         data-ad-slot=\"1234567890\"></ins>\
//     <\script>\
//     (adsbygoogle = window.adsbygoogle || []).push({});\
//     <\/script>'
};

//AddToAny - Меняем локализацию на свой язык
//https://www.addtoany.com/buttons/customize/translation_localization
// var a2a_config = a2a_config || {};
a2a_config.locale = "ru-RU";
// ******************************************
// ******************************************

// // AddToAny Подключаем скрипт после загрузки страницы
// var s = document.createElement("script");
// s.type = "text/javascript";
// s.src = "//static.addtoany.com/menu/page.js";
// // Use any selector
// $("head").append(s);

// $(window).bind("load", function () {
// $.getScript('//static.addtoany.com/menu/page.js', function () {
    // });
    
jQuery(document).ready(function ($) {
            
            
            
            // Оборачиваем весь контент в нутри div#sociallocker в блок для скрытия в оверлее
            $('div.sociallocker').wrapInner("<div class='sociallocker-content'></div>");
            
            // ВСТАВКА КОДА С КНОПКАМИ И ОВЕРЛЕЕМ
            // ====================================
            // Вставляем блок с кнопками от AddToAny перед обернутым содержимым
            $("<div class=\"sociallocker-links\"> <!-- AddToAny BEGIN --> <div class=\"a2a_kit a2a_kit_size_32 a2a_default_style\"> <a class=\"a2a_dd\" href=\"https://www.addtoany.com/share\"> </a> <a class=\"a2a_button_facebook\"></a> <a class=\"a2a_button_twitter\"></a> <a class=\"a2a_button_google_plus\"></a> <a class=\"a2a_button_pinterest\"></a> <a class=\"a2a_button_linkedin\"></a> <a class=\"a2a_button_trello\"></a> </div> </div>").insertBefore(".sociallocker-content");
            // Вставляем блок с оверлеем
            $("<div class=\"sociallocker-overlay\"><i class=\"fas fa-lock\"></i>Разблокировать контент при помощи социальных сетей.</div > ").insertAfter('.sociallocker-content');
            // ====================================
            // ====================================
            
            // $('div#a2apage_overlay')
            
            // AddToAny Подключаем скрипт после загрузки страницы
            // var s = document.createElement("script");
            // s.type = "text/javascript";
            // s.src = "//cdn.rawgit.com/meetselva/attrchange/master/js/attrchange.js";
            // // Use any selector
            // $("head").append(s);

            // // AddToAny Подключаем скрипт после загрузки страницы
            // var s = document.createElement("script");
            // s.type = "text/javascript";
            // s.src = "//cdn.rawgit.com/meetselva/attrchange/master/js/attrchange_ext.js";
            // // Use any selector
            // $("head").append(s);
            
//             $(function () {
//                 var eventCount = 0, //event counter
//                 $attrchange_logger = $('#attrchange-demo-logs'); //cached logger 
//                 $('div#a2apage_overlay').attrchange({
//                     trackValues: true,
//                     /* enables tracking old and new values */
//                     callback: function (e) {
//                         console.log('Что-то происходит');
//                         //callback handler on DOM changes  
//                         //log the events in the panel
//             // var $logs = $attrchange_logger.prepend('<p>Attribute <b>' + e.attributeName +
//             //         '</b> changed from <b>' + e.oldValue +
//             //         '</b> to <b>' + e.newValue +
//             //         '</b></p>')
//             //     .find('p');
//             // $logs.filter(':gt(4)').remove(); //remove old logs, lets just keep the last 5 events
//             // $logs.css('color', '#777').first().css('color', '#333'); // highlight the last log in #333 and rest in #999
//             // $("#attrchange-demo-attrchange-method").text($(this).attrchange("getProperties")["method"]); //show the method used for detecting DOM changes

//             // $('#attrchange-demo-event-count').text(++eventCount); //show the event count
//         }
//     });

//     // $('.attrchange-demo-button').on('click', function () {
//     //     $('#attrchange-demo').css('left', ($(this).hasClass('left') ? "-=10px" : "+=10px"));
//     // });
//     // $('.attrchange-demo-button.right').click(); //just want to log for demo
// });
// Perform change
// $('element').css('background', 'red');

    // Если оферлей AddToAny появился действуем :)
    // if ($("#a2apage_modal").length) {
    // if ($("div#a2apage_overlay").is(':visible')) {
    // if ($("div#a2apage_modal").is(':visible')) {
    // if ($("div#a2apage_modal").css("display")=="block") {
    // if ($("div#a2apage_modal").is(':visible').length) {
    // var element = $("div#a2apage_modal");
    // if (element.length > 0 && element.css('visibility') !== 'hidden' && element.css('display') !== 'none'){
    // if ($('div#a2apage_modal').attr('aria-label') === 'true') {
    // if ($('div#a2apage_modal').attr('aria-label').length) {
    // if ($('div#a2apage_modal[aria-label="Thanks for sharing"]').length) {
    //    $('div#a2apage_modal').attr('aria-label', "ergergrg");
    // jQuery(document).ready(function ($) {
    // $('body').on('change', function () {
    //     if ($('div#a2apage_modal').attr('aria-label') == "Thanks for sharing") {
    //         alert('e5y5ye');
    //         setTimeout(function () {
    //             //alert('Появился');
    //             $("div#a2apage_overlay").css("display", "none");
    //             $("div#a2apage_modal").css("display", "none");

    //             //                 $(".sociallocker-links").each(function () {
    //             //                     $(this).css('display', 'none');
    //             //                 });
    //             //                 $(".sociallocker-overlay").each(function () {
    //             //                     $(this).css('display', 'none');
    //             //                 });
    //             //                 $(".sociallocker-content").each(function () {
    //             //                     $(this).css('top', '0');
    //             //                 });
    //         }, 7000);
    //     };
    // });
    // });


    // if ($('div#a2apage_modal').attr('aria-label') !== "") {
    //     alert('e5y5ye');
    //     setTimeout(function () {
    //         //alert('Появился');
    //         $("div#a2apage_overlay").css("display", "none");
    //         $("div#a2apage_modal").css("display", "none");

    //         $(".sociallocker-links").each(function () {
    //             $(this).css('display', 'none');
    //         });
    //         $(".sociallocker-overlay").each(function () {
    //             $(this).css('display', 'none');
    //         });
    //         $(".sociallocker-content").each(function () {
    //             $(this).css('top', '0');
    //         });
    //     }, 7000);
    // };

    // };

    // ====================================
    // ====================================
    // });
    // });
});


// jQuery(document).ready(function () {
//     $('.sociallocker-overlay').click(function () {
//         return false;
//     });
// });



jQuery(document).ready(function () {


    // Функция слежения за изменениями в атрибуте style
    // 
    var observer = new MutationObserver(function (mutations) {
        mutations.forEach(function (mutationRecord) {
            console.log('style changed!');

            // Событие при изменении свойств стилией бекграунда
            // START
            // -------------------------------------------------------------
                                // if ($('div#a2apage_modal').attr('aria-label') == "Спасибо, что поделился") {
                                if ($("div#a2apage_modal").css("display")=="block") {
                                    console.log('Вниманеи!!!! Изменение атрибутов начало происходить!!!!');
                                    setTimeout(function () {
                                        //alert('Появился');
                                        // 
                                        $("div#a2apage_overlay").css("display", "none");
                                        $("div#a2apage_modal").css("display", "none");

                                        $(".sociallocker-links").each(function () {
                                            $(this).css('display', 'none');
                                        });
                                        $(".sociallocker-overlay").each(function () {
                                            $(this).css('display', 'none');
                                        });
                                        $(".sociallocker-content").each(function () {
                                            $(this).css('top', '0');
                                        });
                                    }, 2500);
                                };
            // -------------------------------------------------------------
            // END



        });
    });

    var target = document.getElementById('a2apage_overlay');
    observer.observe(target, {
        attributes: true,
        attributeFilter: ['style']
    });
});