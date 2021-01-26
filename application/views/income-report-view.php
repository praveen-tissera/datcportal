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
      // step 1
        if(isset($active_courses)){
          echo '<label>Course name</label>';
          echo form_open('report/incomeReport/2');
          echo "<select class='form-control' name='selectcourse'>";
          // print_r($active_courses);
            echo "<option value ='0'>All courses</option>";
          foreach ($active_courses as $key => $active_course) {
              echo "<option value='{$active_course->course_id}'>$active_course->course_name</option>";
          }
          echo "</select>";
          
        }elseif (isset($select_course_detail)) {
          echo '<label>Selected course</label> <br>';
          if(is_array($select_course_detail)){
            echo "<p class='badge badge-primary'>{$select_course_detail[0]->course_name}</p>";
          }else{
            echo "<p class='badge badge-primary'>{$select_course_detail}</p>";
          }
            
           
        }
        
      ?>

        </div>
        <?php
        // stept 2
          if(isset($active_batches)){
            echo '<div class="col-6">';
            // print_r($active_batches);
            echo form_open('report/incomeReport/3');
            if(is_array($select_course_detail)){

              echo "<input type='hidden' name='course_id' value={$select_course_detail[0]->course_id}>";
              
            }else{
              echo "<input type='hidden' name='course_id' value='$select_course_detail'>";
             
              
            }
            

            echo '<label>Select Batch</label>';
            if(is_array($active_batches) && isset($selected_batch)){
              echo "<select class='form-control' name='selectbatch'>";
              // print_r($active_courses);
              $isseleted = ($selected_batch == 'All Batches') ? 'selected' : 'null' ;
              echo "<option  $isseleted value='All Batches'>All Batches</option>";
              foreach ($active_batches as $key => $active_batch) {
                $isseleted = ($selected_batch == $active_batch->batch_id) ? 'selected' : 'null' ;

                echo "<option $isseleted  value='{$active_batch->batch_id}'>$active_batch->batch_number</option>";
              }
              echo "</select>";
            }else{
              echo "<input type='hidden' name='selectbatch' value='$active_batches'>";
              echo "<br><p class='badge badge-primary'>{$active_batches}</p>";
            }
            
  
          echo '</div>';
          }elseif (isset($select_batch_detail)) {
            // print_r($select_batch_detail);
           
            echo "<input type='hidden' value='{$select_batch_detail->course_id}' name='course_id'>";
            echo "<input type='hidden' value='{$select_batch_detail->batch_id}' name='batch_id'>";
            echo '<div class="col-6">';
              echo '<label>Selected batch number : </label><br>';
              
              echo "<p class='badge badge-primary'>{$select_batch_detail->batch_number}</p>";
            echo "</div>";
          }
        ?>
      
        
  </div>
      <?php 
      if(isset($active_batches) || isset($select_batch_detail)){
      ?>
        <div class="row">
          <div class="col-12">
          <label>Select Duration</label>
          </div>
        
          <div class="col">
          <label for="start">Starting Date</label>
          <input type="date" name="startdate" id="start" class="form-control"  value="<?php echo (isset($select_start_date)) ? $select_start_date : '' ; ?>">

          </div>
          <div class="col">
          <label for="end">Ending Date</label>
          <input type="date" name="enddate" id="end" class="form-control" value="<?php echo (isset($select_end_date)) ? $select_end_date : '' ; ?>">

          </div>
        </div>
      <?php } ?>
        <?php 
          if(isset($result_payments) && is_array($result_payments)){
        ?>
      <div class="row">
    
        <div class="col-12" id="chart_div" data-sdate="<?php echo $select_start_date; ?>" data-edate="<?php echo $select_end_date; ?>" data-value="<?php echo  $total_income_graph; ?>" style="height: 400px;"></div>
        
      </div>
          <?php } ?>

      <?php
      
        
     
      ?>
      <?php 
        if(isset($result_payments) && is_array($result_payments)){

          // echo $total_income;
          // print_r($result_payments);
          echo "<table class='table mt-5'>";
              echo "<thead class='thead-dark'>";
                echo "<tr>";
                
                echo "<th scope='col'>Total income</th>";
                echo "<th scope='col'>Detail view</th>";
                
               echo "</tr>";
            echo "</thead>";
            echo "<tbody>";
              echo "<tr>";
                echo "<td>";
                  echo 'LKR '. $total_income;
                echo "</td>";
                echo "<td>";
                  echo "<a href=''>Detail view</a>";
                echo "</td>";
              echo "</tr>";
            echo "</tbody>";
          echo "</table>";

          echo "<hr>";

          echo "<table class='table'>";
          echo "<thead class='bg-primary'>";
            echo "<tr>";
            
            echo "<th scope='col'>Date</th>";
            echo "<th scope='col'>Reg. No</th>";
            echo "<th scope='col'>Student Name</th>";
            echo "<th scope='col'>Course Name</th>";
            echo "<th scope='col'>Batch Number</th>";
            echo "<th scope='col' class='text-right'>ReciptNo</th>";
            echo "<th scope='col' class='text-right'>Paid Amount</th>";
            
           echo "</tr>";
        echo "</thead>";
        echo "<tbody>";
        foreach ($result_payments as $key => $payment) {
          echo "<tr>";
            echo "<td>";
              echo $payment->paid_date;
            echo "</td>";
            echo "<td>";
              echo $payment->student_detail->student_id;
            echo "</td>";
            echo "<td>";
              echo $payment->student_detail->first_name . ' ' . $payment->student_detail->last_name;
            echo "</td>";
            echo "<td>";
              echo $payment->course_batch_detail->course_detail->course_name;
            echo "</td>";
            echo "<td>";
              echo $payment->course_batch_detail->batch_number;
            echo "</td>";
            echo "<td class='text-right'>";
              echo $payment->receipt_number;
            echo "</td>";
            echo "<td class='text-right'>";
              echo number_format($payment->paid_amount,2);
            echo "</td>";
          echo "</tr>";
        }
        echo "<tr>";
            echo "<td colspan='6' class='text-right'>";
              echo "Grand Total";
            echo "</td>";
            echo "<td class='text-right'>";
            echo 'LKR '. $total_income;
            echo "</td>";
        echo "</tr>";
         
        echo "</tbody>";
      echo "</table>";

        }else if(isset($student_batch_certificate)){
          
        }
      
      ?>
      <div class="row">
      <div class="col-12">
         <a class="btn btn-dark mt-2" href="<?php echo base_url('report/incomeReport')?>">Back</a>
        <button type="submit" class="mt-4 form-group btn btn-primary">Next</button>
       

        
      <?php  echo form_close();?>
      <?php
    if (isset($result_payments) && is_array($result_payments)) {
      $attributes = array('target' => '_blank','style'=>'display:inline');
      echo form_open('report/pdf',$attributes);
      echo "<input type='hidden' name='paymentreport' value = '";
      print_r(serialize($result_payments));
      echo  "'>";
      
      echo "<input type='hidden' name='startdate' value='$select_start_date'>";
      echo "<input type='hidden' name='enddate' value='$select_end_date'>";
      echo "<input type='hidden' name='total' value='$total_income'>";
      echo "<input type='submit' class='mt-4 form-group btn btn-warning'  value='down pdf'>";
      echo form_close();
    }

    ?>
      </div>
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
  

  <script type = "text/javascript" src = "https://www.gstatic.com/charts/loader.js">
      </script>
      <script type = "text/javascript">
         google.charts.load('current', {packages: ['corechart']});     
      </script>
<?php 

?>
<script language = "JavaScript">
  
         function drawChart() {
          let income = +$('#chart_div').data("value");
          let start_date = $('#chart_div').data("sdate");
          let end_date = $('#chart_div').data("edate");
          let duration = 'Period (' + start_date + ' to ' + end_date + ')';
          console.log(income);
            // Define the chart to be drawn.
            var data = google.visualization.arrayToDataTable([
               ['Year', 'Collection'],
               [duration,  income],
               
            ]);

            var options = {title: 'Collection (LKR)'}; 

            // Instantiate and draw the chart.
            var chart = new google.visualization.ColumnChart(document.getElementById('chart_div'));
            chart.draw(data, options);
         }
         google.charts.setOnLoadCallback(drawChart);
      </script>