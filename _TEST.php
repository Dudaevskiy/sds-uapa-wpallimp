<?php
    add_action( 'admin_footer', 'test' ); // Write our JS below here



//$id = 27521;
//$get = get_post_meta($id);
//
////if ( metadata_exists( 'post', $post_id, 'SDStudio_ThisPost_remove_first_image' ) ) {
//if( in_array( 'SDStudio_ThisPost_remove_first_image', get_post_custom_keys($id) ) ){
//    $meta_value = get_post_meta( $id, 'SDStudio_ThisPost_remove_first_image', true );
//    if ($meta_value == 'true'){
//        s($meta_value);
//    }
//
//}
////dd($get);




    /**
     * aJax update all posts
     * START
     */
    function test_javascript() { ?>
    <script type="text/javascript" >
    jQuery(document).ready(function($) {
        $('#redux-header').click(function(){
            console.log('привет');
            var data = {
                'SEND':'First',
            }
            console.log(data);
            $.ajax({
                url: '/wp-admin/admin-ajax.php?action=wp_ajax_get_all_posts_ids',
                // url: 'http://ek.uabs.test/wp-content/plugins/sds-uapa-wpallimp/_TEST.php',
                data: data,
                type: "POST",
                async: false,
                // dataType: 'json',
                success: function (response) {
                    console.log(response);
                }
            })
        });
    });
    </script>
    <?php
    }
