<?php /* The template for displaying all single posts */ ?>

<?php get_header(); ?>

<div class="wrap">
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
			<?php
				while (have_posts()) : the_post();
					get_template_part('template-parts/post/content', get_post_format());
					if (comments_open() || get_comments_number()) :
						comments_template();
					endif;
					the_post_navigation(array(
						'prev_text' => '<span class="screen-reader-text">' . __('Previous Post', 'pleiadesmoon') . '</span><span aria-hidden="true" class="nav-subtitle">' . __('Previous', 'pleiadesmoon') . '</span> <span class="nav-title"><span class="nav-title-icon-wrapper">' . pleiadesmoon_get_svg(array('icon' => 'arrow-left')) . '</span>%title</span>',
						'next_text' => '<span class="screen-reader-text">' . __('Next Post', 'pleiadesmoon') . '</span><span aria-hidden="true" class="nav-subtitle">' . __('Next', 'pleiadesmoon') . '</span> <span class="nav-title">%title<span class="nav-title-icon-wrapper">' . pleiadesmoon_get_svg( array('icon' => 'arrow-right')) . '</span></span>',
						'in_same_term'               => true
					));
				endwhile;
			?>

		</main><!-- #main -->
	</div><!-- #primary -->
	<?php get_sidebar(); ?>
</div><!-- .wrap -->

<?php get_footer();
