<?php
Class User extends CI_Controller {
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

		// Load database
		$this->load->model('user_model');
		
	}  

	
	


	


	

/*******************************************************DATC Institute Code */

public function userLogin() {
	if(isset($this->session->userdata['user_detail'])){
			//if session is already set
			redirect('/user/studentTrainerDashBoard');
		}
		else{
			$this->load->view('login');
			
		}
}

public function staffLogin() {
	if(isset($this->session->userdata['user_detail'])){
			//if session is already set
			redirect('/user/staffDashBoard');
		}
		else{
			$this->load->view('staff-login');
			
		}
}



/**
 * 
 * DATC student and trainer loin
 * 
 * 
 */
public function studentTrainerLogin(){
	$this->form_validation->set_rules('email', 'Email', 'trim|required');
	$this->form_validation->set_rules('password', 'Password', 'trim|required');
	if ($this->form_validation->run() == FALSE) {
		if(isset($this->session->userdata['user_detail'])){
			//if session is already set
			redirect('/user/clientDashBoard');
		}
		else{
			$data['user_type'] = 'client';
			$this->load->view('login',$data);
			
		}
	} 
	else{
		$data = array(
			'email' => $this->input->post('email'),
			'password' => sha1($this->input->post('password')),
			'user-type' => $this->input->post('user-type'),
			);
			
		 $result = $this->user_model->student_trainer_login($data);
		if ($result == TRUE) {
			echo "success";
			$result = $this->user_model->read_StudentTraner_information($data['email'],$data['user-type']);
			
			if($data['user-type'] == 'student'){
					$user_session_data = array(
				'user_id' => $result[0]->student_id,
				'fname' => $result[0]->frist_name,
				'lname' => $result[0]->last_name,
				'email' => $result[0]->email,
				'birth-date' => $result[0]->birth_date,
				'staff-id' => $result[0]->staff_id,
				'register-date' => $result[0]->register_date,
				'state' => $result[0]->state,
				'login' => TRUE,
				'type' => 'student'
				);
				
			}else{
				
				$user_session_data = array(
					'user_id' => $result[0]->trainer_id,
					'fname' => $result[0]->first_name,
					'lname' => $result[0]->last_name,
					'email' => $result[0]->email,
					'register-date' => $result[0]->register_date,
					'register-date' => $result[0]->register_date,
					'state' => $result[0]->state,	
					'login' => TRUE,
					'type' => 'trainer'
					);
					print_r($user_session_data);
			}
		
				$this->session->set_userdata('user_detail', $user_session_data);
				redirect('/user/clientDashBoard');
		}
		else{
			$data = array(
				'error_message_display' => 'Invalid Username or Password'
				);
				$this->load->view('login', $data);
		}
	}
}

/**
 * 
 * DATC staff login
 * 
 * 
 */
public function staffMemberLogin(){
	$this->form_validation->set_rules('email', 'Email', 'trim|required');
	$this->form_validation->set_rules('password', 'Password', 'trim|required');
	if ($this->form_validation->run() == FALSE) {
		if(isset($this->session->userdata['user_detail'])){
			//if session is already set
			redirect('/user/staffDashBoard');
		}
		else{
			
			$this->load->view('staff-login');
			
		}
	} 
	else{
		$data = array(
			'email' => $this->input->post('email'),
			'password' => sha1($this->input->post('password')),
			);
			
		 $result = $this->user_model->staff_login($data);
		if ($result == TRUE) {
			
			echo "success";
			$result = $this->user_model->read_Staff_information($data['email']);
			if($result[0]->role_type == 'admin'){
				$user_menu = ['profile'=>'My Profile',
											'staff'=>'Staff Managment',
											'student'=>'Student Managment',
											'trainer'=>'Trainer Managment',
											'course'=>'Course Managment',
											'report'=>'Reports',
											'attendance'=>'Attendance'
										];
			}else if($result[0]->role_type == 'coordinator'){
				$user_menu = ['profile'=>'My Profile',
											'student'=>'Student Managment',
											'trainer'=>'Trainer Managment',
											'course'=>'Course Managment',
											'report'=>'Reports',
											'attendance'=>'Attendance'
										];
			}
			
			
					$user_session_data = array(
				'user_id' => $result[0]->staff_id,
				'staff-name' => $result[0]->staff_name,
				'email' => $result[0]->email,
				'state' => $result[0]->state,
				'login' => TRUE,
				'type' => $result[0]->role_type,
				'user-wise-menu' => $user_menu
				);
				
				print_r($user_session_data);
		
				$this->session->set_userdata('user_detail', $user_session_data);
				redirect('/user/staffDashBoard');
		}
		else{
			$data = array(
				'error_message_display' => 'Invalid Username or Password'
				);
				$this->load->view('staff-login', $data);
		}
	}
}


	/**
	 * Show staff dashboard page
	 */
	public function staffDashBoard() {
		$success = $this->session->flashdata('success_message_display');
		 $error = $this->session->flashdata('error_message_display');
		if(!empty($success)){
			$data['success_message_display'] = $success;
		}
		if(!empty($error)){
			$data['error_message_display'] = $error;
		}

		// $client_detail = $this->session->userdata('user_detail');
		
		// $result = $this->user_model->show_client_booking($client_detail['user_id']);

		$this->load->view('staff-dashboard');


	
	}

public function showCourse($category){
	if($category == 'diploma'){
		$result_course = $this->user_model->read_active_course($category);
		//print_r($result_course);
		foreach($result_course as $key => $single_course){
			$result_batch = $this->user_model->read_active_batch($single_course->course_id);
			//print_r($single_course->course_name);
			$single_course->datch_detail = $result_batch;	
			$result_course_with_batch[] = $single_course;


			// foreach($result as $key=>$book_value){
	
			// 	$result_lawyer_detail= $this->user_model->get_lawyer_detail($book_value->user_id);
			// 	$book_value->lawyer = $result_lawyer_detail[0]->first_name . ' '. $result_lawyer_detail[0]->last_name;
			// 	$book_value->legal_professional = $result_lawyer_detail[0]->legal_professional;
			// 	$result_booking_history[] = $book_value;
				
			// }

		}
		
		$data['course_wise_active_batch'] = $result_course_with_batch;
		$this->load->view('course-diploma',$data);

	}else if($category == 'training'){
		$result = $this->user_model->read_active_course($category);
		$this->load->view('course-training');
	}
}

public function veiwRegister($coursId,$batchId){

	$success = $this->session->flashdata('success_message_display');
	$error = $this->session->flashdata('error_message_display');
 if(!empty($success)){
	 $data['success_message_display'] = $success;
 }
 if(!empty($error)){
	 $data['error_message_display'] = $error;
 }


	
	$result_course = $this->user_model->read_active_course_byid($coursId);
	$result_batch = $this->user_model->read_active_batch_byid($batchId);
	$data['student_register_to_course'] = 0;
	if(isset($this->session->userdata['user_detail']) && $this->session->userdata['user_detail']['type'] == 'student'){
		
		$result_student_course_select = $this->user_model->read_student_register_to_course($this->session->userdata['user_detail']['user_id'],$batchId);
		if($result_student_course_select){
			// echo "student already register";
			$data['student_register_to_course'] = 1;
			
		}else{
			$data['student_register_to_course'] = 0;
		}
		
	}
	


	// print_r($result_course);
	// print_r($result_batch);
	$data['course_detail'] = $result_course;
	$data['batch_detail'] = $result_batch;
	$this->load->view('register',$data);
}

/**
 * student register online after register coordinator should approve
 */
public function studentRegisterOnline($course_id,$batch_id){
	
	if(isset($this->session->userdata['user_detail']) && $this->session->userdata['user_detail']['type'] == 'student'){
			
		$student_log = true;
		$student_id = $this->session->userdata['user_detail']['user_id'];
		$data = null;
	}else{
		$student_log = false;
		$student_id = 0;
		$this->form_validation->set_rules('firstname', 'First Name', 'trim|required|alpha');
		$this->form_validation->set_rules('lastname', 'Last Name', 'trim|required|alpha');
		$this->form_validation->set_rules('password', 'Password', 'trim|required');
		$this->form_validation->set_rules('email', 'Email', 'trim|required');
		$this->form_validation->set_rules('telephone', 'Contact', 'trim|required');
		if ($this->form_validation->run() == FALSE) {
			// $data = array(
			// 	'user_type' => 'client'
			// );
			$this->session->set_flashdata('error_message_display','Error processing the form. ');
			redirect('user/veiwRegister/'.$course_id.'/'.$batch_id);
			//$this->load->view('register',$data);
			
		}
		else{
			$data = array(
				'first_name' => $this->input->post('firstname'),
				'last_name' => $this->input->post('lastname'),
				'birth_date' => $this->input->post('bdate'),
				'email' => $this->input->post('email'),
				'telephone' => $this->input->post('telephone'),
				'password' => sha1($this->input->post('password')),
				'staff_id' => 3,
				'state' => 'pending',
				'register_date' => Date('Y-m-d'),

			);
		}
	}


				
			$result = $this->user_model->student_registration_online($data,$batch_id,$student_log,$student_id);
			if(!$result){
			
				$this->session->set_flashdata('error_message_display','A user exist with the email address, please login to proceed');
				redirect('user/veiwRegister/'.$course_id.'/'.$batch_id);
			}else{
				// echo "<hr>";
				// echo $result;
				if(isset($this->session->userdata['user_detail']) && $this->session->userdata['user_detail']['type'] == 'student'){
					$this->session->set_flashdata('success_message_display','Detail submitted sucessfully');
					redirect('/user/studentTrainerDashboard');
				}else{
					$data['success_message_display'] = 'Registered successfully';
					$this->load->view('login',$data);
				}
			
			}
			
			
			//print_r($_POST);
		
}

/**
 * sudent management dashboard
 */

 public function student(){
		// $session = $this->session->userdata['user_detail'];

		if($this->session->userdata['user_detail']['type'] == 'admin'){
			$data['studentManagement'] = array(
				'newRegistration' => 'New Registration',
				'pendingOnlineRegistration' => 'Pending online Registration',
				'searchStudent' => 'Registered Students',
			);

			$this->load->view('student-management',$data);

		}else if($this->session->userdata['user_detail']['type'] == 'coordinator'){

		}
 }

 public function pendingOnlineRegistration(){
	$result = $this->user_model->get_pending_students();
	
	foreach ($result as $key => $student) {
			//print_r($student);
			$result_batch = $this->user_model->get_pending_student_batch($student->student_id);
			// print_r($result_batch);
			foreach ($result_batch as $key => $batch) {
				$result_batch_indetail = $this->user_model->read_active_batch_byid($batch->batch_id);
				//print_r($result_batch_indetail[0]);
				$batch->batch_number = $result_batch_indetail[0]->batch_number;
				$result_course_indetail = $this->user_model->read_active_course_byid($result_batch_indetail[0]->course_id);
				//print_r($result_course_indetail[0]);
				$batch->course_name = $result_course_indetail[0]->course_name;
				$batch->course_id = $result_course_indetail[0]->course_id;
				$batch_detail_final[] = $batch;
				//print_r($result_batch[$key]->batch_id);
			}
			//print_r($batch_detail_final);
			$student->batch_summary = $batch_detail_final;
			unset($batch_detail_final);
			// $student->batch_detail = $result_batch;
			$pending_student_detail[] = $student;
			
	}
	//print_r($pending_student_detail);
	$data['peding_student_registration'] = $pending_student_detail;
	 $this->load->view('pending-student-registration',$data);
 }

 public function registerStudent($student_state,$student_id,$course_id,$batch_id){
	//check student status and proceed 
	if($student_state == 'pending'){
		//new registration to the batch
		$result_student_detail = $this->user_model->student_detail_byid($student_id);
		print_r($result_student_detail);
		$result_course_detail = $this->user_model->read_course_byid($course_id);
		print_r($result_course_detail);
		$result_batch_detail = $this->user_model->read_batch_byid($batch_id);
		print_r($result_batch_detail);
	}
 }

/**
	 * Logout module 
	 */
	 
	public function logoutUser($user) {
		// Removing session data
		if($user == 'student' || $user == 'trainer'){
				$this->session->unset_userdata('user_detail');
				$data['success_message_display'] = 'Log out sucessfully';
				$this->load->view('login', $data);
		}
		elseif($user = 'coordinator' || $user = 'admin'){
				$this->session->unset_userdata('user_detail');
				$data['success_message_display'] = 'Log out sucessfully';
				$this->load->view('staff-login', $data);
		}		
	}




}
?>
