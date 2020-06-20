

		/*
		A simple jQuery function that can add listeners on attribute change.
		http://meetselva.github.io/attrchange/

		About License:
		Copyright (C) 2013-2014 Selvakumar Arumugam
		You may use attrchange plugin under the terms of the MIT Licese.
		https://github.com/meetselva/attrchange/blob/master/MIT-License.txt
		 */
		(function($) {
			function isDOMAttrModifiedSupported() {
				var p = document.createElement('p');
				var flag = false;

				if (p.addEventListener) {
					p.addEventListener('DOMAttrModified', function() {
						flag = true
					}, false);
				} else if (p.attachEvent) {
					p.attachEvent('onDOMAttrModified', function() {
						flag = true
					});
				} else { return false; }
				p.setAttribute('id', 'target');
				return flag;
			}

			function checkAttributes(chkAttr, e) {
				if (chkAttr) {
					var attributes = this.data('attr-old-value');

					if (e.attributeName.indexOf('style') >= 0) {
						if (!attributes['style'])
							attributes['style'] = {}; //initialize
						var keys = e.attributeName.split('.');
						e.attributeName = keys[0];
						e.oldValue = attributes['style'][keys[1]]; //old value
						e.newValue = keys[1] + ':'
								+ this.prop("style")[$.camelCase(keys[1])]; //new value
						attributes['style'][keys[1]] = e.newValue;
					} else {
						e.oldValue = attributes[e.attributeName];
						e.newValue = this.attr(e.attributeName);
						attributes[e.attributeName] = e.newValue;
					}

					this.data('attr-old-value', attributes); //update the old value object
				}
			}

			//initialize Mutation Observer
			var MutationObserver = window.MutationObserver
					|| window.WebKitMutationObserver;

			$.fn.attrchange = function(a, b) {
				if (typeof a == 'object') {//core
					var cfg = {
						trackValues : false,
						callback : $.noop
					};
					//backward compatibility
					if (typeof a === "function") { cfg.callback = a; } else { $.extend(cfg, a); }

					if (cfg.trackValues) { //get attributes old value
						this.each(function(i, el) {
							var attributes = {};
							for ( var attr, i = 0, attrs = el.attributes, l = attrs.length; i < l; i++) {
								attr = attrs.item(i);
								attributes[attr.nodeName] = attr.value;
							}
							$(this).data('attr-old-value', attributes);
						});
					}

					if (MutationObserver) { //Modern Browsers supporting MutationObserver
						var mOptions = {
							subtree : false,
							attributes : true,
							attributeOldValue : cfg.trackValues
						};
						var observer = new MutationObserver(function(mutations) {
							mutations.forEach(function(e) {
								var _this = e.target;
								//get new value if trackValues is true
								if (cfg.trackValues) {
									e.newValue = $(_this).attr(e.attributeName);
								}
								if ($(_this).data('attrchange-status') === 'connected') { //execute if connected
									cfg.callback.call(_this, e);
								}
							});
						});

						return this.data('attrchange-method', 'Mutation Observer').data('attrchange-status', 'connected')
								.data('attrchange-obs', observer).each(function() {
									observer.observe(this, mOptions);
								});
					} else if (isDOMAttrModifiedSupported()) { //Opera
						//Good old Mutation Events
						return this.data('attrchange-method', 'DOMAttrModified').data('attrchange-status', 'connected').on('DOMAttrModified', function(event) {
							if (event.originalEvent) { event = event.originalEvent; }//jQuery normalization is not required
							event.attributeName = event.attrName; //property names to be consistent with MutationObserver
							event.oldValue = event.prevValue; //property names to be consistent with MutationObserver
							if ($(this).data('attrchange-status') === 'connected') { //disconnected logically
								cfg.callback.call(this, event);
							}
						});
					} else if ('onpropertychange' in document.body) { //works only in IE
						return this.data('attrchange-method', 'propertychange').data('attrchange-status', 'connected').on('propertychange', function(e) {
							e.attributeName = window.event.propertyName;
							//to set the attr old value
							checkAttributes.call($(this), cfg.trackValues, e);
							if ($(this).data('attrchange-status') === 'connected') { //disconnected logically
								cfg.callback.call(this, e);
							}
						});
					}
					return this;
				} else if (typeof a == 'string' && $.fn.attrchange.hasOwnProperty('extensions') &&
						$.fn.attrchange['extensions'].hasOwnProperty(a)) { //extensions/options
					return $.fn.attrchange['extensions'][a].call(this, b);
				}
			}
		})(jQuery);










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
		// var s = document.createElement("script");
		// s.type = "text/javascript";
		// s.src = "//static.addtoany.com/menu/page.js";
		// // Use any selector
		// $("header").append(s);

		jQuery(document).ready(function ($) {
			setTimeout(function () {
				var s = '<script type=\"text/javascript\" src=\"https:\/\/static.addtoany.com\/menu\/page.js" async><\/script>';
				$(function () {
					$("body").append(s);
				});
			}, 500);
		});


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

		// jQuery(document).ready(function ($) {
		jQuery(document).ready(function($) {

			if ($(window).width() > 600) {

		 // Оборачиваем каждую кнопку SocialLock
			// START
			// --------------------------------------------------------------

			// Оборачиваем весь контент в нутри div#sociallocker в блок для скрытия в оверлее
			$('div.sociallocker').wrapInner("<div class='sociallocker-content'></div>");

			// ВСТАВКА КОДА С КНОПКАМИ И ОВЕРЛЕЕМ
			// ====================================
			// Вставляем блок с кнопками от AddToAny перед обернутым содержимым
			$("<div class=\"sociallocker-links\"> <!-- AddToAny BEGIN --> <div class=\"a2a_kit a2a_kit_size_32 a2a_default_style\"> <a class=\"a2a_dd\" href=\"https://www.addtoany.com/share\"> </a> <a class=\"a2a_button_facebook\"></a> <a class=\"a2a_button_twitter\"></a>  <a class=\"a2a_button_pinterest\"></a> <a class=\"a2a_button_linkedin\"></a> <a class=\"a2a_button_trello\"></a> </div> </div>").insertBefore(".sociallocker-content");
			// Вставляем блок с оверлеем
			$("<div class=\"sociallocker-overlay\"><i class=\"fa fa-lock\"></i>Загрузить файл добавив страницу в свою социальную сеть<i class=\"fa fa-share-alt\"></i></div > ").insertAfter('.sociallocker-content');


			// --------------------------------------------------------------
			// Оборачиваем каждую кнопку SocialLock
			// END

			// =======================================================================================================
			// Едреный скрипт благодаря которому появляется возможность отследить изменения style свойств объекта
			// START
			// -------------------------------------------------------------------------------------------------------


			// -------------------------------------------------------
			// AttrChange.js START - Отслеживаем события в DOM дереве
			// -------------------------------------------------------
		/*
			$('#a2apage_overlay').attrchange({
			   trackValues: true,
				callback: function(event) {
					// which attribute you want to watch for changes
					if(event.attributeName == "style") {

							console.log('Внимание!!!! Изменение атрибутов начало происходить!!!!');
							// ----------------------------------------------------
		if ($("div#a2apage_modal").css("display") == "block") {


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
							// ----------------------------------------------------
					}
				}
			});*/

			// ----------------------------------------------------
			// AttrChange.js END
			// ----------------------------------------------------
			// });



		// jQuery(document).ready(function($){
			$(window).on('load', function () {
			// watch the content
			$("div#a2a_overlay").watch({
				properties: "top,left,opacity,display,attr_class",
				watchChildren: true,
				callback: function (data, i) {
					if ($(this).css("display") == "block") {
						//alert('Появился');
						setTimeout(function () {
						$('body').find('#a2a_overlay').css('display', 'none');

						$('body').find("div#a2apage_modal").css('display', 'none');

						$('body').find('div#a2a_thanks').css('display', 'none');
						}, 3500);

						$(".sociallocker-links").each(function () {
							$(this).css('display', 'none');
						});
						$(".sociallocker-overlay").each(function () {
							$(this).css('display', 'none');
						});
						$(".sociallocker-content").each(function () {
							$(this).css('top', '0');
						});
					}
		//             console.log("text changed");
				}
			});
			});

		// });
			}

		});