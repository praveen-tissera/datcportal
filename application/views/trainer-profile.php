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
    <?php echo form_open('user/searchStudent'); ?>
    <div class="col-12">
    
    </div>
    </div>
    <div class="row">
    <div class="col-12">
      <h2>Trainer Details</h2>
      <!-- tab panel -->
      <ul class="nav nav-tabs" id="myTab" role="tablist">
  <li class="nav-item" role="presentation">
    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="home" aria-selected="true">Profile</a>
  </li>
  <li class="nav-item" role="presentation">
    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#course" role="tab" aria-controls="profile" aria-selected="false">Course</a>
  </li>

</ul>
<!-- tab conent -->
<div class="tab-content" id="myTabContent">
  <div class="tab-pane fade show active" id="profile">
    <?php
    echo '<pre>';
      print_r($trainer_profile);
    ?>
  </div>
  <div class="tab-pane fade" id="course" >
    <?php 
      
      // print_r($student_object);
      echo  '<table class="table">
      <thead class="thead-dark">
      <tr>
        <th scope="col">Course name</th>
        <th scope="col">Batch number</th>
        <th scope="col">Trainer assign date to the batch</th>
        <th scope="col">Trainer batch status</th>
        <th scope="col">Batch Description</th>
        
      </tr>
    </thead>';

echo "<tbody>";
//  echo '<pre>';
      foreach ($trainer_batches_object as $key => $batch) {
        
        echo "<tr>";
        echo "<td>";
           print_r($batch->batch_object->course_detail->course_name); 
        echo "</td>";
        echo "<td>";
           print_r($batch->batch_object->batch_number); 
        echo "</td>";
        echo "<td>";
           print_r($batch->added_date); 
        echo "</td>";
        echo "<td>";
           print_r($batch->state); 
        echo "</td>";
        echo "<td>";
           print_r($batch->batch_object->discription); 
        echo "</td>";
        echo "</tr>";
      }
      echo "</tbody>";
      echo "</table>";
    ?>
  </div>

</div>
      
      <?php 
      
    
      
      ?>



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