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
   $delete ="UPDATE phonenogenerate SET status='0' where id ='".$id."'";
   // $delete =  "DELETE FROM phonenogenerate WHERE id=$id";
  
  mysqli_query($conn,$delete);
  ?>
   <script>
    window.location.replace('generatephoneno.php');
   </script>
  <?php
}


if(isset($_POST['save_generate_code']))
{
    $generate_mobilenum =  $_POST['generated_code'];
    $check_normal_spin  =  $_POST['normal_spin_check'];
    $show_reward_value  =  $_POST['get_all_rewards_value'];

    $insert ="INSERT into phonenogenerate SET generate_code = '".$generate_mobilenum."',
    status ='0',
    created=now()"; 
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
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  
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
                  <div class="col-md-10 col-6 pt-2">
                    <h6 class="text-white text-capitalize ps-3">Spin user Code</h6>
                  </div>
                  <!--<div class="col-md-2 col-4 text-center">-->
                  <!--  <button style="background-color: black;margin-top: 6px;" onclick="add_new_code_function_hwe()" class="btn btn-primary">Add New Code</button>-->
                  <!--</div>-->
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
                    <div class="form-group" style="padding:10px;">
                         <select id="normal_spin_check" class="form-control" name="normal_spin_check" style="width: 30%;margin-left: 35%;border: 1px solid lightgray;">
                            <option value="0" >Normal Spin</option>
                            <option value="1"  >Get Reward Spin</option>
                          </select>
                    </div>
                    <div class="form-group" style="padding:10px;">
                         <select id="get_all_rewards_value" class="form-control" name="get_all_rewards_value" style="width: 30%;margin-left: 35%;border: 1px solid lightgray;">
                             <option value="" >Select Reward</option>
                             <?php
                                 $selcte_reward_list  = "SELECT * from wheel_data";
                                 $row_reward = $conn->query($selcte_reward_list);
                              
                                 while($result_reward = mysqli_fetch_assoc($row_reward))
                                 {
                                    $all_data_show = json_decode($result_reward['spin_data'],true);
                                  
                                    $total_slice = $all_data_show['slice'];
                                  
                                    for($i=0; $i<$total_slice; $i++)
                                    {
                                        $showing_reward_list = $all_data_show['prize'.$i];
                                       
                                        ?>
                                            <option value="<?php echo $i; ?>" ><?php echo $showing_reward_list; ?></option>
                                        <?php
                                    }
                                 }
                             ?>
                      
                          </select>
                    </div>
                    <div style="display:flex;justify-content:center;">
                        <button type="submit" name="save_generate_code" class="btn btn-primary">Submit</button>
                    </div>
                  </form>
              </div>
              <div class="table-responsive p-0">
                <table class="table-responsive" id="myTable">
            <thead>
                
                    <tr class="text-center">
                      <th>#</th>
                      <th>User Mobile No.</th>
                      <th>Status</th>
                      <th>Options</th>
                 
                    </tr>
                    </thead>
                    <tbody>
				<?php

                // $select_user ="SELECT * from spin_result where 1=1 ";

                // if(isset($_REQUEST['searchuser']))
                // {
                //     $select_user .= " AND user_email LIKE '%".$_REQUEST["s"]."%' 
                //                       OR reward_item LIKE '%".$_REQUEST["s"]."%'  
                //                       OR win_rate LIKE '%".$_REQUEST["s"]."%'";
                // }

                

                // $row_user = $conn->query($select_user);
                // $no =1;
                // while($result_user = mysqli_fetch_assoc($row_user))
                // {
                 // $user_id_hwe    =   $result_user['user_id'];

                  $no =1;
                  $select_user1 ="SELECT * from phonenogenerate";
                  $row_user1 = $conn->query($select_user1);
                  while($result_user1 = mysqli_fetch_assoc($row_user1))
                  {

                  $get_phone_key    =   $result_user1['generate_code'];
                  $id    =   $result_user1['id'];
                  $status    =   $result_user1['status'];
                  if($status == '1')
                  {
                    $code_status = 'Used';
                  }
                  else{
                    $code_status = 'Not Used';
                  }

                
                  ?>
                      <tr class="text-center">
                      
                        <td><?php echo $no; ?></td>
                        <td><?php echo $get_phone_key; ?></td>
                        <td><?php echo $code_status; ?></td>
                        <td>

                          <!-- <a href="../pages/viewuser.php?id=<?php //echo $id; ?>"><button type="button" class="btn btn-primary btn-sm">View</button></a> -->

                          <!-- <a href="../pages/editusercode.php?id=<?php echo $id; ?>"><button type="button" class="btn btn-dark btn-sm">Edit</button></a> -->
                        <?php
                        
                            if($_SERVER['HTTP_HOST'] =='wgc33.vip')
                            {
                                $del_btn_text = "Reset";
                            }
                            else{
                                $del_btn_text = "Delete";
                            }
                            
                        ?>
                         <!-- <a href="../pages/generatephoneno.php?id=<?php echo $id; ?>"><button type="button" class="btn btn-danger btn-sm">Delete</button></a> -->

                         <a href="../pages/generatephoneno.php?id=<?php echo $id; ?>"><button type="button" class="btn btn-danger btn-sm"> <?php echo $del_btn_text; ?> </button></a>
                           
                        
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