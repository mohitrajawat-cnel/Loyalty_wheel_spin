<?php
if(isset($_REQUEST['ifreame']) && $_REQUEST['ifreame'] == '1')
{ 
    ini_set('session.cookie_samesite', 'None');
    ini_set('session.cookie_secure', 1);
}
session_start();
include 'admin_panel/pages/config.php';

if($game_type == 2)
{
    include 'plinko_index.php';

}
else
{

    header("Expires:".gmdate("D, d M Y H:i:s")." GMT");
    header("Cache-Control: no-cache");
    header("Pragma: no-cache");


    // 10 mins in seconds
    if(isset($_SESSION['timeout_hwe']))
    {
        $inactive = 600;

        $session_life = time() - $_SESSION['timeout_hwe'];
        
        if($session_life > $inactive) {
        session_destroy();
        header("Location: user_logout.php");
        }
        
        
    }
    $_SESSION['timeout_hwe']=time();

    // if(isset($_REQUEST['ifreame']) && $_REQUEST['ifreame'] == '1')
    // {
    //     if(isset($_POST['user_id_hidden']) && $_POST['user_id_hidden'] != '')
    //     {
    //         $_SESSION['user_id'] = $_POST['user_id_hidden'];
    //setcookie("TestCookie", $value);
    //     }
        
    // }
    ?>
    <script src="customn_library/jquery_file.js"></script>

    <?php
    if($user_login_register_method == 1)
    {
        include 'user_login_register_method.php';
    }
    else
    {

        $error='';
        if(isset($_POST['save_user_login']))
        {
                $login_email =	$_POST['user_email'];
                $login_password=$_POST['user_password'];
            
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
                                jQuery("#loginModal").attr("style","display:none;");

                            

                            // window.location.href = "<?php echo Front_URL.$ifreame_url; ?>";
                                
                        });
                    </script>

                    <?php  
            
                }
            
        }

        

        //start maintenance mode code
        $selectaintenance ="SELECT * from ".$table_prefix."wheel_data";
        $rowmaintenance = $conn->query($selectaintenance);
        $resultmaintenance = mysqli_fetch_assoc($rowmaintenance);

        //$site_logo_hwe = $result['site_logo_hwe'];


        $maintenance_data =  json_decode($resultmaintenance['spin_data'],true);

        if(isset($maintenance_data['maintenance_mode']) && $maintenance_data['maintenance_mode'] == '1')
        {

            $username='';
            if(isset($_SESSION['user_id']))
            {
                $selectaintenance_user_data ="SELECT * from ".$table_prefix."user_table where id='".$_SESSION['user_id']."'";
                $rowmaintenance_user_data = $conn->query($selectaintenance_user_data);
                $resultmaintenance_userdata = mysqli_fetch_assoc($rowmaintenance_user_data);
            
                
                $username = $resultmaintenance_userdata['username'];
            }

            if((!isset($_REQUEST['keyhwe']) && $username != 'userr1' ))
            {
                ?>
                    <script>
                            window.location.href = '<?php echo Front_URL; ?>/maintainance_mode.php';
                    </script>
                <?php
            }
        

        }
            
        if(isset($_SESSION['user_id']))
        {
            $id1=$_SESSION['user_id'];


            $sql="select * from ".$table_prefix."user_table where id='$id1'";
            $result=mysqli_query($conn,$sql);
            if($result){
            while($row=mysqli_fetch_assoc($result))
            {
                
            $usernew=$row['username'];
            $remspin=$row['user_total_spin'];
            
            
            }
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

        if(isset($_REQUEST['ifreame']))
        {
            $ifreame = $_REQUEST['ifreame'];

        }



        $user_id_session = '';
        if($code_sp == '1' || $mobile_number_sp == '1' || $code_with_remain_spin_sp == '1' || $email_method== '1' || $name_email_mobileno == '1' || $normal_spin_method == '1' || $user_username_mobile_method == '1')
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

        if(isset($_POST['submit_form_redeem_user']))
        {
            if(!isset($_SESSION['user_id']))
            {
            
                $login_email =	$_POST['user_email'];
                $login_password=$_POST['user_password'];
                $login_confirm_password=$_POST['user_confirm_password'];

                if($login_password == $login_confirm_password)
                {

                    $UUID = substr(str_shuffle("0123456789"), 0, 9);
                
                    $select="select * from ".$table_prefix."user_table where username='$login_email' and password='$login_password'";
                
                    $query1=mysqli_query($conn,$select);
                    $result =mysqli_fetch_assoc($query1);

                    if(mysqli_num_rows($query1)==0)
                    {
                        $insert_share_redeem = "INSERT into ".$table_prefix."user_table SET username='$login_email',
                        password='$login_password',
                        user_total_spin='0',
                        UUID='$UUID'
                        ";

                        if(mysqli_query($conn,$insert_share_redeem))
                        {
                            if(isset($_REQUEST['ref']) && $_REQUEST['ref'] != '')
                            {
                                $refferal_id = base64_decode($_REQUEST['ref']);
                                $user_re_point=0;
                                $select5="select * from ".$table_prefix."user_table where id='".$refferal_id."'";
                    
                                $query15=mysqli_query($conn,$select5);
                                $result5 =mysqli_fetch_assoc($query15);

                                if(mysqli_num_rows($query15) > 0)
                                {
                                
                                        $select_share_point_hwe = "SELECT * from ".$table_prefix."user_redeem_share_points";
                                        $row_share_points_hwe = $conn->query($select_share_point_hwe);

                                        $user_share_points=0;
                                        if(mysqli_num_rows($row_share_points_hwe) > 0)
                                        {
                                            while($result_share_point = mysqli_fetch_assoc($row_share_points_hwe))
                                            {
                                            
                                                $user_share_points = $result_share_point['user_share_point'];
                                            }
                                        }

                                        $user_re_point = $result5['user_redeem_point'];
                                        $user_redeem_point = $user_re_point + $user_share_points;
                                        $update_user = "UPDATE ".$table_prefix."user_table SET user_redeem_point='$user_redeem_point' where id='".$refferal_id."'
                                        ";
                            
                                        mysqli_query($conn,$update_user);
                                    

                                    ?>
                                        <script>
                                                window.location.href = '<?php echo Front_URL; ?>';
                                        </script>
                                    <?php
                                }
                            }   
                        
                        }
                
                    }
                    else
                    {
                        
                        ?>
                        
                        <script>
            
                            alert("Email or Password already exist.");
                        </script>

                        <?php  
                
                    }
                }
                else
                {
                    
                    ?>
                    
                    <script>

                        alert("Password And Confirm Password Doesn't Match.");
                    </script>

                    <?php  
            
                }

            }
            else
            {
                ?>
                    
                <script>

                    alert("Already login.");
                </script>

                <?php  
            }
           
        }
        ?>
        <!DOCTYPE html>
        <html>
        <head>
            <meta charset="UTF-8" />
            <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" />
            <title><?php echo $site_title_hwe; ?></title>
            <meta name="description" content="" data-type="admin" />
            <meta name="keywords" content="" data-type="admin" />
            <meta name="author" content="Gafami">
            <meta property="fb:app_id" content="1701132369920968" data-type="admin" />
            <meta property="og:url" content="" data-type="admin" />
            <meta property="og:type" content="Website" data-type="admin" />
            <meta property="og:title" content="<?php echo $site_title_hwe; ?>" data-type="admin" />
            <meta property="og:description" content="<?php echo $site_description; ?>" data-type="admin" />
            <meta property="og:image" content="" data-type="admin" />
            <?php echo $header_script_tag; ?>
            
            <link rel='stylesheet' href='css/spectrum.min.css' data-type="admin" />
            <!--<link rel="stylesheet" href="css/swiper.min.css" data-type="admin" id="swiper-style">-->
            <link rel="stylesheet" href="css/global.css" />
            <link rel="stylesheet" href="css/admin.css" data-type="admin" />
            <link rel="icon" href="img/brand.png" type="image/png">

            <link rel="stylesheet" href="customn_library/font_awasom_all.css">
        
            <link rel="stylesheet" href="customn_library/bootstrap.min.css">
            <script src="customn_library/bootstrap.bundle.min.js"></script>

            <!-- <script src="customn_library/bootstrap.bundle.min.js"> -->


            
            
        </head>
        <style>
        @media only screen and (min-width:768px)
        {
        /* #viewBox
        {
            height:800px !important;
        } */
        }
        @media only screen and (min-width:768px) and (max-width:1199px)
        {
        #viewBox
        {
            max-width:100% !important;
            width:100% !important;
            position: absolute !important;
            left: 0;
            right: 0;
            top: 0;
            bottom:0;
            margin-top:0px !important;
        }
        #drawing
        {
            position: absolute !important;
            left: 0;
            right: 0;
            top: 0%;
            bottom: 0;
            margin-top:0px !important;
        }
        #viewBox
        {
            height:100% !important;
        }
        }
        </style>
        <script>
        jQuery(document).ready(function(){


        // jQuery(document).click("show_shareable_links",function(){
        //     jQuery("#shares_icons_show").show();
        //     jQuery("#shares_icons_show").attr("style","display:block;");
        // });


            var get_full_url = document.domain;
        
            setInterval(function() {

                    var get_website_url = '<?php echo Front_URL; ?>';
                    jQuery.ajax({
                    type: "POST",
                    url: get_website_url+"/admin_panel/pages/send_ajax_data.php",
                    data: { 
                        randomresultshow: 'randomresultshow'
                    
                    },
                    success:function(datafg)
                    {
                        var second_layout_check = '<?php echo $second_layout_sp; ?>';
                    //var get_site_host_name2 ='<?php echo $host_name; ?>';
                    if(second_layout_check   == '1')
                    {
                            jQuery(".content__container__list").html(datafg);
                    }
                    else
                    {    
                        
                            jQuery(".reward-list-all .items").html("");
                            jQuery(".reward-list-all .items").html(datafg);
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

        $select ="SELECT * from ".$table_prefix."wheel_data";
        $row = $conn->query($select);
        $result = mysqli_fetch_assoc($row);

        //$site_logo_hwe = $result['site_logo_hwe'];


        $background =  json_decode($result['spin_data'],true);
        $site_logo_hwe = $background['site_logo_hwe'];
        $bg_color = $background['bg_color'];

        $redeem_button_hide_show =$background['redeem_button_hide_show'];

        $background_walpaper ='';


        $sound_config =$background['sound-config'];

        $live_chat_menu_url = $background['live_chat_menu_url'];

        if(isset($background['slice']))
        {
            $total_slices_hwe =$background['slice'];
        }
        else
        {
        $total_slices_hwe = 5;
        }


        $wallpaper_config =$background['wallpaper-config'];
        $live_wallpaper_img_mobile='';
        $live_wallpaper_img='';
        if(isset($background['live_wallpaper_img']) && $background['live_wallpaper_img'] != '')
        {
            $live_wallpaper_img =$background['live_wallpaper_img'];

        }
        //$live_wallpaper_img_mobile =  $background['live_wallpaper_img_mobile_size'];

        $reward_list_bg_upload='';
        $reward_icon_change='';
        $reamin_spin_text_color='red';
        if(isset($background['reward_list_bg_upload']))
        {
            $reward_list_bg_upload =$background['reward_list_bg_upload'];
        }
        if(isset($background['reward_icon_change']))
        {
            $reward_icon_change =$background['reward_icon_change'];
        }
        if(isset($background['reamin_spin_text_color']))
        {
            $reamin_spin_text_color =$background['reamin_spin_text_color'];
        }

        $live_wallpaper_img_mobile='';
        if(isset($background['live_wallpaper_img']) && $background['live_wallpaper_img'] != '')
        {
            $live_wallpaper_img_mobile = $background['live_wallpaper_img'];
        }
        if(isset($background['live_wallpaper_img_mobile_size']) && $background['live_wallpaper_img_mobile_size'] !='')
        {
            $live_wallpaper_img_mobile = $background['live_wallpaper_img_mobile_size'];
        }
        $register_now_link ='';
        $register_now='0';
        $register_now_text='';
        if(isset($background['register_now']))
        {
            $register_now =$background['register_now'];
        }
        if(isset($background['register_now_link']))
        {
            $register_now_link =$background['register_now_link'];
        }

        if(isset($background['register_now_text']))
        {
            $register_now_text =$background['register_now_text'];
        }


        $wheel_ux_config =$background['wheel-ux-config'];

        $total_spin_show_admin=0;
        if(isset($background['total_spin_show']) && $background['total_spin_show'] >= 0)
        {
            $total_spin_show_admin = $background['total_spin_show'];
        }


        $coundown_popup_config = $background['coundown-popup-config'];

        $no_matter_probability=0;
        if(isset($background['no_matter_probability'])){
            $no_matter_probability = $background['no_matter_probability'];
        }



        $slider_banner = $background['slider_banner'];

        $normal_spin_check=0;
        if(isset($background['normal_spin_check']))
        {
            $normal_spin_check = $background['normal_spin_check'];
        }



        $reward_list_effect = $background['reward_list_effect'];



        if($coundown_popup_config == 1)
        {
            $coundown_popup_config_selected = 'selected';
        }
        else
        {
            $coundown_popup_config_selected = '';
        }



        $wheel_border_olor ='';
        if(isset($background['wheel_border_color_set']) && $background['wheel_border_color_set'] == '1' && isset($background['wheel_border_olor']))
        {

            $wheel_border_olor = $background['wheel_border_olor'];
        }

        $wheel_button_border_olor ='';
        if(isset($background['wheel_border_button_color_set']) && $background['wheel_border_button_color_set'] == '1' && isset($background['wheel_button_border_olor']))
        {

            $wheel_button_border_olor = $background['wheel_button_border_olor'];
        }

        $user_id = $user_id_session;

        // $user_id_current_login='';
        // if(isset($user_id_session) && $user_id_session !='')
        // {
        //     $user_id_current_login = $user_id;
        // }

        ////spin_data images label
        $total_slices = $background['slice'];
        
        $images_slice_data =array();
        for($i =0; $i <$total_slices; $i++ )
        {
            if(isset($background['no_matter_labal_image_hideshow'.$i]))
            {
                $images_slice_data[$i] = $background['no_matter_labal_image_hideshow'.$i];
            }
            else
            {
                $images_slice_data[$i] =0;
            }
            
        }

        $no_matter_labal_image_hideshow = json_encode($images_slice_data);

        ////spin_data images label
        $labels_slice_data =array();

        $slice_color_set=array();
        $slice_color_set_array_checkbox=array();
        $slice_color_set_hwe='';
        $slice_color_set_array_checkbox_hwe='';

        $slice_text_color_set=array();
        $slice_text_color_set_array_checkbox=array();

        $slice_text_color_set_hwe='';
        $slice_text_color_set_array_checkbox_hwe='';

        $text_images_together= array();
        for($i =0; $i <$total_slices; $i++ )
        {
            // $labels_slice_data[$i] = $background['prize'.$i];
            $labels_slice_data[$i] = str_replace('<br />','',urldecode($background['prize'.$i]));
            $slice_color_set[$i] = $background['slice_color_'.$i];

            if(isset($background['slice_color_checkbox_'.$i]))
            {
                $slice_color_set_array_checkbox[$i] = $background['slice_color_checkbox_'.$i];
            }
            else
            {
                $slice_color_set_array_checkbox[$i] = 0;
            }

            $slice_text_color_set[$i] = $background['slice_text_color_'.$i];
            if(isset($background['slice_text_color_checkbox_'.$i]))
            {
                $slice_text_color_set_array_checkbox[$i] = $background['slice_text_color_checkbox_'.$i];
            }
            else
            {
                $slice_text_color_set_array_checkbox[$i] = 0;
            }
            
        
            
            if(isset($background['text_images_together'.$i]))
            {
                $text_images_together[$i] = $background['text_images_together'.$i];
            }
            else
            {
                $text_images_together[$i] = 0;
            }
            

        }
        $get_labels_value_wheel_hwe = json_encode($labels_slice_data);
        $slice_color_set_hwe = json_encode($slice_color_set);
        $slice_color_set_array_checkbox_hwe = json_encode($slice_color_set_array_checkbox);

        $slice_text_color_set_hwe = json_encode($slice_text_color_set);
        $slice_text_color_set_array_checkbox_hwe = json_encode($slice_text_color_set_array_checkbox);

        $text_images_together_hwe = json_encode($text_images_together);

        $total_spin_user_set_admin=0;
        $total_spin_user_hwe='';
     
            $user_total_spin_select ="SELECT * from ".$table_prefix."user_table where `id`='".$user_id."'";
            $user_total_spin_row = $conn->query($user_total_spin_select);

            while($user_total_spin_result = mysqli_fetch_assoc($user_total_spin_row))
            {
                
                $total_spin_user_hwe = $user_total_spin_result['user_spinned'];

                
                if($user_total_spin_result['user_total_spin'] != '' && $user_total_spin_result['user_total_spin'] > 0)
                {
                    $total_spin_user_set_admin = $user_total_spin_result['user_total_spin'];
                }
                
            }
        
        

        if($reward_list_bg_upload == '')
        {

        }
        else
        {


        ?>
        <style>
        .reward-list .items{

                background: url('<?php echo 'admin_panel/pages/'.$reward_list_bg_upload; ?>') no-repeat !important;
                background-size: 100% 100% !important;
            }

            .lucky_number_popup_latest .items{

                background: url('<?php echo 'admin_panel/pages/'.$reward_list_bg_upload; ?>') no-repeat !important;
                background-size: 100% 100% !important;
            }

            .lucky_number_popup .items{

                background: url('<?php echo 'admin_panel/pages/'.$reward_list_bg_upload; ?>') no-repeat !important;
                background-size: 100% 100% !important;
            }
        </style>

        <?php
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

                setTimeout(function(){
                    
                    var get_total_slice_hwe = '<?php echo $total_slices_hwe;  ?>';
            //          if(get_total_slice_hwe == '12')
            //           {
            //              jQuery("#drawing g:nth-child(2) g:nth-child(3)").attr('transform','matrix(6.123234262925839e-17,1,-1,6.123234262925839e-17,765.6737060546875,-40.581390380859375)');
            //          }
            //          else if(get_total_slice_hwe == '5')
            //          {
            //              jQuery("#drawing g:nth-child(2) g:nth-child(3)").attr('transform','matrix(0.30901700258255005,0.9510565400123596,-0.9510565400123596,0.30901700258255005,597.2919921875,-114.30839538574219)');
            //          }
            //           else if(get_total_slice_hwe == '8')
            //          {
            //               jQuery("#drawing g:nth-child(2) g:nth-child(3)").attr('transform','matrix(0.12186934053897858,0.9925461411476135,-0.9925461411476135,0.12186934053897858,700.7461547851562,-50.4896469116211)');
                        
            //          }
            //mohit
                    //  var host_name_hwe3 = '<?php echo $host_name; ?>';
                    //  if(host_name_hwe3 == 'spin2win88.com')
                    //  {

                    //  }
                    //  else
                    //  {
                    //     if(get_total_slice_hwe == '10')
                    //     {
                    //         jQuery("#drawing g:nth-child(2) g:nth-child(3)").attr('transform','matrix(0.0523359552025795,0.9986295104026794,-0.9986295104026794,0.0523359552025795,765.541259765625,-20.0826151371002197)');
                            
                    //     }
                    //  }
                    
            //           else if(get_total_slice_hwe == '36')
            //           {
            //              jQuery("#drawing g:nth-child(2) g:nth-child(3)").attr('transform','matrix(6.123234262925839e-17,1,-1,6.123234262925839e-17,753.6567993164062,-02.85595703125)');
            //              jQuery("#drawing g:nth-child(2) g:nth-child(3) g:nth-child(1)").attr('title','mohit');
                        
            //          }
                
                
                },1000);
                
                jQuery("#drawing").attr("style","display:none;");
                jQuery("#rotate_image_hide").attr("style","display:block;z-index: 9999999;position: absolute;top: 45%;width: 150px;");
            
                setTimeout(function(){
                    jQuery("#drawing").attr("style","display:block;");
                    jQuery("#rotate_image_hide").attr("style","display:none;z-index: 9999999;position: absolute;top: 45%;width: 150px;");
            
                },3000);
                    //methods
                    var site_host_name = '<?php echo $host_name; ?>';
                    var code_login_function = '<?php echo $code_with_remain_spin_sp; ?>';
                    var code_function = '<?php echo $code_sp; ?>';
                    var normal_spin_method = '<?php echo $normal_spin_method; ?>';

                    var user_username_mobile_method = '<?php echo $user_username_mobile_method; ?>';
                    
                    var code_mobile_function = '<?php echo $mobile_number_sp; ?>';
                    var user_email_method = '<?php echo $email_method; ?>';
                    var user_n_e_mob_method = '<?php echo $name_email_mobileno; ?>';
                    var first_layout_check_hwe = '<?php echo $first_layout_sp; ?>';
                    var fourth_layout_check_hwe = '<?php echo $fourth_layout_sp; ?>';
                    var reward_icon_change = '<?php echo $reward_icon_change; ?>';
                    if(code_login_function == '1' || code_function == '1' || code_mobile_function == '1' || user_email_method == '1' || user_n_e_mob_method == '1'  || normal_spin_method == '1')
                    {
                    
                    }
                    else
                    {
                        var burgerMenu = document.querySelector('.burger-menu');
                                burgerMenu.addEventListener('click', function(event) {
                        
                                    // burgerMenu.children[0].classList.toggle('active');
                                    // burgerMenu.children[0].classList.toggle('cross');
                                    // burgerMenu.children[1].classList.toggle('active');
                                    // burgerMenu.children[1].classList.toggle('cross');
                                    // burgerMenu.children[2].classList.toggle('hide');
                        
                                    // // Show or hide reward list
                                    
                                    jQuery('.burger-menu').css("opacity","0");
                                    jQuery('.reward_icon_list').css("opacity","0");
                                    jQuery('.custom_hide_icon').css("opacity","1");

                                    jQuery(".custom_hide_icon").css("z-index","999999");

                                    jQuery('.reward-list').addClass("show");
                                    jQuery('.reward-list').css("visibility","visible");
                                    jQuery('.reward-list').css("transform","scale(1)");    
                                    // document.querySelector('.reward-list').classList.toggle('show');
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

            <input type="hidden" id="code_function" value='<?php echo $code_sp; ?>' />
            <input type="hidden" id="code_login_function" value='<?php echo $code_with_remain_spin_sp; ?>' />
            <input type="hidden" id="code_mobile_function" value='<?php echo $mobile_number_sp; ?>' />
            <input type="hidden" id="sms_function" value='<?php echo $sms_function; ?>' />
            <input type="hidden" id="mobile_num_otp" value='<?php echo $mobile_num_otp; ?>' />

            <input type="hidden" id="user_login_function" value='<?php echo $user_login_sp; ?>' />

            <input type="hidden" id="email_method_hwe" value='<?php echo $email_method; ?>' />
            <input type="hidden" id="name_email_mobileno_hwe" value='<?php echo $name_email_mobileno; ?>' />

            <input type="hidden" id="user_login_register_function" value='<?php echo $user_login_register_function; ?>' />

            <input type="hidden" id="user_username_mobile_method" value='<?php echo $user_username_mobile_method; ?>' />
            <input type="hidden" id="normal_spin_method" value='<?php echo $normal_spin_method; ?>' />
            

            <input type="hidden" id="image_labal_hide_show_data" value='<?php echo $no_matter_labal_image_hideshow; ?>' />
            <input type="hidden" id="get_labels_value_wheel_hwe" value='<?php echo $get_labels_value_wheel_hwe; ?>' />

            <input type="hidden" id="total_wheel_slices" value='<?php echo $total_slices; ?>' />
            <input type="hidden" id="slice_color_set" value='<?php echo $slice_color_set_hwe; ?>' />
            <input type="hidden" id="slice_color_set_array_checkbox" value='<?php echo $slice_color_set_array_checkbox_hwe; ?>' />

            <input type="hidden" id="slice_text_color_set" value='<?php echo $slice_text_color_set_hwe; ?>' />
            <input type="hidden" id="slice_text_color_set_array_checkbox" value='<?php echo $slice_text_color_set_array_checkbox_hwe; ?>' />

            <input type="hidden" id="wheel_border_olor" value='<?php echo $wheel_border_olor; ?>' />
            <input type="hidden" id="wheel_button_border_olor" value='<?php echo $wheel_button_border_olor; ?>' />

            <input type="hidden" id="text_images_together_hwe" value='<?php echo $text_images_together_hwe; ?>' />

            <!-- <input type="hidden" id="user_id_current_login" value='<?php echo $user_id_current_login; ?>' /> -->
            

            <input type="hidden" id="get_reward_list_data_hwe"/>
            <input type="hidden" id="get_reward_list_lucky_nuumber"/>
            <input type="hidden" id="get_reward_list_latest_reward"/>
            <input type="hidden" id="status_reward_list"/>

        
            <input type="hidden" id="session_set_user_id"/>

            
            
            
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
            
            <?php
            $spain_code_hwe='';
            if(isset($_SESSION['spain_code']))
            {
                $spain_code_hwe = $_SESSION['spain_code'];
            }


            
            ?>
            <input type="hidden" id="spain_code_hwe" value="<?php echo $spain_code_hwe; ?>">

            
            <!-- BACKGROUND ANIMATION RENDER HERE -->
            <?php

            if($redeem_button_hide_show == '1')
            {
                
                ?>
                <style>
                .btn-redeem
                {
                    display:none !important;
                }
                </style>
                <?php
            }

            if($second_layout_sp == '1' || $fourth_layout_sp == '1')
            {
                if($wallpaper_config == 9)
                {
                    ?>

                <style>
                    @media only screen and (min-width:768px)
                    {
                        #particles-js
                        {
                            background-image: url('<?php echo 'admin_panel/pages/'.$live_wallpaper_img; ?>') !important;
                            height:100vh;
                            position:fixed !important;
                        }
                    }

                    @media only screen and (max-width:767px)
                    {
                        #particles-js
                        {
                            background-image: url('<?php echo 'admin_panel/pages/'.$live_wallpaper_img_mobile; ?>') !important;
                            height:100vh;
                            position:fixed !important;
                        }
                    }
                </style>

                    
                    <?php

                    $live_wallpaper_bg = 'background-image: url('.$live_wallpaper_img.') !important;';
                }
            }
            ?>

            
            <div id="particles-js" class="happy-new-year" style="<?php echo $live_wallpaper_bg; ?>">
                

        </div>


            <!-- THIS ELEMENT TO BE USED TO DRAW LUCKY WHEEL -->
            <div class="container" style="justify-content: center;display: flex;">
                    <img id="rotate_image_hide" src="img/rotate_gif.gif" style="display:none;z-index: 9999999;position: absolute;top: 45%;width: 150px;">
            </div>
            <div id="drawing" style="display:none;">

            </div>

            <?php 
            // if($host_name == 'wheel006.jgdx.xyz')
            // {

            // }
            // else
            // { 

            
            if($second_layout_sp == '1')
            {
                include 'front_second_layout.php';
            }
            else if($fourth_layout_sp == '1')
            {
                include 'front_fourth_layout.php';
            }
            else
            {
                include 'front_first_layout.php';
            }

            //}
                
            ?>
        

            

            <?php

            include 'reward_list_user_method.php';
            
            ?>
            
            
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
                                        <button id="close_user_login_popup" type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="form-title text-center">
                                        <h4></h4>
                                        </div>
                                        <div class="d-flex flex-column text-center">
                                        <?php
                                            if($share_referrel == '1' && (isset($_REQUEST['ref']) && $_REQUEST['ref'] !=''))
                                            {
                                            ?>
                                                <style>
                                                @media only screen and (max-width:590px)
                                                {
                                                    .custom_add_margin_user
                                                    {
                                                        margin-left: 0px !important;
                                                        padding-left: 0px !important;
                                                    }
                                                    .custom_mob_confirm_pass
                                                    {
                                                        padding-left: 0px !important;
                                                    }
                                                    .custom_mob_confirm_pass1
                                                    {
                                                        padding: 15px !important;
                                                    }
                                                    #user_confirm_password
                                                    {
                                                        margin-left:0px !important;
                                                    }
                                                }
                                                </style>
                                                <div class="form-group" id="mobile_number_enter_box">
                                                    <div class="row show_in_center_mobile" style="display: flex;">
                                                        <div class="col-sm-4" style="text-align: right;padding: 20px;color: #ef8318;">
                                                            <label>Enter Email</label>
                                                        </div>
                                                        <div class="col-sm-6 custom_add_margin_user" style="display:flex;">
                                                            <input type="email" name="user_email" class="form-control design_password" id="user_email" placeholder="Enter your Email" required>
                                                        </div>
                                                    
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="row show_in_center_mobile" style="display: flex;">
                                                        <div class="col-sm-4" style="text-align: right;padding: 20px;color: #ef8318;">
                                                                <label>Password</label>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <input type="password" name="user_password" class="form-control design_password" id="user_password" placeholder="Enter your password" required>
                                                        </div>
                                                    </div>
                                            
                                                </div>
                                                <div class="form-group">
                                                    <div class="row show_in_center_mobile" style="display: flex;">
                                                        <div class="col-sm-4 custom_mob_confirm_pass1" style="text-align: right;padding: 20px;color: #ef8318;">
                                                                <label>Confirm Password</label>
                                                        </div>
                                                        <div class="col-sm-6 custom_mob_confirm_pass">
                                                            <input type="password" name="user_confirm_password" class="form-control design_password" id="user_confirm_password" placeholder="Enter Confirm password">
                                                        </div>
                                                    </div>
                                            
                                                </div>
                                               
                                            <?php
                                            }
                                            else
                                            {
                                            ?>
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
                                            <?php
                                            }
                                            if($register_now == '1' && $user_login_sp == '1')
                                            {

                                            ?>
                                                <div class="form-group">
                                                    <div class="row show_in_center_mobile" style="display: flex;justify-content: center;">
                                                        <a href="<?php echo $register_now_link; ?>"><?php echo $register_now_text; ?></a>
                                                    </div>
                                                
                                                </div>
                                            <?php
                                            }
                                            ?>

                                            <div class="erroe_msg"><?php echo $error; ?></div>
                                            
                                        
                                    
                                    </div>
                                    </div>
                                    <div class="modal-footer d-flex justify-content-center modal_footer">
                                                <?php
                                                if($share_referrel == '1' && (isset($_REQUEST['ref']) && $_REQUEST['ref'] !=''))
                                                {
                                                    ?>
                                                        <button type="submit" id="submit_form_redeem_user" name="submit_form_redeem_user" class="btn btn-info btn-block btn-round">Sign Up</button>
                                                    <?php
                                                }
                                                else
                                                {
                                                ?>
                                                    <button type="submit" id="save_user_login" name="save_user_login" class="btn btn-info btn-block btn-round">Sign In</button>
                                                <?php
                                                }
                                                ?>
                                    </div>

                                </form>
                        </div>
                    </div>
                </div>
                <?php
                if($code_sp == '1' || $mobile_number_sp == '1' || $code_with_remain_spin_sp == '1' || $email_method== '1' || $name_email_mobileno == '1'  || $normal_spin_method == '1' || $user_username_mobile_method == '1')
                {
                    
                    include 'use_code_or_mobile_method.php';
                    if(!isset($user_spin_code))
                    {
                        $user_spin_code='';
                    }
                }

                
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
                <?php
                if($bg_music == '1' && !empty($bg_music_name))
                {
                    $music_sound = $bg_music_name;
                }
                else
                {
                    $music_sound = 'spinSound.mp3';
                }
                // if($host_name == 'edbet321spins.com')
                // {
                //     $music_sound = 'edbet-background-music.mp3';
            
                // }
                // else
                // {
                //     $music_sound = 'spinSound.mp3';
                // }

                ?>
                <input type="hidden" id="get_bg_music" value="<?php echo $music_sound; ?>">
                <audio id="spinSound" controls style="display:none;">
                    <source src="<?php echo Front_URL.'/super_admin_panel/pages/media/'.$music_sound; ?>" type="audio/mp3">
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
                                                'graphicOption' => 1,
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

                <?php
                $current_time_hwe = date("Y-m-d h:i:s");
                $current_time_hwe_strtotime = strtotime($current_time_hwe);

                if($host_name == 'dailyspin88.com')
                {
                    $js_file_url = 'js/layout_hwe.js?v='.$current_time_hwe_strtotime;
                }
                else
                {
                    $js_file_url = 'js/layout.js?v='.$current_time_hwe_strtotime;
                }
                
                
                

                ?>

                <!-- CONFIG NEEDED PARAMS GENEREATE FROMN ADMIN PAGE TO OPERATE THE WHEEL AS: TOTAL SLICE, GRAPHIC, REWARD VALUES -->
                <script id="config" defer></script>
                <script id="smtp" src="js/smtp.js" data-type="admin" defer></script>
                <script src="js/svg.min.js" defer></script>
                <script src="<?php echo $js_file_url; ?>" defer></script>
            
                <script src='js/spectrum.min.js' data-type="admin" defer></script>
                <script src="js/jszip.min.js" data-type="admin" defer></script>
                <script src="js/jszip-utils.min.js" data-type="admin" defer></script>
                <script src="js/filesaver.js" data-type="admin" defer></script>
                <script src="js/params.js" data-type="admin" defer></script>
                <script id="particles-lib" src="js/particles.min.js" defer></script>
                <script id="anims" src="js/animations.js" defer></script>
                <script>
                    var get_reamin_spin_code1_hwe =0;
                </script>
                <script>
                    var spain_code1_hwe = 0;
                </script>
               <script>
                  var spain_code1_hwe_hwedsfsd = 0;
              </script>
                <script>
                    /***************** CLICK AND RECEIVE REWARD EVENTS *****************/

                    jQuery(document).ready(function(){

                        jQuery("#close_user_login_popup").click(function(){

                            jQuery("#loginModal").removeClass("in");
                            jQuery("#loginModal").attr("style","display:none;");

                        });

                    });

                    function loadEvents() {

                        // Load reward
                        //loadRewardBag();
                    
                        _globalVars.elms.spin.on('click',function() {

                            var total_spin = jQuery("#total_spin_show").val();

                            var user_spin = jQuery("#user_spin_count").val();

                            if(user_spin == '')
                            {
                                user_spin = 0;
                            }
                        

                            if (!_globalVars.isProcessing) {

                                    
                                
                                
                                var check_login_popup_value = jQuery("#get_current_login_id").val();
                                
                    
                                <?php 
                                //check code is valid
                                    if($code_sp == '1' || $mobile_number_sp == '1' || $code_with_remain_spin_sp == '1' || $email_method== '1' || $name_email_mobileno == '1' || $user_username_mobile_method == '1')
                                    {
                                        
                                    ?>
                                
                                        var spain_code_hwe = jQuery('#spain_code_hwe').val();
                                        var mobile_numberotp = '<?php echo $mobile_number_sp; ?>';
                                        if(spain_code_hwe == '' || mobile_numberotp == '1')
                                        {
                                            jQuery("#code_enter_Modal").removeClass("fade");
                                            jQuery("#code_enter_Modal").addClass("fade in");
                                            jQuery("#code_enter_Modal").show();

                                            jQuery("#code_enter_Modal").attr("style","display:block;");
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
                                            
                                                            <?php 
                                                            if($code_sp == '1' || $mobile_number_sp == '1' || $code_with_remain_spin_sp == '1' || $email_method== '1' || $name_email_mobileno == '1' || $user_username_mobile_method == '1')
                                                            {
                                                            }
                                                            else
                                                            {
                                                            ?>
                                                                if(parseInt(total_spin) <= parseInt(0))
                                                                {
                                                                    alert("You have no spin left.");
                                                                    return false;
                                                                }
                                                            <?php 
                                                            } ?>

                                                                <?php 
                                                                if($code_sp == '1' || $mobile_number_sp == '1' || $code_with_remain_spin_sp == '1' || $email_method== '1' || $name_email_mobileno == '1' || $user_username_mobile_method == '1')
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
                                                            
                                            
                                                            spin(function(data) {
                                                                
                                                                var get_show_popup = '<?php echo $background['reward-popup-config']; ?>';
                                                                
                                            
                                                                <?php 
                                                                if($code_sp == '1' || $mobile_number_sp == '1' || $code_with_remain_spin_sp == '1' || $email_method== '1' || $name_email_mobileno == '1' || $user_username_mobile_method == '1')
                                                                {
                                                                    ?>
                                            
                                                                    
                                                                    var user_id = 1;
                                                                    
                                                                <?php } 
                                                                else
                                                                { ?>
                                                                    var user_id = '<?php echo $user_id_session; ?>';
                                                                    <?php 

                                                                }
                                                                if(isset($_SESSION['spain_code']))
                                                                {

                                                                
                                                                ?>     
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
                                                                                    
                                                                                    jQuery('.reward-list').css('transform', 'scale(1)');
                                                                                    
                                                                                    }
                                            
                                                                                });
                                                                <?php
                                                                }
                                                                ?>
                                                                                
                                                                                //}
                                                                            //});
                                            
                                                                if(get_show_popup == 1)
                                                                {
                                                                    jQuery(".reward-list").addClass("show");
                                                                }
                                            
                                                                // Spin complete animation and receive reward
                                                                console.log(data);
                                            
                                                                // Save reward into reward bag
                                                                saveReward(data);
                                            
                                                                
                                            
                                                            });
                                                        }
                                                        
                                                        
                                                    }
                                                });
                                    <?php
                                    }
                                    elseif($normal_spin_method == '1')
                                    {

                                    ?>
                                        


                                            var total_spin = jQuery("#total_spin_show").val();
                                            var user_spin = jQuery("#user_spin_count").val();

                                            if(user_spin == '')
                                            {
                                                user_spin = 0;
                                            }


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
                                            

                                            spin(function(data) {
                                                
                                                var get_show_popup = '<?php echo $background['reward-popup-config']; ?>';

                                                var get_show_popup = '<?php echo $background['reward-popup-config']; ?>';
                                
                
                                                    
                                                    var user_id = 1;
                                                    
                                                
                                                    var spain_code = 0;
                                                
                                                            var reward_id_hwe = jQuery("#set_random_spin_value").val();
                                                            var reward_item = jQuery("#set_user_reward").val();
                                                            var get_spin_total_hwe = jQuery("#total_spin_show").val();
                                                            
                                                            var total_spin = jQuery("#total_spin_show").val();
                                                            var get_reamin_spin_code=0;

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

                                                                jQuery('.custom_hide_icon').css('opacity', '1');
                                                                jQuery('.custom_hide_icon').css('z-index', '1050');

                                                                
                                                            }

                                                        
                                                    });
                                                        
                                                    
                                    
                                                if(get_show_popup == 1)
                                                {
                                                    jQuery(".reward-list").addClass("show");
                                                }
                                        
                                                
                                                
                                                if(get_show_popup == 1)
                                                {
                                                    jQuery('.reward-list').css('transform', 'scale(1)');
                                                    jQuery('.reward-list').css('visibility', 'visible');

                                                    jQuery('.custom_hide_icon').css('opacity', '1');
                                                    jQuery('.custom_hide_icon').css('z-index', '1050');
                                                    jQuery(".reward-list").addClass("show");
                                                }

                                                // Spin complete animation and receive reward
                                                console.log(data);

                                                // Save reward into reward bag
                                                saveReward(data);

                                                

                                            });
                                    <?php
                                    }
                                    else
                                    {
                                    ?>
                                    
                                        var total_spin = jQuery("#total_spin_show").val();

                                        var user_spin = jQuery("#user_spin_count").val();
                                        
                                        var check_login_popup_value = jQuery("#get_current_login_id").val();
                                        
                                        if(check_login_popup_value == 0 || check_login_popup_value == '')
                                        {

                                            jQuery("#loginModal").removeClass("fade");
                                            jQuery("#loginModal").addClass("fade in");
                                            jQuery("#loginModal").show();
                                            return false;
                                            
                                        }
                                        else
                                        {
                                            jQuery("#loginModal").removeClass("in");
                                            jQuery("#loginModal").hide();
                                        }
                                    

                                        
                                    
                        
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
                                    

                                        // jQuery.ajax({
                                        //             type: "POST",
                                        //             url: '<?php echo Site_URL.'/send_ajax_data.php'; ?>',
                                        //             data: { 
                                        //                 set_user_spin : 'set_user_spin',
                                        //                 user_id : user_id,
                                        //                 admin_set_total_spin: total_spin,
                                        //                 user_spin: user_spin
                                                    
                                                        
                                        //             },
                                        //             success:function(success)
                                        //             {
                                                
                                        //                 jQuery("#total_spin_show").attr("value",success);
                                                    
                                                    
                                                    
                                                        
                                        //             }
                                        // });

                                        
                                        spin(function(data) {

                                    
                                            
                                            var get_show_popup = '<?php echo $background['reward-popup-config']; ?>';

                                        
                                            var get_reward_list_lucky_nuumber = jQuery("#get_reward_list_lucky_nuumber").val();
                                            var get_reward_list_lucky_nuumber = jQuery("#get_reward_list_lucky_nuumber").attr("value");

                                            var get_reward_list_latest_reward = jQuery("#get_reward_list_latest_reward").val();
                                            var get_reward_list_latest_reward = jQuery("#get_reward_list_latest_reward").attr("value");

                                            var reward_list_status = jQuery("#status_reward_list").val();
                                            var reward_list_status = jQuery("#status_reward_list").attr("value");

                                            var result_list = jQuery("#get_reward_list_data_hwe").val();
                                            var result_list = jQuery("#get_reward_list_data_hwe").attr("value");

                                            
                                            var satus =reward_list_status;
                                            var lucky_number_set =get_reward_list_lucky_nuumber;

                                            
                                                                    
                                                if(satus == 1)
                                                {
                                                    
                                                    
                                                    // jQuery(".reward-list .items").html("");
                                                    // jQuery(".reward-list .items").html('<span class="lucky_number_style" style="margin-top: 50%;">'+lucky_number_set+'<span>');
                                                    // jQuery(".reward-list .items").css("color","#fff");
                                                    // jQuery(".reward-list .items").css("font-size","42px");
                                                    // jQuery(".reward-list .items").css("justify-content","center");
                                                    // jQuery(".reward-list .items").css("display","block");

                                                    jQuery(".lucky_number_popup .items").html("");
                                                    jQuery(".lucky_number_popup .items").html('<span class="lucky_number_style" style="position: absolute;top: 50%;left: 0;right: 0;bottom: 0;text-align: center;">'+lucky_number_set+'<span>');
                                                    jQuery(".lucky_number_popup .items").css("color","#fff");
                                                    jQuery(".lucky_number_popup .items").css("font-size","42px");
                                                    jQuery(".lucky_number_popup .items").css("justify-content","center");
                                                    jQuery(".lucky_number_popup .items").css("display","block");
                                                    

                                                    jQuery('.lucky_number_popup').css('transform', 'scale(1)');
                                                    jQuery('.lucky_number_popup').css('visibility', 'visible');

                                                    jQuery('.custom_hide_icon').css('opacity', '1');
                                                    jQuery('.custom_hide_icon').css('z-index', '999999');
                                                    


                                                    
                                                }
                                                else
                                                {
                                                //  jQuery(".lucky_number_popup_latest .items").html(get_reward_list_latest_reward);

                                                    jQuery('.lucky_number_popup_latest').css('transform', 'scale(1)');
                                                    jQuery('.lucky_number_popup_latest').css('visibility', 'visible');
                                                    
                                                    // jQuery(".reward-list .items").html("");
                                                    // jQuery(".reward-list .items").html(result_list);

                                                    jQuery('.reward-list').css('transform', 'scale(0)');
                                                    jQuery('.reward-list').css('visibility', 'hidden');

                                                    
                                                

                                                    jQuery('.custom_hide_icon').css('opacity', '1');
                                                    jQuery('.custom_hide_icon').css('z-index', '999999');
                                                }
                                                                        
                                            
                        
                                                if(get_show_popup == 1)
                                                {
                                                    //jQuery(".reward-list").addClass("show");
                                                }
                        
                                            // Spin complete animation and receive reward
                                            console.log(data);
                        
                                            // Save reward into reward bag
                                            saveReward(data);
                        
                                        });

                                    <?php 
                                    }
                                    ?>

                            }

                        });

                        // Redeem listener
                        document.addEventListener('onRedeemCompleted', function(data) {

                            // data.rewardValue => The reward value of user after finish spin the wheel.
                            console.log(data.rewardValue);

                        }, false);

                    }
            
                    // }

                    function isiPhone(){
                        return (
                            (navigator.platform.indexOf("iPhone") != -1) ||
                            (navigator.platform.indexOf("iPod") != -1)
                        );
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
                        setTimeout(function() { 
                
                        document.querySelector('#popup-customer-email .inner-content').classList.add('active'); }, 500);
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
                <?php
                include 'style_for_modal_box.php';
                ?>
        </body>

        </html>
<?php
    }


    if(($user_login_register_method == '1' || $user_login_sp == '1') && $reset_time_login_method == '1')
    {
        ?>
            <script>
                setInterval(function() {

                   
                                 
                            jQuery.ajax({
                            type: "POST",
                            url: '<?php echo Site_URL.'/send_ajax_data.php'; ?>',
                            data: { 
                                reset_timer_set : 'reset_timer_set'
                            
                            },
                            success:function(success)
                            {
                        
                            }
                            });
                                
                    
                }, 60000);
            </script>
        <?php
    }
}
?>