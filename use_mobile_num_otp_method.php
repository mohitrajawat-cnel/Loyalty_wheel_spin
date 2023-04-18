<?php
///login with mobile number

$error_code='';
if(isset($_POST['save_spin_code_mobile']) || isset($_POST['check_spin_code_mobile_otp']))
{

    if(isset($_POST['user_spin_code']) && $_POST['user_spin_code'] != '')
    {
        $generate_mobilenum =  $_POST['user_spin_code'];
    }

    $get_remain_spin=0;
    $enter_otp_sent='';
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
        if($mobile_num_otp == '1')
        {
            $generate_mobilenum = $result['generate_code'];
        }

        $phone_id = $result['id'];

       
        
        $_SESSION['spain_code'] = $phone_id;

        ?>
        <script>
            var get_reamin_spin_code1_hwe =0;
            get_reamin_spin_code1_hwe = '<?php echo $get_remain_spin; ?>';
        </script>
        <script>
            var spain_code1_hwe = '<?php echo $phone_id; ?>';
        </script>
        <script>
            var spain_code1_hwe_mobilenumdfdsfdfgsd = '<?php echo $phone_id; ?>';
        </script>
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
                  
                        
                                var user_id = 1;
                      
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

                      
                            jQuery.ajax({
                                type: "POST",
                                url: '<?php echo Site_URL.'/send_ajax_data.php'; ?>',
                                data: { 
                                    double_check_codephone_status : 'double_check_codephone_status',
                                    mobile_number:'<?php echo $generate_mobilenum; ?>',
                                    phone_number_id : '<?php echo $_SESSION['spain_code']; ?>',
                                    otp_code:'<?php echo $enter_otp_sent; ?>'
                                
                                },
                                success:function(response_phone_status)
                                {
                                
                                    if(response_phone_status == 1)
                                    {
                                        spin(function(data) {
                                
                                        var get_show_popup = '<?php echo $background['reward-popup-config']; ?>';
                                    
                                                
                                                if(get_show_popup == 1)
                                                {
                                                    jQuery(".reward-list").addClass("show");

                                                    jQuery('.reward-list').css('transform', 'scale(1)');
                                                    jQuery('.reward-list').css('visibility', 'visible');

                                                    jQuery('.custom_hide_icon').css('opacity', '1');
                                                    jQuery('.custom_hide_icon').css('z-index', '1050');
                                                }
                                            

                                                    
                                                    // Spin complete animation and receive reward
                                                    console.log(data);
                                
                                                    // Save reward into reward bag
                                                    saveReward(data);
                                
                                
                                                });

                                    } 
                                    else
                                    {
                                        
                                        alert("Mobile Number Already Exist. Please use another Number");
                                        window.location.href = '<?php echo Front_URL; ?>';
                                        
                                        
                                    }
                                } 
                            
                        
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
        if(mysqli_num_rows($query) <= 0)
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

               $get_remain_spin=0;
           //ramkishan
           if($host_name == 'dailyspin88.com')
           {
                $insert ="INSERT into ".$table_prefix."phonenogenerate SET generate_code = '".$generate_mobilenum."',
                status ='0',
                created=now()"; 
                mysqli_query($conn,$insert);
           }
           else
           {
                $insert ="INSERT into ".$table_prefix."phonenogenerate SET generate_code = '".$generate_mobilenum."',
                status ='1',
                created=now()"; 
                mysqli_query($conn,$insert);
           }
              

                $_SESSION['spain_code'] = mysqli_insert_id($conn);
            
        
                ?>
                <script>
                    var get_reamin_spin_code1_hwe =0;
                    get_reamin_spin_code1_hwe = '<?php echo $get_remain_spin; ?>';
                </script>
                <script>
                    var spain_code1_hwe = '<?php echo $_SESSION['spain_code']; ?>';
                </script>
                <script>
                    var spain_code1_hwe_mobilenumdfdsfdfgsd = '<?php echo $_SESSION['spain_code']; ?>';
                </script>
       
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
                                    if($code_sp == '1' || $mobile_number_sp == '1' || $code_with_remain_spin_sp == '1')
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

                                        jQuery('.reward-list').css('transform', 'scale(1)');
                                        jQuery('.reward-list').css('visibility', 'visible');

                                        jQuery('.custom_hide_icon').css('opacity', '1');
                                        jQuery('.custom_hide_icon').css('z-index', '1050');
                                    }
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