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
if(isset($id) && $id !='')
{//ramkishan
  $update_status ="UPDATE ".$table_prefix."codegenerate SET `status`='0' where id ='".$id."'";
  mysqli_query($conn,$update_status);
  ?>
   <script>
    window.location.replace('user_name_email_mobilenumber_method.php');
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
          <h6 class="font-weight-bolder mb-0">User Email List</h6>
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

    <div class="container-fluid py-4">
      <div class="row">
        <div class="col-12">
          <div class="card my-4">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
              <div class="bg-gradient-primary shadow-primary border-radius-lg pt-2 pb-1">
                <div class="row">
                  <div class="col-md-10 col-6 pt-2">
                    <h6 class="text-white text-capitalize ps-3">Spin user Email</h6>
                  </div>
              
                  <!-- <div class="col-md-2 col-4 text-center">
                    <a href="../pages/adduser.php"><button type="button" class="btn btn-dark">Add User</button></a>
                  </div> -->
                </div>
              </div>
            </div>
            <script>
            jQuery(document).ready(function(){
                
                 jQuery("#get_all_rewards_value").hide();
                
                  jQuery('#search_input_box').keypress(function (e) {
                      var key = e.which;
                      if(key == 13)  // the enter key code
                      {
                        jQuery('#searchuser').click();
                        return false;  
                      }
                  }); 
                  
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
                  
            });
              
              
              
              function add_new_code_function_hwe()
              {
                    jQuery('#add_new_code_form').show();
              }
              
              function add_new_code_function_hwe_close()
              {
                    jQuery('#add_new_code_form').hide();
              }

            </script>
            <div class="card-body px-0 pb-2">
                <div id="add_new_code_form" style="display:none; border: 1px solid;border-radius: 10px;width: 96%;margin-left: 2%;">
                    <span  onclick="add_new_code_function_hwe_close()" style="color:red;float: right;margin-right: 10px;cursor: pointer;">X</span>
                  <form method="post">
                    <div class="form-group" style="padding:10px;">
                   
                      <input type="text" name="generated_code" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Code" required style="width: 30%;margin-left: 35%;border: 1px solid lightgray;">
                     
                    </div>
         
                    <div style="display:flex;justify-content:center;">
                        <button type="submit" name="save_generate_code" class="btn btn-primary">Submit</button>
                    </div>
                  </form>
              </div>
              <div class="table-responsive p-0">
                <table class="table align-items-center mb-0">

                <tbody>
                    <tr class="text-center">
                      <th>#</th>
                      <th>User Name</th>
                      <th>User Email</th>
                      <th>User Mobile Number</th>
                      <th>Status</th>
                      <th>Options</th>
                 
                    </tr>
				<?php

                  $no =1;//ramkishan
                  $select_user1 ="SELECT * from ".$table_prefix."codegenerate where method='n_e_m' order by id desc";
                  $row_user1 = $conn->query($select_user1);
                  while($result_user1 = mysqli_fetch_assoc($row_user1))
                  {

                  $username_hwe    =   $result_user1['user_n_e_mob_username'];
                  $useremail_hwe    =   $result_user1['user_n_e_mob_email'];
                  $usermobilenumber_hwe    =   $result_user1['user_n_e_mob_phnumber'];
                  $status    =   $result_user1['status'];
                  $id    =   $result_user1['id'];


                  if($status == '1')
                  {
                    $used_or_not = 'USED';
                  }
                  else
                  {
                    $used_or_not = 'NOT USED';
                  }
               
                
                  ?>
                      <tr class="text-center">
                      
                        <td><?php echo $no; ?></td>
                        <td><?php echo $username_hwe; ?></td>
                        <td><?php echo $useremail_hwe; ?></td>
                        <td><?php echo $usermobilenumber_hwe; ?></td>
                        <td><?php echo $used_or_not; ?></td>
                        <td>

                          <!-- <a href="../pages/viewuser.php?id=<?php //echo $id; ?>"><button type="button" class="btn btn-primary btn-sm">View</button></a> -->

                          <!-- <a href="../pages/editusercode.php?id=<?php echo $id; ?>"><button type="button" class="btn btn-dark btn-sm">Edit</button></a> -->

                          <a href="../pages/user_name_email_mobilenumber_method.php?id=<?php echo $id; ?>" ><button type="button" class="btn btn-danger btn-sm">Delete</button></a>
                          
                        </td>
                    
                      
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