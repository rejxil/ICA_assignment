<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends MY_Controller { //changing the name of welcome to website

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index() //TO HIDE CONTROL YOU REMOVE INDEX FILE
	{
		$this->load->view('welcome_message');
	}

	public function student_list()
	{
		$this->load->model('users_model');

		$data = array(
			'users'		=> $this->users_model->all_users()
		);

		// build the page
		$this->build('student_list', $data);
	}

	public function course()
	{
		$this->load->model('users_model');

		$data = array(
			'courses'		=> $this->users_model->all_courses()

		);

		$this->build('course_list', $data);

	}

	public function dropdown_array()
	{
		$this->load->model('users_model');

		$data = array(
			'list' => $this->users_model->course_array()
		);

		$this->build('student_form', $data);

	}

	public function student($submit = FALSE)
	{
		$this->load->model('users_model');

		// if the user submits the form, ignore the
        // rest of the function
        if ($submit == 'submit') {
            $this->form_submit();
            return;
        }

		$this->load->helper('form'); //DIN DEJJEM FORM UKOLL MINHABBA L-CODEIGNITER

		$data = array(
			'properties'	=> array(
				'action'	=> 'welcome/student/submit',
				'hidden'	=> NULL
			),

			'form' => $this->user_form(), //DIN DEJJEM 'FORM'
			'list' => $this->users_model->course_array()
		);

		$this->build('student_form', $data); //DIN SKONT L-ISEM TAL-FORM TIEGHEK, U TRID IZZID ID-DATA.
	}




	public function course_form($submit = FALSE)
	{
		$this->load->model('users_model');

		if ($submit == 'submit') {
            $this->form_submit();
            return;
        }

		$this->load->helper('form'); //DIN DEJJEM FORM UKOLL MINHABBA L-CODEIGNITER

		$data = array(
			'properties'	=> array(
			'action'		=> 'welcome/course_form/submit',
			'hidden'		=> NULL
		),

			'form' => $this->user_form() //DIN DEJJEM 'FORM'
	);



			$this->build('form_course', $data);
	}


	private function form_submit() {
		if ($this->input->method() != "post") {
			show_404();
			return;
		}

		$this->load->library('form_validation');

		$rules = array(
            array(
				'field' => 'name',
				'label' => 'First Name',
				'rules' => 'required|min_length[3]'
			),
            array(
				'field' => 'surname',
				'label' => 'Last Name',
				'rules' => 'required|min_length[3]'
			),
			array(
				'field' => 'id_number',
				'label' => 'ID_number',
				'rules' => 'required|is_unique[tbl_student.id_number]|min_length[7]'
			),
			array(
				'field' => 'email',
				'label' => 'email',
				'rules' => 'required|valid_email|is_unique[tbl_student.email]'
			),
			array(
				'field'	=> 'course_id',
				'label'	=>	'Course',
				'rules'	=>	'required'
			)
		);
		//prepare rules for validation of the form
		$this->form_validation->set_rules($rules);
		//check the form for validation issues
		if ($this->form_validation->run() === FALSE) {
			//echo validation_errors();
			$this->student();
			return;
		}

		$name 		= $this->input->post('name');
		$surname 	= $this->input->post('surname');
		$id_number	= $this->input->post('id_number');
		$email		= $this->input->post('email');
		$course_id	= $this->input->post('course_id');

		//load user_model to use its functions
		$this->load->model('users_model');

		$this->users_model->add_user($name, $surname, $id_number, $email, $course_id);

		echo "Form successfully submitted.";


	}

	private function user_form($user = NULL) {

		//if no information was provided, to BE SAFE
		//create an empty reference
		if ($user == NULL) {
			$user = array (
				'name'			=> NULL,
				'surname'		=> NULL,
				'id_number'		=> NULL,
				'email'			=> NULL
			);
		}

		return array(
			'name' => array(
				'type' 				=> 'text',
				'name' 				=> 'name',
				'placeholder' 		=> 'Francesco',
				'id' 				=> 'input-name',
				'required' 			=> TRUE,
				'value'				=> set_value('name', $user['name'])
			),
			'surname' => array(
				'type' 				=> 'text',
				'name' 				=> 'surname',
				'placeholder' 		=> 'Theuma',
				'id' 				=> 'input-surname',
				'required' 			=> TRUE,
				'value'				=> set_value('surname', $user['surname'])
			),
			'id_number' => array(
				'type' 				=> 'text',
				'name' 				=> 'id_number',
				'placeholder'		 => '79801005',
				'id' 				=> 'input-id_number',
				'required' 			=> TRUE,
				'value'				=> set_value('id_number', $user['id_number'])
				//set value works with 3 parameters.
				//the first parameter is the field.
			),
			'email' => array(
				'type' 					=> 'email',
				'name' 					=> 'email',
				'placeholder'			 => 'francescotc@cats.com',
				'id' 					=> 'input-email',
				'required' 				=> TRUE,
				'value'					=> set_value('email', $user['email'])
			)

			//ASK SIR HOW TO DO THIS FOR DROPDOWN
		);
	}
}
