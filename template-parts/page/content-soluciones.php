<?php /* Template PART for Soluciones under page-canvasfree.php */ ?>


<!-- HEADER -->
<div class="page-header">
  <div class="page-header-wrap">
    <h1>Soluci&oacute;n: <span><?php echo the_title(); ?></span></h1>
  </div>
</div><!-- class="page-header" -->


<!-- MAIN CONTENT -->
<section class="solution-content entry-content">
  <div class="solution-content-wrap">

    <div class="solution-img">
      <img src="<?php echo get_template_directory_uri(); ?>/assets/images/soluciones/<?php echo get_post_meta($post->ID, 'solucion-content-img', true); ?>">


      </div><!-- class="solution-img" -->
    <div class="solution-text"><?php the_content(); ?></div>
  </div><!-- class="solution-content-wrap" -->
</section><!-- class="solution-content entry-content" -->

<!-- HISTORIA -->
<?php $post_slug = $post->post_name; //retrieves the slug ?>
<section class="solution-cta entry-content <?php echo $post_slug; ?>">
  <div class="solution-cta-wrap">
    <div class="cta-content">
      <h1><?php echo get_post_meta($post->ID, 'solucion-promo', true); ?></h1>
      <h2><?php echo get_post_meta($post->ID, 'solucion-promo2', true); ?></h2>
      <button class="slider-btn"><a href="http://telcatinnova.com/contacto/">Contáctenos</a></button>
    </div><!-- class="cta-content" -->
  </div><!-- .entry-content -->
</section>