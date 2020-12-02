<?php 
class Trainer_model extends CI_Model
{
    public function get_all_trainers(){
        $this->db->select('*');
        $this->db->from('trainer_table');
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return $query->result();
        }else{
            return false;
        }
    
    }
    public function get_all_trainers_base_state($state){
        $condition = "state =" . "'" . $state . "'";
        $this->db->select('*');
        $this->db->from('trainer_table');
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
    public function get_trainer_by_id($trainerid){
        $condition = "trainer_id =" . "'" . $trainerid . "'";
        $this->db->select('*');
        $this->db->from('trainer_table');
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
     * add new trainer profile
     */
    public function add_new_trainer($data)
    {
        $this->db->insert('trainer_table', $data);
        // echo $this->db->last_query();
        if ($this->db->affected_rows() > 0) {
            return(1);
        }else{
            return(0);
        }
    }
    /**
     * link trainer to a batch
     */
    public function map_trainer_with_batch($data){
        // print_r($data);
        // check if tainer already assigned to the batch
        $condition = "trainer_id =" . "'" . $data['trainer_id'] . "' AND batch_id = '" . $data['batch_id'] . "' AND state = 'active'";
        $this->db->select('*');
        $this->db->from('trainer_batch_map_table');
        $this->db->where($condition);

       if($this->db->count_all_results() >0 ){
            return ('user found');
       }else{
            $this->db->insert('trainer_batch_map_table', $data);
            echo $this->db->last_query();
            if ($this->db->affected_rows() > 0) {
                return(1);
            }else{
                return(0);
            } 
       }
   
    }

    /**
     * get all batches assigned to a trainer and all other realted 
     */

     public function get_trainer_batch_details($trainer_id){
        $this->load->model('User_model', 'userModel');

        $condition = "trainer_id = " . "'" . $trainer_id . "'";
        $this->db->select('*');
        $this->db->from('trainer_batch_map_table');
        $this->db->where($condition);
        $query = $this->db->get();
        if($query->num_rows() > 0){
            $batches = $query->result();
            foreach ($batches as $key => $batch) {
                //  print_r($batch);
                 $batches[$key]->batch_object = $this->userModel->batch_details_with_course_detail($batch->batch_id);

                //  $batches[$key]->payment_object = $this->payment_schedule($studentid,$batch->batch_id);
             }
             return $batches;

        }else{
            return(0);
        }
     }
    
}