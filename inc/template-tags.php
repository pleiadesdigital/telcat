<?php // Custom template tags for this theme

if (!function_exists('pleiadesmoon_posted_on')) {
	function pleiadesmoon_posted_on() {
		// Get the author name; wrap it in a link.
		$byline = sprintf(
			/* translators: %s: post author */
			__('by %s', 'pleiadesmoon'),
			'<span class="author vcard"><a class="url fn n" href="' . esc_url(get_author_posts_url(get_the_author_meta('ID'))) . '">' . get_the_author() . '</a></span>'
		);
		// Finally, let's write all of this to the page.
		echo '<span class="posted-on">' . pleiadesmoon_time_link() . '</span><span class="byline"> ' . $byline . '</span>';
	} //pleiadesmoon_posted_on()
}


if (!function_exists('pleiadesmoon_time_link')) {
	function pleiadesmoon_time_link() {
		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
		if (get_the_time('U') !== get_the_modified_time('U')) {
			$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
		}
		$time_string = sprintf( $time_string,
			get_the_date(DATE_W3C),
			get_the_date(),
			get_the_modified_date(DATE_W3C),
			get_the_modified_date()
		);
		// Wrap the time string in a link, and preface it with 'Posted on'
		return sprintf(
			__('<span class="screen-reader-text">Posted on</span> %s', 'pleiadesmoon'),
			'<a href="' . esc_url(get_permalink()) . '" rel="bookmark">' . $time_string . '</a>'
		);
	} //pleiadesmoon_time_link()
}

if (!function_exists('pleiadesmoon_entry_footer')) {
	// Prints HTML with meta information for the categories, tags and comments.
	function pleiadesmoon_entry_footer() {
		// translators: used between list items, there is a space after the comma
		$separate_meta = __(', ', 'pleiadesmoon');
		// Get Categories for posts
		$categories_list = get_the_category_list($separate_meta);
		// Get Tags for posts
		$tags_list = get_the_tag_list('', $separate_meta);

		if (((pleiadesmoon_categorized_blog() && $categories_list) || $tags_list ) || get_edit_post_link()) {
			echo '<footer class="entry-footer">';
				if ('post' === get_post_type()) {
					if (($categories_list && pleiadesmoon_categorized_blog()) || $tags_list) {
						echo '<span class="cat-tags-links">';
							// Make sure there's more than one category before displaying
							if ($categories_list && pleiadesmoon_categorized_blog()) {
								echo '<span class="cat-links">' . pleiadesmoon_get_svg( array('icon' => 'folder-open')) . '<span class="screen-reader-text">' . __( 'Categories', 'pleiadesmoon' ) . '</span>' . $categories_list . '</span>';
							}
							if ($tags_list) {
								echo '<span class="tags-links">' . pleiadesmoon_get_svg(array('icon' => 'hashtag')) . '<span class="screen-reader-text">' . __('Tags', 'pleiadesmoon') . '</span>' . $tags_list . '</span>';
							}
						echo '</span>';
					}
				}
				//pleiadesmoon_edit_link();
			echo '</footer> <!-- .entry-footer -->';
		}
	}
}

if (!function_exists('pleiadesmoon_edit_link')) :
function pleiadesmoon_edit_link() {
	$link = edit_post_link(
		sprintf(
			__('Edit<span class="screen-reader-text"> "%s"</span>', 'pleiadesmoon'),
			get_the_title()
		),
		'<span class="edit-link">',
		'</span>'
	);
	return $link;
}
endif;

function pleiadesmoon_front_page_section($partial = null, $id = 0) {
	if (is_a($partial, 'WP_Customize_Partial')) {
		global $pleiadesmoon;
		$id = str_replace('panel_', '', $partial->id);
		$pleiadesmooncounter = $id;
	}

	global $post; // Modify the global post object before setting up post data
	if (get_theme_mod('panel_' . $id)) {
		global $post;
		$post = get_post(get_theme_mod('panel_' . $id));
		setup_postdata($post);
		set_query_var('panel', $id);

		get_template_part('template-parts/page/content', 'front-page-panels');

		wp_reset_postdata();
	} elseif (is_customize_preview()) {
		// The output placeholder anchor.
		echo '<article class="panel-placeholder panel pleiadesmoon-panel pleiadesmoon-panel' . $id . '" id="panel' . $id . '"><span class="pleiadesmoon-panel-title">' . sprintf(__('Front Page Section %1$s Placeholder', 'pleiadesmoon'), $id) . '</span></article>';
	}
}

// Returns true if a blog has more than 1 category

function pleiadesmoon_categorized_blog() {
	$category_count = get_transient('pleiadesmoon_categories');
	if (false === $category_count) {
		// Create an array of all the categories that are attached to posts
		$categories = get_categories(array(
			'fields'     => 'ids',
			'hide_empty' => 1,
			// We only need to know if there is more than one category.
			'number'     => 2,
		));
		// Count the number of categories that are attached to the posts
		$category_count = count($categories);

		set_transient('pleiadesmoon_categories', $category_count);
	}
	return $category_count > 1;
} //pleiadesmoon_categorized_blog()

// Flush out the transients used in pleiadesmoon_categorized_blog
function pleiadesmoon_category_transient_flusher() {
	if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ) {
		return;
	}
	// Like, beat it. Dig?
	delete_transient('pleiadesmoon_categories');
}
add_action('edit_category', 'pleiadesmoon_category_transient_flusher' );
add_action('save_post',     'pleiadesmoon_category_transient_flusher' );
