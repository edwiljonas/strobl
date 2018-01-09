<?php

# CLASS AJAX

class gsdh_ajax{

	# VARIABLES
	public $gsdh_ajax_calls_array;
	public $gsdh_ajax_frontend_calls_array;
	public $gsdh_ajax_frontend_forms_array;
	public $gsdh_ajax_frontend_array;
	public $backend;
	public $frontend;

	# CONSTRUCT
	public function __construct($backend, $frontend){

		# GET ARRAY DATA
		$this->gsdh_ajax_calls_array = $this->gsdh_get_ajax_calls();

		# GET FORMS DATA
		$this->gsdh_ajax_frontend_forms_array = $this->gsdh_get_forms_ajax_calls();

        # GET FRONTEND DATA
        $this->gsdh_ajax_frontend_array = $this->gsdh_get_frontend_ajax_calls();

		# SET ADMIN BACKEND CALL IDENTIFIER
		$this->backend = $backend;
		//$this->forms = $forms;
        $this->frontend = $frontend;

		# ADD ACTIONS
		$this->gsdh_set_ajax_calls();
		$this->gsdh_set_forms_ajax_calls();
        $this->gsdh_set_frontend_ajax_calls();

	}

	# ADD AJAX HOOKS
	public function gsdh_set_ajax_calls() {

		# ADD AJAX CALL ACTION
		if(isset($this->gsdh_ajax_calls_array) && count($this->gsdh_ajax_calls_array) > 0){
			foreach($this->gsdh_ajax_calls_array as $call){
				add_action( 'wp_ajax_'. $call['action'], array(&$this->backend, $call['method']) );
			}
		}

	}

	public function gsdh_get_ajax_calls(){

		# ADMIN AJAX ARRAY CALLS
		$array = array(
			array('action' => 'gsdh_object_save','method' => 'gsdh_save_options'),
			array('action' => 'gsdh_object_get','method' => 'gsdh_get_options'),
			array('action' => 'gsdh_set_page_shortcode','method' => 'gsdh_set_page_shortcode'),
		);

		# RETURN
		return $array;

	}

	# ADD FORMS AJAX HOOKS
	public function gsdh_set_forms_ajax_calls() {

		# ADD AJAX CALL ACTION
		if(isset($this->gsdh_ajax_frontend_forms_array) && count($this->gsdh_ajax_frontend_forms_array) > 0){
			foreach($this->gsdh_ajax_frontend_forms_array as $call){
				add_action('wp_ajax_'. $call['action'], array(&$this->forms, $call['method']));
				add_action('wp_ajax_nopriv_'. $call['action'], array(&$this->forms, $call['method']));
			}
		}

	}

	# LIST OF AJAX CALLS
	public function gsdh_get_forms_ajax_calls(){

		# FRONT END AJAX ARRAY CALLS
		$array = array(
			array('action' => 'gsdh_check_forms','method' => 'gsdh_check_forms'),
		);

		# RETURN
		return $array;

	}

    # ADD FRONTEND AJAX HOOKS
    public function gsdh_set_frontend_ajax_calls() {

        # ADD AJAX CALL ACTION
        if(isset($this->gsdh_ajax_frontend_array) && count($this->gsdh_ajax_frontend_array) > 0){
            foreach($this->gsdh_ajax_frontend_array as $call){
                add_action('wp_ajax_'. $call['action'], array(&$this->frontend, $call['method']));
                add_action('wp_ajax_nopriv_'. $call['action'], array(&$this->frontend, $call['method']));
            }
        }

    }

    # LIST OF AJAX CALLS
    public function gsdh_get_frontend_ajax_calls(){

        # FRONT END AJAX ARRAY CALLS
        $array = array(
            array('action' => 'gsdh_booking','method' => 'gsdh_booking'),
            array('action' => 'gsdh_request','method' => 'gsdh_request'),
        );

        # RETURN
        return $array;

    }

}