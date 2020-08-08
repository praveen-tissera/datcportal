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
     * read all active courses
     */
    public function read_active_course($data){
        $condition = "course_type = " . "'" . $data . "' AND state = 'active'";
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
        $this->db->limit(1);
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
}