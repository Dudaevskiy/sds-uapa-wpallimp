// !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
// ИПОЛЬЗОВАНИЕ :
// 
// Помещаем контент для скрытия в контейнер:
// <div class = "sociallocker" >
//     <a href = "/file.zip" > 
//         Загрузить файл
//     </a> 
// </div>
// Данный скрипт автоматически обернет каждый блок ссылки в свою обвертку. 
// И не даст загрузить файл пока пользователь не зашарит Вашу страницу
// 
// !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!



// =======================================================
// =======================================================
// AddToAny START
// =======================================================
// =======================================================

            // AddToAny Подключаем скрипт после загрузки страницы
            var s = document.createElement("script");
            s.type = "text/javascript";
            s.src = "//static.addtoany.com/menu/page.js";
            // Use any selector
            $("header").append(s);


            var a2a_config = a2a_config || {};

            // $('div#a2apage_overlay')

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

// =======================================================
// =======================================================
// AddToAny END
// =======================================================
// =======================================================

jQuery(document).ready(function ($) { 
  

// Оборачиваем каждую кнопку SocialLock
// START
// --------------------------------------------------------------

            // Оборачиваем весь контент в нутри div#sociallocker в блок для скрытия в оверлее
            $('div.sociallocker').wrapInner("<div class='sociallocker-content'></div>");

            // ВСТАВКА КОДА С КНОПКАМИ И ОВЕРЛЕЕМ
            // ====================================
            // Вставляем блок с кнопками от AddToAny перед обернутым содержимым
            $("<div class=\"sociallocker-links\"> <!-- AddToAny BEGIN --> <div class=\"a2a_kit a2a_kit_size_32 a2a_default_style\"> <a class=\"a2a_dd\" href=\"https://www.addtoany.com/share\"> </a> <a class=\"a2a_button_facebook\"></a> <a class=\"a2a_button_twitter\"></a> <a class=\"a2a_button_google_plus\"></a> <a class=\"a2a_button_pinterest\"></a> <a class=\"a2a_button_linkedin\"></a> <a class=\"a2a_button_trello\"></a> </div> </div>").insertBefore(".sociallocker-content");
            // Вставляем блок с оверлеем
            $("<div class=\"sociallocker-overlay\"><i class=\"fas fa-lock\"></i>Разблокировать контент при помощи социальных сетей.</div > ").insertAfter('.sociallocker-content');


// --------------------------------------------------------------
// Оборачиваем каждую кнопку SocialLock
// END

// =======================================================================================================
// Едреный скрипт благодаря которому появляется возможность отследить изменения style свойств объекта
// START
// -------------------------------------------------------------------------------------------------------
    $(window).bind("load", function () {

    // https://github.com/RickStrahl/jquery-watch

    /*
    jquery-watcher 
    Version 1.21 - 1/19/2016
    © 2014-2016 Rick Strahl, West Wind Technologies 
    www.west-wind.com
    Licensed under MIT License
    http://en.wikipedia.org/wiki/MIT_License
    */
    (function ($, undefined) {
        $.fn.watch = function (options) {
            /// <summary>
            /// Allows you to monitor changes in a specific
            /// CSS property of an element by polling the value.
            /// You can also monitor attributes (using attr_ prefix)
            /// or property changes (using prop_ prefix).
            /// when the value changes a function is called.
            /// The callback is fired in the context
            /// of the selected element (ie. this)
            ///
            /// Uses the MutationObserver API of the DOM and
            /// falls back to setInterval to poll for changes
            /// for non-compliant browsers (pre IE 11)
            /// </summary>            
            /// <param name="options" type="Object">
            /// Option to set - see comments in code below.
            /// </param>        
            /// <returns type="jQuery" /> 
            var opt = $.extend({
                // CSS styles or Attributes to monitor as comma delimited list
                // For attributes use a attr_ prefix
                // Example: "top,left,opacity,attr_class"
                properties: null,

                // interval for 'manual polling' (IE 10 and older)            
                interval: 100,

                // a unique id for this watcher instance
                id: "_watcher_" + new Date().getTime(),

                // flag to determine whether child elements are watched            
                watchChildren: false,

                // Callback function if not passed in callback parameter   
                callback: null
            }, options);

            return this.each(function () {
                var el = this;
                var el$ = $(this);
                var fnc = function (mRec, mObs) {
                    __watcher.call(el, opt.id, mRec, mObs);
                };

                var data = {
                    id: opt.id,
                    props: opt.properties.split(','),
                    vals: [opt.properties.split(',').length],
                    func: opt.callback, // user function
                    fnc: fnc, // __watcher internal
                    origProps: opt.properties,
                    interval: opt.interval,
                    intervalId: null
                };
                // store initial props and values
                $.each(data.props, function (i) {
                    var propName = data.props[i];
                    if (data.props[i].startsWith('attr_'))
                        data.vals[i] = el$.attr(propName.replace('attr_', ''));
                    else if (propName.startsWith('prop_'))
                        data.vals[i] = el$.prop(propName.replace('props_', ''));
                    else
                        data.vals[i] = el$.css(propName);
                });

                el$.data(opt.id, data);

                hookChange(el$, opt.id, data);
            });

            function hookChange(element$, id, data) {
                element$.each(function () {
                    var el$ = $(this);

                    if (window.MutationObserver) {
                        var observer = el$.data('__watcherObserver' + opt.id);
                        if (observer == null) {
                            observer = new MutationObserver(data.fnc);
                            el$.data('__watcherObserver' + opt.id, observer);
                        }
                        observer.observe(this, {
                            attributes: true,
                            subtree: opt.watchChildren,
                            childList: opt.watchChildren,
                            characterData: true
                        });
                    } else
                        data.intervalId = setInterval(data.fnc, opt.interval);
                });
            }

            function __watcher(id, mRec, mObs) {
                var el$ = $(this);
                var w = el$.data(id);
                if (!w) return;
                var el = this;

                if (!w.func)
                    return;

                var changed = false;
                var i = 0;
                for (i; i < w.props.length; i++) {
                    var key = w.props[i];

                    var newVal = "";
                    if (key.startsWith('attr_'))
                        newVal = el$.attr(key.replace('attr_', ''));
                    else if (key.startsWith('prop_'))
                        newVal = el$.prop(key.replace('prop_', ''));
                    else
                        newVal = el$.css(key);

                    if (newVal == undefined)
                        continue;

                    if (w.vals[i] != newVal) {
                        w.vals[i] = newVal;
                        changed = true;
                        break;
                    }
                }
                if (changed) {
                    // unbind to avoid recursive events
                    el$.unwatch(id);

                    // call the user handler
                    w.func.call(el, w, i, mRec, mObs);

                    // rebind the events
                    hookChange(el$, id, w);
                }
            }
        }
        $.fn.unwatch = function (id) {
            this.each(function () {
                var el = $(this);
                var data = el.data(id);
                try {
                    if (window.MutationObserver) {
                        var observer = el.data("__watcherObserver" + id);
                        if (observer) {
                            observer.disconnect();
                            el.removeData("__watcherObserver" + id);
                        }
                    } else
                        clearInterval(data.intervalId);
                }
                // ignore if element was already unbound
                catch (e) {}
            });
            return this;
        }
        String.prototype.startsWith = function (sub) {
            if (sub === null || sub === undefined) return false;
            return sub == this.substr(0, sub.length);
        }
    })(jQuery, undefined);


    // -0-------------------------
    // some element to monitor
    var el = $("#a2apage_overlay");

    // hook up the watcher
    el.watch({
        // specify CSS styles or attribute names to monitor
        properties: "display,top,left,opacity,attr_class,prop_innerHTML",

        // callback function when a change is detected
        callback: function (data, i) {

                console.log('style changed!');

                // Событие при изменении свойств стилией бекграунда
                // START
                // -------------------------------------------------------------
                // if ($('div#a2apage_modal').attr('aria-label') == "Спасибо, что поделился") {
                if ($("div#a2apage_modal").css("display") == "block") {
                    console.log('Внимание!!!! Изменение атрибутов начало происходить!!!!');
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

            var propChanged = data.props[i];
            var newValue = data.vals[i];

            var el = this;
            var el$ = $(this);

            // do what you need based on changes
            // or do your own checks
        }
    });
    });
// -------------------------------------------------------------------------------------------------------
// Едреный скрипт благодаря которому появляется возможность отследить изменения style свойств объекта
// END
});