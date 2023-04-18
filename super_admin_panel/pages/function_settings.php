<?php
session_start();
include 'config.php';

if(!isset($_SESSION['admin_user_id']))
{
?>
	<script>
    window.location.href='<?php echo Site_URL; ?>/login.php';
    </script>
<?php
}


$id=$_REQUEST['id'];

$update_msg='';
$alert_class='';
if(isset($_POST['update_function_setting']))
{
    $db_name        =   $_POST['db_name'];
    $db_user        =   $_POST['db_user'];
    $db_password        =   $_POST['db_password'];
    $status_hwe        =   $_POST['status_hwe'];

    $code_hwe        =   $_POST['code_hwe'];
	  $code_with_remain_spin       =   $_POST['code_with_remain_spin'];
	  $mobile_number           =   $_POST['mobile_number'];
	  $user_login        =   $_POST['user_login'];

    $email_method           =   $_POST['email_method'];
	  $name_email_mobileno       =   $_POST['name_email_mobileno'];

    $phone_password_with_otp_method          =   $_POST['phone_password_with_otp_method'];
	  $pnone_email_password_with_otp       =   $_POST['pnone_email_password_with_otp'];

    $reset_time_login_method          =   $_POST['reset_time_login_method'];
	  $reward_point_login_method       =   $_POST['reward_point_login_method'];



	  $first_layout  =   $_POST['first_layout'];
	  $second_layout =$_POST['second_layout'];
    $third_layout =$_POST['third_layout'];	 
    $fourth_layout =$_POST['fourth_layout'];	
    
    $set_text_for_code_method  = $_POST['set_text_for_code_method'];

    

    $sms_function        =   $_POST['sms_function'];
	  $firebase_key  =   $_POST['firebase_key'];
	  $firebase_password =$_POST['firebase_password'];
    $share_content_text =$_POST['share_content_text'];
    $share_content_title =$_POST['share_content_title'];
    $share_content_Url =$_POST['share_content_Url'];

    $sms_function_text1 =$_POST['sms_function_text1'];	
    $sms_function_text2 =$_POST['sms_function_text2'];

    $combine_plinko_lucky_wheel =$_POST['combine_plinko_lucky_wheel'];
    
    
    $admin_redeem_button_enable       =   $_POST['admin_redeem_button_enable'];

    $lucky_number_option =$_POST['lucky_number_option'];
    
    $mobile_num_otp_hwe =$_POST['mobile_num_otp'];	

    $share_referrel =$_POST['share_referrel'];

    $bg_music =$_POST['bg_music'];
    
    $user_login_sms_function =$_POST['user_login_sms_function'];

    $normal_spin_method = $_POST['normal_spin_method'];

    $user_login_register_method = $_POST['user_login_register_method'];

    $user_username_mobile_function = $_POST['user_username_mobile_function'];

    $user_usmob_method_username_label = $_POST['user_usmob_method_username_label'];
    $user_usmob_method_mobile_number_label = $_POST['user_usmob_method_mobile_number_label'];
    $user_usmob_method_username_placeholder = $_POST['user_usmob_method_username_placeholder'];
    $user_usmob_method_mobile_number_placeholder = $_POST['user_usmob_method_mobile_number_placeholder'];

    $site_title_hwe = $_POST['site_title_hwe'];

    $site_description = $_POST['site_description'];
    $header_script_tag = htmlentities($_POST['header_script_tag']);

    $number_patern_for_all_mob_method = htmlentities($_POST['number_patern_for_all_mob_method']);

    
    $invisible_slice_method = $_POST['invisible_slice_method'];


    $bg_music_query='';
  
    if($_FILES['upload_bg_music']['name'] && $_FILES['upload_bg_music']['name'] !='')
    {
      $upload_music =$_FILES['upload_bg_music']['name'];
      $tmp_name_music = $_FILES['upload_bg_music']['tmp_name'];

      move_uploaded_file($tmp_name_music,'media/'.$upload_music);
 

      $bg_music_query = "bg_music_name ='".$upload_music."',";
    }
    

    

    
    
      $update ="UPDATE domain_list_settings SET
       `db_name`='".$db_name."',
       db_user='".$db_user."',
       db_password='".$db_password."',
       status='".$status_hwe."',
       code='".$code_hwe."',
       code_with_remain_spin='".$code_with_remain_spin."',
       mobile_number='".$mobile_number."',
       user_login='".$user_login."',
       email_method='".$email_method."',
       name_email_mobileno='".$name_email_mobileno."',
       first_layout='".$first_layout."',
       second_layout='".$second_layout."',
       third_layout='".$third_layout."',
       fourth_layout ='".$fourth_layout."',
       sms_function='".$sms_function."',
       firebase_key='".$firebase_key."',
       firebase_password='".$firebase_password."',
       share_content_text='".$share_content_text."',
       share_content_title='".$share_content_title."',
       share_content_Url='".$share_content_Url."',
       mobile_num_otp = '".$mobile_num_otp_hwe."',
       share_referrel ='".$share_referrel."',
       ".$bg_music_query."
       bg_music ='".$bg_music."',
       user_login_sms_function ='".$user_login_sms_function."',
       sms_function_text1 = '".$sms_function_text1."',
       sms_function_text2 = '".$sms_function_text2."',
       lucky_number_option = '".$lucky_number_option."',
       admin_redeem_button_enable='".$admin_redeem_button_enable."',
       phone_password_with_otp_method='".$phone_password_with_otp_method."',
       pnone_email_password_with_otp='".$pnone_email_password_with_otp."',
       set_text_for_code_method='".$set_text_for_code_method."',
       combine_plinko_lucky_wheel='".$combine_plinko_lucky_wheel."',
       normal_spin_method='".$normal_spin_method."',
       user_login_register_method='".$user_login_register_method."',
       user_username_mobile_function='".$user_username_mobile_function."',
       user_usmob_method_username_label='".$user_usmob_method_username_label."',
       user_usmob_method_mobile_number_label='".$user_usmob_method_mobile_number_label."',
       user_usmob_method_username_placeholder='".$user_usmob_method_username_placeholder."',
       user_usmob_method_mobile_number_placeholder='".$user_usmob_method_mobile_number_placeholder."',
       reset_time_login_method='".$reset_time_login_method."',
       reward_point_login_method='".$reward_point_login_method."',
       site_title_hwe='".$site_title_hwe."',
       site_description='".$site_description."',
       header_script_tag='".$header_script_tag."',
       number_patern_for_all_mob_method='".$number_patern_for_all_mob_method."',
       invisible_slice_method='".$invisible_slice_method."'
      where id='".$id."' ";



   mysqli_query($conn,$update);


  $update_msg='Update Record Successfully';
  $alert_class="alert alert-success";
}


///////////////update game type //////////////////////

if(isset($_POST['update_game_type_setting']))
{
  

    $game_type = $_POST['game_type'];

    
    
    
    $update ="UPDATE domain_list_settings SET
       `game_type`='".$game_type."'
      where id='".$id."' ";

    mysqli_query($conn,$update);

  $update_msg='Update Record Successfully';
  $alert_class="alert alert-success";
}

///////////////end update game type //////////////////////

//////////////////////get domain list data
$select ="SELECT * from domain_list_settings where id='".$id."'";
$row =$conn->query($select);
while($result =mysqli_fetch_assoc($row))
{
   $domain_name = $result['domain_name'];
   $db_name = $result['db_name'];
   $db_user = $result['db_user'];
   $db_password = $result['db_password'];
   $status = $result['status'];
   $code_hwe = $result['code'];
   $code_with_remain_spin=$result['code_with_remain_spin'];
   $mobile_number=$result['mobile_number'];
   $user_login = $result['user_login'];

   $email_method_get           =   $result['email_method'];
   $name_email_mobileno_get      =   $result['name_email_mobileno'];

   $phone_password_with_otp_method_hwe = $result['phone_password_with_otp_method'];
   $pnone_email_password_with_otp_hwe =$result['pnone_email_password_with_otp'];

   $normal_spin_method= $result['normal_spin_method'];

   $user_login_register_method=$result['user_login_register_method'];
   $user_username_mobile_function = $result['user_username_mobile_function'];

   $user_usmob_method_username_label = $result['user_usmob_method_username_label'];
   $user_usmob_method_mobile_number_label = $result['user_usmob_method_mobile_number_label'];
   $user_usmob_method_username_placeholder = $result['user_usmob_method_username_placeholder'];
   $user_usmob_method_mobile_number_placeholder = $result['user_usmob_method_mobile_number_placeholder'];

   $reset_time_login_method = $result['reset_time_login_method'];
   $reward_point_login_method = $result['reward_point_login_method'];

   $first_layout  =   $result['first_layout'];
   $second_layout =$result['second_layout'];
   $third_layout =$result['third_layout'];
   $fourth_layout =$result['fourth_layout'];

   $sms_function = $result['sms_function'];
   $firebase_key = $result['firebase_key'];
   $firebase_password = $result['firebase_password'];
   $sms_function_text1 =$result['sms_function_text1'];
   $sms_function_text2=$result['sms_function_text2'];

   $lucky_number_option=$result['lucky_number_option'];

   $admin_redeem_button_enable = $result['admin_redeem_button_enable'];

   $mobile_num_otp = $result['mobile_num_otp'];

   $share_referrel_hwe = $result['share_referrel'];
   $share_content_text = $result['share_content_text'];
   $share_content_title = $result['share_content_title'];
   $share_content_Url = $result['share_content_Url'];

   $bg_music = $result['bg_music'];
   $user_login_sms_function = $result['user_login_sms_function'];
   $bg_music_name = $result['bg_music_name'];

   $set_text_for_code_method = $result['set_text_for_code_method'];

   $combine_plinko_lucky_wheel = $result['combine_plinko_lucky_wheel'];

   $game_type = $result['game_type'];

   $site_title_hwe= $result['site_title_hwe'];

   $site_description = $result['site_description'];
  $header_script_tag = $result['header_script_tag'];

  $number_patern_for_all_mob_method = $result['number_patern_for_all_mob_method'];

  $invisible_slice_method = $result['invisible_slice_method'];

   
}

?>
<style>
 .radio
{
  cursor:pointer;
}
</style>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="../assets/img/favicon.png">
  <title>
    Function Settings
  </title>
  <!--     Fonts and icons     -->
  <link rel="stylesheet" type="text/css"
    href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700" />
  <!-- Nucleo Icons -->
  <link href="../assets/css/nucleo-icons.css" rel="stylesheet" />
  <link href="../assets/css/nucleo-svg.css" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <!-- Material Icons -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
  <!-- CSS Files -->
  <link id="pagestyle" href="../assets/css/material-dashboard.css?v=3.0.0" rel="stylesheet" />
</head>

<style>

.form_data{
  padding: 0rem 1rem;
}

.form_data input{
  border: 1px solid #dbdbdb;
  padding-left: 5px;
}

.form_data label{
 margin-top: 1rem;
}

</style>

<body class="g-sidenav-show  bg-gray-200">
  <?php include 'header.php'; ?>
  <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
    <!-- Navbar -->
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur"
      navbar-scroll="true">
      <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
          <h6 class="font-weight-bolder mb-0">Function Settings</h6>
        </nav>
      </div>
    </nav>
    <!-- End Navbar -->
    <div class="container-fluid py-4">
      <div class="row">
        <div class="col-12">
          <div class="card my-4">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
              <div class="bg-gradient-primary shadow-primary border-radius-lg pt-2 pb-1">
                <div class="row">
                  <div class="col-md-12 pt-2">
                    <h6 class="text-white text-capitalize ps-3">Settings 
                    <a href="/super_admin_panel/pages/domains.php" style=" margin-left: 10px; background-color: black;
" class="btn btn-primary">Back</a> &nbsp;(<?php echo $domain_name; ?>)
                    </h6>
                  </div>
                </div>
              </div>
            </div>
            <div class="<?php //echo $alert_class; ?>" style="text-align:center;"><?php echo $update_msg; ?></div>
            <div class="card-body px-0 pb-2">
              <form class="form_data" method="post" enctype="multipart/form-data">
                  <div class="row" style="margin: 20px;">
                        <div class="form-group" style="padding:10px;">
                            <select id="game_type" class="form-control" name="game_type" style="width: 30%;margin-left: 35%;border: 1px solid lightgray; padding-left: 10px;" required>
                                <option value="">Please Select Game Type</option>
                                <option value="1" <?php if($game_type == 1){ echo "selected"; } ?>>Lucky Wheel</option>
                                <option value="2"<?php if($game_type == 2){ echo "selected"; } ?> >Plinko</option>
                                <option value="3"<?php if($game_type == 3){ echo "selected"; } ?> >Lucky Chest</option>
                              </select>
                              
                        </div>
                  
                        <div class="col-md-12" style="justify-content: center;display: flex;">
                          <input type="submit" value="Update Game Type" class="btn btn-primary" style="text-align:center;" name="update_game_type_setting">
                        </div>
                    </div>
                <?php
                if($game_type == 2)
                {
                  $conn_plinko = mysqli_connect('localhost', 'admin_plinko_jgdx_xyz', 'ZNdZz9QS4zlWT5yP', 'admin_plinko_jgdx_xyz');


                  if(isset($_POST['game_withCode_orNot'])) {
                    $select_plinko1 ="SELECT * from plinko_domain_table where domain_name='".$domain_name."'";
                    $row_plinko1 =$conn_plinko->query($select_plinko1);
                    while($result_plinko1 =mysqli_fetch_assoc($row_plinko1))
                    {
                      $id_plinko1 = $result_plinko1['id'];
                    }
                    if($_GET['id'] !== "0") {
                     $updateSql = "UPDATE `plinko_domain_table` SET `game_popup` = ". $_POST['code_active'] ." WHERE id = ". $id_plinko1;
                      mysqli_query($conn_plinko, $updateSql);

                    }
                  }

                  $select_plinko ="SELECT * from plinko_domain_table where domain_name='".$domain_name."'";
                  $row_plinko =$conn_plinko->query($select_plinko);
                  while($result_plinko =mysqli_fetch_assoc($row_plinko))
                  {
                  
                    $id_plinko = $result_plinko['id'];
                    $game_popup = $result_plinko['game_popup'];


                    $checked_game_with_code ='';
                    $checked_game_without_code_popup='';
                    if($game_popup == 1)
                    {
                      $checked_game_without_code_popup ='checked';
                    }
                    else
                    {
                      $checked_game_with_code ='checked';
                    }
                  }
                    

                   

                    ?>
                    <div class="row" style="margin: 20px;">
                        <div class="col-md-4">
                          <label for="game_with_code">
                            <input type="radio" name="code_active" id="game_with_code" value="0" <?php echo $checked_game_with_code; ?>>
                            Game with code popup
                          </label>
                        </div>
                        <div class="col-md-4">
                          <label for="game_without_code_popup">
                            <input type="radio" name="code_active" id="game_without_code_popup" value="1" <?php echo $checked_game_without_code_popup; ?>>
                            Game without code popup
                          </label>
                        </div>
                        <div class="col-md-4">
                          <input type="submit" value="Submit" class="btn btn-primary" name="game_withCode_orNot">
                        </div>
                    </div>
                    <?php
                }
                else
                {
                ?>
                
                <div class="row">  
                   <div class="form-group col-md-6">
                     <label><b>Site Title</b></label>
                   </div> 
                    <div class="form-group col-md-6">
                        <input type="text" name="site_title_hwe" autocomplete="off" placeholder="Enter Site Title" value="<?php echo $site_title_hwe; ?>" style="font-size: 14px; padding: 5px; width: 50%;">            
                    </div>
                </div>
                <div class="row">  
                   <div class="form-group col-md-6">
                     <label><b>Site Description</b></label>
                   </div> 
                    <div class="form-group col-md-6">
                        <input type="text" name="site_description" autocomplete="off" placeholder="Enter Site Description" value="<?php echo $site_description; ?>" style="font-size: 14px; padding: 5px; width: 50%;">            
                    </div>
                </div>
                <div class="row">  
                   <div class="form-group col-md-6">
                     <label><b>Site Header Script Tag</b></label>
                   </div> 
                    <div class="form-group col-md-6">
                      <textarea name="header_script_tag" placeholder="Enter site header script tag"><?php echo $header_script_tag; ?></textarea>
                        <!-- <input type="text" name="header_script_tag" autocomplete="off" placeholder="Enter site header script tag" value="<?php echo $header_script_tag; ?>" style="font-size: 14px; padding: 5px; width: 50%;">             -->
                    </div>
                </div>
                <div class="row">  
                   <div class="form-group col-md-6">
                     <label><b>DB Name</b></label>
                   </div> 
                    <div class="form-group col-md-6">
                        <input type="text" name="db_name" autocomplete="off" placeholder="Enter Database Name" value="<?php echo $db_name; ?>" style="font-size: 14px; padding: 5px; width: 50%;">            
                    </div>
                </div>

                <div class="row">  
                   <div class="form-group col-md-6">
                     <label><b>DB User</b></label>
                   </div> 
                    <div class="form-group col-md-6">
                        <input type="text" name="db_user" autocomplete="off" placeholder="Enter Database Name" value="<?php echo $db_user; ?>" style="font-size: 14px; padding: 5px; width: 50%;">            
                    </div>
                </div>

                <div class="row">  
                   <div class="form-group col-md-6">
                     <label><b>DB Password</b></label>
                   </div> 
                    <div class="form-group col-md-6">
                        <input type="password" name="db_password" autocomplete="off" placeholder="Enter Database Name" value="<?php echo $db_password; ?>" style="font-size: 14px; padding: 5px; width: 50%;">            
                    </div>
                </div>

                <div class="row">  
                   <div class="form-group col-md-6">
                     <label><b>Status</b></label>
                   </div> 
                    <div class="form-group col-md-6">
                        <label>Active</label>
                        <input type="radio" <?php if($status == 1){ echo "checked"; } ?> class="radio" value="1" name="status_hwe" >
            
                        <label>Deactive</label>
                        <input type="radio" <?php if($status == 0){ echo "checked"; } ?> class="radio" value="0" name="status_hwe" >
                    
                    </div>
                </div>

                <div class="row">  
                   <div class="form-group col-md-6">
                     <label><b>Code</b></label>
                   </div> 
                    <div class="form-group col-md-6">
                        <label>Active</label>
                        <input type="radio" <?php if($code_hwe == 1){ echo "checked"; } ?> class="radio" value="1" name="code_hwe" placeholder="Enter Database Password" >
            
                        <label>Deactive</label>
                        <input type="radio" <?php if($code_hwe == 0){ echo "checked"; } ?> class="radio" value="0" id="code_hwe" name="code_hwe" placeholder="Enter Database Password" >
                    
                    </div>
                </div>
                
                <div class="row">  
                   <div class="form-group col-md-6">
                     <label><b>Code with remain spin</b></label>
                   </div> 
                    <div class="form-group col-md-6">
                        <label>Active</label>
                        <input type="radio" <?php if($code_with_remain_spin== 1){ echo "checked"; } ?> class="radio" value="1" name="code_with_remain_spin" placeholder="Enter Database Password" >
            
                        <label>Deactive</label>
                        <input type="radio" <?php if($code_with_remain_spin== 0){ echo "checked"; } ?> class="radio" value="0" id="code_with_remain_spin" name="code_with_remain_spin" placeholder="Enter Database Password" >
                    
                    </div>
                </div>
                
                <div class="row">  
                   <div class="form-group col-md-6">
                     <label><b>Mobile number</b></label>
                   </div> 
                    <div class="form-group col-md-6">
                        <label>Active</label>
                        <input type="radio" <?php if($mobile_number== 1){ echo "checked"; } ?> class="radio" value="1" name="mobile_number" placeholder="Enter Database Password" >
            
                        <label>Deactive</label>
                        <input type="radio" <?php if($mobile_number== 0){ echo "checked"; } ?> class="radio" value="0"  id="mobile_number" name="mobile_number" placeholder="Enter Database Password" >
                    
                    </div>
                </div>  
                
                <div class="row">  
                   <div class="form-group col-md-6">
                     <label><b>User Login</b></label>
                   </div> 
                    <div class="form-group col-md-6">
                        <label>Active</label>
                        <input type="radio" <?php if($user_login == 1){ echo "checked"; } ?> class="radio" value="1" name="user_login" placeholder="Enter Database Password" >
            
                        <label>Deactive</label>
                        <input type="radio" <?php if($user_login == 0){ echo "checked"; } ?> class="radio" value="0" id="user_login" name="user_login" placeholder="Enter Database Password" >
                    
                    </div>
                </div>

                <div class="row">  
                   <div class="form-group col-md-6">
                     <label><b>Email Login</b></label>
                   </div> 
                    <div class="form-group col-md-6">
                        <label>Active</label>
                        <input type="radio" <?php if($email_method_get == 1){ echo "checked"; } ?> class="radio" value="1" name="email_method" placeholder="Enter Database Password" >
            
                        <label>Deactive</label>
                        <input type="radio" <?php if($email_method_get == 0){ echo "checked"; } ?> class="radio" value="0" id="email_method" name="email_method" placeholder="Enter Database Password" >
                    
                    </div>
                </div>

                <div class="row">  
                   <div class="form-group col-md-6">
                     <label><b>Name & Email & Mobile Login</b></label>
                   </div> 
                    <div class="form-group col-md-6">
                        <label>Active</label>
                        <input type="radio" <?php if($name_email_mobileno == 1){ echo "checked"; } ?> class="radio" value="1" name="name_email_mobileno" placeholder="Enter Email" >
            
                        <label>Deactive</label>
                        <input type="radio" <?php if($name_email_mobileno == 0){ echo "checked"; } ?> class="radio" value="0" id="name_email_mobileno" name="name_email_mobileno" placeholder="Enter Database Password" >
                    
                    </div>
                </div>

                <div class="row">  
                   <div class="form-group col-md-6">
                     <label><b>Mobile Number with OTP & Password Method </b></label>
                   </div> 
                    <div class="form-group col-md-6">
                        <label>Active</label>
                        <input type="radio" <?php if($phone_password_with_otp_method_hwe == 1){ echo "checked"; } ?> class="radio" value="1" name="phone_password_with_otp_method" placeholder="Enter Email" >
            
                        <label>Deactive</label>
                        <input type="radio" <?php if($phone_password_with_otp_method_hwe == 0){ echo "checked"; } ?> class="radio" value="0" id="phone_password_with_otp_method" name="phone_password_with_otp_method" placeholder="Enter Database Password" >
                    
                    </div>
                </div>

                <div class="row">  
                   <div class="form-group col-md-6">
                     <label><b>Mobile Number with OTP & Password & Email Method</b></label>
                   </div> 
                    <div class="form-group col-md-6">
                        <label>Active</label>
                        <input type="radio" <?php if($pnone_email_password_with_otp_hwe == 1){ echo "checked"; } ?> class="radio" value="1" name="pnone_email_password_with_otp" placeholder="Enter Email" >
            
                        <label>Deactive</label>
                        <input type="radio" <?php if($pnone_email_password_with_otp_hwe == 0){ echo "checked"; } ?> class="radio" value="0" id="pnone_email_password_with_otp" name="pnone_email_password_with_otp" placeholder="Enter Database Password" >
                    
                    </div>
                </div>

                <div class="row">  
                   <div class="form-group col-md-6">
                     <label><b>Normal Spin Method</b></label>
                   </div> 
                    <div class="form-group col-md-6">
                        <label>Active</label>
                        <input type="radio" <?php if($normal_spin_method == 1){ echo "checked"; } ?> class="radio" value="1" name="normal_spin_method" placeholder="Enter Email" >
            
                        <label>Deactive</label>
                        <input type="radio" <?php if($normal_spin_method == 0){ echo "checked"; } ?> class="radio" value="0" id="normal_spin_method" name="normal_spin_method" placeholder="Enter Database Password" >
                    
                    </div>
                </div>

                <div class="row">  
                   <div class="form-group col-md-6">
                     <label><b>User Login & Register Method</b></label>
                   </div> 
                    <div class="form-group col-md-6">
                        <label>Active</label>
                        <input type="radio" <?php if($user_login_register_method == 1){ echo "checked"; } ?> class="radio" value="1" name="user_login_register_method" placeholder="Enter Email" >
            
                        <label>Deactive</label>
                        <input type="radio" <?php if($user_login_register_method == 0){ echo "checked"; } ?> class="radio" value="0" id="user_login_register_method" name="user_login_register_method" placeholder="Enter Database Password" >
                    
                    </div>
                </div>

               <div class="row">  
                   <div class="form-group col-md-6">
                     <label><b>User Username & Mobile Method</b></label>
                   </div> 
                    <div class="form-group col-md-6">
                        <label>Active</label>
                        <input type="radio" <?php if($user_username_mobile_function == 1){ echo "checked"; } ?> class="radio" value="1" name="user_username_mobile_function" placeholder="Enter Email" >
            
                        <label>Deactive</label>
                        <input type="radio" <?php if($user_username_mobile_function == 0){ echo "checked"; } ?> class="radio" value="0" id="user_username_mobile_function" name="user_username_mobile_function" placeholder="Enter Database Password" >
                    
                    </div>
                </div>

                <div class="row">  
                    <div class="form-group col-md-6">
                        <label><b>Mobile Number Pattern</b></label>
                    </div> 
                    <div class="form-group col-md-6">
                      <input type="text" name="number_patern_for_all_mob_method" autocomplete="off" placeholder="Enter Pattern For all Methods" value="<?php echo $number_patern_for_all_mob_method; ?>" style="font-size: 14px; padding: 5px; width: 50%;">            
                    </div>
                </div> 

                <?php
                
                if($user_username_mobile_function == '1')
                {
                  $user_name_mobile = 'style="display:block;"';
                }
                else
                {
                  $user_name_mobile = 'style="display:none;"';
                }
                ?>
                <div id="user_name_mobile" <?php echo $user_name_mobile; ?> >
                  <div class="row">  
                    <div class="form-group col-md-6">
                        <label><b>Enter User Username Label</b></label>
                    </div> 
                    <div class="form-group col-md-6">
                      <input type="text" name="user_usmob_method_username_label" autocomplete="off" placeholder="Enter User Username Label" value="<?php echo $user_usmob_method_username_label; ?>" style="font-size: 14px; padding: 5px; width: 50%;">            
                    </div>
                  </div>
                  <div class="row">  
                    <div class="form-group col-md-6">
                        <label><b>Enter User Mobile Number Label</b></label>
                    </div> 
                    <div class="form-group col-md-6">
                      <input type="text" name="user_usmob_method_mobile_number_label" autocomplete="off" placeholder="Enter User Mobile Number Label" value="<?php echo $user_usmob_method_mobile_number_label; ?>" style="font-size: 14px; padding: 5px; width: 50%;">            
                    </div>
                  </div>  
                  <div class="row">  
                    <div class="form-group col-md-6">
                        <label><b>Enter User Username Placeholder</b></label>
                    </div> 
                    <div class="form-group col-md-6">
                      <input type="text" name="user_usmob_method_username_placeholder" autocomplete="off" placeholder="Enter User Username Placeholder" value="<?php echo $user_usmob_method_username_placeholder; ?>" style="font-size: 14px; padding: 5px; width: 50%;">            
                    </div>
                  </div> 
                  <div class="row">  
                    <div class="form-group col-md-6">
                        <label><b>Enter User Mobile Number Placeholder</b></label>
                    </div> 
                    <div class="form-group col-md-6">
                      <input type="text" name="user_usmob_method_mobile_number_placeholder" autocomplete="off" placeholder="Enter User Mobile Number Placeholder" value="<?php echo $user_usmob_method_mobile_number_placeholder; ?>" style="font-size: 14px; padding: 5px; width: 50%;">            
                    </div>
                  </div> 
                </div>
                <?php 
                $user_login_spin_method_lists= 'display:none';
                if($user_login == '1' || $user_login_register_method == '1')
                {
                    $user_login_spin_method_lists = 'display:block;';
                }
                ?>
                <div id="user_login_spin_method_lists" style="<?php echo $user_login_spin_method_lists; ?>">
                    <div class="row">  
                      <div class="form-group col-md-6">
                        <label><b>User Reset Timer</b></label>
                      </div> 
                        <div class="form-group col-md-6">

                        <label>Active</label>
                            <input type="radio" <?php if($reset_time_login_method== 1){ echo "checked";} ?> class="radio" value="1"  name="reset_time_login_method">

                            <label>Deactive</label>
                            <input type="radio" <?php if($reset_time_login_method== 0){ echo "checked"; } ?> class="radio" value="0" name="reset_time_login_method">
                        
                        </div>
                    </div> 
                    <div class="row">  
                      <div class="form-group col-md-6">
                        <label><b>User Reward Point</b></label>
                      </div> 
                        <div class="form-group col-md-6">

                        <label>Active</label>
                            <input type="radio" <?php if($reward_point_login_method== 1){ echo "checked";} ?> class="radio" value="1"  name="reward_point_login_method" >

                            <label>Deactive</label>
                            <input type="radio" <?php if($reward_point_login_method== 0){ echo "checked"; } ?> class="radio" value="0" name="reward_point_login_method">
                        
                        </div>
                    </div> 
                </div>
                <div class="row">  
                   <div class="form-group col-md-6">
                     <label><b>First layout</b></label>
                   </div> 
                    <div class="form-group col-md-6">
                        <label>Active</label>
                        <input type="radio" <?php if($first_layout == 1){ echo "checked"; } ?> class="radio" value="1" name="first_layout" placeholder="Enter Database Password" >
            
                        <label>Deactive</label>
                        <input type="radio" <?php if($first_layout == 0){ echo "checked"; } ?> class="radio" value="0"  id="first_layout" name="first_layout" placeholder="Enter Database Password" >
                    
                    </div>
                </div>
                
                <div class="row">  
                   <div class="form-group col-md-6">
                     <label><b>Second Layout</b></label>
                   </div> 
                    <div class="form-group col-md-6">
                        <label>Active</label>
                        <input type="radio" <?php if($second_layout == 1){ echo "checked"; } ?> class="radio" value="1" name="second_layout" placeholder="Enter Database Password" >
            
                        <label>Deactive</label>
                        <input type="radio" <?php if($second_layout == 0){ echo "checked"; } ?> class="radio" value="0"  id="second_layout" name="second_layout" placeholder="Enter Database Password" >
                    
                    </div>
                </div>

                <div class="row">  
                   <div class="form-group col-md-6">
                     <label><b>Third Layout</b></label>
                   </div> 
                    <div class="form-group col-md-6">
                        <label>Active</label>
                        <input type="radio" <?php if($third_layout == 1){ echo "checked"; } ?> class="radio" value="1" name="third_layout" placeholder="Enter Database Password" >
            
                        <label>Deactive</label>
                        <input type="radio" <?php if($third_layout == 0){ echo "checked"; } ?> class="radio" value="0"  id="third_layout" name="third_layout" placeholder="Enter Database Password" >
                    
                    </div>
                </div>

                <div class="row">  
                   <div class="form-group col-md-6">
                     <label><b>Fourth Layout</b></label>
                   </div> 
                    <div class="form-group col-md-6">
                        <label>Active</label>
                        <input type="radio" <?php if($fourth_layout == 1){ echo "checked"; } ?> class="radio" value="1" name="fourth_layout" placeholder="Enter Database Password" >
            
                        <label>Deactive</label>
                        <input type="radio" <?php if($fourth_layout == 0){ echo "checked"; } ?> class="radio" value="0"  id="fourth_layout" name="fourth_layout" placeholder="Enter Database Password" >
                    
                    </div>
                </div>
                
                <div class="row">  
                   <div class="form-group col-md-6">
                     <label><b>SMS Function</b></label>
                   </div> 
                    <div class="form-group col-md-6">
                        <label>Active</label>
                        <input type="radio" <?php if($sms_function == 1){ echo "checked"; } ?> class="radio sms_function" value="1" name="sms_function" placeholder="Enter Database Password" >
            
                        <label>Deactive</label>
                        <input type="radio" <?php if($sms_function == 0){ echo "checked"; } ?> class="radio sms_function" value="0"  id="sms_function" name="sms_function" placeholder="Enter Database Password" >
                    
                    </div>
                </div>
                <?php
                
                if($sms_function == '1')
                {
                  $show_firebase_password = 'style="display:block;"';
                }
                else
                {
                  $show_firebase_password = 'style="display:none;"';
                }
                ?>
                <div id="firebase_details" <?php echo $show_firebase_password; ?> >
                  <div class="row">  
                    <div class="form-group col-md-6">
                        <label><b>Enter Firebase Key</b></label>
                    </div> 
                    <div class="form-group col-md-6">
                      <input type="text" name="firebase_key" autocomplete="off" placeholder="Enter Firebase Key" value="<?php echo $firebase_key; ?>" style="font-size: 14px; padding: 5px; width: 50%;">            
                    </div>
                  </div>
                  <div class="row">  
                    <div class="form-group col-md-6">
                        <label><b>Enter Firebase Password</b></label>
                    </div> 
                    <div class="form-group col-md-6">
                      <input type="text" name="firebase_password" autocomplete="off" placeholder="Enter Firebase Password" value="<?php echo $firebase_password; ?>" style="font-size: 14px; padding: 5px; width: 50%;">            
                    </div>
                  </div>  
                  <div class="row">  
                    <div class="form-group col-md-6">
                        <label><b>SMS Message Text 1</b></label>
                    </div> 
                    <div class="form-group col-md-6">
                      <input type="text" name="sms_function_text1" autocomplete="off" placeholder="Enter SMS Message Text 1" value="<?php echo $sms_function_text1; ?>" style="font-size: 14px; padding: 5px; width: 50%;">            
                    </div>
                  </div> 
                  <div class="row">  
                    <div class="form-group col-md-6">
                        <label><b>SMS Message Text 2</b></label>
                    </div> 
                    <div class="form-group col-md-6">
                      <input type="text" name="sms_function_text2" autocomplete="off" placeholder="Enter SMS Message Text 2" value="<?php echo $sms_function_text2; ?>" style="font-size: 14px; padding: 5px; width: 50%;">            
                    </div>
                  </div> 
                </div>


                <div class="row">  
                   <div class="form-group col-md-6">
                     <label><b>Mobile Number With OTP</b></label>
                   </div> 
                    <div class="form-group col-md-6">
                        <label>Active</label>
                        <input type="radio" <?php if($mobile_num_otp== 1){ echo "checked"; } ?> class="radio" value="1" name="mobile_num_otp" placeholder="Enter Database Password" >
            
                        <label>Deactive</label>
                        <input type="radio" <?php if($mobile_num_otp== 0){ echo "checked"; } ?> class="radio" value="0"  id="mobile_num_otp" name="mobile_num_otp" placeholder="Enter Database Password" >
                    
                    </div>
                </div>  

                <div class="row">  
                   <div class="form-group col-md-6">
                     <label><b>Share Link</b></label>
                   </div> 
                    <div class="form-group col-md-6">

                    <label>Refeerer Share</label>
                        <input type="radio" <?php if($share_referrel_hwe== 1){ echo "checked";} ?> class="radio" value="1"  name="share_referrel" placeholder="Enter Database Password" >

                        <label>Normal Share</label>
                        <input type="radio" <?php if($share_referrel_hwe== 0){ echo "checked"; } ?> class="radio" value="0" name="share_referrel" placeholder="Enter Database Password">
                    
                    </div>
                </div> 
                <div class="row">  
                    <div class="form-group col-md-6">
                        <label><b>Share Content Text</b></label>
                    </div> 
                    <div class="form-group col-md-6">
                      <input type="text" name="share_content_text" autocomplete="off" placeholder="Enter your content text" value="<?php echo $share_content_text; ?>" style="font-size: 14px; padding: 5px; width: 50%;">            
                    </div>
                  </div>  
                  <div class="row">  
                    <div class="form-group col-md-6">
                        <label><b>Share Content Title</b></label>
                    </div> 
                    <div class="form-group col-md-6">
                      <input type="text" name="share_content_title" autocomplete="off" placeholder="Enter your content Title" value="<?php echo $share_content_title; ?>" style="font-size: 14px; padding: 5px; width: 50%;">            
                    </div>
                  </div>  
                  <?php 
                  $styling_share_content_url = '';
                  if($share_referrel_hwe == 1)
                  {
                      $styling_share_content_url ='style="display:none;"';
                  }
                  ?>
                  <div class="row custom_sharer_url" <?php echo $styling_share_content_url; ?>>  
                    <div class="form-group col-md-6" >
                        <label><b>Share Content URL</b></label>
                    </div> 
                    <div class="form-group col-md-6">
                      <input type="text" id="share_content_Url" name="share_content_Url" autocomplete="off" placeholder="Enter your url" value="<?php echo $share_content_Url; ?>" style="font-size: 14px; padding: 5px; width: 50%;">            
                    </div>
                  </div>  
                
                <div class="row">  
                   <div class="form-group col-md-6">
                     <label><b>Background Music Function</b></label>
                   </div> 
                    <div class="form-group col-md-6">
                        <label>Active</label>
                        <input type="radio" <?php if($bg_music == 1){ echo "checked"; } ?> class="radio bg_music" value="1" name="bg_music" placeholder="Enter Database Password" >
            
                        <label>Deactive</label>
                        <input type="radio" <?php if($bg_music == 0){ echo "checked"; } ?> class="radio bg_music" value="0"  id="bg_music" name="bg_music" placeholder="Enter Database Password" >
                    
                    </div>
                </div>
                
                <div class="row">  
                   <div class="form-group col-md-6">
                     <label><b>User Login SMS Function</b></label>
                   </div> 
                    <div class="form-group col-md-6">
                        <label>Active</label>
                        <input type="radio" <?php if($user_login_sms_function == 1){ echo "checked"; } ?> class="radio bg_music" value="1" name="user_login_sms_function" placeholder="Enter Database Password" >
            
                        <label>Deactive</label>
                        <input type="radio" <?php if($user_login_sms_function == 0){ echo "checked"; } ?> class="radio bg_music" value="0"  id="user_login_sms_function" name="user_login_sms_function" placeholder="Enter Database Password" >
                    
                    </div>
                </div>

                <div class="row">  
                   <div class="form-group col-md-6">
                     <label><b>Lucky Number Option</b></label>
                   </div> 
                    <div class="form-group col-md-6">
                        <label>Lucky Number Spin</label>
                        <input type="radio" <?php if($lucky_number_option == 1){ echo "checked"; } ?> class="radio bg_music" value="1" name="lucky_number_option" placeholder="Enter Database Password" >
            
                        <label>Normal Spin</label>
                        <input type="radio" <?php if($lucky_number_option == 0){ echo "checked"; } ?> class="radio bg_music" value="0"  id="lucky_number_option" name="lucky_number_option" placeholder="Enter Database Password" >
                    
                    </div>
                </div>

                <div class="row custom_sharer_url">  
                    <div class="form-group col-md-6" >
                        <label><b>Set Text For Code/Mobile/Email Methods</b></label>
                    </div> 
                    <div class="form-group col-md-6">
                      <input type="text" id="set_text_for_code_method" name="set_text_for_code_method" autocomplete="off" placeholder="Enter your url" value="<?php echo $set_text_for_code_method; ?>" style="font-size: 14px; padding: 5px; width: 50%;">            
                    </div>
                </div>

                <div class="row">  
                   <div class="form-group col-md-6">
                     <label><b>Invisible Slice Method</b></label>
                   </div> 
                    <div class="form-group col-md-6">
                        <label>Active</label>
                        <input type="radio" <?php if($invisible_slice_method== 1){ echo "checked"; } ?> class="radio" value="1" name="invisible_slice_method" placeholder="Enter Database Password" >
            
                        <label>Deactive</label>
                        <input type="radio" <?php if($invisible_slice_method== 0){ echo "checked"; } ?> class="radio" value="0"  id="invisible_slice_method" name="invisible_slice_method" placeholder="Enter Database Password" >
                    
                    </div>
                </div>  

                <div class="row">  
                   <div class="form-group col-md-6">
                     <label><b>Admin Redeem Button Enable</b></label>
                   </div> 
                    <div class="form-group col-md-6">
                        <label>Active</label>
                        <input type="radio" <?php if($admin_redeem_button_enable == 1){ echo "checked"; } ?> class="radio" value="1" name="combine_plinko_lucky_wheel" placeholder="Enter Database Password" >
            
                        <label>Deactive</label>
                        <input type="radio" <?php if($admin_redeem_button_enable == 0){ echo "checked"; } ?> class="radio" value="0"  id="combine_plinko_lucky_wheel" name="combine_plinko_lucky_wheel" placeholder="Enter Database Password" >
                    
                    </div>
                </div>

                <div class="row">  
                   <div class="form-group col-md-6">
                     <label><b>Combine Plinko & Lucky Wheel</b></label>
                   </div> 
                   
                    <div class="form-group col-md-6">
                        <label>Active</label>
                        <input type="radio" <?php if($combine_plinko_lucky_wheel == 1){ echo "checked"; } ?> class="radio" value="1" name="admin_redeem_button_enable" placeholder="Enter Database Password" >
            
                        <label>Deactive</label>
                        <input type="radio" <?php if($combine_plinko_lucky_wheel == 0){ echo "checked"; } ?> class="radio" value="0"  id="admin_redeem_button_enable" name="admin_redeem_button_enable" placeholder="Enter Database Password" >
                    
                    </div>
                </div>
                
                <?php
                
                if($bg_music == '1')
                {
                  $show_bg_input = 'style="display:block;"';
                }
                else
                {

                  $show_bg_input = 'style="display:none;"';
                }
                ?>
                <div id="background_music_input" <?php echo $show_bg_input; ?> >
                  <div class="row">  
                    <div class="form-group col-md-6">
                        <label><b>Upload Background Music</b></label>
                    </div> 
                    <div class="form-group col-md-6">
                       <label class="btn btn-default btn-upload " for="banner_image" style="margin-top: 0px;">
                        Choose Image
                        <input id="upload_bg_music" type="file"  name="upload_bg_music" ><span><?php echo $bg_music_name; ?></span>                        
                      </label>
                    
                    </div>
                  </div>
           
                </div>

                
                
                <div class="form-group mt-4">
                  <button type="submit" name="update_function_setting" class="btn btn-primary">Submit</button>
                </div>

                <?php 
                  }
                ?>

              </form>
            </div>
          </div>
        </div>
      </div>



  </main>
  <div class="fixed-plugin">

    <div class="card shadow-lg">
      <div class="card-header pb-0 pt-3">

        <div class="float-end mt-4">
          <button class="btn btn-link text-dark p-0 fixed-plugin-close-button">
            <i class="material-icons">clear</i>
          </button>
        </div>
        <!-- End Toggle Button -->
      </div>
      <hr class="horizontal dark my-1">
      <div class="card-body pt-sm-3 pt-0">
        <!-- Sidebar Backgrounds -->
        <div>
          <h6 class="mb-0">Sidebar Colors</h6>
        </div>


        <!--   Core JS Files   -->
        <script src="../assets/js/core/popper.min.js"></script>
        <script src="../assets/js/core/bootstrap.min.js"></script>
        <script src="../assets/js/plugins/perfect-scrollbar.min.js"></script>
        <script src="../assets/js/plugins/smooth-scrollbar.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script>
          $(document).ready(function(e) {
            // $('input[type=radio][name=second_layout]').change(function() {
            //       if(this.value==1)
            //       {
            //             value = 0;
            //             $("input[name=first_layout][value=" + value + "]").prop('checked', true);
            //       }
            //       else
            //       {
            //             value = 1;
            //             $("input[name=first_layout][value=" + value + "]").prop('checked', true);
            //       }
            //   });

              // $('input[type=radio][name=first_layout]').change(function() {
              //     if(this.value==1)
              //     {
              //           value = 0;
              //           $("input[name=second_layout][value=" + value + "]").prop('checked', true);
              //           $("input[name=fourth_layout][value=" + value + "]").prop('checked', true);
              //     }
              //     else
              //     {
              //           value = 1;
              //           $("input[name=second_layout][value=" + value + "]").prop('checked', true);
              //           $("input[name=fourth_layout][value=" + value + "]").prop('checked', true);
              //     }
              // });

              
              $('input[type=radio][name=first_layout]').change(function() {
                  if(this.value==1)
                  {
                        value = 0;
                        $("input[name=second_layout][value=" + value + "]").prop('checked', true);
                        $("input[name=third_layout][value=" + value + "]").prop('checked', true);
                        $("input[name=fourth_layout][value=" + value + "]").prop('checked', true);
                  }                 
              });

              $('input[type=radio][name=second_layout]').change(function() {
                  if(this.value==1)
                  {
                        value = 0;
                        $("input[name=first_layout][value=" + value + "]").prop('checked', true);
                        $("input[name=third_layout][value=" + value + "]").prop('checked', true);
                        $("input[name=fourth_layout][value=" + value + "]").prop('checked', true);
                  }                 
              });
            //
              $('input[type=radio][name=third_layout]').change(function() {
                  if(this.value==1)
                  {
                        value = 0;
                        $("input[name=first_layout][value=" + value + "]").prop('checked', true);
                        $("input[name=second_layout][value=" + value + "]").prop('checked', true);
                        $("input[name=fourth_layout][value=" + value + "]").prop('checked', true);
                  }                 
              });
//
              $('input[type=radio][name=fourth_layout]').change(function() {
                  if(this.value==1)
                  {
                        value = 0;
                        $("input[name=first_layout][value=" + value + "]").prop('checked', true);
                        $("input[name=second_layout][value=" + value + "]").prop('checked', true);
                        $("input[name=third_layout][value=" + value + "]").prop('checked', true);
                  }                 
              });
              


              ////user login option
              $('input[type=radio][name=code_hwe]').change(function() {
                  if(this.value==1)
                  {
                        value = 0;
                        $("input[name=code_with_remain_spin][value=" + value + "]").prop('checked', true);
                        $("input[name=mobile_number][value=" + value + "]").prop('checked', true);
                        $("input[name=user_login][value=" + value + "]").prop('checked', true);
                        $("input[name=email_method][value=" + value + "]").prop('checked', true);
                        $("input[name=name_email_mobileno][value=" + value + "]").prop('checked', true);
                        $("input[name=phone_password_with_otp_method][value=" + value + "]").prop('checked', true);
                        $("input[name=pnone_email_password_with_otp][value=" + value + "]").prop('checked', true);
                        $("input[name=normal_spin_method][value=" + value + "]").prop('checked', true);
                        $("input[name=user_login_register_method][value=" + value + "]").prop('checked', true);
                        $("input[name=user_username_mobile_function][value=" + value + "]").prop('checked', true);
                  }                 
              });

              $('input[type=radio][name=code_with_remain_spin]').change(function() {
                  if(this.value==1)
                  {
                        value = 0;
                        $("input[name=code_hwe][value=" + value + "]").prop('checked', true);
                        $("input[name=mobile_number][value=" + value + "]").prop('checked', true);
                        $("input[name=user_login][value=" + value + "]").prop('checked', true);
                        $("input[name=email_method][value=" + value + "]").prop('checked', true);
                        $("input[name=name_email_mobileno][value=" + value + "]").prop('checked', true);
                        $("input[name=phone_password_with_otp_method][value=" + value + "]").prop('checked', true);
                        $("input[name=pnone_email_password_with_otp][value=" + value + "]").prop('checked', true);
                        $("input[name=normal_spin_method][value=" + value + "]").prop('checked', true);
                        $("input[name=user_login_register_method][value=" + value + "]").prop('checked', true);
                        $("input[name=user_username_mobile_function][value=" + value + "]").prop('checked', true);
                        
                  }                 
              });

              $('input[type=radio][name=mobile_number]').change(function() {
                  if(this.value==1)
                  {
                        value = 0;
                        $("input[name=code_with_remain_spin][value=" + value + "]").prop('checked', true);
                        $("input[name=code_hwe][value=" + value + "]").prop('checked', true);
                        $("input[name=user_login][value=" + value + "]").prop('checked', true);
                        $("input[name=email_method][value=" + value + "]").prop('checked', true);
                        $("input[name=name_email_mobileno][value=" + value + "]").prop('checked', true);
                        $("input[name=phone_password_with_otp_method][value=" + value + "]").prop('checked', true);
                        $("input[name=pnone_email_password_with_otp][value=" + value + "]").prop('checked', true);
                        $("input[name=normal_spin_method][value=" + value + "]").prop('checked', true);
                        $("input[name=user_login_register_method][value=" + value + "]").prop('checked', true);
                        $("input[name=user_username_mobile_function][value=" + value + "]").prop('checked', true);
                  }                 
              });

              $('input[type=radio][name=user_login]').change(function() {
                  if(this.value==1)
                  {
                        value = 0;
                        $("input[name=code_with_remain_spin][value=" + value + "]").prop('checked', true);
                        $("input[name=mobile_number][value=" + value + "]").prop('checked', true);
                        $("input[name=code_hwe][value=" + value + "]").prop('checked', true);
                        $("input[name=email_method][value=" + value + "]").prop('checked', true);
                        $("input[name=name_email_mobileno][value=" + value + "]").prop('checked', true);
                        $("input[name=phone_password_with_otp_method][value=" + value + "]").prop('checked', true);
                        $("input[name=pnone_email_password_with_otp][value=" + value + "]").prop('checked', true);
                        $("input[name=normal_spin_method][value=" + value + "]").prop('checked', true);
                        $("input[name=user_login_register_method][value=" + value + "]").prop('checked', true);
                        $("input[name=user_username_mobile_function][value=" + value + "]").prop('checked', true);
                  }                 
              });

              $('input[type=radio][name=email_method]').change(function() {
                  if(this.value==1)
                  {
                        value = 0;
                        $("input[name=code_with_remain_spin][value=" + value + "]").prop('checked', true);
                        $("input[name=mobile_number][value=" + value + "]").prop('checked', true);
                        $("input[name=code_hwe][value=" + value + "]").prop('checked', true);
                        $("input[name=user_login][value=" + value + "]").prop('checked', true);
                        $("input[name=name_email_mobileno][value=" + value + "]").prop('checked', true);
                        $("input[name=phone_password_with_otp_method][value=" + value + "]").prop('checked', true);
                        $("input[name=pnone_email_password_with_otp][value=" + value + "]").prop('checked', true);
                        $("input[name=normal_spin_method][value=" + value + "]").prop('checked', true);
                        $("input[name=user_login_register_method][value=" + value + "]").prop('checked', true);
                        $("input[name=user_username_mobile_function][value=" + value + "]").prop('checked', true);
                  }                 
              });

              $('input[type=radio][name=name_email_mobileno]').change(function() {
                  if(this.value==1)
                  {
                        value = 0;
                        $("input[name=code_with_remain_spin][value=" + value + "]").prop('checked', true);
                        $("input[name=mobile_number][value=" + value + "]").prop('checked', true);
                        $("input[name=code_hwe][value=" + value + "]").prop('checked', true);
                        $("input[name=user_login][value=" + value + "]").prop('checked', true);
                        $("input[name=email_method][value=" + value + "]").prop('checked', true);
                        $("input[name=phone_password_with_otp_method][value=" + value + "]").prop('checked', true);
                        $("input[name=pnone_email_password_with_otp][value=" + value + "]").prop('checked', true);
                        $("input[name=normal_spin_method][value=" + value + "]").prop('checked', true);
                        $("input[name=user_login_register_method][value=" + value + "]").prop('checked', true);
                        $("input[name=user_username_mobile_function][value=" + value + "]").prop('checked', true);
                  }                 
              });

              $('input[type=radio][name=phone_password_with_otp_method]').change(function() {
                  if(this.value==1)
                  {
                        value = 0;
                        $("input[name=code_with_remain_spin][value=" + value + "]").prop('checked', true);
                        $("input[name=mobile_number][value=" + value + "]").prop('checked', true);
                        $("input[name=code_hwe][value=" + value + "]").prop('checked', true);
                        $("input[name=user_login][value=" + value + "]").prop('checked', true);
                        $("input[name=email_method][value=" + value + "]").prop('checked', true);
                        $("input[name=name_email_mobileno][value=" + value + "]").prop('checked', true);
                        $("input[name=pnone_email_password_with_otp][value=" + value + "]").prop('checked', true);
                        $("input[name=normal_spin_method][value=" + value + "]").prop('checked', true);
                        $("input[name=user_login_register_method][value=" + value + "]").prop('checked', true);
                        $("input[name=user_username_mobile_function][value=" + value + "]").prop('checked', true);
                  }                 
              });

              $('input[type=radio][name=pnone_email_password_with_otp]').change(function() {
                  if(this.value==1)
                  {
                        value = 0;
                        $("input[name=code_with_remain_spin][value=" + value + "]").prop('checked', true);
                        $("input[name=mobile_number][value=" + value + "]").prop('checked', true);
                        $("input[name=code_hwe][value=" + value + "]").prop('checked', true);
                        $("input[name=user_login][value=" + value + "]").prop('checked', true);
                        $("input[name=email_method][value=" + value + "]").prop('checked', true);
                        $("input[name=name_email_mobileno][value=" + value + "]").prop('checked', true);
                        $("input[name=phone_password_with_otp_method][value=" + value + "]").prop('checked', true);
                        $("input[name=normal_spin_method][value=" + value + "]").prop('checked', true);
                        $("input[name=user_login_register_method][value=" + value + "]").prop('checked', true);
                        $("input[name=user_username_mobile_function][value=" + value + "]").prop('checked', true);
                  }                 
              });

              $('input[type=radio][name=normal_spin_method]').change(function() {
                  if(this.value==1)
                  {
                        value = 0;
                        $("input[name=code_with_remain_spin][value=" + value + "]").prop('checked', true);
                        $("input[name=mobile_number][value=" + value + "]").prop('checked', true);
                        $("input[name=code_hwe][value=" + value + "]").prop('checked', true);
                        $("input[name=user_login][value=" + value + "]").prop('checked', true);
                        $("input[name=email_method][value=" + value + "]").prop('checked', true);
                        $("input[name=name_email_mobileno][value=" + value + "]").prop('checked', true);
                        $("input[name=phone_password_with_otp_method][value=" + value + "]").prop('checked', true);
                        $("input[name=user_login_register_method][value=" + value + "]").prop('checked', true);
                        $("input[name=user_username_mobile_function][value=" + value + "]").prop('checked', true);
                  }                 
              });

              $('input[type=radio][name=user_login_register_method]').change(function() {
                  if(this.value==1)
                  {
                        value = 0;
                        $("input[name=code_with_remain_spin][value=" + value + "]").prop('checked', true);
                        $("input[name=mobile_number][value=" + value + "]").prop('checked', true);
                        $("input[name=code_hwe][value=" + value + "]").prop('checked', true);
                        $("input[name=user_login][value=" + value + "]").prop('checked', true);
                        $("input[name=email_method][value=" + value + "]").prop('checked', true);
                        $("input[name=name_email_mobileno][value=" + value + "]").prop('checked', true);
                        $("input[name=phone_password_with_otp_method][value=" + value + "]").prop('checked', true);
                        $("input[name=normal_spin_method][value=" + value + "]").prop('checked', true);
                        $("input[name=user_username_mobile_function][value=" + value + "]").prop('checked', true);
                        
                  }                 
              });

              $('input[type=radio][name=user_username_mobile_function]').change(function() {
                  if(this.value==1)
                  {
                        value = 0;
                        $("input[name=code_with_remain_spin][value=" + value + "]").prop('checked', true);
                        $("input[name=mobile_number][value=" + value + "]").prop('checked', true);
                        $("input[name=code_hwe][value=" + value + "]").prop('checked', true);
                        $("input[name=user_login][value=" + value + "]").prop('checked', true);
                        $("input[name=email_method][value=" + value + "]").prop('checked', true);
                        $("input[name=name_email_mobileno][value=" + value + "]").prop('checked', true);
                        $("input[name=phone_password_with_otp_method][value=" + value + "]").prop('checked', true);
                        $("input[name=normal_spin_method][value=" + value + "]").prop('checked', true);
                        $("input[name=user_login_register_method][value=" + value + "]").prop('checked', true);
                  }                 
              });

              

              $('input[type=radio][name=sms_function]').change(function() {
                var get_val_hwe = $(this).val();
                  if(get_val_hwe==1)
                  {
                       
                        $("input[name=sms_function][value=" + get_val_hwe + "]").prop('checked', true);
                        $("#firebase_details").attr('style','display:block;');
                  }
                  else
                  {
                      
                        $("input[name=sms_function][value=" + get_val_hwe + "]").prop('checked', true);
                        $("#firebase_details").attr('style','display:none;');
                  }
              });

              $('input[type=radio][name=user_username_mobile_function]').change(function() {
                var get_val_hwe = $(this).val();
                  if(get_val_hwe==1)
                  {
                       
                        $("input[name=user_username_mobile_function][value=" + get_val_hwe + "]").prop('checked', true);
                        $("#user_name_mobile").attr('style','display:block;');
                  }
                  else
                  {
                      
                        $("input[name=user_username_mobile_function][value=" + get_val_hwe + "]").prop('checked', true);
                        $("#user_name_mobile").attr('style','display:none;');
                  }
              });

              $('input[type=radio][name=user_login]').change(function() {
                var get_val_hwe = $(this).val();
                  if(get_val_hwe==1)
                  {
                       
                        $("input[name=user_login][value=" + get_val_hwe + "]").prop('checked', true);
                        $("#user_login_spin_method_lists").attr('style','display:block;');
                  }
                  else
                  {
                      
                        $("input[name=user_login][value=" + get_val_hwe + "]").prop('checked', true);
                        $("#user_login_spin_method_lists").attr('style','display:none;');
                  }
              });

              $('input[type=radio][name=user_login_register_method]').change(function() {
                var get_val_hwe = $(this).val();
                  if(get_val_hwe==1)
                  {
                       
                        $("input[name=user_login_register_method][value=" + get_val_hwe + "]").prop('checked', true);
                        $("#user_login_spin_method_lists").attr('style','display:block;');
                  }
                  else
                  {
                      
                        $("input[name=user_login_register_method][value=" + get_val_hwe + "]").prop('checked', true);
                        $("#user_login_spin_method_lists").attr('style','display:none;');
                  }
              });

              

              $('input[type=radio][name=bg_music]').change(function() {
                var get_val_hwe1 = $(this).val();
                  if(get_val_hwe1==1)
                  {
                       
                        $("input[name=bg_music][value=" + get_val_hwe1 + "]").prop('checked', true);
                        $("#background_music_input").attr('style','display:block;');
                  }
                  else
                  {
                      
                        $("input[name=bg_music][value=" + get_val_hwe1 + "]").prop('checked', true);
                        $("#background_music_input").attr('style','display:none;');
                  }
              });
              $('input[type=radio][name=share_referrel]').change(function() {
                var get_val_hwe = $(this).val();
                
                  if(get_val_hwe==1)
                  {
                
                        $(".custom_sharer_url").attr('style','display:none;');
                  }
                  else
                  {
                      
                        $(".custom_sharer_url").attr('style','display:flex;');
                      
                  }
              });


          });

          var win = navigator.platform.indexOf('Win') > -1;
          if (win && document.querySelector('#sidenav-scrollbar')) {
            var options = {
              damping: '0.5'
            }
            Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
          }
        </script>
        <!-- Github buttons -->
        <script async defer src="https://buttons.github.io/buttons.js"></script>
        <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
        <script src="../assets/js/material-dashboard.min.js?v=3.0.0"></script>
</body>
</html>