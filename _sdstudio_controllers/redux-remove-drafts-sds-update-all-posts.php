<?php

add_action( 'wp_ajax_action_sdstudio_remove_all_posts', 'action_sdstudio_remove_all_posts' );

function action_sdstudio_remove_all_posts() {
    global $wpdb; // this is how you get access to the database
    $informer = intval( $_POST['updtae'] );
    $RemovAllDrafts = $_POST['OPT_1_RemoveAllDraftPosts'];
    $RemoveAllPublishPosts = $_POST['OPT_2_RemoveAllPublishPosts'];

//    $informer = $_POST['OPT_1_RemoveAllDraftPosts'];
//    echo $informer;
//    wp_die();

    if ($informer = true){


        /**
         * START
         * SDStudio_import_post_status
         * null_import
         */

//Обновление всех постов
        function update_all_posts_for_remove() {
            $args = [
                'post_type' => 'post',
                'post_status' => ['publish','draft'],
                'numberposts' => -1
                // Для еденичной проверки
//                'post__in' => array(6830,12389)
            ];
            $all_posts = get_posts($args);

            foreach ($all_posts as $single_post){

                $post_id = $single_post->ID;
                $content = $single_post->post_content;

                $single_post->post_title = $single_post->post_title.'';

                // Удаляем все черновики
//                if (!empty($_POST['OPT_1_RemoveAllDraftPosts'])) {
                if (!empty($_POST['OPT_1_RemoveAllDraftPosts']) && $_POST['OPT_1_RemoveAllDraftPosts'] == 'RemovAllDraft_ENABLE') {
                    if ($single_post->post_status == 'draft'){
                        $single_post->post_status = 'trash';
                    };
                }
                // Удаляем все опубликованные
                if (!empty($_POST['OPT_2_RemoveAllPublishPosts']) && $_POST['OPT_2_RemoveAllPublishPosts'] == 'RemovAllPublish_ENABLE') {
                    if ($single_post->post_status == 'publish'){
                        $single_post->post_status = 'trash';
                    };
                }

                wp_update_post( $single_post );
            }
        }
        update_all_posts_for_remove();

        /**
         * END
         */
        $informer = 'Все записи успешно перемещены в корзину';
        echo $informer;
    }

    wp_die(); // this is required to terminate immediately and return a proper response
}

/**
 * END
 * aJax update all posts
 *
 */