<?php $this->load->view('header'); ?>
<?php $this->load->view('top-navigation'); ?>
<div class="container">
    <div class="row">

        <div class="col-md-offset-1 col-md-10">
    
        <?php 

        if(isset($error_message_display)){
            echo '<div class="alert alert-danger" role="alert">';
            echo $error_message_display;
            echo '</div>';
            }
            if(isset($success_message_display)){
            echo '<div class="alert alert-success" role="alert">';
            echo $success_message_display;
            echo '</div>';
            }

        ?>
        <div class="panel with-nav-tabs panel-default">
                <div class="panel-heading">
                        <ul class="nav nav-tabs">
                            
                            <?php
                            echo "<li><a href='' data-toggle='tab'>Search Legal Professional</a></li>";
                            // if(isset($user_type) && $user_type =='lawyer'){
                            //     echo "<li><a href='#tab1default' data-toggle='tab'>Client Registration</a></li>";
                                
                            // }
                            // else{
                            //     echo "<li class='active'><a href='#tab1default' data-toggle='tab'>Client Registration</a></li>";
                                
                            // }
                            
                            ?>
                            
                        </ul>
                </div>
                <div class="panel-body">
                    <div class="tab-content">
                    <?php
                   
                    echo "<div class='tab-pane fade in active' id='tab1default'>";
                    
                        // if(isset($user_type) && $user_type =='lawyer'){
                        //     echo "<div class='tab-pane fade' id='tab1default'>";
                        // }
                        // else{
                        //     echo "<div class='tab-pane fade in active' id='tab1default'>";
                        // }
                        ?>
                       
                        
                       
                  
                        
                        
                        </div>
                        <?php
                         echo "<div class='tab-pane fade in active' id='tabdefault'>";
                        // if(isset($user_type) && $user_type =='lawyer'){
                        //     echo "<div class='tab-pane fade in active' id='tab2default'>";
                        // }
                        // else{
                        //     echo "<div class='tab-pane fade' id='tab2default'>";
                        // }
                        ?>
                       
                        
                        <div class="panel-heading">
                        
                        
            </div>
                    <div class="panel-body">
                    <?php
                    

                    echo form_open('user/showSearchResult');   
                    if(form_error('provincial-area')|| form_error('legal-professional')||form_error('admitted-bar')|| form_error('specialty')){

                        echo '<div class="alert alert-danger" role="alert">';
                           
                            echo form_error('provincial-area'); 
                            echo form_error('legal-professional');   
                            echo form_error('admitted-bar');
                            echo form_error('specialty');
                            echo form_error('location');
                        echo '</div>';
                        }
                        if(isset($user_type) && $user_type =='lawyer'){
                            if(isset($error_message_display)){
                                echo '<div class="alert alert-danger" role="alert">';
                                echo $error_message_display;
                                echo '</div>';
                                }
                                if(isset($success_message_display)){
                                echo '<div class="alert alert-success" role="alert">';
                                echo $success_message_display;
                                echo '</div>';
                                }
                        }
                        
                    echo "<fieldset>";
                       
                        

                        


                        echo "<p class='pull-right'>";
                                echo "<a href='".base_url('/user/faq') ."'>";
                                
                                echo "<span class='glyphicon glyphicon glyphicon-info-sign' aria-hidden='true'></span>";
                                echo "<span class='sr-only'>Error:</span>";
                                    echo " How to select the relevant lawyer ?";
                                echo "</a>";
                    echo "</p>";
                        
                        echo "<div class='form-group'>";
                        $options = array(
                            ' '         => 'Legal Professional',
                            'lawyer'         => 'Lawyer',
                            'sworn-translator'  => 'Sworn Translator',
                            'lawyer-sworn-translator' => 'Lawyer and Sworn Translator',
                            'notary'  => 'Notary',
                            'family-counselor' => 'Family Counselor'
                           
                            
                        );
                        $attribute = 'class="form-control legal-professional"';


                    echo form_dropdown('legal-professional', $options, ' ',$attribute);
                        echo "</div>";



                        echo "<div class='form-group'>";
                        $options = array(
                            'western'         => 'Western Province',
                            'northern'         => 'Northern Province',
                            'north-Western'         => 'North Western Province',
                            'north-Central'         => 'North Central Province',
                            'central'         => 'Central Province',
                            'sabaragamuwa'         => 'Sabaragamuwa Province',
                            'eastern'         => 'Eastern Province',
                            'uva'         => 'Uva Province',
                            'southern'         => 'Southern Province',
                            
                        );
                        $attribute = 'class="form-control"';


                    echo form_dropdown('provincial-area', $options, 'western',$attribute);
                        echo "</div>";
                        


                        echo "<div class='form-group'>";
                        $options = array(
                            '0'         => 'Admitted Bar',
                            'Wellawaya-Combined-Court'         => 'Wellawaya Combined Court',
                            'Welimada-Combined-Court '         => 'Welimada Combined Court ',
                            'Welikada-Hight-Court '         => 'Welikada Hight Court ',
                            'Wattala-Magistrate-Court '         => 'Wattala Magistrate Court ',
                            'Wariyapola-Magistrate-Court '         => 'Wariyapola Magistrate Court ',
                            'Warakapola-Magistrate-Court '         => 'Warakapola Magistrate Court ',
                            'Walasmulla-Combined-Court '         => 'Walasmulla Combined Court ',
                            'Vavuniya'         => 'Vavuniya ',
                            'Valachchnai-Magistrate-Court '         => 'Valachchnai Magistrate Court ',
                            'Trincomalee'         => 'Trincomalee ',
                            'Tissamaramaya-Combined-Court '         => 'Tissamaramaya Combined Court ',
                            'Theldeniya-Magistrate-Court '         => 'Theldeniya Magistrate Court ',
                            'Thangalle-Combined-Court '         => 'Thangalle Combined Court ',
                            'Thambuththegama '         => 'Thambuththegama ',
                            'Ruwanwella-Magistrate-Court '         => 'Ruwanwella Magistrate Court ',
                            'Rambadagalla-Magistrate-Court  '         => 'Rambadagalla Magistrate Court  ',
                            'Pugoda-Combined-Court  '         => 'Pugoda Combined Court  ',
                            'Polonnaruwa'         => 'Polonnaruwa ',
                            'Point-Pedro'         => 'Point Pedro ',
                            'Pilessa-Magistrate-Court '         => 'Pilessa Magistrate Court ',
                            'Panadura'         => 'Panadura ',
                            'Palmadulla-Combined-Court '         => 'Palmadulla Combined Court ',
                            'banNuwara-Eliya-kruptcy'         => 'Nuwara Eliya ',
                            'Nugegoda'         => 'Nugegoda ',
                            'Nikaweratiya-Magistrate-Court '         => 'Nikaweratiya Magistrate Court ',
                            'Negambo'         => 'Negambo ',
                            'Nawalapitiya-Combined-Court '         => 'Nawalapitiya Combined Court',
                            'bankruptcy'         => 'bankruptcy',
                            'Muthur-Magistrate-Court '         => 'Muthur Magistrate Court',
                            'Mount-Lavinia'         => 'Mount Lavinia ',
                            'Morawaka-District-Court-(Combined-Court) '         => 'Morawaka District Court (Combined Court) ',
                            'Moratuwa-Combined-Court '         => 'Moratuwa Combined Court ',
                            'Monaragala-Combined-Court '         => 'Monaragala Combined Court ',
                            'Minuwangoda-Magistrate-Court '         => 'Minuwangoda Magistrate Court ',
                            'Mawanella-Combined-Court '         => 'Mawanella Combined Court ',
                            'Mathugama'         => 'Mathugama ',
                            'Matara'         => 'Matara ',
                            'Matale-Combined-Court '         => 'Matale Combined Court ',
                            'Marawila-Combined-Court '         => 'Marawila Combined Court ',
                            'Mallakam-District-Court '         => 'Mallakam District Court ',
                            'Maligakanda-Magistrate-Court '         => 'Maligakanda Magistrate Court',
                            'Maho-Combined-Court'         => 'Maho Combined Court',
                            'Mahiyanganaya-Combined-Court '         => 'Mahiyanganaya Combined Court ',
                            'Kurunegala'         => 'Kurunegala ',
                            'Kuliyapitiya'         => 'Kuliyapitiya ',
                            'Kekirawa-Magistrate-Court '         => 'Kekirawa Magistrate Court ',
                            'Kegalle'         => 'Kegalle ',
                            'Kayts-Combined-Court '         => 'Kayts Combined Court ',
                            'Kasbewa-Magistrate-Court '         => 'Kasbewa Magistrate Court ',
                            'Kantale-Magistrate-Court '         => 'Kantale Magistrate Court',
                            'Kandy'         => 'Kandy ',
                            
                        );
                        $attribute = 'class="form-control specialty" style="display:none;"';


                    echo form_dropdown('admitted-bar', $options, '0',$attribute);

                        
                        echo "</div>";







                        echo "<div class='form-group'>";
                        $options = array(
                            '0'         => 'Specialty',
                            'divorce'         => 'Divorce',
                            'immigration'         => 'Immigration',
                            'accident-personal'         => 'Acceident & Personal Inqury',
                            'business-corporate'         => 'Business and Corporate',
                            'family'         => 'Family',
                            'criminal'         => 'Criminal',
                            'bankruptcy-employment'         => 'Bankruptcy and Employment',
                            
                        );
                        $attribute = 'class="form-control specialty" style="display:none;"';


                    echo form_dropdown('specialty', $options, '0',$attribute);

                        
                        echo "</div>";
                       
                    echo "</fieldset>";
                    echo form_submit('submit', 'Search', "class='btn btn-success btn-md btn-block'");
                    echo form_close();

                    ?>
                    </div>
                        
                        
                        </div>
                       <?php
                       /**
                        * show leagal professional details against search criteria
                        */
                       if(isset($search_result) && $search_result == 'empty' ){
                        echo "<h4>No result found</h4>";
                       }elseif(isset($search_result)){
                           $i=1;
                           echo "<container>";
                           echo "<div class='row'>";
                           foreach($search_result as $lawyer_detail){
                               
                            if(($i%3) == 0){                                   
                                    $i == 1;
                            }
                                echo "<div class='col-md-6'>";
                                echo "<div class='card'>";
                                echo '<h5>' . $lawyer_detail->title . ' ' . $lawyer_detail->first_name . ' '. $lawyer_detail->last_name . '</h5>';
                                
                                
                                echo 'Legal professional: ' . str_replace("-"," ",$lawyer_detail->legal_professional);
                                echo "<br>";
                                if($lawyer_detail->legal_professional == 'lawyer' || $lawyer_detail->legal_professional == 'lawyer-sworn-translator'){
                                    echo 'Admitted bar: ' . str_replace("-"," ",$lawyer_detail->admitted_bar);
                                    echo "<br>"; 
                                    echo 'Specialty: ' . str_replace("-"," ",$lawyer_detail->specialty);
                                }                               
                                echo 'Provincial area: ' . str_replace("-"," ",$lawyer_detail->provincial_area);
                                echo "<br>";
                                echo 'Practice Location:' . $lawyer_detail->location;
                                echo "<br>";
                                echo "<a id='appointment' href='". base_url('/user/lawyerDashBoardClientView/'. $lawyer_detail->user_id) ."' type='button' class='btn btn-danger pull-right '>Book Now</a>";
                                echo "<div class='clearfix'></div>";
                                echo "</div>";
                                echo "</div>";
                                $i++;
                           }
                           echo "</div>";
                           echo "</container>";

                       }
                       
                       ?>
                        
                    </div>
                </div>
            </div>
        </div>


            
        </div>
    </div>
</div>
    
   

<?php $this->load->view('footer'); ?>
   <script>
   

$(document).ready(function(){

    $('.legal-professional').change(function(){
        
        if(this.value == 'lawyer' || this.value == 'lawyer-sworn-translator'){
            
            $('.admitted-bar').show();
            $('.specialty').show();
        }
        else{
            $('.admitted-bar').hide();
            $('.specialty').hide(); 
        }
       
    })
});

   </script>