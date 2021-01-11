<?php
Class Course extends CI_Controller {
    public function __construct() {
		parent::__construct();

		// Load form helper library
		$this->load->helper('form');

		// Load form validation library
		$this->load->library('form_validation');

		// Load session library
		$this->load->library('session');

		//load url library
		$this->load->helper('url');

		// Load Models
		$this->load->model('user_model');
		$this->load->model('search_model');
		$this->load->model('trainer_model');
		$this->load->model('course_model');
		
	}  
	public function index() {
		if(isset($this->session->userdata['lawyer_detail'])){
			//if session is already set
			redirect('/user/lawyerDashBoard');
		}
		else{
			$this->load->view('login');
			
		}
	}
	/**
	 * view traner registration page 
	 * 
	 */
	public function newCourseRegistration(){
		
		$this->load->view('course-registration');
	}
	public function newBatchRegistration(){
		$data['active_courses'] = $this->course_model->get_all_courses_base_state('active');
		
		$this->load->view('batch-registration',$data);
	}
	public function addNewCourse(){
		$data_course = array(
			'course_name' => $this->input->post('coursename'),
			'course_description' => $this->input->post('coursediscription'),
			'course_fee' => $this->input->post('coursefee'),
			'state' => 'active',
			'staff_id' => $this->session->userdata('user_detail')['user_id'],
			'course_type' => $this->input->post('coursetype'),
			'submit_date' => Date('Y-m-d'),

		);
		// print_r($data_course);
		$result_registration = $this->course_model->add_new_course($data_course);
		if($result_registration == 1){
			$data['success_message_display'] = "Course registered successfully";
			$this->load->view('course-registration',$data);
			
		}else{
			$data['error_message_display'] = "Registration Fail";
			$this->load->view('course-registration',$data);
		}
	}

	public function addNewBatch(){
		$data['active_courses'] = $this->course_model->get_all_courses_base_state('active');
		$data_course = array(
			'course_id' => $this->input->post('selectcourse'),
			'staff_id' => $this->session->userdata('user_detail')['user_id'],
			'batch_number' => $this->input->post('batchnumber'),
			'create_date' => Date('Y-m-d'),
			'commence_date' => $this->input->post('commencedate'),
			'tentitive_close_date' => $this->input->post('tentativeclosedate'),
			'close_date' => NULL,
			'discription' => $this->input->post('discription'),
			'state' => 'active',
			

		);
		// print_r($data_course);
		$result_registration = $this->course_model->map_batch_with_course($data_course);
		if($result_registration == 1){
			$data['success_message_display'] = "Bactch created successfully";
			$this->load->view('batch-registration',$data);
			
		}else if($result_registration == 'batch found'){
			$data['error_message_display'] = "Batch number already in use";
			$this->load->view('batch-registration',$data);
		}else{
			$data['error_message_display'] = "Registration Fail";
			$this->load->view('batch-registration',$data);
		}
	}

	/**
 * search trainer base on the text send
 */
public function searchCourse(){
	// show default student search page
	if(isset($_POST['search-text']) && isset($_POST['type'])){
		// print_r($_POST);
		$course_search_result = $this->search_model->search_course($_POST);
		// print_r($student_search_result);
		// if found students
		if($course_search_result == 0){
			$data = array(
				'error_message_display'  => 'No result found',
				'search_input' => $_POST
			);
			$this->load->view('search-search-view',$data);
		}else{
			$data = array(
				'success_message_display' => 'Found result',
				'search_result' => $course_search_result,
				'search_input' => $_POST
			);
			$this->load->view('course-search-view',$data);
		}

	}else{
		$this->load->view('course-search-view');
	}
 }

	/**
	 * get active trainer detials
	 * get course
	 * get active batch detials of a course
	 * 
	 */

	public function trainerBatch($step=1){
		$success = $this->session->flashdata('success_message_display');
	$error = $this->session->flashdata('error_message_display');
	if(!empty($success)){
		$data['success_message_display'] = $success;
		
	}
	if(!empty($error)){
		$data['error_message_display'] = $error;
		
	}
		$active_courses= $this->user_model->read_all_active_courses();
		$active_trainers = $this->trainer_model->get_all_trainers_base_state('active');
		if($step == 1){
			if($active_courses && $active_trainers){
				// print_r($active_courses);
				$data['active_courses'] = $active_courses;
				$data['active_trainers'] = $active_trainers;
	
				$this->load->view('trainer-batch-map',$data);
			}
		}else if($step == 2){
			$data['select_course'] = $this->user_model->read_active_course_byid($_POST['selected_course'])[0];
			
			$data['select_trainer'] = $this->trainer_model->get_trainer_by_id($_POST['trainer_id'])[0];
			$data['course_batches'] = $this->user_model->read_active_batch($_POST['selected_course']);
			//print_r($data);
			$this->load->view('trainer-batch-map',$data);
		}else if($step == 3){
			// print_r($_POST);
			$data = array(
				'trainer_id' => $_POST['trainer_id'],
				'batch_id' => $_POST['select_batch'],
				'staff_id' => $this->session->userdata('user_detail')['user_id'],
				'added_date' => Date('Y-m-d'),
				'state' => 'active'

			);
			$result = $this->trainer_model->map_trainer_with_batch($data);
			if($result == 1){
				$this->session->set_flashdata('success_message_display','Trainer assigned to batch');
				redirect('/trainer/trainerBatch/1');
			}else if($result == 'user found'){
				$this->session->set_flashdata('error_message_display','Trainer already assigned to the batch');
				redirect('/trainer/trainerBatch/1');
			}else{
				$this->session->set_flashdata('error_message_display','Error came when assigning trainer to batch. Please try again');
				redirect('/trainer/trainerBatch/1');

			}
		}
		
	}


 public function courseProfile($courseid){
	$success = $this->session->flashdata('success_message_display');
	$error = $this->session->flashdata('error_message_display');
	if(!empty($success)){
		$data['success_message_display'] = $success;
		
	}
	if(!empty($error)){
		$data['error_message_display'] = $error;
		
	}
	if(isset($courseid)){

	 $course_details = $this->course_model->get_course_by_id($courseid);
	 $course_batches_object = $this->course_model->get_course_batch_details($courseid);

	//  print_r($trainer_details);
	//   print_r($course_batches_object);
	 if($course_batches_object != 0){
		$data['course_profile'] = $course_details;
		 $data['course_batches_object'] = $course_batches_object;
		 print_r($data);
	 	 $this->load->view('course-profile',$data);
	 }else{
		$data['error_message_display'] = 'invalid input of trainer';
		// $this->load->view('course-search-view',$data);
	 }
	 
	}else{
		$data['errow_message_display'] = 'invalid input of trainer';
		// $this->load->view('course-search-view',$data);
	}
 }
 public function newSubject($step = 1){
	//  show existing active course
	if($step == 1){
		$data['active_courses'] = $this->course_model->get_all_courses_base_state('active');
		$this->load->view('subject-registration',$data);
	}else if($step == 2){
		// get all subject if exist 
		print_r($_POST);
		// if no subject found retun 0
		$data['subjects'] = $this->course_model->get_all_subjects($_POST['selectcourse']);
		$data['select_course_detail'] = $this->course_model->get_course_by_id($_POST['selectcourse']);

		$this->load->view('subject-registration',$data);
		
	}

 }
}
?>
