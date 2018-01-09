<?php
# COMPOSER CONTROL CLASS
class gsdh_composer{

	# VARIABLES
	public $gsdh_content, $gsdh_array = [];

	# CONSTRUCT
	public function __construct(){

		# RUN HOOKS
		$this->gsdh_hooks();

		# CONTENT CLASS
		$this->gsdh_content = new gsdh_content();

	}

	public function gsdh_hooks(){
		
		////////////////////////////
		// ~ SET ROW ICON
		////////////////////////////

		$settings = array (
			'icon' => 'icon_element_row'
		);
		vc_map_update( 'vc_row', $settings );

		$settings = array (
			'icon' => 'icon_element_text_block'
		);
		vc_map_update( 'vc_column_text', $settings );

		$settings = array (
			'icon' => 'icon_element_icon'
		);
		vc_map_update( 'vc_icon', $settings );
		
		////////////////////////////
		// ~ REMOVE DEFAULTS
		////////////////////////////
				
		# REMOVE DEFAULT ELEMENTS
		add_filter( 'vc_build_admin_page', array($this,'gsdh_remove_default_elements'), 11 );

		# ACTION FOR REMOVING DEFAULT TEMPLATES
		add_filter( 'vc_load_default_templates', array($this, 'gsdh_my_custom_template_modify_array') );
		
		////////////////////////////
		// ~ ELEMENTS
		////////////////////////////

		# ACTION FOR ADDING CUSTOM ELEMENT
		add_action('vc_before_init', array($this, 'gsdh_element') );
		add_action('vc_before_init', array($this, 'gsdh_awards') );
		add_action('vc_before_init', array($this, 'gsdh_testimonials') );
		add_action('vc_before_init', array($this, 'gsdh_listings') );
		add_action('vc_before_init', array($this, 'gsdh_contact') );

		# ADD PARAMS
		//add_action('vc_before_init', array($this, 'gsdh_add_params')); // ~ HORIZONTAL LINE ELEMENT

		# REMOVE PARAMS
		add_action('vc_before_init', array($this, 'gsdh_remove_params')); // ~ HORIZONTAL LINE ELEMENT

		////////////////////////////
		// ~ TEMPLATES
		////////////////////////////

		#ACTION FOR ADDING A TEMPLATE
		add_filter( 'vc_load_default_templates', array($this, 'gsdh_home_template') );

	}

	/************************************************
	 * VISUAL COMPOSER NEW PARAMS
	 ************************************************/

	#ADD PARAMS
	public function gsdh_add_params(){

		#VC ROW PARAMS
		vc_add_param("vc_row", array(
			"type" => "dropdown",
			"class" => "",
			"heading" => "Padding (Row)",
			'category' => esc_html__( 'GSDH', 'js_composer' ),
			"param_name" => "row_padding",
			"value" => array(
				"None" => "gsdh_row_padding_none",
				"Top and Bottom" => "gsdh_row_padding_top_bottom",
				"Top Only" => "gsdh_row_padding_top",
				"Bottom Only" => "gsdh_row_padding_bottom",
			),
			'description' => esc_html__( 'Select the row padding (Top, Bottom)', 'js_composer' ),
		));

		vc_add_param("vc_row", array(
			"type" => "dropdown",
			"class" => "",
			"heading" => "Margin (Row)",
			'category' => esc_html__( 'GSDH', 'js_composer' ),
			"param_name" => "row_margin",
			"value" => array(
				"None" => "gsdh_row_margin_none",
				"Top and Bottom" => "gsdh_row_margin_top_bottom",
				"Top Only" => "gsdh_row_margin_top",
				"Bottom Only" => "gsdh_row_margin_bottom",
			),
			'std' => 'gsdh_row_margin_top_bottom',
			'description' => esc_html__( 'Select the row margin (Top, Bottom)', 'js_composer' ),
		));

	}

	#REMOVE PARAMS
	public function gsdh_remove_params(){

		#VC ROW PARAMS REMOVE
		//	vc_remove_param( "vc_row", "gap" );
		//	vc_remove_param( "vc_row", "full_height" );
		//	vc_remove_param( "vc_row", "equal_height" );
		//	vc_remove_param( "vc_row", "content_placement" );
		//	vc_remove_param( "vc_row", "columns_placement" );
		//	vc_remove_param( "vc_row", "video_bg" );
		//	vc_remove_param( "vc_row", "parallax" );
		//	vc_remove_param( "vc_row", "el_id" );
		//	vc_remove_param( "vc_row", "el_class" );
		//	vc_remove_param( "vc_row", "video_bg_url" );
		//	vc_remove_param( "vc_row", "video_bg_parallax" );
		//	vc_remove_param( "vc_row", "gallery_widget_attached_images_ids" );
		//	vc_remove_param( "vc_row", "parallax_speed_bg" );
		//	vc_remove_param( "vc_row", "parallax_speed_video" );
		//	vc_remove_param( "vc_row", "parallax_image" );

	}

	/************************************************
	 * VISUAL COMPOSER ELEMENTS
	 ************************************************/
	
	# BASIC ELEMENT
	public function gsdh_element(){
		
		//SETUP VC MAP
		vc_map(
			array(
				"name" => esc_html__( "Basic Element", "js_composer" ),
				"base" => "gsdh_shortcode_element",
				"class" => "",
				'icon' => 'gsdh_icon_element',
				"category" => esc_html__( "GSDH", "js_composer"),
				'description' => esc_html__( "Basic element for the current site.", "js_composer" ),
				"params" => array(
					array(
						"type" => "attach_images",
						"holder" => "div",
						"class" => "gsdh_element_class",
						"heading" => esc_html__( "Images", "js_composer" ),
						"param_name" => "gsdh_images",
						"value" => __( "", "js_composer" ),
						"description" => esc_html__( "Add multiple images for you image carousel.", "js_composer" )
					),
					array(
						"type" => "dropdown",
						"holder" => "div",
						"class" => "gsdh_element_class",
						"heading" => esc_html__( "Image background sizing", "js_composer" ),
						"param_name" => "gsdh_size",
						"value" => array(
							'Contain' => 'contain',
							'Cover' => 'cover',
							'Auto' => 'auto'
						),
						'std' => '',
						"description" => esc_html__( "Choose the image sizing.", "js_composer" ),
					),
					array(
						"type" => "dropdown",
						"holder" => "div",
						"class" => "gsdh_element_class",
						"heading" => esc_html__( "Carousel height", "js_composer" ),
						"param_name" => "gsdh_height",
						"value" => array(
							'100px'   => 100,
							'200px'   => 200,
							'300px'   => 300,
							'400px'   => 400,
							'500px'   => 500,
						),
						'std' => '',
						"description" => esc_html__( "Set the height for your image carousel.", "js_composer" ),
					),
				)
			)
		);
		
	}
	
	# BASIC ELEMENT SHORTCODE FUNCTION
	function gsdh_shortcode_element( $atts ) {
		
		# SETUP CONTENT CLASS
		$gsdh_data = $this->gsdh_content->gsdh_element($atts);
		
		# RETURN DATA/HTML
		echo $gsdh_data;
		
	}

    # CONTACT ELEMENT
    public function gsdh_contact(){

        # SETUP VC MAP
        vc_map(
            array(
                "name" => esc_html__( "Contact", "js_composer" ),
                "base" => "gsdh_shortcode_contact",
                "class" => "",
                'icon' => 'gsdh_icon_contact',
                "category" => esc_html__( "GSDH", "js_composer"),
                'description' => esc_html__( "Display the contact icons.", "js_composer" ),
                "params" => array(
                    array(
                        "type" => "",
                        "holder" => "div",
                        "class" => "",
                        "heading" => __( "Contact Icons", "gsdh" ),
                        "param_name" => "foo",
                        "value" => __( "This is test param for creating new project", "gsdh" ),
                        "description" => __( "This VC element will add 3 icons to the page.", "gsdh" )
                    )
                )
            )
        );

    }

    # CONTACT SHORTCODE
    function gsdh_shortcode_contact( $atts ) {

        # SETUP CONTENT CLASS
        $gsdh_data = $this->gsdh_content->gsdh_contact($atts);

        # RETURN DATA/HTML
        echo $gsdh_data;

    }

    # AWARDS ELEMENT
    public function gsdh_awards(){

        # SETUP VC MAP
        vc_map(
            array(
                "name" => esc_html__( "Awards", "js_composer" ),
                "base" => "gsdh_shortcode_awards",
                "class" => "",
                'icon' => 'gsdh_icon_awards',
                "category" => esc_html__( "GSDH", "js_composer"),
                'description' => esc_html__( "Display all the awards on a page.", "js_composer" ),
                "params" => array(
                    array(
                        "type" => "",
                        "holder" => "div",
                        "class" => "",
                        "heading" => __( "Awards", "gsdh" ),
                        "param_name" => "foo",
                        "value" => __( "This is test param for creating new project", "gsdh" ),
                        "description" => __( "This VC element grabs data from the awards post-type.", "gsdh" )
                    )
                )
            )
        );

    }

    # AWARDS SHORTCODE
    function gsdh_shortcode_awards( $atts ) {

        # SETUP CONTENT CLASS
        $gsdh_data = $this->gsdh_content->gsdh_awards($atts);

        # RETURN DATA/HTML
        echo $gsdh_data;

    }

    # TESTIMONIALS ELEMENT
    public function gsdh_testimonials(){

        # SETUP VC MAP
        vc_map(
            array(
                "name" => esc_html__( "Testimonials", "js_composer" ),
                "base" => "gsdh_shortcode_testimonials",
                "class" => "",
                'icon' => 'gsdh_icon_testimonials',
                "category" => esc_html__( "GSDH", "js_composer"),
                'description' => esc_html__( "Display all the awards on a page.", "js_composer" ),
                "params" => array(
                    array(
                        "type" => "",
                        "holder" => "div",
                        "class" => "",
                        "heading" => __( "Testimonials", "gsdh" ),
                        "param_name" => "foo",
                        "value" => __( "This is test param for creating new project", "gsdh" ),
                        "description" => __( "This VC element grabs data from the testimonials post-type.", "gsdh" )
                    )
                )
            )
        );

    }

    # TESTIMONIALS SHORTCODE
    function gsdh_shortcode_testimonials( $atts ) {

        # SETUP CONTENT CLASS
        $gsdh_data = $this->gsdh_content->gsdh_testimonials($atts);

        # RETURN DATA/HTML
        echo $gsdh_data;

    }

    # LISTINGS ELEMENT
    public function gsdh_listings(){

        # SETUP VC MAP
        vc_map(
            array(
                "name" => esc_html__( "Top Listings", "js_composer" ),
                "base" => "gsdh_shortcode_listings",
                "class" => "",
                'icon' => 'gsdh_icon_listings',
                "category" => esc_html__( "GSDH", "js_composer"),
                'description' => esc_html__( "Display all the awards on a page.", "js_composer" ),
                "params" => array(
                    array(
                        "type" => "",
                        "holder" => "div",
                        "class" => "",
                        "heading" => __( "Top Listings", "gsdh" ),
                        "param_name" => "foo",
                        "value" => __( "This is test param for creating new project", "gsdh" ),
                        "description" => __( "This VC element grabs data from the listings post-type.", "gsdh" )
                    )
                )
            )
        );

    }

    # LISTINGS SHORTCODE
    function gsdh_shortcode_listings( $atts ) {

        # SETUP CONTENT CLASS
        $gsdh_data = $this->gsdh_content->gsdh_listings($atts);

        # RETURN DATA/HTML
        echo $gsdh_data;

    }

	/************************************************
	 * VISUAL COMPOSER REMOVE ELEMENTS
	 ************************************************/

	#REMOVE DEFAULTS
	public function gsdh_remove_default_elements(){

        vc_remove_element("vc_cta_button2");
        vc_remove_element("vc_button2");
        vc_remove_element("vc_masonry_media_grid");
        vc_remove_element("vc_masonry_grid");
        vc_remove_element("vc_masonry_grid");
        vc_remove_element("vc_media_grid");
        vc_remove_element("vc_basic_grid");
        vc_remove_element("vc_cta");
        vc_remove_element("vc_btn");
        //vc_remove_element("vc_custom_heading");
        vc_remove_element("vc_empty_space");
        vc_remove_element("vc_line_chart");
        vc_remove_element("vc_round_chart");
        vc_remove_element("vc_pie");
        vc_remove_element("vc_raw_js");
        vc_remove_element("vc_raw_html");
        vc_remove_element("vc_video");
        vc_remove_element("vc_widget_sidebar");
        vc_remove_element("vc_tta_pageable");
        vc_remove_element("vc_tta_accordion");
        vc_remove_element("vc_tta_tour");
        vc_remove_element("vc_tta_tabs");
        vc_remove_element("vc_gallery");
        vc_remove_element("vc_gallery");
        vc_remove_element("vc_text_separator");
        vc_remove_element("vc_button");
        vc_remove_element("vc_posts_slider");
        vc_remove_element("vc_gmaps");
        vc_remove_element("vc_teaser_grid");
        vc_remove_element("vc_progress_bar");
        vc_remove_element("vc_facebook");
        vc_remove_element("vc_tweetmeme");
        vc_remove_element("vc_googleplus");
        vc_remove_element("vc_facebook");
        vc_remove_element("vc_pinterest");
        vc_remove_element("vc_message");
        vc_remove_element("vc_posts_grid");
        vc_remove_element("vc_carousel");
        vc_remove_element("vc_flickr");
        vc_remove_element("vc_tour");
        vc_remove_element("vc_separator");
        //vc_remove_element("vc_single_image");
        vc_remove_element("vc_cta_button");
        vc_remove_element("vc_accordion");
        vc_remove_element("vc_accordion_tab");
        vc_remove_element("vc_toggle");
        vc_remove_element("vc_tabs");
        vc_remove_element("vc_tab");
        vc_remove_element("vc_images_carousel");
        vc_remove_element("vc_wp_archives");
        vc_remove_element("vc_wp_calendar");
        vc_remove_element("vc_wp_categories");
        vc_remove_element("vc_wp_custommenu");
        vc_remove_element("vc_wp_links");
        vc_remove_element("vc_wp_meta");
        vc_remove_element("vc_wp_pages");
        vc_remove_element("vc_wp_posts");
        vc_remove_element("vc_wp_recentcomments");
        vc_remove_element("vc_wp_rss");
        vc_remove_element("vc_wp_search");
        vc_remove_element("vc_wp_tagcloud");
        vc_remove_element("vc_wp_text");
        vc_remove_element("woocommerce_cart");
        vc_remove_element("woocommerce_checkout");
        vc_remove_element("woocommerce_order_tracking");
        vc_remove_element("woocommerce_my_account");
        vc_remove_element("recent_products");
        vc_remove_element("featured_products");
        vc_remove_element("product");
        vc_remove_element("products");
        vc_remove_element("add_to_cart");
        vc_remove_element("add_to_cart_url");
        vc_remove_element("product_page");
        vc_remove_element("product_category");
        vc_remove_element("product_categories");
        vc_remove_element("sale_products");
        vc_remove_element("best_selling_products");
        vc_remove_element("top_rated_products");
        vc_remove_element("product_attribute");

	}

	#REMOVE ALL DEFAULT TEMPLATES
	public function gsdh_my_custom_template_modify_array( $data ) {
		return array();
	}

	/************************************************
	 * VISUAL COMPOSER TEMPLATES
	 ************************************************/

	#HOME TEMPLATE
	function gsdh_home_template( $data ) {
		$template               = array();
		$template['name']       = __( 'Home Template', 'gsdh' ); // Assign name for your custom template
		$template['image_path'] = preg_replace( '/\s/', '%20', plugins_url( 'images/custom_template_thumbnail.jpg', __FILE__ ) ); // Always use preg replace to be sure that "space" will not break logic. Thumbnail should have this dimensions: 114x154px.
		$template['custom_class'] = 'custom_template_for_vc_custom_template'; // CSS class name
		$template['content']    = '[ CONTENT FOR TEMPLATE ]';
		array_unshift( $data, $template );
		return $data;
	}

	/************************************************
	 * AUTOCOMPLETE FUNCTIONS
	 ************************************************/

	# AUTOCOMPLETE
	public function gsdh_autocomplete() {

		#ARGUMENTS
		$args = array(
			'taxonomy'     => 'product_cat',
			'orderby'      => 'name',
			'show_count'   => 1,
			'pad_counts'   => 1,
			'hierarchical' => 0,
			'hide_empty'   => 1
		);

		#GET CATEGORIES
		$the_categories = get_categories($args);

		#ARRAY
		$result = array();

		#SETUP RESULTS
		foreach ( $the_categories as $term )	{
			$result[] = array(
				'value' => $term->term_id,
				'label' => $term->name,
			);
		}

		#RETURN RESULTS
		return $result;

	}

}