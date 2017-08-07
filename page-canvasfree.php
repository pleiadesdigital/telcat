<?php /* Template Name: Canvas Free */ ?>

<!-- CONTENT PART GENERATOR -->
<?php
  if (is_page('contacto')) {
    $content_part = 'contacto';
  } elseif (is_page('acerca-de')) {
    $content_part = 'about';
  } elseif (is_page('soluciones') || $post->post_parent==34) {
    $content_part = 'soluciones';
  } elseif (is_page('catalogo')) {
    $content_part = 'catalogo';
  } elseif (is_page('portafolio')) {
    $content_part = 'portfolio';
  } else {
    $content_part = 'page';
  }
?>

<?php get_header(); ?>

<!-- <div class="wrap"> -->
  <div id="primary" class="canvasfree">
    <main id="main" class="site-main" role="main">
    <?php
      while (have_posts()) : the_post();
        get_template_part('template-parts/page/content', $content_part);
      endwhile;
    ?>
    </main><!-- #main -->
  </div><!-- #primary -->
<!-- </div>.wrap -->

<?php get_footer(); ?>