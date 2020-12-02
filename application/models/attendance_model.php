<?php 
class Attendance_model extends CI_Model
{
  
    /**
     * get students details who are registered to a batch
     */
    public function get_students_by_batch_id($batchid){
        $this->load->model('User_model', 'userModel');
        $condition = "batch_id =" . "'" . $batchid . "'";
        $this->db->select('*');
        $this->db->from('student_batch_map_table');
        $this->db->where($condition);
        
        $query = $this->db->get();
        if($query->num_rows() > 0){
            // return $query->result();
            // print_r($query->result());
            $student_obj = $query->result();
            foreach ($student_obj as $key => $value) {
               $student_info =  $this->userModel->student_detail_byid($value->student_id)[0];
                $student_obj[$key]->student_detail = $student_info;
                
            }
            return $student_obj;
        }else{
            return(0);
        }
    }
    /**
     * add new attendance
     */
    public function add_new_attendance($data)
    {
        // print_r($data);

        $condition = "student_id =" . "'" . $data['student_id'] . "' && batch_id = '" . $data['batch_id'] . "'";
        $this->db->select('*');
        $this->db->from('student_attendance_table');
        $this->db->where($condition);
        
        $query = $this->db->get();
        // echo $this->db->last_query();
        if($query->num_rows() > 0){

            $condition ="student_id =" . "'" .  $data['student_id'] . "' AND batch_id=" . "'" . $data['batch_id'] . "'";
            $this->db->set('status', $data['status']);
            $this->db->where($condition);
            
            $this->db->update('student_attendance_table');
            if ($this->db->affected_rows() > 0) {
                return(1);
            }else{
                return(0);
            }


        }else{
            
            $this->db->insert('student_attendance_table', $data);
            // echo $this->db->last_query();
            if ($this->db->affected_rows() > 0) {
                return(1);
            }else{
                return(0);
            }
        }

       
    }

    


   
}