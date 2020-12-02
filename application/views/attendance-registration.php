<?php

if (!($this->session->userdata('user_detail'))) {

  redirect('/user/login');
} else {
  $user_detail = $this->session->userdata('user_detail');
  
}


?>


<!-- lawyer profile and resouce link -->
<?php $this->load->view('header'); ?>
<?php $this->load->view('top-navigation'); ?>
<?php $this->load->view('staff-navigation'); ?>



<br>

<div class="container">
  <div class="row">
    <div class="col-12">
    <?php

    if (isset($error_message_display)) {
      echo '<div class="alert alert-danger" role="alert">';
      echo $error_message_display;
      echo '</div>';
    }
    if (isset($success_message_display)) {
      echo '<div class="alert alert-success" role="alert">';
      echo $success_message_display;
      echo '</div>';
    }

    ?>
    </div>
  </div>
    <?php 
    // print_r($studentManagement);
    
    if(isset($this->session->userdata('user_detail')['user-wise-menu'])){
      $userMenu = $this->session->userdata('user_detail')['user-wise-menu'];
          

          
  }
    
    ?>
    <div class="row">
    
    
      

      <div class="col-6">
          
      <?php 
        if(isset($active_courses)){
          echo '<label>Course name</label>';
          echo form_open('attendance/newAttendanceRegistration/2');
          echo "<select class='form-control' name='selectcourse'>";
          // print_r($active_courses);
          foreach ($active_courses as $key => $active_course) {
              echo "<option value='{$active_course->course_id}'>$active_course->course_name</option>";
          }
          echo "</select>";
          
        }elseif (isset($select_course_detail)) {
          echo '<label>Selected course</label>';
            echo "<p>{$select_course_detail[0]->course_name}</p>";
           
        }
        
      ?>

        </div>
        <?php
          if(isset($active_batches)){
            echo '<div class="col-6">';
            // print_r($active_batches);
            echo form_open('attendance/newAttendanceRegistration/3');
            echo "<input type='text' name='course_id' value={$select_course_detail[0]->course_id}>";
            echo '<label>Batch number</label>';
            echo "<select class='form-control' name='selectbatch'>";
            // print_r($active_courses);
              echo "<option>Select a batch</option>";
            foreach ($active_batches as $key => $active_batch) {
                echo "<option value='{$active_batch->batch_id}'>$active_batch->batch_number</option>";
            }
            echo "</select>";
  
          echo '</div>';
          }elseif (isset($select_batch_detail)) {
            // print_r($select_batch_detail);
            echo form_open('attendance/newAttendanceRegistration/4');
            echo "<input type='text' value='{$select_batch_detail->course_id}' name='course_id'>";
            echo "<input type='text' value='{$select_batch_detail->batch_id}' name='batch_id'>";
            echo '<div class="col-6">';
              echo '<label>Selected batch number : </label>';
              
              echo "<p>{$select_batch_detail->batch_number}</p>";
            echo "</div>";
          }
        ?>
      
        
  </div>

      <?php
      
        // print_r($student_in_batch_obj);
        if(isset($student_in_batch_obj) &&  $student_in_batch_obj != 0){
          echo "<div class='row'>";
            echo "<div class='col-12'>";

        $datetime = new DateTime($start_date);
        echo "<table class='table table-striped'>";
        echo "<tr>";
        echo "<th>";
          echo "Student name";
        echo "</th>";
        for($i=1;$i<=7;$i++){
            echo "<th>";
            $datetime->modify('+1 day');
            echo $datetime->format('Y-m-d');
            echo "</th>";
        }


        echo "</tr>";
          foreach ($student_in_batch_obj as $key => $student) {
         echo "<tr>";
            echo "<td>";
            // print_r($student);
              echo $student->student_detail->first_name . ' ' . $student->student_detail->last_name;
            echo "</td>";
            echo "<td>";
              echo "<select name='{$student->student_id}_1'>";
              echo "<option value='na'>N/A</option>";
                echo "<option value='0'>0</option>";
                echo "<option value='1'>1</option>";
              echo "</select>";
            echo "</td>";
            echo "<td>";
              echo "<select name='{$student->student_id}_2'>";
                echo "<option value='na'>N/A</option>";
                echo "<option value='0'>0</option>";
                echo "<option value='1'>1</option>";
              echo "</select>";
            echo "</td>";
            echo "<td>";
              echo "<select name='{$student->student_id}_3'>";
                echo "<option value='na'>N/A</option>";
                echo "<option value='0'>0</option>";
                echo "<option value='1'>1</option>";
              echo "</select>";
            echo "</td>";
            echo "<td>";
              echo "<select name='{$student->student_id}_4'>";
                echo "<option value='na'>N/A</option>";
                echo "<option value='0'>0</option>";
                echo "<option value='1'>1</option>";
              echo "</select>";
            echo "</td>";
            echo "<td>";
              echo "<select name='{$student->student_id}_5'>";
                echo "<option value='na'>N/A</option>";
                echo "<option value='0'>0</option>";
                echo "<option value='1'>1</option>";
              echo "</select>";
            echo "</td>";
            echo "<td>";
              echo "<select name='{$student->student_id}_6'>";
                echo "<option value='na'>N/A</option>";
                echo "<option value='0'>0</option>";
                echo "<option value='1'>1</option>";
              echo "</select>";
            echo "</td>";
            echo "<td>";
              echo "<select name='{$student->student_id}_7'>";
                echo "<option value='na'>N/A</option>";
                echo "<option value='0'>0</option>";
                echo "<option value='1'>1</option>";
              echo "</select>";
            echo "</td>";
         echo "</tr>";
          }
        echo "</table>";
        echo "</div>";
        echo "</div>";
      }
      
     
      ?>
      <div class="row">
      <div class="col-12">
         <a class="btn btn-dark mt-2" href="<?php echo base_url('attendance/newAttendanceRegistration')?>">Back</a>
        <button type="submit" class="mt-4 form-group btn btn-primary">Next</button>
       </div>

        
      <?php  echo form_close();?>
      </div>
    </div>
    
 
  
 



</div>






<?php $this->load->view('footer'); ?>
<script>
  $(document).ready(function(){
    $('#due-date').hide();
    $('#pay_mode').on('change',function(){
      var installment = $(this).val();
      if(installment == '1st installment'){
        $('#due-date').show();
      }else{
        $('#due-date').hide();
      }
    });
  });
</script>