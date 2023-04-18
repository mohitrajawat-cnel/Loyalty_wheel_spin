<?php
session_start();
include 'admin_panel/pages/config.php';

// Date in the past

header("Expires:".date("l, G M Y h:i:s")." GMT");
header("Expires:".date("l, G M Y h:i:s"));
header("Cache-Control: no-cache");
header("Pragma: no-cache");

// 10 mins in seconds
if(!isset($_SESSION['user_id']))
{
   
   header("Location:".Front_URL);
    
}
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
    background-color: white !important;
    background-size: cover;
    color: #000 !important;
}
    </style>
<?php
if((isset($_REQUEST['data-link']) && $_REQUEST['data-link'] != '') &&  (isset($_REQUEST['custom_id_hwe']) && $_REQUEST['custom_id_hwe'] != ''))
{
  $user_id = $user_id_session;
  $data_link = urldecode($_REQUEST['data-link']);
  $reward_id= base64_decode($_REQUEST['custom_id_hwe']);

  $share_reward_redeem_date =date("Y-m-d H:i:s");

  $select_reward_point ="SELECT * from ".$table_prefix."reward_redeem_share where id='$reward_id'";
  $row_reward_point = $conn->query($select_reward_point);
  while($result_reward_point = mysqli_fetch_assoc($row_reward_point))
  {
    $number_of_points_reward    =   $result_reward_point['number_of_points'];
  }

  $insert_redem_email = "INSERT into ".$table_prefix."share_redeem_reward_results set share_redeem_reward_id='$reward_id',
  user_id='$user_id',
  number_of_redeem_points='$number_of_points_reward',
  redeem_reward_email='$data_link',
  share_reward_redeem_date='$share_reward_redeem_date'";

  if(mysqli_query($conn,$insert_redem_email))
  {
    $select_user2 ="SELECT * from ".$table_prefix."user_table where id='".$user_id_session."'";
    $row_user2 = $conn->query($select_user2);
    $result_user2 = mysqli_fetch_assoc($row_user2);

    $redeem_points_taotal = $result_user2['user_redeem_point'];

    $reamin_redeem_point = $redeem_points_taotal -$number_of_points_reward;

    $reduce_redeem_point_to_user = "UPDATE ".$table_prefix."user_table SET user_redeem_point='$reamin_redeem_point' where id='".$user_id_session."'";
    if(mysqli_query($conn,$reduce_redeem_point_to_user))
    {
      ?>
      <script>
            var link = '<?php echo $data_link; ?>';
            var front_url = '<?php echo Front_URL; ?>/share_redeem_data_show.php';
            window.location.href = link;
            
      </script>
      <?php
    }

  }

}


if(isset($_POST['save_redeem_email']))
{
  $user_id = $user_id_session;
  $redeem_reward_email = $_POST['email_for_redeem_reward'];
  $redeem_reward_id = $_POST['redeem_reward_id'];
  $number_of_redeem_points= $_POST['number_of_redeem_points'];

  $share_reward_redeem_date =date("Y-m-d H:i:s");

  $insert_redem_email = "INSERT into ".$table_prefix."share_redeem_reward_results set share_redeem_reward_id='$redeem_reward_id',
  user_id='$user_id',
  number_of_redeem_points='$number_of_redeem_points',
  redeem_reward_email='$redeem_reward_email',
  share_reward_redeem_date='$share_reward_redeem_date'";

  if(mysqli_query($conn,$insert_redem_email))
  {
    $select_user2 ="SELECT * from ".$table_prefix."user_table where id='".$user_id_session."'";
    $row_user2 = $conn->query($select_user2);
    $result_user2 = mysqli_fetch_assoc($row_user2);

    $redeem_points_taotal = $result_user2['user_redeem_point'];

    $reamin_redeem_point = $redeem_points_taotal -$number_of_redeem_points;

    $reduce_redeem_point_to_user = "UPDATE ".$table_prefix."user_table SET user_redeem_point='$reamin_redeem_point' where id='".$user_id_session."'";
    mysqli_query($conn,$reduce_redeem_point_to_user);
  }

}

?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" />
        <title><?php echo $site_title_hwe; ?></title>
        <meta name="description" content="" data-type="admin" />
        <meta name="keywords" content="" data-type="admin" />
        <meta name="author" content="Gafami">
        <meta property="fb:app_id" content="1701132369920968" data-type="admin" />
        <meta property="og:url" content="" data-type="admin" />
        <meta property="og:type" content="Website" data-type="admin" />
        <meta property="og:title" content="<?php echo $site_title_hwe; ?>" data-type="admin" />
        <meta property="og:description" content="<?php echo $site_description; ?>" data-type="admin" />
        <meta property="og:image" content="" data-type="admin" />
        <?php echo $header_script_tag; ?>

        <!-- <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap4.min.css"> -->

        <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    
        <link rel="stylesheet" href="customn_library/bootstrap.min.css">
        <!-- <script src="customn_library/bootstrap.bundle.min.js"></script> -->
<!-- 
        <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script> -->

        <!-- <script src="customn_library/bootstrap.bundle.min.js"> -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

        
        
    </head>
    <style>
      .reward_images
      {
        justify-content: center;
        display: flex;
        height:100px;
      }
      .reward_images img
      {
        width:auto;
        height:100%;
      }
      .reward_button
      {
        justify-content: center;
        display: flex;
      }
      .reward_box_layout
      {
        box-shadow: 3px 3px 3px 3px #C3C3C3;
        border-radius: 15px;
      }
      .btn-redeem-hwe
      {
        margin: 10px;
        width: 100%;
        border-radius: 22px;
        font-weight: bold;
        background-color: #C70039 !important;
      }
      .reward-history
      {
        margin-top: 8px !important;
        color: #fff;
        font-size: 20px;
        font-weight: bold;
        background: none;
        border: none;
        /* padding: 0px 0px 20px 0px; */
        position: absolute;
        right: 0;
        top: 28px;
      }
   
    </style>
    <?php

      $select_user2_hwe ="SELECT * from ".$table_prefix."user_table where id='".$user_id_session."'";
      $row_user2_hwe = $conn->query($select_user2_hwe);
      $result_user2_hwe = mysqli_fetch_assoc($row_user2_hwe);
   
      $user_total_point = $result_user2_hwe['user_redeem_point'];
    ?>
    <body>
        <div class="row" style="background: #C70039;color:#fff;border-radius: 25px 25px 0px 0px;">
            <div class="col-md-12"> 
                <h3 style="text-align:center;">Redeem Points</h3>
            </div>
            <!-- <div class="col-md-12"> -->
                        <a href="<?php echo Front_URL.'/user_rewards_redeem_history.php' ?>" title="Redeem History" class="btn btn-lg reward-history" style="margin-top: 20px;" data-toggle="modal" ><i class="fa fa-history" aria-hidden="true"></i>
</a>
            <!-- </div> -->
            <div class="col-md-12"> 
                <!-- <div class="col-md-6"> -->
                        <h3 style="text-align:center;">My Points: <?php echo $user_total_point; ?></h3>
                  <!-- </div> -->
                  <!-- <div class="col-md-6">
                        <a href="<?php echo Front_URL.'/user_rewards_redeem_history.php' ?>" class="btn btn-lg reward-history" style="margin-top: 20px;" data-toggle="modal" >Redeem history</a>
                  </div> -->
                
                
            </div>
        </div>
        <div class="container"> 
          <div class="row"> 

             <div class="col-md-12"> 
                <div class="col-md-6">
                  <h3>Redeem Now!</h3>
                </div>
                <div class="col-md-6">
                  
                </div>
             </div>
             <div class="row"> 

                <?php

                $select_user ="SELECT * from ".$table_prefix."reward_redeem_share where 1=1";

                $row_user = $conn->query($select_user);
                $no =1;

                
                $total_num = mysqli_num_rows($row_user);
             
                while($result_user = mysqli_fetch_assoc($row_user))
                {


                  $number_of_points    =   $result_user['number_of_points'];
                  $title    =   $result_user['title'];
                  $description    =   $result_user['description'];
                  $redeem_button_link    =   $result_user['redeem_button_link'];
                  $image    =   $result_user['image'];

                  $id    =   $result_user['id'];


                  $select_user1 ="SELECT * from ".$table_prefix."user_table where id='".$user_id_session."'";
                  $row_user1 = $conn->query($select_user1);
                  $result_user1 = mysqli_fetch_assoc($row_user1);

                  $redeem_points = $result_user1['user_redeem_point'];
                 
                  if($redeem_points >= $number_of_points)
                  {
                    if(isset($result_user['redeem_button_link']) && $result_user['redeem_button_link'] != '')
                    {                     
                      $redeem_button = '<a href="?data-link='.urlencode($redeem_button_link).'&custom_id_hwe='.base64_encode($id).'" name="custom_link" class="btn btn-danger btn-sm btn-redeem-hwe" data-link="'.$redeem_button_link.'" data-custom_id="'.$id.'">REDEEM NOW</a>';
                    }
                    else
                    {
                      $redeem_button = '<button type="button" class="btn btn-danger btn-sm btn-redeem-hwe" data-toggle="modal" data-target="#myModal_'.$id.'">REDEEM NOW</button>';
                    }
                  }
                  else
                  {
                    $redeem_button ='<button type="button" class="btn btn-danger btn-sm btn-redeem-hwe" disabled>REDEEM NOW</button>';
                  }

                  $margin_reward_box='';
                  if((int)$total_num == (int)$no)
                  {
                    $margin_reward_box = 'margin-bottom:60px;';
                  }
                  ?>
                    <div class="col-lg-2 col-md-4 col-sm-6 col-2"  style="<?php echo $margin_reward_box;?>">
                      <div class="reward_box_layout">
                          <div class="reward_images">
                            <img src="admin_panel/pages/<?php echo $image; ?>" style="padding: 10px;">
                          </div>
                          <div class="reward_button">
                            <?php echo $redeem_button; ?>
                          </div>
                        </div>
                      <div>
                          <div class="text-center" style="padding: 8px;">
                              <span style="color:#C70039;font-size: 18px;font-weight: bold;"><?php echo $number_of_points; ?> Points</span>
                          </div>
                          <div class="text-center">
                            <span style="font-size: 16px;font-weight: bold;"><?php echo $title; ?></span>
                          </div>
                      </div>
                          <div class="container">
                            
                            <form method="post">
                               <!-- Modal -->
                               <div class="modal fade" id="myModal_<?php echo $id; ?>" role="dialog">
                                 <div class="modal-dialog">
                                 
                                   <!-- Modal content-->
                                   <div class="modal-content">
                                     <div class="modal-header">
                                       <button type="button" class="close" data-dismiss="modal">&times;</button>
                                       <h4 class="modal-title" style="color:#000;">Redeem Reward</h4>
                                     </div>
                                     <div class="modal-body">
                                        <label style="color:#000;">Enter Email For Reward</label>
                                        <input type="email" name="email_for_redeem_reward" class="form-control">
                                        <input type="hidden" name="redeem_reward_id" value="<?php echo $id; ?>" class="form-control">
                                        <input type="hidden" name="number_of_redeem_points" value="<?php echo $number_of_points; ?>" class="form-control">
                                         <br>
                                        <button type="submit" name="save_redeem_email" class="btn btn-primary">Save</button>
                                        
                                     </div>
                                     <div class="modal-footer">
                                       <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                     </div>
                                   </div>
                                   
                                 </div>
                               </div>
 
                             </form> 
                               
                       </div>

                    </div>

                  <?php

                  $no++;

                  ?>
                      
                  <?php
                }

                ?>
               

              </div>
          </div>
        </div>
        
        <?php
          include 'site_front_menu.php';
        ?>

    </body>

</html>
<script>
        // jQuery(document).ready(function () {
        //     jQuery('#example').DataTable();
        // });
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
              
                