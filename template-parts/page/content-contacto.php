<?php /* Template PART for Contacto under page-canvasfree.php */ ?>


<!-- HEADER -->
<div class="page-header">
  <div class="page-header-wrap">
    <h1><?php echo the_title(); ?></h1>
  </div>
</div><!-- class="page-header" -->

<!-- MAP -->
<section class="google-map">
  <div class="google-map-wrap entry-content">
    <!-- MAP -->
    <div id="contact-map">
      <div id="map-canvas"></div>
    </div><!-- class="contact-map" -->
  </div><!-- .contact-map-wrap -->
</section>

<!-- MAIN CONTENT -->
<section class="contact-content entry-content">
  <div class="contact-content-wrap">
    <h2>Formulario de Contacto</h2>
    <?php the_content(); ?>
  </div><!-- .entry-content -->
</section>