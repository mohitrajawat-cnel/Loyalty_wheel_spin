<?php
session_start();
include 'admin_panel/pages/config.php';

// Date in the past

header("Expires:".date("l, G M Y h:i:s")." GMT");
header("Expires:".date("l, G M Y h:i:s"));
header("Cache-Control: no-cache");
header("Pragma: no-cache");

$user_id_session = '';
if($code_sp == '1' || $mobile_number_sp == '1' || $code_with_remain_spin_sp == '1' || $email_method== '1' || $name_email_mobileno == '1')
{
    $user_id =1;
    $spain_code =0;
    if(isset($_SESSION['spain_code']))
    {
        $spain_code = 1;
    }
    else
    {
        $spain_code = 1;
    }
}
else
{
    $spain_code =1;
    $user_id =0;
    if(isset($_SESSION['user_id']))
    {
        $user_id = 1;
        $user_id_session = $_SESSION['user_id'];
    }
    else
    {
        $user_id = 1;
    }
}

if(isset($_REQUEST['ifreame']) && (isset($_REQUEST['ifuser_id']) && $_REQUEST['ifuser_id'] != ''))
{
    $user_id = 1;
    $_SESSION['user_id'] = $_REQUEST['ifuser_id'];
    $user_id_session = $_REQUEST['ifuser_id'];
}
?>
<style>
body
{
    background-color: rebeccapurple !important;
    background-size: cover;
    color: #fff !important;
}
    </style>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" />
        <title><?php echo $site_title_hwe; ?></title>
    

        <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap4.min.css">

        <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    
        <link rel="stylesheet" href="customn_library/bootstrap.min.css">
        <!-- <script src="customn_library/bootstrap.bundle.min.js"></script> -->

        <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>

        <!-- <script src="customn_library/bootstrap.bundle.min.js"> -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

        
        
    </head>
    <body>
        <table class="table table-striped table-responsive" id="example" style="width:100%" >
                      
            <thead>
                <tr class="text-center">
                    <th>#</th>
                    <th>Username</th>
                    <th>Reward Name</th>
                    <th>Redeem Reward Get Email</th>
                    <th>Reward Redeem Points</th>
                    <th>Reward Redeem Date</th>
                
                </tr>
            </thead>
            <tbody>
                  <?php
                
                  $select_user ="SELECT * from ".$table_prefix."share_redeem_reward_results where user_id='$user_id_session'";
                 
                  $row_user = $conn->query($select_user);
                  $no =1;

                  while($result_user = mysqli_fetch_assoc($row_user))
                  {
                    

                    $user_id_hwe    =   $result_user['user_id'];
                    $share_redeem_reward_id    =   $result_user['share_redeem_reward_id'];
                    $number_of_redeem_points    =   $result_user['number_of_redeem_points'];
                    $redeem_reward_email    =   $result_user['redeem_reward_email'];
                    $share_reward_redeem_date    =   $result_user['share_reward_redeem_date'];
                    $share_reward_redeem_date    =   strtotime($result_user['share_reward_redeem_date']);
                    $spin_date = date("d-m-Y H:i:s",$share_reward_redeem_date);
                   
                    $select_user1 ="SELECT * from ".$table_prefix."user_table where id='".$user_id_hwe."'";
                    $row_user1 = $conn->query($select_user1);
                    $result_user1 = mysqli_fetch_assoc($row_user1);
                    $username_user='';
                    if(mysqli_num_rows($row_user1) > 0)
                    {
                      $username_user    =   $result_user1['username'];
                    }
                    


                    $select_user1_redeem ="SELECT * from ".$table_prefix."reward_redeem_share where id='".$share_redeem_reward_id."'";
                    $row_user1_redeem = $conn->query($select_user1_redeem);
                    $result_user1_redeem = mysqli_fetch_assoc($row_user1_redeem);

                    $title_reward    =   $result_user1_redeem['title'];

                    
                    
                    ?>
          
                      <tr class="text-center">
                      
                        <td><?php echo $no; ?></td>
                        <td><?php echo $username_user; ?></td>
                        <td><?php echo $title_reward; ?></td>
                        <td><?php echo $redeem_reward_email; ?></td>
                        <td><?php echo $number_of_redeem_points; ?></td>
                        <td><?php echo $spin_date; ?></td>
                        <?php
                        
                        ?>
                      </tr>
                    <?php

                        $no++;

                      
                  }
                  ?>


                    </tbody>
        </table>

        <?php
          include 'site_front_menu.php';
        ?>

    </body>

</html>
<script>
        jQuery(document).ready(function () {
            jQuery('#example').DataTable();
        });
</script>
<style>
.menu_site
{
  height: 30px;
}
.img_set
{
  width: 57px !important;
  margin-top: -6px;
}
</style>
              
                