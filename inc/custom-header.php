<?php // Custom header implementation

function pleiadesmoon_custom_header_setup() {
	add_theme_support('custom-header', apply_filters('pleiadesmoon_custom_header_args', array(
		'default-image'      => get_parent_theme_file_uri('/assets/images/header.jpg'),
		'width'              => 2000,
		'height'             => 1200,
		'flex-height'        => true,
		'video'              => true,
		'wp-head-callback'   => 'pleiadesmoon_header_style',
	)));
	register_default_headers(array(
		'default-image' => array(
			'url'           => '%s/assets/images/header.jpg',
			'thumbnail_url' => '%s/assets/images/header.jpg',
			'description'   => __('Default Header Image', 'pleiadesmoon'),
		),
	));
}
add_action('after_setup_theme', 'pleiadesmoon_custom_header_setup');

if (!function_exists('pleiadesmoon_header_style')) :
function pleiadesmoon_header_style() {
	$header_text_color = get_header_textcolor();
	if (get_theme_support('custom-header', 'default-text-color') === $header_text_color) {
		return;
	}
	?>
	<style id="pleiadesmoon-custom-header-styles" type="text/css">
	<?php
		// Has the text been hidden?
		if ('blank' === $header_text_color) :
	?>
		.site-title,
		.site-description {
			position: absolute;
			clip: rect(1px, 1px, 1px, 1px);
		}
	<?php
		// If the user has set a custom color for the text use that
		else :
	?>
		.site-title a,
		.colors-dark .site-title a,
		.colors-custom .site-title a,
		body.has-header-image .site-title a,
		body.has-header-video .site-title a,
		body.has-header-image.colors-dark .site-title a,
		body.has-header-video.colors-dark .site-title a,
		body.has-header-image.colors-custom .site-title a,
		body.has-header-video.colors-custom .site-title a,
		.site-description,
		.colors-dark .site-description,
		.colors-custom .site-description,
		body.has-header-image .site-description,
		body.has-header-video .site-description,
		body.has-header-image.colors-dark .site-description,
		body.has-header-video.colors-dark .site-description,
		body.has-header-image.colors-custom .site-description,
		body.has-header-video.colors-custom .site-description {
			color: #<?php echo esc_attr($header_text_color); ?>;
		}
	<?php endif; ?>
	</style>
	<?php
}
endif;

// Customize video play/pause button in the custom header
function pleiadesmoon_video_controls($settings) {
	$settings['l10n']['play'] = '<span class="screen-reader-text">' . __('Play background video', 'pleiadesmoon') . '</span>' . pleiadesmoon_get_svg( array('icon' => 'play' ));
	$settings['l10n']['pause'] = '<span class="screen-reader-text">' . __('Pause background video', 'pleiadesmoon' ) . '</span>' . pleiadesmoon_get_svg(array('icon' => 'pause'));
	return $settings;
}
add_filter('header_video_settings', 'pleiadesmoon_video_controls');
