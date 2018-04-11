<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller {

	// this will load right before the
	// controllers we have in controllers/

	// magic method
	// is called/used when the class loads
	function __construct() {

		// REQUIRED
		// load the parent into its child
		// will add the plugins from autoload
		parent::__construct();

	}

	// We can use this to replace $this->load->view
	function build($pages = NULL, $data = NULL) {

		$start = array(
			'nav'		=> $this->nav_links()
		);

		$this->load->view('templates/start', $start);
		$this->load->view($pages, $data);
		$this->load->view('templates/end');

	}

	// Use an associative array for the navigation

	function nav_links() {
		return array(
			'Home'			=> 'welcome/index',
			'Student Form'	=> 'welcome/student',
			'Course Form'	=> 'welcome/course_form',
			'Student List'	=> 'welcome/student_list',
			'Course List'	=> 'welcome/course'
		);
	}


}
