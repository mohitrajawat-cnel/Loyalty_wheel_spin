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

if(isset($_REQUEST['id']))
{
    $id=$_REQUEST['id'];
}

if(isset($id) && $id !='')
{//ramkishan
  $delete ="DELETE from ".$table_prefix."user_data where id ='".$id."'";
  mysqli_query($conn,$delete);
  ?>
   <script>
    window.location.replace('users.php');
   </script>
  <?php
}
//export spin results
$export_data = array();
if(isset($_POST["export_spin_result"])){

  
         
  $filename = 'spin-results.csv';
  $export_data = unserialize($_POST['export_data']);

  // file creation
  $file = fopen($filename,"w");

  foreach ($export_data as $line){
    fputcsv($file,$line);
  }

  fclose($file); 

  // download
  header("Content-Description: File Transfer");
  header("Content-Disposition: attachment; filename=".$filename);
  header("Content-Type: application/csv; "); 

  readfile($filename);

  // deleting file
  unlink($filename);
  exit();
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
  //    jQuery(document).ready(function(){
	//    jQuery("#myTable").dataTable();
	//  });
   </script>
  <!-- --> 
  
  
</head> 
<?php

if(isset($_REQUEST['redeem_id']))
{
    $id=$_REQUEST['redeem_id'];
}

if(isset($id) && $id !='')
{//ramkishan
  $delete ="UPDATE ".$table_prefix."spin_result SET admin_redeem_status='1' where id ='".$id."'";
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
    <?php
      if (!isset ($_GET['page']) ) {

        $page_number = 1;
        
      } else {
        
      $page_number = (isset($_GET['page']) && is_numeric($_GET['page']) ) ? $_GET['page'] : 1;
        
      }

      $search_result='';
      $like_query_for_search='';
      if(isset($_REQUEST['s']) && $_REQUEST['s'] != '')
      {
        $search_result = $_REQUEST['s'];

        if($user_login_sp == '1' || $user_login_register_method == '1')
        {
          $search_user ="SELECT * from ".$table_prefix."user_table where username LIKE '%".$search_result."%'";
          $search_row_suer = $conn->query($search_user);
          if(mysqli_num_rows($search_row_suer) > 0)
          {
              while($result_user_search = mysqli_fetch_assoc($search_row_suer))
              {
                  $user_id_array[] = $result_user_search['id'];
              }
      
              if(count($user_id_array) >0)
              {
                $implode_users = implode(',',$user_id_array);
                $in_query_users = ' OR user_id IN('.$implode_users.')';
              }
      
          }
        }
        elseif($mobile_number_sp == '1' || $mobile_num_otp)
        {
          $search_mob_num ="SELECT * from ".$table_prefix."phonenogenerate where generate_code LIKE '%".$search_result."%'";
          $search_row_mob_num = $conn->query($search_mob_num);
          if(mysqli_num_rows($search_row_mob_num) > 0)
          {
              while($result_mob_num_search = mysqli_fetch_assoc($search_row_mob_num))
              {
                  $user_mob_num_array[] = $result_mob_num_search['id'];
              }
      
              if(count($user_mob_num_array) >0)
              {
                $implode_mob_num = implode(',',$user_mob_num_array);
                $in_query_users = ' OR spin_code IN('.$implode_mob_num.')';
              }
      
          }

        }
        else
        {
         $search_code ="SELECT * from ".$table_prefix."codegenerate where generate_code LIKE '%".$search_result."%'";
          $search_row_code = $conn->query($search_code);
          if(mysqli_num_rows($search_row_code) > 0)
          {
              while($result_code_search = mysqli_fetch_assoc($search_row_code))
              {
                  $user_code_array[] = $result_code_search['id'];
              }
      
              if(count($user_code_array) >0)
              {
                $implode_code = implode(',',$user_code_array);
                $in_query_users = ' OR spin_code IN('.$implode_code.')';
              }
      
          }

        }
        
  
        $like_query_for_search = " AND (reward_item LIKE '%".$search_result."%' OR user_email LIKE '%".$search_result."%'".$in_query_users.")";
       
      }

      $limit = isset($_SESSION['records-limit']) ? $_SESSION['records-limit'] : 10;

       $sql = $conn->query("SELECT * FROM ".$table_prefix."spin_result where 1=1".$like_query_for_search);

      $allRecrods = mysqli_num_rows($sql);
        
      // Calculate total pages
      $totoalPages = ceil($allRecrods / $limit);
      

    ?>
    <form method="get">
      <lable> Search <input type="search" class="" name="s" placeholder="Enter Value" value="<?php echo $search_result; ?>" aria-controls="myTable"></lable>
      <input type="hidden" class="" name="page" value="1" aria-controls="myTable">
      <button type="submit"><i class="fa fa-search"></i></button>
    </form>
    <form method="post">
      <div class="container-fluid py-4">
        <div class="row">
          <div class="col-12">
            <div class="card my-4">
              <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                <div class="bg-gradient-primary shadow-primary border-radius-lg pt-2 pb-1">
                  <div class="row">
                    <div class="col-md-12 col-12 pt-2">
                      <h6 class="text-white text-capitalize ps-3" style="float:left;">Spin Result List</h6>
                    
                        <button style="background-color:#337ab7;float:right;" type="submit" name="export_spin_result" class="btn btn-primary">Export Results</button>
                    
                    </div>
                    <div class="col-md-4 col-4 text-center">
                    
                          <!--  <input  type="text" name="s" id="search_input_box" class="form-control" value="<?php echo $_REQUEST['s']; ?>" style="width: 61%;float: left;border: 1px solid white;color: white;" />
                            <button type="submit" id="searchuser" name="searchuser" class="btn btn-dark">Search</button> --> 
                  
                    </div>
                    <!-- <div class="col-md-2 col-4 text-center">
                      <a href="../pages/adduser.php"><button type="button" class="btn btn-dark">Add User</button></a>
                    </div> -->
                  </div>
                </div>
              </div>
              <div>
                  <p style="font-size:20px;"><b>Total Records:</b><span style="font-weight:bold;"><?php echo $allRecrods; ?></span></p>
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
                  <table class="table table-hover" id="myTable">
                      
                  <thead>
                      <tr class="text-center">
                        <th>#</th>
                        <?php 
                        if($code_sp == '1' || $mobile_number_sp == '1' || $code_with_remain_spin_sp == '1' || $email_method== '1' || $name_email_mobileno == '1'  || $normal_spin_method == '1')
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
                        <?php if($code_sp == '1' || $mobile_number_sp == '1' || $code_with_remain_spin_sp == '1' || $email_method== '1' || $name_email_mobileno == '1' || $user_username_mobile_method == '1')
                        { 
                          if($mobile_number_sp == '1')
                          {
                              $column_code = 'Mobile Number';
                          }
                          elseif($email_method == '1')
                          {
                            $column_code = 'Email';
                          }
                          elseif($name_email_mobileno == '1')
                          {
                            $column_code = 'User Email';
                          }
                          elseif($user_username_mobile_method == '1')
                          {
                            $column_code = 'User Mobile Number';
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

                        <?php 
         
                        if($admin_redeem_button_enable == '1' )
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


                      // Offset
                      $paginationStart = ($page_number - 1) * $limit;

                      $prev = $page_number - 1;
                      $next = $page_number + 1;

                  $select_user ="SELECT * from ".$table_prefix."spin_result where 1=1".$like_query_for_search." order by id desc LIMIT ".$paginationStart.",".$limit;
                  
                  $row_user = $conn->query($select_user);
                  $no =1;

                  $count_row =1;
                  $user_arr=array();
                  if($code_sp == '1' || $mobile_number_sp == '1' || $code_with_remain_spin_sp == '1' || $email_method== '1' || $name_email_mobileno == '1' || $normal_spin_method == '1')
                  { 
                    $user_arr[0] = array('Reward Name','Reward Get Email',$column_code,'Redeem Date','Spin Date');
                  }
                  elseif($user_username_mobile_method == '1')
                  { 
                    $user_arr[0] = array('Player Id','Reward Name','Reward Get Email',$column_code,'Redeem Date','Spin Date');
                  }
                  else
                  {
                    $user_arr[0] = array('Player Id','Reward Name','Reward Get Email','Redeem Date','Spin Date');
                  }
                  
                  while($result_user = mysqli_fetch_assoc($row_user))
                  {
                    $user_id_hwe    =   $result_user['user_id'];
                    //ramkishan
                    $username_user='';
                    if($user_id_hwe != '')
                    {
                      $select_user1 ="SELECT * from ".$table_prefix."user_table where id='".$user_id_hwe."'";
                      $row_user1 = $conn->query($select_user1);
                      $result_user1 = mysqli_fetch_assoc($row_user1);
  
                      
                      if(isset($result_user1['username']))
                      {
                        $username_user    =   $result_user1['username'];
                      }
                    }
                  
                    

                    $win_rate  =   $result_user['win_rate'];
                   // $reward_item  =   $result_user['reward_item'];
                    $reward_item = str_replace('<br />','',urldecode($result_user['reward_item']));

                    $reward_get_email  =   $result_user['user_email'];
                    
                    
                    
                    

                    //   $created  =   strtotime($result_user['created']);
                    //   $spin_date = date("Y-m-d h:i:s",$created)
                    $spin_date_strtime = strtotime($result_user['created']);
                    $spin_date = date("d-m-Y H:i:s",$spin_date_strtime);
                    
                    $redeem_time = $result_user['redeem_time'];
                    $spin_code = $result_user['spin_code'];
                    
                    if($mobile_number_sp == '1')
                    {//ramkishan
                        $select_user1_code ="SELECT * from ".$table_prefix."phonenogenerate where id='".$spin_code."'";
                    }
                    else
                    {//ramkishan
                        $select_user1_code ="SELECT * from ".$table_prefix."codegenerate where id='".$spin_code."'";
                    }
                    $row_user1_code = $conn->query($select_user1_code);
                    $result_user1_code = mysqli_fetch_assoc($row_user1_code);
          ?>
          
                      <tr class="text-center">
                      
                        <td><?php echo $no; ?></td>
                        <?php 
                        if($code_sp == '1' || $mobile_number_sp == '1' || $code_with_remain_spin_sp == '1' || $email_method== '1' || $name_email_mobileno == '1'  || $normal_spin_method == '1')
                        {  
                            
                        }
                        else
                        {
                          if($user_username_mobile_method == '1')
                          {
                        
                            $user_username_mob_meth_username ='';
                            if(isset($result_user1_code['user_username_mob_meth_username']))
                            {
                              $user_username_mob_meth_username = $result_user1_code['user_username_mob_meth_username'];
                            }
                            
                            ?>
                            <td><?php echo $user_username_mob_meth_username; ?></td>
                            <?php 
                          }
                          else
                          {
                    
                            ?>
                            <td><?php echo $username_user; ?></td>
                            <?php 
                          }
                        }?>
                        <!--<td><?php //echo $win_rate; ?></td>-->
                        <td><?php echo $reward_item; ?></td>
                        <td><?php echo $reward_get_email; ?></td>
                        <?php if($code_sp == '1' || $mobile_number_sp == '1' || $code_with_remain_spin_sp == '1' || $email_method== '1' || $name_email_mobileno == '1'  || $user_username_mobile_method == '1')
                        {
                          if($email_method == '1')
                          {
                              if(isset($result_user1_code['user_email_method_email']))
                              {
                                ?>
                                  <td><?php echo $result_user1_code['user_email_method_email']; ?></td>
                                <?php
                              }
                              else
                              {
                                ?>
                                  <td></td>
                                <?php
                              }
                          
                          }
                          elseif($name_email_mobileno == '1')
                          {
                            if(isset($result_user1_code['user_n_e_mob_email']))
                            {
                              ?>
                                <td><?php echo $result_user1_code['user_n_e_mob_email']; ?></td>
                              <?php
                            }
                            else
                            {
                              ?>
                                <td></td>
                              <?php
                            }
                            
                          }
                          elseif($user_username_mobile_method == '1')
                          {
                            if(isset($result_user1_code['user_username_mob_meth_mobnumber']))
                            {
                              ?>
                                <td><?php echo $result_user1_code['user_username_mob_meth_mobnumber']; ?></td>
                              <?php
                            }
                            else
                            {
                              ?>
                                <td></td>
                              <?php
                            }
                            
                          }
                          else
                          {
                            if(isset($result_user1_code['generate_code']))
                            {
                              ?>
                                <td><?php echo $result_user1_code['generate_code']; ?></td>
                              <?php
                            }
                            else
                            {
                              ?>
                                <td></td>
                              <?php
                            }
                            ?>
                              
                            <?php
                          }
                           ?>
                        
                        <?php 
                        }
                        ?>
                        <td><?php echo $redeem_time; ?></td>
                        <td><?php echo $spin_date; ?></td>
                        <?php if($admin_redeem_button_enable == '1')
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

                        $generate_code_hwe_hwe='';
                        if(isset($result_user1_code['generate_code']))
                        {
                          $generate_code_hwe_hwe = $result_user1_code['generate_code'];
                        }

                        if($code_sp == '1' || $mobile_number_sp == '1' || $code_with_remain_spin_sp == '1' || $email_method== '1' || $name_email_mobileno == '1' || $normal_spin_method == '1')
                        {  
                          $user_arr[$count_row] = array($reward_item,$reward_get_email,$generate_code_hwe_hwe,$redeem_time,$spin_date);
                        }
                        elseif($user_username_mobile_method == 1)
                        {  
                          $user_username_mob_meth_mobnumber='';
                          if(isset($result_user1_code['user_username_mob_meth_mobnumber']))
                          {
                            $user_username_mob_meth_mobnumber = $result_user1_code['user_username_mob_meth_mobnumber'];
                          }
                          $user_arr[$count_row] = array($user_username_mob_meth_username,$reward_item,$reward_get_email,$user_username_mob_meth_mobnumber,$redeem_time,$spin_date);
                        }
                        else
                        {
                          $user_arr[$count_row] = array($username_user,$reward_item,$reward_get_email,$redeem_time,$spin_date);
                        }


                        
                        
                        $serialize_user_arr = serialize($user_arr);

                        $count_row++;
                      
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
      <?php
                  
      echo '<ul class="page">';
    
      echo ' <a class="hwe_ul"  href="spin_results.php?page=1&s='.$search_result.'">First</a>';

      if($page_number>1)
      {
        echo '<a class="hwe_ul"  href = "spin_results.php?page=' . $page_number - 1 . '&s='.$search_result.'">' . $page_number - 1 . ' </a>';
      }

      echo '<a class = "none" href= "#" class="active">' . $page_number . ' </a>';


      if($page_number<$totoalPages)
      {
        echo '<a class="hwe_ul"   href = "spin_results.php?page=' . $page_number + 1 . '&s='.$search_result.'">' . $page_number + 1 . ' </a>';
      }
     
       echo ' <a class="hwe_ul"  href="spin_results.php?page='.($totoalPages) .'&s='.$search_result.'">Last</a>';
     
      echo '</ul>';
      ?>

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
<style>

.hwe_ul {
    margin:5px;
    padding:5px;
    background:#d9534f;
    list-style: none;
    color:white;
    vertical-align:bottom;
    text-decoration:none;
    
}
ul  a{
margin: 5px;
padding: 5px;
background: brown;
list-style: none;
color: white;
vertical-align: bottom;
text-decoration: none;
}

.fa{
  
}
</style>
</html>