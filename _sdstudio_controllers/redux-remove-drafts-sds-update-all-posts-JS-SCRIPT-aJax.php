<?php
add_action( 'admin_footer', 'remove_posts_javascript' ); // Write our JS below here

/**
 * aJax update all posts
 * START
 */
function remove_posts_javascript() { ?>
    <script type="text/javascript" >
        jQuery(document).ready(function($) {
            // since 2.8 ajaxurl is always defined in the admin header and points to admin-ajax.php
            $('body').on('click touch','[for="button-update-all-posts_remove-drafts-buttonset1"]', function(){
                console.log('Клик есть!');

                // Дополнительные опции, для передачи в aJax
                // START
                // Удалить все черновики
                var OPT_1 = $('[for="redux_sds_uapa_wpallimp_opt_multi_checkbox_remove-drafts_1_0"] > input:first-child').val();
                // Удалить все опубликованные
                var OPT_2 = $('[for="redux_sds_uapa_wpallimp_opt_multi_checkbox_remove-drafts_2_1"] > input:first-child').val();
                var OPT_5 = $('[for="redux_sds_uapa_wpallimp_opt_multi_checkbox_update_all_posts_5_4"] > input:first-child').val();
                var OPT_6 = $('[for="redux_sds_uapa_wpallimp_opt_multi_checkbox_update_all_posts_6_5"] > input:first-child').val();

            if (OPT_1 == 1){
                OPT_1 = 'RemovAllDraft_ENABLE';
            } else {
                OPT_1 = 'FALSE';
            }
            console.log('Удалить все черновики - '+OPT_1);

            if (OPT_2 == 1){
                OPT_2 = 'RemovAllPublish_ENABLE';
            } else {
                OPT_2 = 'FALSE';
            }
            // --------------------------------
            console.log('Удалить все ОПУБЛИКОВАННЫЕ - '+OPT_2);

            //
            // if (OPT_5 == 1){
            //     OPT_5 = 'RemovAllPublish_ENABLE';
            // } else {
            //     OPT_5 = 'FALSE';
            // }
            // // --------------------------------
            // console.log('Удалить первое изображение в записях - '+OPT_5);
            //
            //
            // if (OPT_6 == 1){
            //     OPT_6 = 'OPT_6_Gallery_IMG_Joomla_to_WordPres_ENABLE';
            // } else {
            //     OPT_6 = 'FALSE';
            // }
            // // --------------------------------
            // console.log('Удалить все ОПУБЛИКОВАННЫЕ - '+OPT_6);



            // --------------------------------
            // END
            // Дополнительные опции, для передачи в aJax

            // Массив для ajax
            var data = {
                'action': 'action_sdstudio_remove_all_posts',
                'OPT_1_RemoveAllDraftPosts':OPT_1,//RemovMarkDownImage_ENABLE,FALSE
                'OPT_2_RemoveAllPublishPosts':OPT_2,//SavePostToDraft,FALSE
                // 'OPT_5_RemoveFirstImageInAllPosts':OPT_5,
                // 'OPT_6_Gallery_IMG_Joomla_to_WordPres_ENABLE':OPT_6,
                // 'SelectVarIMG': SelectVarIMG_val,//FALSE,standart,sdstudio-not-light-box
                'remove': true,
            };

            console.log('var data:');
            console.log(data);


            jQuery.post(ajaxurl, data, function(response) {
                alert('Ответ сервера: ' + response);
            });
        })

        });
    </script> <?php
}