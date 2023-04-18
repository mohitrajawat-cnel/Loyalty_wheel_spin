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


//send sms on mobile number

class bulk360hwe{
  var $user   = '';
  var $pass   = '';
  var $from   = '60109503939';
  var $to;
  var $text;

  var $url    = 'https://sms.360.my/gw/bulk360/v3_0/send.php';

  function __construct() {
	  $this->user = urlencode($this->user);
	  $this->pass = urlencode($this->pass);

	  $this->url = $this->url . "?from=$this->from&detail=1";
  }

  function sendsmshwe($to, $text,$firebase_key,$firebase_password) {
	  $this->url = $this->url . "&to=".$to."&text=".rawurlencode($text)."&user=".$firebase_key."&pass=".$firebase_password;

	  $ch = curl_init();
	  curl_setopt($ch, CURLOPT_URL, $this->url);
	  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	  curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
	  curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
	  $sentResult = curl_exec($ch);
	  
	  if ($sentResult == FALSE) {
		  echo 'Curl failed for sending sms to crm.. '.curl_error($ch);
	  }
	  else
	  {
	   // echo $sentResult;
		$sms_data =  json_decode($sentResult,true);
		$sms_data_desc = $sms_data['desc'];
		?>
		  <script>
				var sms_desc = '<?php echo $sms_data_desc; ?>';
				alert(sms_desc);
			</script>
		<?php
	  }
	  curl_close($ch);

	// echo 'sentResult = ' . $sentResult;
  }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="../assets/img/favicon.png">
  <title>
  <?php echo $site_title_hwe; ?>
  </title>
  <meta name="description" content="" data-type="admin" />
  <meta name="keywords" content="html5 game, lucky wheek, wheel of fortune" data-type="admin" />
  <meta name="author" content="Gafami">
  <meta property="fb:app_id" content="1701132369920968" data-type="admin" />
  <meta property="og:url" content="" data-type="admin" />
  <meta property="og:type" content="Website" data-type="admin" />
  <meta property="og:title" content="<?php echo $site_title_hwe; ?>" data-type="admin" />
  <meta property="og:description" content="<?php echo $site_description; ?>" data-type="admin" />
  <meta property="og:image" content="https://www.iomgame.com/wheel_of_fortune/screenshot.png" data-type="admin" />
  <?php echo $header_script_tag; ?>
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
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
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
<?php
$save_msg='';
if(isset($_POST['save']) && !isset($_REQUEST['id']))
{
  $user_id = $_REQUEST['id'];

  $username    =   $_POST['username'];
  $password    =   $_POST['email'];
  $total_spin  =   $_POST['total_spin'];
  $phone_number  =   $_POST['phone_number'];

  $spin_type_check    =   $_POST['normal_spin_check'];
  if($spin_type_check == '1')
  {

  
    $count_total_slices = count($_POST['reward_spin_value']);

    $all_spins_value =  $_POST['reward_spin_value'];





    $number_total=0;
    for($m=0; $m < $count_total_slices; $m++)
    {
      if($all_spins_value[$m] == '')
      {
        $all_spins_value[$m] =0;
      }
    $number_total = $number_total + $all_spins_value[$m];

    }


    if($number_total <= 0)
    {
      $spin_type_check=0;
    }

    
  ?>
    <script>
            jQuery(document).ready(function(){
                
                var total_number = '<?php echo $number_total; ?>';

              
                if(parseInt(total_number) <= 0)
                {
                  alert("Please set reward for spin.");
            
                }

                

            });
      </script>
  <?php

}
  $reward_spin_value =   json_encode($_POST['reward_spin_value']);
  $user_earn_point_hwe='';
  if($share_referrel == '1' || (($user_login_sp == '1' || $user_login_register_method == '1') && $reward_point_login_method == '1'))
  {

    $user_redeem_point=$_POST['user_redeem_point'];

    $user_earn_point_hwe = "user_redeem_point='$user_redeem_point',";

  }
 
  $UUID = substr(str_shuffle("0123456789"), 0, 9);
  // if($host_name == 'wheel006.jgdx.xyz')
  // {
    //ramkishan

    $select_user ="SELECT * from ".$table_prefix."user_table where username = '".$username."'";
    $row_user = $conn->query($select_user);
    if(mysqli_num_rows($row_user) > 0)
    {
      ?>
      <script>
              alert("User Already Registered.");
      </script>
          
      <?php
    }
    else
    {
      $insert ="INSERT into ".$table_prefix."user_table SET
      username = '".$username."',password ='".$password."',user_total_spin='".$total_spin."',
      user_spin_type_login_method='".$spin_type_check."',
      num_for_reward_reamin_spin='".$reward_spin_value."',
      ".$user_earn_point_hwe."
      UUID='".$UUID."'";
      mysqli_query($conn,$insert);
    }
   
  // }
  // else
  // {//ramkishan
  //   $insert ="INSERT into ".$table_prefix."user_table SET
  //   username = '".$username."',password ='".$password."',user_total_spin='".$total_spin."',
  //   user_spin_type_login_method='".$spin_type_check."',
  //   num_for_reward_reamin_spin='".$reward_spin_value."'";
  //   mysqli_query($conn,$insert);
  // }
  
    if(isset($_POST['phone_number']) && $_POST['phone_number'] != '')
    {
       $sms = new bulk360hwe();
       $sms->sendsmshwe($phone_number, 'Please use this login details Website link: '.Front_URL.', Username='.$username.', Password='.$password,$firebase_key,$firebase_password);
    }     
      

      $save_msg='Playes Added Successfully';



}

$username_user='';
$password_user='';
$total_spin_user='';
if(isset($_REQUEST['id']))
{


  if(isset($_POST['save']))
 {
   $user_id = $_REQUEST['id'];

   $username    =   $_POST['username'];
   $password    =   $_POST['email'];;
   $total_spin  =   $_POST['total_spin'];

   $spin_type_check    =   $_POST['normal_spin_check'];

   if($spin_type_check == '1')
   {
    $count_total_slices = count($_POST['reward_spin_value']);

    $all_spins_value =  $_POST['reward_spin_value'];


    $number_total=0;
    for($m=0; $m < $count_total_slices; $m++)
    {
      if($all_spins_value[$m] == '')
      {
        $all_spins_value[$m] =0;
      }
    $number_total = $number_total + $all_spins_value[$m];

    }


    if($number_total <= 0)
    {
      $spin_type_check=0;
    }

    
  ?>
    <script>
            jQuery(document).ready(function(){
                
                var total_number = '<?php echo $number_total; ?>';

              
                if(parseInt(total_number) <= 0)
                {
                  alert("Please set reward for spin.");
            
                }

                

            });
      </script>
  <?php
}
   $reward_spin_value =   json_encode($_POST['reward_spin_value']);

   $user_earn_point_hwe='';
   if($share_referrel == '1' || (($user_login_sp == '1' || $user_login_register_method == '1') && $reward_point_login_method == '1'))
    {

      $user_redeem_point=$_POST['user_redeem_point'];

      $user_earn_point_hwe = "user_redeem_point='$user_redeem_point',";

    }


//ramkishan
   $select ="SELECT * from ".$table_prefix."user_table";
   $row = $conn->query($select);
   $count  = mysqli_num_rows($row);
//ramkishan
     $update ="UPDATE ".$table_prefix."user_table SET
     username = '".$username."',password ='".$password."',user_total_spin='".$total_spin."',
     ".$user_earn_point_hwe."
       user_spin_type_login_method='".$spin_type_check."',
       num_for_reward_reamin_spin='".$reward_spin_value."' WHERE id='".$user_id."'
     "; 
     mysqli_query($conn,$update);

    $save_msg='Playes Updated Successfully';

  }
//ramkishan

  $select_user ="SELECT * from ".$table_prefix."user_table where id='".$_REQUEST['id']."'";
  $row_user = $conn->query($select_user);
  while($result_user = mysqli_fetch_assoc($row_user))
  {
    $username_user    =   $result_user['username'];
    $password_user    =   $result_user['password'];
    $total_spin_user  =   $result_user['user_total_spin'];

    $user_spin_type_login_method_hwe  =   $result_user['user_spin_type_login_method'];    

    $user_redeem_point=0;
    $user_redeem_point = $result_user['user_redeem_point'];
    $num_for_reward_reamin_spin_hwe  =   json_decode($result_user['num_for_reward_reamin_spin'],true);

  }
}


?>
<style>
 .radio
{
  cursor:pointer;
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
          <h6 class="font-weight-bolder mb-0">Add/Edit player</h6>
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
                    <h6 class="text-white text-capitalize ps-3">Add User</h6>
                  </div>
                </div>
              </div>
            </div>
            <div style="text-align:center;"><?php echo $save_msg; ?></div>
            <div class="card-body px-0 pb-2">
              <form class="form_data" method="post">
                <div class="row">
                  
                  <div class="form-group col-md-6">
                    <label>Username</label>
                    <input type="text" name="username" class="form-control" value="<?php echo $username_user; ?>" placeholder="Username" required>
                  </div>
                  <div class="form-group col-md-6">
                    <label>Password</label>
                    <input type="text" name="email" class="form-control" value="<?php echo $password_user; ?>" placeholder="Password" required>
                  </div>
                  <div class="form-group col-md-6">
                    <label>User Remain Spin</label>
                    <input type="text" name="total_spin" class="form-control" value="<?php echo $total_spin_user; ?>" placeholder="Total Spin" required>
                  </div>
                  
                  <?php
                    $display_phone_number = 'display:none';
                    if($user_login_sms_function_hwe == '1' && $user_login_hwe == '1')
                    {
                        $display_phone_number = 'display:block';
                    }
                    ?>
                  
                  <div class="form-group col-md-6" style="<?php echo $display_phone_number; ?>">
                    <label>Phone Number</label>
                    <input type="text" name="phone_number" class="form-control" value="<?php echo $phone_number; ?>" placeholder="Phone Number">
                  </div>
                 <div class="form-group col-md-6">
                    <div class="form-group">
                        <label>Remain Spin Type</label>
                         <select id="normal_spin_check" class="form-control" name="normal_spin_check" style="border: 1px solid lightgray;">
                            <option value="0" <?php if($user_spin_type_login_method_hwe == '0'){ echo 'selected'; } ?>>Normal Spin</option>
                            <option value="1" <?php if($user_spin_type_login_method_hwe == '1'){ echo 'selected'; } ?>>Set Reward For Spin</option>
                          </select>
                    </div>

                    <?php
                    $display = 'display:none';
                    if($user_spin_type_login_method_hwe == '1')
                    {
                      $display = 'display:block';
                    }
                    ?>
                      <div id="get_all_rewards_value" class="form-control" style="border: 1px solid lightgray;<?php echo $display; ?>">
                             <option value="" >Set how many times Reward get for remain spin</option>
                             <?php
                            //ramkishan
                                 $selcte_reward_list  = "SELECT * from ".$table_prefix."wheel_data";
                                 $row_reward = $conn->query($selcte_reward_list);
                              
                                 while($result_reward = mysqli_fetch_assoc($row_reward))
                                 {
                                    $all_data_show = json_decode($result_reward['spin_data'],true);
                                  
                                    $total_slice = $all_data_show['slice'];
                                  
                                    for($i=0; $i<$total_slice; $i++)
                                    {
                                        $showing_reward_list = $all_data_show['prize'.$i];
                                       
                                        ?>
                                        <div>
                                            <input name="<?php echo $i; ?>" value="<?php echo $showing_reward_list; ?>" style="border-radius: 5px;margin: 5px 5px 0px 0px;" readonly>
                                            <input name="reward_spin_value[<?php echo $i; ?>]" class="reward_value_for_reamin_spin" style="border-radius: 5px;" value="<?php echo $num_for_reward_reamin_spin_hwe[$i] ? $num_for_reward_reamin_spin_hwe[$i] : 0;  ?>">
                                        </div>  
                                        <?php
                                    }
                                 }
                             ?>
                      
                              </div>

                </div>
                <?php
                if($share_referrel == '1' || (($user_login_sp == '1' || $user_login_register_method == '1') && $reward_point_login_method == '1'))
                {
                ?>
                  <div class="form-group col-md-6">
                      <label>Change user Earn Points</label>
                      <input type="number" name="user_redeem_point" class="form-control" value="<?php echo $user_redeem_point; ?>" placeholder="Change user Share Points Earn" required>
                  </div>
                <?php
                }
                ?>

                </div>
          
                <div class="form-group mt-4">
                  <button type="submit" name="save" class="btn btn-primary" onClick="return confirm('Are you sure you want to save changes!');">Submit</button>
                </div>

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
        <script>
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
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script>
              jQuery(document).ready(function(){
                  jQuery('#normal_spin_check').on('change',function () {
                 
                     var get_normal_spin_value = jQuery(this).val();
                     
                     if(get_normal_spin_value == 1)
                     {
                         jQuery("#get_all_rewards_value").show();
                     }
                     else if(get_normal_spin_value == 0)
                     {
                         jQuery("#get_all_rewards_value").hide();
                     }
                  });
                  jQuery('.reward_value_for_reamin_spin').on('keyup',function () {
                 
                      var toatl_reamin_spin = jQuery("input[name=total_spin]").val();
                      
                      if(toatl_reamin_spin == '')
                      {
                        toatl_reamin_spin =0;
                        
                      }
                      var toatl_rewars_spipn_value =0;
                      jQuery('.reward_value_for_reamin_spin').each(function(){
                        
                        var get_reard_spin_value = jQuery(this).val();
                        if(get_reard_spin_value == '')
                        {
                          get_reard_spin_value = 0;
                        }
                        toatl_rewars_spipn_value = parseInt(toatl_rewars_spipn_value) + parseInt(get_reard_spin_value);

                      });

                      if(toatl_rewars_spipn_value > toatl_reamin_spin)
                      {
                        alert("Can not set reward value greater then total remain spin.");
                    
                      }
                      
                    });

                  
              });
          </script>
</body>

</html>