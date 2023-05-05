<?php
session_start();
include 'admin_panel/pages/config.php';

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

                        //window.location = "<?php echo Front_URL.$ifreame_url; ?>";
                        
                });
            </script>

            <?php  
       
        }
    
}


$id1=$_SESSION['user_id'];


$sql="select * from ".$table_prefix."user_table where id='$id1'";
$result=mysqli_query($conn,$sql);
if($result){
while($row=mysqli_fetch_assoc($result))
{
    
$usernew=$row['username'];
$remspin=$row['user_total_spin'];

}
if($remspin>9)
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
    <script src="customn_library/jquery_file.js"></script>
    <link rel="stylesheet" href="customn_library/font_awasom_all.css">
  
  <link rel="stylesheet" href="customn_library/bootstrap.min.css">
  <script src="customn_library/bootstrap.bundle.min.js"></script>
   
</head>


<script>
    jQuery(document).ready(function(){
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
    });

</script>
<!-- style for winners list  -->


<!-- end style for winners list -->

<style>
    .reward-list
    {
        z-index: 10;
    }
    @media only screen and (min-width: 768px)
    {
        .custom_login_button_user
        {
            left: 42px;
            top: 0px !important;
        }
    }
    #popup-customer-email .inactive 
    {
        pointer-events: none;
    }

    .custom_login_button_user
    {
        /* position: absolute;
        top: 6px; */
        font-size: 32px;
        color: #fff;
        cursor:pointer;
        text-align: left;
        margin-left: 42px;
    }
    .custom_login_button_user img
    {
        width :240px !important;
    }
    

    .burger-menu
    {
        right: 20px !important;
        top: 20px !important;
    }
    @media only screen and (max-width:767px)
    {
        .custom_login_button_user
        {
         
            text-align: left !important;
            /* position: absolute;
            top: 18px; */
            font-size: 32px;
            color: #fff;
            right: 6px;
            cursor:pointer;
            margin-left: 35px !important;
            margin-top: 16px;
            
            
        }
        .custom_login_button_user img
        {
            width :120px !important;
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
    .modal_footer
    {
        justify-content: center;
        display: flex;
        background: linear-gradient(40deg, #45cafc, #303f9f);
        color: #ffffff;
    }
    .design_password
    {
        border-radius: 5px;
        border: 2px solid #45cafc;
    }
</style>
<?php

$select ="SELECT * from ".$table_prefix."wheel_data";
$row = $conn->query($select);
$result = mysqli_fetch_assoc($row);

$site_logo_hwe = $result['site_logo_hwe'];

$background =  json_decode($result['spin_data'],true);

$site_logo_hwe = $background['site_logo_hwe'];

$bg_color = $background['bg_color'];

$live_chat_menu_url = $background['live_chat_menu_url'];

$background_walpaper ='';


$sound_config =$background['sound-config'];

$wallpaper_config =$background['wallpaper-config'];
$live_wallpaper_img =$background['live_wallpaper_img'];

$wheel_ux_config =$background['wheel-ux-config'];

$total_spin_show_admin = $background['total_spin_show'];

$coundown_popup_config = $background['coundown-popup-config'];

$no_matter_probability = $background['no_matter_probability'];

$slider_banner = $background['slider_banner'];

$normal_spin_check = $background['normal_spin_check'];



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


$user_total_spin_select ="SELECT * from ".$table_prefix."user_table where `id`='".$user_id."'";
$user_total_spin_row = $conn->query($user_total_spin_select);

while($user_total_spin_result = mysqli_fetch_assoc($user_total_spin_row))
{
    $total_spin_user_hwe='';
    $total_spin_user_hwe = $user_total_spin_result['user_spinned'];

    $total_spin_user_set_admin='';
    $total_spin_user_set_admin = $user_total_spin_result['user_total_spin'];
    $UUID = $user_total_spin_result['UUID'];
}
        

?>


<body style="background: #000;">
    <input type="hidden" id="image_labal_hide_show_data" value='<?php echo $no_matter_labal_image_hideshow; ?>' />
    <input type="hidden" id="get_labels_value_wheel_hwe" value='<?php echo $get_labels_value_wheel_hwe; ?>' />
    
    <input type="hidden" id="user_spin_code_hwe" value="<?php echo $user_spin_code; ?>" />
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



    <!-- THIS ELEMENT TO BE USED TO DRAW LUCKY WHEEL -->
 <style>
.sum {
	background: #222;
	color: #f5ce62;
	display: inline-block;
	padding: 10px;
	text-align: center;
	width: 100%;
	border-bottom-left-radius: 5px;
	border-bottom-right-radius: 5px;
	margin-bottom: 30px;
	-webkit-box-sizing: border-box;
	box-sizing: border-box;
	border: 5px solid;
	border-image-source: linear-gradient(45deg, #f5ce62, #45cafc);
	border-image-slice: 1;
	-webkit-box-shadow: 0 0 15px #f5ce62;
	box-shadow: 0 0 15px #f5ce62;
} 
 @media only screen and (max-width:767px) {
.sum {
	background: #222;
	color: #f5ce62;
	display: inline-block;
	padding: 10px;
	text-align: center;
	width: 99% !important;
	border-bottom-left-radius: 5px;
	border-bottom-right-radius: 5px;
	margin-bottom: 5px;
	-webkit-box-sizing: border-box;
	box-sizing: border-box;
	border: 5px solid;
	border-image-source: linear-gradient(45deg, #f5ce62, #45cafc);
	border-image-slice: 1;
	-webkit-box-shadow: 0 0 15px #f5ce62;
	box-shadow: 0 0 15px #f5ce62;
}
 }
.sum .name {
	font-size: 16px;
	display: inline-block;
	margin-bottom: 10px;
}

.sum .value {
	font-size: 24px;
	font-weight: 600;
}
.reward-list-all {
	position: absolute;
	right: 10px;
	top: 180px;
	-webkit-transform: translate(0%, 0%);
	-ms-transform: translate(0%, 0%);
	transform: translate(0%, 0%);
	width: 280px;
	color: #fff;
	-webkit-transition: all 0.5s;
	-o-transition: all 0.5s;
	transition: all 0.5s;
}

@media only screen and (max-width:767px){
    .reward-list-all {
	position: absolute;
    left: 6%;
    /* top: 577px; */
    top: 775px;
	-webkit-transform: translate(0%, 0%);
	-ms-transform: translate(0%, 0%);
	transform: translate(0%, 0%);
	width: 88% !important;
	color: #fff;
	-webkit-transition: all 0.5s;
	-o-transition: all 0.5s;
	transition: all 0.5s;
   
    padding-bottom: 73px;
}

    #viewBox
    {
        height: 100% !important;
    }
}

.reward-list-all .block-header {
	background-image: -webkit-linear-gradient(50deg, #ffa000, #ffa000);
	background-image: -o-linear-gradient(50deg, #ffa000, #ffa000);
	background-image: linear-gradient(40deg, #ffa000, #ffa000);
	padding: 20px;
	border-top-left-radius: 5px;
	border-top-right-radius: 5px;
    text-align: center;
    font-weight:bold;
    font-size: 20px;
}
.reward-list-all .items {
	background: rgba(0, 0, 0, 0.6);
	border-bottom-left-radius: 5px;
	border-bottom-right-radius: 5px;
	-webkit-box-shadow: 0 0 15px #222;
	box-shadow: 0 0 15px #222;
    text-align: left;
}
.reward-list-all .item {
	position: relative;
	border-bottom: 1px solid #ddd;
	-webkit-box-sizing: border-box;
	box-sizing: border-box;
	padding: 10px;
	margin: 0 8px;
}

.reward-list-all .item .icon {
	background-image: url(../img/icon.svg);
	background-size: cover;
	background-repeat: no-repeat;
	width: 15px;
	height: 15px;
}
.reward-list-all .item .player-name {
	white-space: nowrap;
	margin-left: 5px;
    font-size:18px;
    font-weight: bold;
}

.reward-list-all .item .reward-value {
	background: red;
	padding: 8px;
	border-radius: 5px;
	position: absolute;
	right: 5px;
	top: 50%;
	-webkit-transform: translateY(-50%);
	-ms-transform: translateY(-50%);
	transform: translateY(-50%);
	width: auto;
	min-width: 40px;
	text-align: right;
}

@media only screen and (max-width:767px)
{
    .custon_banner_show
    {
        position: absolute;
        width: 100%;
        max-width: 600px;
        background-image: -webkit-linear-gradient(50deg, #ffa000, #ffa000);
        background-image: -o-linear-gradient(50deg, #ffa000, #ffa000);
        background-image: linear-gradient(40deg, #ffa000, #ffa000);
       
        left: 50%;
        -webkit-transform: translateX(-50%);
        -ms-transform: translateX(-50%);
        transform: translateX(-50%);
        -webkit-box-shadow: 0 0 15px #222;
        box-shadow: 0 0 15px #222;
        text-align: center;
        color: #fff;
        border-top-left-radius: 5px;
        border-top-right-radius: 5px;
        z-index: 99;
        
    
    }

}
@media only screen and (min-width:768px)
{

    .custon_banner_show
    {
        bottom: 0px !important;
        /* position:absolute !important; */
        position: inherit !important;
        top:100%;
    }
    .burger-menu
    {
        right: 50px !important;
        top: 28px !important;
    }
}
.custon_banner_show
{
    position:fixed;
    bottom: 61px;
    background-image: none !important;
}

.custon_banner_show .footer-text {
	padding: 10px;
    font-size:129%;
    padding-top: 23px;
}

.logout {
	position: absolute;
	right: 10px;
	top: 50%;
	-webkit-transform: translateY(-50%);
	-ms-transform: translateY(-50%);
	transform: translateY(-50%);
	text-decoration: underline;
	cursor: pointer;
}
.footer_ul
{
    display: flex;
}
.footer_ul li
{
    font-size: 13px;
    color: #000;
    padding: 7px;
}
.menu_site
{
    height: 38px;
    
}
.img_set
{
    margin-top: -12px;
}

.remaining-spin-times {
	position: absolute;
	left: 10px;
	top: 40%;
	background: rgba(0, 0, 0, 0.6);
	-webkit-transform: translateY(-50%);
	-ms-transform: translateY(-50%);
	transform: translateY(-50%);
	width: 160px;
	height: 160px;
	color: #fff;
	border-radius: 5px;
	padding: 5px;
	white-space: nowrap;
	-webkit-box-shadow: 0 0 15px #222;
	box-shadow: 0 0 15px #222;
}
@media only screen and (max-width:767px)
{
    .remaining-spin-times {
	position: absolute;
    left: 33%;
    /* top: 498px; */
    top: 50%;
	background: rgba(0, 0, 0, 0.6);
	-webkit-transform: translateY(-50%);
	-ms-transform: translateY(-50%);
	transform: translateY(-50%);
	width: 139px;
	height: 125px;
	color: #fff;
	border-radius: 5px;
	padding: 5px;
	white-space: nowrap;
	-webkit-box-shadow: 0 0 15px #222;
	box-shadow: 0 0 15px #222;
    
}

}


.remaining-spin-times .block-header {
	background-image: -webkit-linear-gradient(50deg, #ffa000, #ffa000);
	background-image: -o-linear-gradient(50deg, #ffa000, #ffa000);
	background-image: linear-gradient(40deg, #ffa000, #ffa000);
	padding: 20px;
	border-top-left-radius: 5px;
	border-top-right-radius: 5px;
    font-size:90%;
}
.remaining-spin-times .box {
	width: calc(50% - 4px);
	display: inline-block;
	position: relative;
	height: calc(100% - 55px);
	text-align: center;
	border: 1px solid rgba(255, 255, 255, 0.3);
}

.remaining-spin-times .box span {
	position: absolute;
	left: 50%;
	top: 50%;
	-webkit-transform: translate(-50%, -50%);
	-ms-transform: translate(-50%, -50%);
	transform: translate(-50%, -50%);
	font-size: 30px;
	font-weight: 600;
}



.new {

    border-width:thick;
    border-style:solid;
}

@media only view and (max-width:767px){

    .new {

        border-width:thick;
        border-style:inset;
    }
    #drawing
    {
        margin-top:112px;
    }
}

#drawing
{
    margin-top:75px;
}

</style>

<?php 
    if($code_sp == '1' || $mobile_number_sp == '1' || $code_with_remain_spin_sp == '1')
    {
    }
    else
    {
    ?>
    <div class="custom_login_button_user" style="width:95%;">
         <img src="<?php echo 'admin_panel/pages/'.$site_logo_hwe; ?>" style="width: 50px;">
         <!-- <span ><a href="<?php //echo "Front_URL"; ?>/user_logout.php" id="user_login_button" style="color: #fff;">Logout</a></span> -->
    </div>


    <!-- BURGER MENU -->
    <div class="burger-menu">
        <span class="active"></span>
        <span class="active"></span>
        <span class="active"></span>
        <div class="counter">...</div>
    </div>
    <!-- REWARD LIST OF PLAYER -->
    
    <?php
    }
     ?>
    
    <?php 
    if(isset($user_id_session) && $user_id_session != '')
    {

        $sql_hwe="select * from ".$table_prefix."user_table where id='".$user_id_session."'";
        $result_hwe=mysqli_query($conn,$sql_hwe);
        if($result_hwe){
            while($row_hwe=mysqli_fetch_assoc($result_hwe))
            {
                
                $username_hwe1=$row_hwe['username'];
                $UUID='';
                if(isset($row_hwe['UUID']))
                {
                    $UUID=$row_hwe['UUID'];
                }
                
          
            }
        }
    ?>
        <div class="show_name_log_button">
            <div class="show_username">
                <?php echo $username_hwe1; ?>
            </div>
            <div class="show_logout_button">
                    <span >
                    <p>
                        <a href="<?php echo Front_URL; ?>/user_logout.php" class="btn btn-info btn-lg">
                        <span class="glyphicon glyphicon-log-out"></span> Log out
                        </a>
                    </p> 
                        <!-- <a href="<?php echo Front_URL; ?>/user_logout.php" id="user_login_button" style="color: #fff;">Logout</a> -->
                    </span>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-md-3 col-3" style="width: 25%;
                  font-size: 15px; padding: 10px;">
                    <div>ID: <?php echo $username_hwe1; ?></div>
                    <div>Password: <?php echo $userpassword_hwe1; ?></div>
                    <div>Remaining Spin: <?php echo $rem1.$rem2; ?></div>
                    <div>UUID: <?php echo $UUID; ?></div>
                </div>
                <div class="col-md-9 col-9" style="font-size: 12px;" id="size_on_mobile">
                <table class="table-responsive" id="myTable" >
    <?php
        }
    ?>



<div style="text-align:center;position: absolute;top: 50%;width: 100%;color: #fff;font-size: 20px;">

        <div >Remain Spin</div>
        <div ><?echo $rem1.''.$rem2;?></div>
</div>
<div style="text-align:center;position: absolute;top: 60%;width: 100%;color: #fff;font-size: 17px;">

        <div >UUID : <?php echo $UUID; ?></div>
        
</div>
<!-- <div class="remaining-spin-times">
        <div class="block-header">Remaining Spin</div>
        <div class="l box"><span><?echo $rem1;?></span></div>
        <div class="r box"><span><?echo $rem2;?></span></div>
</div> -->
<?php
include 'site_front_menu.php';
?>
<style>
        .add_banner
        {
            width:100%;
        }
    </style>



<style>
.btn-lg
{
    padding: 5px 7px !important;
    font-size: 18px;
    line-height: 1.3333333;
    border-radius: 6px;
}
.btn-info {
	color: #fff;
	background-color: #5bc0de;
	border-color: #46b8da;
}
.show_username
{
    font-size: 32px;
    color: #cf440f;
    cursor: pointer;
    text-align:left;
    margin-left:35px;
    float:left;
    font-weight: bold;
}
.show_logout_button
{
    
    font-size: 32px;
    color: #fff;

    cursor:pointer;
    text-align: right;
    margin-right:10px;
}
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
</style>

        
 
 

    <!-- CONFIG NEEDED PARAMS GENEREATE FROMN ADMIN PAGE TO OPERATE THE WHEEL AS: TOTAL SLICE, GRAPHIC, REWARD VALUES -->

 
</body>

</html>