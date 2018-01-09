<?php
# GET CONTENT
class gsdh_content{

	# CONSTRUCT
	public function __construct(){
	}

	# ELEMENT
	public function gsdh_element($atts){
		
		?>
            GSDH ELEMENT
        <?php
		
	}

    # CONTACT
    public function gsdh_contact($atts){

        ?>
            <div class="col-md-12 contact-icons">
                <div class="contact-inner">
                    <a href="mailto:info@immobilien-strobl.de" class="icon dashicons-before dashicons-email-alt">
                        <div class="custom-tooltip">SCHREIBEN SIE UNS EINE EMAIL</div>
                    </a>
                    <a target="_blank" href="https://www.google.co.za/maps/place/PETER+STROBL+Immobilien+KG/@48.0394532,11.5196096,17z/data=!3m1!4b1!4m5!3m4!1s0x479ddc72aae5caef:0xfbfb8f049a663089!8m2!3d48.0394496!4d11.5217983?hl=en" class="icon dashicons-before dashicons-location">
                        <div class="custom-tooltip">HIER FINDEN<br> SIE UNS</div>
                    </a>
                    <a href="tel:+49 89 6 41 88 10" class="icon dashicons-before dashicons-phone">
                        <div class="custom-tooltip">RUFEN SIE UNS AN</div>
                    </a>
                </div>
            </div>
        <?php

    }

    # AWARDS
    public function gsdh_awards($atts){

        global $post;
        setup_postdata( $post );

        # ARGUMENTS
        $args = array(
            'post_type' => 'awards',
            'orderby' => 'menu_order',
            'posts_per_page' => -1,
            'order' => 'ASC',
            'offset' => 0
        );

        $query_two = new WP_Query($args);

        # LOOP PAGES
        if ( $query_two->have_posts() ) :

            ?>
            <div class="enable-content-owl owl-content" data-view="3">
                <?php

                while ( $query_two->have_posts() ) : $query_two->the_post();

                    #DATA
                    $prefix = 'awards_';
                    $image = get_post_meta($post->ID, 'gsdh_' . $prefix . 'image', true);
                    $imageSrc = wp_get_attachment_image_src( $image, 'large' );

                    ?>

                    <div class="item">
                        <div class="award_item" style="background-image: url(<?php echo esc_url($imageSrc[0]); ?>);">

                        </div>
                    </div>

                    <?php

                endwhile;

                ?>
            </div>
            <?php

        endif;

    }

    # TESTIMONIALS
    public function gsdh_testimonials($atts){

        global $post;
        setup_postdata( $post );

        # ARGUMENTS
        $args = array(
            'post_type' => 'testimonials',
            'orderby' => 'menu_order',
            'posts_per_page' => -1,
            'order' => 'ASC',
            'offset' => 0
        );

        $query_two = new WP_Query($args);

        # LOOP PAGES
        if ( $query_two->have_posts() ) :

            ?>
            <div class="enable-content-owl owl-content" data-view="1">
                <?php

                while ( $query_two->have_posts() ) : $query_two->the_post();

                    #DATA
                    $prefix = 'testimonials_';
                    $imageSrc = wp_get_attachment_image_src ( get_post_thumbnail_id ( $post->ID ), 'large' );

                    ?>

                    <div class="item">
                        <div class="testimonial_item">
                            <div class="container">
                                <div class="row">
                                    <div class="testimonial_image col-md-6" style="background-image: url(<?php echo esc_url($imageSrc[0]); ?>);"></div>
                                    <div class="col-md-6">
                                        <h2>Referenzen
                                            <span class="reference"><?php the_title(); ?></span>
                                        </h2>
                                        <?php the_content(); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <?php

                endwhile;

                ?>
            </div>
            <?php

        endif;

    }

    # LISTINGS
    public function gsdh_listings($atts){

        global $post;
        setup_postdata( $post );

        # ARGUMENTS
        $args = array(
            'post_type' => 'listings',
            'orderby' => 'menu_order',
            'posts_per_page' => -1,
            'order' => 'ASC',
            'offset' => 0
        );

        $query_two = new WP_Query($args);

        # LOOP PAGES
        if ( $query_two->have_posts() ) :

            ?>
            <div class="enable-content-owl owl-content" data-view="3">
            <?php

            while ( $query_two->have_posts() ) : $query_two->the_post();

                #DATA
                $prefix = 'listings_';
                $title = get_post_meta($post->ID, 'gsdh_' . $prefix . 'title', true);
                $image = get_post_meta($post->ID, 'gsdh_' . $prefix . 'image', true);
                $imageSrc = wp_get_attachment_image_src( $image, 'large' );

                ?>

                    <div class="item">
                        <div class="listing_item" style="background-image: url(<?php echo esc_url($imageSrc[0]); ?>);">
                            <div class="list_box_left"></div>
                            <div class="list_box_right"></div>
                            <div class="listing_title">
                                <?php echo esc_html($title); ?>
                            </div>
                        </div>
                    </div>

                <?php

            endwhile;

            ?>
            </div>
            <?php

        endif;

    }

	# GENERATE UNIQUE
	public function gsdh_genGUID(){
		return sprintf('%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
			mt_rand(0, 0xffff), mt_rand(0, 0xffff), mt_rand(0, 0xffff),
			mt_rand(0, 0x0fff) | 0x4000,
			mt_rand(0, 0x3fff) | 0x8000,
			mt_rand(0, 0xffff), mt_rand(0, 0xffff), mt_rand(0, 0xffff)
		);
	}

}