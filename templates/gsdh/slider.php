<div class="top-wrap">
    <div class="top-slider enable-owl">
        <?php

        # ARGUMENTS
        $args = array(
            'post_type' => 'slides',
            'orderby' => 'menu_order',
            'posts_per_page' => -1,
            'order' => 'ASC',
            'offset' => 0
        );

        # QUERY POSTS
        $query_slides = new WP_Query($args);

        # LOOP
        if ( $query_slides->have_posts() ) :
            while ( $query_slides->have_posts() ) : $query_slides->the_post();

                #DATA
                $prefix = 'slides_';
                $image = get_post_meta($post->ID, 'gsdh_' . $prefix . 'image', true);
                $bg = get_post_meta($post->ID, 'gsdh_' . $prefix . 'bg', true);
                $imageSrc = wp_get_attachment_image_src( $image, 'large' );

                ?>

                <div class="item" data-bg="<?php echo $bg; ?>">
                    <div class="container">
                        <div class="slider-img" style="background-image: url(<?php echo esc_url($imageSrc[0]); ?>);"></div>
                    </div>
                </div>

                <?php

            endwhile;
        endif;

        # RESET QUERY
        wp_reset_query();

        ?>
    </div>
    <div class="top-form">
        <div class="container">
            <div class="form-holder">
                <div class="form-loader">
                    <div id="loader">
                        <div id="shadow"></div>
                        <div id="box"></div>
                    </div>
                </div>
                <div class="form-title show-on-mobile">
                    <img src="<?php echo esc_url( get_template_directory_uri() ); ?>/dist/images/frontend/activ.png" height="60">
                    <h5>
                        SIE WOLLEN EINE IMMOBILIE VERMIETEN?
                        <span>BEI UNS SIND SIE RICHTIG.</span>
                    </h5>
                </div>
                <div class="form-nav">
                    <div class="icon dashicons-before dashicons-email-alt active-form-nav" data-form="booking"></div>
                    <div class="icon dashicons-before dashicons-admin-home" data-form="info"></div>
                    <div class="icon dashicons-before dashicons-phone" data-form="request"></div>
                </div>
                <div class="all-forms">
                    <div class="form-item" id="booking">
                        <?php get_template_part('templates/gsdh/form', 'booking'); ?>
                    </div>
                    <div class="form-item" id="info">
                        <?php get_template_part('templates/gsdh/form', 'info'); ?>
                    </div>
                    <div class="form-item" id="request">
                        <?php get_template_part('templates/gsdh/form', 'request'); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>