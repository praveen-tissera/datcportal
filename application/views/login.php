
<?php

if ($this->session->userdata('user_detail')) {

  redirect('/user/studentTrainerDashboard');
} 


?>

<?php $this->load->view('header'); ?>
<div class="sidenav">
   <div class="login-main-text">
      <a href="<?php echo base_url(); ?>"> &lt; Back To Home </a>
      <h2 class="mt-4">DATC Institute<br> </h2>
      <p>Login for Students and Trainers.</p>
   </div>
</div>
<div class="main">

   <div class="col-md-6 col-sm-12">

      <div class="login-form">

         <?php
         echo form_open('user/studentTrainerLogin');
         ?>
         <?php
         if (isset($error_message_display)) {
            echo '<div class="alert alert-danger" role="alert">';
            echo $error_message_display;
            echo '</div>';
         }
         if (isset($success_message_display)) {
            echo '<div class="alert alert-secondary" role="alert">';
            echo $success_message_display;
            echo '</div>';
         }
         ?>
         <div class="form-group">
            <label>Email <?php echo (form_error('email')) ? '<span class="badge badge-danger">Email field required</span>' : ''; ?> </label>
            <input type="text" name="email" class="form-control" placeholder="Email Address" required>
         </div>
         <div class="form-group">
            <label>Password <?php echo (form_error('password')) ? '<span class="badge badge-danger">Password field required</span>' : ''; ?></label>
            <input type="password" name="password" class="form-control" placeholder="Password" required>
         </div>

         <div class="form-group">
            <label>Slect User Group : </label>
            <div class="form-check form-check-inline">
               <input class="form-check-input" checked type="radio" name="user-type" id="student" value="student">
               <label class="form-check-label" for="student">Student</label>
            </div>
            <div class="form-check form-check-inline">
               <input class="form-check-input" type="radio" name="user-type" id="trainer" value="trainer">
               <label class="form-check-label" for="trainer">Trainer</label>
            </div>
         </div>
         <button type="submit" class="btn btn-black">Login</button>

         <?php echo form_close(); ?>
      </div>
   </div>
</div>