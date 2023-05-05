<?php
session_start();
include 'admin_panel/pages/config.php';
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<?php
$error='';
if(isset($_POST['save_user_login']))
{
        $login_email =	$_POST['user_email'];
        $login_password=$_POST['user_password'];
    
        $select="select * from user_table where username='$login_email' and password='$login_password'";
     
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

                        //window.location = "<?php echo Front_URL.$ifreame_url; ?>";
                        
                });
            </script>

            <?php  
       
        }
    
}


$id1=$_SESSION['user_id'];


$sql="select * from user_table where id='$id1'";
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
if($host_name == 'wheel006.jgdx.xyz' || $host_name == 'spin2win.bet' || $host_name == 'skyworldsg-luckyspin.com' || $host_name == 'wheel001.jgdx.xyz' || $host_name == 'wheel011.jgdx.xyz' || $host_name == 'fbads996.com')
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
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" />
    <title>Loyalty Wheel Spin</title>
    <meta name="description" content="" data-type="admin" />
    <meta name="keywords" content="" data-type="admin" />
    <meta name="author" content="Gafami">
    <meta property="fb:app_id" content="1701132369920968" data-type="admin" />
    <meta property="og:url" content="" data-type="admin" />
    <meta property="og:type" content="Website" data-type="admin" />
    <meta property="og:title" content="Loyalty Wheel Spin" data-type="admin" />
    <meta property="og:description" content="" data-type="admin" />
    <meta property="og:image" content="" data-type="admin" />

    <link rel='stylesheet' href='css/spectrum.min.css' data-type="admin" />
    <!--<link rel="stylesheet" href="css/swiper.min.css" data-type="admin" id="swiper-style">-->
    <link rel="stylesheet" href="css/global.css" />
    <link rel="stylesheet" href="css/admin.css" data-type="admin" />
    <link rel="icon" href="img/brand.png" type="image/png">
    
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
</head>
<style>
@media only screen and (min-width:768px)
{
   #viewBox
   {
     height:800px !important;
   }
}
</style>
<script>
jQuery(document).ready(function(){

    var get_full_url = document.URL;
   
    setInterval(function() {

            jQuery.ajax({
            type: "POST",
            url: get_full_url+"admin_panel/pages/send_ajax_data.php",
            data: { 
                randomresultshow: 'randomresultshow'
            
            
            },
            success:function(success)
            {
              var get_site_host_name ='<?php echo $host_name; ?>';
               if(get_site_host_name   == 'edbet321spins.com')
               {
                    jQuery(".content__container__list").html(success);
               }
               else
               {    
                    jQuery(".reward-list-all .items").html();
                    jQuery(".reward-list-all .items").html(success);
               }
               

            }
        });

    }, 6000);
     
    var user_id = ' <?php echo $user_id; ?>';
    
    var spain_code = ' <?php echo $spain_code; ?>';

    if(user_id == 0)
    {
        jQuery("#loginModal").removeClass("fade");
        jQuery("#loginModal").addClass("fade in");
        jQuery("#loginModal").show();
    }
    else if(user_id == 1)
    {
        jQuery("#loginModal").removeClass("in");
        jQuery("#loginModal").hide();
        
        if(spain_code == 0)
        {
            jQuery("#code_enter_Modal").removeClass("fade");
            jQuery("#code_enter_Modal").addClass("fade in");
            jQuery("#code_enter_Modal").show();
        }
        else
        {
            jQuery("#code_enter_Modal").removeClass("in");
            jQuery("#code_enter_Modal").hide();
        }
    }

  
});
</script>
<script>
jQuery(document).ready(function(){
   
     
    var user_id = ' <?php echo $user_id; ?>';
    
    var spain_code = ' <?php echo $spain_code; ?>';

    if(user_id == 0)
    {
        jQuery("#loginModal").removeClass("fade");
        jQuery("#loginModal").addClass("fade in");
        jQuery("#loginModal").show();
    }
    else if(user_id == 1)
    {
        jQuery("#loginModal").removeClass("in");
        jQuery("#loginModal").hide();
        
        if(spain_code == 0)
        {
            jQuery("#code_enter_Modal").removeClass("fade");
            jQuery("#code_enter_Modal").addClass("fade in");
            jQuery("#code_enter_Modal").show();
        }
        else
        {
            jQuery("#code_enter_Modal").removeClass("in");
            jQuery("#code_enter_Modal").hide();
        }
    }

  
});
</script>

<style>
    .reward-list
    {
        z-index: 1000;
    }
    #particles-js
    {
        position: fixed !important;
        height:100vh !important;
    }
</style>
<?php

$select ="SELECT * from wheel_data";
$row = $conn->query($select);
$result = mysqli_fetch_assoc($row);

$site_logo_hwe = $result['site_logo_hwe'];


$background =  json_decode($result['spin_data'],true);
$site_logo_hwe = $background['site_logo_hwe'];
$bg_color = $background['bg_color'];

$background_walpaper ='';


$sound_config =$background['sound-config'];

$live_chat_menu_url = $background['live_chat_menu_url'];

$total_slices_hwe =$background['slice'];

$wallpaper_config =$background['wallpaper-config'];
$live_wallpaper_img =$background['live_wallpaper_img'];

$wheel_ux_config =$background['wheel-ux-config'];

$total_spin_show_admin = $background['total_spin_show'];

$coundown_popup_config = $background['coundown-popup-config'];

$no_matter_probability = $background['no_matter_probability'];

$slider_banner = $background['slider_banner'];

$normal_spin_check = $background['normal_spin_check'];


$reward_list_effect = $background['reward_list_effect'];



if($coundown_popup_config == 1)
{
    $coundown_popup_config_selected = 'selected';
}
else
{
    $coundown_popup_config_selected = '';
}


$user_id = $user_id_session;

////spin_data images label
$total_slices = $background['slice'];
   
$images_slice_data =array();
for($i =0; $i <$total_slices; $i++ )
{
    $images_slice_data[$i] = $background['no_matter_labal_image_hideshow'.$i];
}

$no_matter_labal_image_hideshow = json_encode($images_slice_data);

////spin_data images label
$labels_slice_data =array();
for($i =0; $i <$total_slices; $i++ )
{
    $labels_slice_data[$i] = $background['prize'.$i];
}
$get_labels_value_wheel_hwe = json_encode($labels_slice_data);


$user_total_spin_select ="SELECT * from user_table where `id`='".$user_id."'";
$user_total_spin_row = $conn->query($user_total_spin_select);

while($user_total_spin_result = mysqli_fetch_assoc($user_total_spin_row))
{
    $total_spin_user_hwe='';
    $total_spin_user_hwe = $user_total_spin_result['user_spinned'];

    $total_spin_user_set_admin='';
    $total_spin_user_set_admin = $user_total_spin_result['user_total_spin'];
}
 
?>
<script>
    
    jQuery(document).ready(function(){
        
            setTimeout(function(){
              
                var get_total_slice = '<?php echo $total_slices_hwe;  ?>';
                jQuery("#slice").val(get_total_slice).trigger('change');
         
        
                var get_walpaper = '<?php echo $wallpaper_config;  ?>';
                jQuery("#wallpaper-config").val(get_walpaper).trigger('change');
          
                var wheel_ux_config = '<?php echo $wheel_ux_config;  ?>';
                jQuery("#wheel-ux-config").val(wheel_ux_config).trigger('change');
      
      
                var check_sound = '<?php echo $sound_config;  ?>';
                jQuery("#sound-config").val(check_sound).trigger('change');
            
            },800);

      //  setTimeout(function(){
            
            //  var get_total_slice_hwe = '<?php echo $total_slices_hwe;  ?>';
            //  if(get_total_slice_hwe == '12')
              //{
                //  jQuery("#drawing g:nth-child(2) g:nth-child(3)").attr('transform','matrix(6.123234262925839e-17,1,-1,6.123234262925839e-17,765.6737060546875,-40.581390380859375)');
             // }
             // else if(get_total_slice_hwe == '5')
             // {
                 // jQuery("#drawing g:nth-child(2) g:nth-child(3)").attr('transform','matrix(0.30901700258255005,0.9510565400123596,-0.9510565400123596,0.30901700258255005,597.2919921875,-114.30839538574219)');
             // }
              //else if(get_total_slice_hwe == '8')
             // {
                  //jQuery("#drawing g:nth-child(2) g:nth-child(3)").attr('transform','matrix(0.12186934053897858,0.9925461411476135,-0.9925461411476135,0.12186934053897858,700.7461547851562,-50.4896469116211)');
                  
             // }
             // else if(get_total_slice_hwe == '10')
             // {
                //  jQuery("#drawing g:nth-child(2) g:nth-child(3)").attr('transform','matrix(0.12186934053897858,0.9925461411476135,-0.9925461411476135,0.12186934053897858,714.7461547851562,-75.4896469116211)');
                  
             // }
              //else if(get_total_slice_hwe == '36')
              //{
                 // jQuery("#drawing g:nth-child(2) g:nth-child(3)").attr('transform','matrix(6.123234262925839e-17,1,-1,6.123234262925839e-17,753.6567993164062,-02.85595703125)');
                 //jQuery("#drawing g:nth-child(2) g:nth-child(3) g:nth-child(1)").attr('title','mohit');
                  
            //  }
          
          
         //},1000);
        
        jQuery("#drawing").attr("style","display:none;");
        jQuery("#rotate_image_hide").attr("style","display:block;z-index: 9999999;position: absolute;top: 45%;width: 150px;");
     
            
            var site_host_name = '<?php echo $host_name; ?>';
            if(site_host_name == 'wheel006.jgdx.xyz' || site_host_name == 'spin2win.bet' || site_host_name == 'skyworldsg-luckyspin.com' || site_host_name == 'wheel001.jgdx.xyz' || $host_name == 'wheel011.jgdx.xyz' || site_host_name == 'wgc33.vip' || site_host_name == 'fbads996.com')
            {
                
            }
            else
            {
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
            }
       
       
            jQuery(".save_reward_email").on("click",function(){

                        var user_id = '<?php echo $user_id_session; ?>';
                        var email_value = jQuery("#customer-email").val();
                        var reward_id = jQuery("#customer_reward_id_hwe").val();
      

                        jQuery.ajax({
                                        type: "POST",
                                        url: "<?php echo Site_URL; ?>/send_ajax_data.php",
                                        data: { 
                                            update_email_in_result : 'update_email_in_result',
                                            user_id : user_id,
                                            user_email_reward : email_value,
                                            reward_id : reward_id
                                        
                                        },
                                        success:function(success)
                                        {
                                            jQuery("#popup-customer-email").hide();
                                            jQuery(".after_redeem_change_button_"+reward_id+" button").html('<span>USED</span>');
                                            jQuery(".after_redeem_change_button_"+reward_id+" button").attr("onclick","");
                                            jQuery(".after_redeem_change_button_"+reward_id+" button").addClass("disabled");
                                            
                                             jQuery('.reward-list').css('transform', 'scale(0)');
                                             jQuery('.reward-list').css('visibility', 'hidden');
                                             
                                             window.location.href= jQuery(location).attr('href');
                                        }
                        });

            });
       
    });
    
      
</script>

<body style="background-color:<?php echo $bg_color; ?>">
    <input type="hidden" id="image_labal_hide_show_data" value='<?php echo $no_matter_labal_image_hideshow; ?>' />
    <input type="hidden" id="get_labels_value_wheel_hwe" value='<?php echo $get_labels_value_wheel_hwe; ?>' />
    
 <!-- partial -->


    <!-- POPUP CUSTOMER EMAIL RENDER HERE  -->
    <div id="popup-customer-email" class="common-popup hide" data-type="admin">
        <div class="inner-content" style="position: fixed !important;">
            <input id="customer_reward_id_hwe" type="hidden">
            <input id="customer-email" class="text-box" type="text" maxlength="80" placeholder="Please enter your email to recive the reward" value="" oninput="validateEmail(this, value)" />
            <button class="btn btn-send-email sameline save_reward_email inactive"><span>Save</span></button>
        </div>
    </div>


    <input type="hidden" id="total_spin_show" value="<?php echo $total_spin_user_set_admin; ?>">
    <input type="hidden" id="user_spin_count" value="<?php echo $total_spin_user_hwe; ?>">
    <input type="hidden" id="get_current_login_id" value="<?php echo $user_id_session; ?>">
    <input type="hidden" id="no_matter_probability_hwe" value="<?php echo $no_matter_probability; ?>">
    <input type="hidden" id="set_random_spin_value">
    <input type="hidden" id="set_user_reward">
    <input type="hidden" id="website_main_url_hwe" value="<?php echo Front_URL; ?>">
    
    <input type="hidden" id="spain_code_hwe" value="<?php echo $_SESSION['spain_code']; ?>">
    
    <!-- BACKGROUND ANIMATION RENDER HERE -->
    <?php
    if($wallpaper_config == 9)
    {
        ?>

    <style>
         #particles-js
         {
            background-image: url(<?php echo 'admin_panel/pages/'.$live_wallpaper_img; ?>) !important;
            height:100vh;
            position:fixed !important;
         }
    </style>

          
        <?php

        $live_wallpaper_bg = 'background-image: url('.$live_wallpaper_img.') !important;';
    }
    ?>

    
    <div id="particles-js" class="happy-new-year" style="<?php echo $live_wallpaper_bg; ?>">
        

</div>


    <!-- THIS ELEMENT TO BE USED TO DRAW LUCKY WHEEL -->
    <div class="container" style="justify-content: center;display: flex;">
            <img id="rotate_image_hide" src="img/rotate_gif.gif" style="display:none;z-index: 9999999;position: absolute;top: 45%;width: 150px;">
    </div>
    <div id="drawing" style="display:none;">


    <?php 
        if($host_name == 'edbet321spins.com')
        {
          include 'front_second_layout.php';
        }
        else
        {
           include 'front_first_layout.php';
        }
    ?>
    <div class="reward-list">

        <div class="items">
            <?php
                $selcte_reward_list  = "SELECT * from spin_result where `user_id`='".$user_id_session."' order by id desc";
                $row_reward = $conn->query($selcte_reward_list);
                while($result_reward = mysqli_fetch_assoc($row_reward))
                {
                    $reward_item = $result_reward['reward_item'];
                    $user_email = $result_reward['user_email'];
                    $reward_id = $result_reward['id'];
                    $reward_id_hwe = $result_reward['reward_id'];
                    $redeem_used_hwe = $result_reward['redeem_used'];
                    
                     //get reward redeem details
                    $select_reward ="SELECT * from wheel_data";
                    $row_reward_wheel = $conn->query($select_reward);
                    $result_reward_wheel = mysqli_fetch_assoc($row_reward_wheel);
                
                    $spin_data =  json_decode($result_reward_wheel['spin_data'],true);
                
                    $total_slices = $spin_data['slice'];
                   
                    $prize =array();
                    $redirect_onoff = 0;
                    $redirect_link_hwe = '';
                    for($i =0; $i <$total_slices; $i++ )
                    {
                        if($i==$reward_id_hwe) 
                        {
                            $redirect_link_hwe = $spin_data['reward_redirect_link_redeem'.$i];
                            $redirect_onoff = $spin_data['no_matter_reward_redirect_link_redeem'.$i];
                        }
                    }

                    if($redeem_used_hwe == 1)
                    {
                        $all_data .= '
                        <div class="item disabled after_redeem_change_button_'.$reward_id.'">
                            <button class="btn-redeem disabled" ><span disabled="disabled">USED</span></button>
                            <div class="value" data-value="'.$reward_item.'">'.$reward_item.'</div>
                        </div>
                      ';
                       
                    }
                    else
                    {
                        if($redirect_onoff==1)
                        {
                              $all_data .='
                                    <div class="item disabled after_redeem_change_button_'.$reward_id.'">
                                        <a  onclick="spin_result_redeem_used_update('.$reward_id.')" target="_blank" href="'.$redirect_link_hwe.'" ><button class="btn-redeem"><span>REDEEM</span></button></a>
                                        <div class="value" data-value="'.$reward_item.'">'.$reward_item.'</div>
                                    </div>
                              ';
                        }
                        else
                        {
                            $all_data .='
                                    <div class="item disabled after_redeem_change_button_'.$reward_id.'">
                                        <button class="btn-redeem" onclick="redeem('.$reward_id.')"><span>REDEEM</span></button>
                                        <div class="value" data-value="'.$reward_item.'">'.$reward_item.'</div>
                                    </div>
                              ';
                        }
                    }
                }

                echo $all_data;
            ?>
        </div>
       
     </div>
     
     <?php //}?>
    <!-- BANNERS -->
    <div id="ads" data-type="admin">
        <div class="swiper-container">
   
<div class="modal" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="top:81px;">
    <div class="popup-overlay"></div>
    <div class="modal-dialog modal-dialog-centered" role="document" style="z-index: 10000;">
        <div class="modal-content">
            <style>
                @media only screen and (max-width:590px)
                {
                    .show_in_center_mobile
                    {
                        justify-content: center;
                    }
                    .custom_add_margin_user
                    {
                        margin-left: 16px;
                    }
                }
            </style>
            <form method="post">
                <div class="modal-header border-bottom-0">
                    <!-- <button id="close_user_login_popup" type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button> -->
                </div>
                <div class="modal-body">
                    <div class="form-title text-center">
                    <h4></h4>
                    </div>
                    <div class="d-flex flex-column text-center">
                    
                    
                        <div class="form-group">
                             <div class="row show_in_center_mobile" style="display: flex;">
                                <div class="col-sm-4" style="text-align: right;padding: 20px;color: #ef8318;">
                                    <label>User ID</label>
                                </div>
                                <div class="col-sm-6 custom_add_margin_user">
                                    <input type="text" name="user_email" class="form-control design_password" id="user_email" placeholder="Enter your id">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row show_in_center_mobile" style="display: flex;">
                                <div class="col-sm-4" style="text-align: right;padding: 20px;color: #ef8318;">
                                        <label>Password</label>
                                </div>
                                <div class="col-sm-6">
                                    <input type="password" name="user_password" class="form-control design_password" id="user_password" placeholder="Enter your password">
                                </div>
                            </div>
                        
                        </div>

                        <div class="erroe_msg"><?php echo $error; ?></div>
                        
                    
                
                </div>
                </div>
                <div class="modal-footer d-flex justify-content-center modal_footer">
                    <button type="submit" id="save_user_login" name="save_user_login" class="btn btn-info btn-block btn-round">Sign In</button>
                </div>

            </form>
    </div>
    </div>
 </div>
 <?php
 include 'use_code_or_mobile_method.php';
 ?>
 <input type="hidden" id="user_spin_code_hwe" value="<?php echo $user_spin_code; ?>" />
  
    <div id="edit-params" data-type="admin" class="l-first" style="display:none;">

        <div class="form-group">
                <h2 for="wallpaper-config" class="remake">Live Wallpapers</h2>
                <select id="wallpaper-config" class="form-control" name="wallpaper-config">
                    <option value="0" >No</option>
                    <option value="3"  >Songkran</option>
                    <option value="1" >Christmas</option>
                    <option value="2"  >Happy new year</option>
                    <option value="4" >Flame</option>
                    <option value="5" >Gift</option>
                    <option value="6" >Zodiac</option>
                    <option value="9" >Your Background</option>
                </select>
        </div>
        <div class="form-group">
                <h2 for="wheel-ux-config" class="remake">Wheel UX</h2>
                <select id="wheel-ux-config" class="form-control" name="wheel-ux-config">
                    <option value="0">Original</option>
                    <option value="1">Golden Style</option>
                    <option value="2">Gift Style</option>
                    <option value="3">Zodiac</option>
                    <option value="4">Reward Image</option>
                </select>
        </div>
        <div class="form-group">
                <h2 for="coundown-popup-config" class="remake">Count Down Timer</h2>
                <select id="coundown-popup-config" class="form-control" name="coundown-popup-config">
                    <option value="1" <?php if($coundown_popup_config == 1){ echo 'selected'; } ?> >Yes</option>
                    <option value="0" <?php if($coundown_popup_config == 0){ echo 'selected'; } ?> >No</option>
                </select>
        </div>
        <div class="form-group">
                <h2 for="sound-config" class="remake">Spin Sound</h2>
                <select id="sound-config" class="form-control" name="sound-config">
                    <option value="1" <?php if($sound_config == 1){ echo 'selected'; } ?> >Yes</option>
                    <option value="0" <?php if($sound_config == 0){ echo 'selected'; } ?> >No</option>
                </select>
        </div>
        <div class="form-group">
            <h2 for="slice" class="remake">Total slices</h2>
            <select id="slice" class="form-control" onchange="setTotalSlices()">
                <option value="5">5 Slices</option>
                <option value="8">8 Slices</option>
                <option value="10">10 Slices</option>
                <option value="12" selected>12 Slices</option>
                <option value="36">36 Slices</option>
            </select>
        </div>
        <div class="form-group layout-group">
            <h2 for="list-input" class="toogle-hidden-menu pointer remake">Slice data <span class="toggle-redirect-link">=></span></h2>
            <div id="list-input">
                <!--<input type="text" class="form-control input-detail" placeholder="Enter Slice Value" />-->
            </div>
            <div id="list-redirect-Link" class="">
                <!--<input type="text" class="form-control input-detail" placeholder="Enter Redirect Link" />-->
            </div>
        </div>
    </div>
    <div id="edit-params" data-type="admin" class="r-first" style="display:none;">
        <div class="form-group">
            <h2 for="wheel-ux-config" class="remake">Wheel UX</h2>
            <select id="wheel-ux-config" class="form-control">
                <option value="0">Original</option>
                <option value="1">Golden Style</option>
                <option value="2">Gift Style</option>
                <option value="3">Zodiac</option>
                <option value="4" selected>Reward Image</option>
            </select>
        </div>
    
        <div class="form-group">
            <h2 for="graphic">Graphic quality</h2>
            <select id="graphic" class="form-control" onchange="setGraphicQuality()">
                <option value="0">Low</option>
                <option value="1" selected>Medium</option>
                <option value="2">High</option>
            </select>
        </div>
        <div class="form-group">
            <h2 for="graphic">Upload spin icon</h2>
            <label class="btn btn-default btn-upload" for="file-selector">
                <input id="file-selector" type="file" onchange="setBrandLogo()" style="display:none;">
                Choose Image
            </label>
        </div>
        <div class="form-group">
            <h2 for="bg">Background color</h2>
            <input id='colorpicker' />
        </div>
    </div>


    <!-- SOUND TRACK -->
    <audio id="spinSound" controls style="display:none;">
        <source src="media/spinSound.mp3" type="audio/mp3">
        Your browser does not support the audio element.
    </audio>
    <?php
       $default_config_array =array();
       $default_reward_image_array =array();
      
       

       $sound_config =$background['sound-config'];
       if($sound_config == 1)
       {
           $sound_check_hwe = true; 
       }
       else
       {
           $sound_check_hwe = false;
       }

       for($m=0; $m<$total_slices_hwe; $m++)
       {
           $default_reward_image_array[] = array(
                                               'value'=>  $background['prize'.$m],
                                               'imageUrl' => 'img/reward'.$m.'.png',
                                           );
       }
    
       $default_config_array =array (
                                      'wheelUX' => $wheel_ux_config,
                                      'totalSlices' => $total_slices_hwe,
                                      'distanceDeg' => 45,
                                      'defaultStartDeg' => 270,
                                      'borderSlice' => 5,
                                      'sliceWidth' => 30,
                                      'graphicOption' => $graphic,
                                      'brandLogo' => 'admin_panel/pages/img/brand.png',
                                      'backgroundColor' => $bg_color,
                                      'allowSound' => $sound_check_hwe,
                                      'anims' => 
                                      array (
                                        'fallingSnow' => true,
                                        'flame' => false,
                                      ),
                                    );
                                    
      
    ?>
    <script>
        
        var send_defaultConfig_json_data = '<?php echo json_encode($default_config_array); ?>';
    </script>
        <script>
        
        var send_reward_image_json_data = '<?php echo json_encode($default_reward_image_array); ?>';
    </script>

    <!-- CONFIG NEEDED PARAMS GENEREATE FROMN ADMIN PAGE TO OPERATE THE WHEEL AS: TOTAL SLICE, GRAPHIC, REWARD VALUES -->
    <script id="config" defer></script>
    <script id="smtp" src="js/smtp.js" data-type="admin" defer></script>
    <script src="js/svg.min.js" defer></script>
    <script src="js/layout.js" defer></script>
    <script src="js/jquery-3.4.0.min.js" data-type="admin" defer></script>
    <script src='js/spectrum.min.js' data-type="admin" defer></script>
    <script src="js/jszip.min.js" data-type="admin" defer></script>
    <script src="js/jszip-utils.min.js" data-type="admin" defer></script>
    <script src="js/filesaver.js" data-type="admin" defer></script>
    <script src="js/params.js" data-type="admin" defer></script>
    <script id="particles-lib" src="js/particles.min.js" defer></script>
    <script id="anims" src="js/animations.js" defer></script>
    <script>
    /***************** CLICK AND RECEIVE REWARD EVENTS *****************/


    function loadEvents() {

        // Load reward
        //loadRewardBag();

      

        // Spin tap
        _globalVars.elms.spin.click(function() {

            if (!_globalVars.isProcessing) {
                    
                var total_spin = jQuery("#total_spin_show").val();

                var user_spin = jQuery("#user_spin_count").val();
                
                var check_login_popup_value = jQuery("#get_current_login_id").val();
                
                
                <?php 
                //check code is valid
                    if($host_name == 'wheel006.jgdx.xyz' || $host_name == 'spin2win.bet' || $host_name == 'skyworldsg-luckyspin.com' || $host_name == 'wheel001.jgdx.xyz' || $host_name == 'wheel011.jgdx.xyz' || $host_name == 'wgc33.vip' || $host_name == 'fbads996.com')
                    {
                     ?>
                        var spain_code_hwe = jQuery('#spain_code_hwe').val();
                        if(spain_code_hwe == '')
                        {
                            jQuery("#code_enter_Modal").removeClass("fade");
                            jQuery("#code_enter_Modal").addClass("fade in");
                            jQuery("#code_enter_Modal").show();
                            return false;
                        }
                        
                        var user_code = spain_code_hwe;
                        
                         jQuery.ajax({
                                    type: "POST",
                                    url: '<?php echo Site_URL.'/send_ajax_data.php'; ?>',
                                    data: { 
                                        check_user_code_limit_is_allow : 'check_user_code_limit_is_allow',
                                        user_code : user_code
                                    },
                                    success:function(success)
                                    {
                                        if(success)
                                        {
                                            jQuery("#code_enter_Modal").removeClass("fade");
                                            jQuery("#code_enter_Modal").addClass("fade in");
                                            jQuery("#code_enter_Modal").show();
                                            return false;
                                        }
                                        else
                                        {
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
                                            if($host_name == 'wheel006.jgdx.xyz' || $host_name == 'spin2win.bet' || $host_name == 'skyworldsg-luckyspin.com' || $host_name == 'wheel001.jgdx.xyz' || $host_name == 'wheel011.jgdx.xyz' || $host_name == 'fbads996.com')
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
                                           if(check_sound == 1)
                       {
                           setTimeout(function () {
                           if(_dynamicParams.config.allowSound) {
                                    var spinSound = document.getElementById('spinSound');
                                        spinSound.play().catch(function() {
                                    });
                            }
                           },2000);
                       }
                                            
                            
                                            spin(function(data) {
                                                
                                                var get_show_popup = '<?php echo $background['reward-popup-config']; ?>';
                                                if(get_show_popup == 1)
                                                {
                                                    jQuery(".reward-list").addClass("show");
                                                }
                            
                                                <?php 
                                                if($host_name == 'wheel006.jgdx.xyz' || $host_name == 'spin2win.bet' || $host_name == 'skyworldsg-luckyspin.com' || $host_name == 'wheel001.jgdx.xyz' || $host_name == 'wheel011.jgdx.xyz' || $host_name == 'fbads996.com')
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
                                                                 //  alert(data);
                                                                //   jQuery("#user_spin_count").val("");
                                                                  // jQuery("#user_spin_count").val();
                                                                  jQuery("#total_spin_show").attr("value",success);
                                                                  
                                                                  var reward_id_hwe = jQuery("#set_random_spin_value").val();
                                                                  var reward_item = jQuery("#set_user_reward").val();
                            
                                                                    jQuery.ajax({
                                                                    type: "POST",
                                                                    url: '<?php echo Site_URL.'/send_ajax_data.php'; ?>',
                                                                    data: { 
                                                                        set_user_spin_result : 'set_user_spin_result',
                                                                        user_id : user_id,
                                                                        admin_set_total_spin: total_spin,
                                                                        user_spin: success,
                                                                        reward_item: reward_item,
                                                                        reward_id_hwe: reward_id_hwe,
                                                                        spain_code: spain_code
                                                                        
                                                                    },
                                                                    success:function(result)
                                                                    {
                                                                       jQuery(".reward-list .items").html("");
                                                                       jQuery(".reward-list .items").html(result);
                                                                       
                                                                       jQuery('.reward-list').css('transform', 'scale(1)');
                                                                    
                                                                    }
                            
                                                                  });
                                                                
                                                                }
                                                            });
                            
                                                
                            
                                                // Spin complete animation and receive reward
                                                console.log(data);
                            
                                                // Save reward into reward bag
                                                saveReward(data);
                            
                                                
                            
                                            });
                                        }
                                        
                                        
                                    }
                                });
                     <?php }
                     else
                     {
                     ?>
                     
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
                        if($host_name == 'wheel006.jgdx.xyz' || $host_name == 'spin2win.bet' || $host_name == 'skyworldsg-luckyspin.com' || $host_name == 'wheel001.jgdx.xyz' || $host_name == 'wheel011.jgdx.xyz' || $host_name == 'fbads996.com')
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
                       if(check_sound == 1)
                       {
                           setTimeout(function () {
                           if(_dynamicParams.config.allowSound) {
                                    var spinSound = document.getElementById('spinSound');
                                        spinSound.play().catch(function() {
                                    });
                            }
                           },2000);
                       }
                        
        
                        spin(function(data) {
                            
                            var get_show_popup = '<?php echo $background['reward-popup-config']; ?>';
                            if(get_show_popup == 1)
                            {
                                jQuery(".reward-list").addClass("show");
                            }
        
                            <?php 
                            if($host_name == 'wheel006.jgdx.xyz' || $host_name == 'spin2win.bet' || $host_name == 'skyworldsg-luckyspin.com' || $host_name == 'wheel001.jgdx.xyz' || $host_name == 'wheel011.jgdx.xyz' || $host_name == 'fbads996.com')
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
                                             //  alert(data);
                                            //   jQuery("#user_spin_count").val("");
                                              // jQuery("#user_spin_count").val();
                                              jQuery("#total_spin_show").attr("value",success);
                                              
                                              var reward_id_hwe = jQuery("#set_random_spin_value").val();
                                              var reward_item = jQuery("#set_user_reward").val();
        
                                                jQuery.ajax({
                                                type: "POST",
                                                url: '<?php echo Site_URL.'/send_ajax_data.php'; ?>',
                                                data: { 
                                                    set_user_spin_result : 'set_user_spin_result',
                                                    user_id : user_id,
                                                    admin_set_total_spin: total_spin,
                                                    user_spin: success,
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
                                            
                                            }
                                        });
        
                            
        
                            // Spin complete animation and receive reward
                            console.log(data);
        
                            // Save reward into reward bag
                            saveReward(data);
        
                        });
                    <?php }?>

            }

        });

        // Redeem listener
        document.addEventListener('onRedeemCompleted', function(data) {

            // data.rewardValue => The reward value of user after finish spin the wheel.
            console.log(data.rewardValue);

        }, false);

        
     
    }



    /*
        Function redirect to new page
    */
    function redirectAffiliateLink() {

        try {
            var currentReward = document.getElementById('drawing').getAttribute('value');
            var currentAffiliateLink = _dynamicParams.jsonData[currentReward].link;;

            if (typeof(currentAffiliateLink) !== 'undefined') {
                window.open(currentAffiliateLink, '_blank');
            }

        } catch (ex) {}
    }

    /*
        Function to validate email and send email
    */
    function validateEmail(elm, value) {
        var re = /^(([^<>()\[\]\.,;:\s@\"]+(\.[^<>()\[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()\.,;\s@\"]+\.{0,1})+[^<>()\.,;:\s@\"]{2,})$/;
        if (re.test(value)) {
            document.querySelector('.btn-send-email').classList.remove('inactive');
        } else {
            document.querySelector('.btn-send-email').classList.add('inactive');
        }
    }

    /*
        Function to handle email popup show / hide
    */
    function showPopupEmail() {
        document.querySelector('#popup-customer-email').classList.remove('hide');
        setTimeout(function() { document.querySelector('#popup-customer-email .inner-content').classList.add('active'); }, 500);
    }

    /*
        Event click of send email button
    */
    if (document.querySelector('#popup-customer-email')) {
        document.querySelector('.btn-send-email').addEventListener('click', function(e) {

            if (document.querySelector('.btn-send-email').className.indexOf('inactive') === -1) {
                sendEmail();
            }

        }, false);
    }
    /***************** //CLICK AND RECEIVE REWARD EVENTS *****************/
    </script>
    <script data-type="admin">
    /* 
        Ads Banner
    */
    if (!document.querySelector('#edit-params')) {
        var swiper = new Swiper('.swiper-container', {
            effect: 'cube',
            grabCursor: true,
            cubeEffect: {
                shadow: true,
                slideShadows: true,
                shadowOffset: 20,
                shadowScale: 0.94,
            },
            speed: 1000,
            loop: true,
            autoplay: {
                delay: 5000,
            }
        });
    }
    </script>
    <style>
        .popup-overlay {
        	position: fixed;
        	z-index: 10000;
        	top: 0;
        	left: 0;
        	overflow: hidden;
        	width: 100%;
        	height: 100%;
        	opacity: .8;
        	background: #2d2d32;
        	filter: alpha(opacity=80);
        }
        .modal-dialog-centered
        {
            z-index: 10000 !important;
        }
        .modal-dialog
        {
            margin:auto !important;
            position: relative;
            width: auto;
        }
        .modal
        {
            top: 25% !important;
            /*position : absolute !important;*/
            position: fixed;
            right: 0;
            bottom: 0;
            left: 0;
            z-index: 1050;
            display: none;
            overflow: hidden;
            -webkit-overflow-scrolling: touch;
            outline: 0;
        
        }
        .modal-open .modal {
          overflow-x: hidden;
          overflow-y: auto;
        }
        
        .modal-content {
        	position: relative;
        	background-color: #fff;
        	background-clip: padding-box;
        	border: 1px solid rgba(0,0,0,.2);
        	border-radius: 6px;
        	-webkit-box-shadow: 0 3px 9px rgba(0,0,0,.5);
        	box-shadow: 0 3px 9px rgba(0,0,0,.5);
        	outline: 0;
        }
        
        .modal-header {
        	padding: 15px;
        	border-bottom: 1px solid #e5e5e5;
        }
        
        .modal-body {
        	position: relative;
        	padding: 15px;
        }
        
        .text-center {
        	text-align: center;
        }
        
        .h4{
        	margin-top: 10px;
        	margin-bottom: 10px;
        }
        
        .form-group {
        	margin-bottom: 15px;
        }
        
        .row {
        	margin-right: -15px;
        	margin-left: -15px;
        }
        
        .form-control
        {
            display: block;
            height: 34px;
            /*padding: 6px 12px;*/
            font-size: 14px;
            line-height: 1.42857143;
            color: #555;
            background-color: #fff;
            background-image: none;
            -webkit-box-shadow: inset 0 1px 1px rgba(0,0,0,.075);
            box-shadow: inset 0 1px 1px rgba(0,0,0,.075);
            -webkit-transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s;
            -o-transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s;
            -webkit-transition: border-color ease-in-out .15s,-webkit-box-shadow ease-in-out .15s;
            transition: border-color ease-in-out .15s,-webkit-box-shadow ease-in-out .15s;
            transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s;
            transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s,-webkit-box-shadow ease-in-out .15s;
        }
        @media only screen and (min-width:768px)
        {
            .modal-dialog {
            	width: 600px !important;
            	margin: 30px auto;
            }
            .modal-content {
              -webkit-box-shadow: 0 5px 15px rgba(0,0,0,.5) !important;
              box-shadow: 0 5px 15px rgba(0,0,0,.5) !important;
            }
            .col-sm-4 {
                width: 33.33333333% !important;
            }
            .col-sm-6 {
              width: 50% !important;
              padding-right: 15px !important;
              padding-left: 15px !important;
            }
        }
        .modal_footer
        {
            justify-content: center;
            display: flex;
            background: linear-gradient(40deg, #45cafc, #303f9f);
            color: #ffffff;
            padding: 15px;
            text-align: right;
            border-top: 1px solid #e5e5e5;
        }
        .design_password
        {
            border-radius: 5px;
            border: 2px solid #45cafc;
        }
        .login_form_style
        {
            text-align: right;padding: 20px;color: #ef8318;
        }
        .btn-block {
        	display: block;
        	width: 100%;
        }
        .btn-info {
        	color: #fff;
        	background-color: #5bc0de;
        	border-color: #46b8da;
        }
        .btn {
        	display: inline-block;
        	margin-bottom: 0;
        	font-weight: 400;
        	text-align: center;
        	white-space: nowrap;
        	vertical-align: middle;
        	-ms-touch-action: manipulation;
        	touch-action: manipulation;
        	cursor: pointer;
        	background-image: none;
        	border: 1px solid transparent;
        	padding: 6px 12px;
        	font-size: 14px;
        	line-height: 1.42857143;
        	border-radius: 4px;
        	-webkit-user-select: none;
        	-moz-user-select: none;
        	-ms-user-select: none;
        	user-select: none;
        }
        @media only screen and (max-width:590px)
        {
            .show_in_center_mobile
            {
                justify-content: center;
            }
            .custom_add_margin_user
            {
                margin-left: 16px;
            }
        }
        .show_in_center_mobile
        {
            display: flex;
        }
        #popup-customer-email .inactive 
        {
            pointer-events: none;
        }
    
        .custom_login_button_user
        {
            position: absolute;
            top: 20px;
            font-size: 32px;
            color: #fff;
       
            cursor:pointer;
            text-align: left;
        }
        
        @media only screen and (max-width:767px)
        {
            .custom_login_button_user
            {
             
                text-align: left !important;
                
            }
      
        }
        #save_user_login
        {
            background-image: linear-gradient(to right, #f5ce62, #e43603, #fa7199, #e85a19);
            box-shadow: 0 4px 15px 0 rgba(229, 66, 10, 0.75);
            text-transform: uppercase;
            width: 120px;
            font-size: 16px;
            font-weight: 600;
            color: #fff;
            cursor: pointer;
            margin: 5px;
            height: 55px;
            text-align: center;
            border: none;
            background-size: 300% 100%;
            border-radius: 50px;
        }
        
    </style>
</body>

</html>