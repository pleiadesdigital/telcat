<?php /* The Main Header for Pleiades Moon */ ?>
<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js no-svg">
	<!-- HEAD -->
	<head>
		<meta charset="<?php bloginfo('charset'); ?>">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="profile" href="http://gmpg.org/xfn/11">
		<?php wp_head(); ?>
	</head>
	<!-- BODY -->
	<body <?php body_class(); ?>>
	<div id="page" class="site">
		<a class="skip-link screen-reader-text" href="#content"><?php _e('Skip to content', 'pleiadesmoon'); ?></a>
		<!-- HEADER -->
		<header id="masthead" class="site-header <?php if (is_front_page()) { echo 'shfront'; } ?>" role="banner">

			<div class="site-header-wrapper">
				<?php get_template_part('template-parts/header/header', 'image'); ?>

				<?php if (has_nav_menu('top')) : ?>
				<div class="navigation-top">
					<div class="wrap">
						<?php get_template_part('template-parts/navigation/navigation', 'top'); ?>
					</div><!-- .wrap -->
				</div><!-- .navigation-top -->
				<?php endif; ?>

				<!-- SLIDER FRONT -->
			<?php if (is_front_page()) { ?>
				<section id="slider-front" class="slider-front">
						<div id="slider" class="flexslider">
							<ul class="slides">
								<li>
									<h1>comunicaciones en todas las capas</h1>
									<h2>el siguiente nivel de éxito</h2>
									<button class="slider-btn">Conozca más</button>
								</li>
							</ul><!-- class="slides" -->
						</div><!-- id="slider" class="flexslider" -->
				</section><!-- id="slider-front" class="slider-front" -->
			<?php } ?>
			</div><!-- class="site-header-wrapper -->

		</header><!-- id="masthead" class="site-header" -->

		<?php
		// If a regular post or page, and not the front page, show the featured image
		if (has_post_thumbnail() && (is_single() || (is_page() && !pleiadesmoon_is_frontpage())) && !is_page()) :
			echo '<div class="single-featured-image-header">';
			the_post_thumbnail('pleiadesmoon-featured-image');
			echo '</div><!-- .single-featured-image-header -->';
		endif;
		?>

		<div class="site-content-contain">
			<div id="content" class="site-content">
