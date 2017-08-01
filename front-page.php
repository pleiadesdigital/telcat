<?php /* The front page template file */ ?>
<?php get_header(); ?>

<div id="primary" class="content-area">
	<main id="main" class="site-main" role="main">


    <!-- PRODUCTOS Y SERVICIOS -->
		<div id="prod-services-main" class="prod-services-main">
      <div class="prod-services">
        <?php
          $query = new WP_Query('pagename=soluciones');
          $soluciones_id = $query->queried_object->ID;
          $args = array(
            'post_type'         => 'page',
            'post_parent'       => $soluciones_id,
            'post_per_page'     => 4,
            'post_status'       => 'publish',
            'order'             => 'ASC'
          );
          $soluciones_query = new WP_Query($args);
        ?>
        <h2>Soluciones</h2>
        <ul class="servicios">
        <?php if ($soluciones_query->have_posts()) : ?>
        <?php while ($soluciones_query->have_posts()) : ?>
        <?php $soluciones_query->the_post(); ?>
          <li>
            <div class="serv-icon">
              <a href="<?php the_permalink(); ?>"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/icons/<?php echo get_post_meta($post->ID, 'icon', true);?>.png" alt="<?php the_title(); ?>"></a>
            </div><!-- class="serv-icon" -->
            <div class="serv-text">
              <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
              <p><?php the_excerpt(); ?></p>
            </div><!-- class="serv-text" -->
          </li>
        <?php endwhile; endif; ?>
        </ul><!-- class="servicios" -->

      </div><!-- class="prod-services" -->
    </div><!-- id="prod-services-main" class="prod-services-main" -->

    <!-- POR QUÉ TELCAT -->
    <div class="fp-credibility">
      <div class="fp-credibility-wrap">
        <h2>Por qué elegir a nuestra empresa</h2>
        <p><span class="bold">Telcat Innovations</span> ofrece soluciones para la conceptualización, ingeniería, diseño e implementación de proyectos integrales para ambientes críticos 24 horas al día y 7 días a la semana.</p>
      </div>
    </div><!-- class="fp-credibility" -->

    <!-- NOTICIAS / ARTICULOS -->
    <div class="fp-blog">
      <div class="fp-blog-wrap">
        <h2>Blog de Artículos y Noticias</h2>
        <?php
          $args = array(
            'cat'             => 5,
            'post_per_page'   => 3,
            'orderby'         => 'asc'
          );
          $query = new WP_Query($args);
        ?>
        <ul class="blog-list">
          <?php if ($query->have_posts()) : while ($query->have_posts()) : $query->the_post(); ?>
          <li>
            <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('frontpage-blog'); ?></a>
            <h3><?php the_title(); ?></h3>
            <?php the_excerpt(); ?>
          </li>
        <?php endwhile; endif; ?>
        </ul><!-- class="blog-list" -->
        <?php wp_reset_postdata(); ?>
      </div><!-- class="fp-blog-wrap" -->
    </div><!-- class="fp-blog" -->



	</main><!-- #main -->
</div><!-- #primary -->

<?php get_footer();
