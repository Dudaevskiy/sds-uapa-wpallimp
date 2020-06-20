<?php
// В данном случае обязательно используем wp-load
require_once( $_SERVER['DOCUMENT_ROOT'] . '/wp-load.php' );

/**
 * 2️⃣ - Обрабатываем каждый пост по отдельности
 */
add_action( 'wp_ajax_runer_update_all_posts', 'runer_update_all_posts' );
function runer_update_all_posts(){
    /**
     * FINISH
     */
    if (strpos($_POST['POSTS_IDs'], 'Пост для обработки: finish') !== false){
        echo 'finish';
        wp_die();
    }

    /**
     * ОБРАБОТКА ПОСТА
     */
    if (strpos($_POST['POSTS_IDs'], 'Пост для обработки') !== false){
        $GET_POSTS_IDs = $_POST['POSTS_IDs'];
        $informer = "\n";
        // =============================================
        // =============================================
//        $informer = intval( $_POST['update'] );
        $SelectVarIMG_val = $_POST['SelectVarIMG'];
        $OnlyForPostToDraft = $_POST['OPT_3_OnlyForPostToDraft'];//OnlyForDraftPosts,FALSE
        $PublishPosts = $_POST['OPT_4_PublishPosts'];// PublishPosts,FALSE
        global $OPT_5_RemoveFirstImageInAllPosts;
        $OPT_5_RemoveFirstImageInAllPosts = $_POST['OPT_5_RemoveFirstImageInAllPosts'];// PublishPosts,FALSE
        global $OPT_6_Gallery_IMG_Joomla_to_WordPres_ENABLE;
        $OPT_6_Gallery_IMG_Joomla_to_WordPres_ENABLE = $_POST['OPT_6_Gallery_IMG_Joomla_to_WordPres_ENABLE'];// PublishPosts,FALSE
        global $OPT_7_AllImagesToLightBox;
        $OPT_7_AllImagesToLightBox = $_POST['OPT_7_AllImagesToLightBox'];// PublishPosts,FALSE

        // STATUSES
        $custom_poststatus = [];
        if (!empty($_POST['OPT_3_OnlyForPostToDraft']) && $_POST['OPT_3_OnlyForPostToDraft'] == 'OnlyForDraftPosts'){
            $custom_poststatus = ['draft'];
        } else {
            $custom_poststatus = ['publish','draft'];
        }

        // MAGIC START
        // ID POST
        $post_id = $GET_POSTS_IDs;
        $post_id = explode(": ", $post_id);
        $post_id = $post_id[1];

        $get_post = get_post($post_id );
        $content = $get_post->post_content;
        $single_post->post_title = $get_post->post_title.'';
        $single_post->post_content = $get_post->post_content;

        // Informer
        $informer .= get_the_title($post_id)."\n";
        $informer .= get_permalink($post_id)."\n";

        // Создаем массив данных
        $my_post = array();
        $my_post['ID'] = $post_id;
        //==============================================

        // Удаляем все poster-for-import-post изображения в записи
        if (!empty($_POST['OPT_1_RemovMarkDownImage']) && $_POST['OPT_1_RemovMarkDownImage'] == 'RemovMarkDownImage_ENABLE') {
            $informer .= 'Для '.$post_id.' Удалено первое изображение с классом poster-for-import-post '."\n";
            $single_post->post_content = preg_replace('/<img alt="this image post" class="poster-for-import-post" src="(.*)"(.*)>/', '', $single_post->post_content);
        }

        // Статус поста 'OPT_2_SavePostToDraft':OPT_2_SavePostToDraft,//SavePostToDraft,FALSE
        if (!empty($_POST['OPT_2_SavePostToDraft']) && $_POST['OPT_2_SavePostToDraft'] == 'SavePostToDraft') {
            $informer .= 'Для '.$post_id.' Установлен статус "Черновик" '."\n";
            $single_post->post_status = 'draft';
        }

        //Публикуем пост $_POST['OPT_4_PublishPosts'];// PublishPosts
        if (!empty($_POST['OPT_4_PublishPosts']) && $_POST['OPT_4_PublishPosts'] == 'PublishPosts') {
            $informer .= 'Для '.$post_id.' Установлен статус "Опубликован" '."\n";
            $single_post->post_status = 'publish';
        }

        // Все изображения галерей Joomla в Галереи WordPress
        if (!empty($OPT_6_Gallery_IMG_Joomla_to_WordPres_ENABLE) && $OPT_6_Gallery_IMG_Joomla_to_WordPres_ENABLE == 'Gallery_IMG_Joomla_to_WordPres_ENABLE') {
            $informer .= 'Для '.$post_id.' произведен поиск и замена галереи Joomla на шорт код галереи WordPress" '."\n";

            // Если в теле статьи есть изображения в лайт боксе
            // значит выходим - статья уже обработана ранее
            if (strpos($single_post->post_content , 'class="SDStudio-light-box-enable"') == false){

                //====================================
                // Получаем вложенные изображения через URL
                // START
                // https://pippinsplugins.com/retrieve-attachment-id-from-image-url/
                //====================================
                libxml_use_internal_errors(true);
                $doc=new DOMDocument();
                //$doc->loadHTML("<html><body>Test<br><img src=\"myimage.jpg\" title=\"title\" alt=\"alt\"></body></html>");
                $doc->loadHTML('<?xml encoding="utf-8"?>' . $single_post->post_content);
                $xml=simplexml_import_dom($doc); // just to make xpath more simple
                $images=$xml->xpath('//img');
                $IMGs_URLs = '';
                $IMGs_IDs = '';

                if (!empty($images)){
                    // Основная магия захвата ID изображений из URL изображений
                    foreach ($images as $img) {
                        global $wpdb;
                        $image_url = $img['src'];
                        $image_id = $wpdb->get_col($wpdb->prepare("SELECT ID FROM $wpdb->posts WHERE guid='%s';", $image_url ));
                        $image_id = $image_id[0];
                        $IMGs_IDs .= $image_id . ",";
                    }
                    //====================================
                    // END
                    // Получаем вложенные изображения через URL
                    //====================================

                    $shortcode_gallery = '[gallery ids="'.$IMGs_IDs.'" columns="3" link="file"]';
                    // Удаляем последнюю запятую
                    $shortcode_gallery = str_replace('," columns','" columns',$shortcode_gallery);

                    $informer .= 'Для '.$post_id.' шорт код'.$shortcode_gallery."\n";

                    // 2 шаг
                    $replace_wraper_gallery = '/<div data-img-gallery-image="sdstudio-gallery-wrapper">(.*)<\/div>/ms';
                    $single_post->post_content = preg_replace($replace_wraper_gallery, $shortcode_gallery, $single_post->post_content);
//                    echo json_encode(array($single_post->ID.' - Галерея обновлена', "session"=>$_SESSION));


                }
            }
        }

        // Удалить первое изображение во всех записях
        // preg_replace('/<img alt="this image post" class="poster-for-import-post" src="(.*)"(.*)>/', '', $input_lines);
        global $OPT_5_RemoveFirstImageInAllPosts;
        if (!empty($OPT_5_RemoveFirstImageInAllPosts) && $OPT_5_RemoveFirstImageInAllPosts == 'RemoveFirstImageInAllPosts_ENABLE') {
            // Если в теле статьи есть изображения в лайт боксе
            // значит выходим - статья уже обработана ранее
//            if (strpos($single_post->post_content , 'class="SDStudio-light-box-enable"') == false) {
                // Добавляем мета дату что бы дважды не удалить первую картинку при следующем запуске
                if( in_array( 'SDStudio_ThisPost_remove_first_image', get_post_custom_keys($post_id) ) ){
                    $meta_value = get_post_meta( $post_id, 'SDStudio_ThisPost_remove_first_image', true );
                    if ($meta_value == 'true'){
                        $informer .= 'Для '.$post_id.' - ✔ УЖЕ Удалено первое изображение записи ранее" '."\n";
                    }
                } else {
                    add_metadata( 'post', $post_id, 'SDStudio_ThisPost_remove_first_image', 'true', true );
                    $single_post->post_content = preg_replace("/<img[^>]+\>/i", "", $single_post->post_content, 1);
                    $informer .= 'Для '.$post_id.' - Удалено первое изображение записи" '."\n";
                }
//            }
        }


        // 3 шаг - все изображения в лайт боксы
        global $OPT_7_AllImagesToLightBox;
        if (!empty($OPT_7_AllImagesToLightBox) && $OPT_7_AllImagesToLightBox == 'OPT_7_AllImagesToLightBox_ENABLE') {
            // Если в теле статьи есть изображения в лайт боксе
            // значит выходим - статья уже обработана ранее
            if (strpos($single_post->post_content , 'class="SDStudio-light-box-enable"') == false) {
                $pattern = '/(<img[^>]*src=\"([^>]*?)\"(.*)>)/i';
                $replacement = '<a href="$2" data-rel="lightbox" ><img class="SDStudio-light-box-enable" src="$2"$3></a>';
                $single_post->post_content = preg_replace($pattern, $replacement, $single_post->post_content);

                $informer .= 'Для '.$post_id.' - Все изображение обернуты в LightBox" '."\n";
            }
        }



        // Все изображения в лайт бокс тип 'standart'
        if (!empty($_POST['SelectVarIMG']) && $_POST['SelectVarIMG'] == 'standart'){
            // Применяем lightbox
            // https://gist.github.com/hagronnestad/5336369
            $pattern = '/(<img[^>]*src=\"([^>]*?)\"(.*)>)/i';
            $replacement = '<a href="$2" data-rel="lightbox" ><img class="SDStudio-light-box-enable" src="$2"$3></a>';
            $single_post->post_content = preg_replace($pattern, $replacement, $single_post->post_content);
        }

        // Все изображения в лайт бокс тип 'sdstudio-not-light-box'
        if (!empty($_POST['SelectVarIMG']) && $_POST['SelectVarIMG'] == 'sdstudio-not-light-box'){
            // Применяем lightbox
            // https://gist.github.com/hagronnestad/5336369
            $pattern = '/(<img class=\"SDStudio-NOT-LIGHT-BOX\" src=\"([^>]*?)\"(.*)>)/i';
            $replacement = '<a href="$2" data-rel="lightbox" ><img class="SDStudio-light-box-enable" src="$2"$3></a>';
            $single_post->post_content = preg_replace($pattern, $replacement, $single_post->post_content);
        }

        if ($single_post->post_status){
            $my_post['post_status'] = $single_post->post_status;
        }
        $my_post['post_content'] = $single_post->post_content;

        wp_update_post( wp_slash($my_post) );

        // MAGIC END
        // =============================================
        // =============================================
        $informer .= "\n";
        echo $GET_POSTS_IDs.$informer;
    }

}

/**
 * 1️⃣ - Получаем ID всех постов
 */
add_action( 'wp_ajax_get_all_posts_ids', 'get_all_posts_ids' );
function get_all_posts_ids() {
    if ($_POST['RUN_GET']){
        // Обработка статусов
        $custom_poststatus = [];
        if (!empty($_POST['OPT_3_OnlyForPostToDraft']) && $_POST['OPT_3_OnlyForPostToDraft'] == 'OnlyForDraftPosts'){
            $custom_poststatus = ['draft'];
        } else {
            $custom_poststatus = ['publish','draft'];
        }
        // Сначала получаем все посты
        $args = [
            'post_type' => 'post',
            'post_status' => $custom_poststatus,
//           'post_status' => array('publish','draft'),
            'numberposts' => -1
            // Для еденичной проверки
//           'post__in' => array(37506)
        ];
        $all_posts = get_posts($args);
        // Получаем все ID постов
        $IDs = '';
        foreach ($all_posts as $single_post) {
            $IDs .= $single_post->ID . ', ';
        }
        $IDs .= 'finish ';
        $informer = 'ID всех записей для обработки: ' . $IDs;
        echo json_encode(['POSTS_IDs' => $informer]);
        wp_die();
    }
}