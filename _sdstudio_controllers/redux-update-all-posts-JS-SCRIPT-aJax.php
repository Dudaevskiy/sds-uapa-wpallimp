<?php
add_action( 'admin_footer', 'my_action_javascript' ); // Write our JS below here

/**
 * aJax update all posts
 * START
 */
function my_action_javascript() { ?>
    <script type="text/javascript" >
        jQuery(document).ready(function($) {
            $('body').on('click touch','[for="button-update-all-posts-buttonset1"]', function(){
                console.log('привет');
                $("#sdstudio_ajax_logging").html('Начинаем обработку постов');
                // Дополнительные опции, для передачи в aJax
                // START
                // Удалить изображение записи из тела (<!-- this image post <img src="*"> -->)
            var OPT_1_RemovMarkDownImage = $('[for="redux_sds_uapa_wpallimp_opt_multi_checkbox_update_all_posts_1_0"] > input:first-child').val();
            var OPT_2_SavePostToDraft = $('[for="redux_sds_uapa_wpallimp_opt_multi_checkbox_update_all_posts_2_1"] > input:first-child').val();
            var OPT_3_OnlyForPostToDraft = $('[for="redux_sds_uapa_wpallimp_opt_multi_checkbox_update_all_posts_3_2"] > input:first-child').val();
            var OPT_4_PublishPosts = $('[for="redux_sds_uapa_wpallimp_opt_multi_checkbox_update_all_posts_4_3"] > input:first-child').val();
            var OPT_5_RemoveFirstImageInAllPosts = $('[for="redux_sds_uapa_wpallimp_opt_multi_checkbox_update_all_posts_5_4"] > input:first-child').val();
            var OPT_6_Gallery_IMG_Joomla_to_WordPres_ENABLE = $('[for="redux_sds_uapa_wpallimp_opt_multi_checkbox_update_all_posts_6_5"] > input:first-child').val();
            var OPT_7_AllImagesToLightBox = $('[for="redux_sds_uapa_wpallimp_opt_multi_checkbox_update_all_posts_7_6"] > input:first-child').val();

            if (OPT_1_RemovMarkDownImage == 1){
                OPT_1_RemovMarkDownImage = 'RemovMarkDownImage_ENABLE';
            } else {
                OPT_1_RemovMarkDownImage = 'FALSE';
            }
            // --------------------------------
            if (OPT_2_SavePostToDraft == 1){
                OPT_2_SavePostToDraft = 'SavePostToDraft';
            } else {
                OPT_2_SavePostToDraft = 'FALSE';
            }
            // --------------------------------
            if (OPT_3_OnlyForPostToDraft == 1){
                OPT_3_OnlyForPostToDraft = 'OnlyForDraftPosts';
            } else {
                OPT_3_OnlyForPostToDraft = 'FALSE';
            }
            // --------------------------------

            if (OPT_4_PublishPosts == 1){
                OPT_4_PublishPosts = 'PublishPosts';
            } else {
                OPT_4_PublishPosts = 'FALSE';
            }
            // --------------------------------
            if (OPT_5_RemoveFirstImageInAllPosts == 1){
                OPT_5_RemoveFirstImageInAllPosts = 'RemoveFirstImageInAllPosts_ENABLE';
            } else {
                OPT_5_RemoveFirstImageInAllPosts = 'FALSE';
            }
            // --------------------------------
            if (OPT_6_Gallery_IMG_Joomla_to_WordPres_ENABLE == 1){
                OPT_6_Gallery_IMG_Joomla_to_WordPres_ENABLE = 'Gallery_IMG_Joomla_to_WordPres_ENABLE';
            } else {
                OPT_6_Gallery_IMG_Joomla_to_WordPres_ENABLE = 'FALSE';
            }
            // --------------------------------
            if (OPT_7_AllImagesToLightBox == 1){
                OPT_7_AllImagesToLightBox = 'OPT_7_AllImagesToLightBox_ENABLE';
            } else {
                OPT_7_AllImagesToLightBox = 'FALSE';
            }
            // --------------------------------
            console.log(OPT_1_RemovMarkDownImage);
            // END
            // Дополнительные опции, для передачи в aJax

            // Выборка варианта тегов изображений на сайте, для передачи в aJax
            // START
            var SelectVarIMG = $('body').find('span#select2-opt-select-img-format-for-replaces-select-container').text();
            var SelectVarIMG_val;
            if (SelectVarIMG == '×<img src="" *>'){
                SelectVarIMG_val = 'standart';
            } else if (SelectVarIMG == '×<img class="SDStudio-NOT-LIGHT-BOX" src="" *>'){
                SelectVarIMG_val = 'sdstudio-not-light-box';
            } else {
                SelectVarIMG_val = 'FALSE';
            }
            // END
            // Выборка варианта тегов изображений на сайте, для передачи в aJax
            // window.GET_POSTS_IDs = 'RUN_GET';


            //////////////////////////////////
            // Функция для перебора всех постов
            //////////////////////////////////
            function getProgress($var){
                console.log('👍👍👍 Погнали выполнять функцию');
                console.log($var);
                // Массив для ajax
                var data = {
                    'POSTS_IDs':$var,
                    'OPT_1_RemovMarkDownImage':OPT_1_RemovMarkDownImage,//RemovMarkDownImage_ENABLE,FALSE
                    'OPT_2_SavePostToDraft':OPT_2_SavePostToDraft,//SavePostToDraft,FALSE
                    'OPT_3_OnlyForPostToDraft':OPT_3_OnlyForPostToDraft,//OnlyForDraftPosts,FALSE
                    'OPT_4_PublishPosts':OPT_4_PublishPosts,// PublishPosts,FALSE
                    'OPT_5_RemoveFirstImageInAllPosts':OPT_5_RemoveFirstImageInAllPosts,// PublishPosts,FALSE
                    'OPT_6_Gallery_IMG_Joomla_to_WordPres_ENABLE':OPT_6_Gallery_IMG_Joomla_to_WordPres_ENABLE,// PublishPosts,FALSE
                    'OPT_7_AllImagesToLightBox':OPT_7_AllImagesToLightBox,// PublishPosts,FALSE
                    'SelectVarIMG': SelectVarIMG_val,//FALSE,standart,sdstudio-not-light-box
                    'update': true,
                };
                var This_response = '';

                function AllPostsupdaer_II($var){
                    // console.log('🔑🔑🔑🔑🔑🎶🎶🎶🎶❤❤❤'+This_response);
                    // Для оповещении о текущем состоянии ответа
                    console.log($var);

                    console.log('2️⃣ Активно правило - Пост для обработки');

                    // var CountSDStudio_Only_IDs = window.SDStudio_Only_IDs - 1;
                    window.SDStudio_Only_IDs = window.SDStudio_Only_IDs - 1;
                    console.log('🔑 Переменная для количества постов - '+window.SDStudio_Only_IDs);

                    var IDs_FIRST = window.SDStudio_sds_uapa_wpallimp_IDs.shift();
                    console.log(IDs_FIRST );
                    var GET_POSTS_IDs = 'Пост для обработки: '+IDs_FIRST;
                    var NEXT_GET_POSTS_IDs = 'Следующий пост для обработки: '+window.SDStudio_sds_uapa_wpallimp_IDs[0];
                    console.log(GET_POSTS_IDs);
                    console.log(NEXT_GET_POSTS_IDs);
                    var Informer = '#'+window.SDStudio_Only_IDs+'\n';
                    Informer = Informer+This_response.substring(0, This_response.length - 1)+'\n';
                    $("#sdstudio_ajax_logging").append('\n'+$var+'\n');
                    $("#sdstudio_ajax_logging").append(Informer);
                    // Располагаем скрол внизу
                    var objDiv = document.getElementById("sdstudio_ajax_logging");
                    objDiv.scrollTop = objDiv.scrollHeight;
                    getProgress(GET_POSTS_IDs);
                }

                function Finish_III($var){
                    console.log('3️⃣ Все посты обработаны выходим');
                    var informer = '✔✔✔✔✔✔✔✔✔  Спасибо за внимание, все посты обработаны';
                    console.log(informer);
                    Data = new Date();
                    Hour = Data.getHours();
                    Minutes = Data.getMinutes();
                    Seconds = Data.getSeconds();
                    GetTimeStart = "Время окончания: "+Hour+":"+Minutes;
                    $("#sdstudio_ajax_logging").append('\n'+$var+'\n');
                    $("#sdstudio_ajax_logging").append('\n'+GetTimeStart+'\n');
                    $("#sdstudio_ajax_logging").append(informer+'\n\n\n');
                    // Располагаем скрол внизу
                    var objDiv = document.getElementById("sdstudio_ajax_logging");
                    objDiv.scrollTop = objDiv.scrollHeight;
                    return;
                }

                $.ajax({
                    url: '/wp-admin/admin-ajax.php?action=runer_update_all_posts',
                    data:data,
                    // async: false,
                    type: "POST",
                    success: function(response) {
                        console.log('🎶🎶🎶🎶🎶🎶🎶'+response);
                        This_response = response;
                    }
                }).done(function (This_response) {
                    window.This_response = This_response;

                    // 3️⃣ Все посты обработаны выходим
                    if (This_response.indexOf('finish') > -1){
                        var Informer = '🆗🆗🆗🆗🆗🆗🆗 - Все прошло хорошо и без ошибок, оканчиваем работу';
                        Finish_III(Informer);
                    }

                    // 2️⃣ Активно правило - Пост для обработки
                    if (This_response.indexOf('Пост для обработки') > -1){
                        var Informer = '🆗🆗🆗🆗🆗🆗🆗 - Все хорошо и без ошибок';
                        AllPostsupdaer_II(Informer);
                    }

                }).fail(function (jqXHR, textStatus, errorThrown) {
                    console.log(jqXHR);
                    console.log(textStatus);
                    console.log(errorThrown);
                    // И запускаем правило для повторной обработки постов в случае если еще есть ID для обработки
                    if (window.SDStudio_Only_IDs > 0){
                        var Informer = '🔴⭕🔴⭕🔴⭕🔴⭕🔴⭕🔴⭕🔴⭕🔴⭕🔴 - Внимание была ошибка !!!! (II)'+"\n ID"+window.SDStudio_sds_uapa_wpallimp_IDs[0];
                        AllPostsupdaer_II(Informer);
                    } else {
                        // 3️⃣ Все посты обработаны выходим
                        if (This_response.indexOf('finish') > -1){
                            var Informer = '🔴⭕🔴⭕🔴⭕🔴⭕🔴⭕🔴⭕🔴⭕🔴⭕🔴 - Внимание была ошибка !!!! (III)'+"\n ID"+window.SDStudio_sds_uapa_wpallimp_IDs[0];
                            Finish_III(Informer);
                        }

                    }

                    serrorFunction();
                });
                        console.log('This_response - '+This_response);
                        console.log(data);
                }

            /////////////////////////////////////////
            // Функция ajax для сбора ID всех постов
            /////////////////////////////////////////
            function GetAllPostsIDs($VAR){
                // Массив для ajax
                var data = {
                    'RUN_GET':$VAR,
                    'OPT_1_RemovMarkDownImage':OPT_1_RemovMarkDownImage,//RemovMarkDownImage_ENABLE,FALSE
                    'OPT_2_SavePostToDraft':OPT_2_SavePostToDraft,//SavePostToDraft,FALSE
                    'OPT_3_OnlyForPostToDraft':OPT_3_OnlyForPostToDraft,//OnlyForDraftPosts,FALSE
                    'OPT_4_PublishPosts':OPT_4_PublishPosts,// PublishPosts,FALSE
                    'OPT_5_RemoveFirstImageInAllPosts':OPT_5_RemoveFirstImageInAllPosts,// PublishPosts,FALSE
                    'OPT_6_Gallery_IMG_Joomla_to_WordPres_ENABLE':OPT_6_Gallery_IMG_Joomla_to_WordPres_ENABLE,// PublishPosts,FALSE
                    'OPT_7_AllImagesToLightBox':OPT_7_AllImagesToLightBox,// PublishPosts,FALSE
                    'SelectVarIMG': SelectVarIMG_val,//FALSE,standart,sdstudio-not-light-box
                    'update': true,
                };
                $.ajax({
                    url: '/wp-admin/admin-ajax.php?action=get_all_posts_ids',
                    data: data,
                    type: "POST",
                    async: false,
                    // dataType: 'json',
                }).done(function (response) {
                    var This_response = JSON.parse(response);
                    This_response = This_response.POSTS_IDs;
                    if (This_response.indexOf('ID всех записей для обработки') > -1){
                        Data = new Date();
                        Hour = Data.getHours();
                        Minutes = Data.getMinutes();
                        Seconds = Data.getSeconds();
                        GetTimeStart = "Время начала: "+Hour+":"+Minutes;
                        $("#sdstudio_ajax_logging").append('\n'+GetTimeStart+'\n');
                        // Располагаем скрол внизу
                        var objDiv = document.getElementById("sdstudio_ajax_logging");
                        objDiv.scrollTop = objDiv.scrollHeight;
                        $("#sdstudio_ajax_logging").append(This_response+'\n\n\n');
                        // Располагаем скрол внизу
                        var objDiv = document.getElementById("sdstudio_ajax_logging");
                        objDiv.scrollTop = objDiv.scrollHeight;

                        console.log('1️⃣ Активно правило - ID всех записей для обработки');
                        // Удаляем все пробелы
                        // if (!window.SDStudio_sds_uapa_wpallimp_IDs){
                        var IDs = This_response;
                        // Удаляем все пробелы
                        IDs = IDs.replace(/\s/g, '');
                        // Делим на массив по :
                        IDs = IDs.split(':'); IDs = IDs[1];
                        // Делим на массив по ,
                        IDs = IDs.split(',');
                        console.log(IDs);
                        // Для количества постов
                        window.SDStudio_Only_IDs = IDs.length;
                        // var SDStudio_Only_IDs = window.SDStudio_Only_IDs.shift();
                        console.log('🔑 Переменная для количества постов - '+SDStudio_Only_IDs);

                        window.SDStudio_sds_uapa_wpallimp_IDs = IDs;

                        var IDs_FIRST = window.SDStudio_sds_uapa_wpallimp_IDs.shift();
                        console.log(IDs_FIRST );
                        console.log(window.SDStudio_sds_uapa_wpallimp_IDs);
                        console.log('Следующий пост для обработки - '+window.SDStudio_sds_uapa_wpallimp_IDs[0]);
                        var GET_POSTS_IDs = 'Пост для обработки: '+IDs_FIRST;
                        console.log(GET_POSTS_IDs);
                        getProgress(GET_POSTS_IDs);

                    }
                });
            }
            var RunGetAllPostsIDs = 'RUN_GET_ALL_IDs';
            console.log(RunGetAllPostsIDs);
            GetAllPostsIDs(RunGetAllPostsIDs);
        });
        });
    </script> <?php
}