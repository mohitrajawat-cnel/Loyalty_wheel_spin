<?php
include 'config.php';

if(isset($_REQUEST['export_results']))
{
  $start = $_REQUEST['start'];
  $limit = 20;

  $select_user ="SELECT * from ".$table_prefix."spin_result where 1=1 order by id desc limit ".$start.",".$limit;
  $row_user = $conn->query($select_user);

  $no =1;
  $count_row =1;
  

  $status = 0;

  if(mysqli_num_rows($row_user) > 0)
  {
      $status = $start + $limit;

      $user_arr=array();

      if($start == 0){

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
      
      }

     

      while($result_user = mysqli_fetch_assoc($row_user))
      {
        $user_id_hwe = $result_user['user_id'];
        $username_user='';
        if($user_id_hwe != '')
        {
          $select_user1 ="SELECT * from ".$table_prefix."user_table where id='".$user_id_hwe."'";
          $row_user1 = $conn->query($select_user1);
          $result_user1 = mysqli_fetch_assoc($row_user1);
          if(isset($result_user1['username']))
          {
            $username_user = $result_user1['username'];
          }
        }

        $reward_item = str_replace('<br />','',urldecode($result_user['reward_item']));

        $reward_get_email  =   $result_user['user_email'];
        
        $spin_date_strtime = strtotime($result_user['created']);
        $spin_date = date("d-m-Y H:i:s",$spin_date_strtime);
        
        $redeem_time = $result_user['redeem_time'];
        $spin_code = $result_user['spin_code'];
        
        if($mobile_number_sp == '1')
        {
            $select_user1_code ="SELECT * from ".$table_prefix."phonenogenerate where id='".$spin_code."'";
        }
        else
        {
            $select_user1_code ="SELECT * from ".$table_prefix."codegenerate where id='".$spin_code."'";
        }
        $row_user1_code = $conn->query($select_user1_code);
        $result_user1_code = mysqli_fetch_assoc($row_user1_code);
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

      $start_page_total = $paginationStart + $limit;


      $filename = 'spin-results.csv';
      $export_data = $user_arr;
    
      // file creation
      $file = fopen($filename,"a");
    
      foreach($export_data as $line){
        fputcsv($file,$line);
      }
      fclose($file);
      
  }
  else
  {
    $status = 0;
  }

  echo $status;
  die();
}

if(isset($_POST['export_results_success']))
{
  $filename = 'spin-results.csv';
  unlink($filename);
  die();
}