<!-- This is general navigation comming on top of the page -->
    <div class="container">
            <div class="top-bar py-3">
                <div class="row">
                    <div class="col-md-7 hidden-xs hidden-sm">
                        <span>District Agriculture Training Center</span>
                    </div>
                    <div class="col-md-5 text-right">
                        <div class="top-bar-right">
                            <?php 
                                if(isset($this->session->userdata('user_detail')['type']) && ($this->session->userdata('user_detail')['type'] == 'admin' || $this->session->userdata('user_detail')['type'] == 'coordinator')){
                                    echo '<a class="btn btn-danger" id="appointment" href="'. base_url('/user/pendingOnlineRegistration') .'">View Pending Registrations</a>';
                                }else{
                                    echo '<a class="btn btn-danger" id="appointment" href="'. base_url('/user/search') .'">Register to a course</a>';
                                }
                            ?>
                            
                        </div>

                    </div>
                </div>
            </div>
        </div>
        
        <!-- Static navbar -->
        <nav class="navbar navbar-expand-lg sticky-top navbar-light bg-primary">
            <div class="container">
                <!-- <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="index.html"><img src="img/logo.png" alt=""></a>
                </div> -->
                <div id="navbarNav" class="collapse navbar-collapse">
                    <ul class="navbar-nav ml-auto mr-auto">

                        <li class="nav-item active"><a class="text-white nav-link" href="<?php echo base_url(); ?>">Home</a></li>
                        <li class="nav-item"><a class="text-white nav-link" href="<?php echo base_url('/user/showForum') ?>">Courses</a></li>
                        <li class="nav-item"><a class="text-white nav-link" href="<?php echo base_url('/user/createQuestion') ?>">Certificate Verification</a></li>
                        <!-- <li><a style="padding-left: 5px; padding-right: 5px;" href="<?php //echo base_url('/user/createQuestion') ?>"><span class="label label-primary " style="font-size:14px"> Ask Question </span></a></li> -->
                        <li class="nav-item"><a class="text-white nav-link" href="<?php echo base_url('/user/search') ?>">Contact Us</a></li>
                        <!-- <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">About Us<span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="about.html">What we do</a></li>
                                <li><a href="about.html">Our Hisrory</a></li>
                                <li><a href="about.html">Our Leadership</a></li>
                                <li><a href="about.html">Press about us</a></li>

                            </ul>
                        </li> -->
                        <!-- <li><a href="team.html">Our Team</a></li> -->
                        <!-- <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Services <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="services.html">Cancer Center</a></li>
                                <li><a href="services.html">Rehabilitation Center</a></li>
                                <li><a href="services.html">Gastro Labs</a></li>
                                <li><a href="services.html">Emergency Room</a></li>

                            </ul>
                        </li> -->
                        
                        <!-- <li><a href="contact.html">Contact us</a></li> -->
                        <li class="nav-item"><a class='text-white nav-link' href="<?php echo base_url('/user/register') ?>">Join</a></li>
                        <?php 
                            // print_r($this->session->userdata['user_detail']);
                            if(isset($this->session->userdata['user_detail']['login'])){
                                $userType = $this->session->userdata['user_detail']['type'];
                                echo "<li class='nav-item'><a class='text-white nav-link' href='";
                                echo base_url('/user/logoutUser/'.$userType);
                                echo "'>log out</a></li>";
                            }
                            else{
                                echo "<li class='nav-item'><a class='text-white nav-link' href='";
                                echo base_url('/user/userLogin');
                                echo "'>log in</a></li>";
                            }
                        ?>
                        <?php 
                            if(isset($this->session->userdata['lawyer_detail'])){
                                echo "<li class='nav-item'><a class='text-white nav-link' href='";
                                echo base_url('/user/lawyerDashBoard');
                                echo "'>";
                                echo "<span class='label label-default' style='font-size:14px'> My Dashboard</span>";
                               
                                echo "</a></li>";
                            }
                            elseif(isset($this->session->userdata['client_detail'])){
                                echo "<li class='nav-item'><a class='text-white nav-link' style='padding-left: 5px; padding-right: 5px;' href='";
                                echo base_url('/user/clientDashBoard');
                                echo "'>";
                                echo "<span class='label label-default' style='font-size:14px;'> My Dashboard</span>";
                               
                                echo "</a></li>";
                            }
                        ?>
                        
                    </ul>
                </div><!--/.nav-collapse -->
            </div><!--/.container-fluid -->
        </nav>


        




