<?php
/**
 * my-tpl-resume functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package my-tpl-resume
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function my_tpl_resume_setup() {
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on my-tpl-resume, use a find and replace
		* to change 'my-tpl-resume' to the name of your theme in all the template files.
		*/
	load_theme_textdomain( 'my-tpl-resume', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
		* Let WordPress manage the document title.
		* By adding theme support, we declare that this theme does not use a
		* hard-coded <title> tag in the document head, and expect WordPress to
		* provide it for us.
		*/
	add_theme_support( 'title-tag' );

	/*
		* Enable support for Post Thumbnails on posts and pages.
		*
		* @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		*/
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus(
		array(
			'menu-1' => esc_html__( 'Primary', 'my-tpl-resume' ),
		)
	);

	/*
		* Switch default core markup for search form, comment form, and comments
		* to output valid HTML5.
		*/
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	// Set up the WordPress core custom background feature.
	add_theme_support(
		'custom-background',
		apply_filters(
			'my_tpl_resume_custom_background_args',
			array(
				'default-color' => 'ffffff',
				'default-image' => '',
			)
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);
}
add_action( 'after_setup_theme', 'my_tpl_resume_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function my_tpl_resume_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'my_tpl_resume_content_width', 640 );
}
add_action( 'after_setup_theme', 'my_tpl_resume_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function my_tpl_resume_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'my-tpl-resume' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'my-tpl-resume' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'my_tpl_resume_widgets_init' );

/**
 * Remove tags from head.
 */
function wpcourses_disable_feed() {
    wp_redirect(get_option('siteurl'));
}
add_action('do_feed', 'wpcourses_disable_feed', 1);
add_action('do_feed_rdf', 'wpcourses_disable_feed', 1);
add_action('do_feed_rss', 'wpcourses_disable_feed', 1);
add_action('do_feed_rss2', 'wpcourses_disable_feed', 1);
add_action('do_feed_atom', 'wpcourses_disable_feed', 1);
remove_action( 'wp_head', 'feed_links_extra', 3 );
remove_action( 'wp_head', 'feed_links', 2 );
remove_action( 'wp_head', 'rsd_link' );
remove_action('wp_head', 'wp_generator');
remove_filter('the_content', 'wpautop');
remove_action('wp_head', 'wp_shortlink_wp_head');
remove_action('wp_head', 'adjacent_posts_rel_link_wp_head');
remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('wp_print_styles', 'print_emoji_styles');
remove_action( 'wp_head','rest_output_link_wp_head');
remove_action( 'wp_head','wp_oembed_add_discovery_links');
remove_action( 'template_redirect', 'rest_output_link_header', 11 );

/**
 * Remove version css and js from header
 */
function remove_css_js_version( $src ) {
    if( strpos( $src, '?ver=' ) )
        $src = remove_query_arg( 'ver', $src );
    return $src;
}
add_filter( 'style_loader_src', 'remove_css_js_version', 9999 );
add_filter( 'script_loader_src', 'remove_css_js_version', 9999 );

function remove_wp_block_library_css() {
    wp_dequeue_style( 'wp-block-library' );
    wp_dequeue_style( 'wp-block-library-theme' );
    wp_dequeue_style( 'wc-block-style' );
    wp_dequeue_style( 'global-styles' );
}

add_action( 'wp_enqueue_scripts', 'mywptheme_child_deregister_styles', 20 );
function mywptheme_child_deregister_styles() {
    wp_dequeue_style( 'classic-theme-styles' );
}
add_action( 'wp_enqueue_scripts', 'remove_wp_block_library_css', 100 );

function remove_footer_admin () {
    echo '© 2023, Vladislav Tanasevski';
}
add_filter('admin_footer_text', 'remove_footer_admin');

function footer_version ($default) {
    return '';
}
add_filter ('update_footer', 'footer_version', 999);

function footer_filter ($default) {
    return '';
}
add_filter ('admin_footer_text', 'footer_filter');

add_action( 'add_admin_bar_menus', function() {
    remove_action( 'admin_bar_menu', 'wp_admin_bar_customize_menu', 40);
    remove_action( 'admin_bar_menu', 'wp_admin_bar_search_menu', 4 );
    remove_action( 'admin_bar_menu', 'wp_admin_bar_wp_menu', 10 );
});

/**
 * Language translations
 */
add_action('init', function() {
    pll_register_string('tpl-title-nothing-found', 'Title Nothing Found');
    pll_register_string('tpl-description-nothing-found', 'Description Nothing Found');
    pll_register_string('tpl-link-nothing-found', 'Page link Nothing Found');
	pll_register_string('tpl-button-expand', 'Expand');
	pll_register_string('tpl-button-collapse', 'Collapse');
	pll_register_string('tpl-social-priority', 'Social Priority');
});

/**
 * Language switcher
 */
function lang_switcher() {
    $langs_array = pll_the_languages( array( 'dropdown' => 0, 'hide_current' => 1, 'raw' => 1 ) );
    if ($langs_array) : ?>
        <?php foreach ($langs_array as $lang) : ?>
        <a href="<?= $lang['url']; ?>"><?= $lang['name']; ?></a>
        <?php endforeach; ?>
    <?php endif; 
}
add_shortcode( 'polylang_lang_switcher', 'lang_switcher' );

/**
 * Enqueue scripts and styles.
 */
function my_tpl_resume_scripts() {
    wp_enqueue_style('General', get_template_directory_uri() . '/style.min.css');
	wp_enqueue_script('Jquery', get_template_directory_uri() . '/js/jquery.min.js', array(), _S_VERSION, false);
	wp_enqueue_script('General', get_template_directory_uri() . '/js/general.min.js', array(), _S_VERSION, true);
}
add_action( 'wp_enqueue_scripts', 'my_tpl_resume_scripts' );

/**
 * Return custom message on login
 */
function no_wordpress_errors() {
    return 'Wrong login or password';
}
add_filter( 'login_errors', 'no_wordpress_errors' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

