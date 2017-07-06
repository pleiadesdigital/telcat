<?php /* Pleiades Moon Premium Theme functions and definitions */

// WordPress version check (4.7 or later)
if ( version_compare( $GLOBALS['wp_version'], '4.7-alpha', '<' ) ) {
	require get_template_directory() . '/inc/back-compat.php';
	return;
}
// SET UP THEME DEFAULTS
function pleiadesmoon_setup() {
	// Make theme available for translation
	load_theme_textdomain('pleiadesmoon');
	// Add default posts and comments RSS feed links to head.
	add_theme_support('automatic-feed-links');
	// Let WordPress manage the document title
	add_theme_support('title-tag');
	// POST THUMBNAILS
	add_theme_support('post-thumbnails');
	add_image_size('pleiadesmoon-featured-image', 2000, 1200, true);
	add_image_size('pleiadesmoon-thumbnail-avatar', 100, 100, true);
	// Set the default content width.
	$GLOBALS['content_width'] = 525;
	// NAVIGATION
	register_nav_menus(array(
		'top'    => __('Top Menu', 'pleiadesmoon'),
		'social' => __('Social Links Menu', 'pleiadesmoon'),
	));
	// HTML5 support
	add_theme_support('html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	));
	// POST FORMATS
	add_theme_support('post-formats', array(
		'aside',
		'image',
		'video',
		'quote',
		'link',
		'gallery',
		'audio',
	));
	// Custom Logo.
	add_theme_support('custom-logo', array(
		'width'       => 250,
		'height'      => 250,
		'flex-width'  => true,
	));
	// Selective refresh for widgets.
	add_theme_support('customize-selective-refresh-widgets');
	// Visual editor styles
	//add_editor_style(array('assets/css/editor-style.css', pleiadesmoon_fonts_url()));

	// Define and register starter content to showcase the theme on new sites
	$starter_content = array(
		'widgets' => array(
			'sidebar-1' => array(
				'text_business_info',
				'search',
				'text_about',
			),
			'sidebar-2' => array(
				'text_business_info',
			),
			'sidebar-3' => array(
				'text_about',
				'search',
			),
		),
		'posts' => array(
			'home',
			'about' => array(
				'thumbnail' => '{{image-sandwich}}',
			),
			'contact' => array(
				'thumbnail' => '{{image-espresso}}',
			),
			'blog' => array(
				'thumbnail' => '{{image-coffee}}',
			),
			'homepage-section' => array(
				'thumbnail' => '{{image-espresso}}',
			),
		),
		'attachments' => array(
			'image-espresso' => array(
				'post_title' => _x('Espresso', 'Theme starter content', 'pleiadesmoon'),
				'file' => 'assets/images/espresso.jpg',
			),
			'image-sandwich' => array(
				'post_title' => _x('Sandwich', 'Theme starter content', 'pleiadesmoon'),
				'file' => 'assets/images/sandwich.jpg',
			),
			'image-coffee' => array(
				'post_title' => _x('Coffee', 'Theme starter content', 'pleiadesmoon' ),
				'file' => 'assets/images/coffee.jpg',
			),
		),
		'options' => array(
			'show_on_front' => 'page',
			'page_on_front' => '{{home}}',
			'page_for_posts' => '{{blog}}',
		),
		'theme_mods' => array(
			'panel_1' => '{{homepage-section}}',
			'panel_2' => '{{about}}',
			'panel_3' => '{{blog}}',
			'panel_4' => '{{contact}}',
		),
		'nav_menus' => array(
			'top' => array(
				'name' => __('Top Menu', 'pleiadesmoon'),
				'items' => array(
					'link_home',
					'page_about',
					'page_blog',
					'page_contact',
				),
			),
			'social' => array(
				'name' => __( 'Social Links Menu', 'pleiadesmoon' ),
				'items' => array(
					'link_yelp',
					'link_facebook',
					'link_twitter',
					'link_instagram',
					'link_email',
				),
			),
		),
	);
	$starter_content = apply_filters('pleiadesmoon_starter_content', $starter_content);
	add_theme_support('starter-content', $starter_content);
} //pleiadesmoon_setup()
add_action('after_setup_theme', 'pleiadesmoon_setup');

/* CONTENT WIDTH IN PX */
function pleiadesmoon_content_width() {
	$content_width = $GLOBALS['content_width'];
	// Get layout
	$page_layout = get_theme_mod('page_layout');
	// Check if layout is one column.
	if ('one-column' === $page_layout) {
		if (pleiadesmoon_is_frontpage()) {
			$content_width = 644;
		} elseif (is_page()) {
			$content_width = 740;
		}
	}
	// Check if is single post and there is no sidebar.
	if (is_single() && ! is_active_sidebar('sidebar-1')) {
		$content_width = 740;
	}
	$GLOBALS['content_width'] = apply_filters('pleiadesmoon_content_width', $content_width);
}
add_action('template_redirect', 'pleiadesmoon_content_width', 0);

// WIDGET AREAS
function pleiadesmoon_widgets_init() {
	register_sidebar(array(
		'name'          => __('Sidebar', 'pleiadesmoon'),
		'id'            => 'sidebar-1',
		'description'   => __('Add widgets here to appear in your sidebar.', 'pleiadesmoon'),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	));

	register_sidebar( array(
		'name'          => __('Footer 1', 'pleiadesmoon'),
		'id'            => 'sidebar-2',
		'description'   => __('Add widgets here to appear in your footer.', 'pleiadesmoon'),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => __('Footer 2', 'pleiadesmoon'),
		'id'            => 'sidebar-3',
		'description'   => __('Add widgets here to appear in your footer.', 'pleiadesmoon'),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action('widgets_init', 'pleiadesmoon_widgets_init');

/* REPLACES "[...]" with ... and "Continue reading */
function pleiadesmoon_excerpt_more($link) {
	if (is_admin()) {
		return $link;
	}
	$link = sprintf('<p class="link-more"><a href="%1$s" class="more-link">%2$s</a></p>',
		esc_url(get_permalink( get_the_ID())),
		/* translators: %s: Name of current post */
		sprintf(__('Continue reading<span class="screen-reader-text"> "%s"</span>', 'pleiadesmoon'), get_the_title( get_the_ID()))
	);
	return ' &hellip; ' . $link;
}
add_filter('excerpt_more', 'pleiadesmoon_excerpt_more');

// JAVASCRIPT DETECTION
function pleiadesmoon_javascript_detection() {
	echo "<script>(function(html){html.className = html.className.replace(/\bno-js\b/,'js')})(document.documentElement);</script>\n";
}
add_action('wp_head', 'pleiadesmoon_javascript_detection', 0);


function pleiadesmoon_pingback_header() {
	if (is_singular() && pings_open()) {
		printf('<link rel="pingback" href="%s">' . "\n", get_bloginfo('pingback_url'));
	}
}
add_action('wp_head', 'pleiadesmoon_pingback_header' );

// Display custom color CSS.
function pleiadesmoon_colors_css_wrap() {
	if ('custom' !== get_theme_mod('colorscheme' ) && ! is_customize_preview()) {
		return;
	}

	require_once(get_parent_theme_file_path('/inc/color-patterns.php'));
	$hue = absint( get_theme_mod('colorscheme_hue', 250 ));
?>
	<style type="text/css" id="custom-theme-colors" <?php if ( is_customize_preview() ) { echo 'data-hue="' . $hue . '"'; } ?>>
		<?php echo pleiadesmoon_custom_colors_css(); ?>
	</style>
<?php }
add_action('wp_head', 'pleiadesmoon_colors_css_wrap');

/********************************************************
****************** STYLES & SCRIPTS *********************
********************************************************/

function pleiadesmoon_scripts() {

	// MAIN CSS style.css
	wp_enqueue_style('pleiadesmoon-style', get_stylesheet_uri());
	// Fontawesome
	wp_enqueue_script('pleiades17-fontawesome', 'https://use.fontawesome.com/b1403a6995.js', array(), '20170109', true);
	// Google Fonts
	// wp_enqueue_style('google-fonts', 'https://fonts.googleapis.com/css?family=Libre+Franklin:200,300,400,400i,700');
	wp_enqueue_style('google-fonts', 'https://fonts.googleapis.com/css?family=Lato:300,400,700|Rokkitt:300,400,500');
	// Google Maps
	wp_enqueue_script('pleiades17-googlemaps', 'https://maps.googleapis.com/maps/api/js?key=AIzaSyDjEcnBmAHgm_LfegO9o84NLPAfBLwVjSY', array(), '20161130', true);
	// FlexSlider CSS & JS
	wp_enqueue_style('flexslider-css', get_template_directory_uri() . '/assets/css/flexslider.css');
	wp_enqueue_script('flexslider-js', get_template_directory_uri() . '/assets/js/jquery.flexslider-min.js', array('jquery'), '', true);
	// Load IE9 stylesheet, to fix display issues in the Customizer
	if (is_customize_preview()) {
		wp_enqueue_style('pleiadesmoon-ie9', get_theme_file_uri('/assets/css/ie9.css' ), array( 'pleiadesmoon-style'), '1.0');
		wp_style_add_data('pleiadesmoon-ie9', 'conditional', 'IE 9');
	}
	// Load the Internet Explorer 8 specific stylesheet.
	wp_enqueue_style('pleiadesmoon-ie8', get_theme_file_uri('/assets/css/ie8.css' ), array( 'pleiadesmoon-style'), '1.0');
	wp_style_add_data('pleiadesmoon-ie8', 'conditional', 'lt IE 9');

	// HTML5 shiv
	wp_enqueue_script('html5', get_theme_file_uri('/assets/js/html5.js'), array(), '3.7.3');
	wp_script_add_data('html5', 'conditional', 'lt IE 9');
	// SKIP LINK FOCUS
	wp_enqueue_script('pleiadesmoon-skip-link-focus-fix', get_theme_file_uri('/assets/js/skip-link-focus-fix.js'), array(), '1.0', true);
	// SVG
	$pleiadesmoon_l10n = array(
		'quote'          => pleiadesmoon_get_svg(array('icon' => 'quote-right')),
	);
	// RESP NAVIGATION JS
	if (has_nav_menu('top')) {
		wp_enqueue_script('pleiadesmoon-navigation', get_theme_file_uri('/assets/js/navigation.js'), array('jquery'), '1.0', true);
		$pleiadesmoon_l10n['expand']         = __('Expand child menu', 'pleiadesmoon');
		$pleiadesmoon_l10n['collapse']       = __('Collapse child menu', 'pleiadesmoon');
		$pleiadesmoon_l10n['icon']           = pleiadesmoon_get_svg( array('icon' => 'angle-down', 'fallback' => true));
	}
	wp_enqueue_script('pleiadesmoon-global', get_theme_file_uri('/assets/js/global.js'), array('jquery'), '1.0', true);

	wp_enqueue_script('jquery-scrollto', get_theme_file_uri('/assets/js/jquery.scrollTo.js'), array('jquery'), '2.1.2', true);

	wp_localize_script('pleiadesmoon-skip-link-focus-fix', 'pleiadesmoonScreenReaderText', $pleiadesmoon_l10n );

	if (is_singular() && comments_open() && get_option('thread_comments')) {
		wp_enqueue_script('comment-reply');
	}
} //pleiadesmoon_scripts()
add_action('wp_enqueue_scripts', 'pleiadesmoon_scripts');

// Custom image sizes attribute (enhance responsive image functionality)
function pleiadesmoon_content_image_sizes_attr($sizes, $size) {
	$width = $size[0];
	if (740 <= $width) {
		$sizes = '(max-width: 706px) 89vw, (max-width: 767px) 82vw, 740px';
	}
	if (is_active_sidebar('sidebar-1') || is_archive() || is_search() || is_home() || is_page()) {
		if (!(is_page() && 'one-column' === get_theme_mod('page_options')) && 767 <= $width) {
			 $sizes = '(max-width: 767px) 89vw, (max-width: 1000px) 54vw, (max-width: 1071px) 543px, 580px';
		}
	}
	return $sizes;
} //spleiadesmoon_content_image_sizes_attr($sizes, $size)
add_filter('wp_calculate_image_sizes', 'pleiadesmoon_content_image_sizes_attr', 10, 2);

//Filter the `sizes` value in the header image markup
function pleiadesmoon_header_image_tag($html, $header, $attr) {
	if (isset($attr['sizes'])) {
		$html = str_replace($attr['sizes'], '100vw', $html);
	}
	return $html;
}
add_filter('get_header_image_tag', 'pleiadesmoon_header_image_tag', 10, 3);

// Use front-page.php when front page displays is set to a static page
function pleiadesmoon_front_page_template($template) {
	return is_home() ? '' : $template;
}
add_filter('frontpage_template',  'pleiadesmoon_front_page_template');

/* REQUIRED FILES */
// Implement the Custom Header feature
require get_parent_theme_file_path('/inc/custom-header.php');
// Custom template tags
require get_parent_theme_file_path('/inc/template-tags.php');
// Template Functions
require get_parent_theme_file_path('/inc/template-functions.php');
// Customizer
require get_parent_theme_file_path('/inc/customizer.php');
// SVG icons functions and filters
require get_parent_theme_file_path('/inc/icon-functions.php');
// Pleiades Moon Custom Post Types
require get_parent_theme_file_path('/inc/pmcpt.php');
