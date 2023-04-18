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

  $reset_spin_hour    =   $_POST['reset_spin_hour'];
  $reset_remain_spin    =   $_POST['reset_remain_spin'];

  $select_user ="SELECT * from ".$table_prefix."reset_remain_spin";
  $row_user = $conn->query($select_user);
  if(mysqli_num_rows($row_user) > 0)
  {
    $update ="UPDATE ".$table_prefix."reset_remain_spin SET
    reset_spin_hour = '".$reset_spin_hour."',
    reset_remain_spin='$reset_remain_spin' where id='1'";
    mysqli_query($conn,$update);
  }
  else
  {
    $insert ="INSERT into ".$table_prefix."reset_remain_spin SET
    reset_spin_hour = '".$reset_spin_hour."',
    reset_remain_spin='$reset_remain_spin'";
    mysqli_query($conn,$insert);
  }
 

  $save_msg='Timer Set Successfully';



}
 ?>

<style>
 .radio
{
  cursor:pointer;
}
</style>
<?php
$select ="SELECT * from ".$table_prefix."reset_remain_spin";
$row = $conn->query($select);
$result = mysqli_fetch_assoc($row);
$reset_spin_hour    =   $result['reset_spin_hour'];
$reset_remain_spin    =   $result['reset_remain_spin'];

?>
<body class="g-sidenav-show  bg-gray-200">
   <?php include 'header.php'; ?>
  <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
    <!-- Navbar -->
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur"
      navbar-scroll="true">
      <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
          <h6 class="font-weight-bolder mb-0">Reset Timer Remaining Spin</h6>
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
                    <h6 class="text-white text-capitalize ps-3">Remain Spin Reset Time</h6>
                  </div>
                </div>
              </div>
            </div>
            <div style="text-align:center;"><?php echo $save_msg; ?></div>
            <div class="card-body px-0 pb-2">
              <form class="form_data" method="post">
                <div class="row">
                    <div class="form-group col-md-6">
                  
                          <label>Select Reset Spin Hour</label>
                            <select id="reset_spin_hour" class="form-control" name="reset_spin_hour" style="border: 1px solid lightgray;">
                              <option value="0">Select Reset Spin Hour</option>
                              <option value="1" <?php if($reset_spin_hour == '1'){ echo 'selected'; } ?>>1</option>
                              <option value="2" <?php if($reset_spin_hour == '2'){ echo 'selected'; } ?>>2</option>
                              <option value="3" <?php if($reset_spin_hour == '3'){ echo 'selected'; } ?>>3</option>
                              <option value="4" <?php if($reset_spin_hour == '4'){ echo 'selected'; } ?>>4</option>
                              <option value="5" <?php if($reset_spin_hour == '5'){ echo 'selected'; } ?>>5</option>
                              <option value="6" <?php if($reset_spin_hour == '6'){ echo 'selected'; } ?>>6</option>
                              <option value="7" <?php if($reset_spin_hour == '7'){ echo 'selected'; } ?>>7</option>
                              <option value="8" <?php if($reset_spin_hour == '8'){ echo 'selected'; } ?>>8</option>
                              <option value="9" <?php if($reset_spin_hour == '9'){ echo 'selected'; } ?>>9</option>
                              <option value="10" <?php if($reset_spin_hour == '10'){ echo 'selected'; } ?>>10</option>
                              <option value="11" <?php if($reset_spin_hour == '11'){ echo 'selected'; } ?>>11</option>
                              <option value="12" <?php if($reset_spin_hour == '12'){ echo 'selected'; } ?>>12</option>
                            </select>
                    
                    </div>
                    <div class="form-group col-md-6">
                      <label>Reset Remain Spin</label>
                      <input type="number" name="reset_remain_spin" class="form-control" value="<?php echo $reset_remain_spin; ?>" placeholder="Enter Reset Remain Spin" required>
                    </div>
                  
                </div>
          
                <div class="form-group mt-4">
                  <button type="submit" name="save" class="btn btn-primary">Submit</button>
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