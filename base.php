<?php

use Roots\Sage\Setup;
use Roots\Sage\Wrapper;

?>

<!doctype html>
<html <?php language_attributes(); ?>>
  <?php get_template_part('templates/head'); ?>
  <body <?php body_class(); ?>>
    <!--[if IE]>
      <div class="alert alert-warning">
        <?php _e('You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.', 'sage'); ?>
      </div>
    <![endif]-->

    <!-- HEADER -->
    <?php
      do_action('get_header');
      get_template_part('templates/header');
    ?>

    <!-- SLIDER -->
    <?php if(is_front_page()){ ?>
        <?php get_template_part('templates/gsdh/slider'); ?>
        <?php

            # CURRENT PAGE ID
            $id = $post->ID;
            $impressum = get_page_by_title( 'Impressum' );

            # ARGUMENTS
            $args = array(
                'post_type' => 'page',
                'post__not_in' => array($id, $impressum->ID),
                'orderby' => 'menu_order',
                'posts_per_page' => -1,
                'order' => 'ASC',
                'offset' => 0
            );

            # QUERY POSTS
            query_posts($args);

            # LOOP PAGES
            if ( have_posts() ) :
                while ( have_posts() ) : the_post();
                    echo '<div id="'.get_permalink($post->ID).'"></div>';
                    echo '<div class="section-holder" data-href="'.get_permalink($post->ID).'">';
                        the_content();
                    echo '</div>';
                endwhile;
            endif;

            # RESET QUERY
            wp_reset_query();

        ?>
    <?php } else { ?>
        <?php include Wrapper\template_path(); ?>
    <?php } ?>

    <!-- FOOTER -->
    <?php
      do_action('get_footer');
      get_template_part('templates/footer');
      wp_footer();
    ?>

  </body>
</html>
