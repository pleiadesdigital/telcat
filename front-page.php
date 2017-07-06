<?php /* The front page template file */ ?>
<?php get_header(); ?>

<div id="primary" class="content-area">
	<main id="main" class="site-main" role="main">

		<?php
			if (have_posts()) :	while (have_posts()) : the_post();
					get_template_part('template-parts/page/content', 'front-page');
			endwhile;	endif;
		?>

		<?php
		// Get each of our panels and show the post data
		if (0 !== pleiadesmoon_panel_count() || is_customize_preview()) : // If we have pages to show

			$num_sections = apply_filters('pleiadesmoon_front_page_sections', 4);
			global $pleiadesmooncounter;

			// Create a setting and control for each of the sections available in the theme
			for ($i = 1; $i < (1 + $num_sections); $i++) {
				$pleiadesmooncounter = $i;
				pleiadesmoon_front_page_section(null, $i);
			}
		endif;
		?>

	</main><!-- #main -->
</div><!-- #primary -->

<?php get_footer();
