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

if(isset($_POST['save_generate_code']))
{
  
    $remain_spin_for_code  =  $_POST['remain_spin_generate_code'];
   
//ramkishan
    $insert ="UPDATE ".$table_prefix."codegenerate SET remain_spin_for_code ='$remain_spin_for_code',
    created=now() where id='".$_REQUEST['code_id']."'"; 
    mysqli_query($conn,$insert);
    
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
          <h6 class="font-weight-bolder mb-0">Remain Spin</h6>
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
                    <h6 class="text-white text-capitalize ps-3">User Remain Spin Update</h6>
                  </div>
               
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
                  

                  
            });
              
              
     

            </script>
            <div class="card-body px-0 pb-2">
                <div id="add_new_code_form" style="border: 1px solid;border-radius: 10px;width: 96%;margin-left: 2%;">
                    <?php
                        $code_id = $_REQUEST['code_id'];//ramkishan
                        $selcte_code = "SELECT * from ".$table_prefix."codegenerate where id='".$code_id."'";
                        
                         $row_code = $conn->query($selcte_code);
                      
                         while($result_remain = mysqli_fetch_assoc($row_code))
                         {
                             $user_code = $result_remain['generate_code'];
                             $user_reamin_spin= $result_remain['remain_spin_for_code'];
                         }
                    ?>
                  <form method="post">
                    <div class="form-group" style="padding:10px;">
                   
                      <input type="text" name="generated_code" class="form-control" id="exampleInputEmail1" value="<?php echo $user_code; ?>" aria-describedby="emailHelp" placeholder="Enter Code" required style="width: 30%;margin-left: 35%;border: 1px solid lightgray; padding-left:5px;" readOnly>
                     
                    </div>
                    
                    <div class="form-group" style="padding:10px;">
                   
                              <input type="text" name="remain_spin_generate_code" class="form-control" value="<?php echo $user_reamin_spin; ?>" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Remain Spin" required style="width: 30%;margin-left: 35%;border: 1px solid lightgray; padding-left:5px;">
                             
                    </div>
          
                    
                    <div style="display:flex;justify-content:center;">
                        <button type="submit" name="save_generate_code" class="btn btn-primary">Submit</button>
                    </div>
                  </form>
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