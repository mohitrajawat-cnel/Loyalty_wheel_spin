<?php
session_start();
include 'config.php';

// Include database configuration file
require_once 'dbConfig.php';
// Include URL Shortener library file
require_once 'Shortener.class.php';

// Initialize Shortener class and pass PDO object
$shortener = new Shortener($db);

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
  //ramkishan
  $delete ="DELETE from ".$table_prefix."codegenerate where id ='".$id."'";
  mysqli_query($conn,$delete);
   //ramkishan
  $delete_code_spin_results ="DELETE from ".$table_prefix."spin_result where spin_code ='".$id."'";
  mysqli_query($conn,$delete_code_spin_results);
  ?>
   <script>
    window.location.replace('generatecode.php');
   </script>
  <?php
}
//$sms_message = $sms_function_text1.' Your Reward Code is <b>'.$generate_code.'</b> '.Front_URL.'. '.$sms_function_text2;

//   preg_match_all('/[0-9]{3}[\-][0-9]{6}|[0-9]{3}[\s][0-9]{6}|[0-9]{3}[\s][0-9]{3}[\s][0-9]{4}|[0-9]{9}|[0-9]{3}[\-][0-9]{3}[\-][0-9]{4}/', $sms_message, $matches_mobile);
// $matches_mobile_hwe = $matches_mobile[0];

// foreach($matches_mobile_hwe as $matches_mobile_hwe_hwe)
//  {

//   $mobile_number = $matches_mobile_hwe_hwe;

//   $sms_message = str_replace('+6'.$mobile_number,'<a href="tel:6'.$mobile_number.'" target="_blank">+6'.$mobile_number.'</a>',$sms_message);
 
//  }
 
  //preg_match_all('#\bhttps?://[^,\s()<>]+(?:\([\w\d]+\)|([^,[:punct:]\s]|/))#', $sms_message, $match);

 // $all_urls = $match[0];


  // print_r($all_urls);


//  foreach($all_urls as $all_urls_hwe)
//  {
//       $longURL = $all_urls_hwe;

//       $shortURL_Prefix = 'asiaz.xyz/';

//       try{
//           // Get short code of the URL
//           $shortCode = $shortener->urlToShortCode($longURL);
          
//           // Create short URL
//           $shortURL = $shortURL_Prefix.$shortCode;
//           $links = '<a href="'.$shortCode.'" target="_blank">'.$shortURL.'</a>';
     
//           //$links = html_entity_decode($links);

//           $sms_message = str_replace($longURL,$links,$sms_message);
//           //$sms_message = preg_replace('/<span[^>]+\>/i', '', $sms_message);
      
//           $shortURL = $shortURL_Prefix;
//       }catch(Exception $e){
//           // Display error
//           echo $e->getMessage();
//       }
//  }

//  $sms_message =  preg_replace('/\s+/','',htmlspecialchars($sms_message));
//   $sms_message1 = htmlspecialchars($sms_message);
// $sms_message = html_entity_decode($sms_message,ENT_COMPAT,'UTF-8');

if(isset($_POST['save_generate_code']))
{
    $generate_code  =  $_POST['generated_code'];
    $check_normal_spin  =  $_POST['normal_spin_check'];
    $show_reward_value  =  $_POST['get_all_rewards_value'];

    $use_mobile_num_sms='';
    if(isset($_POST['mobile_num_for_sms']) && $_POST['mobile_num_for_sms'] !='')
    {
      $mobile_num_for_sms  =  $_POST['mobile_num_for_sms'];
      $use_mobile_num_sms = 'mobile_num_for_sms ='.$mobile_num_for_sms.',';
    }
    
    
    
    $remain_spin_for_code ='';
    if(isset($_POST['remain_spin_generate_code']) && $_POST['remain_spin_generate_code'] !='')
    {
         $remain_spin_for_code  =  $_POST['remain_spin_generate_code'];
        
    }
    else
    {
      $remain_spin_for_code  =1;
    }

    $use_code_method_reamin_spin = 'remain_spin_for_code ='.$remain_spin_for_code.',';
   
//ramkishan
    $select_user1_hwe ="SELECT * from ".$table_prefix."codegenerate where generate_code = '".$generate_code."'";
    $row_user1_hwe = $conn->query($select_user1_hwe);

    if(mysqli_num_rows($row_user1_hwe) <= 0)
    {
//ramkishan


    
         $insert ="INSERT into ".$table_prefix."codegenerate SET generate_code = '".$generate_code."',
          ".$use_code_method_reamin_spin.$use_mobile_num_sms."
          status ='0',
          check_normal_spin ='$check_normal_spin',
          show_reward_value ='$show_reward_value',
          created=now()"; 


          mysqli_query($conn,$insert);

          // header('MIME-Version: 1.0' . "\r\n");
          // header('Content-type: text/html; charset=iso-8859-1' . "\r\n");

         
          $sms_message = str_replace('[CODE]',$generate_code,$sms_message_data);



          if(isset($_POST['mobile_num_for_sms']) && $_POST['mobile_num_for_sms'] !='')
          {
            //send sms on mobile number

        

  

            class bulk360{
              var $user   = '';
              var $pass   = '';
              var $from   = '60109503939';
              var $to;
              var $text;

              var $url    = 'https://sms.360.my/gw/bulk360/v3_0/send.php';

              function __construct() {
                  $this->user = urlencode($this->user);
                  $this->pass = urlencode($this->pass);

                  $this->url = $this->url . "?from=$this->from&detail=1";
              }

              function sendsms($to, $text,$firebase_key,$firebase_password) {
                  $this->url = $this->url . "&to=".$to."&text=".urlencode($text)."&user=".$firebase_key."&pass=".$firebase_password;

                  $ch = curl_init();
                  curl_setopt($ch, CURLOPT_URL, $this->url);
                  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                  curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
                  curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
                  $sentResult = curl_exec($ch);
                  
                  if ($sentResult == FALSE) {
                      echo 'Curl failed for sending sms to crm.. '.curl_error($ch);
                  }
                  else
                  {
                    //echo $text;
                    $sms_data =  json_decode($sentResult,true);
                    $sms_data_desc = $sms_data['desc'];
                    ?>
                      <script>
                            var sms_desc = '<?php echo $sms_data_desc; ?>';
                            alert(sms_desc);
                        </script>
                    <?php
                  }
                  curl_close($ch);

                // echo 'sentResult = ' . $sentResult;
              }
            }

            $sms = new bulk360();
            $response = $sms->sendsms($mobile_num_for_sms,$sms_message,$firebase_key,$firebase_password);
         
          }

    }
    else
    {
       echo '<script>
       alert("Code Already Exists.");
       </script>
       ';
    }
    
}

if(isset($_POST['import_users_code']))
{

  $filename=$_FILES['import_users_file']['name'];
  $tmpname=$_FILES['import_users_file']['tmp_name'];
  $upload = dirname(__FILE__).'/excel_data/'.basename($filename);

  move_uploaded_file($tmpname,$upload);


  $handle = fopen($upload, 'r');

  if (($handle = fopen($upload, "r")) !== FALSE) 
  {
    
    $all_data=array();
    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
      $user_data_array = array();
      

      $row++;
      $user_data_array['User_Code'] =$data[0];
      $user_data_array['Spin_Type'] =$data[1];
      $user_data_array['Reward_Id'] =$data[2];

      $all_data[] = $user_data_array;
    }

    fclose($handle);

    $User_Code = 0;
    $Spin_Type=0;
    $Reward_Id='';
    foreach($all_data as $key => $all_data_hwe)
    {
        if($key == '0')
        {
          continue;
        }
        $User_Code = $all_data_hwe['User_Code'];
        $Spin_Type = $all_data_hwe['Spin_Type'];
        $Reward_Id = $all_data_hwe['Reward_Id'];

        $select_user1_hwe ="SELECT * from ".$table_prefix."codegenerate where generate_code ='".$User_Code."'";
        $row_user1_hwe = $conn->query($select_user1_hwe);

          if(mysqli_num_rows($row_user1_hwe) <= 0)
          {
              $insert ="INSERT into ".$table_prefix."codegenerate SET generate_code = '".$User_Code."',
                status ='0',
                check_normal_spin ='$Spin_Type',
                show_reward_value ='$Reward_Id',
                created=now()"; 

                if(mysqli_query($conn,$insert))
                {
                  echo '<div style="text-align:center;">Code Imported Successfully</div>';
                }
          }
        else
        {
              $update ="UPDATE ".$table_prefix."codegenerate SET generate_code = '".$User_Code."',
              check_normal_spin ='$Spin_Type',
              show_reward_value ='$Reward_Id',
              created=now() where generate_code = '".$User_Code."'"; 

              if(mysqli_query($conn,$update))
              {
                echo '<div style="text-align:center;">Code Updated Successfully</div>';
              }
        }

    }
  }


}
$export_data_hwe=array();
if(isset($_POST["download_blank_file"])){

  
         
  $filename = 'user_code_import_file.csv';
  $export_data_hwe[] = array('User Code','Spin type','Reward ID');

  // file creation
  $file = fopen($filename,"w");

  foreach ($export_data_hwe as $line){
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
                  <div class="col-md-2 col-4 text-center">
                    <button style="background-color: black;margin-top: 6px;" onclick="add_new_code_function_hwe()" class="btn btn-primary">Add New Code</button>
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
                    
                    <?php
                    if($code_with_remain_spin_sp == '1')
                    {
                        ?>
                           <div class="form-group" style="padding:10px;">
                   
                              <input type="text" name="remain_spin_generate_code" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Remain Spin" required style="width: 30%;margin-left: 35%;border: 1px solid lightgray;">
                             
                            </div>
                      <?php
                    }
                    ?>
                    
                    <div class="form-group" style="padding:10px;">
                         <select id="normal_spin_check" class="form-control" name="normal_spin_check" style="width: 30%;margin-left: 35%;border: 1px solid lightgray;">
                            <option value="0" >Normal Spin</option>
                            <option value="1"  >Get Reward Spin</option>
                          </select>
                    </div>
                    <div class="form-group" style="padding:10px;">
                         <select id="get_all_rewards_value" class="form-control" name="get_all_rewards_value" style="width: 30%;margin-left: 35%;border: 1px solid lightgray;">
                             <option value="" >Select Reward</option>
                             <?php //ramkishan
                                 $selcte_reward_list  = "SELECT * from ".$table_prefix."wheel_data";
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
                    <?php
                    if($sms_function == '1')
                    {
                        ?>
                           <div class="form-group" style="padding:10px;">
                 
                           <input type="hidden" name="links_send" class="form-control" id="links_send" aria-describedby="emailHelp" placeholder="Enter Mobile Number" required style="width: 30%;margin-left: 35%;border: 1px solid lightgray;">
                              <input type="text" name="mobile_num_for_sms" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Mobile Number" required style="width: 30%;margin-left: 35%;border: 1px solid lightgray;">
                             
                            </div>
                      <?php
                    }
                    ?>
                    <div style="display:flex;justify-content:center;">
                        <button type="submit" name="save_generate_code" class="btn btn-primary">Submit</button>
                    </div>
                  </form>
              </div>
              <form method="post" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-md-6 col-6 text-center">

                        <input type="file" name="import_users_file">
                        <button type="submit" name="import_users_code" class="btn btn-dark">Import User Code</button>
                    </div>
                    <div class="col-md-6 col-6 text-center">
                        <button style="float:right;margin-right: 10px;" type="submit" name="download_blank_file" class="btn btn-dark">Download File</button>
                    </div>
                </div>
              </form>
              <div class="table-responsive p-0">
                <table class="table align-items-center mb-0">

                <tbody>
                    <tr class="text-center">
                      <th>#</th>
                      <th>User Code</th>
                      <th>Status</th>
                      <th>Options</th>
                 
                    </tr>
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

                  $no =1;//ramkishan
                  $select_user1 ="SELECT * from ".$table_prefix."codegenerate";
                  $row_user1 = $conn->query($select_user1);
                  while($result_user1 = mysqli_fetch_assoc($row_user1))
                  {

                  $generate_code1    =   $result_user1['generate_code'];
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
                        <td><?php echo $generate_code1; ?></td>
                        <td><?php echo $code_status; ?></td>
                        <td>

                          <!-- <a href="../pages/viewuser.php?id=<?php //echo $id; ?>"><button type="button" class="btn btn-primary btn-sm">View</button></a> -->

                          <!-- <a href="../pages/editusercode.php?id=<?php echo $id; ?>"><button type="button" class="btn btn-dark btn-sm">Edit</button></a> -->

                          <a href="../pages/generatecode.php?id=<?php echo $id; ?>" onClick="if(!confirm('Are you sure you want to delete spin result with user code!')){return false;}"><button type="button" class="btn btn-danger btn-sm">Delete</button></a>
                           <?php
                            if($code_with_remain_spin_sp == '1')
                            {
                                ?>
                          
                                <a href="../pages/update_code_function_reamin_spin.php?code_id=<?php echo $id; ?>"><button type="button" class="btn btn-dark btn-sm">Edit</button></a>
  
                                <?php
                            
                            }
                            
                            ?>
                          

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