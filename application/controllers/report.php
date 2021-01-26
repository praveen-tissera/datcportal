<?php
Class Report extends CI_Controller {
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
		$this->load->model('report_model');
		
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
		//  print_r($data);
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
 public function newSubject($step = 1,$editcourseid=0,$subjectid=0,$status=0){
	$success = $this->session->flashdata('success_message_display');
	$error = $this->session->flashdata('error_message_display');
	$flash_courseid = $this->session->flashdata('courseid');
	if(!empty($success)){
		$data['success_message_display'] = $success;
		
	}
	if(!empty($error)){
		$data['error_message_display'] = $error;
		
	}
	//  show existing active course
	if($step == 1){
		$data['active_courses'] = $this->course_model->get_all_courses_base_state('active');
		$this->load->view('subject-registration',$data);
	}else if($step == 2 ){


		if(isset($flash_courseid) && !empty($flash_courseid)){
			$courseid = $flash_courseid;
		}elseif(isset($_POST['selectcourse'])){
			$courseid = $_POST['selectcourse'];
		}




		// if flash data or post data not available direct to step 1
		if(isset($courseid) && !empty($courseid)){
				// if no subject found retun 0
				$data['subjects'] = $this->course_model->get_all_subjects($courseid);
				$data['select_course_detail'] = $this->course_model->get_course_by_id($courseid);
	
				$this->load->view('subject-registration',$data);
			
		}elseif($editcourseid >0 && $subjectid > 0 && $status ==1){
			// show subject to edit
			$data['subjects'] = $this->course_model->get_all_subjects($editcourseid);
				$data['select_course_detail'] = $this->course_model->get_course_by_id($editcourseid);
			$data['select_course_detail'] = $this->course_model->get_course_by_id($editcourseid);
			$data['subject_detail'] = $this->course_model->get_subject($editcourseid,$subjectid);
			// print_r($data);
			$this->load->view('subject-registration',$data);
			
		}else{
				redirect('/course/newSubject/1');
		}
		
		
	}elseif ($step == 3) {
		// add new subject
		// print_r($_POST);
		
		$data = array(
			'course_id' => $_POST['courseid'],
			'subject_name' => $_POST['subject'],
			'state' => $_POST['state']
		);
		$result = $this->course_model->add_new_subject($data);
		if($result == 1){
			$this->session->set_flashdata('success_message_display','Subject added successfully');
			$this->session->set_flashdata('courseid',$_POST['courseid']);
				redirect('/course/newSubject/2');
		}else{
			$this->session->set_flashdata('error_message_display','Error came when inserting subject. Please try again');
				redirect('/trainer/newSubject/1');
		}
	}elseif($step == 4){
		// upddate selected subject
		// print_r($_POST);
		$data  = array(
			'course_id' => $_POST['courseid'],
			'subject_id' => $_POST['subjectid'],
			'subject_name' => $_POST['subject'],
			'state' => $_POST['state'],

		);

		$result_subject_update = $this->course_model->update_subject($data);

		if($result_subject_update == 1){
			$this->session->set_flashdata('success_message_display','Subject updated successfully');
			$this->session->set_flashdata('courseid',$_POST['courseid']);
				redirect('/course/newSubject/2');

		}else if($result_subject_update == 0){
			$this->session->set_flashdata('success_message_display','Nothing to update');
			$this->session->set_flashdata('courseid',$_POST['courseid']);
				redirect('/course/newSubject/2');

		}else{
			$this->session->set_flashdata('error_message_display','Error when updating subject. Please try again');
			$this->session->set_flashdata('courseid',$_POST['courseid']);
				redirect('/course/newSubject/2');
		}
	}


 }
/**
 * process income report 
 */

 public function incomeReport($step=1){
	if($step == 1){
		$data['active_courses'] = $this->course_model->get_all_courses_base_state('active');
		$this->load->view('income-report-view',$data);
	}elseif ($step == 2) {
		// print_r($_POST);
		if(isset($_POST['selectcourse']) && $_POST['selectcourse'] == 0){
			$data['select_course_detail'] = 'All Courses';
			$data['active_batches'] = 'All Batches';
		}else{
			$select_course_detail = $this->course_model->get_course_by_id($_POST['selectcourse']);
			$data['select_course_detail'] = $select_course_detail;
			$data['selected_batch'] = 'All Batches';
			$data['active_batches'] = $this->course_model->get_course_batch_details($_POST['selectcourse']);
		}
		
		 
		
		$this->load->view('income-report-view',$data);
	}elseif ($step == 3) {
		//  print_r($_POST);

		if($_POST['course_id'] == 'All Courses' && $_POST['selectbatch'] == 'All Batches'){
			$data['select_course_detail'] = 'All Courses';
			$data['active_batches'] = 'All Batches';
			$data['selected_batch'] = 'All Batches';
			$post_data = array(
				'course_id' => $_POST['course_id'],
				'batch_id' => $_POST['selectbatch'],
				'startdate' => $_POST['startdate'],
				'enddate' => $_POST['enddate'],
			);
			$data['result_payments'] = $this->report_model->income_report($post_data);
			$data['select_start_date'] = $_POST['startdate'];
		 $data['select_end_date'] =  $_POST['enddate'];
				 $total = 0;
				 foreach ($data['result_payments'] as $key => $payment) {
					 $total  = $total + $payment->paid_amount;
				 }
				 $data['total_income_graph'] = number_format($total,2,".","");
				 $data['total_income'] = number_format($total,2);
				 $this->load->view('income-report-view',$data);
		}else if($_POST['course_id'] != 'All Courses' && $_POST['selectbatch'] == 'All Batches'){
			
			$data['select_course_detail'] = $this->course_model->get_course_by_id($_POST['course_id']);
			$data['active_batches'] = $this->course_model->get_course_batch_details($_POST['course_id']);
			$data['selected_batch'] = $_POST['selectbatch'];
			$post_data = array(
				'course_id' => $_POST['course_id'],
				'batch_id' => $_POST['selectbatch'],
				'startdate' => $_POST['startdate'],
				'enddate' => $_POST['enddate'],
			);
			// print_r($post_data);
			$data['result_payments'] = $this->report_model->income_report($post_data);
			$data['select_start_date'] = $_POST['startdate'];
		 $data['select_end_date'] =  $_POST['enddate'];
				 $total = 0;
				 foreach ($data['result_payments'] as $key => $payment) {
					 $total  = $total + $payment->paid_amount;
				 }
				 $data['total_income_graph'] = number_format($total,2,".","");
				 $data['total_income'] = number_format($total,2);
				 $this->load->view('income-report-view',$data);
		}
		else{
			$data['select_course_detail'] = $this->course_model->get_course_by_id($_POST['course_id']);
			$data['active_batches'] = $this->course_model->get_course_batch_details($_POST['course_id']);
			$data['selected_batch'] = $_POST['selectbatch'];
		 $data['select_start_date'] = $_POST['startdate'];
		 $data['select_end_date'] =  $_POST['enddate'];

					$post_data = array(
						'course_id' => $_POST['course_id'],
						'batch_id' => $_POST['selectbatch'],
						'startdate' => $_POST['startdate'],
						'enddate' => $_POST['enddate'],
					);
				 $data['result_payments'] = $this->report_model->income_report($post_data);
				 $total = 0;
				 foreach ($data['result_payments'] as $key => $payment) {
					 $total  = $total + $payment->paid_amount;
				 }
				 $data['total_income_graph'] = number_format($total,2,".","");
				 $data['total_income'] = number_format($total,2);
				 $this->load->view('income-report-view',$data);
		}
		 
	}
 }


/**
 * process registration report 
 */

public function registrationReport($step=1){
	if($step == 1){
		$data['active_courses'] = $this->course_model->get_all_courses_base_state('active');
		$this->load->view('registration-report-view',$data);
	}elseif ($step == 2) {
		// print_r($_POST);
		if(isset($_POST['selectcourse']) && $_POST['selectcourse'] == 0){
			$data['select_course_detail'] = 'All Courses';
			$data['active_batches'] = 'All Batches';
		}else{
			$select_course_detail = $this->course_model->get_course_by_id($_POST['selectcourse']);
			$data['select_course_detail'] = $select_course_detail;
			$data['selected_batch'] = 'All Batches';
			$data['active_batches'] = $this->course_model->get_course_batch_details($_POST['selectcourse']);
		}
		
		 
		
		$this->load->view('registration-report-view',$data);
	}elseif ($step == 3) {
		//  print_r($_POST);

		if($_POST['course_id'] == 'All Courses' && $_POST['selectbatch'] == 'All Batches'){
			
			$data['select_course_detail'] = 'All Courses';
			$data['active_batches'] = 'All Batches';
			$data['selected_batch'] = 'All Batches';

			$post_data = array(
				'course_id' => $_POST['course_id'],
				'batch_id' => $_POST['selectbatch'],
				'startdate' => $_POST['startdate'],
				'enddate' => $_POST['enddate'],
			);
			$data['result_registration'] = $this->report_model->registration_report($post_data);

			$data['select_start_date'] = $_POST['startdate'];
		 	$data['select_end_date'] =  $_POST['enddate'];
			
			$this->load->view('registration-report-view',$data);


		}else if($_POST['course_id'] != 'All Courses' && $_POST['selectbatch'] == 'All Batches'){
			
			$data['select_course_detail'] = $this->course_model->get_course_by_id($_POST['course_id']);
			$data['active_batches'] = $this->course_model->get_course_batch_details($_POST['course_id']);
			$data['selected_batch'] = $_POST['selectbatch'];
			$post_data = array(
				'course_id' => $_POST['course_id'],
				'batch_id' => $_POST['selectbatch'],
				'startdate' => $_POST['startdate'],
				'enddate' => $_POST['enddate'],
			);
			// print_r($post_data);
			$data['result_registration'] = $this->report_model->registration_report($post_data);
			$data['select_start_date'] = $_POST['startdate'];
			$data['select_end_date'] =  $_POST['enddate'];
				 
				//  print_r($data);
				 $this->load->view('registration-report-view',$data);
		}
		else{
			$data['select_course_detail'] = $this->course_model->get_course_by_id($_POST['course_id']);
			$data['active_batches'] = $this->course_model->get_course_batch_details($_POST['course_id']);
		 $data['selected_batch'] = $_POST['selectbatch'];
		 $data['select_start_date'] = $_POST['startdate'];
		 $data['select_end_date'] =  $_POST['enddate'];

					$post_data = array(
						'course_id' => $_POST['course_id'],
						'batch_id' => $_POST['selectbatch'],
						'startdate' => $_POST['startdate'],
						'enddate' => $_POST['enddate'],
					);
				 $data['result_registration'] = $this->report_model->registration_report($post_data);
	
				 $this->load->view('registration-report-view',$data);
		}
		 
	}
 }


public function pdf(){

if(isset($_POST['registrationreport'])){
	$result_registration =unserialize($_POST['registrationreport']);
	$start_date = $_POST['startdate'];
	$end_date = $_POST['enddate'];
	
	

	$html =  "<table border='1' style='margin-top:40px;width:100%;border:1px black solid;border-collapse: collapse;'><thead ><tr><th style='padding:10px;'>Total Registration</th><th scope='col'>Duration</th></tr></thead><tbody><tr><td style='text-align:center;padding:10px;'>{$result_registration['student_count']} </td><td style='text-align:center;'>$start_date to  $end_date</td></tr></tbody></table><hr><table border='1' style='width:100%;border:1px black solid;border-collapse: collapse;'><thead class='bg-primary'><tr><th scope='col'>Batch Name</th><th scope='col'>Student Count</th></tr></thead><tbody>";
	

	foreach ($result_registration['registration_obj'] as $key => $course) {

		if (isset($course['batches']) && is_array($course['batches']) && count($course['batches']) > 0) {

			$html .= "<tr  style='background-color:#ccc';'><td style='text-align:center;padding:10px;' colspan='2'>{$course['course_detail']}</td></tr>";
			
			foreach ($course['batches'] as $key => $batch) {
				$html .= "<tr><td style='padding:10px;' >batch # {$batch['batch_id']}</td><td>{$batch['student_count']}</td></tr>";
			}
		}
	}

	$html .= "<tr><td style='padding:10px;' >Grand Total</td><td > {$result_registration['student_count']}</td></tr></tbody></table>";
}
if(isset($_POST['paymentreport'])){

	$result_payments =unserialize($_POST['paymentreport']);
	$total_income = $_POST['total'];
	$start_date = $_POST['startdate'];
	$end_date = $_POST['enddate'];
	

	$html = "<table border='1' style='margin-top:40px;width:100%;border:1px black solid;border-collapse: collapse;'><thead><tr><th style='padding:10px;' >Total income</th><th scope='col'>Duration</th></tr></thead><tbody><tr><td>LKR  {$total_income}</td><td>$start_date to  $end_date</td></tr></tbody></table><hr>";

          $html .= "<table border='1' style='width:100%;border:1px black solid;border-collapse: collapse;'><thead><tr><th style='padding:10px;'>Date</th><th scope='col'>Reg. No</th><th scope='col'>Student Name</th><th scope='col'>Course Name</th><th scope='col'>Batch Number</th><th style='text-align:right;'>ReciptNo</th><th style='text-align:right;'>Paid Amount</th></tr></thead><tbody>";
        foreach ($result_payments as $key => $payment) {
					$html .= "<tr><td> {$payment->paid_date}</td><td> {$payment->student_detail->student_id} </td><td> {$payment->student_detail->first_name}   {$payment->student_detail->last_name} </td><td> {$payment->course_batch_detail->course_detail->course_name} </td><td> {$payment->course_batch_detail->batch_number} </td><td style='text-align:right;'> {$payment->receipt_number}</td><td style='text-align:right'>"; $html .= number_format($payment->paid_amount,2);
					$html .="</td></tr>";
        }
        $html .= "<tr><td colspan='6' style='text-align:right;'>Grand Total</td><td style='text-align:right;'> LKR {$total_income}</td></tr></tbody></table>";

}
	



	$this->load->library('pdf');
	$this->dompdf->loadHtml($html);
	$this->dompdf->setPaper('A4', 'landscape');
	$this->dompdf->render();
	$this->dompdf->stream("welcome.pdf", array("Attachment"=>1));
}
 

 

}
?>
