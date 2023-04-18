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


$id=$_REQUEST['id']; //ramkishan
$select ="SELECT * from ".$table_prefix."user_data where id='".$id."'";
$row =$conn->query($select);
while($result =mysqli_fetch_assoc($row))
{

   $first_name=$result['first_name'];
   $last_name=$result['last_name'];
   $email=$result['email'];
   $password        =   $result['password'];
   $subdomain_name  =   $result['subdomain_name'];
   $databasehost_name =$result['databasehost_name'];
   $database_name   =  $result['database_name'];
   $database_username =$result['database_username'];
   $database_password =$result['database_password'];
   $status=$result['status'];

	if($status == 0)
	{
	  $user_status ="Deactive";
      
	}
	else
	{
	  $user_status ="Active";
	}

   
}
$update_msg='';
$alert_class='';
if(isset($_POST['update_user']))
{
      $first_name       =   $_POST['first_name'];
	  $last_name       =   $_POST['last_name'];
	  $email           =   $_POST['email'];
	  $password        =   $_POST['password'];
	  $subdomain_name  =   $_POST['subdomain_name'];
	  $databasehost_name =$_POST['databasehost_name'];
	  $database_name   =  $_POST['database_name'];
	  $database_username =$_POST['database_username'];
	  $database_password =$_POST['database_password'];
	  $status =           $_POST['status'];
//ramkishan
  $update ="UPDATE ".$table_prefix."user_data SET
       status='".$status."'
	 where id='".$id."' ";

   mysqli_query($conn,$update);

  $update_msg='Update Record Successfully';
  $alert_class="alert alert-success";
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
          <h6 class="font-weight-bolder mb-0">Edit User</h6>
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
                    <h6 class="text-white text-capitalize ps-3">Edit User</h6>
                  </div>
                </div>
              </div>
            </div>
            <div class="<?php //echo $alert_class; ?>" style="text-align:center;"><?php echo $update_msg; ?></div>
            <div class="card-body px-0 pb-2">
              <form class="form_data" method="post">
                <div class="row">
                  
                  <div class="form-group col-md-6">
                    <label>First Name</label>
                    <input type="text" name="first_name" class="form-control" placeholder="First name" value="<?php echo $first_name; ?>" readonly>
                  </div>
                  <div class="form-group col-md-6">
                    <label>Last Name</label>
                    <input type="text" name="last_name" class="form-control" placeholder="Last name" value="<?php echo $last_name; ?>" readonly>
                  </div>
                </div>
                <div class="row">
                  <div class="form-group col-md-6">
                    <label>Email Address</label>
                    <input type="email" name="email" class="form-control" placeholder="Email Address"value="<?php echo $email; ?>" readonly>
                  </div>
                  <!--<div class="form-group col-md-6">
                    <label>Password</label>
                    <input type="text" name="password" class="form-control" placeholder="Enter Password" value="<?php echo $password; ?>" readonly> 
                  </div>-->
                </div>
               
                <div class="form-group">
                  <label>Subdomain Name</label>
                  <input type="text" name="subdomain_name" class="form-control" placeholder="Enter Subdomain" value="<?php echo $subdomain_name; ?>" readonly>
                </div>

                <div class="row">
                  <div class="form-group col-md-3">
                    <label>Database Hostname</label>
                    <input type="text" name="databasehost_name" class="form-control" placeholder="Email Database Hostname" value="<?php echo $databasehost_name; ?>" readonly>
                  </div>
                  <div class="form-group col-md-3">
                    <label>Database Name</label>
                    <input type="text" name="database_name" class="form-control" placeholder="Enter Database Name" value="<?php echo $database_name; ?>" readonly>
                  </div>
                  <div class="form-group col-md-3">
                    <label>Database Username</label>
                    <input type="text" name="database_username" class="form-control" placeholder="Email Database Username" value="<?php echo $database_username; ?>" readonly>
                  </div>
                  <div class="form-group col-md-3">
                    <label>Database Password</label>
                    <input type="text" name="database_password" class="form-control" placeholder="Enter Database Password" value="<?php echo $database_password; ?>" readonly>
                  </div>
                </div>
                <div class="form-group col-md-6">
                    <label>Active</label>
                    <input type="radio" <?php if($status == 1){ echo "checked"; } ?> class="radio" value="1" name="status" placeholder="Enter Database Password" >
            
                   <label>Deactive</label>
                    <input type="radio" <?php if($status == 0){ echo "checked"; } ?> class="radio" value="0" name="status" placeholder="Enter Database Password" >
                    
                  </div>
                
                <div class="form-group mt-4">
                  <button type="submit" name="update_user" class="btn btn-primary">Submit</button>
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