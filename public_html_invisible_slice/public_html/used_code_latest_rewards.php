<?php
session_start();
include 'admin_panel/pages/config.php';

// Date in the past

header("Expires:".date("l, G M Y h:i:s")." GMT");
header("Expires:".date("l, G M Y h:i:s"));
header("Cache-Control: no-cache");
header("Pragma: no-cache");


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


        
        
    </head>
    <body>
        <table class="table table-striped table-responsive" id="example" style="width:100%" >
                      
            <thead>
                      <tr class="text-center">
                        <th>#</th>
                        <?php 
                        if($code_sp == '1' || $mobile_number_sp == '1' || $code_with_remain_spin_sp == '1' || $email_method== '1' || $name_email_mobileno == '1')
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
                        <?php if($code_sp == '1' || $mobile_number_sp == '1' || $code_with_remain_spin_sp == '1' || $email_method== '1' || $name_email_mobileno == '1')
                        { 
                          if($mobile_number_sp == '1')
                          {
                              $column_code = 'Mobile Number';
                          }
                          else if($email_method == '1')
                          {
                            $column_code = 'Email';
                          }
                          else if($name_email_mobileno == '1')
                          {
                            $column_code = 'User Email';
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
                        <?php if($admin_redeem_button_enable == '1' && $user_login_sp != '1')
                        { 
                        ?>
                        <?php
                        }
                        ?>
                      </tr>
            </thead>
            <tbody>
                <?php
                $code = base64_decode($_REQUEST['code']);
                $select="select * from ".$table_prefix."codegenerate where generate_code='$code'";
                $query=mysqli_query($conn,$select);
                while($result = mysqli_fetch_assoc($query))
                {
                    $code_id = $result['id'];
                }

                  $select_user ="SELECT * from ".$table_prefix."spin_result where 1=1 && result_visible_status='1' && spin_code='".$code_id."'";
               
                  if(isset($_REQUEST['searchuser']))
                  {
                   
                              
                        $select_user .= " AND user_email LIKE '%".$_REQUEST["s"]."%'; 
                        OR datetime LIKE '%".$_REQUEST["s"]."%'  
                        OR redeem_time LIKE '%".$_REQUEST["s"]."%'"; 
                  }
                  
                  $select_user .= " ORDER BY created DESC";

                  $row_user = $conn->query($select_user);
                  $no =1;

                  $count_row =1;
                  $user_arr=array();
                  if($code_sp == '1' || $mobile_number_sp == '1' || $code_with_remain_spin_sp == '1' || $email_method== '1' || $name_email_mobileno == '1')
                  {
                    $user_arr[0] = array('Reward Name','Reward Get Email',$column_code,'Redeem Date','Spin Date');
                  }
                  else
                  {
                    $user_arr[0] = array('Player Id','Reward Name','Reward Get Email','Redeem Date','Spin Date');
                  }
                  
                  while($result_user = mysqli_fetch_assoc($row_user))
                  {
                    $user_id_hwe    =   $result_user['user_id'];
                    //ramkishan
                    $select_user1 ="SELECT * from ".$table_prefix."user_table where id='".$user_id_hwe."'";
                    $row_user1 = $conn->query($select_user1);
                    $result_user1 = mysqli_fetch_assoc($row_user1);

                    $username_user    =   $result_user1['username'];

                    $win_rate  =   $result_user['win_rate'];
                    //$reward_item  =   $result_user['reward_item'];
                    $reward_item = str_replace('<br />','',urldecode($result_user['reward_item']));

                    $reward_get_email  =   $result_user['user_email'];
                    
                   
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
          
                      <tr class="text-left">
                      
                        <td><?php echo $no; ?></td>
                        <?php 
                        if($code_sp == '1' || $mobile_number_sp == '1' || $code_with_remain_spin_sp == '1' || $email_method== '1' || $name_email_mobileno == '1')
                        {  
                            
                        }else{ ?>
                        <td><?php echo $username_user; ?></td>
                        <?php 
                        }?>
                        <!--<td><?php //echo $win_rate; ?></td>-->
                        <td><?php echo $reward_item; ?></td>
                        <td><?php echo $reward_get_email; ?></td>
                        <?php if($code_sp == '1' || $mobile_number_sp == '1' || $code_with_remain_spin_sp == '1' || $email_method== '1' || $name_email_mobileno == '1')
                        {
                          if($email_method == '1')
                          {
                            ?>
                                <td><?php echo $result_user1_code['user_email_method_email']; ?></td>
                            <?php
                          }
                          if($name_email_mobileno == '1')
                          {
                            ?>
                                <td><?php echo $result_user1_code['user_n_e_mob_email']; ?></td>
                            <?php
                          }
                          else
                          {
                            ?>
                              <td><?php echo $result_user1_code['generate_code']; ?></td>
                            <?php
                          }
                           ?>
                        
                        <?php }?>
                        <td><?php echo $redeem_time; ?></td>
                        <td><?php echo $spin_date; ?></td>
                      
                      </tr>
                    <?php
                        $no++;

                        
                        if($code_sp == '1' || $mobile_number_sp == '1' || $code_with_remain_spin_sp == '1' || $email_method== '1' || $name_email_mobileno == '1')
                        {  
                          $user_arr[$count_row] = array($reward_item,$reward_get_email,$result_user1_code['generate_code'],$redeem_time,$spin_date);
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
              
                