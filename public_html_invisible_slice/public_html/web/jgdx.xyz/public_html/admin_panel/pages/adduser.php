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
    Loyalty Wheel Spin
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
<?php
$save_msg='';
if(isset($_POST['save']) && !isset($_REQUEST['id']))
{
  $user_id = $_REQUEST['id'];

  $username    =   $_POST['username'];
  $password    =   $_POST['email'];;
  $total_spin  =   $_POST['total_spin'];


      $insert ="INSERT into user_table SET
      username = '".$username."',password ='".$password."',user_total_spin='".$total_spin."'"; 
      mysqli_query($conn,$insert);

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

   $select ="SELECT * from user_table";
   $row = $conn->query($select);
   $count  = mysqli_num_rows($row);

     $update ="UPDATE user_table SET
     username = '".$username."',password ='".$password."',user_total_spin='".$total_spin."' WHERE id='".$user_id."'
     "; 
     mysqli_query($conn,$update);

    $save_msg='Playes Updated Successfully';

  }


  $select_user ="SELECT * from user_table where id='".$_REQUEST['id']."'";
  $row_user = $conn->query($select_user);
  while($result_user = mysqli_fetch_assoc($row_user))
  {
    $username_user    =   $result_user['username'];
    $password_user    =   $result_user['password'];;
    $total_spin_user  =   $result_user['user_total_spin'];

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
</body>

</html>