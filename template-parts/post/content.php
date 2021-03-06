<?php /* Template Part for displaying regular content posts */ ?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php
		if (is_sticky() && is_home()) :
			echo pleiadesmoon_get_svg(array('icon' => 'thumb-tack'));
		endif;
	?>
	<header class="entry-header">
		<?php
			if ('post' === get_post_type()) :
				echo '<div class="entry-meta">';
					if (is_single()) :
						pleiadesmoon_posted_on();
					else :
						echo pleiadesmoon_time_link();
						// pleiadesmoon_edit_link();
					endif;
				echo '</div><!-- .entry-meta -->';
			endif;
			if (is_single()) {
				the_title('<h1 class="entry-title">', '</h1>');
			} else {
				the_title('<h2 class="entry-title"><a href="' . esc_url(get_permalink()) . '" rel="bookmark">', '</a></h2>');
			}
		?>
	</header><!-- .entry-header -->

	<!-- POST THUMBNAIL -->
	<?php if ('' !== get_the_post_thumbnail() && !is_single()) : ?>
		<div class="post-thumbnail">
			<a href="<?php the_permalink(); ?>">
				<?php the_post_thumbnail('pleiadesmoon-featured-image'); ?>
			</a>
		</div><!-- .post-thumbnail -->
	<?php endif; ?>

	<div class="entry-content">
		<?php
			if (is_single()) {
				the_content(sprintf(
				__('Continue reading<span class="screen-reader-text"> "%s"</span>', 'pleiadesmoon'),
					get_the_title()
				));
			} else {
			the_excerpt();
		}
			wp_link_pages(array(
				'before'      => '<div class="page-links">' . __('Pages:', 'pleiadesmoon'),
				'after'       => '</div>',
				'link_before' => '<span class="page-number">',
				'link_after'  => '</span>',
			));
		?>
	</div><!-- .entry-content -->

	<?php if (is_single()) : ?>
		<?php pleiadesmoon_entry_footer(); ?>
	<?php endif; ?>

</article><!-- #post-## -->
