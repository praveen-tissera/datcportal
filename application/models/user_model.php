<?php 
class User_model extends CI_Model
{
   
   

    /*************************************************************************************** */
    /**
     * 
     * DATC institute models
     * 
     */

    /**
     * validate student and trainer login
     */
    public function student_trainer_login($data){
        
        if($data['user-type'] == 'student'){
           //print_r($data);
            //student login
            $condition = "email =" . "'" . $data['email'] . "' AND " . "password =" . "'" . $data['password'] . "'";
            $this->db->select('*');
            $this->db->from('student_table');
            $this->db->where($condition);
            $this->db->limit(1);
            
            $query = $this->db->get();
           // echo $this->db->last_query();
            $query->num_rows();
            if ($query->num_rows() == 1) {
                return true;
            } 
            else {
                return false;
            }
        }
        else if($data['user-type'] == 'trainer'){
            //trainer login
            $condition = "email =" . "'" . $data['email'] . "' AND " . "password =" . "'" . $data['password'] . "'";
            $this->db->select('*');
            $this->db->from('trainer_table');
            $this->db->where($condition);
            $this->db->limit(1);
            $query = $this->db->get();
            $query->num_rows();
            if ($query->num_rows() == 1) {
                return true;
            } 
            else {
                return false;
            }
        }

    }
    /**
     * validate staff login
     */
    public function staff_login($data){
        
        
           //print_r($data);
            //student login
            $condition = "email =" . "'" . $data['email'] . "' AND " . "password =" . "'" . $data['password'] . "'";
            $this->db->select('*');
            $this->db->from('staff_table');
            $this->db->where($condition);
            $this->db->limit(1);
            
            $query = $this->db->get();
           // echo $this->db->last_query();
            $query->num_rows();
            if ($query->num_rows() == 1) {
                return true;
            } 
            else {
                return false;
            }
     
    }



    // Read data from database to show data in admin page
    public function read_Staff_information($email) {
        
            $condition = "email =" . "'" . $email . "'";
        $this->db->select('*');
        $this->db->from('staff_table');
        $this->db->where($condition);
        $this->db->limit(1);
        $query = $this->db->get();

            if ($query->num_rows() == 1) {
                return $query->result();
            } 
            else {
                return false;
            }
        
    }

    // Read data from database to show data in admin page
    public function get_Staff_detail_by_id($staff_id) {
        
        $condition = "staff_id =" . "'" . $staff_id . "'";
    $this->db->select('*');
    $this->db->from('staff_table');
    $this->db->where($condition);
    $this->db->limit(1);
    $query = $this->db->get();

        if ($query->num_rows() == 1) {
            return $query->result();
        } 
        else {
            return false;
        }
    
}



    // Read data from database to show data in admin page
    public function read_StudentTraner_information($email,$userType) {
        if($userType == 'student'){
            $condition = "email =" . "'" . $email . "'";
        $this->db->select('*');
        $this->db->from('student_table');
        $this->db->where($condition);
        $this->db->limit(1);
        $query = $this->db->get();

            if ($query->num_rows() == 1) {
                return $query->result();
            } 
            else {
                return false;
            }
        }
        else if($userType == 'trainer'){
            $condition = "email =" . "'" . $email . "'";
            $this->db->select('*');
            $this->db->from('trainer_table');
            $this->db->where($condition);
            $this->db->limit(1);
            $query = $this->db->get();

            if ($query->num_rows() == 1) {
                return $query->result();
            } 
            else {
                return false;
            }
        }
    }
    /**
     * read all the active course
     * 
     */

    public function read_all_active_courses(){
        $this->db->select('*');
        $this->db->from('course_table');
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return $query->result();
        }else{
            return false;
        }
    }

    /**
     * read all active courses base on course type
     */
    public function read_active_course($data){
        if($data == 'diploma'){
            $condition = "course_type = " . "'" . $data . "' AND state = 'active'";
        }else if($data == 'training'){
            $condition = "course_type = 'threedays' OR course_type = 'oneday'  AND state = 'active'";
        }
        
        $this->db->select('*');
        $this->db->from('course_table');
        $this->db->where($condition);
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return $query->result();
        }else{
            return false;
        }

    }
    /**
     * read all active batches for a course
     */
    public function read_active_batch($data){
        $condition = "course_id = " . "'" . $data . "' AND state = 'active'";
        $this->db->select('*');
        $this->db->from('batch_table');
        $this->db->where($condition);
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return $query->result();
        }else{
            return false;
        }

    }
    /**
     * read course details by course id with active status
     */

     public function read_active_course_byid($data){
        $condition = "course_id = " . "'" . $data . "' AND state = 'active'";
        $this->db->select('*');
        $this->db->from('course_table');
        $this->db->where($condition);
        $this->db->limit(1);
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return $query->result();
        }else{
            return false;
        }


     }
     /**
     * read course details by course id and should be active course
     */

    public function read_active_batch_byid($data){
        $condition = "batch_id = " . "'" . $data . "' AND state = 'active'";
        $this->db->select('*');
        $this->db->from('batch_table');
        $this->db->where($condition);
        $this->db->limit(1);
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return $query->result();
        }else{
            return false;
        }


     }
     /**
      * register student online
      */
     public function student_registration_online($data,$batch_id,$login_status,$student_id){

        if($login_status){

            $data = array(
                'student_id' => $student_id,
				'batch_id' => $batch_id,
				'staff_id' => 3,
				'added_date' => Date('Y-m-d'),
				'state' => 'pending',
				'certificate_no' => NuLL
                );
                $this->db->trans_begin();
                $this->db->insert('student_batch_map_table', $data);
                // echo $this->db->last_query();
                if( $this->db->trans_status() === FALSE ){
                    $this->db->trans_rollback();
                    return(0);
                }else{
                    $this->db->trans_commit();
                    // echo $insert_id;
                    return  (1);
                }  

        }else{

            // Query to check whether username already exist or not
        $condition = "email =" . "'" . $data['email'] . "'";
        $this->db->select('*');
        $this->db->from('student_table');
        $this->db->where($condition);
        $this->db->limit(1);
        $query = $this->db->get();
        if ($query->num_rows() == 0) {
            $data['register_date'] = date('Y-m-d');
            //$data['state'] = 'pending';
            //$data['email_url'] = sha1(time() . $data['email']);
            
            // Query to insert data in database
            $this->db->trans_begin();
            $this->db->insert('student_table', $data);
            
            if( $this->db->trans_status() === FALSE ){
                
                $this->db->trans_rollback();
                //return( 0 );

            }else{
                
                $insert_id = $this->db->insert_id();
                // echo $insert_id;
                $data = array(
                'student_id' => $insert_id,
				'batch_id' => $batch_id,
				'staff_id' => $data['staff_id'],
				'added_date' => $data['register_date'],
				'state' => 'pending',
				'certificate_no' => NuLL
                );
                
                $this->db->insert('student_batch_map_table', $data);
                // echo $this->db->last_query();
                if( $this->db->trans_status() === FALSE ){
                    $this->db->trans_rollback();
                    return(0);
                }else{
                    $this->db->trans_commit();
                    // echo $insert_id;
                    return  ($insert_id);
                }   
                
            }
        } 
        else {
            return(0);
        }

        }

        
}
/**
 * check whether student register to a course 
 * 
 */

    public function read_student_register_to_course($student_id,$batch_id){
        $condition = "student_id =" . "'" . $student_id . "' AND batch_id = '". $batch_id ."'";
        $this->db->select('*');
        $this->db->from('student_batch_map_table');
        $this->db->where($condition);
        $this->db->limit(1);
        $query = $this->db->get();
        if ($query->num_rows() == 1) {
            return (1);
        }else{
            return (0);
        }
    }

    public function get_pending_students(){
        $condition = "state ='pending'";
        $this->db->select('*');
        $this->db->from('student_table');
        $this->db->where($condition);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        }else{
            return (0);
        }
    }
    /**
     * read pending student detail by student id
     */
    public function get_pending_student_batch($student_id){
        $condition = "student_id =" . "'" . $student_id . "' AND state = 'pending'";
        $this->db->select('*');
        $this->db->from('student_batch_map_table');
        $this->db->where($condition);
        
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        }else{
            return (0);
        }
    }

    /**
     * read student full detail by student id
     */
	public function student_detail_byid($student_id){
        $condition = "student_id =" . "'" . $student_id . "'";
        $this->db->select('*');
        $this->db->from('student_table');
        $this->db->where($condition);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        }else{
            return (0);
        }
    }

    /**
     * read course details by course id
     */
    public function read_course_byid($course_id){
        $condition = "course_id = " . "'" . $course_id . "'";
        $this->db->select('*');
        $this->db->from('course_table');
        $this->db->where($condition);
        $this->db->limit(1);
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return $query->result();
        }else{
            return false;
        }


     }  
     /**
      * read batch detail by batch id
      */

     public function read_batch_byid($batch_id){
        $condition = "batch_id = " . "'" . $batch_id . "'";
        $this->db->select('*');
        $this->db->from('batch_table');
        $this->db->where($condition);
        $this->db->limit(1);
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return $query->result();
        }else{
            return false;
        }


     }

     public function update_student_payment($data,$staff_id){
        // echo "<hr>";
        // print_r($data);
        // print_r($staff_id);


        if($data['pay_type'] == 1){
            // full payment
            // print_r($data);
            // Array ( [student-id] => 1 [batch-id] => 1 [course-id] => 1 [firstname] => chinthana [lastname] => perera [bdate] => 1997-08-04 [email] => chinthan@gmail.com [telephone] => [pay_type] => 1 [fullpayment] => 30000.00 [installment-one] => 15000.00 [installment-two] => 15000.00 [installment-two-date] => 2022-11-15 )
            // INSERT INTO `payment_schedule_table` (`payment_id`, `student_id`, `batch_id`, `payment_status`, `amount`, `payment_due_date`, `added_date`) VALUES (NULL, '1', '1', 'full', '30000', '2020-10-13', '2020-10-13');
            $data = array(
                'student_id' => $data['student-id'],
				'batch_id' => $data['batch-id'],
				'payment_status' => 'full',
				'amount' => $data['fullpayment'],
                'payment_due_date' => NuLL,
                'added_date' => Date('Y-m-d')
                );
                $this->db->trans_begin();
                $this->db->insert('payment_schedule_table', $data);
                $insert_id = $this->db->insert_id();
                if( $this->db->trans_status() === FALSE ){
                    $this->db->trans_rollback();
                    echo "fail";
                    return(0);
                }else{
                   
                        echo "payment scheduel works<br>";
                        // receipt number hardcorded
                        // print_r($data);
                        $data_payment_receive = array(
                        'payment_id' => $insert_id,
                        'receipt_number' => date("YmdHis"),
                        'paid_amount' => $data['amount'],
                        'paid_date' => Date('Y-m-d'),
                        'staff_id' => $staff_id,
                        'add_date' => Date('Y-m-d')
                        );
                    $this->db->insert('payment_receive_table', $data_payment_receive);
                    if( $this->db->trans_status() === FALSE ){
                        $this->db->trans_rollback();
                        echo "fail";
                         return(0);
                    }else{
                        echo "payment receive works<br>";
                        echo 'payment receive id' . $insert_id;
                        
                        $condition ="student_id =" . "'" .  $data['student_id'] . "' AND batch_id=" . "'" . $data['batch_id'] . "'";
                        $this->db->set('state', 'active');
                        $this->db->where($condition);
                        
                        $this->db->update('student_batch_map_table');
                        if( $this->db->trans_status() === FALSE ){
                            $this->db->trans_rollback();
                            echo "fail";
                             return(0);
                        }else{
                            echo "update student map table <br>";
                            // set student account to active
                        $condition ="student_id =" . "'" .  $data['student_id'] . "'";
                        $this->db->set('state', 'active');
                        $this->db->where($condition);
                        
                        $this->db->update('student_table');

                            //need to pass receipt number 

                            $this->db->trans_commit();
                            echo " finally pass pass";
                            return $data_payment_receive['receipt_number'];
                           
                        }   

                        
                    }
   
                }
        }else{
            // part payment
        

            // will use to update only the 1st installment 
           
                $data = array(
                    array(
                        'student_id' => $data['student-id'],
                        'batch_id' => $data['batch-id'],
                        'payment_status' => '1st installment',
                        'amount' => $data['installment-one'],
                        'payment_due_date' => NuLL,
                        'added_date' => Date('Y-m-d')
                    ),
                    array(
                        'student_id' => $data['student-id'],
                        'batch_id' => $data['batch-id'],
                        'payment_status' => '2nd installment',
                        'amount' => $data['installment-two'],
                        'payment_due_date' => $data['installment-two-date'],
                        'added_date' => Date('Y-m-d')
                        )

                );

                $this->db->trans_begin();
                 $this->db->insert('payment_schedule_table', $data[0]);
                // $this->db->insert_batch('payment_schedule_table', $data); 
                $insert_id = $this->db->insert_id();
                if( $this->db->trans_status() === FALSE ){
                    $this->db->trans_rollback();
                    echo "fail";
                     return(0);
                }else{
                   
                        echo "payment scheduel works<br>";
                        // receipt number hardcorded
                        // print_r($data);
                        $data_payment_receive = array(
                        'payment_id' => $insert_id,
                        'receipt_number' => date("YmdHis"),
                        'paid_amount' => $data[0]['amount'],
                        'paid_date' => Date('Y-m-d'),
                        'staff_id' => $staff_id,
                        'add_date' => Date('Y-m-d')
                        );
                    $this->db->insert('payment_receive_table', $data_payment_receive);
                    if( $this->db->trans_status() === FALSE ){
                        $this->db->trans_rollback();
                        echo "fail";
                         return(0);
                    }else{
                        echo "payment receive works<br>";
                        echo 'payment receive id' . $insert_id;
                        
                        $condition ="student_id =" . "'" .  $data[0]['student_id'] . "' AND batch_id=" . "'" . $data[0]['batch_id'] . "'";
                        $this->db->set('state', 'active');
                        $this->db->where($condition);
                        
                        $this->db->update('student_batch_map_table');
                        if( $this->db->trans_status() === FALSE ){
                            $this->db->trans_rollback();
                            echo "fail";
                            
                             return(0);
                        }else{
                            echo "update student map table <br>";
                            // set student account to active
                        $condition ="student_id =" . "'" .  $data[0]['student_id'] . "'";
                        $this->db->set('state', 'active');
                        $this->db->where($condition);
                        
                        $this->db->update('student_table');

                            //need to pass receipt number 

                            $this->db->trans_commit();

                            $this->db->insert('payment_schedule_table', $data[1]);
                            echo " finally installament payment registration pass";
                            return $data_payment_receive['receipt_number'];
                           
                        }   

                        
                    }

   
                }



        }


    }
    public function register_student_offiline($data_student,$data_course_batch,$payment_detail){
        echo "<br>";
        // print_r($data_course_batch);
         // Query to check whether username already exist or not
         $condition = "email =" . "'" . $data_student['email'] . "'";
         $this->db->select('*');
         $this->db->from('student_table');
         $this->db->where($condition);
         $this->db->limit(1);
         $query = $this->db->get();
         if ($query->num_rows() == 0) {
             $data['register_date'] = date('Y-m-d');
             //$data['state'] = 'pending';
             //$data['email_url'] = sha1(time() . $data['email']);
             
             // Query to insert data in database
             $this->db->trans_begin();
             $this->db->insert('student_table', $data_student);
             
             if( $this->db->trans_status() === FALSE ){
                 
                 $this->db->trans_rollback();
                 //return( 0 );
 
             }else{
                //  get student id
                 $insert_id = $this->db->insert_id();
                 // echo $insert_id;

                 //insert student id to batch detail table and keep student id on top for table insertion
                 $data_course_batch['student_id'] = $insert_id;
                 $data_course_batch = array_reverse($data_course_batch);

                 $this->db->insert('student_batch_map_table', $data_course_batch);
                 // echo $this->db->last_query();
                 if( $this->db->trans_status() === FALSE ){
                     $this->db->trans_rollback();
                     return(0);
                 }else{
                     $this->db->trans_commit();
                     echo "student details added";
                     // echo $insert_id;
                     //return  ($insert_id);
                     
                     $data_payment = array(
                         'student-id' =>$insert_id,
                         'batch-id' => $data_course_batch['batch_id'],
                         'fullpayment' => $payment_detail['fullpayment'],
                         'pay_type' => $payment_detail['pay_type'],
                         'installment-two-date'=> $payment_detail['due-date'],
                         'installment-one' => $payment_detail['installmentone'],
                         'installment-two' => $payment_detail['installmenttwo']


                     );
                    //  call payment handle method which use to do online register student payments.
                     $payment_output = $this->update_student_payment($data_payment,$data_course_batch['staff_id']);
                     if($payment_output == '0'){
                        $this->db->trans_rollback();
                        return(0);
                     }else{
                        //  print_r($payment_output);
                        $register_student_detail = array(
                            'student_reg_id' => $insert_id,
                            'receipt_number' => $payment_output
                        );
                        return $register_student_detail;
                     }


                 }   
                 
             }
         } 
         else {
             return('email found');
         }
 
    }

   public function batch_details_with_course_detail($batchid){
        $condition = "batch_id = " . "'" . $batchid . "'";
        $this->db->select('*');
        $this->db->from('batch_table');
        $this->db->where($condition);
        $this->db->limit(1);
        $query = $this->db->get();
        if($query->num_rows() > 0){
            $batches = $query->result();
            $course_detail = $this->read_course_byid($batches[0]->course_id);
            $batches[0]->course_detail = $course_detail[0];
            // print_r($batches[0]->course_detail->course_name);
            // print_r($batches);
            return $batches[0];
        }else{
            return false;
        }
   }
   /**
    * return payment sechedule for student * batch wise
    * supprorting method
    * payment_receive()
    */
   public function payment_schedule($studentid,$batchid){
        $condition = "student_id = " . "'" . $studentid . "' && batch_id = " . "'" . $batchid . "'";
        $this->db->select('*');
        $this->db->from('payment_schedule_table');
        $this->db->where($condition);
        // $this->db->limit(1);
        $query = $this->db->get();
        if($query->num_rows() > 0){
            $payments = $query->result();
            foreach ($payments as $key => $payment) {
               $payments[$key]->payment_receive =  $this->payment_receive($payment->payment_id);
            }
            
            return $payments;
        }else{
            return false;
        }
   }

   public function payment_receive($paymentid){
        $condition = "payment_id = " . "'" . $paymentid . "'";
        $this->db->select('*');
        $this->db->from('payment_receive_table');
        $this->db->where($condition);
        $this->db->limit(1);
        $query = $this->db->get();
        if($query->num_rows() > 0){
            $payment_receive = $query->result();
            // $course_detail = $this->read_course_byid($batches[0]->course_id);
            // $batches[0]->course_detail = $course_detail[0];
            // print_r($batches[0]->course_detail->course_name);
            // print_r($batches);
            return $payment_receive[0];
        }else{
            return false;
        }
   }

   /**
    * get student wise register batch, its * course details and payment details
    * supporting methods
    * batch_details_with_course_detail()
    * payment_schedule()
    * 
    */
    public function student_wise_batches_course($studentid){
        $condition = "student_id = " . "'" . $studentid . "'";
        $this->db->select('*');
        $this->db->from('student_batch_map_table');
        $this->db->where($condition);
        $query = $this->db->get();
        if($query->num_rows() > 0){
             $batches = $query->result();
            //  print_r($batches);
             foreach ($batches as $key => $batch) {
                //  print_r($batch);
                 $batches[$key]->batch_object = $this->batch_details_with_course_detail($batch->batch_id);
                 $batches[$key]->payment_object = $this->payment_schedule($studentid,$batch->batch_id);
                
            

             }
            //   print_r($batches);
              return $batches;
        }else{
            return false;
        }
    }

    /**
     * add 2nd installment only
     */
    public function add_installment_payment($payment_id,$batch_id,$staff_id,$paid_amount,$student_id){
        $data_payment_receive = array(
            'payment_id' => $payment_id,
            'receipt_number' => date("YmdHis"),
            'paid_amount' => $paid_amount,
            'paid_date' => Date('Y-m-d'),
            'staff_id' => $staff_id,
            'add_date' => Date('Y-m-d')
            );
        $this->db->trans_begin();
        $this->db->insert('payment_receive_table', $data_payment_receive);
        if( $this->db->trans_status() === FALSE ){
            $this->db->trans_rollback();
            echo "fail";
            return(0);
        }else{
            // update studend batch map table student status
            $condition ="student_id =" . "'" .  $student_id . "' AND batch_id=" . "'" . $batch_id . "'";
                        $this->db->set('state', 'active');
                        $this->db->where($condition);
                        
                        $this->db->update('student_batch_map_table');

            if( $this->db->trans_status() === FALSE ){
                $this->db->trans_rollback();
                echo "fail";
                return(0);
            }else{
                $this->db->trans_commit();
                return(1);
            }
            

        }
        
    }
    public function payment_schedule_by_paymentid($payment_id){
        $condition = "payment_id = " . "'" . $payment_id . "'";
        $this->db->select('*');
        $this->db->from('payment_schedule_table');
        $this->db->where($condition);
        $this->db->limit(1);
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return $query->result();
        }else{
            return(0);
        }
    }
}