<?php

///login with email
if(isset($_POST['user_username_mobile_save']))
{
 
    $user_mob_num_usname_name = $_POST['user_mob_num_usname_name'];
    $user_mob_num_usname_number = $_POST['user_mob_num_usname_number'];

 //ramkishan
    $select="select * from ".$table_prefix."codegenerate where user_username_mob_meth_username='$user_mob_num_usname_name' && user_username_mob_meth_mobnumber='$user_mob_num_usname_number' && status='1'";
   
    $query=mysqli_query($conn,$select);
    $result =mysqli_fetch_assoc($query);
    
    $get_remain_spin ='';
    if(mysqli_num_rows($query) > 0)
    {

        $error_code='<span id="login-password-error" class="error" style="color:red;">Details Already Used.</span>';
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
        $select8="select * from ".$table_prefix."codegenerate where user_username_mob_meth_username='$user_mob_num_usname_name' && user_username_mob_meth_mobnumber='$user_mob_num_usname_number' && status='0'";
        //ramkishan
        $query8=mysqli_query($conn,$select8);
        $result8 =mysqli_fetch_assoc($query8);

        $get_remain_spin = 0;
        $date = date("Y-m-d h:i:s");
        if(mysqli_num_rows($query8) > 0)
        {
            $user_result_id =$result8['id'];
            $update_limit ="UPDATE ".$table_prefix."codegenerate SET user_username_mob_meth_username='$user_mob_num_usname_name',user_username_mob_meth_mobnumber='$user_mob_num_usname_number',method='user_username_mobile',created='$date' where id='$user_result_id'"; 
            mysqli_query($conn,$update_limit);
            //ramkishan

            $useremailid = $user_result_id;
        }
        else
        {
            $update_limit ="INSERT into ".$table_prefix."codegenerate SET user_username_mob_meth_username='$user_mob_num_usname_name',user_username_mob_meth_mobnumber='$user_mob_num_usname_number',method='user_username_mobile',created='$date'"; 
            mysqli_query($conn,$update_limit);
            //ramkishan
  
            $useremailid = mysqli_insert_id($conn);
        }
    
        $_SESSION['spain_code'] = $useremailid;
        
     
        ?>
        
        <script type="text/javascript">
            var get_reamin_spin_code1 =0;
             get_reamin_spin_code1 = '<?= $get_remain_spin; ?>';
        </script>
        <script type="text/javascript">
            var spain_code1dsfsdfsd = '<?= $_SESSION['spain_code']; ?>';
            
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
                            
                        
                                    var get_spin_total_hwe = 0;

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
                           
          
                                jQuery('.reward-list').css('transform', 'scale(1)');
                                jQuery('.reward-list').css('visibility', 'visible');

                                jQuery('.custom_hide_icon').css('opacity', '1');
                                jQuery('.custom_hide_icon').css('z-index', '999999');
                              

                                
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
        
    }
}
?>