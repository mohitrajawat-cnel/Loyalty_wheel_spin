<?php
session_start();
include 'config.php';

if(!isset($_SESSION['admin_user_id']))
{ ?>	
    <script>
         window.location.href='<?php echo Site_URL; ?>/login.php';
    </script>
<?php
}

$id=$_REQUEST['deleteid'];
if(isset($id) && $id !='')
{//ramkishan
  $delete ="DELETE from ".$table_prefix."top_winner where id ='".$id."'";
  mysqli_query($conn,$delete);
  ?>
   <script>
    window.location.replace('top_winner.php');
   </script>
  <?php
}



if(isset($_POST['save_top_winner']))
{
    $player_id  =  $_POST['player_id'];
    $reward  =  $_POST['reward'];
//ramkishan
    $insert ="INSERT into ".$table_prefix."top_winner SET player_id = '".$player_id."',reward ='$reward'"; 
    mysqli_query($conn,$insert);
}


if(isset($_REQUEST['update_top_winner']))
{
    $player_id  =  $_POST['player_id'];
    $reward  =  $_POST['reward'];
    $id = $_REQUEST['editid'];

    //update query
//ramkishan
    $sql = "UPDATE ".$table_prefix."top_winner SET player_id='$player_id' , reward='$reward' WHERE id=$id";
    mysqli_query($conn,$sql);
    ?>
        <script>
            window.location.replace('top_winner.php');
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
          <h6 class="font-weight-bolder mb-0">Top Winner Result List</h6>
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
                    <h6 class="text-white text-capitalize ps-3">Top Winner Code</h6>
                  </div>
                  <div class="col-md-2 col-4 text-center">
                    <button style="background-color: black;margin-top: 6px;" onclick="add_new_code_function_hwe()" class="btn btn-primary" >Add New </button>
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
              
              // For add form
              function add_new_code_function_hwe()
              {
                    jQuery('#add_new_code_form').show();
              }
              
              function add_new_code_function_hwe_close()
              {
                    jQuery('#add_new_code_form').hide();
              }
              ///

              /// For edit form
              function edit_top_winner_function_hwe(){
                jQuery('#edit_top_winner_form').show();
              }

              function edit_top_winner_function_hwe_close(){
                    jQuery('#edit_top_winner_form').hide();
              }
              ///

            </script>
            <div class="card-body px-0 pb-2">
                <div id="add_new_code_form" style="display:none; border: 1px solid;border-radius: 10px;width: 96%;margin-left: 2%;">
                    <span  onclick="add_new_code_function_hwe_close()" style="color:red;float: right;margin-right: 10px;cursor: pointer;">X</span>
                  <form method="post">
                    <div class="form-group" style="padding:10px;">
                      <input type="text" name="player_id" class="form-control" id="player_id"  placeholder="Enter Id" style="width: 30%;margin-left: 35%;border: 1px solid lightgray;">
                    </div>

                    <div class="form-group" style="padding:10px;">
                   <input type="text" name="reward" class="form-control" id="reward"  placeholder="Enter Reward" style="width: 30%;margin-left: 35%;border: 1px solid lightgray;">
                  
                 </div>

                    <div style="display:flex;justify-content:center;">
                        <button type="submit" name="save_top_winner" class="btn btn-primary">Submit</button>
                    </div>
                  </form>
              </div>

              <?php 
              if(isset($_REQUEST['itemedit']))
              {
                    $editid = $_REQUEST['editid'];//ramkishan
                    $top_winner_sql = "SELECT * FROM ".$table_prefix."top_winner where id='$editid' ";
                    $top_winner_result = $conn->query($top_winner_sql);
                           // output data of each row
                           while($row = $top_winner_result->fetch_assoc()) 
                           {
                                $id =  $row["id"];
                                $player_id = $row["player_id"];
                                $reward =  $row["reward"];
                           }

              ?>
                <div id="edit_top_winner_form" style="border: 1px solid;border-radius: 10px;width: 96%;margin-left: 2%;">
                        <span  onclick="edit_top_winner_function_hwe_close()" style="color:red;float: right;margin-right: 10px;cursor: pointer;">X</span>
                    <form method="post">
                        <div class="form-group" style="padding:10px;">
                        <input type="text" name="player_id" class="form-control" id="player_id"  placeholder="Enter Id" style="width: 30%;margin-left: 35%;border: 1px solid lightgray;" value="<?php echo $player_id; ?>">
                        </div>

                        <div class="form-group" style="padding:10px;">
                    <input type="text" name="reward" class="form-control" id="reward"  placeholder="Enter Reward" style="width: 30%;margin-left: 35%;border: 1px solid lightgray;" value="<?php echo $reward; ?>">
                    
                    </div>

                        <div style="display:flex;justify-content:center;">
                            <button type="submit" name="update_top_winner" class="btn btn-primary">Update</button>
                        </div>
                    </form>
                </div>
            <?php } ?>


              <div class="table-responsive p-0">
                <table class="table align-items-center mb-0">

                <tbody>
                    <tr class="text-center">
                      <th>#</th>
                      <th>Player Id</th>
                      <th>Reward</th>
                      <th>Action</th>
                    </tr>
				<?php
                  $no =1;//ramkishan
                  $select_user1 ="SELECT * from ".$table_prefix."top_winner";
                  $row_user1 = $conn->query($select_user1);
                  while($result_user1 = mysqli_fetch_assoc($row_user1))
                  {

                  $id  =  $result_user1['id'];
                  $player_id  =  $result_user1['player_id'];
                  $reward    =   $result_user1['reward'];

                  ?>
                      <tr class="text-center">
                        <td><?php echo $no; ?></td>
                        <td><?php echo $player_id; ?></td>
                        <td><?php echo $reward; ?></td>
                        <td>

                           <a href="../pages/top_winner.php?editid=<?php echo $id; ?>&itemedit=1" onclick="edit_top_winner_function_hwe()"><button type="button" class="btn btn-success btn-sm">Edit</button></a>

                          <!-- <button type="button" class="btn btn-success btn-sm" onclick="edit_top_winner_function_hwe(<?php echo $id ?>)">Edit</button> -->

                          <a href="../pages/top_winner.php?deleteid=<?php echo $id; ?>"><button type="button" class="btn btn-danger btn-sm">Delete</button></a>
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