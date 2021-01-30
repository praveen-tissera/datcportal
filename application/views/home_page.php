<?php $this->load->view('header'); ?>
    <body>
    <?php $this->load->view('top-navigation'); ?>
    <?php $this->load->view('staff-navigation'); ?>
    <header class="bg-primary py-5 mb-5 banner">
    <div class="container h-100">
      <div class="row h-100 align-items-center">
        <div class="col-lg-12 banner-content-wrapper">
          <h1 class="display-4 text-white mt-5 mb-2">District Agriculture Training Center</h1>
          <p class="lead mb-5 text-white-50">DATC is an institute governed by provincial agriculture department of Sri Lanka, conducts training sessions & diploma courses for farmers, university students & other stakeholders</p>
        </div>
      </div>
    </div>
  </header>
      
        <div class="container">
            <div class="row center-title mb-5">
                <div class="col-6">
                    <img src="<?php echo base_url('assets/img/aboutus.jpg'); ?>" class="img-fluid"  alt="">
                </div>
                <div class="col-6">
                    <h2 class="display-4 mt-5">Who We Are</h2>
                    <p class="text-left">
                    The District Agriculture Training Centre, Poddiwela was founded in 1987 which implements programs to increase local food production with the objective of achieving food security in the local production & minimize food import expenditure in order to create a self-sufficient country through agricultural revival.
                    </p>
                   
                </div>
            </div>
            <div class="row center-title my-5" id="courseview">
                <div class="col-md-12">
                    <h2 class="display-4 text-left mt-5" >Courses we offer</h2>
                    
                   
                </div>
            </div>
            <div class="row">
            <div class="col-6">
                <div class="card mb-3" style="max-width: 540px;">
                    <div class="row no-gutters">
                        <div class="col-md-4">
                        
                        <img src="<?php echo base_url('assets/img/diploma.jpg'); ?>" class="card-img img-fluid"  alt="">
                        </div>
                        <div class="col-md-8">
                        <div class="card-body">
                            <h5 class="card-title">Diploama Coures</h5>
                            <p class="card-text">
                            These courses is to produce young agro entrepreneurs, who are capable of practicing appropriate technology and management tasks in crop production.
                            </p>
                            <a href="<?php echo base_url('user/showCourse/diploma'); ?>" class="btn btn-info">view all</a>
                        </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="col-6">
                <div class="card mb-3" style="max-width: 540px;">
                    <div class="row no-gutters">
                        <div class="col-md-4">
                        <img src="<?php echo base_url('assets/img/training.jpg'); ?>" class="card-img img-fluid"  alt="">
                        </div>
                        <div class="col-md-8">
                        <div class="card-body">
                            <h5 class="card-title">Training Courses</h5>
                            <p class="card-text">The training programs are especially created for young farmers in order to develop their knowledge & skills.<br><br></p>
                            <a href="<?php echo base_url('user/showCourse/training'); ?>" class="btn btn-info">view all</a>
                        </div>
                        </div>
                    </div>
                </div>

            </div>

            </div>

            <div class="row my-5">
                <div class="col-12">
                <h2 class="display-4 text-left mt-5" id="contactinfo">Contact Info</h2>
                </div>
                <div class="col-12">
                <div class="wow fadeInUp contact-info" data-wow-delay="0.4s">
                         <div class="section-title">
                              
                              <p>Lorem ipsum dolor sit consectetur adipiscing morbi venenatis et tortor consectetur adipisicing lacinia tortor morbi ultricies.</p>
                         </div>
                         
                         <p><i class="fa fa-map-marker"></i> 456 New Street 22000, New York City, USA</p>
                         <p><i class="fa fa-comment"></i> <a href="mailto:info@company.com">info@company.com</a></p>
                         <p><i class="fa fa-phone"></i> 010-020-0340</p>
                    </div>
                </div>

            </div>
            
        
            
            <div class="text-center">
                <!-- <a href="#" class="btn btn-lg btn-theme-bg">More about our Services <i class="glyphicon glyphicon-circle-arrow-right"></i></a> -->
            </div>
        </div>
        

        

        
       

        <?php $this->load->view('footer'); ?>