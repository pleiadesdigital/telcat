<?php /* Template part for displaying posts with excerpts */ ?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<header class="entry-header">
		<?php if ('post' === get_post_type()) : ?>
			<div class="entry-meta">
				<?php
					echo pleiadesmoon_time_link();
					pleiadesmoon_edit_link();
				?>
			</div><!-- .entry-meta -->
		<?php elseif ('page' === get_post_type() && get_edit_post_link()) : ?>
			<div class="entry-meta">
				<?php pleiadesmoon_edit_link(); ?>
			</div><!-- .entry-meta -->
		<?php endif; ?>
		<?php if (is_front_page() && !is_home()) {
			the_title(sprintf('<h3 class="entry-title"><a href="%s" rel="bookmark">', esc_url(get_permalink())), '</a></h3>');
		} else {
			the_title(sprintf('<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url(get_permalink())), '</a></h2>');
		} ?>
	</header><!-- .entry-header -->

	<div class="entry-summary">
		<?php the_excerpt(); ?>
	</div><!-- .entry-summary -->

</article><!-- #post-## -->
