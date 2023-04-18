<?php
session_start();
include 'config.php';
if(isset($_POST['save_email_config_popup']))
{
 
    $encode_send_wheel_data = json_encode($_POST);

    $select ="SELECT * from wheel_data";
    $row = $conn->query($select);
    $count  = mysqli_num_rows($row);
    if($count > 0)
    {
       $update ="UPDATE wheel_data SET
       save_email_config_popup = '".$encode_send_wheel_data."' WHERE id='1'"; 
       mysqli_query($conn,$update);
    }
    else
    {
        $insert ="INSERT into wheel_data SET
        save_email_config_popup = '".$encode_send_wheel_data."'"; 
        mysqli_query($conn,$insert);
    }

    
}
if(isset($_POST['access_key_save']))
{
 
  

    $encode_send_wheel_data  =json_encode($_POST);

    $select ="SELECT * from wheel_data";
    $row = $conn->query($select);
    $count  = mysqli_num_rows($row);
    if($count > 0)
    {
       $update ="UPDATE wheel_data SET
       access_key_save = '".$encode_send_wheel_data."' WHERE id='1'
       "; 
       mysqli_query($conn,$update);
    }
    else
    {
        $insert ="INSERT into wheel_data SET
        access_key_save = '".$encode_send_wheel_data."'"; 
        mysqli_query($conn,$insert);
    }
    
}
if(isset($_POST['customer_email_save']))
{
 
    

    $encode_send_wheel_data  =json_encode($_POST);

    $select ="SELECT * from wheel_data";
    $row = $conn->query($select);
    $count  = mysqli_num_rows($row);
    if($count > 0)
    {
       $update ="UPDATE wheel_data SET
       customer_email_save = '".$encode_send_wheel_data."' WHERE id='1'
       "; 
       mysqli_query($conn,$update);
    }
    else
    {
        $insert ="INSERT into wheel_data SET
        customer_email_save = '".$encode_send_wheel_data."'"; 
        mysqli_query($conn,$insert);
    }
    
}

if(isset($_POST['save_countdown']))
{
 
    

    $encode_send_wheel_data  =json_encode($_POST);

    $select ="SELECT * from wheel_data where id='1'";
    $row = $conn->query($select);
    $count  = mysqli_num_rows($row);
    if($count > 0)
    {
       $update ="UPDATE wheel_data SET
       save_countdown = '".$encode_send_wheel_data."' WHERE id='1'
       "; 
       mysqli_query($conn,$update);
    }
    else
    {
        $insert ="INSERT into wheel_data SET
        save_countdown = '".$encode_send_wheel_data."'"; 
        mysqli_query($conn,$insert);
    }
    
}


if(isset($_POST['get_spin_reward_images']))
{
    $slice_number = $_POST['slice'];
    
    $select ="SELECT * from wheel_data";
    $row = $conn->query($select);
    $result = mysqli_fetch_assoc($row);

    $slice_image =  json_decode($result['spin_slice_data'],true);
    
    $reward_images = $slice_image['slice'.$slice_number];
    
    echo $reward_images;

}

if(isset($_POST['check_user_code_limit_is_allow']))
{
   $user_code = $_REQUEST['user_code'];
   
     $table_name='';
    if($host_name == 'wgc33.vip')
    {
        $table_name = 'phonenogenerate';
    }
    else
    {
        $table_name = 'codegenerate';
    }
   
    $select="select * from ".$table_name." where generate_code='$user_code' and status = '0'";
    $query=mysqli_query($conn,$select);
    $result =mysqli_fetch_assoc($query);
    if(mysqli_num_rows($query)==0)
    {
        echo 1;
    }
    else
    {
        echo 0;
    }
   die; 
}

if(isset($_POST['get_reward_id_number']))
{
   $reward_id = $_REQUEST['reward_id'];
   
   $iv_length = openssl_cipher_iv_length(ciphering);
    $options = 0;
    
    $decryption=openssl_decrypt ($reward_id, ciphering, 
        encryption_key, $options, encryption_iv);
    echo str_replace('reward','',$decryption); 
   die; 
}

if(isset($_POST['get_random_spin_value']))
{
    date_default_timezone_set("Asia/Kuala_Lumpur");
    
    $all_data['data'] =array();
    $array_1 =$all_data['data'];

    $rewrd_data_hwe['reward'] =array();
    $array_2 =$rewrd_data_hwe['reward'];
    
    $get_generate_code = $_POST['user_spin_code'];
    
    // $check_for_mobile = '';
    // if($host_name == 'wgc33.vip')
    // {
    //     $check_for_mobile ='1';
    // }
    
    if(isset($_POST['user_spin_code']) && $_POST['user_spin_code'] !='')
    {
   
        $selcte_reward_list  = "SELECT * from codegenerate where generate_code='".$get_generate_code."' and status = '1'";
        $row_reward = $conn->query($selcte_reward_list);
        $probability_value = '';
        $probability_reward = '';
        if(mysqli_num_rows($row_reward) > 0)
        {
            $result_reward = mysqli_fetch_assoc($row_reward);
            
            $get_normal_spin_check = $result_reward['check_normal_spin'];
          
            if($get_normal_spin_check == '1')
            {
              
                $probability_value = $result_reward['show_reward_value'];
             
                
                $select ="SELECT * from wheel_data";
               
                $row = $conn->query($select);
                $result = mysqli_fetch_assoc($row);
                
                    
                $decode_data =json_decode($result['spin_data'],true);
                
                $probability_reward = $decode_data['prize'.$probability_value];
                
                 ///encryption keys
                $iv_length = openssl_cipher_iv_length(ciphering);
                $options = 0;
                
                $encryp_reward_id = openssl_encrypt('reward'.$probability_value, ciphering,
                encryption_key, $options, encryption_iv);
        
                $all_data_send['probability']=$encryp_reward_id;
                
                $all_data_send['reward']=$probability_reward;
         
                echo json_encode($all_data_send);
   
            }
            else
            {
         
                $all_data['data'] =array();
                $array_1 =$all_data['data'];
            
                $rewrd_data_hwe['reward'] =array();
                $array_2 =$rewrd_data_hwe['reward'];
                
                $select ="SELECT * from wheel_data";
                $row = $conn->query($select);
                while($result = mysqli_fetch_assoc($row))
                {
                    
                    $decode_data =json_decode($result['spin_data'],true);
             
                    $calculate_per_value =array();
                    $data_hwe =array();
                    for($i =0; $i < $decode_data['slice']; $i++)
                    {
                        $probability_value =  $decode_data['probability'.$i];
                        $probability_prize =  $i;
            
                         $calculate_per_value['num'] = round(($probability_value * 10)/100);
                         $calculate_per_value['value'] = $probability_prize;
                         $calculate_per_value['reward'] = $decode_data['prize'.$i];
                         $calculate_per_value['check_tick'] = $decode_data['no_matter_probability'.$i];
            
                         $data_hwe[] =$calculate_per_value;
                       
                         
                    } 
   
                    foreach($data_hwe as $data_hwe_hwe)
                        {
                            if($data_hwe_hwe['check_tick'] != '')
                            {
                                $number = $data_hwe_hwe['num'];
                                if($number == 0)
                                {
                                    $number='';
                                    continue;
                                    
                                }
            
                            }
            
                            $number = $data_hwe_hwe['num'];
            
                            if($data_hwe_hwe['check_tick'] == 1)
                            {
                                $number =1;
                                $date_get = date("y-m-d");
                                $next_day = date('Y-m-d', strtotime( $date_get . " +1 days"));
                                $selcte_reward_list  = "SELECT * from spin_result where created between '$date_get' and '$next_day' && reward_item='".$data_hwe_hwe['reward']."'";
                                $row_reward = $conn->query($selcte_reward_list);
                                if(mysqli_num_rows($row_reward) > 0)
                                {
                                    $number='';
                                    continue;
                                }
                                
                            }
                            $value = $data_hwe_hwe['value'];
                            $reward = $data_hwe_hwe['reward'];
            
                            
            
                            for($j =0; $j < $number; $j++ )
                            {
                                array_push($array_1,$value);
                                array_push($array_2,$reward);
                                
                            }
                        }
                  
                        $all_data_send =array();
            
            
                        if(count($array_1) <=0 )
                        {
                            ///encryption keys
                            $iv_length = openssl_cipher_iv_length(ciphering);
                            $options = 0;
                            
                            $encryp_reward_id = openssl_encrypt('reward0', ciphering,
                            encryption_key, $options, encryption_iv);
                    
                            $all_data_send['probability']=$encryp_reward_id;
                       
                            $all_data_send['reward']=$decode_data['prize0'];
                            echo json_encode($all_data_send);
                        }
                        else
                        {
                            
                            $random_number = array_rand($array_1,1);
                        
                            foreach($array_1 as $key => $array_1_hwe)
                            {
                                if($key == $random_number)
                                {
                                //echo $array_1_hwe;
                                
                                ///encryption keys
                                $iv_length = openssl_cipher_iv_length(ciphering);
                                $options = 0;
                                
                                $encryp_reward_id = openssl_encrypt('reward'.$array_1_hwe, ciphering,
                        encryption_key, $options, encryption_iv);
                        
                                $all_data_send['probability']=$encryp_reward_id;
                                $all_data_send['reward']=$array_2[$key];
                         
                                echo json_encode($all_data_send);
                    
                                unset($array_1[$random_number]);
                  
                                }
                            }
                        }
                   
                  
                    
                   
            
            
                }
                
            }
        
        }
        
    }
    else
    {
      
            $select ="SELECT * from wheel_data";
            $row = $conn->query($select);
            while($result = mysqli_fetch_assoc($row))
            {
                
                $decode_data =json_decode($result['spin_data'],true);
        
                $calculate_per_value =array();
                $data_hwe =array();
                for($i =0; $i < $decode_data['slice']; $i++)
                {
                    $probability_value =  $decode_data['probability'.$i];
                    $probability_prize =  $i;
        
                     $calculate_per_value['num'] = round(($probability_value * 10)/100);
                     $calculate_per_value['value'] = $probability_prize;
                     $calculate_per_value['reward'] = $decode_data['prize'.$i];
                     $calculate_per_value['check_tick'] = $decode_data['no_matter_probability'.$i];
        
                     $data_hwe[] =$calculate_per_value;
                   
                     
                } 
        
                foreach($data_hwe as $data_hwe_hwe)
                    {
                        if($data_hwe_hwe['check_tick'] != '')
                        {
                            $number = $data_hwe_hwe['num'];
                            if($number == 0)
                            {
                                $number='';
                                continue;
                                
                            }
        
                        }
        
                        $number = $data_hwe_hwe['num'];
        
                        if($data_hwe_hwe['check_tick'] == 1)
                        {
                            $number =1;
                            $date_get = date("y-m-d");
                            $next_day = date('Y-m-d', strtotime( $date_get . " +1 days"));
                            $selcte_reward_list  = "SELECT * from spin_result where created between '$date_get' and '$next_day' && reward_item='".$data_hwe_hwe['reward']."'";
                            $row_reward = $conn->query($selcte_reward_list);
                            if(mysqli_num_rows($row_reward) > 0)
                            {
                                $number='';
                                continue;
                            }
                            
                        }
                        $value = $data_hwe_hwe['value'];
                        $reward = $data_hwe_hwe['reward'];
        
                        
        
                        for($j =0; $j < $number; $j++ )
                        {
                            array_push($array_1,$value);
                            array_push($array_2,$reward);
                            
                        }
                    }
                    $all_data_send =array();
        
        
                    if(count($array_1) <=0 )
                    {
                        ///encryption keys
                        $iv_length = openssl_cipher_iv_length(ciphering);
                        $options = 0;
                        
                        $encryp_reward_id = openssl_encrypt('reward0', ciphering,
                        encryption_key, $options, encryption_iv);
                
                        $all_data_send['probability']=$encryp_reward_id;
                   
                        $all_data_send['reward']='8$';
                        echo json_encode($all_data_send);
                    }
                    else
                    {
                        
                        $random_number = array_rand($array_1,1);
                    
                        foreach($array_1 as $key => $array_1_hwe)
                        {
                            if($key == $random_number)
                            {
                            //echo $array_1_hwe;
                            
                            ///encryption keys
                            $iv_length = openssl_cipher_iv_length(ciphering);
                            $options = 0;
                            
                            $encryp_reward_id = openssl_encrypt('reward'.$array_1_hwe, ciphering,
                    encryption_key, $options, encryption_iv);
                    
                            $all_data_send['probability']=$encryp_reward_id;
                            $all_data_send['reward']=$array_2[$key];
                     
                            echo json_encode($all_data_send);
                
                            unset($array_1[$random_number]);
              
                            }
                        }
                    }
               
              
                
               
        
        
            }
    }
    
   
}



if(isset($_POST['get_images_labels_show_on_wheel_value']))
{

    $select ="SELECT * from wheel_data";
    $row = $conn->query($select);
    $result = mysqli_fetch_assoc($row);

    $spin_data =  json_decode($result['spin_data'],true);

    $total_slices = $spin_data['slice'];
   
    $prize =array();
    for($i =0; $i <$total_slices; $i++ )
    {
      
        $prize[$i] = $spin_data['no_matter_labal_image_hideshow'.$i];
       
    }

    echo json_encode($prize);

   die; 

}



if(isset($_POST['get_labels_value_wheel_hwe_action']))
{
    $select ="SELECT * from wheel_data";
    $row = $conn->query($select);
    $result = mysqli_fetch_assoc($row);

    $spin_data =  json_decode($result['spin_data'],true);

    $total_slices = $spin_data['slice'];
   
    $prize =array();
    for($i =0; $i <$total_slices; $i++ )
    {
        $prize[$i] = $spin_data['prize'.$i];
    }
    echo json_encode($prize);
    die; 
}


if(isset($_POST['get_probability_value']))
{

    $select ="SELECT * from wheel_data";
    $row = $conn->query($select);
    $result = mysqli_fetch_assoc($row);

    $spin_data =  json_decode($result['spin_data'],true);

    $total_slices = $spin_data['slice'];
   
    $prize =array();
    for($i =0; $i <$total_slices; $i++ )
    {
      
        $prize[]['probability'] = $spin_data['probability'.$i];
       
    }

    echo json_encode($prize);

   die; 

}

if(isset($_POST['get_reward_data_list']))
{

    $select ="SELECT * from wheel_data";
    $row = $conn->query($select);
    $result = mysqli_fetch_assoc($row);

    $spin_data =  json_decode($result['spin_data'],true);

    $total_slices = $spin_data['slice'];
   
    $prize =array();
    for($i =0; $i <$total_slices; $i++ )
    {
      
        $prize[]['prize'] = $spin_data['prize'.$i];
       
    }

    echo json_encode($prize);

   die; 

}

if(isset($_POST['get_set_prize_for_once_day']))
{

    $select ="SELECT * from wheel_data";
    $row = $conn->query($select);
    $result = mysqli_fetch_assoc($row);

    $spin_data =  json_decode($result['spin_data'],true);

    $total_slices = $spin_data['slice'];
   
    $prize =array();
    for($i =0; $i <$total_slices; $i++ )
    {
      
        $prize[]['no_matter_probability'] = $spin_data['no_matter_probability'.$i];
       
    }

    echo json_encode($prize);

   die; 

}


if(isset($_POST['reward_labal_image_checkbox']))
{

    $select ="SELECT * from wheel_data";
    $row = $conn->query($select);
    $result = mysqli_fetch_assoc($row);

    $spin_data =  json_decode($result['spin_data'],true);

    $total_slices = $spin_data['slice'];
   
    $prize =array();
    for($i =0; $i <$total_slices; $i++ )
    {
        $prize[]['no_matter_labal_image_hideshow'] = $spin_data['no_matter_labal_image_hideshow'.$i];
    }

    echo json_encode($prize);
   die; 
}


if(isset($_POST['reward_redirect_link_redeem_div']))
{

    $select ="SELECT * from wheel_data";
    $row = $conn->query($select);
    $result = mysqli_fetch_assoc($row);

    $spin_data =  json_decode($result['spin_data'],true);

    $total_slices = $spin_data['slice'];
   
    $prize =array();
    for($i =0; $i <$total_slices; $i++ )
    {
        $prize[]['reward_redirect_link_redeem'] = $spin_data['reward_redirect_link_redeem'.$i];
    }

    echo json_encode($prize);
   die; 
}


if(isset($_POST['reward_redirect_link_redeem_set_onoff']))
{

    $select ="SELECT * from wheel_data";
    $row = $conn->query($select);
    $result = mysqli_fetch_assoc($row);

    $spin_data =  json_decode($result['spin_data'],true);

    $total_slices = $spin_data['slice'];
   
    $prize =array();
    for($i =0; $i <$total_slices; $i++ )
    {
        $prize[]['no_matter_reward_redirect_link_redeem'] = $spin_data['no_matter_reward_redirect_link_redeem'.$i];
    }

    echo json_encode($prize);
   die; 
}


if(isset($_POST['set_user_spin']))
{
  
    $user_id = $_POST['user_id'];
    $user_spin = $_POST['user_spin'];
    $admin_set_total_spin = $_POST['admin_set_total_spin'];

    $select ="SELECT * from user_table where `id`='".$user_id."'";

    $row = $conn->query($select);
    $count  = mysqli_num_rows($row);
    if($count > 0)
    {
       $admin_set_total_spin = $admin_set_total_spin - 1;
      $update ="UPDATE user_table SET
      `user_spinned` = '".$user_spin."',
      `user_total_spin` = '".$admin_set_total_spin."'
        WHERE id='".$user_id."'"; 
        mysqli_query($conn,$update);
    }

    echo $admin_set_total_spin;

   die; 

}


if(isset($_POST['update_spin_result_redeem_used']))
{
    $reward_id = $_POST['reward_id'];
    
    date_default_timezone_set("Asia/Kuala_Lumpur");
    $now_hwe = date('d-m-Y H:i:s');

   echo $update ="UPDATE spin_result SET `redeem_used` = '1', `redeem_time` = '".$now_hwe."' WHERE `id`='".$reward_id."'"; 
    mysqli_query($conn,$update);
    die; 
}

if(isset($_POST['set_user_spin_result']))
{
    date_default_timezone_set("Asia/Kuala_Lumpur");
    $user_id = $_POST['user_id'];
    $user_spin = $_POST['user_spin'];
    $admin_set_total_spin = $_POST['admin_set_total_spin'];
    $reward_item = $_POST['reward_item'];
    $reward_id_hwe = $_POST['reward_id_hwe'];
    $spain_code = $_POST['spain_code'];
    
    $iv_length = openssl_cipher_iv_length(ciphering);
    $options = 0;
    
    $decryption_hwe = openssl_decrypt ($reward_id_hwe, ciphering, 
        encryption_key, $options, encryption_iv);
    $reward_id_hwe = str_replace('reward','',$decryption_hwe);
    
    if($user_spin > 0)
    {
        $win_rate = ($user_spin*100)/$admin_set_total_spin;
    }
    else
    {
        $win_rate = 0;
    }
    $win_rate = 0;
    $date = date("Y-m-d H:i:s");

    $time_stamp = strtotime($date);

       $update ="INSERT into spin_result SET
      `user_id` = '".$user_id."',
      `reward_item` = '".$reward_item."',
      `reward_id` = '".$reward_id_hwe."',
      `win_rate` = '".round($win_rate)."',
      `created` ='".$date."',
      `datetime`='".$date."',
      `spin_code`='".$spain_code."'"; 
      
        mysqli_query($conn,$update);

        if($spain_code != '')
        {
            $selcte_reward_list  = "SELECT * from spin_result where `spin_code`='".$spain_code."' order by id desc";
        }
        else
        {
            $selcte_reward_list  = "SELECT * from spin_result where `user_id`='".$user_id."' order by id desc";
        }
       
        $row_reward = $conn->query($selcte_reward_list);
        while($result_reward = mysqli_fetch_assoc($row_reward))
        {
            $reward_item = $result_reward['reward_item'];
            $user_email = $result_reward['user_email'];
            $reward_id = $result_reward['id'];
            $reward_id_hwe = $result_reward['reward_id'];
            $redeem_used_hwe = $result_reward['redeem_used'];
                    
            //get reward redeem details
            $select_reward ="SELECT * from wheel_data";
            $row_reward_wheel = $conn->query($select_reward);
            $result_reward_wheel = mysqli_fetch_assoc($row_reward_wheel);
        
            $spin_data =  json_decode($result_reward_wheel['spin_data'],true);
        
            $total_slices = $spin_data['slice'];
           
            $prize =array();
            $redirect_onoff = 0;
            $redirect_link_hwe = '';
            for($i =0; $i <$total_slices; $i++ )
            {
                if($i==$reward_id_hwe) 
                {
                    $redirect_link_hwe = $spin_data['reward_redirect_link_redeem'.$i];
                    $redirect_onoff = $spin_data['no_matter_reward_redirect_link_redeem'.$i];
                }
            }

            if($redeem_used_hwe == 1)
            {
                $all_data .= '
                <div class="item disabled after_redeem_change_button_'.$reward_id.'">
                    <button class="btn-redeem disabled"><span>USED</span></button>
                    <div class="value" data-value="'.$reward_item.'">'.$reward_item.'</div>
                </div>
              ';
               
            }
            else
            {
                
             if($redirect_onoff==1)
                {
                      $all_data .='
                            <div class="item disabled after_redeem_change_button_'.$reward_id.'">
                                <a  onclick="spin_result_redeem_used_update('.$reward_id.')" target="_blank" href="'.$redirect_link_hwe.'" ><button class="btn-redeem"><span>REDEEM</span></button></a>
                                <div class="value" data-value="'.$reward_item.'">'.$reward_item.'</div>
                            </div>
                      ';
                }
                else
                {
                    $all_data .='
                            <div class="item disabled after_redeem_change_button_'.$reward_id.'">
                                <button class="btn-redeem" onclick="redeem('.$reward_id.')"><span>REDEEM</span></button>
                                <div class="value" data-value="'.$reward_item.'">'.$reward_item.'</div>
                            </div>
                      ';
                }
            }
        }
 
    echo $all_data;
   // echo $user_spin;

   die; 

}

if(isset($_POST['update_email_in_result']))
{

    $user_id = $_POST['user_id'];
    $email = $_POST['user_email_reward'];
    $reward_id = $_POST['reward_id'];
    
    $now_hwe = date('d-m-Y H:i:s');
    
     echo $update ="UPDATE spin_result SET
      `user_id` = '".$user_id."',
      `user_email` = '".$email."',
      `redeem_used` = '1',
      `redeem_time` = '".$now_hwe."' where user_id ='".$user_id."' && id='".$reward_id."'"; 
        mysqli_query($conn,$update);
 

   die; 

}
// if(isset($_POST['set_reward_images_hwe']))
// {

//     $user_id = $_POST['user_id'];
//     $email = $_POST['user_email_reward'];
    

    
//       echo $update ="UPDATE spin_result SET
//       `user_id` = '".$user_id."',
//       `user_email` = '".$email."' where user_id ='".$user_id."'"; 
//         mysqli_query($conn,$update);
 

//   // echo $user_spin;

//   die; 

// }

?>