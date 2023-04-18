<?php

///login with email
if(isset($_POST['email_save']))
{
 
    $user_email_id = $_POST['user_spin_code'];

 //ramkishan
    $select="select * from ".$table_prefix."codegenerate where user_email_method_email='$user_email_id' && status='1'";
   
    $query=mysqli_query($conn,$select);
    $result =mysqli_fetch_assoc($query);
    
    $get_remain_spin ='';
    if(mysqli_num_rows($query) > 0)
    {

        $error_code='<span id="login-password-error" class="error" style="color:red;">Please enter correct email or already used.</span>';
        ?>
            <script>
                    jQuery(document).ready(function(){
                        jQuery("#code_enter_Modal").removeClass("fade");
                        jQuery("#code_enter_Modal").addClass("fade in");
                        jQuery("#code_enter_Modal").show();
                        jQuery("#code_enter_Modal").attr("style","display:block;");
                    });
            </script>
            <?php 
    }
    else
    {
        $select8="select * from ".$table_prefix."codegenerate where user_email_method_email='$user_email_id' && status='0'";
   //ramkishan
        $query8=mysqli_query($conn,$select8);
        $result8 =mysqli_fetch_assoc($query8);
        
        $get_remain_spin = 0;
        if(mysqli_num_rows($query8) > 0)
        {
            $user_emails_id =$result8['id'];
            $update_limit ="UPDATE ".$table_prefix."codegenerate SET user_email_method_email = '$user_email_id',method='email',`status`='1',created=now() where id='$user_emails_id'"; 
            mysqli_query($conn,$update_limit);//ramkishan

            $useremailid = $user_emails_id;
        }
        else
        {
           $update_limit ="INSERT into ".$table_prefix."codegenerate SET user_email_method_email = '$user_email_id',method='email',`status`='1',created=now()"; 
            mysqli_query($conn,$update_limit);//ramkishan
    
            $useremailid = mysqli_insert_id($conn);
        }
    
        $_SESSION['spain_code'] = $useremailid;
        
     
  
        ?>
         <script>
            var get_reamin_spin_code1_hwe =0;
            get_reamin_spin_code1_hwe = '<?php echo $get_remain_spin; ?>';
        </script>
        <script>
            var spain_code1_hwe = '<?php echo $useremailid; ?>';
        </script>
         <script>
            var spain_code1_hwe_emaildfg = '<?php echo $useremailid; ?>';
        </script>

        <script>
            jQuery(document).ready(function(){

             
                    jQuery("#drawing").show();
                    jQuery("#code_enter_Modal").removeClass("in");
                    jQuery("#code_enter_Modal").hide();

                    jQuery("#drawing").attr("style","display:block;");
                    jQuery("#code_enter_Modal").attr("style","display:none;")
                    
                    setTimeout(function () {
                        var get_reamin_spin_code =''
                        var total_spin = jQuery("#total_spin_show").val();
                        var user_spin = jQuery("#user_spin_count").val();
                        get_reamin_spin_code = '<?php echo $get_remain_spin; ?>';
        
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
                            if($code_sp == '1' || $mobile_number_sp == '1' || $code_with_remain_spin_sp == '1' || $email_method == '1')
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
                                jQuery('.custom_hide_icon').css('z-index', '999999');
                            }
                                
        
                            // Spin complete animation and receive reward
                            console.log(data);
        
                            // Save reward into reward bag
                            saveReward(data);
        
                        });
                    }, 2000);

                    //window.location = "<?php echo Front_URL; ?>";
            });
        </script>
        <?php  
        
    }
}
?>