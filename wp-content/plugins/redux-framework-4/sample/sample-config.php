<?php
/**
 * ReduxFramework Sample Config File
 * For full documentation, please visit: http://docs.reduxframework.com/
 *
 * @package Redux Framework
 */

defined( 'ABSPATH' ) || exit;

if ( ! class_exists( 'Redux' ) ) {
	return;
}

// This is your option name where all the Redux data is stored.
$opt_name = 'redux_demo';  // YOU MUST CHANGE THIS.  DO NOT USE 'redux_demo' IN YOUR PROJECT!!!

// Uncomment to disable demo mode.
/* Redux::disable_demo(); */  // phpcs:ignore Squiz.PHP.CommentedOutCode

/*
 * --> Used within different fields. Simply examples. Search for ACTUAL DECLARATION for field examples
 */

$sample_html = '';
if ( file_exists( dirname( __FILE__ ) . '/info-html.html' ) ) {
	ob_start();

	include dirname( __FILE__ ) . '/info-html.html';

	$sample_html = ob_get_clean();
}

// Background Patterns Reader.
$sample_patterns_path = Redux_Core::$dir . '../sample/patterns/';
$sample_patterns_url  = Redux_Core::$url . '../sample/patterns/';
$sample_patterns      = [];

if ( is_dir( $sample_patterns_path ) ) {
	$sample_patterns_dir = opendir( $sample_patterns_path );

	if ( $sample_patterns_dir ) {
		$sample_patterns = [];

		// phpcs:ignore WordPress.CodeAnalysis.AssignmentInCondition
		while ( false !== ( $sample_patterns_file = readdir( $sample_patterns_dir ) ) ) {
			if ( stristr( $sample_patterns_file, '.png' ) !== false || stristr( $sample_patterns_file, '.jpg' ) !== false ) {
				$name              = explode( '.', $sample_patterns_file );
				$name              = str_replace( '.' . end( $name ), '', $sample_patterns_file );
				$sample_patterns[] = [
					'alt' => $name,
					'img' => $sample_patterns_url . $sample_patterns_file,
				];
			}
		}
	}
}

// Used to execept HTML tags in description arguments where esc_html would remove.
$kses_exceptions = [
	'a'      => [
		'href' => [],
	],
	'strong' => [],
	'br'     => [],
	'code'   => [],
];

/*
 * ---> BEGIN ARGUMENTS
 */

/**
 * All the possible arguments for Redux.
 * For full documentation on arguments, please refer to: https://docs.reduxframework.com/core/arguments/
 */
$theme = wp_get_theme(); // For use with some settings. Not necessary.

// TYPICAL -> Change these values as you need/desire.
$args = [
	// This is where your data is stored in the database and also becomes your global variable name.
	'opt_name'                  => $opt_name,

	// Name that appears at the top of your panel.
	'display_name'              => $theme->get( 'Name' ),

	// Version that appears at the top of your panel.
	'display_version'           => $theme->get( 'Version' ),

	// Specify if the admin menu should appear or not. Options: menu or submenu (Under appearance only).
	'menu_type'                 => 'menu',

	// Show the sections below the admin menu item or not.
	'allow_sub_menu'            => true,

	// The text to appear in the admin menu.
	'menu_title'                => esc_html__( 'Sample Options', 'your-domain-here' ),

	// The text to appear on the page title.
	'page_title'                => esc_html__( 'Sample Options', 'your-domain-here' ),

	// Enabled the Webfonts typography module to use asynchronous fonts.
	'async_typography'          => true,

	// Disable to create your own google fonts loader.
	'disable_google_fonts_link' => false,

	// Show the panel pages on the admin bar.
	'admin_bar'                 => true,

	// Icon for the admin bar menu.
	'admin_bar_icon'            => 'dashicons-portfolio',

	// Priority for the admin bar menu.
	'admin_bar_priority'        => 50,

	// Sets a different name for your global variable other than the opt_name.
	'global_variable'           => '',

	// Show the time the page took to load, etc (forced on while on localhost or when WP_DEBUG is enabled).
	'dev_mode'                  => true,

	// Enable basic customizer support.
	'customizer'                => true,

	// Allow the panel to opened expanded.
	'open_expanded'             => false,

	// Disable the save warning when a user changes a field.
	'disable_save_warn'         => false,

	// Order where the menu appears in the admin area. If there is any conflict, something will not show. Warning.
	'page_priority'             => null,

	// For a full list of options, visit: http://codex.wordpress.org/Function_Reference/add_submenu_page#Parameters.
	'page_parent'               => 'themes.php',

	// Permissions needed to access the options panel.
	'page_permissions'          => 'manage_options',

	// Specify a custom URL to an icon.
	'menu_icon'                 => '',

	// Force your panel to always open to a specific tab (by id).
	'last_tab'                  => '',

	// Icon displayed in the admin panel next to your menu_title.
	'page_icon'                 => 'icon-themes',

	// Page slug used to denote the panel, will be based off page title, then menu title, then opt_name if not provided.
	'page_slug'                 => $opt_name,

	// On load save the defaults to DB before user clicks save.
	'save_defaults'             => true,

	// Display the default value next to each field when not set to the default value.
	'default_show'              => false,

	// What to print by the field's title if the value shown is default.
	'default_mark'              => '*',

	// Shows the Import/Export panel when not used as a field.
	'show_import_export'        => true,

	// The time transinets will expire when the 'database' arg is set.
	'transient_time'            => 60 * MINUTE_IN_SECONDS,

	// Global shut-off for dynamic CSS output by the framework. Will also disable google fonts output.
	'output'                    => true,

	// Allows dynamic CSS to be generated for customizer and google fonts,
	// but stops the dynamic CSS from going to the page head.
	'output_tag'                => true,

	// Disable the footer credit of Redux. Please leave if you can help it.
	'footer_credit'             => '',

	// If you prefer not to use the CDN for ACE Editor.
	// You may download the Redux Vendor Support plugin to run locally or embed it in your code.
	'use_cdn'                   => true,

	// Set the theme of the option panel.  Use 'classic' to rever to the Redux 3 style.
	'admin_theme'               => 'wp',

	// HINTS.
	'hints'                     => [
		'icon'          => 'el el-question-sign',
		'icon_position' => 'right',
		'icon_color'    => 'lightgray',
		'icon_size'     => 'normal',
		'tip_style'     => [
			'color'   => 'red',
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

	// FUTURE -> Not in use yet, but reserved or partially implemented. Use at your own risk.
	// possible: options, theme_mods, theme_mods_expanded, transient. Not fully functional, warning!
	'database'                  => '',
	'network_admin'             => true,
];


// ADMIN BAR LINKS -> Setup custom links in the admin bar menu as external items.
// PLEASE CHANGE THEME BEFORE RELEASEING YOUR PRODUCT!!
// If these are left unchanged, they will not display in your panel!
$args['admin_bar_links'][] = [
	'id'    => 'redux-docs',
	'href'  => '//docs.redux.io/',
	'title' => __( 'Documentation', 'your-domain-here' ),
];

$args['admin_bar_links'][] = [
	'id'    => 'redux-support',
	'href'  => '//github.com/ReduxFramework/redux-framework/issues',
	'title' => __( 'Support', 'your-domain-here' ),
];

$args['admin_bar_links'][] = [
	'id'    => 'redux-extensions',
	'href'  => 'redux.io/extensions',
	'title' => __( 'Extensions', 'your-domain-here' ),
];

// SOCIAL ICONS -> Setup custom links in the footer for quick links in your panel footer icons.
// PLEASE CHANGE THEME BEFORE RELEASEING YOUR PRODUCT!!
// If these are left unchanged, they will not display in your panel!
$args['share_icons'][] = [
	'url'   => '//github.com/ReduxFramework/ReduxFramework',
	'title' => 'Visit us on GitHub',
	'icon'  => 'el el-github',
];
$args['share_icons'][] = [
	'url'   => '//www.facebook.com/pages/Redux-Framework/243141545850368',
	'title' => 'Like us on Facebook',
	'icon'  => 'el el-facebook',
];
$args['share_icons'][] = [
	'url'   => '//twitter.com/reduxframework',
	'title' => 'Follow us on Twitter',
	'icon'  => 'el el-twitter',
];
$args['share_icons'][] = [
	'url'   => '//www.linkedin.com/company/redux-framework',
	'title' => 'Find us on LinkedIn',
	'icon'  => 'el el-linkedin',
];

// Panel Intro text -> before the form.
if ( ! isset( $args['global_variable'] ) || false !== $args['global_variable'] ) {
	if ( ! empty( $args['global_variable'] ) ) {
		$v = $args['global_variable'];
	} else {
		$v = str_replace( '-', '_', $args['opt_name'] );
	}

	// translators:  Panel opt_name.
	$args['intro_text'] = '<p>' . sprintf( esc_html__( 'Did you know that Redux sets a global variable for you? To access any of your saved options from within your code you can use your global variable: $%1$s', 'your-domain-here' ), '<strong>' . $v . '</strong>' ) . '<p>';
} else {
	$args['intro_text'] = '<p>' . esc_html__( 'This text is displayed above the options panel. It isn\'t required, but more info is always better! The intro_text field accepts all HTML.', 'your-domain-here' ) . '</p>';
}

// Add content after the form.
$args['footer_text'] = '<p>' . esc_html__( 'This text is displayed below the options panel. It isn\'t required, but more info is always better! The footer_text field accepts all HTML.', 'your-domain-here' ) . '</p>';

Redux::set_args( $opt_name, $args );

/*
 * ---> END ARGUMENTS
 */

/*
 * ---> START HELP TABS
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
 * ---> START SECTIONS
 */

// -> START Basic Fields
Redux::set_section(
	$opt_name,
	[
		'title'            => esc_html__( 'Basic Fields', 'your-domain-here' ),
		'id'               => 'basic',
		'desc'             => esc_html__( 'These are really basic fields!', 'your-domain-here' ),
		'customizer_width' => '400px',
		'icon'             => 'el el-home',
	]
);

Redux::set_section(
	$opt_name,
	[
		'title'            => esc_html__( 'Checkbox', 'your-domain-here' ),
		'id'               => 'basic-checkbox',
		'subsection'       => true,
		'customizer_width' => '450px',
		'desc'             => esc_html__( 'For full documentation on this field, visit: ', 'your-domain-here' ) . '<a href="//docs.reduxframework.com/core/fields/checkbox/" target="_blank">docs.reduxframework.com/core/fields/checkbox/</a>',
		'fields'           => [
			[
				'id'       => 'opt-checkbox',
				'type'     => 'checkbox',
				'title'    => esc_html__( 'Checkbox Option', 'your-domain-here' ),
				'subtitle' => esc_html__( 'No validation can be done on this field type', 'your-domain-here' ),
				'desc'     => esc_html__( 'This is the description field, again good for additional info.', 'your-domain-here' ),
				'default'  => '1', // 1 = on | 0 = off.
			],
			[
				'id'       => 'opt-multi-check',
				'type'     => 'checkbox',
				'title'    => esc_html__( 'Multi Checkbox Option', 'your-domain-here' ),
				'subtitle' => esc_html__( 'No validation can be done on this field type', 'your-domain-here' ),
				'desc'     => esc_html__( 'This is the description field, again good for additional info.', 'your-domain-here' ),

				// Must provide key => value pairs for multi checkbox options.
				'options'  => [
					'1' => 'Opt 1',
					'2' => 'Opt 2',
					'3' => 'Opt 3',
				],
				'default'  => [
					'1' => '1',
					'2' => '0',
					'3' => '0',
				],
			],
			[
				'id'       => 'opt-checkbox-data',
				'type'     => 'checkbox',
				'title'    => esc_html__( 'Multi Checkbox Option (with menu data)', 'your-domain-here' ),
				'subtitle' => esc_html__( 'No validation can be done on this field type', 'your-domain-here' ),
				'desc'     => esc_html__( 'This is the description field, again good for additional info.', 'your-domain-here' ),
				'data'     => 'menu',
			],
			[
				'id'       => 'opt-checkbox-sidebar',
				'type'     => 'checkbox',
				'title'    => esc_html__( 'Multi Checkbox Option (with sidebar data)', 'your-domain-here' ),
				'subtitle' => esc_html__( 'No validation can be done on this field type', 'your-domain-here' ),
				'desc'     => esc_html__( 'This is the description field, again good for additional info.', 'your-domain-here' ),
				'data'     => 'sidebars',
			],
		],
	]
);

Redux::set_section(
	$opt_name,
	[
		'title'            => esc_html__( 'Radio', 'your-domain-here' ),
		'id'               => 'basic-radio',
		'subsection'       => true,
		'customizer_width' => '500px',
		'desc'             => esc_html__( 'For full documentation on this field, visit: ', 'your-domain-here' ) . '<a href="//docs.reduxframework.com/core/fields/radio/" target="_blank">docs.reduxframework.com/core/fields/radio/</a>',
		'fields'           => [
			[
				'id'       => 'opt-radio',
				'type'     => 'radio',
				'title'    => esc_html__( 'Radio Option', 'your-domain-here' ),
				'subtitle' => esc_html__( 'No validation can be done on this field type', 'your-domain-here' ),
				'desc'     => esc_html__( 'This is the description field, again good for additional info.', 'your-domain-here' ),

				// Must provide key => value pairs for radio options.
				'options'  => [
					'1' => 'Opt 1',
					'2' => 'Opt 2',
					'3' => 'Opt 3',
				],
				'default'  => '2',
			],
			[
				'id'       => 'opt-radio-data',
				'type'     => 'radio',
				'title'    => esc_html__( 'Radio Option w/ Menu Data', 'your-domain-here' ),
				'subtitle' => esc_html__( 'No validation can be done on this field type', 'your-domain-here' ),
				'desc'     => esc_html__( 'This is the description field, again good for additional info.', 'your-domain-here' ),
				'data'     => 'menu',
			],
		],
	]
);

Redux::set_section(
	$opt_name,
	[
		'title'      => esc_html__( 'Sortable', 'your-domain-here' ),
		'id'         => 'basic-sortable',
		'subsection' => true,
		'desc'       => esc_html__( 'For full documentation on this field, visit: ', 'your-domain-here' ) . '<a href="//docs.reduxframework.com/core/fields/sortable/" target="_blank">docs.reduxframework.com/core/fields/sortable/</a>',
		'fields'     => [
			[
				'id'       => 'opt-sortable',
				'type'     => 'sortable',
				'title'    => esc_html__( 'Sortable Text Option', 'your-domain-here' ),
				'subtitle' => esc_html__( 'Define and reorder these however you want.', 'your-domain-here' ),
				'desc'     => esc_html__( 'This is the description field, again good for additional info.', 'your-domain-here' ),
				'label'    => true,
				'options'  => [
					'Text One'   => 'Item 1',
					'Text Two'   => 'Item 2',
					'Text Three' => 'Item 3',
				],
			],
			[
				'id'       => 'opt-check-sortable',
				'type'     => 'sortable',
				'mode'     => 'toggle', // toggle or text.
				'title'    => esc_html__( 'Sortable Toggle Option', 'your-domain-here' ),
				'subtitle' => esc_html__( 'Define and reorder these however you want.', 'your-domain-here' ),
				'desc'     => esc_html__( 'This is the description field, again good for additional info.', 'your-domain-here' ),
				'options'  => [
					'cb1' => 'Option One',
					'cb2' => 'Option Two',
					'cb3' => 'Option Three',
				],
				'default'  => [
					'cb1' => false,
					'cb2' => true,
					'cb3' => false,
				],
			],
		],
	]
);

Redux::set_section(
	$opt_name,
	[
		'title'            => esc_html__( 'Text', 'your-domain-here' ),
		'desc'             => esc_html__( 'For full documentation on this field, visit: ', 'your-domain-here' ) . '<a href="//docs.reduxframework.com/core/fields/text/" target="_blank">docs.reduxframework.com/core/fields/text/</a>',
		'id'               => 'basic-text',
		'subsection'       => true,
		'customizer_width' => '700px',
		'fields'           => [
			[
				'id'       => 'text-example',
				'type'     => 'text',
				'title'    => esc_html__( 'Text Field', 'your-domain-here' ),
				'subtitle' => esc_html__( 'Subtitle', 'your-domain-here' ),
				'desc'     => esc_html__( 'Field Description', 'your-domain-here' ),
				'default'  => 'Default Text',
			],
			[
				'id'        => 'text-example-hint',
				'type'      => 'text',
				'title'     => esc_html__( 'Text Field w/ Hint', 'your-domain-here' ),
				'subtitle'  => esc_html__( 'Subtitle', 'your-domain-here' ),
				'desc'      => esc_html__( 'Field Description', 'your-domain-here' ),
				'default'   => 'Default Text',
				'text_hint' => [
					'title'   => 'Hint Title',
					'content' => 'Hint content about this field!',
				],
			],
			[
				'id'          => 'text-placeholder',
				'type'        => 'text',
				'title'       => esc_html__( 'Text Field', 'your-domain-here' ),
				'subtitle'    => esc_html__( 'Subtitle', 'your-domain-here' ),
				'desc'        => esc_html__( 'Field Description', 'your-domain-here' ),
				'placeholder' => 'Placeholder Text',
			],
		],
	]
);

Redux::set_section(
	$opt_name,
	[
		'title'      => esc_html__( 'Multi Text', 'your-domain-here' ),
		'id'         => 'basic-multi-text',
		'desc'       => esc_html__( 'For full documentation on this field, visit: ', 'your-domain-here' ) . '<a href="//docs.reduxframework.com/core/fields/multi-text/" target="_blank">docs.reduxframework.com/core/fields/multi-text/</a>',
		'subsection' => true,
		'fields'     => [
			[
				'id'       => 'opt-multitext',
				'type'     => 'multi_text',
				'title'    => esc_html__( 'Multi Text Option', 'your-domain-here' ),
				'subtitle' => esc_html__( 'Field subtitle', 'your-domain-here' ),
				'desc'     => esc_html__( 'Field Decription', 'your-domain-here' ),
			],
		],
	]
);

Redux::set_section(
	$opt_name,
	[
		'title'      => esc_html__( 'Password', 'your-domain-here' ),
		'id'         => 'basic-password',
		'desc'       => esc_html__( 'For full documentation on this field, visit: ', 'your-domain-here' ) . '<a href="//docs.reduxframework.com/core/fields/password/" target="_blank">docs.reduxframework.com/core/fields/password/</a>',
		'subsection' => true,
		'fields'     => [
			[
				'id'       => 'password',
				'type'     => 'password',
				'username' => true,
				'title'    => 'Password Field',
			],
		],
	]
);

Redux::set_section(
	$opt_name,
	[
		'title'      => esc_html__( 'Textarea', 'your-domain-here' ),
		'id'         => 'basic-textarea',
		'desc'       => esc_html__( 'For full documentation on this field, visit: ', 'your-domain-here' ) . '<a href="//docs.reduxframework.com/core/fields/textarea/" target="_blank">docs.reduxframework.com/core/fields/textarea/</a>',
		'subsection' => true,
		'fields'     => [
			[
				'id'       => 'opt-textarea',
				'type'     => 'textarea',
				'title'    => esc_html__( 'Textarea Option - HTML Validated Custom', 'your-domain-here' ),
				'subtitle' => esc_html__( 'Subtitle', 'your-domain-here' ),
				'desc'     => esc_html__( 'This is the description field, again good for additional info.', 'your-domain-here' ),
				'default'  => 'Default Text',
			],
		],
	]
);

// -> START Editors.
Redux::set_section(
	$opt_name,
	[
		'title'            => esc_html__( 'Editors', 'your-domain-here' ),
		'id'               => 'editor',
		'customizer_width' => '500px',
		'icon'             => 'el el-edit',
	]
);

Redux::set_section(
	$opt_name,
	[
		'title'      => esc_html__( 'WordPress Editor', 'your-domain-here' ),
		'id'         => 'editor-wordpress',
		'desc'       => esc_html__( 'For full documentation on this field, visit: ', 'your-domain-here' ) . '<a href="//docs.reduxframework.com/core/fields/editor/" target="_blank">docs.reduxframework.com/core/fields/editor/</a>',
		'subsection' => true,
		'fields'     => [
			[
				'id'       => 'opt-editor',
				'type'     => 'editor',
				'title'    => esc_html__( 'Editor', 'your-domain-here' ),
				'subtitle' => esc_html__( 'Use any of the features of WordPress editor inside your panel!', 'your-domain-here' ),
				'default'  => 'Powered by Redux Framework.',
			],
			[
				'id'      => 'opt-editor-tiny',
				'type'    => 'editor',
				'title'   => esc_html__( 'Editor w/o Media Button', 'your-domain-here' ),
				'default' => 'Powered by Redux Framework.',
				'args'    => [
					'wpautop'       => false,
					'media_buttons' => false,
					'textarea_rows' => 5,
					'teeny'         => false,
					'quicktags'     => false,
				],
			],
			[
				'id'         => 'opt-editor-full',
				'type'       => 'editor',
				'title'      => esc_html__( 'Editor - Full Width', 'your-domain-here' ),
				'full_width' => true,
			],
		],
	]
);

Redux::set_section(
	$opt_name,
	[
		'title'      => esc_html__( 'ACE Editor', 'your-domain-here' ),
		'id'         => 'editor-ace',
		'subsection' => true,
		'desc'       => esc_html__( 'For full documentation on the this field, visit: ', 'your-domain-here' ) . '<a href="//docs.reduxframework.com/core/fields/ace-editor/" target="_blank">docs.reduxframework.com/core/fields/ace-editor/</a>',
		'fields'     => [
			[
				'id'       => 'opt-ace-editor-css',
				'type'     => 'ace_editor',
				'title'    => esc_html__( 'CSS Code', 'your-domain-here' ),
				'subtitle' => esc_html__( 'Paste your CSS code here.', 'your-domain-here' ),
				'mode'     => 'css',
				'theme'    => 'monokai',
				'desc'     => 'Possible modes can be found at <a href="//ace.c9.io" target="_blank">ace.c9.io/</a>.',
				'default'  => '#header{
	margin: 0 auto;
}',
			],
			[
				'id'       => 'opt-ace-editor-js',
				'type'     => 'ace_editor',
				'title'    => esc_html__( 'JS Code', 'your-domain-here' ),
				'subtitle' => esc_html__( 'Paste your JS code here.', 'your-domain-here' ),
				'mode'     => 'javascript',
				'theme'    => 'chrome',
				'desc'     => 'Possible modes can be found at <a href="//ace.c9.io" target="_blank">ace.c9.io/</a>.',
				'default'  => 'jQuery(document).ready(function(){\n\n});',
			],
			[
				'id'         => 'opt-ace-editor-php',
				'type'       => 'ace_editor',
				'full_width' => true,
				'title'      => esc_html__( 'PHP Code', 'your-domain-here' ),
				'subtitle'   => esc_html__( 'Paste your PHP code here.', 'your-domain-here' ),
				'mode'       => 'php',
				'theme'      => 'chrome',
				'desc'       => 'Possible modes can be found at <a href="//ace.c9.io" target="_blank">ace.c9.io/</a>.',
				'default'    => '<?php
    echo "PHP String";',
			],
		],
	]
);

// -> START Color Selection.
Redux::set_section(
	$opt_name,
	[
		'title' => esc_html__( 'Color Selection', 'your-domain-here' ),
		'id'    => 'color',
		'icon'  => 'el el-brush',
	]
);

Redux::set_section(
	$opt_name,
	[
		'title'      => esc_html__( 'Color', 'your-domain-here' ),
		'id'         => 'opt-color',
		'desc'       => esc_html__( 'For full documentation on this field, visit: ', 'your-domain-here' ) . '<a href="//docs.reduxframework.com/core/fields/color/" target="_blank">docs.reduxframework.com/core/fields/color/</a>',
		'subsection' => true,
		'fields'     => [
			[
				'id'          => 'opt-color-title',
				'type'        => 'color',
				'output'      => [
					'background-color' => '.site-background',
					'color'            => '.site-title',
				],
				'title'       => esc_html__( 'Site Title Color', 'your-domain-here' ),
				'subtitle'    => esc_html__( 'Pick a title color for the theme (default: #000).', 'your-domain-here' ),
				'default'     => '#000000',
				'color_alpha' => true,
			],
			[
				'id'       => 'opt-color-footer',
				'type'     => 'color',
				'title'    => esc_html__( 'Footer Background Color', 'your-domain-here' ),
				'subtitle' => esc_html__( 'Pick a background color for the footer (default: #dd9933).', 'your-domain-here' ),
				'default'  => '#dd9933',
				'validate' => 'color',
			],
		],
	]
);

Redux::set_section(
	$opt_name,
	[
		'title'      => esc_html__( 'Color Gradient', 'your-domain-here' ),
		'desc'       => esc_html__( 'For full documentation on this field, visit: ', 'your-domain-here' ) . '<a href="//docs.reduxframework.com/core/fields/color-gradient/" target="_blank">docs.reduxframework.com/core/fields/color-gradient/</a>',
		'id'         => 'color-gradient',
		'subsection' => true,
		'fields'     => [
			[
				'id'       => 'opt-color-header',
				'type'     => 'color_gradient',
				'title'    => esc_html__( 'Header Gradient Color Option', 'your-domain-here' ),
				'subtitle' => esc_html__( 'Only color validation can be done on this field type', 'your-domain-here' ),
				'desc'     => esc_html__( 'This is the description field, again good for additional info.', 'your-domain-here' ),
				'output'   => '.site-header',
				'preview'  => true,
				'default'  => [
					'from' => '#1e73be',
					'to'   => '#00897e',
				],
			],
		],
	]
);

Redux::set_section(
	$opt_name,
	[
		'title'      => esc_html__( 'Color RGBA', 'your-domain-here' ),
		'desc'       => esc_html__( 'For full documentation on this field, visit: ', 'your-domain-here' ) . '<a href="//docs.reduxframework.com/core/fields/color-rgba/" target="_blank">docs.reduxframework.com/core/fields/color-rgba/</a>',
		'id'         => 'color-rgba',
		'subsection' => true,
		'fields'     => [
			[
				'id'       => 'opt-color-rgba',
				'type'     => 'color_rgba',
				'title'    => esc_html__( 'Color RGBA', 'your-domain-here' ),
				'subtitle' => esc_html__( 'Gives you the RGBA color.', 'your-domain-here' ),
				'default'  => [
					'color' => '#7e33dd',
					'alpha' => '.8',
				],
				'mode'     => 'background',
				'validate' => 'colorrgba',
			],
		],
	]
);

Redux::set_section(
	$opt_name,
	[
		'title'      => esc_html__( 'Link Color', 'your-domain-here' ),
		'desc'       => esc_html__( 'For full documentation on this field, visit: ', 'your-domain-here' ) . '<a href="//docs.reduxframework.com/core/fields/link-color/" target="_blank">docs.reduxframework.com/core/fields/link-color/</a>',
		'id'         => 'color-link',
		'subsection' => true,
		'fields'     => [
			[
				'id'       => 'opt-link-color',
				'type'     => 'link_color',
				'title'    => esc_html__( 'Links Color Option', 'your-domain-here' ),
				'subtitle' => esc_html__( 'Only color validation can be done on this field type', 'your-domain-here' ),
				'desc'     => esc_html__( 'This is the description field, again good for additional info.', 'your-domain-here' ),
				'default'  => [
					'regular' => '#aaa',
					'hover'   => '#bbb',
					'active'  => '#ccc',
				],
				'output'   => 'a',

				// phpcs:ignore Squiz.PHP.CommentedOutCode
				// 'regular'   => false, // Disable Regular Color.
				// 'hover'     => false, // Disable Hover Color.
				// 'active'    => false, // Disable Active Color.
				// 'visited'   => true,  // Enable Visited Color.
			],
		],
	]
);

Redux::set_section(
	$opt_name,
	[
		'title'      => esc_html__( 'Palette', 'your-domain-here' ),
		'desc'       => esc_html__( 'For full documentation on this field, visit: ', 'your-domain-here' ) . '<a href="//docs.reduxframework.com/core/fields/palette-color/" target="_blank">docs.reduxframework.com/core/fields/palette-color/</a>',
		'id'         => 'palette',
		'subsection' => true,
		'fields'     => [
			[
				'id'       => 'opt-palette-color',
				'type'     => 'palette',
				'title'    => esc_html__( 'Palette Color Option', 'your-domain-here' ),
				'subtitle' => esc_html__( 'Only color validation can be done on this field type', 'your-domain-here' ),
				'desc'     => esc_html__( 'This is the description field, again good for additional info.', 'your-domain-here' ),
				'default'  => 'red',
				'palettes' => [
					'red'  => [
						'#ef9a9a',
						'#f44336',
						'#ff1744',
					],
					'pink' => [
						'#fce4ec',
						'#f06292',
						'#e91e63',
						'#ad1457',
						'#f50057',
					],
					'cyan' => [
						'#e0f7fa',
						'#80deea',
						'#26c6da',
						'#0097a7',
						'#00e5ff',
					],
				],
			],
		],
	]
);

// -> START Design Fields.
Redux::set_section(
	$opt_name,
	[
		'title' => esc_html__( 'Design Fields', 'your-domain-here' ),
		'id'    => 'design',
		'icon'  => 'el el-wrench',
	]
);

Redux::set_section(
	$opt_name,
	[
		'title'      => esc_html__( 'Background', 'your-domain-here' ),
		'id'         => 'design-background',
		'desc'       => esc_html__( 'For full documentation on this field, visit: ', 'your-domain-here' ) . '<a href="//docs.reduxframework.com/core/fields/background/" target="_blank">docs.reduxframework.com/core/fields/background/</a>',
		'subsection' => true,
		'fields'     => [
			[
				'id'       => 'opt-background',
				'type'     => 'background',
				'output'   => [ 'body' ],
				'title'    => __( 'Body Background', 'your-domain-here' ),
				'subtitle' => __( 'Body background with image, color, etc.', 'your-domain-here' ),
			],
		],
	]
);

Redux::set_section(
	$opt_name,
	[
		'title'      => esc_html__( 'Border', 'your-domain-here' ),
		'id'         => 'design-border',
		'desc'       => esc_html__( 'For full documentation on this field, visit: ', 'your-domain-here' ) . '<a href="//docs.reduxframework.com/core/fields/border/" target="_blank">docs.reduxframework.com/core/fields/border/</a>',
		'subsection' => true,
		'fields'     => [
			[
				'id'       => 'opt-header-border',
				'type'     => 'border',
				'title'    => esc_html__( 'Header Border Option', 'your-domain-here' ),
				'subtitle' => esc_html__( 'Only color validation can be done on this field type', 'your-domain-here' ),
				'output'   => [ '.site-header' ],
				'desc'     => esc_html__( 'This is the description field, again good for additional info.', 'your-domain-here' ),
				'default'  => [
					'border-color'  => '#1e73be',
					'border-style'  => 'solid',
					'border-top'    => '3px',
					'border-right'  => '3px',
					'border-bottom' => '3px',
					'border-left'   => '3px',
				],
			],
			[
				'id'       => 'opt-header-border-expanded',
				'type'     => 'border',
				'title'    => esc_html__( 'Header Border Option', 'your-domain-here' ),
				'subtitle' => esc_html__( 'Only color validation can be done on this field type', 'your-domain-here' ),
				'output'   => [ '.site-header' ],
				'all'      => false,
				'desc'     => esc_html__( 'This is the description field, again good for additional info.', 'your-domain-here' ),
				'default'  => [
					'border-color'  => '#1e73be',
					'border-style'  => 'solid',
					'border-top'    => '3px',
					'border-right'  => '3px',
					'border-bottom' => '3px',
					'border-left'   => '3px',
				],
			],
		],
	]
);

Redux::set_section(
	$opt_name,
	[
		'title'      => esc_html__( 'Dimensions', 'your-domain-here' ),
		'id'         => 'design-dimensions',
		'desc'       => esc_html__( 'For full documentation on this field, visit: ', 'your-domain-here' ) . '<a href="//docs.reduxframework.com/core/fields/dimensions/" target="_blank">docs.reduxframework.com/core/fields/dimensions/</a>',
		'subsection' => true,
		'fields'     => [
			[
				'id'             => 'opt-dimensions',
				'type'           => 'dimensions',
				'units'          => [ 'em', 'px', '%' ], // You can specify a unit value. Possible: px, em, %.
				'units_extended' => 'true', // Allow users to select any type of unit.
				'title'          => esc_html__( 'Dimensions (Width/Height) Option', 'your-domain-here' ),
				'subtitle'       => esc_html__( 'Allow your users to choose width, height, and/or unit.', 'your-domain-here' ),
				'desc'           => esc_html__( 'You can enable or disable any piece of this field. Width, Height, or Units.', 'your-domain-here' ),
				'default'        => [
					'width'  => 200,
					'height' => 100,
				],
			],
			[
				'id'             => 'opt-dimensions-width',
				'type'           => 'dimensions',
				'units'          => [ 'em', 'px', '%' ], // You can specify a unit value. Possible: px, em, %.
				'units_extended' => 'true', // Allow users to select any type of unit.
				'title'          => esc_html__( 'Dimensions (Width) Option', 'your-domain-here' ),
				'subtitle'       => esc_html__( 'Allow your users to choose width, height, and/or unit.', 'your-domain-here' ),
				'desc'           => esc_html__( 'You can enable or disable any piece of this field. Width, Height, or Units.', 'your-domain-here' ),
				'height'         => false,
				'default'        => [
					'width'  => 200,
					'height' => 100,
				],
			],
		],
	]
);

Redux::set_section(
	$opt_name,
	[
		'title'      => esc_html__( 'Spacing', 'your-domain-here' ),
		'id'         => 'design-spacing',
		'desc'       => esc_html__( 'For full documentation on this field, visit: ', 'your-domain-here' ) . '<a href="//docs.reduxframework.com/core/fields/spacing/" target="_blank">docs.reduxframework.com/core/fields/spacing/</a>',
		'subsection' => true,
		'fields'     => [
			[
				'id'            => 'opt-spacing',
				'type'          => 'spacing',
				'output'        => [ '.site-header' ],

				// absolute, padding, margin, defaults to padding.
				'mode'          => 'margin',

				// Have one field that applies to all.
				'all'           => true,

				// You can specify a unit value. Possible: px, em, %.
				'units'         => 'em',

				// Set to false to hide the units if the units are specified.
				'display_units' => false,
				'title'         => esc_html__( 'Padding/Margin Option', 'your-domain-here' ),
				'subtitle'      => esc_html__( 'Allow your users to choose the spacing or margin they want.', 'your-domain-here' ),
				'desc'          => esc_html__( 'You can enable or disable any piece of this field. Top, Right, Bottom, Left, or Units.', 'your-domain-here' ),
				'default'       => [
					'margin-top'    => '1',
					'margin-right'  => '2',
					'margin-bottom' => '3',
					'margin-left'   => '4',
					'units'         => 'em',
				],

				// phpcs:ignore Squiz.PHP.CommentedOutCode
				// Allow users to select any type of unit.
				// 'units_extended'=> 'true',    // Enable extended units.
				// 'top'           => false,     // Disable the top.
				// 'right'         => false,     // Disable the right.
				// 'bottom'        => false,     // Disable the bottom.
				// 'left'          => false,     // Disable the left.
			],
			[
				'id'             => 'opt-spacing-expanded',
				'type'           => 'spacing',
				'mode'           => 'margin',
				'all'            => false,
				'units'          => [ 'em', 'px', '%' ],
				'units_extended' => true,
				'title'          => __( 'Padding/Margin Option', 'your-domain-here' ),
				'subtitle'       => __( 'Allow your users to choose the spacing or margin they want.', 'your-domain-here' ),
				'desc'           => __( 'You can enable or disable any piece of this field. Top, Right, Bottom, Left, or Units.', 'your-domain-here' ),
				'default'        => [
					'margin-top'    => '1',
					'margin-right'  => '2',
					'margin-bottom' => '3',
					'margin-left'   => '5',
					'units'         => 'em',
				],
			],
		],
	]
);

// -> START Media Uploads.
Redux::set_section(
	$opt_name,
	[
		'title' => esc_html__( 'Media Uploads', 'your-domain-here' ),
		'id'    => 'media',
		'icon'  => 'el el-picture',
	]
);

Redux::set_section(
	$opt_name,
	[
		'title'      => esc_html__( 'Gallery', 'your-domain-here' ),
		'id'         => 'media-gallery',
		'desc'       => esc_html__( 'For full documentation on this field, visit: ', 'your-domain-here' ) . '<a href="//docs.reduxframework.com/core/fields/gallery/" target="_blank">docs.reduxframework.com/core/fields/gallery/</a>',
		'subsection' => true,
		'fields'     => [
			[
				'id'       => 'opt-gallery',
				'type'     => 'gallery',
				'title'    => esc_html__( 'Add/Edit Gallery', 'your-domain-here' ),
				'subtitle' => esc_html__( 'Create a new Gallery by selecting existing or uploading new images using the WordPress native uploader', 'your-domain-here' ),
				'desc'     => esc_html__( 'This is the description field, again good for additional info.', 'your-domain-here' ),
			],
		],
	]
);

Redux::set_section(
	$opt_name,
	[
		'title'      => esc_html__( 'Media', 'your-domain-here' ),
		'id'         => 'media-media',
		'desc'       => esc_html__( 'For full documentation on this field, visit: ', 'your-domain-here' ) . '<a href="//docs.reduxframework.com/core/fields/media/" target="_blank">docs.reduxframework.com/core/fields/media/</a>',
		'subsection' => true,
		'fields'     => [
			[
				'id'           => 'opt-media',
				'type'         => 'media',
				'url'          => true,
				'title'        => esc_html__( 'Media w/ URL', 'your-domain-here' ),
				'compiler'     => 'true',
				'desc'         => esc_html__( 'Basic media uploader with disabled URL input field.', 'your-domain-here' ),
				'subtitle'     => esc_html__( 'Upload any media using the WordPress native uploader', 'your-domain-here' ),
				'preview_size' => 'full',
			],
			[
				'id'       => 'media-no-url',
				'type'     => 'media',
				'title'    => esc_html__( 'Media w/o URL', 'your-domain-here' ),
				'desc'     => esc_html__( 'This represents the minimalistic view. It does not have the preview box or the display URL in an input box. ', 'your-domain-here' ),
				'subtitle' => esc_html__( 'Upload any media using the WordPress native uploader', 'your-domain-here' ),
				'url'      => false,
				'preview'  => false,
			],
			[
				'id'       => 'media-no-preview',
				'type'     => 'media',
				'preview'  => false,
				'title'    => esc_html__( 'Media No Preview', 'your-domain-here' ),
				'desc'     => esc_html__( 'This represents the minimalistic view. It does not have the preview box or the display URL in an input box. ', 'your-domain-here' ),
				'subtitle' => esc_html__( 'Upload any media using the WordPress native uploader', 'your-domain-here' ),
				'hint'     => [
					'title'   => esc_html__( 'Test Hint', 'your-domain-here' ),
					'content' => wp_kses_post( 'This is a <b>hint</b> tool-tip for the webFonts field.<br/><br/>Add any HTML based text you like here.' ),
				],
			],
			[
				'id'         => 'opt-random-upload',
				'type'       => 'media',
				'title'      => esc_html__( 'Upload Anything - Disabled Mode', 'your-domain-here' ),
				'full_width' => true,

				// Can be set to false to allow any media type, or can also be set to any mime type.
				'mode'       => false,

				'desc'       => esc_html__( 'Basic media uploader with disabled URL input field.', 'your-domain-here' ),
				'subtitle'   => esc_html__( 'Upload any media using the WordPress native uploader', 'your-domain-here' ),
			],
		],
	]
);

Redux::set_section(
	$opt_name,
	[
		'title'      => esc_html__( 'Slides', 'your-domain-here' ),
		'id'         => 'additional-slides',
		'desc'       => esc_html__( 'For full documentation on this field, visit: ', 'your-domain-here' ) . '<a href="//docs.reduxframework.com/core/fields/slides/" target="_blank">docs.reduxframework.com/core/fields/slides/</a>',
		'subsection' => true,
		'fields'     => [
			[
				'id'          => 'opt-slides',
				'type'        => 'slides',
				'title'       => esc_html__( 'Slides Options', 'your-domain-here' ),
				'subtitle'    => esc_html__( 'Unlimited slides with drag and drop sortings.', 'your-domain-here' ),
				'desc'        => esc_html__( 'This field will store all slides values into a multidimensional array to use into a foreach loop.', 'your-domain-here' ),
				'placeholder' => [
					'title'       => esc_html__( 'This is a title', 'your-domain-here' ),
					'description' => esc_html__( 'Description Here', 'your-domain-here' ),
					'url'         => esc_html__( 'Give us a link!', 'your-domain-here' ),
				],
			],
		],
	]
);

// -> START Presentation Fields.
Redux::set_section(
	$opt_name,
	[
		'title' => esc_html__( 'Presentation Fields', 'your-domain-here' ),
		'id'    => 'presentation',
		'icon'  => 'el el-screen',
	]
);

Redux::set_section(
	$opt_name,
	[
		'title'      => esc_html__( 'Divide', 'your-domain-here' ),
		'id'         => 'presentation-divide',
		'desc'       => esc_html__( 'The spacer to the section menu as seen to the left (after this section block) is the divide "section". Also the divider below is the divide "field".', 'your-domain-here' ) . '<br />' . __( 'For full documentation on this field, visit: ', 'your-domain-here' ) . '<a href="//docs.reduxframework.com/core/fields/divide/" target="_blank">docs.reduxframework.com/core/fields/divide/</a>',
		'subsection' => true,
		'fields'     => [
			[
				'id'   => 'opt-divide',
				'type' => 'divide',
			],
		],
	]
);

Redux::set_section(
	$opt_name,
	[
		'title'      => esc_html__( 'Info', 'your-domain-here' ),
		'id'         => 'presentation-info',
		'desc'       => esc_html__( 'For full documentation on this field, visit: ', 'your-domain-here' ) . '<a href="//docs.reduxframework.com/core/fields/info/" target="_blank">docs.reduxframework.com/core/fields/info/</a>',
		'subsection' => true,
		'fields'     => [
			[
				'id'   => 'opt-info-field',
				'type' => 'info',
				'desc' => esc_html__( 'This is the info field, if you want to break sections up.', 'your-domain-here' ),
			],
			[
				'id'    => 'opt-notice-info1',
				'type'  => 'info',
				'style' => 'info',
				'title' => esc_html__( 'This is a title.', 'your-domain-here' ),
				'desc'  => wp_kses_post( __( 'This is an info field with the <strong>info</strong> style applied. By default the <strong>normal</strong> style is applied.', 'your-domain-here' ) ),
			],
			[
				'id'    => 'opt-info-warning',
				'type'  => 'info',
				'style' => 'warning',
				'title' => esc_html__( 'This is a title.', 'your-domain-here' ),
				'desc'  => wp_kses_post( __( 'This is an info field with the <strong>warning</strong> style applied.', 'your-domain-here' ) ),
			],
			[
				'id'    => 'opt-info-success',
				'type'  => 'info',
				'style' => 'success',
				'icon'  => 'el el-info-circle',
				'title' => esc_html__( 'This is a title.', 'your-domain-here' ),
				'desc'  => wp_kses_post( __( 'This is an info field with the <strong>success</strong> style applied and an icon.', 'your-domain-here' ) ),
			],
			[
				'id'    => 'opt-info-critical',
				'type'  => 'info',
				'style' => 'critical',
				'icon'  => 'el el-info-circle',
				'title' => esc_html__( 'This is a title.', 'your-domain-here' ),
				'desc'  => wp_kses_post( __( 'This is an info field with the <strong>critical</strong> style applied and an icon.', 'your-domain-here' ) ),
			],
			[
				'id'    => 'opt-info-custom',
				'type'  => 'info',
				'style' => 'custom',
				'color' => 'purple',
				'icon'  => 'el el-info-circle',
				'title' => esc_html__( 'This is a title.', 'your-domain-here' ),
				'desc'  => wp_kses_post( __( 'This is an info field with the <strong>custom</strong> style applied, color arg passed, and an icon.', 'your-domain-here' ) ),
			],
			[
				'id'     => 'opt-info-normal',
				'type'   => 'info',
				'notice' => false,
				'title'  => esc_html__( 'This is a title.', 'your-domain-here' ),
				'desc'   => wp_kses_post( __( 'This is an info non-notice field with the <strong>normal</strong> style applied.', 'your-domain-here' ) ),
			],
			[
				'id'     => 'opt-notice-info',
				'type'   => 'info',
				'notice' => false,
				'style'  => 'info',
				'title'  => esc_html__( 'This is a title.', 'your-domain-here' ),
				'desc'   => wp_kses_post( __( 'This is an info non-notice field with the <strong>info</strong> style applied.', 'your-domain-here' ) ),
			],
			[
				'id'     => 'opt-notice-warning',
				'type'   => 'info',
				'notice' => false,
				'style'  => 'warning',
				'icon'   => 'el el-info-circle',
				'title'  => esc_html__( 'This is a title.', 'your-domain-here' ),
				'desc'   => wp_kses_post( __( 'This is an info non-notice field with the <strong>warning</strong> style applied and an icon.', 'your-domain-here' ) ),
			],
			[
				'id'     => 'opt-notice-success',
				'type'   => 'info',
				'notice' => false,
				'style'  => 'success',
				'icon'   => 'el el-info-circle',
				'title'  => esc_html__( 'This is a title.', 'your-domain-here' ),
				'desc'   => wp_kses_post( __( 'This is an info non-notice field with the <strong>success</strong> style applied and an icon.', 'your-domain-here' ) ),
			],
			[
				'id'     => 'opt-notice-critical',
				'type'   => 'info',
				'notice' => false,
				'style'  => 'critical',
				'icon'   => 'el el-info-circle',
				'title'  => esc_html__( 'This is a title.', 'your-domain-here' ),
				'desc'   => wp_kses_post( __( 'This is an non-notice field with the <strong>critical</strong> style applied and an icon.', 'your-domain-here' ) ),
			],
		],
	]
);

Redux::set_section(
	$opt_name,
	[
		'title'      => esc_html__( 'Section', 'your-domain-here' ),
		'id'         => 'presentation-section',
		'desc'       => esc_html__( 'For full documentation on this field, visit: ', 'your-domain-here' ) . '<a href="//docs.reduxframework.com/core/fields/section/" target="_blank">docs.reduxframework.com/core/fields/section/</a>',
		'subsection' => true,
		'fields'     => [
			[
				'id'       => 'section-start',
				'type'     => 'section',
				'title'    => esc_html__( 'Section Example', 'your-domain-here' ),
				'subtitle' => esc_html__( 'With the "section" field you can create indented option sections.', 'your-domain-here' ),
				'indent'   => true, // Indent all options below until the next 'section' option is set.
			],
			[
				'id'       => 'section-test',
				'type'     => 'text',
				'title'    => esc_html__( 'Field Title', 'your-domain-here' ),
				'subtitle' => esc_html__( 'Field Subtitle', 'your-domain-here' ),
			],
			[
				'id'       => 'section-test-media',
				'type'     => 'media',
				'title'    => esc_html__( 'Field Title', 'your-domain-here' ),
				'subtitle' => esc_html__( 'Field Subtitle', 'your-domain-here' ),
			],
			[
				'id'     => 'section-end',
				'type'   => 'section',
				'indent' => false, // Indent all options below until the next 'section' option is set.
			],
			[
				'id'   => 'section-info',
				'type' => 'info',
				'desc' => esc_html__( 'And now you can add more fields below and outside of the indent.', 'your-domain-here' ),
			],
		],
	]
);

Redux::set_section(
	$opt_name,
	[
		'id'   => 'presentation-divide-sample',
		'type' => 'divide',
	]
);

// -> START Switch & Button Set.
Redux::set_section(
	$opt_name,
	[
		'title' => esc_html__( 'Switch & Button Set', 'your-domain-here' ),
		'id'    => 'switch_buttonset',
		'icon'  => 'el el-cogs',
	]
);

Redux::set_section(
	$opt_name,
	[
		'title'      => esc_html__( 'Button Set', 'your-domain-here' ),
		'id'         => 'switch_buttonset-set',
		'desc'       => esc_html__( 'For full documentation on this field, visit: ', 'your-domain-here' ) . '<a href="//docs.reduxframework.com/core/fields/button-set/" target="_blank">docs.reduxframework.com/core/fields/button-set/</a>',
		'subsection' => true,
		'fields'     => [
			[
				'id'       => 'opt-button-set',
				'type'     => 'button_set',
				'title'    => esc_html__( 'Button Set Option', 'your-domain-here' ),
				'subtitle' => esc_html__( 'No validation can be done on this field type', 'your-domain-here' ),
				'desc'     => esc_html__( 'This is the description field, again good for additional info.', 'your-domain-here' ),

				// Must provide key => value pairs for radio options.
				'options'  => [
					'1' => 'Opt 1',
					'2' => 'Opt 2',
					'3' => 'Opt 3',
				],
				'default'  => '2',
			],
			[
				'id'       => 'opt-button-set-multi',
				'type'     => 'button_set',
				'title'    => esc_html__( 'Button Set, Multi Select', 'your-domain-here' ),
				'subtitle' => esc_html__( 'No validation can be done on this field type', 'your-domain-here' ),
				'desc'     => esc_html__( 'This is the description field, again good for additional info.', 'your-domain-here' ),
				'multi'    => true,

				// Must provide key => value pairs for radio options.
				'options'  => [
					'1' => 'Opt 1',
					'2' => 'Opt 2',
					'3' => 'Opt 3',
				],
				'default'  => [ '2', '3' ],
			],
		],
	]
);

Redux::set_section(
	$opt_name,
	[
		'title'      => esc_html__( 'Switch', 'your-domain-here' ),
		'id'         => 'switch_buttonset-switch',
		'desc'       => esc_html__( 'For full documentation on this field, visit: ', 'your-domain-here' ) . '<a href="//docs.reduxframework.com/core/fields/switch/" target="_blank">docs.reduxframework.com/core/fields/switch/</a>',
		'subsection' => true,
		'fields'     => [
			[
				'id'       => 'switch-on',
				'type'     => 'switch',
				'title'    => esc_html__( 'Switch On', 'your-domain-here' ),
				'subtitle' => esc_html__( 'Look, it\'s on!', 'your-domain-here' ),
				'default'  => true,
			],
			[
				'id'       => 'switch-off',
				'type'     => 'switch',
				'title'    => esc_html__( 'Switch Off', 'your-domain-here' ),
				'subtitle' => esc_html__( 'Look, it\'s on!', 'your-domain-here' ),
				'default'  => false,
			],
			[
				'id'       => 'switch-parent',
				'type'     => 'switch',
				'title'    => esc_html__( 'Switch - Nested Children, Enable to show', 'your-domain-here' ),
				'subtitle' => esc_html__( 'Look, it\'s on! Also hidden child elements!', 'your-domain-here' ),
				'default'  => false,
				'on'       => 'Enabled',
				'off'      => 'Disabled',
			],
			[
				'id'       => 'switch-child1',
				'type'     => 'switch',
				'required' => [ 'switch-parent', '=', true ],
				'title'    => esc_html__( 'Switch - This and the next switch required for patterns to show', 'your-domain-here' ),
				'subtitle' => esc_html__( 'Also called a "fold" parent.', 'your-domain-here' ),
				'desc'     => esc_html__( 'Items set with a fold to this ID will hide unless this is set to the appropriate value.', 'your-domain-here' ),
				'default'  => false,
			],
			[
				'id'       => 'switch-child2',
				'type'     => 'switch',
				'required' => [ 'switch-parent', '=', true ],
				'title'    => esc_html__( 'Switch2 - Enable the above switch and this one for patterns to show', 'your-domain-here' ),
				'subtitle' => esc_html__( 'Also called a "fold" parent.', 'your-domain-here' ),
				'desc'     => esc_html__( 'Items set with a fold to this ID will hide unless this is set to the appropriate value.', 'your-domain-here' ),
				'default'  => false,
			],
		],
	]
);

// -> START Select Fields.
Redux::set_section(
	$opt_name,
	[
		'title' => esc_html__( 'Select Fields', 'your-domain-here' ),
		'id'    => 'select',
		'icon'  => 'el el-list-alt',
	]
);

Redux::set_section(
	$opt_name,
	[
		'title'      => esc_html__( 'Select', 'your-domain-here' ),
		'id'         => 'select-select',
		'desc'       => esc_html__( 'For full documentation on this field, visit: ', 'your-domain-here' ) . '<a href="//docs.reduxframework.com/core/fields/select/" target="_blank">docs.reduxframework.com/core/fields/select/</a>',
		'subsection' => true,
		'fields'     => [
			[
				'id'       => 'opt-select',
				'type'     => 'select',
				'title'    => esc_html__( 'Select Option', 'your-domain-here' ),
				'subtitle' => esc_html__( 'No validation can be done on this field type', 'your-domain-here' ),
				'desc'     => esc_html__( 'This is the description field, again good for additional info.', 'your-domain-here' ),

				// Must provide key => value pairs for select options.
				'options'  => [
					'1' => 'Opt 1',
					'2' => 'Opt 2',
					'3' => 'Opt 3',
				],
				'default'  => '2',
			],
			[
				'id'       => 'opt-select-stylesheet',
				'type'     => 'select',
				'title'    => esc_html__( 'Theme Stylesheet', 'your-domain-here' ),
				'subtitle' => esc_html__( 'Select your themes alternative color scheme.', 'your-domain-here' ),
				'options'  => [
					'default.css' => 'default.css',
					'color1.css'  => 'color1.css',
				],
				'default'  => 'default.css',
			],
			[
				'id'       => 'opt-select-optgroup',
				'type'     => 'select',
				'title'    => esc_html__( 'Select Option with optgroup', 'your-domain-here' ),
				'subtitle' => esc_html__( 'No validation can be done on this field type', 'your-domain-here' ),
				'desc'     => esc_html__( 'This is the description field, again good for additional info.', 'your-domain-here' ),

				// Must provide key => value pairs for select options.
				'options'  => [
					'Group 1' => [
						'1' => 'Opt 1',
						'2' => 'Opt 2',
						'3' => 'Opt 3',
					],
					'Group 2' => [
						'4' => 'Opt 4',
						'5' => 'Opt 5',
						'6' => 'Opt 6',
					],
					'7'       => 'Opt 7',
					'8'       => 'Opt 8',
					'9'       => 'Opt 9',
				],
				'default'  => '2',
			],
			[
				'id'       => 'opt-multi-select',
				'type'     => 'select',
				'multi'    => true,
				'title'    => esc_html__( 'Multi Select Option', 'your-domain-here' ),
				'subtitle' => esc_html__( 'No validation can be done on this field type', 'your-domain-here' ),
				'desc'     => esc_html__( 'This is the description field, again good for additional info.', 'your-domain-here' ),

				// Must provide key => value pairs for radio options.
				'options'  => [
					'1' => 'Opt 1',
					'2' => 'Opt 2',
					'3' => 'Opt 3',
				],
				'default'  => [ '2', '3' ],
			],
			[
				'id'   => 'opt-info',
				'type' => 'info',
				'desc' => esc_html__( 'You can easily add a variety of data from WordPress.', 'your-domain-here' ),
			],
			[
				'id'       => 'opt-select-categories',
				'type'     => 'select',
				'data'     => 'roles',
				'title'    => esc_html__( 'Categories Select Option', 'your-domain-here' ),
				'subtitle' => esc_html__( 'No validation can be done on this field type', 'your-domain-here' ),
				'desc'     => esc_html__( 'This is the description field, again good for additional info.', 'your-domain-here' ),
			],
			[
				'id'       => 'opt-select-categories-multi',
				'type'     => 'select',
				'data'     => 'categories',
				'multi'    => true,
				'title'    => esc_html__( 'Categories Multi Select Option', 'your-domain-here' ),
				'subtitle' => esc_html__( 'No validation can be done on this field type', 'your-domain-here' ),
				'desc'     => esc_html__( 'This is the description field, again good for additional info.', 'your-domain-here' ),
			],
			[
				'id'       => 'opt-select-pages',
				'type'     => 'select',
				'data'     => 'pages',
				'title'    => esc_html__( 'Pages Select Option', 'your-domain-here' ),
				'subtitle' => esc_html__( 'No validation can be done on this field type', 'your-domain-here' ),
				'desc'     => esc_html__( 'This is the description field, again good for additional info.', 'your-domain-here' ),
			],
			[
				'id'       => 'opt-multi-select-pages',
				'type'     => 'select',
				'data'     => 'pages',
				'multi'    => true,
				'title'    => esc_html__( 'Pages Multi Select Option', 'your-domain-here' ),
				'subtitle' => esc_html__( 'No validation can be done on this field type', 'your-domain-here' ),
				'desc'     => esc_html__( 'This is the description field, again good for additional info.', 'your-domain-here' ),
			],
			[
				'id'       => 'opt-select-tags',
				'type'     => 'select',
				'data'     => 'tags',
				'title'    => esc_html__( 'Tags Select Option', 'your-domain-here' ),
				'subtitle' => esc_html__( 'No validation can be done on this field type', 'your-domain-here' ),
				'desc'     => esc_html__( 'This is the description field, again good for additional info.', 'your-domain-here' ),
			],
			[
				'id'       => 'opt-multi-select-tags',
				'type'     => 'select',
				'data'     => 'tags',
				'multi'    => true,
				'title'    => esc_html__( 'Tags Multi Select Option', 'your-domain-here' ),
				'subtitle' => esc_html__( 'No validation can be done on this field type', 'your-domain-here' ),
				'desc'     => esc_html__( 'This is the description field, again good for additional info.', 'your-domain-here' ),
			],
			[
				'id'       => 'opt-select-menus',
				'type'     => 'select',
				'data'     => 'menus',
				'title'    => esc_html__( 'Menus Select Option', 'your-domain-here' ),
				'subtitle' => esc_html__( 'No validation can be done on this field type', 'your-domain-here' ),
				'desc'     => esc_html__( 'This is the description field, again good for additional info.', 'your-domain-here' ),
			],
			[
				'id'       => 'opt-multi-select-menus',
				'type'     => 'select',
				'data'     => 'menu',
				'multi'    => true,
				'title'    => esc_html__( 'Menus Multi Select Option', 'your-domain-here' ),
				'subtitle' => esc_html__( 'No validation can be done on this field type', 'your-domain-here' ),
				'desc'     => esc_html__( 'This is the description field, again good for additional info.', 'your-domain-here' ),
			],
			[
				'id'       => 'opt-select-post-type',
				'type'     => 'select',
				'data'     => 'post_type',
				'title'    => esc_html__( 'Post Type Select Option', 'your-domain-here' ),
				'subtitle' => esc_html__( 'No validation can be done on this field type', 'your-domain-here' ),
				'desc'     => esc_html__( 'This is the description field, again good for additional info.', 'your-domain-here' ),
			],
			[
				'id'       => 'opt-multi-select-post-type',
				'type'     => 'select',
				'data'     => 'post_type',
				'multi'    => true,
				'title'    => esc_html__( 'Post Type Multi Select Option', 'your-domain-here' ),
				'subtitle' => esc_html__( 'No validation can be done on this field type', 'your-domain-here' ),
				'desc'     => esc_html__( 'This is the description field, again good for additional info.', 'your-domain-here' ),
			],
			[
				'id'       => 'opt-multi-select-sortable',
				'type'     => 'select',
				'data'     => 'post_type',
				'multi'    => true,
				'sortable' => true,
				'title'    => esc_html__( 'Post Type Multi Select Option + Sortable', 'your-domain-here' ),
				'subtitle' => esc_html__( 'This field also has sortable enabled!', 'your-domain-here' ),
				'desc'     => esc_html__( 'This is the description field, again good for additional info.', 'your-domain-here' ),
			],
			[
				'id'       => 'opt-select-posts',
				'type'     => 'select',
				'data'     => 'post',
				'title'    => esc_html__( 'Posts Select Option2', 'your-domain-here' ),
				'subtitle' => esc_html__( 'No validation can be done on this field type', 'your-domain-here' ),
				'desc'     => esc_html__( 'This is the description field, again good for additional info.', 'your-domain-here' ),
			],
			[
				'id'       => 'opt-multi-select-posts',
				'type'     => 'select',
				'data'     => 'post',
				'multi'    => true,
				'title'    => esc_html__( 'Posts Multi Select Option', 'your-domain-here' ),
				'subtitle' => esc_html__( 'No validation can be done on this field type', 'your-domain-here' ),
				'desc'     => esc_html__( 'This is the description field, again good for additional info.', 'your-domain-here' ),
			],
			[
				'id'       => 'opt-select-roles',
				'type'     => 'select',
				'data'     => 'roles',
				'title'    => esc_html__( 'User Role Select Option', 'your-domain-here' ),
				'subtitle' => esc_html__( 'No validation can be done on this field type', 'your-domain-here' ),
				'desc'     => esc_html__( 'This is the description field, again good for additional info.', 'your-domain-here' ),
			],
			[
				'id'               => 'opt-select-capabilities',
				'type'             => 'select',
				'data'             => 'capabilities',
				'multi'            => false,
				'ajax'             => true,
				'min_input_length' => 3,
				'title'            => esc_html__( 'Capabilities Select Option w/ AJAX Loading', 'your-domain-here' ),
				'subtitle'         => esc_html__( 'No validation can be done on this field type', 'your-domain-here' ),
				'desc'             => esc_html__( 'This is the description field, again good for additional info.', 'your-domain-here' ),
			],
			[
				'id'       => 'opt-select-elusive',
				'type'     => 'select',
				'data'     => 'elusive-icons',
				'title'    => esc_html__( 'Elusive Icons Select Option', 'your-domain-here' ),
				'subtitle' => esc_html__( 'No validation can be done on this field type', 'your-domain-here' ),
				'desc'     => esc_html__( 'Here\'s a list of all the elusive icons by name and icon.', 'your-domain-here' ),
			],
			[
				'id'               => 'opt-select-users',
				'type'             => 'select',
				'data'             => 'users',
				'ajax'             => true,
				'min_input_length' => 3,
				'title'            => esc_html__( 'Users Select Option', 'your-domain-here' ),
				'subtitle'         => esc_html__( 'No validation can be done on this field type', 'your-domain-here' ),
				'desc'             => esc_html__( 'This is the description field, again good for additional info.', 'your-domain-here' ),
			],
		],
	]
);

Redux::set_section(
	$opt_name,
	[
		'title'      => esc_html__( 'Image Select', 'your-domain-here' ),
		'id'         => 'select-image_select',
		'desc'       => esc_html__( 'For full documentation on this field, visit: ', 'your-domain-here' ) . '<a href="//docs.reduxframework.com/core/fields/image-select/" target="_blank">docs.reduxframework.com/core/fields/image-select/</a>',
		'subsection' => true,
		'fields'     => [
			[
				'id'       => 'opt-image-select-layout',
				'type'     => 'image_select',
				'title'    => esc_html__( 'Images Option for Layout', 'your-domain-here' ),
				'subtitle' => esc_html__( 'No validation can be done on this field type', 'your-domain-here' ),
				'desc'     => esc_html__( 'This uses some of the built in images, you can use them for layout options.', 'your-domain-here' ),

				// Must provide key => value(array:title|img) pairs for radio options.
				'options'  => [
					'1' => [
						'alt' => '1 Column',
						'img' => Redux_Core::$url . 'assets/img/1col.png',
					],
					'2' => [
						'alt' => '2 Column Left',
						'img' => Redux_Core::$url . 'assets/img/2cl.png',
					],
					'3' => [
						'alt' => '2 Column Right',
						'img' => Redux_Core::$url . 'assets/img/2cr.png',
					],
					'4' => [
						'alt' => '3 Column Middle',
						'img' => Redux_Core::$url . 'assets/img/3cm.png',
					],
					'5' => [
						'alt' => '3 Column Left',
						'img' => Redux_Core::$url . 'assets/img/3cl.png',
					],
					'6' => [
						'alt' => '3 Column Right',
						'img' => Redux_Core::$url . 'assets/img/3cr.png',
					],
				],
				'default'  => '2',
			],
			[
				'id'       => 'opt-patterns',
				'type'     => 'image_select',
				'tiles'    => true,
				'title'    => esc_html__( 'Images Option (with tiles => true)', 'your-domain-here' ),
				'subtitle' => esc_html__( 'Select a background pattern.', 'your-domain-here' ),
				'default'  => 0,
				'options'  => $sample_patterns,
			],
			[
				'id'       => 'opt-image-select',
				'type'     => 'image_select',
				'title'    => esc_html__( 'Images Option', 'your-domain-here' ),
				'subtitle' => esc_html__( 'No validation can be done on this field type', 'your-domain-here' ),
				'desc'     => esc_html__( 'This is the description field, again good for additional info.', 'your-domain-here' ),

				// Must provide key => value(array:title|img) pairs for radio options.
				'options'  => [
					'1' => [
						'title' => 'Opt 1',
						'img'   => admin_url() . 'images/align-none.png',
					],
					'2' => [
						'title' => 'Opt 2',
						'img'   => admin_url() . 'images/align-left.png',
					],
					'3' => [
						'title' => 'Opt 3',
						'img'   => admin_url() . 'images/align-center.png',
					],
					'4' => [
						'title' => 'Opt 4',
						'img'   => admin_url() . 'images/align-right.png',
					],
				],
				'default'  => '2',
			],
			[
				'id'         => 'opt-presets',
				'type'       => 'image_select',
				'presets'    => true,
				'full_width' => true,
				'title'      => esc_html__( 'Preset', 'your-domain-here' ),
				'subtitle'   => esc_html__( 'This allows you to set a json string or array to override multiple preferences in your theme.', 'your-domain-here' ),
				'default'    => 0,
				'desc'       => esc_html__( 'This allows you to set a json string or array to override multiple preferences in your theme.', 'your-domain-here' ),
				'options'    => [
					'1' => [
						'alt'     => 'Preset 1',
						'img'     => Redux_Core::$url . '../sample/presets/preset1.png',
						'presets' => [
							'switch-on'     => 1,
							'switch-off'    => 1,
							'switch-parent' => 1,
						],
					],
					'2' => [
						'alt'     => 'Preset 2',
						'img'     => Redux_Core::$url . '../sample/presets/preset2.png',
						'presets' => '{"opt-slider-label":"1", "opt-slider-text":"10"}',
					],
				],
			],
		],
	]
);

Redux::set_section(
	$opt_name,
	[
		'title'      => esc_html__( 'Select Image', 'your-domain-here' ),
		'id'         => 'select-select_image',
		'desc'       => esc_html__( 'For full documentation on this field, visit: ', 'your-domain-here' ) . '<a href="//docs.reduxframework.com/core/fields/select-image/" target="_blank">docs.reduxframework.com/core/fields/select-image/</a>',
		'subsection' => true,
		'fields'     => [
			[
				'id'      => 'opt-select_image',
				'type'    => 'select_image',
				'presets' => true,
				'title'   => esc_html__( 'Select Image', 'your-domain-here' ),
				'options' => [
					[
						'alt' => 'Preset 1',
						'img' => Redux_Core::$url . '../sample/presets/preset1.png',
					],
					[
						'alt' => 'Preset 2',
						'img' => Redux_Core::$url . '../sample/presets/preset2.png',
					],
				],
				'default' => Redux_Core::$url . '../sample/presets/preset2.png',
			],
			[
				'id'       => 'opt-select-image',
				'type'     => 'select_image',
				'title'    => esc_html__( 'Select Image', 'your-domain-here' ),
				'subtitle' => esc_html__( 'A preview of the selected image will appear underneath the select box.', 'your-domain-here' ),
				'options'  => $sample_patterns,
				'default'  => Redux_Core::$url . '../sample/patterns/triangular.png',
			],
		],
	]
);

// -> START Slider / Spinner.
Redux::set_section(
	$opt_name,
	[
		'title' => esc_html__( 'Slider / Spinner', 'your-domain-here' ),
		'id'    => 'slider_spinner',
		'icon'  => 'el el-adjust-alt',
	]
);

Redux::set_section(
	$opt_name,
	[
		'title'      => esc_html__( 'Slider', 'your-domain-here' ),
		'id'         => 'slider_spinner-slider',
		'desc'       => esc_html__( 'For full documentation on this field, visit: ', 'your-domain-here' ) . '<a href="//docs.reduxframework.com/core/fields/slider/" target="_blank">docs.reduxframework.com/core/fields/slider/</a>',
		'fields'     => [
			[
				'id'            => 'opt-slider-label',
				'type'          => 'slider',
				'title'         => esc_html__( 'Slider Example 1', 'your-domain-here' ),
				'subtitle'      => esc_html__( 'This slider displays the value as a label.', 'your-domain-here' ),
				'desc'          => esc_html__( 'Slider description. Min: 1, max: 500, step: 1, default value: 250', 'your-domain-here' ),
				'default'       => 250,
				'min'           => 1,
				'step'          => 1,
				'max'           => 500,
				'display_value' => 'label',
			],
			[
				'id'            => 'opt-slider-text',
				'type'          => 'slider',
				'title'         => esc_html__( 'Slider Example 2 with Steps (5)', 'your-domain-here' ),
				'subtitle'      => esc_html__( 'This example displays the value in a text box', 'your-domain-here' ),
				'desc'          => esc_html__( 'Slider description. Min: 0, max: 300, step: 5, default value: 75', 'your-domain-here' ),
				'default'       => 75,
				'min'           => 0,
				'step'          => 5,
				'max'           => 300,
				'display_value' => 'text',
			],
			[
				'id'            => 'opt-slider-select',
				'type'          => 'slider',
				'title'         => esc_html__( 'Slider Example 3 with two sliders', 'your-domain-here' ),
				'subtitle'      => esc_html__( 'This example displays the values in select boxes', 'your-domain-here' ),
				'desc'          => esc_html__( 'Slider description. Min: 0, max: 500, step: 5, slider 1 default value: 100, slider 2 default value: 300', 'your-domain-here' ),
				'default'       => [
					1 => 100,
					2 => 300,
				],
				'min'           => 0,
				'step'          => 5,
				'max'           => '500',
				'display_value' => 'select',
				'handles'       => 2,
			],
			[
				'id'            => 'opt-slider-float',
				'type'          => 'slider',
				'title'         => esc_html__( 'Slider Example 4 with float values', 'your-domain-here' ),
				'subtitle'      => esc_html__( 'This example displays float values', 'your-domain-here' ),
				'desc'          => esc_html__( 'Slider description. Min: 0, max: 1, step: .1, default value: .5', 'your-domain-here' ),
				'default'       => .5,
				'min'           => 0,
				'step'          => .1,
				'max'           => 1,
				'resolution'    => 0.1,
				'display_value' => 'text',
			],
		],
		'subsection' => true,
	]
);

Redux::set_section(
	$opt_name,
	[
		'title'      => esc_html__( 'Spinner', 'your-domain-here' ),
		'id'         => 'slider_spinner-spinner',
		'desc'       => esc_html__( 'For full documentation on this field, visit: ', 'your-domain-here' ) . '<a href="//docs.reduxframework.com/core/fields/spinner/" target="_blank">docs.reduxframework.com/core/fields/spinner/</a>',
		'subsection' => true,
		'fields'     => [
			[
				'id'          => 'opt-spinner',
				'type'        => 'spinner',
				'title'       => esc_html__( 'JQuery UI Spinner Example 1', 'your-domain-here' ),
				'desc'        => esc_html__( 'JQuery UI spinner description. Min:20, max: 100, step:20, default value: 40', 'your-domain-here' ),
				'default'     => '40',
				'min'         => '20',
				'step'        => '20',
				'max'         => '100',
				'suffix'      => '',
				'output_unit' => '',
				'output'      => [ '.heck-with-it' => 'max-width' ],
			],
		],
	]
);

// -> START Typography.
Redux::set_section(
	$opt_name,
	[
		'title'  => esc_html__( 'Typography', 'your-domain-here' ),
		'id'     => 'typography',
		'desc'   => esc_html__( 'For full documentation on this field, visit: ', 'your-domain-here' ) . '<a href="//docs.reduxframework.com/core/fields/typography/" target="_blank">docs.reduxframework.com/core/fields/typography/</a>',
		'icon'   => 'el el-font',
		'fields' => [
			[
				'id'                => 'opt-typography-body',
				'type'              => 'typography',
				'title'             => esc_html__( 'Body Font', 'your-domain-here' ),
				'subtitle'          => esc_html__( 'Specify the body font properties.', 'your-domain-here' ),
				'google'            => true,
				'font_family_clear' => false,
				'default'           => [
					'color'       => '#dd9933',
					'font-size'   => '30px',
					'font-family' => 'Arial, Helvetica, sans-serif',
					'font-weight' => 'Normal',
				],
				'output'            => [ '.site-description, .entry-title' ],
			],
			[
				'id'          => 'opt-typography',
				'type'        => 'typography',
				'title'       => esc_html__( 'Typography h2.site-description', 'your-domain-here' ),

				// Use if you want to hook in your own CSS compiler.
				'compiler'    => true,

				// Select a backup non-google font in addition to a google font.
				'font-backup' => true,

				// Enable all Google Font style/weight variations to be added to the page.
				'all-styles'  => true,
				'all-subsets' => true,
				'units'       => 'px',
				'subtitle'    => esc_html__( 'Typography option with each property can be called individually.', 'your-domain-here' ),
				'default'     => [
					'color'       => '#333',
					'font-style'  => '700',
					'font-family' => 'Abel',
					'google'      => true,
					'font-size'   => '33px',
					'line-height' => '40px',
				],
				// Disable google fonts.
				// 'google'      => false,
				// Includes font-style and weight. Can use font-style or font-weight to declare.
				// 'font-style'    => false,
				// Only appears if google is true and subsets not set to false.
				// 'subsets'       => false,
				// Hide or show the font size input.
				// 'font-size'     => false,
				// Hide or show the line height input.
				// 'line-height'   => false,
				// Hide or show the word spacing input. Defaults to false.
				// 'word-spacing'  => true,
				// Hide or show the word spacing input. Defaults to false.
				// 'letter-spacing'=> true,
				// Hide or show the font color picker.
				// 'color'         => false,
				// Disable the font previewer
				// 'preview'       => false,
				// An array of CSS selectors to apply this font style to dynamically
				// 'output'      => array( 'h2.site-description, .entry-title' ),
				// An array of CSS selectors to apply this font style to dynamically
				// 'compiler'    => array( 'h2.site-description-compiler' ),
				// .
			],
		],
	]
);

// -> START Additional Types.
Redux::set_section(
	$opt_name,
	[
		'title' => esc_html__( 'Additional Types', 'your-domain-here' ),
		'id'    => 'additional',
		'icon'  => 'el el-magic',
	]
);

Redux::set_section(
	$opt_name,
	[
		'title'      => esc_html__( 'Date', 'your-domain-here' ),
		'id'         => 'additional-date',
		'desc'       => esc_html__( 'For full documentation on this field, visit: ', 'your-domain-here' ) . '<a href="//docs.reduxframework.com/core/fields/date/" target="_blank">docs.reduxframework.com/core/fields/date/</a>',
		'subsection' => true,
		'fields'     => [
			[
				'id'       => 'opt-datepicker',
				'type'     => 'date',
				'title'    => esc_html__( 'Date Option', 'your-domain-here' ),
				'subtitle' => esc_html__( 'No validation can be done on this field type', 'your-domain-here' ),
				'desc'     => esc_html__( 'This is the description field, again good for additional info.', 'your-domain-here' ),
			],
		],
	]
);

Redux::set_section(
	$opt_name,
	[
		'title'      => esc_html__( 'Sorter', 'your-domain-here' ),
		'id'         => 'additional-sorter',
		'desc'       => esc_html__( 'For full documentation on this field, visit: ', 'your-domain-here' ) . '<a href="//docs.reduxframework.com/core/fields/sorter/" target="_blank">docs.reduxframework.com/core/fields/sorter/</a>',
		'subsection' => true,
		'fields'     => [
			[
				'id'       => 'opt-homepage-layout',
				'type'     => 'sorter',
				'title'    => 'Layout Manager Advanced',
				'subtitle' => 'You can add multiple drop areas or columns.',
				'compiler' => 'true',
				'options'  => [
					'enabled'  => [
						'highlights' => 'Highlights',
						'slider'     => 'Slider',
						'staticpage' => 'Static Page',
						'services'   => 'Services',
					],
					'disabled' => [],
					'backup'   => [],
				],
				'limits'   => [
					'disabled' => 1,
					'backup'   => 2,
				],
			],
			[
				'id'       => 'opt-homepage-layout-2',
				'type'     => 'sorter',
				'title'    => 'Homepage Layout Manager',
				'desc'     => 'Organize how you want the layout to appear on the homepage',
				'compiler' => 'true',
				'options'  => [
					'disabled' => [
						'highlights' => 'Highlights',
						'slider'     => 'Slider',
					],
					'enabled'  => [
						'staticpage' => 'Static Page',
						'services'   => 'Services',
					],
				],
			],
		],
	]
);

Redux::set_section(
	$opt_name,
	[
		'title'      => esc_html__( 'Raw', 'your-domain-here' ),
		'id'         => 'additional-raw',
		'desc'       => esc_html__( 'For full documentation on this field, visit: ', 'your-domain-here' ) . '<a href="//docs.reduxframework.com/core/fields/raw/" target="_blank">docs.reduxframework.com/core/fields/raw/</a>',
		'subsection' => true,
		'fields'     => [
			[
				'id'       => 'opt-raw_info_4',
				'type'     => 'raw',
				'title'    => esc_html__( 'Standard Raw Field', 'your-domain-here' ),
				'subtitle' => esc_html__( 'Subtitle', 'your-domain-here' ),
				'desc'     => esc_html__( 'Description', 'your-domain-here' ),
				'content'  => $sample_html,
			],
			[
				'id'         => 'opt-raw_info_5',
				'type'       => 'raw',
				'full_width' => false,
				'title'      => esc_html__( 'Raw Field <code>full_width</code> False', 'your-domain-here' ),
				'subtitle'   => esc_html__( 'Subtitle', 'your-domain-here' ),
				'desc'       => esc_html__( 'Description', 'your-domain-here' ),
				'content'    => $sample_html,
			],
		],
	]
);

Redux::set_section(
	$opt_name,
	[
		'title' => esc_html__( 'Advanced Features', 'your-domain-here' ),
		'icon'  => 'el el-thumbs-up',
	]
);

Redux::set_section(
	$opt_name,
	[
		'title'      => esc_html__( 'Callback', 'your-domain-here' ),
		'id'         => 'additional-callback',
		'desc'       => esc_html__( 'For full documentation on this field, visit: ', 'your-domain-here' ) . '<a href="//docs.reduxframework.com/core/fields/callback/" target="_blank">docs.reduxframework.com/core/fields/callback/</a>',
		'subsection' => true,
		'fields'     => [
			[
				'id'       => 'opt-custom-callback',
				'type'     => 'callback',
				'title'    => esc_html__( 'Custom Field Callback', 'your-domain-here' ),
				'subtitle' => esc_html__( 'This is a completely unique field type', 'your-domain-here' ),
				'desc'     => esc_html__( 'This is created with a callback function, so anything goes in this field. Make sure to define the function though.', 'your-domain-here' ),
				'callback' => 'redux_my_custom_field',
			],
		],
	]
);

// -> START Validation.
Redux::set_section(
	$opt_name,
	[
		'title'      => esc_html__( 'Field Validation', 'your-domain-here' ),
		'id'         => 'validation',
		'desc'       => esc_html__( 'For full documentation on validation, visit: ', 'your-domain-here' ) . '<a href="//docs.reduxframework.com/core/the-basics/validation/" target="_blank">docs.reduxframework.com/core/the-basics/validation/</a>',
		'subsection' => true,
		'fields'     => [
			[
				'id'       => 'opt-text-email',
				'type'     => 'text',
				'title'    => esc_html__( 'Text Option - Email Validated', 'your-domain-here' ),
				'subtitle' => esc_html__( 'This is a little space under the Field Title in the Options table, additional info is good in here.', 'your-domain-here' ),
				'desc'     => esc_html__( 'This is the description field, again good for additional info.', 'your-domain-here' ),
				'validate' => 'email',
				'msg'      => 'An error message you could customize via your option array!',
				'default'  => 'test@test.com',
			],
			[
				'id'       => 'opt-text-post-type',
				'type'     => 'text',
				'title'    => esc_html__( 'Text Option with Data Attributes', 'your-domain-here' ),
				'subtitle' => esc_html__( 'You can also pass an options array if you want. Set the default to whatever you like.', 'your-domain-here' ),
				'desc'     => esc_html__( 'This is the description field, again good for additional info.', 'your-domain-here' ),
				'data'     => 'post_type',
			],
			[
				'id'       => 'opt-multi-text',
				'type'     => 'multi_text',
				'title'    => esc_html__( 'Multi Text Option - Color Validated', 'your-domain-here' ),
				'validate' => 'color',
				'subtitle' => esc_html__( 'If you enter an invalid color it will be removed. Try using the text "blue" as a color.  ;)', 'your-domain-here' ),
				'desc'     => esc_html__( 'This is the description field, again good for additional info.', 'your-domain-here' ),
			],
			[
				'id'       => 'opt-text-url',
				'type'     => 'text',
				'title'    => esc_html__( 'Text Option - URL Validated', 'your-domain-here' ),
				'subtitle' => esc_html__( 'This must be a URL.', 'your-domain-here' ),
				'desc'     => esc_html__( 'This is the description field, again good for additional info.', 'your-domain-here' ),
				'validate' => 'url',
				'default'  => 'https://reduxframework.com',
			],
			[
				'id'       => 'opt-text-numeric',
				'type'     => 'text',
				'title'    => esc_html__( 'Text Option - Numeric Validated', 'your-domain-here' ),
				'subtitle' => esc_html__( 'This must be numeric.', 'your-domain-here' ),
				'desc'     => esc_html__( 'This is the description field, again good for additional info.', 'your-domain-here' ),
				'validate' => [ 'numeric', 'not_empty' ],
				'default'  => '0',
			],
			[
				'id'       => 'opt-text-comma-numeric',
				'type'     => 'text',
				'title'    => esc_html__( 'Text Option - Comma Numeric Validated', 'your-domain-here' ),
				'subtitle' => esc_html__( 'This must be a comma separated string of numerical values.', 'your-domain-here' ),
				'desc'     => esc_html__( 'This is the description field, again good for additional info.', 'your-domain-here' ),
				'validate' => 'comma_numeric',
				'default'  => '0',
			],
			[
				'id'       => 'opt-text-no-special-chars',
				'type'     => 'text',
				'title'    => __( 'Text Option - No Special Chars Validated', 'your-domain-here' ),
				'subtitle' => __( 'This must be a alpha numeric only.', 'your-domain-here' ),
				'desc'     => __( 'This is the description field, again good for additional info.', 'your-domain-here' ),
				'validate' => 'no_special_chars',
				'default'  => '0',
			],
			[
				'id'       => 'opt-text-str_replace',
				'type'     => 'text',
				'title'    => esc_html__( 'Text Option - Str Replace Validated', 'your-domain-here' ),
				'subtitle' => esc_html__( 'You decide.', 'your-domain-here' ),
				'desc'     => esc_html__( 'This field\'s default value was changed by a filter hook!', 'your-domain-here' ),
				'validate' => 'str_replace',
				'str'      => [
					'search'      => ' ',
					'replacement' => '-thisisaspace-',
				],
				'default'  => 'This is the default.',
			],
			[
				'id'       => 'opt-text-preg_replace',
				'type'     => 'text',
				'title'    => esc_html__( 'Text Option - Preg Replace Validated', 'your-domain-here' ),
				'subtitle' => esc_html__( 'You decide.', 'your-domain-here' ),
				'desc'     => esc_html__( 'This is the description field, again good for additional info.', 'your-domain-here' ),
				'validate' => 'preg_replace',
				'preg'     => [
					'pattern'     => '/.*?\\d.*?\\d(\\d)/is',
					'replacement' => 'no numbers',
				],
				'default'  => '0',
			],
			[
				'id'                => 'opt-text-custom_validate',
				'type'              => 'text',
				'title'             => esc_html__( 'Text Option - Custom Callback Validated', 'your-domain-here' ),
				'subtitle'          => esc_html__( 'You decide.', 'your-domain-here' ),
				'desc'              => wp_kses( __( 'Enter <code>1</code> and click <strong>Save Changes</strong> for an error message, or enter <code>2</code> and click <strong>Save Changes</strong> for a warning message.', 'your-domain-here' ), $kses_exceptions ),
				'validate_callback' => 'redux_validate_callback_function',
				'default'           => '0',
			],
			[
				'id'       => 'opt-textarea-no-html',
				'type'     => 'textarea',
				'title'    => esc_html__( 'Textarea Option - No HTML Validated', 'your-domain-here' ),
				'subtitle' => esc_html__( 'All HTML will be stripped', 'your-domain-here' ),
				'desc'     => esc_html__( 'This is the description field, again good for additional info.', 'your-domain-here' ),
				'validate' => 'no_html',
				'default'  => 'No HTML is allowed in here.',
			],
			[
				'id'       => 'opt-textarea-html',
				'type'     => 'textarea',
				'title'    => esc_html__( 'Textarea Option - HTML Validated', 'your-domain-here' ),
				'subtitle' => esc_html__( 'HTML Allowed (wp_kses)', 'your-domain-here' ),
				'desc'     => esc_html__( 'This is the description field, again good for additional info.', 'your-domain-here' ),
				'validate' => 'html', // See http://codex.wordpress.org/Function_Reference/wp_kses_post.
				'default'  => 'HTML is allowed in here.',
			],
			[
				'id'           => 'opt-textarea-some-html',
				'type'         => 'textarea',
				'title'        => esc_html__( 'Textarea Option - HTML Validated Custom', 'your-domain-here' ),
				'subtitle'     => esc_html__( 'Custom HTML Allowed (wp_kses)', 'your-domain-here' ),
				'desc'         => esc_html__( 'This is the description field, again good for additional info.', 'your-domain-here' ),
				'validate'     => 'html_custom',
				'default'      => '<p>Some HTML is allowed in here.</p>',

				// See http://codex.wordpress.org/Function_Reference/wp_kses.
				'allowed_html' => [
					'a'      => [
						'href'  => [],
						'title' => [],
					],
					'br'     => [],
					'em'     => [],
					'strong' => [],
				],
			],
			[
				'id'       => 'opt-textarea-js',
				'type'     => 'textarea',
				'title'    => esc_html__( 'Textarea Option - JS Validated', 'your-domain-here' ),
				'subtitle' => esc_html__( 'JS will be escaped', 'your-domain-here' ),
				'desc'     => esc_html__( 'This is the description field, again good for additional info.', 'your-domain-here' ),
				'validate' => 'js',
			],
		],
	]
);

// -> START Sanitizing.
Redux::set_section(
	$opt_name,
	[
		'title'      => esc_html__( 'Field Sanitizing', 'your-domain-here' ),
		'id'         => 'sanitizing',
		'desc'       => esc_html__( 'For full documentation on sanitizing, visit: ', 'your-domain-here' ) . '<a href="//docs.reduxframework.com/core/the-basics/sanitizing/" target="_blank">docs.reduxframework.com/core/the-basics/sanitizing/</a>',
		'subsection' => true,
		'fields'     => [
			[
				'id'       => 'opt-text-uppercase',
				'type'     => 'text',
				'title'    => esc_html__( 'Text Option - Force Uppercase', 'your-domain-here' ),
				'subtitle' => esc_html__( 'Uses the strtoupper function to force all uppercase characters.', 'your-domain-here' ),
				'desc'     => esc_html__( 'This is the description field, again good for additional info.', 'your-domain-here' ),
				'sanitize' => [ 'strtoupper' ],
				'default'  => 'Force Uppercase',
			],
			[
				'id'       => 'opt-text-sanitize-title',
				'type'     => 'text',
				'title'    => esc_html__( 'Text Option - Sanitize Title', 'your-domain-here' ),
				'subtitle' => esc_html__( 'Uses the WordPress sanitize_title function to format text.', 'your-domain-here' ),
				'desc'     => esc_html__( 'This is the description field, again good for additional info.', 'your-domain-here' ),
				'sanitize' => [ 'sanitize_title' ],
				'default'  => 'Sanitize This Title',
			],
			[
				'id'       => 'opt-text-custom-sanitize',
				'type'     => 'text',
				'title'    => esc_html__( 'Text Option - Custom Sanitize', 'your-domain-here' ),
				'subtitle' => esc_html__( 'Uses the custom function redux_custom_santize to capitalize every other letter.', 'your-domain-here' ),
				'desc'     => esc_html__( 'This is the description field, again good for additional info.', 'your-domain-here' ),
				'sanitize' => [ 'redux_custom_sanitize' ],
				'default'  => 'Sanitize This Text',
			],
		],
	]
);

// -> START Required.
Redux::set_section(
	$opt_name,
	[
		'title'      => esc_html__( 'Field Required / Linking', 'your-domain-here' ),
		'id'         => 'required',
		'desc'       => esc_html__( 'For full documentation on validation, visit: ', 'your-domain-here' ) . '<a href="//docs.reduxframework.com/core/the-basics/required/" target="_blank">docs.reduxframework.com/core/the-basics/required/</a>',
		'subsection' => true,
		'fields'     => [
			[
				'id'       => 'opt-required-basic',
				'type'     => 'switch',
				'title'    => esc_html__( 'Basic Required Example', 'your-domain-here' ),
				'subtitle' => wp_kses_post( __( 'Click <code>On</code> to see the text field appear.', 'your-domain-here' ) ),
				'default'  => false,
			],
			[
				'id'       => 'opt-required-basic-text',
				'type'     => 'text',
				'title'    => esc_html__( 'Basic Text Field', 'your-domain-here' ),
				'subtitle' => wp_kses_post( __( 'This text field is only show when the above switch is set to <code>On</code>, using the <code>required</code> argument.', 'your-domain-here' ) ),
				'required' => [ 'opt-required-basic', '=', true ],
			],
			[
				'id'   => 'opt-required-divide-1',
				'type' => 'divide',
			],
			[
				'id'       => 'opt-required-nested',
				'type'     => 'switch',
				'title'    => esc_html__( 'Nested Required Example', 'your-domain-here' ),
				'subtitle' => wp_kses_post( __( 'Click <code>On</code> to see another set of options appear.', 'your-domain-here' ) ),
				'default'  => false,
			],
			[
				'id'       => 'opt-required-nested-buttonset',
				'type'     => 'button_set',
				'title'    => esc_html__( 'Multiple Nested Required Examples', 'your-domain-here' ),
				'subtitle' => wp_kses_post( __( 'Click any buton to show different fields based on their <code>required</code> statements.', 'your-domain-here' ) ),
				'options'  => [
					'button-text'     => esc_html__( 'Show Text Field', 'your-domain-here' ),
					'button-textarea' => esc_html__( 'Show Textarea Field', 'your-domain-here' ),
					'button-editor'   => esc_html__( 'Show WP Editor', 'your-domain-here' ),
					'button-ace'      => esc_html__( 'Show ACE Editor', 'your-domain-here' ),
				],
				'required' => [ 'opt-required-nested', '=', true ],
				'default'  => 'button-text',
			],
			[
				'id'       => 'opt-required-nested-text',
				'type'     => 'text',
				'title'    => esc_html__( 'Nested Text Field', 'your-domain-here' ),
				'required' => [ 'opt-required-nested-buttonset', '=', 'button-text' ],
			],
			[
				'id'       => 'opt-required-nested-textarea',
				'type'     => 'textarea',
				'title'    => esc_html__( 'Nested Textarea Field', 'your-domain-here' ),
				'required' => [ 'opt-required-nested-buttonset', '=', 'button-textarea' ],
			],
			[
				'id'       => 'opt-required-nested-editor',
				'type'     => 'editor',
				'title'    => esc_html__( 'Nested Editor Field', 'your-domain-here' ),
				'required' => [ 'opt-required-nested-buttonset', '=', 'button-editor' ],
			],
			[
				'id'       => 'opt-required-nested-ace',
				'type'     => 'ace_editor',
				'title'    => esc_html__( 'Nested ACE Editor Field', 'your-domain-here' ),
				'required' => [ 'opt-required-nested-buttonset', '=', 'button-ace' ],
			],
			[
				'id'   => 'opt-required-divide-2',
				'type' => 'divide',
			],
			[
				'id'       => 'opt-required-select',
				'type'     => 'select',
				'title'    => esc_html__( 'Select Required Example', 'your-domain-here' ),
				'subtitle' => esc_html__( 'Select a different option to display its value.  Required may be used to display multiple & reusable fields', 'your-domain-here' ),
				'options'  => [
					'no-sidebar'    => esc_html__( 'No Sidebars', 'your-domain-here' ),
					'left-sidebar'  => esc_html__( 'Left Sidebar', 'your-domain-here' ),
					'right-sidebar' => esc_html__( 'Right Sidebar', 'your-domain-here' ),
					'both-sidebars' => esc_html__( 'Both Sidebars', 'your-domain-here' ),
				],
				'default'  => 'no-sidebar',
				'select2'  => [ 'allowClear' => false ],
			],
			[
				'id'       => 'opt-required-select-left-sidebar',
				'type'     => 'select',
				'title'    => esc_html__( 'Select Left Sidebar', 'your-domain-here' ),
				'data'     => 'sidebars',
				'default'  => '',
				'required' => [ 'opt-required-select', '=', [ 'left-sidebar', 'both-sidebars' ] ],
			],
			[
				'id'       => 'opt-required-select-right-sidebar',
				'type'     => 'select',
				'title'    => esc_html__( 'Select Right Sidebar', 'your-domain-here' ),
				'data'     => 'sidebars',
				'default'  => '',
				'required' => [ 'opt-required-select', '=', [ 'right-sidebar', 'both-sidebars' ] ],
			],
		],
	]
);

Redux::set_section(
	$opt_name,
	[
		'title'      => esc_html__( 'WPML Integration', 'your-domain-here' ),
		'desc'       => esc_html__( 'These fields can be fully translated by WPML (WordPress Multi-Language). This serves as an example for you to implement. For extra details look at our <a href="//docs.reduxframework.com/core/advanced/wpml-integration/" target="_blank">WPML Implementation</a> documentation.', 'your-domain-here' ),
		'subsection' => true,
		'fields'     => [
			[
				'id'    => 'wpml-text',
				'type'  => 'textarea',
				'title' => esc_html__( 'WPML Text', 'your-domain-here' ),
				'desc'  => esc_html__( 'This string can be translated via WPML.', 'your-domain-here' ),
			],
			[
				'id'      => 'wpml-multicheck',
				'type'    => 'checkbox',
				'title'   => esc_html__( 'WPML Multi Checkbox', 'your-domain-here' ),
				'desc'    => esc_html__( 'You can literally translate the values via key.', 'your-domain-here' ),
				'options' => [
					'1' => esc_html__( 'Option 1', 'your-domain-here' ),
					'2' => esc_html__( 'Option 2', 'your-domain-here' ),
					'3' => esc_html__( 'Option 3', 'your-domain-here' ),
				],
			],
		],
	]
);

Redux::set_section(
	$opt_name,
	[
		'title' => esc_html__( 'Disabling', 'your-domain-here' ),
		'icon'  => 'el el-lock',
	]
);

Redux::set_section(
	$opt_name,
	[
		'title'            => esc_html__( 'Disable Field', 'your-domain-here' ),
		'id'               => 'basic-checkbox-disable',
		'subsection'       => true,
		'customizer_width' => '450px',
		'desc'             => esc_html__( 'For full documentation on this field, visit: ', 'your-domain-here' ) . '<a href="//docs.reduxframework.com/core/fields/checkbox/" target="_blank">docs.reduxframework.com/core/fields/checkbox/</a>',
		'fields'           => [
			[
				'id'       => 'opt-checkbox-disable',
				'type'     => 'checkbox',
				'title'    => esc_html__( 'Checkbox Option', 'your-domain-here' ),
				'subtitle' => esc_html__( 'No validation can be done on this field type', 'your-domain-here' ),
				'desc'     => esc_html__( 'This is the description field, again good for additional info.', 'your-domain-here' ),
				'disabled' => true,
				'default'  => '1', // 1 = on | 0 = off.
			],
		],
	]
);

Redux::set_section(
	$opt_name,
	[
		'title'            => esc_html__( 'Disable Section', 'your-domain-here' ),
		'id'               => 'basic-checkbox-section-disable',
		'subsection'       => true,
		'customizer_width' => '450px',
		'disabled'         => true,
		'desc'             => esc_html__( 'For full documentation on this field, visit: ', 'your-domain-here' ) . '<a href="//docs.reduxframework.com/core/fields/checkbox/" target="_blank">docs.reduxframework.com/core/fields/checkbox/</a>',
		'fields'           => [
			[
				'id'       => 'opt-checkbox-section-disable',
				'type'     => 'checkbox',
				'title'    => esc_html__( 'Checkbox Option', 'your-domain-here' ),
				'subtitle' => esc_html__( 'No validation can be done on this field type', 'your-domain-here' ),
				'desc'     => esc_html__( 'This is the description field, again good for additional info.', 'your-domain-here' ),
				'default'  => '1', // 1 = on | 0 = off.
			],
		],
	]
);

Redux::set_section(
	$opt_name,
	[
		'icon'            => 'el el-list-alt',
		'title'           => esc_html__( 'Customizer Only', 'your-domain-here' ),
		'desc'            => '<p class="description">' . esc_html__( 'This Section should be visible only in Customizer', 'your-domain-here' ) . '</p>',
		'customizer_only' => true,
		'fields'          => [
			[
				'id'              => 'opt-customizer-only',
				'type'            => 'select',
				'title'           => esc_html__( 'Customizer Only Option', 'your-domain-here' ),
				'subtitle'        => esc_html__( 'The subtitle is NOT visible in customizer', 'your-domain-here' ),
				'desc'            => esc_html__( 'The field desc is NOT visible in customizer.', 'your-domain-here' ),
				'customizer_only' => true,
				'options'         => [
					'1' => esc_html__( 'Opt 1', 'your-domain-here' ),
					'2' => esc_html__( 'Opt 2', 'your-domain-here' ),
					'3' => esc_html__( 'Opt 3', 'your-domain-here' ),
				],
				'default'         => '2',
			],
		],
	]
);

if ( file_exists( dirname( __FILE__ ) . '/../README.md' ) ) {
	$section = [
		'icon'   => 'el el-list-alt',
		'title'  => esc_html__( 'Documentation', 'your-domain-here' ),
		'fields' => [
			[
				'id'           => 'opt-raw-documentation',
				'type'         => 'raw',
				'markdown'     => true,
				'content_path' => dirname( __FILE__ ) . '/../README.md', // FULL PATH, not relative please.
			],
		],
	];

	Redux::set_section( $opt_name, $section );
}

/*
 * <--- END SECTIONS
 */

/*
 * ---> BEGIN METABOX CONFIG
 */

// Regardless how you create your Metabox arrays, whether via a separate file on inyour actual option config,
// It MUST, MUST, MUST be set via this action hook.  Otherwise, your Metaboxes will NOT render.
add_filter( 'redux/' . $opt_name . '/extensions/metaboxes/config/load', 'redux_load_metabox_config' );

if ( ! function_exists( 'redux_load_metabox_config' ) ) {
	/**
	 * Load Metabox config on action hook.  This ensures proper load order, otherwise Metaboxes may not display.
	 *
	 * @param string $opt_name Panel opt_name.
	 */
	function redux_load_metabox_config( $opt_name ) {

		// File containing sample Metabox Lite option arrays.
		require_once Redux_Core::$dir . '../sample/sample-metabox-config.php';
	}
}

/*
 * ---> END METABOX CONFIG
 */

/*
 * YOU MUST PREFIX THE FUNCTIONS BELOW AND ACTION FUNCTION CALLS OR OTHER CONFIGS MAY OVERRIDE YOUR CODE.
 */

/*
 * --> Action hook examples.
 */

// Function to test the compiler hook and demo CSS output.
// Above 10 is a priority, but 2 in necessary to include the dynamically generated CSS to be sent to the function.
// add_filter('redux/options/' . $opt_name . '/compiler', 'compiler_action', 10, 3);
//
// Change the arguments after they've been declared, but before the panel is created.
// add_filter('redux/options/' . $opt_name . '/args', 'change_arguments' );
//
// Change the default value of a field after it's been set, but before it's been useds.
// add_filter('redux/options/' . $opt_name . '/defaults', 'change_defaults' );
//
// Dynamically add a section. Can be also used to modify sections/fields.
// add_filter('redux/options/' . $opt_name . '/sections', 'dynamic_section');
// .
if ( ! function_exists( 'compiler_action' ) ) {
	/**
	 *
	 * This is a test function that will let you see when the compiler hook occurs.
	 * It only runs if a field's value has changed and compiler=>true is set.
	 *
	 * @param array  $options        Options values.
	 * @param string $css            Compiler selector CSS values  compiler => array( CSS SELECTORS ).
	 * @param array  $changed_values Values changed since last save.
	 */
	function compiler_action( $options, $css, $changed_values ) {
		echo '<h1>The compiler hook has run!</h1>';
		echo '<pre>';
		// phpcs:ignore WordPress.PHP.DevelopmentFunctions
		print_r( $changed_values ); // Values that have changed since the last save.
		// echo '<br/>';
		// print_r($options); //Option values.
		// echo '<br/>';
		// print_r($css); // Compiler selector CSS values  compiler => array( CSS SELECTORS ).
		echo '</pre>';
	}
}

if ( ! function_exists( 'redux_validate_callback_function' ) ) {
	/**
	 * Custom function for the callback validation referenced above
	 *
	 * @param array $field          Field array.
	 * @param mixed $value          New value.
	 * @param mixed $existing_value Existing value.
	 *
	 * @return mixed
	 */
	function redux_validate_callback_function( $field, $value, $existing_value ) {
		$error   = false;
		$warning = false;

		// Do your validation.
		if ( 1 === $value ) {
			$error = true;
			$value = $existing_value;
		} elseif ( 2 === $value ) {
			$warning = true;
			$value   = $existing_value;
		}

		$return['value'] = $value;

		if ( true === $error ) {
			$field['msg']    = 'your custom error message';
			$return['error'] = $field;
		}

		if ( true === $warning ) {
			$field['msg']      = 'your custom warning message';
			$return['warning'] = $field;
		}

		return $return;
	}
}

if ( ! function_exists( 'redux_my_custom_field' ) ) {
	/**
	 * Custom function for the callback referenced above.
	 *
	 * @param array $field Field array.
	 * @param mixed $value Set value.
	 */
	function redux_my_custom_field( $field, $value ) {
		print_r( $field ); // phpcs:ignore WordPress.PHP.DevelopmentFunctions
		echo '<br/>';
		print_r( $value ); // phpcs:ignore WordPress.PHP.DevelopmentFunctions
	}
}

if ( ! function_exists( 'dynamic_section' ) ) {
	/**
	 * Custom function for filtering the sections array. Good for child themes to override or add to the sections.
	 * Simply include this function in the child themes functions.php file.
	 * NOTE: the defined constants for URLs, and directories will NOT be available at this point in a child theme,
	 * so you must use get_template_directory_uri() if you want to use any of the built in icons.
	 *
	 * @param array $sections Section array.
	 *
	 * @return array
	 */
	function dynamic_section( $sections ) {
		$sections[] = [
			'title'  => esc_html__( 'Section via hook', 'your-domain-here' ),
			'desc'   => '<p class="description">' . esc_html__( 'This is a section created by adding a filter to the sections array. Can be used by child themes to add/remove sections from the options.', 'your-domain-here' ) . '</p>',
			'icon'   => 'el el-paper-clip',

			// Leave this as a blank section, no options just some intro text set above.
			'fields' => [],
		];

		return $sections;
	}
}

if ( ! function_exists( 'change_arguments' ) ) {
	/**
	 * Filter hook for filtering the args.
	 * Good for child themes to override or add to the args array. Can also be used in other functions.
	 *
	 * @param array $args Global arguments array.
	 *
	 * @return array
	 */
	function change_arguments( $args ) {
		$args['dev_mode'] = true;

		return $args;
	}
}

if ( ! function_exists( 'change_defaults' ) ) {
	/**
	 * Filter hook for filtering the default value of any given field. Very useful in development mode.
	 *
	 * @param array $defaults Default value array.
	 *
	 * @return array
	 */
	function change_defaults( $defaults ) {
		$defaults['str_replace'] = esc_html__( 'Testing filter hook!', 'your-domain-here' );

		return $defaults;
	}
}

if ( ! function_exists( 'redux_custom_sanitize' ) ) {
	/**
	 * Function to be used if the field santize argument.
	 *
	 * Return value MUST be the formatted or cleaned text to display.
	 *
	 * @param string $value Value to evaluate or clean.  Required.
	 *
	 * @return string
	 */
	function redux_custom_sanitize( $value ) {
		$return = '';

		foreach ( explode( ' ', $value ) as $w ) {
			foreach ( str_split( $w ) as $k => $v ) {
				if ( ( $k + 1 ) % 2 !== 0 && ctype_alpha( $v ) ) {
					$return .= mb_strtoupper( $v );
				} else {
					$return .= $v;
				}
			}
			$return .= ' ';
		}

		return $return;
	}
}
