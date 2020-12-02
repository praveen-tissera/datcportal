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
      <h2>Student Details</h2>
      <!-- tab panel -->
      <ul class="nav nav-tabs" id="myTab" role="tablist">
  <li class="nav-item" role="presentation">
    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="home" aria-selected="true">Profile</a>
  </li>
  <li class="nav-item" role="presentation">
    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#course" role="tab" aria-controls="profile" aria-selected="false">Course</a>
  </li>
  <li class="nav-item" role="presentation">
    <a class="nav-link" id="contact-tab" data-toggle="tab" href="#payment" role="tab" aria-controls="contact" aria-selected="false">Payments</a>
  </li>
</ul>
<!-- tab conent -->
<div class="tab-content" id="myTabContent">
  <div class="tab-pane fade show active" id="profile">
    <?php
    echo '<pre>';
      print_r($student_profile);
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
        <th scope="col">Student regiser date on batch</th>
        <th scope="col">Student batch status</th>
        <th scope="col">Certificate status</th>
        
      </tr>
    </thead>';

echo "<tbody>";
//  echo '<pre>';
      foreach ($student_object as $key => $batch) {
        
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
           print_r($batch->certificate_no); 
        echo "</td>";
        echo "</tr>";
      }
      echo "</tbody>";
      echo "</table>";
    ?>
  </div>
  <div class="tab-pane fade" id="payment">
  <?php 
      
      //  print_r($student_object);
      echo  '<table class="table">
      <thead class="thead-dark">
      <tr>
        <th scope="col">Course name</th>
        <th scope="col">Batch number</th>
        <th scope="col">payment history</th>

        
      </tr>
    </thead>';

echo "<tbody>";
//  echo '<pre>';
      foreach ($student_object as $key => $batch) {
        
        echo "<tr>";
        echo "<td>";
           print_r($batch->batch_object->course_detail->course_name); 
        echo "</td>";
        echo "<td>";
           print_r($batch->batch_object->batch_number); 
        echo "</td>";

        echo "<td>";
          //  print_r($batch); 
          if(!empty($batch->payment_object)){
            // print_r(count($batch->payment_object)); 
            echo "<table class='table table-bordered'>";
            foreach ($batch->payment_object as $key => $payment) {
              // print_r($payment);
              echo "<td>";
              echo "Payment status -";
              echo   ($payment->payment_status == 'full') ? 'full paid' :  $payment->payment_status;
              echo '<br>';
              echo "Pay amount -" .  $payment->amount . '<br>';
              echo "Payment due date -" .  $payment->payment_due_date . '<br>';
              if(isset($payment->payment_receive) &&  !empty($payment->payment_receive)){
                echo 'Paid receipt # -' . $payment->payment_receive->receipt_number . '<br>';   
                echo 'Paid date - ' . $payment->payment_receive->paid_date . '<br>';
                echo "<a href='". base_url('user/printreceipt/'.$payment->payment_id .'/'.$payment->batch_id.'/'.$payment->student_id ) . "'>Print receipt</a>";
              }else{
                echo "<a href='". base_url('user/payInstallment/'.$payment->payment_id .'/'.$payment->batch_id.'/'.$payment->student_id ) . "'>Pay now</a>";
              }
              
              
              echo "</td>";
            }
            echo "</table>";

          }else{
            echo "No payment history found";
          }
          //  echo count($batch->payment_object);
        echo "</td>";
        echo "<td>";
           print_r($batch->certificate_no); 
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