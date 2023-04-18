<?php
if(isset($_POST['save_user_login']))
{
        $login_email =	$_POST['user_email'];
        $login_password=$_POST['user_password'];
    //ramkishan
        $select="select * from ".$table_prefix."user_table where username='$login_email' and password='$login_password'";
     
        $query=mysqli_query($conn,$select);
        $result =mysqli_fetch_assoc($query);
        
        if(mysqli_num_rows($query)==0)
        {
            $error='<span id="login-password-error" class="error">Please enter correct login details.</span>';
        }
        else
        {
            $_SESSION['user_id'] = $result['id'];
            // echo $result['id'];
            
            // die;
            $ifreame_url = '';
            if($ifreame == 1)
            {
                $ifreame_url = '?ifreame=1&ifuser_id='.$result['id'];
            }
            ?>
            
            <script>
 
                jQuery(document).ready(function(){
             
                        jQuery("#drawing").show();
                        jQuery("#loginModal").removeClass("in");
                        jQuery("#loginModal").hide();

                        jQuery("#drawing").attr("style","display:block;");
                        jQuery("#loginModal").attr("style","display:none;")

                       // window.location = "<?php echo Front_URL.$ifreame_url; ?>";
                        
                });
            </script>

            <?php  
       
        }
    
}
    

$id1=$_SESSION['user_id'];

//ramkishan
$sql="select * from ".$table_prefix."user_table where id='$id1'";
$result=mysqli_query($conn,$sql);
if($result){
while($row=mysqli_fetch_assoc($result))
{
    
$usernew=$row['username'];
$remspin=$row['user_total_spin'];


}
if($remspin>10)
{
$stri=(string)$remspin;
$rem1=$stri[0];
$rem2=$stri[1];
}
else
{
$rem1=0;
$rem2=$remspin;
}
}


$ifreame = $_REQUEST['ifreame'];
$user_id_session = '';
if($code_sp == '1' || $mobile_number_sp == '1' || $code_with_remain_spin_sp == '1')
{
    $user_id =1;
    $spain_code =0;
    if(isset($_SESSION['spain_code']))
    {
        $spain_code = 1;
    }
    else
    {
        $spain_code = 1;
    }
}
else
{
    $spain_code =1;
    $user_id =0;
    if(isset($_SESSION['user_id']))
    {
        $user_id = 1;
        $user_id_session = $_SESSION['user_id'];
    }
    else
    {
        $user_id = 1;
    }
}

if(isset($_REQUEST['ifreame']) && (isset($_REQUEST['ifuser_id']) && $_REQUEST['ifuser_id'] != ''))
{
    $user_id = 1;
    $_SESSION['user_id'] = $_REQUEST['ifuser_id'];
    $user_id_session = $_REQUEST['ifuser_id'];
}



?>
<script>
var burgerMenu = document.querySelector('.burger-menu');
    burgerMenu.addEventListener('click', function(event) {
    
        burgerMenu.children[0].classList.toggle('active');
        burgerMenu.children[0].classList.toggle('cross');
        burgerMenu.children[1].classList.toggle('active');
        burgerMenu.children[1].classList.toggle('cross');
        burgerMenu.children[2].classList.toggle('hide');

        // Show or hide reward list
        document.querySelector('.reward-list').classList.toggle('show');
    });

    
        
    _globalVars.elms.spin.on('click',function() {

if (!_globalVars.isProcessing) {
        
    var total_spin = jQuery("#total_spin_show").val();

    var user_spin = jQuery("#user_spin_count").val();
    
    var check_login_popup_value = jQuery("#get_current_login_id").val();
    
 
         
            var total_spin = jQuery("#total_spin_show").val();

            var user_spin = jQuery("#user_spin_count").val();
            
            var check_login_popup_value = jQuery("#get_current_login_id").val();
            
            if(check_login_popup_value == 1)
            {
                
                jQuery("#loginModal").removeClass("in");
                jQuery("#loginModal").hide();
            }
            else if(check_login_popup_value == 0 || check_login_popup_value == '')
            {
                jQuery("#loginModal").removeClass("fade");
                jQuery("#loginModal").addClass("fade in");
                jQuery("#loginModal").show();
                return false;
            }
        

            if(user_spin == '')
            {
                user_spin = 0;
            }

            // if(parseInt(user_spin) > parseInt(total_spin))
            // {
            //     alert("You can not do spin.");
            //     return false;
            // }
            <?php 
            if($code_sp == '1' || $mobile_number_sp == '1' || $code_with_remain_spin_sp == '1')
            {
            }
            else
            {
               ?>
                if(total_spin <= 0)
                {
                    alert("You can not do spin.");
                    return false;
                }
              <?php 
            } ?>
            
           
            
            

            //Play sound if have config
           var check_sound = '<?php echo $sound_config;  ?>';
           if(check_sound == '1')
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
                        }
             });
            spin(function(data) {
                
                var get_show_popup = '<?php echo $background['reward-popup-config']; ?>';
                if(get_show_popup == 1)
                {
                    jQuery(".reward-list").addClass("show");
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
                                        spain_code: spain_code
                                        
                                    },
                                    success:function(result)
                                    {
                                       jQuery(".reward-list .items").html("");
                                       jQuery(".reward-list .items").html(result);
                                    
                                    }

                                  });
                                
                                //}
                            //});

                

                // Spin complete animation and receive reward
                console.log(data);

                // Save reward into reward bag
                saveReward(data);

            });
      

}

});
</script>