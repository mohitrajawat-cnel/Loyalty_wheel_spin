<?php
session_start();
include 'admin_panel/pages/config.php';

if($_REQUEST['task'] == 'checkapikey')
{
    // GET API
    checkapikey($_REQUEST);
}

if($_REQUEST['task'] == 'update_reamin_spin')
{
    //POST API
    update_reamin_spin($_REQUEST);
}

function checkapikey($params)
{
   global $conn;

   $api_key = $params['api_key'];

   $response= array();
//ramkishan
   $select = "SELECT * from domain_list_settings where api_key='$api_key'";
   $row = $conn->query($select);
  
   if(mysqli_num_rows($row) > 0)
   {
     $response['message'] = 'API Key Matched Successfully.';
     $response['status'] = true;
     $response['error_code'] = 0;

   }
   else
   {
      $response['message'] = 'Please Enter Correct API Key.';
      $response['status'] = false;
      $response['error_code'] = 0606;
   }

   echo json_encode($response);

   die();
}

function update_reamin_spin($params)
{
   global $conn,$table_prefix;

   
   $reamin_spin=0;
   $api_key = $params['api_key'];
   $uuid = $params['uuid'];
   $reamin_spin = $params['number_of_spins'];

   $response = array();

   //ramkishan
   $select = "SELECT * from domain_list_settings where api_key='$api_key'";
   $row = $conn->query($select);
   $result = mysqli_fetch_assoc($row);

   //$domain_table_prefix = $result['table_prefix'];
//ramkishan

   $select_user = "SELECT * from ".$table_prefix."user_table where UUID='".$uuid."'";
   $row_user = $conn->query($select_user);
   $result_user = mysqli_fetch_assoc($row_user);

   $toatl_spin_get = $result_user['user_total_spin'];

   $user_increase_spin = $toatl_spin_get + $reamin_spin;

   $update = "UPDATE ".$table_prefix."user_table SET user_total_spin='".$user_increase_spin."' where UUID='".$uuid."'";

   if(mysqli_query($conn,$update))
   {
     $response['message'] = 'Remain Spin Updated Successfully.';
     $response['status'] = true;
     $response['error_code'] = 0;

   }
   else
   {
      $response['message'] = 'Not updated remain spin.';
      $response['status'] = false;
      $response['error_code'] = 0606;
   }


    echo json_encode($response);

   die();
   

}


?>