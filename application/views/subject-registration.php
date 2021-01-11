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
          echo form_open('course/newSubject/2');
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
          if(isset($subjects)){
            echo '<div class="col-6">';
            echo "<table class='table'>";
              echo "<tr>";
                echo "<th>Subject #</th>";
                echo "<th>Subject Name</th>";
                echo "<th>Status</th>";
                
              echo "</tr>";
              foreach ($subjects as $key => $value) {
                echo "<tr>";
                  echo "<td>";
                    echo $value->subject_id;
                  echo "</td>";
                  echo "<td>";
                    echo $value->subject_name;
                  echo "</td>";
                  echo "<td>";
                    echo $value->state;
                  echo "</td>";
                echo "</tr>";
              }

            echo "</table>";
            // print_r($subjects);
          echo '</div>';
          }
        ?>
      
        
  </div>

      <?php
      
        // print_r();
        if(isset($batch_attendance) &&  $batch_attendance != 0){
          echo "<div class='row'>";
            echo "<div class='col-12'>";

       
        echo "<table class='table table-striped table-responsive'>";
        echo "<tr>";
          echo "<th>";
            echo "Registration #";
          echo "</th>";
          echo "<th>";
            echo "Student name";
          echo "</th>";
        foreach ($batch_attendance as $value) {
          echo "<th>";
            echo $value->attend_date;
          echo "</th>";
          
        }


        echo "</tr>";
        foreach ($batch_student_attendance as $studentkey => $stdObj) {
          echo "<tr>";
            echo "<td>";
            // echo "<pre>";
            //   print_r($stdObj->student_detail->student_id);
            // echo "</pre>";
            echo $stdObj->student_detail->student_id;
            echo "</td>";
            echo "<td>";
            echo $stdObj->student_detail->first_name . " " . $stdObj->student_detail->last_name;
            echo "</td>";

            foreach ($batch_attendance as $batch_attend_date) {
              foreach ($stdObj->student_attendance as $stdAttendDate) {
                // echo $stdAttendDate->attend_date;
                // echo "---";
                // echo $batch_attend_date->attend_date;
                // echo "<hr>";

                if($stdAttendDate->attend_date == $batch_attend_date->attend_date ){
                   echo "<td>";
                  // $stdAttendDate->attend_date;
                   echo $stdAttendDate->status;
                   echo "</td>";
                  
                }
              }
              
            }


          echo "</tr>";


        }
         
        echo "</table>";
        echo "</div>";
        echo "</div>";
      }
      
     
      ?>
      <div class="row">
      <div class="col-12">
         <a class="btn btn-dark mt-2" href="<?php echo base_url('attendance/searchAttendance')?>">Back</a>
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