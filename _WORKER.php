<?php

//Download and Insert a Remote Image File into the WordPress Media Library
//https://kellenmace.com/download-insert-remote-image-file-wordpress-media-library/
// Require the file that contains the KM_Download_Remote_Image class.
//require_once plugin_dir_path( __FILE__ ) . 'vendor/class-download-remote-image.php';
require_once plugin_dir_path( __FILE__ ) . 'vendor/autoload.php';

$MarkdownParser = new \cebe\markdown\Markdown();
//global $MarkDownImageFolder_sds_editor_tools;
$MarkDownImageFolder_Updater_all_posts_after_WP_All_Import = SDStudio_Updater_all_posts_after_WP_All_Import__PLUGIN_URL.'_markdown/images/';



// Название плагина
//$plugin_data = get_plugin_data( __FILE__ );
$plugin_name = SDStudioPluginName_sds_uapa_wpallimp();
$plugin_version = SDStudioPluginVersion_sds_uapa_wpallimp();


//Download and Insert a Remote Image File into the WordPress Media Library
//https://kellenmace.com/download-insert-remote-image-file-wordpress-media-library/
// Require the file that contains the KM_Download_Remote_Image class.

// Подключаем в основном файле плагина
// require_once plugin_dir_path( __FILE__ ) . '_WORKER.php';
// Заменяем sds-upd-data-year-posts на свой слаг плагина

//https://cdn.jsdelivr.net/gh/google/code-prettify@master/loader/run_prettify.js

 // if ( is_plugin_active( 'accelerated-mobile-pages/accelerated-moblie-pages.php' ) ) { 
	//plugin is activated 
// }
 
 
//if (!function_exists('run_prettify') &&  !is_plugin_active( 'accelerated-mobile-pages/accelerated-moblie-pages.php' )) {
//
//    add_action('wp_enqueue_scripts', 'run_prettify');
//
//    function run_prettify()
//    {
//        wp_enqueue_script('run_prettify', 'https://cdn.jsdelivr.net/gh/google/code-prettify@master/loader/run_prettify.js');
//    }
//}


//require_once plugin_dir_path(__FILE__) . 'wp-content/plugins/redux-framework-4/redux-framework.php';
//wp-content/plugins/sds-uapa-wpallimp/wp-content/plugins/redux-framework-4/redux-framework.php



if (!class_exists('ReduxFramework')) {
//==========================================
//==========================================
// Подключаем Redux
    // Redux Framework
//    require_once plugin_dir_path(__FILE__) . 'vendor/autoload.php';

    require_once plugin_dir_path(__FILE__) . 'wp-content/plugins/redux-framework-4/redux-framework.php';
    //require_once plugin_dir_path(__FILE__) . '/wp-content/plugins/redux-framework-4/ReduxCore/framework.php';

//Redux::setSection($opt_name__redux_sds_upd_data_year_posts, array(    'title' => esc_html__('Section title', 'yourtextdomain') ,    'id' => esc_html__('section-unique-id', ' yourtextdomain') ,    'icon' => 'icon-name',    'fields' => array()));

//==========================================
//==========================================
}
if (!class_exists('Redux')) {
    return null;
}


//-----------------------------------------
// REMOVE DEMO and PROMO REDUX
// START
//-----------------------------------------
/**
 * Disable Redux Developer Mode dev_mode
 * https://asique.net/disable-redux-framework-developer-mode-dev_mode/
 * START
 */

if (!function_exists('redux_disable_dev_mode_plugin')) {

    function redux_disable_dev_mode_plugin($redux)
    {
        if ($redux->args['opt_name'] != 'redux_demo') {
            $redux->args['dev_mode'] = false;
            $redux->args['forced_dev_mode_off'] = false;
        }
    }

    add_action('redux/construct', 'redux_disable_dev_mode_plugin');
}

if (!function_exists('gl_removeDemoModeLink')) {
    function gl_removeDemoModeLink()
    {
        if (class_exists('ReduxFrameworkPlugin')) {
            remove_filter('plugin_row_meta', [ReduxFrameworkPlugin::get_instance(), 'plugin_metalinks'], null, 2);
        }
        if (class_exists('ReduxFrameworkPlugin')) {
            remove_action('admin_notices', [ReduxFrameworkPlugin::get_instance(), 'admin_notices']);
        }
    }

    add_action('init', 'gl_removeDemoModeLink');
}


/**
 * END
 * Disable Redux Developer Mode dev_mode
 */
add_action('redux/loaded', 'remove_demo');


/**
 * Removes the demo link and the notice of integrated demo from the redux-framework plugin
 * https://forums.envato.com/t/how-to-remove-redux-framework-notice/62645/4
 * START
 */
if (!function_exists('remove_demo')) {
    function remove_demo()
    {
        // Used to hide the demo mode link from the plugin page. Only used when Redux is a plugin.
        if (class_exists('ReduxFrameworkPlugin')) {
            remove_filter('plugin_row_meta', [
                ReduxFrameworkPlugin::instance(),
                'plugin_metalinks'
            ], null, 2);

            // Used to hide the activation notice informing users of the demo panel. Only used when Redux is a plugin.
            remove_action('admin_notices', [ReduxFrameworkPlugin::instance(), 'admin_notices']);
        }
    }
}
/**
 * END
 * Removes the demo link and the notice of integrated demo from the redux-framework plugin
 * https://forums.envato.com/t/how-to-remove-redux-framework-notice/62645/4
 */

/**
 * https://docs.reduxframework.com/core/the-basics/removing-demo-mode-and-notices/
 * START
 */
if (!function_exists('removeDemoModeLink')) {
    function removeDemoModeLink()
    { // Be sure to rename this function to something more unique
        if (class_exists('ReduxFrameworkPlugin')) {
            remove_filter('plugin_row_meta', [ReduxFrameworkPlugin::get_instance(), 'plugin_metalinks'], null, 2);
        }
        if (class_exists('ReduxFrameworkPlugin')) {
            remove_action('admin_notices', [ReduxFrameworkPlugin::get_instance(), 'admin_notices']);
        }
    }

    add_action('init', 'removeDemoModeLink');
}
/**
 * END
 * https://docs.reduxframework.com/core/the-basics/removing-demo-mode-and-notices/
 */
//-----------------------------------------
// END
// REMOVE DEMO and PROMO REDUX
//-----------------------------------------



// This is your option name where all the Redux data is stored.
//dd($opt_name);
$opt_name = 'redux_sds_uapa_wpallimp';
//Redux::init($opt_name);
/**
 * GLOBAL ARGUMENTS
 * All the possible arguments for Redux.
 * For full documentation on arguments, please refer to: @link https://github.com/ReduxFramework/ReduxFramework/wiki/Arguments
 */

/**
 * ---> BEGIN ARGUMENTS
 */

$theme = wp_get_theme(); // For use with some settings. Not necessary.

$args = [
    // REQUIRED!!  Change these values as you need/desire.
    'opt_name'                  => $opt_name,

    // Name that appears at the top of your panel.
    'display_name'              => $plugin_name,
    // Version that appears at the top of your panel.
    'display_version'           => $plugin_version,

    // Specify if the admin menu should appear or not. Options: menu or submenu (Under appearance only).
    'menu_type'                 => 'menu',

    // Show the sections below the admin menu item or not.
    'allow_sub_menu'            => true,

    'menu_title'                => esc_html__( 'Updater all posts after WP All Import', 'your-domain-here' ),
    'page_title'                => esc_html__( 'SDStudio Updater all posts after WP All Import', 'your-domain-here' ),

    // Specify a custom URL to an icon.
    'menu_icon'                 => 'dashicons-welcome-widgets-menus',

    // Use a asynchronous font on the front end or font string.
    'async_typography'          => true,

    // Disable this in case you want to create your own google fonts loader.
    'disable_google_fonts_link' => false,

    // Show the panel pages on the admin bar.
    'admin_bar'                 => false,

    // Choose an icon for the admin bar menu.
    'admin_bar_icon'            => 'dashicons-portfolio',

    // Choose an priority for the admin bar menu.
    'admin_bar_priority'        => 50,

    // Set a different name for your global variable other than the opt_name.
    'global_variable'           => '',

    // Show the time the page took to load, etc.
    'dev_mode'                  => false,

    // Enable basic customizer support.
    'customizer'                => true,

    // Order where the menu appears in the admin area. If there is any conflict, something will not show. Warning.
    'page_priority'             => null,

    // For a full list of options, visit: @link http://codex.wordpress.org/Function_Reference/add_submenu_page#Parameters.
    'page_parent'               => 'themes.php',

    // Permissions needed to access the options panel.
    'page_permissions'          => 'manage_options',


    // Force your panel to always open to a specific tab (by id).
    'last_tab'                  => '',

    // Icon displayed in the admin panel next to your menu_title.
    'page_icon'                 => 'icon-themes',

    // Page slug used to denote the panel.
    'page_slug'                 => '_options',

    // On load save the defaults to DB before user clicks save or not.
    'save_defaults'             => true,

    // If true, shows the default value next to each field that is not the default value.
    'default_show'              => false,

    // What to print by the field's title if the value shown is default. Suggested: *.
    'default_mark'              => '',

    // Shows the Import/Export panel when not used as a field.
    'show_import_export'        => true,

    // CAREFUL -> These options are for advanced use only.
    'transient_time'            => 60 * MINUTE_IN_SECONDS,

    // Global shut-off for dynamic CSS output by the framework. Will also disable google fonts output.
    'output'                    => true,

    // Allows dynamic CSS to be generated for customizer and google fonts, but stops the dynamic CSS from going to the head.
    'output_tag'                => true,

    // FUTURE -> Not in use yet, but reserved or partially implemented. Use at your own risk.
    // possible: options, theme_mods, theme_mods_expanded, transient. Not fully functional, warning!
    'database'                  => '',

    // If you prefer not to use the CDN for Select2, Ace Editor, and others, you may download the Redux Vendor Support plugin yourself and run locally or embed it in your code.
    'use_cdn'                   => true,
    'compiler'                  => true,

    // HINTS.
    'hints'                     => [
        'icon'          => 'el el-question-sign',
        'icon_position' => 'right',
        'icon_color'    => 'lightgray',
        'icon_size'     => 'normal',
        'tip_style'     => [
            'color'   => 'light',
            'shadow'  => true,
            'rounded' => false,
            'style'   => '',
        ],
        'tip_position'  => [
            'my' => 'top left',
            'at' => 'bottom right',
        ],
        'tip_effect'    => [
            'show' => [
                'effect'   => 'slide',
                'duration' => '500',
                'event'    => 'mouseover',
            ],
            'hide' => [
                'effect'   => 'slide',
                'duration' => '500',
                'event'    => 'click mouseleave',
            ],
        ],
    ],
];

// ADMIN BAR LINKS -> Setup custom links in the admin bar menu as external items.
$args['admin_bar_links'][] = [
    'id'    => 'redux-docs',
    'href'  => '//docs.reduxframework.com/',
    'title' => esc_html__( 'Documentation', 'your-domain-here' ),
];

$args['admin_bar_links'][] = [
    'id'    => 'redux-support',
    'href'  => '//github.com/ReduxFramework/redux-framework/issues',
    'title' => esc_html__( 'Support', 'your-domain-here' ),
];

$args['admin_bar_links'][] = [
    'id'    => 'redux-extensions',
    'href'  => 'reduxframework.com/extensions',
    'title' => esc_html__( 'Extensions', 'your-domain-here' ),
];

// SOCIAL ICONS -> Setup custom links in the footer for quick links in your panel footer icons.
// http://elusiveicons.com/icons/
$args['share_icons'][] = [
//    'url'   => 'https://github.com/Dudaevskiy',
    'url'   => $SDStudio_github_com,
    'title' => 'Visit us on GitHub',
    'target' => '_blank',
    'icon'  => 'el el-github',
];
$args['share_icons'][] = [
//    'url'   => 'https://www.facebook.com/WebSDStudio/',
    'url'   => $SDStudio_facebook_com,
    'title' => esc_html__( 'Like us on Facebook', 'sds-options-and-settings' ),
    'target' => '_blank',
    'icon'  => 'el el-facebook',
];
$args['share_icons'][] = [
//    'url'   => '//sdstudio.top/',
    'url'   => $SDStudio_site,
    'title' => esc_html__( 'Website', 'sds-options-and-settings' ),
    'target' => '_blank',
    'icon'  => 'el el-home',
];
$args['share_icons'][] = [
//    'url'   => 'https://www.linkedin.com/public-profile/settings?trk=d_flagship3_profile_self_view_public_profile&lipi=urn%3Ali%3Apage%3Ad_flagship3_profile_self_edit_contact_info%3BhWD%2Fwa9lSmWLHB9H6SsiWA%3D%3D',
    'url'   => $SDStudio_linkedin_com,
    'title' => esc_html__( 'FInd us on LinkedIn', 'sds-options-and-settings' ),
    'target' => '_blank',
    'icon'  => 'el el-linkedin',
];

// Panel Intro text -> before the form.
if ( ! isset( $args['global_variable'] ) || false !== $args['global_variable'] ) {
    if ( ! empty( $args['global_variable'] ) ) {
        $v = $args['global_variable'];
    } else {
        $v = str_replace( '-', '_', $args['opt_name'] );
    }
//    $args['intro_text'] = '<p>' . sprintf( __( 'Did you know that Redux sets a global variable for you? To access any of your saved options from within your code you can use your global variable: $s', 'your-domain-here' ) . '</p>', '<strong>' . $v . '</strong>' );
} else {
//    $args['intro_text'] = '<p>' . esc_html__( 'This text is displayed above the options panel. It isn\'t required, but more info is always better! The intro_text field accepts all HTML.', 'your-domain-here' ) . '</p>';
}

// Add content after the form.
//$args['footer_text'] = '<p>' . esc_html__( 'This text is displayed below the options panel. It isn\'t required, but more info is always better! The footer_text field accepts all HTML.', 'your-domain-here' ) . '</p>';

Redux::set_args( $opt_name, $args );

/*
 * ---> END ARGUMENTS
 */

/*
 * ---> BEGIN HELP TABS
 */

$help_tabs = [
    [
        'id'      => 'redux-help-tab-1',
        'title'   => esc_html__( 'Theme Information 1', 'your-domain-here' ),
        'content' => '<p>' . esc_html__( 'This is the tab content, HTML is allowed.', 'your-domain-here' ) . '</p>',
    ],

    [
        'id'      => 'redux-help-tab-2',
        'title'   => esc_html__( 'Theme Information 2', 'your-domain-here' ),
        'content' => '<p>' . esc_html__( 'This is the tab content, HTML is allowed.', 'your-domain-here' ) . '</p>',
    ],
];

Redux::set_help_tab( $opt_name, $help_tabs );

// Set the help sidebar.
$content = '<p>' . esc_html__( 'This is the sidebar content, HTML is allowed.', 'your-domain-here' ) . '</p>';
Redux::set_help_sidebar( $opt_name, $content );

/*
 * <--- END HELP TABS
 */

/*
 *
 * ---> BEGIN SECTIONS
 *
 */

/* As of Redux 3.5+, there is an extensive API. This API can be used in a mix/match mode allowing for. */

/* -> START Basic Fields. */

$kses_exceptions = [
    'a'      => [
        'href' => [],
    ],
    'strong' => [],
    'br'     => [],
];

//$section = [
//    'title'  => esc_html__( 'FAQ', 'sds-updater-all-faq' ),
//    'id'     => 'basic',
//    'desc'   => esc_html__( ').', 'your-domain-here' ),
//    'icon'   => 'el el-home',
//    'fields' => [
//        [
//            'id'       => 'opt-text',
////            'type'     => 'text',
////            'title'    => esc_html__( 'Example Text', 'your-domain-here' ),
//            'desc'     => esc_html__( 'Example description.', 'your-domain-here' ),
////            'subtitle' => esc_html__( 'Example subtitle.', 'your-domain-here' ),
////            'hint'     => array(
////                'content' => wp_kses( __( 'This is a <strong>hint</strong> tool-tip for the text field.<br/><br/>Add any HTML based text you like here.', 'your-domain here' ), $kses_exceptions ),
////            ),
//        ],
//    ],
//];
//
//Redux::set_section( $opt_name, $section );

//$faq = $MarkdownParser->parse( file_get_contents(dirname(__FILE__) . '/_markdown/faq.md') );
$faq = $MarkdownParser->parse( file_get_contents(SDStudio_Updater_all_posts_after_WP_All_Import__PLUGIN_DIR . '/README.md') );
$section = [
    'title' => __( 'FAQ', 'sds-uapa-wpallimp' ),
    'id'    => 'basic',
    'desc'  => $faq,
    'icon'  => 'el el-home',
];

Redux::set_section( $opt_name, $section  );

//$section = [
//    'title' => __( 'FAQ', 'your-domain-here' ),
//    'id'    => 'basic',
//    'desc'  => __( 'Для того что бы импортировать CSV файл используя плагин WP All Import нужно учитывать следующие факторы:<br>- Обязательно импортируем все со статусом опуубликованные (иначе не получится применить приобразование Markdown в HTML. Ну и данный плагин имееет опцию смены поста стаатуса на "Черновик").<br> - При импорте записей используйте данный шаблон импорта: шаблон импорта <a href="/wp-content/plugins/sds-uapa-wpallimp/files/MarkDown_to_WP_v1.txt">MarkDown_to_WP_v1
//</a><br><h2>Обязательные плагины</h2><h3>Markdown - плагины отвечающие за обработку</h3> - <a target="_blank" href="https://ru.wordpress.org/plugins/wp-githuber-md/">WP Githuber MD — WordPress Markdown Editor</a><br> - <a target="_blank" href="https://ru.wordpress.org/plugins/rest-api/">WP REST API</a><h4>Импортирование Markdown.md файлов в пост</h4>- <a target="_blank" href="https://ru.wordpress.org/plugins/import-markdown/">Import Markdown</a><h3>Лайт боксы и галереи</h3>- <a target="_blank" href="https://ru.wordpress.org/plugins/responsive-lightbox/">Responsive Lightbox & Gallery</a><br><h3>Редактирование контента с фронтенда</h3><a target="_blank" href="https://ru.wordpress.org/plugins/wp-front-end-editor/">Front-end Editor</a><h3>Внешние ссылки</h3><a target="_blank" href="https://ru.wordpress.org/plugins/sem-external-links/">External Links</a><h3>Кастомные слаги для ссылок постов</h3>- <a href="https://ru.wordpress.org/plugins/custom-permalinks/" target="_blank">Custom Permalinks</a>', 'your-domain-here' ),
//    'icon'  => 'el el-home',
//];
//
//Redux::set_section( $opt_name, $section );

/**
 * UPDAE ALL POSTS
 * START
 *********************************/

$section = [
    'title' => __( 'Обновить все записи', 'update-all-posts' ),
    'id'    => 'posts_updater',
    'subsection' => false,
    'fields' => [
        [
            'id'       => 'opt_multi_checkbox_update_all_posts',
            'type'     => 'checkbox',
            'title'    => __('Дополнительные опции', 'redux-sds-update_all_posts'),
            'subtitle' => __('Дополнительные функции и опции для обновления всех записей', 'redux-framework-demo'),
//            'desc'     => __('This is the description field, again good for additional info.', 'redux-framework-demo'),

            //Must provide key => value pairs for multi checkbox options
            'options'  => [
                '1' => 'Удалить изображение записи из тела (<img alt="this image post" class="poster-for-import-post" src="(.*)"(.*)>)',
                '2' => 'Сохранить как черновик',
                '3' => 'Применить только для черновиков записей',
                '4' => 'И сразу опубликовать (только для черновиков)',
                '5' => '✔ Удалить первое изображение у всех записей',
                '6' => '✔ Все изображения из галерей Joomla в шорт код галереи WordPress (Для каждого проекта свои настройки)',
                '7' => '✔ Все изображения в теле записей в LightBox',
            ],

            //See how default has changed? you also don't need to specify opts that are 0.
            'default' => [
                '1' => '0',
                '2' => '0',
                '3' => '0',
                '4' => '0',
                '5' => '0',
                '6' => '0',
                '7' => '0',
            ]
        ],
        [
            'id'           => 'opt-raw',
            'type'         => 'raw',
            'title'        => __('Логирование', 'redux-framework-demo'),
//            'subtitle'     => __('Subtitle text goes here.', 'redux-framework-demo'),
//            'desc'         => __('This is the description field for additional info.', 'redux-framework-demo'),
//            'content_path' => file_get_contents( SDStudio_Updater_all_posts_after_WP_All_Import__PLUGIN_DIR . '/_raw_text/001_Block_ajax_loging.txt' )
            'content' => '<pre id="sdstudio_ajax_logging">Здесь будет отображаться логирование...</pre>',
        ],
//        [
//            'id'       => 'opt-select-img-format-for-replaces',
//            'type'     => 'select',
//            'title'    => __('При обновлении применить light box к всем картинкам', 'redux-framework-demo'),
//            'subtitle' => __('Обновляем все изображения записей для приминения лайт боксов', 'redux-framework-demo'),
//            'desc'     => __('Выберите тип тега изображений (которые у Вас присутствуют в записях) для обновления', 'redux-framework-demo'),
//            // Must provide key => value pairs for select options
//            'options'  => [
//                '1' => 'Не применять',
//                'standart' => '<img src="" *>',
//                'sdstudio-not-light-box' => '<img class="SDStudio-NOT-LIGHT-BOX" src="" *>'
//            ],
//            'default'  => '1',
//        ],
        [
            'id'       => 'button-update-all-posts',
            'type'     => 'button_set',
            'title'    => __('Важная информация', 'redux-framework-demo'),
            'subtitle' => __('После нажатия, Вы не как не сможете остановить процесс обновления', 'redux-framework-demo'),
//            'desc'     => __('This is the description field, again good for additional info.', 'redux-framework-demo'),
            'multi'    => false,
            //Must provide key => value pairs for options
            'options' => [
                '1' => 'Обновить все посты',
//                '2' => 'Opt 2',
//                '3' => 'Opt 3'
            ],
//            'default' => array('2', '3'),
        ],
    ],
    'desc'  => __( 'При клике произойдет перебор абсолютно всех постов блога, и автоматическкое обновление каждого из них.', 'your-domain-here' ),
    // Иконки брать здесь
    // http://elusiveicons.com/icons/
    'icon'  => 'el el-repeat-alt',
];

Redux::set_section( $opt_name, $section );


/*
 * <--- END SECTIONS
 */

require_once plugin_dir_path( __FILE__ ) . '_sdstudio_controllers/redux-update-all-posts-JS-SCRIPT-aJax.php';

require_once plugin_dir_path( __FILE__ ) . '_sdstudio_controllers/redux-update-all-posts.php';

/**
 * END
 * UPDAE ALL POSTS
 *********************************/




$section = [
    'title' => __( 'Удаление записей', 'remove-drafts-sds-update-all-posts' ),
    'id'    => 'remove-drafts-sds',
    'subsection' => false,
    'fields' => [
        [
            'id'       => 'opt_multi_checkbox_remove-drafts',
            'type'     => 'checkbox',
            'title'    => __('Опции удаления записей', 'redux-sds-update_all_posts'),
            'subtitle' => __('Данные опции срабатывают отдельно от основной функцииобновления постов.', 'redux-framework-demo'),
//            'desc'     => __('This is the description field, again good for additional info.', 'redux-framework-demo'),

            //Must provide key => value pairs for multi checkbox options
            'options'  => [
                '1' => 'Удалить все черновики записей',
                '2' => 'Удалить все опубликкованные записи'
//                '3' => 'Opt 3'
            ],

            //See how default has changed? you also don't need to specify opts that are 0.
            'default' => [
                '1' => '0',
                '2' => '0'
//                '3' => '0'
            ]
        ],
        [
            'id'       => 'button-update-all-posts_remove-drafts',
            'type'     => 'button_set',
            'title'    => __('Важная информация', 'redux-framework-demo'),
            'subtitle' => __('После нажаатия, Вы не как не сможете остановить процесс удаления записей', 'redux-framework-demo'),
//            'desc'     => __('This is the description field, again good for additional info.', 'redux-framework-demo'),
            'multi'    => false,
            //Must provide key => value pairs for options
            'options' => [
                '1' => 'Начать удаление',
//                '2' => 'Opt 2',
//                '3' => 'Opt 3'
            ],
            'default' => ['0'],
        ],
    ],
    'desc'  => __( 'При клике произойдет перебор абсолютно всех постов блога, и автоматическкое обновление каждого из них.', 'your-domain-here' ),
    // Иконки брать здесь
    // http://elusiveicons.com/icons/
    'icon'  => 'el el-remove-circle',
];

Redux::set_section( $opt_name, $section );

require_once plugin_dir_path( __FILE__ ) . '_sdstudio_controllers/redux-remove-drafts-sds-update-all-posts-JS-SCRIPT-aJax.php';

require_once plugin_dir_path( __FILE__ ) . '_sdstudio_controllers/redux-remove-drafts-sds-update-all-posts.php';


// dd(get_post_meta(10214));
// dd(get_post(9928));
// "SDStudio_import_post_status"	"null_import"
?>