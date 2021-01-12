<?php 
class Course_model extends CI_Model
{
    /**
     * get all courses
     */
    public function get_all_coures(){
        $this->db->select('*');
        $this->db->from('course_table');
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return $query->result();
        }else{
            return(0);
        }
    
    }
    /**
     * get all courses base on course state
     */
    public function get_all_courses_base_state($state){
        $condition = "state =" . "'" . $state . "'";
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
     * get trainer details by trainer id
     */
    public function get_course_by_id($courseid){
        $condition = "course_id =" . "'" . $courseid . "'";
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
     * add new course
     */
    public function add_new_course($data)
    {
        $this->db->insert('course_table', $data);
        // echo $this->db->last_query();
        if ($this->db->affected_rows() > 0) {
            return(1);
        }else{
            return(0);
        }
    }


    /**
     * add new subject
     */
    public function add_new_subject($data)
    {
        $this->db->insert('subject_table', $data);
        // echo $this->db->last_query();
        if ($this->db->affected_rows() > 0) {
            return(1);
        }else{
            return(0);
        }
    }


     /**
     * get subject details base on course id and subject id
     */
    public function get_subject($courseid,$subjectid){
        $condition = "course_id =" . "'" . $courseid . "' && subject_id ='" . $subjectid . "'";
        $this->db->select('*');
        $this->db->from('subject_table');
        $this->db->where($condition);
        $this->db->limit(1);
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return $query->result();
        }else{
            return(0);
        }
    }
        /**
         * update subject details
         */
    public function update_subject($data){

        $condition ="subject_id =" . "'" .  $data['subject_id'] . "'";
        $this->db->set('subject_name', $data['subject_name']);
        $this->db->set('state', $data['state'] );
        $this->db->where($condition);
                        
        $this->db->update('subject_table');

        if($this->db->affected_rows() == 1){
            return(1);
        }else if($this->db->affected_rows() == 0){
            return(0);
        }else{
            return(-1);
        }

    }
    


    /**
     * link batch to a course
     */
    public function map_batch_with_course($data){
        // print_r($data);
        // check if batch already exist
        $condition = "course_id =" . "'" . $data['course_id'] . "' AND batch_number = '" . $data['batch_number'] . "'";
        $this->db->select('*');
        $this->db->from('batch_table');
        $this->db->where($condition);

       if($this->db->count_all_results() >0 ){
            return ('batch found');
       }else{
            $this->db->insert('batch_table', $data);
            $this->db->last_query();
            if ($this->db->affected_rows() > 0) {
                return(1);
            }else{
                return(0);
            } 
       }
   
    }

    
    /**
     * get all batches assigned to a course and all other realted 
     */

     public function get_course_batch_details($course_id){
        $this->load->model('User_model', 'userModel');
        

        $condition = "course_id = " . "'" . $course_id . "'";
        $this->db->select('*');
        $this->db->from('batch_table');
        $this->db->where($condition);
        $query = $this->db->get();
        if($query->num_rows() > 0){
            $batches = $query->result();
            foreach ($batches as $key => $batch) {
                //  print_r($batch);
                 $batches[$key]->batch_object = $this->userModel->batch_details_with_course_detail($batch->batch_id);
                 $batches[$key]->staff_object = $this->userModel->get_Staff_detail_by_id($batch->staff_id)[0];
                 

                  $batches[$key]->trainer_object = $this->userModel-> trainer_map_to_batch($batch->batch_id);
                //  $batches[$key]->payment_object = $this->payment_schedule($studentid,$batch->batch_id);
             }
             return $batches;

        }else{
            return(0);
        }
     }
     /**
      * get all subjects in a course
      */
     public function get_all_subjects($course_id){
        $condition = "course_id = " . "'" . $course_id . "'";
        $this->db->select('*');
        $this->db->from('subject_table');
        $this->db->where($condition);
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return $query->result();
        }else{
            return(0);
        }

     }
    
}