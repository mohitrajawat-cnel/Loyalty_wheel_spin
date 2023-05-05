<?php
///login with mobile number
if(isset($_POST['save_spin_code_mobile']) || isset($_POST['check_spin_code_mobile_otp']))
{
    $generate_mobilenum =  $_POST['user_spin_code'];

    
    if(isset($_POST['enter_otp_sent']) && $_POST['enter_otp_sent'] != '')
    {
        $enter_otp_sent =  $_POST['enter_otp_sent'];  //ramkishan
        $select="select * from ".$table_prefix."phonenogenerate where mobile_otp='$enter_otp_sent' and status = '0'";
    }
    else
    {
        //ramkishan
        $select="select * from ".$table_prefix."phonenogenerate where generate_code='$generate_mobilenum' and status = '0'";
    }
    
    $query=mysqli_query($conn,$select);
    $result =mysqli_fetch_assoc($query);
    if(mysqli_num_rows($query) > 0)
    {

        $phone_id = $result['id'];

        if($mobile_num_otp == '1')
        {
            if(isset($_POST['enter_otp_sent']) && $_POST['enter_otp_sent'] != '')
            {
                //ramkishan
                $insert ="UPDATE ".$table_prefix."phonenogenerate SET mobile_otp = '".$enter_otp_sent."',
                status ='1',
                created=now() where id='".$phone_id."'"; 
                mysqli_query($conn,$insert);
            }
            
        
        }
        else
        {
            $generate_mobilenum =  $_POST['user_spin_code'];
    
    //ramkishan
              $insert ="UPDATE ".$table_prefix."phonenogenerate SET generate_code = '".$generate_mobilenum."',
              status ='1',
              created=now() where id='".$phone_id."'"; 
              mysqli_query($conn,$insert);
        }
       
        
        $_SESSION['spain_code'] = $phone_id;

        ?>
        <script>
            jQuery(document).ready(function(){
         
                var mob_otp_hwe1= '';
                    mob_otp_hwe1 = '<?php echo $mobile_num_otp; ?>';

                var get_otp_value_hwe='';
                    get_otp_value_hwe ='<?php echo $_POST['enter_otp_sent']; ?>';

                    var method_check = '<?php echo $mobile_num_otp; ?>';

                    if(get_otp_value_hwe == '' && method_check == '1' )
                    {
                  
                        jQuery("#otp_enter_Modal").addClass("in");
                        jQuery("#otp_enter_Modal").show();
                        jQuery("#otp_enter_Modal").attr("style","display:block;");
                    }
                    else
                    {
            
                        jQuery("#drawing").show();
                        jQuery("#code_enter_Modal").removeClass("in");
                        jQuery("#code_enter_Modal").hide();

                        jQuery("#drawing").attr("style","display:block;");
                        jQuery("#code_enter_Modal").attr("style","display:none;")
                    

                    // if(get_otp_value_hwe != '')
                    // {
                    //     jQuery("#otp_enter_Modal").addClass("in");
                    //     jQuery("#otp_enter_Modal").show();
                    //     jQuery("#otp_enter_Modal").attr("style","display:block;");
                    // }
                 

                 
                    
                    setTimeout(function () {
                        var total_spin = jQuery("#total_spin_show").val();
                        var user_spin = jQuery("#user_spin_count").val();
                        var get_reamin_spin_code='';
        
                        if(user_spin == '')
                        {
                            user_spin = 0;
                        }
        
                      
                        //Play sound if have config
                       var check_sound = '<?php echo $sound_config;  ?>';
                       if(check_sound == 1)
                       {
                           setTimeout(function () {
                      
                           
                                    var spinSound = document.getElementById('spinSound');
                                    spinSound.autoplay = true;
                                        spinSound.play().catch(function() {
                                    });
                            
                            },2000);

                            if(isiPhone()){
                                setTimeout(function () {
                                        
                                            
                                        var spinSound = document.getElementById('spinSound');
                                        spinSound.autoplay = true;
                                            spinSound.play().catch(function() {
                                        });
                                
                                },400);
                            }
                       }
                       <?php
                            if($code_sp == '1' || $mobile_number_sp == '1' || $code_with_remain_spin_sp == '1' || $share_referrel == '1')
                            {
                                ?>
        
                                
                                var user_id = 1;
                                
                            <?php } 
                            else
                            { ?>
                                var user_id = '<?php echo $user_id_session; ?>';
                                <?php 
                            }?>    
                                var spain_code = '<?php echo $_SESSION['spain_code']; ?>';
                          
        
                                jQuery.ajax({
                                type: "POST",
                                url: '<?php echo Site_URL.'/send_ajax_data.php'; ?>',
                                data: { 
                                    set_user_spin : 'set_user_spin',
                                    user_id : user_id,
                                    admin_set_total_spin: total_spin,
                                    user_spin: user_spin
                                
                                    
                                },
                                success:function(success)
                                {
                        
                                    jQuery("#total_spin_show").attr("value",success);

                                    jQuery("#total_spin_show").attr("value",success);
                            
                                        var get_spin_total_hwe = jQuery("#total_spin_show").val();

                                        jQuery.ajax({
                                        type: "POST",
                                        url: '<?php echo Site_URL.'/send_ajax_data.php'; ?>',
                                        data: { 
                                            set_user_spin_result_remain_spin : 'set_user_spin_result_remain_spin',
                                            user_id : user_id,
                                            user_spin: get_spin_total_hwe,
                                            spain_code: spain_code,
                                            get_reamin_spin_code: get_reamin_spin_code
                                            
                                        },
                                        success:function(result)
                                        {
                                      
                                        }
                                    });
                                }

                        });
        
                        spin(function(data) {
                            
                            var get_show_popup = '<?php echo $background['reward-popup-config']; ?>';
                            if(get_show_popup == 1)
                            {
                                jQuery(".reward-list").addClass("show");
                            }
        
                            <?php 
                            if($code_sp == '1' || $mobile_number_sp == '1' || $code_with_remain_spin_sp == '1' || $share_referrel == '1')
                            {
                                ?>
        
                                
                                var user_id = 1;
                                
                            <?php } 
                            else
                            { ?>
                                var user_id = '<?php echo $user_id_session; ?>';
                                <?php 
                            }?>    
                                var spain_code = '<?php echo $_SESSION['spain_code']; ?>';
                          
                                //     var reward_id_hwe = jQuery("#set_random_spin_value").val();
                                //     var reward_item = jQuery("#set_user_reward").val();
                                //     var get_spin_total_hwe = jQuery("#total_spin_show").val();

                                //     jQuery.ajax({
                                //     type: "POST",
                                //     url: '<?php echo Site_URL.'/send_ajax_data.php'; ?>',
                                //     data: { 
                                //         set_user_spin_result : 'set_user_spin_result',
                                //         user_id : user_id,
                                //         admin_set_total_spin: total_spin,
                                //         user_spin: get_spin_total_hwe,
                                //         reward_item: reward_item,
                                //         reward_id_hwe: reward_id_hwe,
                                //         spain_code: spain_code,
                                //         get_reamin_spin_code: get_reamin_spin_code
                                        
                                //     },
                                //     success:function(result)
                                //     {
                                        
                                //         jQuery(".reward-list .items").html("");
                                //         jQuery(".reward-list .items").html(result);

                                //         jQuery('.reward-list').css('transform', 'scale(1)');
                                //         jQuery('.reward-list').css('visibility', 'visible');

                                jQuery('.lucky_number_popup_latest').css('transform', 'scale(1)');
                                jQuery('.lucky_number_popup_latest').css('visibility', 'visible');
                                //     }
                            
                                // });                  
                                
                                
                               
                            // Spin complete animation and receive reward
                            console.log(data);
        
                            // Save reward into reward bag
                            saveReward(data);
        
        
                        });
                    }, 2000);
                }

                    //window.location = "<?php echo Front_URL; ?>";
            });
        </script>
        <?php   
       
    }
    else
    {
        $generate_mobilenum = $_POST['user_spin_code'];

        if($mobile_num_otp == '1')
        {
            $select="select * from ".$table_prefix."phonenogenerate where generate_code='$generate_mobilenum' and status = '0'";
        }
        else
        {
            //ramkishan
            $select="select * from ".$table_prefix."phonenogenerate where generate_code='$generate_mobilenum' and status = '1'";
        }

        
        
        $query=mysqli_query($conn,$select);
        $result =mysqli_fetch_assoc($query);
        if(mysqli_num_rows($query) == 0)
        {
            $country_code_num='';
            $generate_mobilenum =  $_POST['user_spin_code'];
            if(isset($_POST['country_code_num']) && $_POST['country_code_num'] !='')
            {
                $country_code_num =  $_POST['country_code_num'];
            }
           

            $mobile_otp_query='';
            if($mobile_num_otp == '1')
            {
              
                //   $mobile_otp_query = "mobile_otp='".$fourRandomDigit."',";
            
         
                //     $insert ="INSERT into phonenogenerate SET generate_code = '".$generate_mobilenum."',
                //     country_code_num ='".$country_code_num."',
                //     status ='0',
                //     ".$mobile_otp_query."
                //     created=now()"; 
                //     mysqli_query($conn,$insert);

                ?>

                    <script>
                        jQuery(document).ready(function(){

                                jQuery("#code_enter_Modal").removeClass("in");
                                jQuery("#code_enter_Modal").hide();

                                jQuery("#otp_enter_Modal").addClass("in");
                                jQuery("#otp_enter_Modal").show();
                                jQuery("#otp_enter_Modal").attr("style","display:block;");

                                return false;
                        });
                    </script>
                <?php

           }
           else
           {


           //ramkishan
                $insert ="INSERT into ".$table_prefix."phonenogenerate SET generate_code = '".$generate_mobilenum."',
                status ='1',
                created=now()"; 
                mysqli_query($conn,$insert);

                $_SESSION['spain_code'] = mysqli_insert_id($conn);
            
        
                ?>
                <script>
                    jQuery(document).ready(function(){
                            jQuery("#drawing").show();
                            jQuery("#code_enter_Modal").removeClass("in");
                            jQuery("#code_enter_Modal").hide();

                            jQuery("#drawing").attr("style","display:block;");
                            jQuery("#code_enter_Modal").attr("style","display:none;")
                            
                            setTimeout(function () {
                                var total_spin = jQuery("#total_spin_show").val();
                                var user_spin = jQuery("#user_spin_count").val();
                                var get_reamin_spin_code= '';
                
                                if(user_spin == '')
                                {
                                    user_spin = 0;
                                }
                
                            
                                //Play sound if have config
                            var check_sound = '<?php echo $sound_config;  ?>';
                            if(check_sound == 1)
                            {
                                setTimeout(function () {
                      
                           
                                    var spinSound = document.getElementById('spinSound');
                                    spinSound.autoplay = true;
                                        spinSound.play().catch(function() {
                                    });
                            
                                },2000);

                                if(isiPhone()){
                                    setTimeout(function () {
                                            
                                                
                                            var spinSound = document.getElementById('spinSound');
                                            spinSound.autoplay = true;
                                                spinSound.play().catch(function() {
                                            });
                                    
                                    },400);
                                }
                            }
                            <?php 
                                    if($code_sp == '1' || $mobile_number_sp == '1' || $code_with_remain_spin_sp == '1' || $share_referrel == '1')
                                    {
                                        ?>
                
                                        
                                        var user_id = 1;
                                        
                                    <?php } 
                                    else
                                    { ?>
                                        var user_id = '<?php echo $user_id_session; ?>';
                                        <?php 
                                    }?>    
                                        var spain_code = '<?php echo $_SESSION['spain_code']; ?>';
                                
                
                                        jQuery.ajax({
                                        type: "POST",
                                        url: '<?php echo Site_URL.'/send_ajax_data.php'; ?>',
                                        data: { 
                                            set_user_spin : 'set_user_spin',
                                            user_id : user_id,
                                            admin_set_total_spin: total_spin,
                                            user_spin: user_spin
                                        
                                            
                                        },
                                        success:function(success)
                                        {
                                            
                                            jQuery("#total_spin_show").attr("value",success);
                                
                                            var get_spin_total_hwe = jQuery("#total_spin_show").val();

                                            jQuery.ajax({
                                            type: "POST",
                                            url: '<?php echo Site_URL.'/send_ajax_data.php'; ?>',
                                            data: { 
                                                set_user_spin_result_remain_spin : 'set_user_spin_result_remain_spin',
                                                user_id : user_id,
                                                user_spin: get_spin_total_hwe,
                                                spain_code: spain_code,
                                                get_reamin_spin_code: get_reamin_spin_code
                                                
                                            },
                                            success:function(result)
                                            {
                                        
                                            }
                                        });
                                        }
                                });
                
                                spin(function(data) {
                                    
                                    var get_show_popup = '<?php echo $background['reward-popup-config']; ?>';
                                    if(get_show_popup == 1)
                                    {
                                        jQuery(".reward-list").addClass("show");
                                    }
                
                                    <?php 
                                    if($code_sp == '1' || $mobile_number_sp == '1' || $code_with_remain_spin_sp == '1' || $share_referrel == '1')
                                    {
                                        ?>
                
                                        
                                        var user_id = 1;
                                        
                                    <?php } 
                                    else
                                    { ?>
                                        var user_id = '<?php echo $user_id_session; ?>';
                                        <?php 
                                    }?>    
                                        var spain_code = '<?php echo $_SESSION['spain_code']; ?>';
                                
                                                        
                                                            
                                        var reward_id_hwe = jQuery("#set_random_spin_value").val();
                                        var reward_item = jQuery("#set_user_reward").val();
                                        var get_spin_total_hwe = jQuery("#total_spin_show").val();

                                        jQuery.ajax({
                                        type: "POST",
                                        url: '<?php echo Site_URL.'/send_ajax_data.php'; ?>',
                                        data: { 
                                            set_user_spin_result : 'set_user_spin_result',
                                            user_id : user_id,
                                            admin_set_total_spin: total_spin,
                                            user_spin: get_spin_total_hwe,
                                            reward_item: reward_item,
                                            reward_id_hwe: reward_id_hwe,
                                            spain_code: spain_code,
                                            get_reamin_spin_code: get_reamin_spin_code
                                            
                                        },
                                        success:function(result)
                                        {
                                            
                                            jQuery(".reward-list .items").html("");
                                            jQuery(".reward-list .items").html(result);

                                            jQuery('.reward-list').css('transform', 'scale(1)');
                                            jQuery('.reward-list').css('visibility', 'visible');
                                        }
                                    
                                    });
                                    // Spin complete animation and receive reward
                                    console.log(data);
                
                                    // Save reward into reward bag
                                    saveReward(data);
                
                
                                });
                            }, 3000);
        
                            //window.location = "<?php echo Front_URL; ?>";
                    });
                </script>
                <?php   
            }
        }
        else
        {
            
            $error_code='<span id="login-password-error" class="error" style="color:red;">Please enter another mobile number.</span>';
            ?>
            <script>
                    jQuery(document).ready(function(){
                        jQuery("#code_enter_Modal").removeClass("fade");
                        jQuery("#code_enter_Modal").addClass("fade in");
                        jQuery("#code_enter_Modal").show();
                        jQuery("#code_enter_Modal").attr("style","display:block;");

                      
                         
                            var spinSound = document.getElementById('spinSound');
                            //spinSound.autoplay = true;
                                spinSound.pause().catch(function() {
                            });
            
                    
                    });
            </script>
            <?php 
            
        }
        
        
        
    }
}
?>

    <div class="modal" id="code_enter_Modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="popup-overlay"></div>
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <form method="post">
                            <div class="modal-header border-bottom-0">
                                <button id="close_code_methods_popup" type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="form-title text-center">
                                <h4></h4>
                                </div>
                                <div class="d-flex flex-column text-center">
                                
                                <?php
                                
                        
                                    $label_mobile = 'Enter Mobile Number';
                                    $type_set = 'number';
                               
                                    
                                   
                                ?>
                                    
                                    <div class="form-group">
                                        <div class="row show_in_center_mobile">
                                            <div class="col-sm-4 login_form_style">
                                                <label><?php echo $label_mobile; ?></label>
                                            </div>
                                            <div class="col-sm-6 custom_add_margin_user" style="display:flex;">
                                                <?php
                                                $output6 = '';
                                                if($mobile_num_otp == '1')
                                                {
                                                    //include 'country_code_with_mob_num_code.php';
                                                
                                                    $countryArray = array(
                                                        
                                                        // 'IN'=>array('name'=>'INDIA','code'=>'91'),
                                                        
                                                        'MY'=>array('name'=>'MALAYSIA','code'=>'60'),
                                                        
                                                    );

                                                    $output6 = '<span><select id="show_number_code" name="country_code_num" class="form-control show_number_code" style="width:100%;">';
                
                                                    foreach($countryArray as $code => $country){
                                                    $mob_code = $country["code"];
                                                        $output6 .= '<option value="'.$mob_code.'">+'.$mob_code.'</option>';
                                                    }
                                                    
                                                    $output6 .= '</select></span>';
                                                    
                                                    echo $output6; 
                                                }
                                                ?>
                                                <input type="<?php echo $type_set; ?>" id="phone" name="user_spin_code" class="form-control design_password" id="user_spin_code" placeholder="<?php echo $label_mobile; ?>">
                                                
                                            </div>
                                        </div>
                                        <?php
                                        
                                        
                                            ?>
                                                <div id="recaptcha-conatiner" style="visibility: hidden;"></div>
                                            <?php
                                      
                                        ?>
                                        
                                    </div>
                              
                                    
                                    <div class="erroe_msg"><?php echo $error_code; ?></div>
                                    
                                
                            
                                </div>
                            </div>
                            <div class="modal-footer d-flex justify-content-center modal_footer">
                                <?php
                                
                                    ?>
                                    <button type="submit" style="display:none;" id="save_spin_code" name="save_spin_code_mobile" class="btn btn-info btn-block btn-round">Submit</button>
                                    <button type="button" style="display:block;"id="save_spin_code_with_otp" onClick="sendOTP_hwe();" name="save_spin_code_mobile_hwe1" class="btn btn-info btn-block btn-round">Submit</button>
                                    <?php
                          
                                ?>
                                
                            </div>

                        </form>
                    </div>
                </div>
            </div>
            <?php 
           
                ?>
            <div class="modal" id="otp_enter_Modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="popup-overlay"></div>
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <form method="post">
                            <div class="modal-header border-bottom-0">
                                <button id="close_otp_popup" type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="form-title text-center">
                                <h4></h4>
                                </div>
                                <div class="d-flex flex-column text-center">
                            
                                <div class="form-group">
                                        <div class="row show_in_center_mobile">
                                        <div class="col-sm-4 login_form_style">
                                            <label>Enter OTP</label>
                                        </div>
                                        <div class="col-sm-6 custom_add_margin_user">
                                            <input type="number" name="enter_otp_sent" class="form-control design_password" id="enter_otp_sent" placeholder="Enter OTP Number" required>
                                        </div>
                                    </div>
                                </div>
                                    
                                <div class="erroe_msg"><?php echo $error_code; ?></div>
                                
                                </div>
                                </div>
                                <div class="modal-footer d-flex justify-content-center modal_footer">
                                
                                <button type="submit" style="display:none;" id="check_spin_code_mobile_otp" name="check_spin_code_mobile_otp" class="btn btn-info btn-block btn-round">Submit</button>
                                <button type="button" id="check_spin_code_mobile_otp_hwe" onClick="varify_code();" name="" class="btn btn-info btn-block btn-round">Submit</button>
                                        
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
                <?php
            
            
                ?>
                <style>
                        #save_spin_code_with_otp
                        {
                            /* display:block !important; */
                        }
                        #save_spin_code
                        {
                            /* display:none; */
                        }
                </style>
                <script src="firebase.js"></script>
                <script src="https://www.gstatic.com/firebasejs/8.3.2/firebase.js"></script>

                    <script>
                    var firebaseConfig = {
                        apiKey: "AIzaSyCA3xs9B29_ShkcRKuHjsChjb1vaXohWKA",
                        authDomain: "lucky-wheel-mini-game.firebaseapp.com",
                        projectId: "lucky-wheel-mini-game",
                        storageBucket: "lucky-wheel-mini-game.appspot.com",
                        messagingSenderId: "150689764858",
                        appId: "1:150689764858:web:a9e6908056186175ef8043",
                        measurementId: "G-MCLDKTEQQX"
                    };

                    // Initialize Firebase
                    firebase.initializeApp(firebaseConfig);
                    firebase.analytics();
                </script>
                
            <script>
            jQuery(document).ready(function(){

                jQuery("#close_code_methods_popup").click(function(){

                    jQuery("#code_enter_Modal").removeClass("in");
                    jQuery("#code_enter_Modal").attr("style","display:none;");

                });

                jQuery("#close_otp_popup").click(function(){

                    jQuery("#otp_enter_Modal").removeClass("in");
                    jQuery("#otp_enter_Modal").attr("style","display:none;");

                });

            

            });

            //ramkishan
    
    
</script>