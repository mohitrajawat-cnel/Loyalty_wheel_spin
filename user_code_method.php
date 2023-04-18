<?php
///login with code
if(isset($_POST['save_spin_code']))
{
    $user_spin_code = $_POST['user_spin_code'];

    //$_SESSION['user_spin_code'] = $_POST['user_spin_code'];
    
    if($code_sp == '1' || $mobile_number_sp == '1' || $code_with_remain_spin_sp == '1')
    {
      $select="select * from ".$table_prefix."codegenerate where generate_code='$user_spin_code'";
    }
    else
    {
      $select="select * from ".$table_prefix."codegenerate where generate_code='$user_spin_code' and status = '0'";
    }
    $query=mysqli_query($conn,$select);
    $result =mysqli_fetch_assoc($query);
    
    $get_remain_spin = $result['remain_spin_for_code'];
    if(mysqli_num_rows($query)==0)
    {
        $error_code='<span id="login-password-error" class="error" style="color:red;">Please enter correct code.</span>';
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

        $select3="select * from ".$table_prefix."codegenerate where generate_code='$user_spin_code' and status = '1'";
        $query3=mysqli_query($conn,$select3);
        $result3 =mysqli_fetch_assoc($query3);
        $count_code=0;
        if(mysqli_num_rows($query3) > 0)
        {
            $count_code = 1;
        }


          $_SESSION['spain_code'] = $result['id'];


        
     
  
        ?>
        <script>
            var get_reamin_spin_code1_hwe =0;
            get_reamin_spin_code1_hwe = '<?php echo $get_remain_spin; ?>';
        </script>
        <script>
            var spain_code1_hwe = '<?php echo $result['id']; ?>';
        </script>
        <script>
            var spain_code1_hwedfgdfg = '<?php echo $result['id']; ?>';
        </script>
  
        <script>
            jQuery(document).ready(function(){
                    jQuery("#drawing").show();
                    jQuery("#code_enter_Modal").removeClass("in");
                    jQuery("#code_enter_Modal").hide();

                    jQuery("#drawing").attr("style","display:block;");
                    jQuery("#code_enter_Modal").attr("style","display:none;")
                    
                    setTimeout(function () {
                        var get_reamin_spin_code =0;
                        var total_spin = jQuery("#total_spin_show").val();
                        var user_spin = jQuery("#user_spin_count").val();
                        get_reamin_spin_code = '<?php echo $get_remain_spin; ?>';

                        var count_code = '<?php echo $count_code ?>';
        
                        if(user_spin == '')
                        {
                            user_spin = 0;
                        }
        
                        <?php
                     
                      
                        if($code_with_remain_spin_sp == '1')
                        {
                            ?>
                            
                                if(get_reamin_spin_code > 0)
                                {
                                    
                                }
                                else
                                {
                                    alert("You have no spin left.");
                                    return false;
                                }
                            
                            <?php
                        }

                        if($code_sp == '1')
                        {
                            ?>
                            
                                if(count_code > 0)
                                {
                                    
                                    // alert("Code already used.");
                                    jQuery.ajax({
                                        type: "POST",
                                        url: '<?php echo Site_URL.'/send_ajax_data.php'; ?>',
                                        data: { 
                                            get_used_code_result : 'get_used_code_result',
                                            code : '<?php echo $_SESSION['spain_code']; ?>',
                                        
                                            
                                        },
                                        success:function(used_code_result)
                                        {
                                            jQuery("#code_enter_Modal").removeClass("in");
                                            jQuery("#code_enter_Modal").hide();
                                            jQuery("#code_enter_Modal").attr("style","display:none;");
                                            jQuery('.reward-list .items').html('');
                                            jQuery('.reward-list .items').html(used_code_result);
                                            jQuery('.reward-list').css('transform', 'scale(1)');
                                            jQuery('.reward-list').css('visibility', 'visible');

                                            jQuery('.custom_hide_icon').css('opacity', '1');
                                            jQuery('.custom_hide_icon').css('z-index', '1050');
                                            
                                        }
                                    });
                                    return false;
                                }
                            
                            <?php
                        }
                        
                        if($code_sp == '1' || $mobile_number_sp == '1' || $code_with_remain_spin_sp == '1')
                        {
                        }
                        else
                        {
                           ?>
                            if(total_spin <= 0)
                            {
                                alert("You have no spin left.");
                                return false;
                            }
                          <?php 
                        }
                        ?>
        
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
                                // var spain_code = '<?php echo $_SESSION['spain_code']; ?>';
                            
                                //         var reward_id_hwe = jQuery("#set_random_spin_value").val();
                                //         var reward_item = jQuery("#set_user_reward").val();
                                //         var get_spin_total_hwe = jQuery("#total_spin_show").val();

                                        jQuery('.reward-list').css('transform', 'scale(1)');
                                        jQuery('.reward-list').css('visibility', 'visible');

                                        jQuery('.custom_hide_icon').css('opacity', '1');
                                        jQuery('.custom_hide_icon').css('z-index', '1050');

                                //         jQuery.ajax({
                                //         type: "POST",
                                //         url: '<?php echo Site_URL.'/send_ajax_data.php'; ?>',
                                //         data: {
                                //             set_user_spin_result : 'set_user_spin_result',
                                //             user_id : user_id,
                                //             admin_set_total_spin: total_spin,
                                //             user_spin: get_spin_total_hwe,
                                //             reward_item: reward_item,
                                //             reward_id_hwe: reward_id_hwe,
                                //             spain_code: spain_code,
                                //             get_reamin_spin_code: get_reamin_spin_code
                                            
                                //         },
                                //         success:function(result)
                                //         {
                                //             jQuery(".reward-list .items").html("");
                                //             jQuery(".reward-list .items").html(result);

                                //             jQuery('.reward-list').css('transform', 'scale(1)');
                                //             jQuery('.reward-list').css('visibility', 'visible');

                                //             jQuery('.custom_hide_icon').css('opacity', '1');
                                //             jQuery('.custom_hide_icon').css('z-index', '1050');

                                            
                                //         }

                                    
                                // });
                                    
                                
                
                            if(get_show_popup == 1)
                            {
                                jQuery(".reward-list").addClass("show");
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
        
           $update_limit ="UPDATE ".$table_prefix."codegenerate SET status = '1' WHERE id='".$result['id']."'"; 
           mysqli_query($conn,$update_limit);
    }
}
?>