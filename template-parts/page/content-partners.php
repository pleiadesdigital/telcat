<?php /* Template PART for Portafolio under page-canvasfree.php */ ?>


<!-- HEADER -->
<div class="page-header">
  <div class="page-header-wrap">
    <h1><?php echo the_title(); ?></h1>
  </div>
</div><!-- class="page-header" -->


<!-- MAIN CONTENT -->
<section class="portfolio-content entry-content">
  <div class="portfolio-content-wrap">
    <div class="portfolio-text">
      <?php the_content(); ?>
    </div><!-- class="portfolio-text" -->
  </div><!-- class="portfolio-content-wrap" -->
</section><!-- class="portfolio-content entry-content" -->

<!-- PORTAFOLIO CUBES -->
<section class="portfolio-cubes">
  <div class="portfolio-cubes-wrap">
  <?php
    $args = array(
      'post_type'       => 'post',
      'cat'             => 8,
      'order'         => 'asc'
    );
    $query = new WP_Query($args);
  ?>
    <ul class="cubes">
    <?php if ($query->have_posts()) : while ($query->have_posts()) : $query->the_post(); ?>
      <li>
        <h2><?php the_title(); ?></h2>
        <?php the_post_thumbnail(); ?>
        <?php the_content(); ?>
        <h6>Gestión: <?php echo get_post_meta($post->ID, 'gestion', true); ?></h6>
      </li>
    <?php endwhile; endif; ?>
    </ul> <!-- class="cubes" -->
    <?php wp_reset_postdata(); ?>
  </div><!-- class="portfolio-cubes-wrap" -->
</section><!-- class="portafolio-cubes" -->


