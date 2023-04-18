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

if(isset($_REQUEST['deletestatus']) && isset($_REQUEST['delete_redeem']) && $_REQUEST['delete_redeem'] !='')
{

  $redeem_share_table_delete = $select_user ="DELETE from ".$table_prefix."reward_redeem_share where id ='".$_REQUEST['delete_redeem']."'";
  mysqli_query($conn,$redeem_share_table_delete);
  ?>
   <script>
    window.location.replace('share_redeem_rewards.php');
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
if(isset($_POST['save_user_share_point']))
{
  $user_share_point = $_POST['user_share_point'];

  $select_share_point = "SELECT * from ".$table_prefix."user_redeem_share_points";
  $row_share_points = $conn->query($select_share_point);
  if(mysqli_num_rows($row_share_points) > 0)
  {
    $insert_user_share_point = "UPDATE ".$table_prefix."user_redeem_share_points set user_share_point='$user_share_point' where id='1'";
  }
  else
  {
    $insert_user_share_point = "INSERT into ".$table_prefix."user_redeem_share_points set user_share_point='$user_share_point'";
  }
  

  mysqli_query($conn,$insert_user_share_point);
}

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
          <h6 class="font-weight-bolder mb-0">Redeem Rewards List</h6>
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
                      <h6 class="text-white text-capitalize ps-3" style="float:left;">Redeem Rewards List</h6>
                    
                        <a href="add_share_redeem_rewards.php" style="background-color:#337ab7;float:right;" class="btn btn-primary">Add Redeem Rewards</a>
                  
                        <?php
                        if($share_referrel == '1')
                        {

                        ?>
                          <button style="background-color: #337ab7;float: right;margin-right:20px;" onclick="add_user_share_points()" class="btn btn-primary">Add User Share Points</button>
                       <?php
                        }
                       ?>
                    </div>
                
                  
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
                <div id="add_user_points_form" style="display:none; border: 1px solid;border-radius: 10px;width: 96%;margin-left: 2%;">
                    <span  onclick="add_user_share_points_close()" style="color:red;float: right;margin-right: 10px;cursor: pointer;">X</span>
                  <form method="post">
                    <div class="form-group" style="padding:10px;">
                   
                      <input type="text" name="user_share_point" class="form-control" id="user_share_point" aria-describedby="emailHelp" placeholder="Add User Share Points" required style="width: 30%;margin-left: 35%;border: 1px solid lightgray;">
                     
                    </div>
                    
                    
                    <div style="display:flex;justify-content:center;">
                        <button type="submit" name="save_user_share_point" class="btn btn-primary">Submit</button>
                    </div>
                  </form>
              </div>
              <?php
              if($share_referrel == '1')
              {

              ?>
              <div class="card-body px-0 pb-2">
                <span style="font-size:20px;font-weight:bold;">User Share Point</span> : <span style="font-size:18px;font-weight:bold;"><?php echo $user_share_points; ?></span>
              <div>

              <?php
              }
              ?>
                 
                  <table class="table-responsive" id="myTable" >
                      
                  <thead>
                      <tr class="text-center">
                        <th>#</th>
                        
                        <th>Title</th>
                        <th>Description</th>
                        <th>Image</th>
                        <th>Number Of Pints</th>
                        <th>Options</th>
                      
                      </tr>
                      </thead>
                      <tbody>
              <?php

                  $select_user ="SELECT * from ".$table_prefix."reward_redeem_share where 1=1";
                  
                  $row_user = $conn->query($select_user);
                  $no =1;

                  
                  while($result_user = mysqli_fetch_assoc($row_user))
                  {

                    $id = $result_user['id'];
                    $number_of_points    =   $result_user['number_of_points'];
                    $title    =   $result_user['title'];
                    $description    =   $result_user['description'];
                    $image    =   $result_user['image'];
                    
                    // $spin_date_strtime = strtotime($result_user['created']);
                    // $spin_date = date("d-m-Y H:i:s",$spin_date_strtime);
                    
    
                    
                    
                    ?>
          
                      <tr class="text-center">
                      
                        <td><?php echo $no; ?></td>
                       
                        <td><?php echo $title; ?></td>
                        <td><?php echo $description; ?></td>
                        <td><a href="/admin_panel/pages/<?php echo $image; ?>" target="_blank">Redeem Reward Image</td>

                        <td><?php echo $number_of_points; ?></td>

                        <td>
                          <a href="../pages/add_share_redeem_rewards.php?id=<?php echo $id; ?>"><button type="button" class="btn btn-dark btn-sm">Edit</button></a>
                          <a href="../pages/share_redeem_rewards.php?deletestatus=1&delete_redeem=<?php echo $id; ?>" onClick="return confirm('Are you sure you want to delete redeem reward')"><button type="button" class="btn btn-danger btn-sm">Delete</button></a>
                        </td>
                       
                      </tr>

                    <?php

                        $no++;
                      
                    }
                    ?>


                    </tbody>
                  </table>
              
                
                    <textarea name='export_data' style='display: none;'><?php echo $serialize_user_arr; ?></textarea>
                  
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

          function add_user_share_points()
          {
                jQuery('#add_user_points_form').show();
          }
          function add_user_share_points_close()
          {
                jQuery('#add_user_points_form').hide();
          }

        </script>
        <!-- Github buttons -->
        <script async defer src="https://buttons.github.io/buttons.js"></script>
        <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
        <script src="../assets/js/material-dashboard.min.js?v=3.0.0"></script>
</body>

</html>