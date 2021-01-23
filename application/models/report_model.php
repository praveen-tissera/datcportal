<?php 
class Report_model extends CI_Model
{
   /**
    * income report 
    */
    public function income_report($data){
         $this->load->model('Course_model', 'courseModel');
         $this->load->model('trainer_model', 'trainerModel');
         $this->load->model('user_model', 'userModel');
         $this->load->model('search_model', 'searchModel');

        //  print_r($data);
        if($data['course_id']=='All Courses' && $data['batch_id']=='All Batches' ){
            $condtion = "paid_date >= '". $data['startdate'] ."' AND paid_date <= '". $data['enddate'] ."'"; 
        }else if($data['course_id'] !='All Courses' && $data['batch_id']=='All Batches'){
                $batches = $this->courseModel->get_course_batch_details($data['course_id']); 
                // print_r($batches);
                $batch_string = '';
                foreach ($batches as $key => $batch) {
                    $batch_string = $batch_string . "`batch_id`=". $batch->batch_id . ' OR ';
                }
                
                $batch_string =  substr("$batch_string", 0, -3);
                // echo $batch_string;
                $condtion = "paid_date >= '". $data['startdate'] ."' AND paid_date <= '". $data['enddate'] ."' AND (". $batch_string . ")"; 
        }
        else{
            $condtion = "paid_date >= '". $data['startdate'] ."' AND paid_date <= '". $data['enddate'] ."' AND batch_id =". $data['batch_id'] ; 
        }
         


        // $condtion = "paid_date >= '2020-11-19'"; 
        $this->db->select('receipt_number,paid_date,payment_receive_table.payment_id, paid_amount, student_id, batch_id');
        $this->db->from('payment_receive_table');
        $this->db->join('payment_schedule_table', 'payment_schedule_table.payment_id=payment_receive_table.payment_id');
         $this->db->where($condtion);
        $query= $this->db->get();
        // echo $this->db->last_query();
        //  print_r($query->result());
        $payments = $query->result();
        foreach ($payments as $key => $payment) {
            $payments[$key]->student_detail =$this->userModel->student_detail_byid($payment->student_id)[0];
            $payments[$key]->course_batch_detail = $this->userModel->batch_details_with_course_detail($payment->batch_id);
        }
        //  print_r($payments);
        return $payments;

    }

    /**
     * student registration 
     */

    public function registration_report($data_receive){
        $this->load->model('Course_model', 'courseModel');
        $this->load->model('trainer_model', 'trainerModel');
        $this->load->model('user_model', 'userModel');
        $this->load->model('search_model', 'searchModel');

       //  print_r($data);
       if($data_receive['course_id']=='All Courses' && $data_receive['batch_id']=='All Batches' ){
        $condtion = "added_date >= '" . $data_receive['startdate'] . "' AND added_date <= ' " . $data_receive['enddate'] . "'";
        $this->db->select('*');
        $this->db->from('student_batch_map_table');
        $this->db->where($condtion);
        $query= $this->db->get();
        $data['student_count'] = $query->num_rows();


        $this->db->select('*');
        $this->db->from('batch_table');
        $this->db->group_by('course_id');
        $query= $this->db->get();

        if($query->num_rows() > 0){
            $result_course = $query->result();
            $registration_obj = array();
            
            foreach ($result_course as $key => $course) {
                $course_name = $this->userModel->read_course_byid($course->course_id)[0]->course_name;
                $registration_obj[$course->course_id]['course_id'] = $course->course_id;
                $registration_obj[$course->course_id]['course_detail'] = $course_name;
                    

                $condtion = "course_id = '". $course->course_id ."'" ; 
                $this->db->select('*');
                $this->db->from('batch_table');
                $this->db->where($condtion);
                $query= $this->db->get();
                // echo $this->db->last_query();
                // echo "<br>";
                $batches = $query->result();
                
                foreach ($batches as $key => $batch) {

                    $condtion = "batch_id = '". $batch->batch_id ."' AND ( added_date >= '" . $data_receive['startdate'] . "' AND added_date <= ' " . $data_receive['enddate'] . "')"; 

                    $this->db->select('*');
                    $this->db->from('student_batch_map_table');
                    $this->db->where($condtion);
                    
                    $query_student_batch_map= $this->db->get();
                    // echo $this->db->last_query();
                    // echo "<hr>";
                    if($query_student_batch_map->num_rows()>0){
                        $registration_obj[$course->course_id]['batches'][] = array (
                            'batch_id' => $batch->batch_number,
                            'student_count'=>$query_student_batch_map->num_rows()
                        );
                    }

                }


            }    
        }

           $this->db->select('*');
           $this->db->from('student_batch_map_table');
           $query= $this->db->get();
           $data['registration_obj'] = $registration_obj;
          
        //    print_r($data);
           return $data;







       }else if($data_receive['course_id'] !='All Courses' && $data_receive['batch_id']=='All Batches'){



        $condtion = "course_id='". $data_receive['course_id'] ."'";
        $this->db->select('*');
        $this->db->from('batch_table');
        $this->db->where($condtion);

        $query= $this->db->get();
        // echo $this->db->last_query();
        if($query->num_rows() > 0){
           $count = 0;
            $registration_obj = array();
            
            
                $course_name = $this->userModel->read_course_byid($data_receive['course_id'])[0]->course_name;
                $registration_obj[$data_receive['course_id']]['course_id'] = $data_receive['course_id'];
                $registration_obj[$data_receive['course_id']]['course_detail'] = $course_name;
                    

                $condtion = "course_id = '". $data_receive['course_id'] ."'" ; 
                $this->db->select('*');
                $this->db->from('batch_table');
                $this->db->where($condtion);
                $query= $this->db->get();
                // echo $this->db->last_query();
                // echo "<br>";
                $batches = $query->result();
                
                foreach ($batches as $key => $batch) {

                    $condtion = "batch_id = '". $batch->batch_id ."' AND ( added_date >= '" . $data_receive['startdate'] . "' AND added_date <= ' " . $data_receive['enddate'] . "')"; 

                    $this->db->select('*');
                    $this->db->from('student_batch_map_table');
                    $this->db->where($condtion);
                    
                    $query_student_batch_map= $this->db->get();
                    // echo $this->db->last_query();
                    // echo "<hr>";
                    if($query_student_batch_map->num_rows()>0){
                        $count = $count+$query_student_batch_map->num_rows();
                        $registration_obj[$data_receive['course_id']]['batches'][] = array (
                            'batch_id' => $batch->batch_number,
                            'student_count'=>$query_student_batch_map->num_rows()
                        );
                    }

                }   
        }

            $data['student_count'] = $count;
           $data['registration_obj'] = $registration_obj;
          
        //    print_r($data);
           return $data;





       }
       else{
           


        $condtion = "course_id='". $data_receive['course_id'] ."'";
        $this->db->select('*');
        $this->db->from('batch_table');
        $this->db->where($condtion);

        $query= $this->db->get();
        // echo $this->db->last_query();
        if($query->num_rows() > 0){
           $count = 0;
            $registration_obj = array();
            
            
                $course_name = $this->userModel->read_course_byid($data_receive['course_id'])[0]->course_name;
                $registration_obj[$data_receive['course_id']]['course_id'] = $data_receive['course_id'];
                $registration_obj[$data_receive['course_id']]['course_detail'] = $course_name;
                    

                $condtion = "batch_id = '". $data_receive['batch_id'] ."'" ; 
                $this->db->select('*');
                $this->db->from('batch_table');
                $this->db->where($condtion);
                $query= $this->db->get();
                // echo $this->db->last_query();
                // echo "<br>";
                $batches = $query->result();
                
                foreach ($batches as $key => $batch) {

                    $condtion = "batch_id = '". $batch->batch_id ."' AND ( added_date >= '" . $data_receive['startdate'] . "' AND added_date <= ' " . $data_receive['enddate'] . "')"; 

                    $this->db->select('*');
                    $this->db->from('student_batch_map_table');
                    $this->db->where($condtion);
                    
                    $query_student_batch_map= $this->db->get();
                    // echo $this->db->last_query();
                    // echo "<hr>";
                    if($query_student_batch_map->num_rows()>0){
                        $count = $count+$query_student_batch_map->num_rows();
                        
                        $registration_obj[$data_receive['course_id']]['batches'][] = array (
                            'batch_id' => $batch->batch_number,
                            'student_count'=>$query_student_batch_map->num_rows()
                        );
                    }

                }   
        }

            $data['student_count'] = $count;
           $data['registration_obj'] = $registration_obj;
          
        //    print_r($data);
           return $data;









       }
        


      
   
   }

}