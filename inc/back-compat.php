<?php // Pleiades Moon back compat functionality
// Prevent switching to Twenty Seventeen on old versions of WordPress.

function pleiadesmoon_switch_theme() {
	switch_theme(WP_DEFAULT_THEME);
	unset($_GET['activated']);
	add_action('admin_notices', 'pleiadesmoon_upgrade_notice');
}
add_action('after_switch_theme', 'pleiadesmoon_switch_theme');

// Adds a message for unsuccessful theme switch
function pleiadesmoon_upgrade_notice() {
	$message = sprintf(__('Pleiades Moon requires at least WordPress version 4.7. You are running version %s. Please upgrade and try again.', 'pleiadesmoon'), $GLOBALS['wp_version']);
	printf('<div class="error"><p>%s</p></div>', $message);
}

//Prevents the Customizer from being loaded on WordPress versions prior to 4.7
function pleiadesmoon_customize() {
	wp_die(sprintf(__('Pleiades Moon requires at least WordPress version 4.7. You are running version %s. Please upgrade and try again.', 'pleiadesmoon'), $GLOBALS['wp_version']), '', array(
		'back_link' => true,
	));
}
add_action('load-customize.php', 'pleiadesmoon_customize');

// Prevents the Theme Preview from being loaded on WordPress versions prior to 4.7
function pleiadesmoon_preview() {
	if (isset( $_GET['preview'])) {
		wp_die(sprintf(__('Pleiades Moon requires at least WordPress version 4.7. You are running version %s. Please upgrade and try again.', 'pleiadesmoon'), $GLOBALS['wp_version']));
	}
}
add_action('template_redirect', 'pleiadesmoon_preview');
