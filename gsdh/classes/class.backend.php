<?php

# CLASS BACKEND

class gsdh_backend{

	# CONSTRUCT
	public function __construct(){}

	# GET BACKEND PAGES
	public function gsdh_get_backend_pages(){

		$slug = $_POST['slug'];

		get_template_part( 'gsdh/includes/sub', $slug );

		exit();

	}

}