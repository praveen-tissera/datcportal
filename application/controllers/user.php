<?php
Class User extends CI_Controller {
    public function __construct() {
		parent::__construct();

		$this->load->helper('captcha');
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
		
	}  
	public function index() {
		if(isset($this->session->userdata['user_detail'])){
			//if session is already set
			// redirect('/user/lawyerDashBoard');
		}
		else{
			// $this->load->view('login');
			
		}
	}
	

/*******************************************************DATC Institute Code */

public function login() {
	if(isset($this->session->userdata['user_detail'])){
			//if session is already set
			// redirect('/user/studentTrainerDashBoard');
			print_r($this->session->userdata('user_detail'));
			if($this->session->userdata('user_detail')['type'] == 'admin' ||$this->session->userdata('user_detail')['type'] == 'coordinator'){
				$this->load->view('staff-login');
			}else if($this->session->userdata('user_detail')['type'] == 'trainer' ||$this->session->userdata('user_detail')['type'] == 'student'){
				$this->load->view('login');
			}
		}
		else{
			$this->load->view('login');
			
		}
}

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
				$user_menu = ['profile'=>'My Profile',
											
											'course'=>'Course Managment',
											'attendance'=>'Attendance'
										];
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
				'type' => 'student',
				'user-wise-menu' => $user_menu
				);
				
			}else{
				$user_menu = ['profile'=>'My Profile',
											
											'student'=>'Student Managment',
											
											'course'=>'Course Managment',
										
										];
				$user_session_data = array(
					'user_id' => $result[0]->trainer_id,
					'fname' => $result[0]->first_name,
					'lname' => $result[0]->last_name,
					'email' => $result[0]->email,
					'register-date' => $result[0]->register_date,
					'register-date' => $result[0]->register_date,
					'state' => $result[0]->state,	
					'login' => TRUE,
					'type' => 'trainer',
					'user-wise-menu' => $user_menu
					);
					
					// print_r($user_session_data);
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
				
				// print_r($user_session_data);
		
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

	/**
	 * Show student and trainer  dashboard page
	 */
	public function clientDashBoard() {
		$success = $this->session->flashdata('success_message_display');
		 $error = $this->session->flashdata('error_message_display');
		if(!empty($success)){
			$data['success_message_display'] = $success;
		}
		if(!empty($error)){
			$data['error_message_display'] = $error;
		}

		 $client_detail = $this->session->userdata('user_detail');
			print_r($client_detail);
		// $result = $this->user_model->show_client_booking($client_detail['user_id']);

		 $this->load->view('client-dashboard');


	
	}

public function showCourse($category){
	if($category == 'diploma'){
		$result_course = $this->user_model->read_active_course($category);
		//print_r($result_course);
		if(!$result_course){
			// echo "cannot find diploma related courses";
			$data['error_message_display'] = 'cannot find diploma related courses';
		}else{
		foreach($result_course as $key => $single_course){
			$result_batch = $this->user_model->read_active_batch($single_course->course_id);
			//print_r($single_course->course_name);
			$single_course->datch_detail = $result_batch;	
			$result_course_with_batch[] = $single_course;
		}

		

		}
		
		$data['course_wise_active_batch'] = $result_course_with_batch;
		$this->load->view('course-diploma',$data);

	}else if($category == 'training'){
		$result_course = $this->user_model->read_active_course($category);
		if(!$result_course){
			echo "cannot find traning related courses";
			$data['error_message_display'] = 'cannot find training related courses';
		}else{
			foreach($result_course as $key => $single_course){
				$result_batch = $this->user_model->read_active_batch($single_course->course_id);
				//print_r($single_course->course_name);
				$single_course->datch_detail = $result_batch;	
				$result_course_with_batch[] = $single_course;
	
			}
			
			$data['course_wise_active_batch'] = $result_course_with_batch;
		}
		
		
		$this->load->view('course-diploma',$data);
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
 * student management dashboard
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


 /**
	*  current login user profile 
  */

 public function profile(){
	$success = $this->session->flashdata('success_message_display');
	$error = $this->session->flashdata('error_message_display');
	if(!empty($success)){
		$data['success_message_display'] = $success;
		
	}
	if(!empty($error)){
		$data['error_message_display'] = $error;
		
	}

	 if($this->session->userdata('user_detail')['type'] == 'admin' ||$this->session->userdata('user_detail')['type'] == 'coordinator'){
		
		$data['profile'] = $this->user_model->get_Staff_detail_by_id($this->session->userdata('user_detail')['user_id'])[0];
		$data['profile']->user_role = $this->session->userdata('user_detail')['type'];

	}else if($this->session->userdata('user_detail')['type'] == 'trainer'){
		$data['profile'] = $this->user_model->read_trainer_detail($this->session->userdata('user_detail')['user_id']);
		$data['profile']->user_role = $this->session->userdata('user_detail')['type'];
	


	}else if($this->session->userdata('user_detail')['type'] == 'student'){
		
		$data['profile'] = $this->user_model->student_detail_byid($this->session->userdata('user_detail')['user_id'])[0];
		
		 $data['profile']->user_role = $this->session->userdata('user_detail')['type'];
	}



	$this->load->view('my-profile',$data);
 }
/**
 * update user profil
 */
 public function profileUpdate($section,$role){
	 if($role == 'admin' || $role == 'coordinator'){
		 
		 if($section =='profile'){
			 $result_update_profile = $this->user_model->update_profile($section,$role,$_POST);

			 if($result_update_profile ==1){
				$this->session->set_flashdata('success_message_display','profile update successfully');
				redirect('/user/profile');

		}else if($result_update_profile == 0){
				$this->session->set_flashdata('success_message_display','No data found to update');
				redirect('/user/profile');
		}else{
				$this->session->set_flashdata('error_message_display','Error processing the form. ');
				redirect('/user/profile');
		}

		 }else if($section =='password'){

			$staff_detail = $this->user_model->get_Staff_detail_by_id($this->session->userdata('user_detail')['user_id'])[0];
			
			$_POST['currentpsw'] = sha1($_POST['currentpsw']);
			$_POST['newpsw'] = sha1($_POST['newpsw']);
			$_POST['confirmnewpsw'] = sha1($_POST['confirmnewpsw']);
			$_POST['regnumber'] = $this->session->userdata('user_detail')['user_id'];
			if($_POST['currentpsw'] === $staff_detail->password){
				if(	$_POST['newpsw'] === $staff_detail->password){
					$this->session->set_flashdata('error_message_display','New password cannot be same as old password');
					redirect('/user/profile');
				}
				elseif ($_POST['newpsw'] != $_POST['confirmnewpsw']) {
					print_r($_POST);
					$this->session->set_flashdata('error_message_display','New password and confirm password mismatch');
					redirect('/user/profile');
				}else{
							echo "update password and logout";
							$result_update_profile = $this->user_model->update_profile($section,$role,$_POST);
							
							
						if($result_update_profile ==1){
							$this->logoutUser($role,'updatepsw');
						}else if($result_update_profile == 0){
								$this->session->set_flashdata('success_message_display','No data found to update');
								redirect('/user/profile');
						}else{
								$this->session->set_flashdata('error_message_display','Error processing the form. ');
								redirect('/user/profile');
						}


				}
			
			}else{
				$this->session->set_flashdata('error_message_display','Password missmatch');
				// redirect('/user/profile');
			}
		 }



	 }else if($role == 'trainer'){
			print_r($_POST);
			if($section =='profile'){
				$result_update_profile = $this->user_model->update_profile($section,$role,$_POST);

				if($result_update_profile ==1){
					$this->session->set_flashdata('success_message_display','profile update successfully');
					redirect('/user/profile');
	
			}else if($result_update_profile == 0){
					$this->session->set_flashdata('success_message_display','No data found to update');
					redirect('/user/profile');
			}else{
					$this->session->set_flashdata('error_message_display','Error processing the form. ');
					redirect('/user/profile');
			}





			}else if($section =='password'){
				$trainer_detail = $this->user_model->read_trainer_detail($this->session->userdata('user_detail')['user_id']);
				$_POST['currentpsw'] = sha1($_POST['currentpsw']);
				$_POST['newpsw'] = sha1($_POST['newpsw']);
				$_POST['confirmnewpsw'] = sha1($_POST['confirmnewpsw']);
				$_POST['regnumber'] = $this->session->userdata('user_detail')['user_id'];
				if($_POST['currentpsw'] === $trainer_detail->password){
					if(	$_POST['newpsw'] === $trainer_detail->password){
						$this->session->set_flashdata('error_message_display','New password cannot be same as old password');
						redirect('/user/profile');
					}
					elseif ($_POST['newpsw'] != $_POST['confirmnewpsw']) {
						print_r($_POST);
						$this->session->set_flashdata('error_message_display','New password and confirm password mismatch');
						redirect('/user/profile');
					}else{
								echo "update password and logout";
								$result_update_profile = $this->user_model->update_profile($section,$role,$_POST);
								
								
							if($result_update_profile ==1){
								$this->logoutUser($role,'updatepsw');
							}else if($result_update_profile == 0){
									$this->session->set_flashdata('success_message_display','No data found to update');
									redirect('/user/profile');
							}else{
									$this->session->set_flashdata('error_message_display','Error processing the form. ');
									redirect('/user/profile');
							}


					}
				
				}else{
					$this->session->set_flashdata('error_message_display','Password missmatch');
					redirect('/user/profile');
				}
			}
	 }else if($role == 'student'){
		print_r($_POST);
		if($section =='profile'){

			$result_update_profile = $this->user_model->update_profile($section,$role,$_POST);

				if($result_update_profile ==1){
					$this->session->set_flashdata('success_message_display','profile update successfully');
					redirect('/user/profile');
	
			}else if($result_update_profile == 0){
					$this->session->set_flashdata('success_message_display','No data found to update');
					redirect('/user/profile');
			}else{
					$this->session->set_flashdata('error_message_display','Error processing the form. ');
					redirect('/user/profile');
			}



		}else if($section =='password'){
			print_r($_POST);
			$staff_detail = $this->user_model->student_detail_byid($this->session->userdata('user_detail')['user_id'])[0];
			
			$_POST['currentpsw'] = sha1($_POST['currentpsw']);
			$_POST['newpsw'] = sha1($_POST['newpsw']);
			$_POST['confirmnewpsw'] = sha1($_POST['confirmnewpsw']);
			$_POST['regnumber'] = $this->session->userdata('user_detail')['user_id'];
			if($_POST['currentpsw'] === $staff_detail->password){
				if(	$_POST['newpsw'] === $staff_detail->password){
					$this->session->set_flashdata('error_message_display','New password cannot be same as old password');
					redirect('/user/profile');
				}elseif ($_POST['newpsw'] != $_POST['confirmnewpsw']) {
					print_r($_POST);
					$this->session->set_flashdata('error_message_display','New password and confirm password mismatch');
					redirect('/user/profile');
				}else{
							echo "update password and logout";
							$result_update_profile = $this->user_model->update_profile($section,$role,$_POST);
							
							
						if($result_update_profile ==1){
							$this->logoutUser($role,'updatepsw');
						}else if($result_update_profile == 0){
								$this->session->set_flashdata('success_message_display','No data found to update');
								 redirect('/user/profile');
						}else{
								$this->session->set_flashdata('error_message_display','Error processing the form. ');
								redirect('/user/profile');
						}


				}
			
			}else{
				$this->session->set_flashdata('error_message_display','Password missmatch');
				 redirect('/user/profile');
			}

			


		}
	}

 }

 /**
 * staff management dashboard
 */

public function staff(){
	// $session = $this->session->userdata['user_detail'];

	if($this->session->userdata['user_detail']['type'] == 'admin'){
		$data['staffManagement'] = array(
			'newStaffRegistration' => 'New Staff Member',
			'searchStaff' => 'Search Staff Member',
		);

		$this->load->view('staff-management',$data);

	}else if($this->session->userdata['user_detail']['type'] == 'coordinator'){

	}
}


 /**
 * trainer management dashboard
 */

public function trainer(){
	// $session = $this->session->userdata['user_detail'];

	if($this->session->userdata['user_detail']['type'] == 'admin'){
		$data['trainerManagement'] = array(
			'newTrainerRegistration' => 'New Trainer',
			'trainerBatch' => 'Assign Trainer to Batch',
			'searchTrainer' => 'Search Trainer',
		);

		$this->load->view('trainer-management',$data);

	}else if($this->session->userdata['user_detail']['type'] == 'coordinator'){

	}
}

 /**
 * attendance management dashboard
 */

public function attendance(){
	// $session = $this->session->userdata['user_detail'];

	if($this->session->userdata['user_detail']['type'] == 'admin'){
		$data['studentManagement'] = array(
			'newAttendanceRegistration' => 'Add Attendance',
			'searchAttendance' => 'Search Attendance',
		);

		$this->load->view('attendance-management',$data);

	}else if($this->session->userdata['user_detail']['type'] == 'coordinator'){

	}
}

/**
 * course batch management dashboard
 */
public function course(){
	// $session = $this->session->userdata['user_detail'];

	if($this->session->userdata['user_detail']['type'] == 'admin'){
		$data['studentManagement'] = array(
			'newCourseRegistration' => 'New Course',
			'newBatchRegistration' => 'New Batch', 
			'searchCourse' => 'Search Course & Batch',
			'newSubject' => 'New Subject',
			'examCertificate' => 'Exam & Certificate'
		);

		$this->load->view('course-management',$data);

	}else if($this->session->userdata['user_detail']['type'] == 'coordinator'){

	}
}

 public function pendingOnlineRegistration(){
	$result = $this->user_model->get_pending_students();
	
	foreach ($result as $key => $student) {
			//print_r($student);
			$result_batch = $this->user_model->get_pending_student_batch($student->student_id);
			//  print_r($result_batch);
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
			//print_r($batch_detail_final); 
			// $student->batch_detail = $result_batch;
			$pending_student_detail[] = $student;
			
	}
	// print_r($pending_student_detail);
	$data['peding_student_registration'] = $pending_student_detail;
	 $this->load->view('pending-student-registration',$data);
 }

 public function registerStudent($student_state,$student_id,$course_id,$batch_id){
	//check student status and proceed 
	if($student_state == 'pending'){
		//new registration to the batch
		$result_student_detail = $this->user_model->student_detail_byid($student_id);
		//print_r($result_student_detail);
		$result_course_detail = $this->user_model->read_course_byid($course_id);
		//print_r($result_course_detail);
		$result_batch_detail = $this->user_model->read_batch_byid($batch_id);
		//print_r($result_batch_detail);

		$data = array(
			'student_detail' => $result_student_detail,
			'course_detail' => $result_course_detail,
			'batch_detail' => $result_batch_detail
		);
		$this->load->view('pending-registration-form',$data);
	}
 }

/**
 * confirm student first payment those who do online registration
 */

 
 public function studentRegisterconfirm(){
	//  print_r($_POST);
	 if($_POST['pay_type'] == 1){


		 $result_update_student = $this->user_model->update_student_payment($_POST,$this->session->userdata('user_detail')['user_id']);
		 echo "receipt number <br>";
		 echo $result_update_student;
// check whether receipt get from model
		if($result_update_student !== 0){
			$data['success_message_display'] = 'Student detail updated successfully.';
			$data['receipt_number'] = $result_update_student;
			$data['student_detail'] = $_POST;
			$this->load->view('student-first-payment-confirmation',$data);
		}
	 }else if($_POST['pay_type'] == 2){
	
		$result_update_student = $this->user_model->update_student_payment($_POST,$this->session->userdata('user_detail')['user_id']);
		// part payment only first installment
		// print_r($_POST);
		// check whether receipt get from model
		if($result_update_student !== 0){
			$data['success_message_display'] = 'Student detail updated successfully';
			$data['receipt_number'] = $result_update_student;
			$data['student_detail'] = $_POST;
			$this->load->view('student-first-payment-confirmation',$data);
		}


	 }
 }

 public function newRegistration($step='1'){
	 echo $step;
	 /**
		* step one -  select course
		* step two - select batch and payment type
		* step three - student details
		*/
		if($step == '1'){
			// get all courses into drop down
			$data['all_courses'] = $this->user_model->read_all_active_courses();
			
			$this->load->view('new-student-offline-registration',$data);

		}
		if($step == '2'){
			// /print_r($_POST);
			$data['select_course'] = $this->user_model->read_active_course_byid($_POST['selected_course']);
			// print_r($course_details[0]);
			 $data['all_batches'] = $this->user_model->read_active_batch($_POST['selected_course']);
			//  print_r($data);
			 $this->load->view('new-student-offline-registration',$data);
			
		}
		if($step == '3'){
			// submission
			// print_r($_POST);
			// Array ( [course-id] => 1 [selected_batch] => 2 [payment_mode] => full [due-date] => 2022-02-08 [firstname] => roshi [lastname] => fernando [bdate] => 2007-06-05 [email] => roshi@gmail.com [telephone] => 1234567 [password] => 71160457V )

			$data_student = array(
				'first_name' => $this->input->post('firstname'),
				'last_name' => $this->input->post('lastname'),
				'birth_date' => $this->input->post('bdate'),
				'email' => $this->input->post('email'),
				'telephone' => $this->input->post('telephone'),
				'password' => sha1($this->input->post('password')),
				'staff_id' => $this->session->userdata('user_detail')['user_id'],
				'state' => 'active',
				'register_date' => Date('Y-m-d'),

			);
			$data_course_batch = array(
				'batch_id'=> $this->input->post('selected_batch'),
				'staff_id'=> $this->session->userdata('user_detail')['user_id'],
				'added_date'=> Date('Y-m-d'),
				'state'=> 'active',
				'certificate_no' => NuLL
			);
			$pay_type = ($this->input->post('payment_mode') == 'full') ? '1':'2';
			$payment_detail = array(
				'payment_mode' => $this->input->post('payment_mode'),
				'pay_type' => $pay_type,
				'fullpayment'=> $this->input->post('fullpayment'),
				'installmentone' => $this->input->post('installmentone'),
				'installmenttwo' => $this->input->post('installmenttwo'),
				'due-date' =>$this->input->post('due-date')
			);
			 $registration_details = $this->user_model->register_student_offiline($data_student,$data_course_batch,$payment_detail);
			//  echo "<hr>";
			 if($registration_details == 'email found'){
				$data['error_message_display'] = "Student Registration fail. User with the same email exist!";
				$this->load->view('student-first-payment-confirmation', $data);
			 }else{
				  $student_batch_payment = array_merge($data_student,$data_course_batch,$payment_detail,$registration_details);
					// print_r($student_batch_payment);
					$data['success_message_display'] = "Student registered successfully";
					$data['student_detail'] = $student_batch_payment;
					$this->load->view('student-first-payment-confirmation', $data);
			 }
			
		}
		
 }
/**
 * search students base on the text send
 */
 public function searchStudent(){
	// show default student search page
	if(isset($_POST['search-text']) && isset($_POST['type'])){
		// print_r($_POST);
		$student_search_result = $this->search_model->search_student($_POST);
		// print_r($student_search_result);
		// if found students
		if($student_search_result == 0){
			$data = array(
				'error_message_display'  => 'No result found',
				'search_input' => $_POST
			);
			$this->load->view('student-search-view',$data);
		}else{
			$data = array(
				'success_message_display' => 'Found result',
				'search_result' => $student_search_result,
				'search_input' => $_POST
			);
			$this->load->view('student-search-view',$data);
		}

	}else{
		$this->load->view('student-search-view');
	}
 }

/**
 * view indiviual student details
 * course selected
 * payment details
 */
 public function studentProfile($studentid){
	$success = $this->session->flashdata('success_message_display');
	$error = $this->session->flashdata('error_message_display');
	if(!empty($success)){
		$data['success_message_display'] = $success;
		
	}
	if(!empty($error)){
		$data['error_message_display'] = $error;
		
	}
	if(isset($studentid)){
		// $student_profile = $this->user_model->student_detail_byid($studentid);
		  $student_courses_batches = $this->user_model->student_wise_batches_course($studentid);
		//$student_courses_batches = $this->user_model->batch_details_with_course_detail(1);
		// $student_courses_batches = $this->user_model->payment_schedule(17,2);
		// print_r($student_courses_batches);a
		$data['student_profile'] = $this->user_model->student_detail_byid($studentid)[0];
		$data['student_object'] = $student_courses_batches;
		$this->load->view('student-profile',$data);
	}else{
		echo "invalid input";
	}

 }

 /**
	* update installments which are settle after 1st installment
  */
 public function payInstallment($paymentid,$batchid,$studentid){
	 
	$payment_schedule_detials = $this->user_model->payment_schedule_by_paymentid($paymentid);
	
	echo $this->session->userdata('user_detail')['user_id'];
	 $result_add_installment  = $this->user_model->add_installment_payment($paymentid,$batchid,$this->session->userdata('user_detail')['user_id'],$payment_schedule_detials[0]->amount,$studentid);

	 if($result_add_installment == 1){
		//  echo "true";
		$this->session->set_flashdata('success_message_display','installment payment added successfully');
		redirect('/user/studentProfile/'.$studentid);
	 }else{
		// echo "false";
		$this->session->set_flashdata('error_message_display','Error or processing your request. Please try again');
		redirect('/user/studentProfile/'.$studentid);
	 }
 }

 public function verification($step =1){
	$success = $this->session->flashdata('success_message_display');
	$error = $this->session->flashdata('error_message_display');
	if(!empty($success)){
		$data['success_message_display'] = $success;
		
	}
	if(!empty($error)){
		$data['error_message_display'] = $error;
		
	}
		if($step ==1){
			$vals = array(
				'img_path'      => './captcha/',
				'img_width'     => '250',
				'img_height'    => 50,
				'font_path'			=> '../../assets/bootstrap/fonts/glyphicons-halflings-regular.ttf',
				'font_size'     => 16,
        'img_url'       => 'http://localhost/datcportal/captcha/'
			);
			$cap = create_captcha($vals);
			
			$data_cap = array(
        'captcha_time'  => $cap['time'],
        'ip_address'    => $this->input->ip_address(),
        'word'          => $cap['word']
			);
			echo $cap['word'];
			$this->user_model->addCaptcha($data_cap);
			// print_r($data);
			// show form
			$data['cap'] = $cap;
			$this->load->view('verfication-view',$data);
		}else if($step == 2 && isset($_POST)){
			$expiration = time() - 7200; // Two hour limit
			print_r($_POST);
			$form_captcha = array(
			'string'	=> $_POST['captcha'], 
				'ip' => $this->input->ip_address(), 
				'time' => $expiration
			);
			$result_captcha = $this->user_model->validateCaptcha($form_captcha);
			if($result_captcha == 1){
				echo "capctcha is correct";
				$data['result_certificate'] = $this->user_model->readCertificate($_POST['certificatenumber']);
				$data['certificatenumber'] = $_POST['certificatenumber'];
				
				$this->load->view('certificate-view',$data);
			}else{
				$this->session->set_flashdata('error_message_display','You must submit the word that appears in the image.');
				redirect('/user/verification/1');
				
			}
		}
	}

/**
	 * Logout module 
	 */
	 
	public function logoutUser($user,$message = "") {
		
		// Removing session data
		if($user == 'student' || $user == 'trainer'){
				$this->session->unset_userdata('user_detail');
				if($message == 'updatepsw'){
					$data['success_message_display'] = 'Password updated successfuly please login';
				}
				else{
					$data['success_message_display'] = 'Log out sucessfully';
				}

				$this->load->view('login', $data);
		}
		elseif($user = 'coordinator' || $user = 'admin'){
				$this->session->unset_userdata('user_detail');
				if($message == 'updatepsw'){
					$data['success_message_display'] = 'Password updated successfuly please login';
				}
				else{
					$data['success_message_display'] = 'Log out sucessfully';
				}
				
				$this->load->view('staff-login', $data);
		}		
	}




}
?>
