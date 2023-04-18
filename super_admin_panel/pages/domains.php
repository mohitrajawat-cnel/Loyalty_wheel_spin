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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<?php

if(isset($_REQUEST['deletedm']) && $_REQUEST['deletedm'] == 1)
{
    $delete ="DELETE from domain_list_settings where id ='".$_REQUEST['id']."'";
    mysqli_query($conn,$delete);
    ?>
     <script>
      window.location.replace('domains.php');
     </script>
    <?php
}
function customFunc_hwe($dataArr = array(),$hst_hostname,$hst_port){

// Send POST query via cURL
$postdata = http_build_query($dataArr);
$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, 'https://' . $hst_hostname . ':' . $hst_port . '/api/');
curl_setopt($curl, CURLOPT_RETURNTRANSFER,true);
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_POSTFIELDS, $postdata);
  $answer = curl_exec($curl);
  return $answer;
}
function customFunc_hwe_hwe($dataArr = array()){
  $answer="";
  $hst_hostname = "happywheelspin.com";
  $hst_port = "8083";
  $postdata = http_build_query($dataArr);
  $curl = curl_init();
  curl_setopt($curl, CURLOPT_URL, "https://" . $hst_hostname . ':' . $hst_port . "/api/");
  curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
  curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
  curl_setopt($curl, CURLOPT_POST, true);
  curl_setopt($curl, CURLOPT_POSTFIELDS, $postdata);
  $answer = curl_exec($curl);
  return $answer;
}

if(isset($_POST['save_domain_data']))
{
    $domain_name = $_POST['domain_name'];
    $domain_status  =  $_POST['domain_status'];

    $domain_type  =  $_POST['domain_type'];


    if($domain_type == 2)
    {
        $domain_name =$domain_name;

        $dateTime = date('Y-m-d H:i:s', strtotime("NOW"));

        $table_pre = 'zgx_'.rand(10, 999);

        $table_prefix = $table_pre."_";

        $table_prefix_wheel = $table_pre;

        $hst_hostname = "happywheelspin.com";
        $hst_port = "8083";
        $hst_username = "admin";
        $hst_password = "96Pb1YsXfAFGeJ2KyERdzqMZtCajLV";
        $hst_returncode = "yes";
        $hst_cmd = "v-add-web-domain";
        $username = "admin";
        $domain = $domain_name;
        $postvars = array(
            "user" => $hst_username,
            "password" => $hst_password,
            'returncode' => $hst_returncode,
            "cmd" => $hst_cmd,
            "arg1" => $username,
            "arg2" => $domain
        );
        $answer = customFunc_hwe_hwe($postvars);
        if($answer === "0") {
            $postvars["cmd"] = "v-change-web-domain-dirlist";
            $postvars["arg3"] = "on";
            $checkboxEnabled = customFunc_hwe_hwe($postvars);
            if($checkboxEnabled === "0") {
                $postvars["cmd"] = "v-change-web-domain-docroot";
                $postvars["arg3"] = "jgdx.xyz";
                ?>
                <script>
                    var domainDirData = <?php echo json_encode($postvars); ?>;
                    const $ = jQuery;
                    let ip = "185.201.9.152";
                    $(document).ready(function(){
                        $("#modal_overlay").show();
                    });
                    $.ajax({
                        url: "https://jgdx.xyz/super_admin_panel/pages/ajax.php",
                        ip: "185.201.9.152",
                        type: "POST",
                        data: { dirData: domainDirData, domain_root_condition: "set_domain_dir" },
                        dataType:"JSON",
                        success: function(response){
                            if(response.result === "0") {
                            }
                        }
                    });
                    $.ajax({
                        url: "https://jgdx.xyz/super_admin_panel/pages/ajax.php",
                        ip: "185.201.9.152",
                        data: {
                            create_database_tables: "create tables",
                            domain_name: "<?php echo $domain; ?>",
                            domain_status: "<?php echo $domain_status; ?>",
                            table_prefix : "<?php echo $table_prefix; ?>"
                        },
                        type: "POST",
                        dataType: "JSON",
                        success: function(response){
                            $("#modal_overlay").hide();
                            if(response.result1 === "success"){
                                alert("Domain Created Succesfully.");
                                $("#domainTable tbody").html(response.data);
                            } else{
                                alert(response.result1);
                            }
                        }
                    });

                    var hst_hostname = '<?php echo $hst_hostname; ?>';
                    var hst_port = '<?php echo $hst_port; ?>';
                    var hst_username = '<?php echo $hst_username; ?>';
                    var hst_password = '<?php echo $hst_password; ?>';
                    var hst_returncode = '<?php echo $hst_returncode; ?>';
                    var username = '<?php echo $username; ?>';
                    var domain_name = '<?php echo $domain; ?>';
                    var table_prefix = '<?php echo $table_prefix_wheel; ?>';

                  jQuery.ajax({
                                type: "POST",
                                url: "custom_domains.php",
                                data: { 
                                  domain_root_set : 'domain_root_set',
                                  hst_hostname:hst_hostname,
                                  hst_port:hst_port,
                                  hst_username : hst_username,
                                  hst_password : hst_password,
                                  hst_returncode:hst_returncode,
                                  username:username,
                                  domain_name:domain_name,
                                  table_prefix: table_prefix
                                
                                },
                                success:function(){

                                }
                            });
                           

                  setTimeout(function(){
                   
                      window.location.replace('domains.php');
                    },20000);
          
      

              </script>
            <?php
            
            }
        } elseif($answer === '4'){
            echo '<script>alert("Domain Already Exist!")</script>';
        }
    }
    else
    {

      $domain_prefix=15;
      $table_prefix = bin2hex(random_bytes($domain_prefix));

      $save_table_prefix = $table_prefix.'_';

      $num_key = 11;
      $api_key = bin2hex(random_bytes($num_key));
    

      $insert = "INSERT into domain_list_settings SET domain_name = '".$domain_name."',
      status ='".$domain_status."', created=now(),table_prefix='".$save_table_prefix."',api_key='".$api_key."'"; 
      mysqli_query($conn,$insert);

      $hst_hostname = 'happywheelspin.com';
      $hst_port = '8083';
      
      // Server credentials
      $hst_username = 'admin';
      $hst_password = '96Pb1YsXfAFGeJ2KyERdzqMZtCajLV';
      $hst_returncode = 'yes';
      $username = 'admin';
      $domain = $domain_name;

      //add dns record
    //   $cmd_add_domain_dns_record = 'v-add-dns-record';
    //   $postvars_add_domain_dns_record = array(
    //       'user' => $hst_username,
    //       'password' => $hst_password,
    //       'returncode' => $hst_returncode,
    //       'cmd' => $cmd_add_domain_dns_record,
    //       'arg1' => $username,
    //       'arg2' => $domain,
    //       'arg3' => 'www',
    //       'arg4' => 'A',
    //       'arg5' =>'185.201.9.152'

    //   );
    // $add_domain_dns_record_reponse = customFunc_hwe($postvars_add_domain_dns_record,$hst_hostname,$hst_port,);

      //add domain
      $cmd_add_domain = 'v-add-web-domain';
      $postvars_add_domain = array(
          'user' => $hst_username,
          'password' => $hst_password,
          'returncode' => $hst_returncode,
          'cmd' => $cmd_add_domain,
          'arg1' => $username,
          'arg2' => $domain

      );

      $add_domain_reponse = customFunc_hwe($postvars_add_domain,$hst_hostname,$hst_port);

      if($add_domain_reponse == 0)
      {
      


        $hst_command_change_dirlist = 'v-change-web-domain-dirlist';
          // Prepare POST query
          $postvars_change_dirlist = array(
              'user' => $hst_username,
              'password' => $hst_password,
              'returncode' => $hst_returncode,
              'cmd' => $hst_command_change_dirlist,
              'arg1' => $username,
              'arg2' => $domain,
              'arg3' => 'on',

          );

          $change_domain_dirlist_reponse = customFunc_hwe($postvars_change_dirlist,$hst_hostname,$hst_port);

          if($change_domain_dirlist_reponse == 0)
          {
          //change dopmain root
            ?>
              <script>
      
                var hst_hostname = '<?php echo $hst_hostname; ?>';
                var hst_port = '<?php echo $hst_port; ?>';
                var hst_username = '<?php echo $hst_username; ?>';
                var hst_password = '<?php echo $hst_password; ?>';
                var hst_returncode = '<?php echo $hst_returncode; ?>';
                var username = '<?php echo $username; ?>';
                var domain_name = '<?php echo $domain; ?>';
                var table_prefix = '<?php echo $table_prefix; ?>';

                  jQuery.ajax({
                                type: "POST",
                                url: "custom_domains.php",
                                data: { 
                                  domain_root_set : 'domain_root_set',
                                  hst_hostname:hst_hostname,
                                  hst_port:hst_port,
                                  hst_username : hst_username,
                                  hst_password : hst_password,
                                  hst_returncode:hst_returncode,
                                  username:username,
                                  domain_name:domain_name,
                                  table_prefix: table_prefix
                                
                                },
                                success:function(data)
                                {
                                  alert("fgsdf");
                                  //   jQuery.ajax({
                                  //   type: "POST",
                                  //   url: "custom_domains.php",
                                  //   data: { 
                                  //     create_database_tables : 'create_database_tables',
                                  //     domain_name:domain_name,
                                  //     table_prefix: table_prefix
                                    
                                  //   },
                                  //   success:function(result)
                                  //   {
                                    
                                  //       //alert("mohit");

                                  //   }
                                  // });

                                }
                        });
              
                
              </script>
            <?php
            
          }
      }
      

      ?>
        <script>
          // setTimeout(function(){
          //   alert("mohit");
          //   window.location.replace('domains.php');
          // },10000);
          
        </script>
      <?php

  }
    
    
}
 // Server credentials
//  $hst_hostname = 'happywheelspin.com';
//  $hst_port = '8083';
//  $hst_username = 'admin';
//  $hst_password = '96Pb1YsXfAFGeJ2KyERdzqMZtCajLV';
//  $hst_returncode = 'no';
//  $username = 'admin';
// $cmd_add_domain1 = 'v-add-web-domain-ssl';
// $postvars_add_domain2 = array(
//     'user' => $hst_username,
//     'password' => $hst_password,
//     'returncode' => $hst_returncode,
//     'cmd' => $cmd_add_domain1,
//     'arg1' => $username,
//     'arg2' => 'testing123.jgdx.xyz',
//     'arg3' => '/home/web/testing123.jgdx.xyz/pun'

// );
// $cmd_add_domain1 = 'v-add-web-domain-ssl-force';
// $postvars_add_domain2 = array(
//     'user' => $hst_username,
//     'password' => $hst_password,
//     'returncode' => $hst_returncode,
//     'cmd' => $cmd_add_domain1,
//     'arg1' => $username,
//     'arg2' => 'testing123.jgdx.xyz'

// );

// $add_domain_reponse2 = customFunc_hwe($postvars_add_domain2,$hst_hostname,$hst_port);
// print_r($add_domain_reponse2);
// die("fdgsdf");
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
         <a href="../pages/domains.php">
          <h6 class="font-weight-bolder mb-0">Domain List</h6>
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
                  <div class="col-md-9 col-6 pt-2">
                    <h6 class="text-white text-capitalize ps-3">List</h6>
                  </div>
                  <div class="col-md-3 col-4 text-center">
                    <button style="background-color: black;margin-top: 6px;" onclick="add_new_code_function_hwe()" class="btn btn-primary">Add New Domain</button>
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
                  <form method="post" action="">
                    <div class="form-group" style="padding:10px;">                   
                      <input type="text" name="domain_name" class="form-control" placeholder="Enter Domain Name" required style="width: 30%;margin-left: 35%;border: 1px solid lightgray;padding-left: 10px;">
                    </div>
                    <div class="form-group" style="padding:10px;">
                         <select id="normal_spin_check" class="form-control" name="domain_status" style="width: 30%;margin-left: 35%;border: 1px solid lightgray; padding-left: 10px;">
                            <option value="1">Active</option>
                            <option value="0">Deactive</option>
                          </select>
                    </div>
                    <div class="form-group" style="padding:10px;">
                         <select id="domain_type" class="form-control" name="domain_type" style="width: 30%;margin-left: 35%;border: 1px solid lightgray; padding-left: 10px;" required>
                            <option value="">Please Select Game Type</option>
                            <option value="1">Lucky Wheel</option>
                            <option value="2">Plinko</option>
                          </select>
                          
                    </div>
                                        
                    <div style="display:flex;justify-content:center;">
                        <button type="submit" name="save_domain_data" class="btn btn-primary">Submit</button>
                    </div>
                  </form>
              </div>
              <div class="table-responsive p-0">
                <table class="table align-items-center mb-0">

                <tbody>
                    <tr class="text-center">
                      <th>#</th>
                      <th>Domain</th>
                      <th>Status</th>
                      <th>Action</th>
                 
                    </tr>
				<?php
                  $no =1;
                  $select_domain ="SELECT * from domain_list_settings";
                  $row_domain = $conn->query($select_domain);
                  while($result_domain = mysqli_fetch_assoc($row_domain))
                  {
                      $id    =   $result_domain['id'];
                      $status    =   $result_domain['status'];
                      $domain_name    =   $result_domain['domain_name'];
                      if($status == '1')
                      {
                          $code_status = 'Active';
                      }
                      else
                      {
                          $code_status = 'Not Active';
                      }
                
                  ?>
                      <tr class="text-center">                      
                          <td><?php echo $no; ?></td>
                          <td><a href="https://<?php echo $domain_name; ?>" target="blank" ><?php echo $domain_name; ?></a></td>
                          <td><?php echo $code_status; ?></td>
                          <td>
                            <a href="../pages/function_settings.php?id=<?php echo $id; ?>"><button type="button" class="btn btn-success btn-sm">Function Settings</button></a>
                            <a href="../pages/domains.php?id=<?php echo $id; ?>&deletedm=1"><button type="button" class="btn btn-danger btn-sm">Delete</button></a>
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