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
  
  
  <!-- for data table -->
   <script src="js/jquery.js"></script> 
  <script src="media/js/jquery.dataTables.min.js"></script> 
  <link href="media/css/jquery.dataTables.min.css" rel="stylesheet">
    
    <script>
     jQuery(document).ready(function(){
	   jQuery("#myTable").dataTable();
	 });
   </script>
  <!-- --> 
  
  
</head> 
<?php
if(isset($_REQUEST['redeem_id']) && $_REQUEST['redeem_id'] !='')
{

  $delete ="UPDATE ".$table_prefix."share_redeem_reward_results SET admin_redeemed_status='1' where id ='".$_REQUEST['redeem_id']."'";
  mysqli_query($conn,$delete);
  ?>
   <script>
    window.location.replace('reward_redeem_results.php');
   </script>
  <?php
}

?>
<body class="g-sidenav-show  bg-gray-200">
  <?php
   include 'header.php';
  ?>
  <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
    <!-- Navbar -->
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur"
      navbar-scroll="true">
      <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
         <a href="../pages/users.php">
          <h6 class="font-weight-bolder mb-0">Reward Redeem Result</h6>
         </a>
         
        </nav>
        <nav aria-label="breadcrumb" style="position: absolute;right: 18px;">
         <a href="../pages/logout.php">
          <h6 class="font-weight-bolder mb-0">Logout</h6>
         </a>
        </nav>
        <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">

          <ul class="navbar-nav  justify-content-end">

            </li>
          </ul>
          </li>
          </ul>
        </div>
      </div>
    </nav>
    <!-- End Navbar -->
    <form method="post">
      <div class="container-fluid py-4">
        <div class="row">
          <div class="col-12">
            <div class="card my-4">
              <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                <div class="bg-gradient-primary shadow-primary border-radius-lg pt-2 pb-1">
                  <div class="row">
                    <div class="col-md-12 col-12 pt-2">
                      <h6 class="text-white text-capitalize ps-3" style="float:left;">Reward Redeem Result List</h6>
                    
                  </div>
                </div>
              </div>
              <script>
                $('#search_input_box').keypress(function (e) {
                    var key = e.which;
                    if(key == 13)  // the enter key code
                    {
                      $('#searchuser').click();
                      return false;  
                    }
                });   

              </script>
              <div class="card-body px-0 pb-2">
              <!--  <div class="table-responsive p-0"> -->
              <div>
                  <table class="table-responsive" id="myTable" >
                      
                  <thead>
                      <tr class="text-center">
                        <th>#</th>
                        <th>Username</th>
                        <th>Reward Name</th>
                        <th>Redeem Reward Get Email</th>
                        <th>Reward Redeem Points</th>
                        <th>Reward Redeem Date</th>
                        <th>Status</th>
                        <th>Redeem Button</th>
                        
                      </tr>
                      </thead>
                      <tbody>
                  <?php
                  //ramkishan

              

                  $select_user ="SELECT * from ".$table_prefix."share_redeem_reward_results";
                 
                  $row_user = $conn->query($select_user);
                  $no =1;

                  while($result_user = mysqli_fetch_assoc($row_user))
                  {
                    

                    $user_id_hwe    =   $result_user['user_id'];
                    $share_redeem_reward_id    =   $result_user['share_redeem_reward_id'];
                    $number_of_redeem_points    =   $result_user['number_of_redeem_points'];
                    $redeem_reward_email    =   $result_user['redeem_reward_email'];
                    $share_reward_redeem_date    =   $result_user['share_reward_redeem_date'];
                    $share_reward_redeem_date    =   strtotime($result_user['share_reward_redeem_date']);
                    $spin_date = date("d-m-Y H:i:s",$share_reward_redeem_date);

                    $share_redeem_admin_status    =   $result_user['admin_redeemed_status'];

                    $id = $result_user['id'];
                    if($share_redeem_admin_status == 1)
                    {
                        $redeem_text = 'REDEEMED';
                        $redeem_button = '';
                    }
                    else
                    {
                        $redeem_text = 'REDEEM';
                        $confirm_status = "return confirm('Ae you sure you want to change')";
                        $redeem_button = '<a href="../pages/reward_redeem_results.php?redeem_id='.$id.'" onclick="'.$confirm_status.'"><button type="button" class="btn btn-danger btn-sm">REDEEM</button></a>';
                        
                    }
                   
                    $select_user1 ="SELECT * from ".$table_prefix."user_table where id='".$user_id_hwe."'";
                    $row_user1 = $conn->query($select_user1);
                    $result_user1 = mysqli_fetch_assoc($row_user1);
                    $username_user='';
                    if(mysqli_num_rows($row_user1) > 0)
                    {
                      $username_user    =   $result_user1['username'];
                    }
                    


                    $select_user1_redeem ="SELECT * from ".$table_prefix."reward_redeem_share where id='".$share_redeem_reward_id."'";
                    $row_user1_redeem = $conn->query($select_user1_redeem);
                    $result_user1_redeem = mysqli_fetch_assoc($row_user1_redeem);

                    $title_reward    =   $result_user1_redeem['title'];

                    
                    
                    ?>
          
                      <tr class="text-center">
                      
                        <td><?php echo $no; ?></td>
                        <td><?php echo $username_user; ?></td>
                        <td><?php echo $title_reward; ?></td>
                        <td><?php echo $redeem_reward_email; ?></td>
                        <td><?php echo $number_of_redeem_points; ?></td>
                        <td><?php echo $spin_date; ?></td>
                        <td><?php echo $redeem_text; ?></td>
                        <td><?php echo $redeem_button; ?></td>
                        <?php
                        
                        ?>
                      </tr>
                    <?php

                        $no++;

                      
                  }
                  ?>


                    </tbody>
                  </table>
              
                  
                </div>
              </div>
            </div>
          </div>
        </div>
      </form>


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
</body>

</html>