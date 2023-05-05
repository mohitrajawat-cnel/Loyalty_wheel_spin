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
{
  $delete ="DELETE from user_data where id ='".$id."'";
  mysqli_query($conn,$delete);
  ?>
   <script>
    window.location.replace('users.php');
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
$id=$_REQUEST['redeem_id'];
if(isset($id) && $id !='')
{
  $delete ="UPDATE spin_result SET admin_redeem_status='1' where id ='".$id."'";
  mysqli_query($conn,$delete);
  ?>
   <script>
    window.location.replace('spin_results.php');
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
          <h6 class="font-weight-bolder mb-0">Spin Result List</h6>
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
                  <div class="col-md-8 col-6 pt-2">
                    <h6 class="text-white text-capitalize ps-3">Spin Result List</h6>
                  </div>
                  <div class="col-md-4 col-4 text-center">
                    <form mathad="GET">
                         <!--  <input  type="text" name="s" id="search_input_box" class="form-control" value="<?php echo $_REQUEST['s']; ?>" style="width: 61%;float: left;border: 1px solid white;color: white;" />
                          <button type="submit" id="searchuser" name="searchuser" class="btn btn-dark">Search</button> --> 
                    </form>
                  </div>
                  <!-- <div class="col-md-2 col-4 text-center">
                    <a href="../pages/adduser.php"><button type="button" class="btn btn-dark">Add User</button></a>
                  </div> -->
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
                      <?php 
                      if($host_name == 'wheel006.bonuus.io' || $host_name == 'spin2win.bet' || $host_name == 'skyworldsg-luckyspin.com' || $host_name == 'wheel001.bonuus.io' || $host_name == 'wgc33.vip')
                      {  
                          
                      }
                      else
                      {
                       ?>
                      <th>Player Id</th>
                      <?php  
                      }
                      ?>
                      <!--<th>Win Rate</th>-->
                      <th>Reward Name</th>
                      <th>Reward Get Email</th>
                      <?php if($host_name == 'wheel006.bonuus.io' || $host_name == 'spin2win.bet' || $host_name == 'skyworldsg-luckyspin.com' || $host_name == 'wheel001.bonuus.io' || $host_name == 'wgc33.vip')
                      { 
                        if($host_name == 'wgc33.vip')
                        {
                            $column_code = 'Mobile Number';
                        }
                        else
                        {
                            $column_code = 'code';
                        }
                      ?>
                      <th><?php echo $column_code; ?></th>
                      <?php }?>
                      <th>Redeem Date</th>
                      <th>Spin Date</th>
                      <?php if($host_name == 'luckyspin888.com')
                      { 
                      ?>
                      <th>Status</th>
                      <th>Option</th>
                      <?php
                      }
                      ?>
                    </tr>
                    </thead>
                    <tbody>
				<?php

                $select_user ="SELECT * from spin_result where 1=1 ";
                
                //echo $select_user;
                //die();

                if(isset($_REQUEST['searchuser']))
                {
                   /* $select_user .= " AND user_email LIKE '%".$_REQUEST["s"]."%' 
                                     OR reward_item LIKE '%".$_REQUEST["s"]."%'  
                                     OR win_rate LIKE '%".$_REQUEST["s"]."%'";
                    
                    */
                    
                   
                                    
                      $select_user .= " AND user_email LIKE '%".$_REQUEST["s"]."%'; 
                      OR datetime LIKE '%".$_REQUEST["s"]."%'  
                      OR redeem_time LIKE '%".$_REQUEST["s"]."%'";
                      
                      
                }

                

                $row_user = $conn->query($select_user);
                $no =1;
                while($result_user = mysqli_fetch_assoc($row_user))
                {
                  $user_id_hwe    =   $result_user['user_id'];
                  
                  $select_user1 ="SELECT * from user_table where id='".$user_id_hwe."'";
                  $row_user1 = $conn->query($select_user1);
                  $result_user1 = mysqli_fetch_assoc($row_user1);

                  $username_user    =   $result_user1['username'];

                  $win_rate  =   $result_user['win_rate'];
                  $reward_item  =   $result_user['reward_item'];

                  $reward_get_email  =   $result_user['user_email'];
                  
                  
                  
                  

                  //   $created  =   strtotime($result_user['created']);
                  //   $spin_date = date("Y-m-d h:i:s",$created)
                  $spin_date_strtime = strtotime($result_user['created']);
                  $spin_date = date("d-m-Y H:i:s",$spin_date_strtime);
                  
                  $redeem_time = $result_user['redeem_time'];
                  $spin_code = $result_user['spin_code'];
                  
                  if($host_name == 'wgc33.vip')
                  {
                      $select_user1_code ="SELECT * from phonenogenerate where id='".$spin_code."'";
                  }
                  else
                  {
                      $select_user1_code ="SELECT * from codegenerate where id='".$spin_code."'";
                  }
                  $row_user1_code = $conn->query($select_user1_code);
                  $result_user1_code = mysqli_fetch_assoc($row_user1_code);
				?>
				
                    <tr class="text-center">
                    
                      <td><?php echo $no; ?></td>
                      <?php 
                      if($host_name == 'wheel006.bonuus.io' || $host_name == 'spin2win.bet' || $host_name == 'skyworldsg-luckyspin.com' || $host_name == 'wheel001.bonuus.io' || $host_name == 'wgc33.vip')
                      {  
                          
                      }else{ ?>
                      <td><?php echo $username_user; ?></td>
                      <?php 
                      }?>
                      <!--<td><?php //echo $win_rate; ?></td>-->
                      <td><?php echo $reward_item; ?></td>
                      <td><?php echo $reward_get_email; ?></td>
                      <?php if($host_name == 'wheel006.bonuus.io' || $host_name == 'spin2win.bet' || $host_name == 'skyworldsg-luckyspin.com' || $host_name == 'wheel001.bonuus.io' || $host_name == 'wgc33.vip')
                      { ?>
                      <td><?php echo $result_user1_code['generate_code']; ?></td>
                      <?php }?>
                      <td><?php echo $redeem_time; ?></td>
                      <td><?php echo $spin_date; ?></td>
                      <?php if($host_name == 'luckyspin888.com')
                      { 
                           $redeem_check_or_not  =   $result_user['admin_redeem_status'];
                           $id  =   $result_user['id'];
                           
                           if($redeem_check_or_not == 1)
                           {
                               $redeem_text = 'REDEEMED';
                               $redeem_button = '';
                           }
                           else
                           {
                               $redeem_text = 'REDEEM';
                                $redeem_button = '<a href="../pages/spin_results.php?redeem_id='.$id.'"><button type="button" class="btn btn-danger btn-sm">REDEEM</button></a>';
                              
                           }
                      ?>
                      <td><?php echo $redeem_text; ?></td>
                      <td><?php echo $redeem_button; ?></td>
                      <?php
                      }
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