<?php
		
	# SHORTCODES
	class gsdh_shortcodes{

		# CONSTRUCT
		public function __construct(){

			# INSTANTIATE CLASS
			if ( defined( 'WPB_VC_VERSION' ) && class_exists('gsdh_content')) {
				$this->content_shortcodes();
			}

		}
		
		# GET CONTENT SHORTCODES
		public function content_shortcodes(){

			$gsdh_composer = new gsdh_composer();

			add_shortcode( 'gsdh_shortcode_element', array($gsdh_composer, 'gsdh_shortcode_element') );
			add_shortcode( 'gsdh_shortcode_awards', array($gsdh_composer, 'gsdh_shortcode_awards') );
			add_shortcode( 'gsdh_shortcode_testimonials', array($gsdh_composer, 'gsdh_shortcode_testimonials') );
			add_shortcode( 'gsdh_shortcode_listings', array($gsdh_composer, 'gsdh_shortcode_listings') );
			add_shortcode( 'gsdh_shortcode_contact', array($gsdh_composer, 'gsdh_shortcode_contact') );

		}

	}