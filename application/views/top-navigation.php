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
               
                <div id="navbarNav" class="collapse navbar-collapse">
                    <ul class="navbar-nav ml-auto mr-auto">

                        <li class="nav-item active"><a class="text-white nav-link" href="<?php echo base_url(); ?>">Home</a></li>
                        <li class="nav-item"><a class="text-white nav-link" href="<?php echo base_url('/user/showForum') ?>">Courses</a></li>
                        <li class="nav-item"><a class="text-white nav-link" href="<?php echo base_url('/user/verification') ?>">Certificate Verification</a></li>
                        
                        <li class="nav-item"><a class="text-white nav-link" href="<?php echo base_url('/user/search') ?>">Contact Us</a></li>
                        
                        <li class="nav-item"><a class='text-white nav-link' href="<?php echo base_url('/user/register') ?>">Join</a></li>
                        <?php 
                            
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


        




