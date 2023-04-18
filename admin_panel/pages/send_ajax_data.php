<?php
session_start();
include 'config.php';
if(isset($_POST['save_email_config_popup']))
{
 
    $encode_send_wheel_data = json_encode($_POST);

    $select ="SELECT * from ".$table_prefix."wheel_data";
    $row = $conn->query($select);
    $count  = mysqli_num_rows($row);
    if($count > 0)
    {
       $update ="UPDATE ".$table_prefix."wheel_data SET
       save_email_config_popup = '".$encode_send_wheel_data."' WHERE id='1'"; 
       mysqli_query($conn,$update);
    }
    else
    {
        $insert ="INSERT into ".$table_prefix."wheel_data SET
        save_email_config_popup = '".$encode_send_wheel_data."'"; 
        mysqli_query($conn,$insert);
    }

    
}
if(isset($_POST['access_key_save']))
{
 
  

    $encode_send_wheel_data  =json_encode($_POST);

    $select ="SELECT * from ".$table_prefix."wheel_data";
    $row = $conn->query($select);
    $count  = mysqli_num_rows($row);
    if($count > 0)
    {
       $update ="UPDATE ".$table_prefix."wheel_data SET
       access_key_save = '".$encode_send_wheel_data."' WHERE id='1'
       "; 
       mysqli_query($conn,$update);
    }
    else
    {
        $insert ="INSERT into ".$table_prefix."wheel_data SET
        access_key_save = '".$encode_send_wheel_data."'"; 
        mysqli_query($conn,$insert);
    }
    
}
if(isset($_POST['customer_email_save']))
{
 
    

    $encode_send_wheel_data  =json_encode($_POST);

    $select ="SELECT * from ".$table_prefix."wheel_data";
    $row = $conn->query($select);
    $count  = mysqli_num_rows($row);
    if($count > 0)
    {
       $update ="UPDATE ".$table_prefix."wheel_data SET
       customer_email_save = '".$encode_send_wheel_data."' WHERE id='1'
       "; 
       mysqli_query($conn,$update);
    }
    else
    {
        $insert ="INSERT into ".$table_prefix."wheel_data SET
        customer_email_save = '".$encode_send_wheel_data."'"; 
        mysqli_query($conn,$insert);
    }
    
}

if(isset($_POST['save_countdown']))
{
 
    

    $encode_send_wheel_data  =json_encode($_POST);

    $select ="SELECT * from ".$table_prefix."wheel_data where id='1'";
    $row = $conn->query($select);
    $count  = mysqli_num_rows($row);
    if($count > 0)
    {
       $update ="UPDATE ".$table_prefix."wheel_data SET
       save_countdown = '".$encode_send_wheel_data."' WHERE id='1'
       "; 
       mysqli_query($conn,$update);
    }
    else
    {
        $insert ="INSERT into ".$table_prefix."wheel_data SET
        save_countdown = '".$encode_send_wheel_data."'"; 
        mysqli_query($conn,$insert);
    }
    
}


if(isset($_POST['get_spin_reward_images']))
{
    $slice_number = $_POST['slice'];
    
    $select ="SELECT * from ".$table_prefix."wheel_data";
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
    if($mobile_number_sp == '1')
    {
        $table_name = 'phonenogenerate';
    }
    else
    {
        $table_name = 'codegenerate';
    }
   
    $select="select * from ".$table_prefix.$table_name." where generate_code='$user_code' and status = '0'";
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
    if($host_name == "spin2win88.com" || $host_name == 'sgluckydraw88.com' )
    {
        $reward_id = $_REQUEST['reward_id'];
        $user_id = $_SESSION['user_id'];

        $iv_length = openssl_cipher_iv_length(ciphering);
        $options = 0;
        
        $decryption=openssl_decrypt ($reward_id, ciphering, 
            encryption_key, $options, encryption_iv);
        $reward_id_hwe = str_replace('reward','',$decryption); 

        $status= $reward_id_hwe;

        $selcte_reward_list  = "SELECT * from ".$table_prefix."user_table where id='".$user_id."'";
        $row_reward = $conn->query($selcte_reward_list);
        $result_reward = mysqli_fetch_assoc($row_reward);
        
        $get_reward_spin_check = $result_reward['user_spin_type_login_method'];
        $user_total_spin = $result_reward['user_total_spin'];
        if(isset($result_reward['user_spin_type_login_method']))
        {
            if($get_reward_spin_check == '1')
            {
            $rewards_remain_spin_values = json_decode($result_reward['num_for_reward_reamin_spin'],true);
            if($rewards_remain_spin_values[$reward_id_hwe] <= 0)
            {
                $user_total_spin_hwe = $user_total_spin + 1;
                $status = 'Please Again Spin';
                $update_hwe= "UPDATE ".$table_prefix."user_table set user_total_spin='$user_total_spin_hwe' where id='".$user_id."'";
                mysqli_query($conn,$update_hwe);
            }
            } 
        }
        
    echo $status;                    
    die; 
  }
  else
  {
       $reward_id = $_REQUEST['reward_id'];
    
       $iv_length = openssl_cipher_iv_length(ciphering);
        $options = 0;
        
        $decryption=openssl_decrypt ($reward_id, ciphering, 
            encryption_key, $options, encryption_iv);
        echo str_replace('reward','',$decryption); 
       die; 
   }
}

if(isset($_POST['get_random_spin_value']))
{

    date_default_timezone_set("Asia/Kuala_Lumpur");
    
    $all_data['data'] =array();
    $array_1 =$all_data['data'];

    $rewrd_data_hwe['reward'] =array();
    $array_2 =$rewrd_data_hwe['reward'];
    
    $user_id='';
    if(isset($_POST['user_id']) && $_POST['user_id'] !='')
    {
        $user_id = $_POST['user_id'];
    }
    
    
    // $check_for_mobile = '';
    // if($host_name == 'wgc33.vip')
    // {
    //     $check_for_mobile ='1';
    // }
    
    if(isset($_POST['user_spin_code']) && $_POST['user_spin_code'] !='')
    {
        $get_generate_code = $_POST['user_spin_code'];
        
        $selcte_reward_list  = "SELECT * from ".$table_prefix."codegenerate where generate_code='".$get_generate_code."' and status = '1'";
    
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
             
                
                $select ="SELECT * from ".$table_prefix."wheel_data";
               
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
                
                $select ="SELECT * from ".$table_prefix."wheel_data";
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
                        if(empty($probability_value))
                        {
                           $probability_value =0;
                        }
                         //$calculate_per_value['num'] = round(($probability_value * 10)/100);
                         $calculate_per_value['num'] = $probability_value;
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
                            $selcte_reward_list  = "SELECT * from ".$table_prefix."spin_result where created between '$date_get' and '$next_day' && reward_item='".$data_hwe_hwe['reward']."'";
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
                        foreach($data_hwe as $count_num => $data_hwe_hwe1)
                        {
                            $value1 = $data_hwe_hwe1['value'];
                            $reward1 = $data_hwe_hwe1['reward'];

                            array_push($array_1,$value1);
                            array_push($array_2,$reward1);
                        }

                        // shuffle($array_1);
                        $random_number = array_rand($array_1,1);
            
                        foreach($array_1 as $key => $array_1_hwe)
                        {
                            if($key == $random_number)
                            {
                    
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
                    else
                    {
                        //shuffle($array_1);
                        $random_number = array_rand($array_1,1);
            
                        foreach($array_1 as $key => $array_1_hwe)
                        {
                            if($key == $random_number)
                            {
                                                    
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
       // $user_id=1;

            $selcte_reward_list  = "SELECT * from ".$table_prefix."user_table where id='".$user_id."'";
            $row_reward = $conn->query($selcte_reward_list);
            $result_reward = mysqli_fetch_assoc($row_reward);
            
            $get_reward_spin_check = $result_reward['user_spin_type_login_method'];
          
            if($get_reward_spin_check == '1')
            {
                $array_after_unset =array();
                $array_after_unset1=array();

                if($result_reward['save_array_after_unset_reward'] !='')
                {
                    $array_after_unset = json_decode($result_reward['save_array_after_unset_reward'],true);
                }
                


                $all_data['data'] =array();
                $array_1 =$all_data['data'];
            
                $rewrd_data_hwe['reward'] =array();
                $array_2 =$rewrd_data_hwe['reward'];
                
                $select ="SELECT * from ".$table_prefix."wheel_data";
                $row = $conn->query($select);
                while($result = mysqli_fetch_assoc($row))
                {

                    $rewards_remain_spin_values = json_decode($result_reward['num_for_reward_reamin_spin'],true);
                    
                    
                    $decode_data =json_decode($result['spin_data'],true);
            
                    $calculate_per_value =array();
                    $data_hwe =array();
                    for($i =0; $i < $decode_data['slice']; $i++)
                    {
                        $probability_value =  $rewards_remain_spin_values[$i];
                        $probability_prize =  $i;
                        if(empty($probability_value))
                        {
                          $probability_value =0;
                        }
                       
                        $calculate_per_value['num'] = $probability_value;
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
                                $selcte_reward_list  = "SELECT * from ".$table_prefix."spin_result where created between '$date_get' and '$next_day' && reward_item='".$data_hwe_hwe['reward']."'";
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
            
            
                        if(count($array_after_unset) > 0)
                        {
         
                                $random_number = array_rand($array_after_unset,1);
             
                                foreach($array_1 as $key => $array_1_hwe)
                                {
                                    $value_get_unset_array = $array_after_unset[$random_number];
                                    if($array_1_hwe == $value_get_unset_array)
                                    {
                                   
                                        $iv_length = openssl_cipher_iv_length(ciphering);
                                        $options = 0;
                          
                                        $encryp_reward_id = openssl_encrypt('reward'.$array_1_hwe, ciphering,
                                        encryption_key, $options, encryption_iv);
                                
                                        $all_data_send['probability']=$encryp_reward_id;
                                        $all_data_send['reward']=$array_2[$key];
                                
                                        echo json_encode($all_data_send);
                            
                                        unset($array_after_unset[$random_number]);
                                        
                                        $array_after_unset1 = json_encode($array_after_unset);

                                        if(count($array_after_unset) > 0)
                                        {
                                            $update_array_after_unset ="UPDATE ".$table_prefix."user_table SET save_array_after_unset_reward='".$array_after_unset1."' where id='$user_id'";
                                            mysqli_query($conn,$update_array_after_unset);
                                        }
                                        else
                                        {
                                            $update_array_after_unset ="UPDATE ".$table_prefix."user_table SET save_array_after_unset_reward='' where id='$user_id'";
                                            mysqli_query($conn,$update_array_after_unset);
                                        }

                                        

                                        die();
                    
                                    }
                                }
                        }
                        
                        if(count($array_1) <=0 )
                        {
                            foreach($data_hwe as $count_num => $data_hwe_hwe1)
                            {
                                $value1 = $data_hwe_hwe1['value'];
                                $reward1 = $data_hwe_hwe1['reward'];

                                array_push($array_1,$value1);
                                array_push($array_2,$reward1);
                            }
                            // print_r($data_hwe);
                            // die("gfhfghdf");
                            // shuffle($array_1);
                            $random_number = array_rand($array_1,1);
                
                            foreach($array_1 as $key => $array_1_hwe)
                            {
                                if($key == $random_number)
                                {
                        
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
                        else
                        {
                        // shuffle($array_1);
                 
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
                                    $array_after_unset = json_encode($array_1);

                                    if(count($array_1) > 0)
                                    {
                                        $update_array_after_unset ="UPDATE ".$table_prefix."user_table SET save_array_after_unset_reward='".$array_after_unset."' where id='$user_id'";
                                        mysqli_query($conn,$update_array_after_unset);
                                    }
                                    else
                                    {
                                        $update_array_after_unset ="UPDATE ".$table_prefix."user_table SET save_array_after_unset_reward='' where id='$user_id'";
                                        mysqli_query($conn,$update_array_after_unset);
                                    }
                                    
                
                                }
                            }
                    }
                }
            }
            else
            {
                $all_data['data'] =array();
                $array_1 =$all_data['data'];
            
                $rewrd_data_hwe['reward'] =array();
                $array_2 =$rewrd_data_hwe['reward'];

                $select ="SELECT * from ".$table_prefix."wheel_data";
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
                        if(empty($probability_value))
                        {
                        $probability_value =0;
                        }
                        //$calculate_per_value['num'] = round(($probability_value * 10)/100);
                        $calculate_per_value['num'] = $probability_value;
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
                                $selcte_reward_list  = "SELECT * from ".$table_prefix."spin_result where created between '$date_get' and '$next_day' && reward_item='".$data_hwe_hwe['reward']."'";
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
                            foreach($data_hwe as $count_num => $data_hwe_hwe1)
                            {
                                $value1 = $data_hwe_hwe1['value'];
                                $reward1 = $data_hwe_hwe1['reward'];

                                array_push($array_1,$value1);
                                array_push($array_2,$reward1);
                            }
                            // print_r($data_hwe);
                            // die("gfhfghdf");
                            // shuffle($array_1);
                            $random_number = array_rand($array_1,1);
                
                            foreach($array_1 as $key => $array_1_hwe)
                            {
                                if($key == $random_number)
                                {
                        
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
                        else
                        {
                        // shuffle($array_1);
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

if(isset($_POST['get_random_spin_value_user_method']))
{

    if($host_name == "mplus88.asia" || $host_name == 'sgluckydraw88.com')
    {
       
        date_default_timezone_set("Asia/Kuala_Lumpur");

        $user_id='';
        if(isset($_POST['user_id']) && $_POST['user_id'] !='')
        {
            $user_id = $_POST['user_id'];
        }
    
        $select_user ="SELECT * from ".$table_prefix."user_table where `id`='".$user_id."'";
    
        $row4= $conn->query($select_user);
        $result_spin =mysqli_fetch_assoc($row4);
    
        $user_total_spin = $result_spin['user_total_spin'];
    
        // if(!$user_total_spin < 0)
        // {
          
                $all_data['data'] =array();
                $array_1 =$all_data['data'];
    
                $rewrd_data_hwe['reward'] =array();
                $array_2 =$rewrd_data_hwe['reward'];
                
            
                
                if(isset($_POST['user_spin_code']) && $_POST['user_spin_code'] !='')
                {
                    $get_generate_code = $_POST['user_spin_code'];
    
                    $selcte_reward_list  = "SELECT * from ".$table_prefix."codegenerate where generate_code='".$get_generate_code."' and status = '1'";
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
                        
                            
                            $select ="SELECT * from ".$table_prefix."wheel_data";
                        
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
                    
                            //echo json_encode($all_data_send);
            
                        }
                        else
                        {
                    
                            $all_data['data'] =array();
                            $array_1 =$all_data['data'];
                        
                            $rewrd_data_hwe['reward'] =array();
                            $array_2 =$rewrd_data_hwe['reward'];
                            
                            $select ="SELECT * from ".$table_prefix."wheel_data";
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
                                    if(empty($probability_value))
                                    {
                                    $probability_value =0;
                                    }
                                    //$calculate_per_value['num'] = round(($probability_value * 10)/100);
                                    $calculate_per_value['num'] = $probability_value;
                                    $calculate_per_value['value'] = $probability_prize;
                                    $calculate_per_value['reward'] = $decode_data['prize'.$i];
                                    if(isset($decode_data['no_matter_probability'.$i]))
                                    {
                                        $calculate_per_value['check_tick'] = $decode_data['no_matter_probability'.$i];
                                    }
                                    else
                                    {
                                        $calculate_per_value['check_tick'] = 0;
                                    }
                        
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
                                        $selcte_reward_list  = "SELECT * from ".$table_prefix."spin_result where created between '$date_get' and '$next_day' && reward_item='".$data_hwe_hwe['reward']."'";
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
                                    foreach($data_hwe as $count_num => $data_hwe_hwe1)
                                    {
                                        $value1 = $data_hwe_hwe1['value'];
                                        $reward1 = $data_hwe_hwe1['reward'];
    
                                        array_push($array_1,$value1);
                                        array_push($array_2,$reward1);
                                    }
    
                                    // shuffle($array_1);
                                    $random_number = array_rand($array_1,1);
                        
                                    foreach($array_1 as $key => $array_1_hwe)
                                    {
                                        if($key == $random_number)
                                        {
                                
                                                ///encryption keys
                                            $iv_length = openssl_cipher_iv_length(ciphering);
                                            $options = 0;
                                            
                                            $encryp_reward_id = openssl_encrypt('reward'.$array_1_hwe, ciphering,
                                            encryption_key, $options, encryption_iv);
                                
                                            $all_data_send['probability']=$encryp_reward_id;
                                            $all_data_send['reward']=$array_2[$key];
                                
                                            //echo json_encode($all_data_send);
                                
                                            unset($array_1[$random_number]);
                                        }
                                    }
                                }
                                else
                                {
                                    //shuffle($array_1);
                                    $random_number = array_rand($array_1,1);
                        
                                    foreach($array_1 as $key => $array_1_hwe)
                                    {
                                        if($key == $random_number)
                                        {
                                                                
                                        ///encryption keys
                                        $iv_length = openssl_cipher_iv_length(ciphering);
                                        $options = 0;
                                        
                                        $encryp_reward_id = openssl_encrypt('reward'.$array_1_hwe, ciphering,
                                        encryption_key, $options, encryption_iv);
                                
                                        $all_data_send['probability']=$encryp_reward_id;
                                        $all_data_send['reward']=$array_2[$key];
                                    
                                        //echo json_encode($all_data_send);
                            
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
                // $user_id=1;
    
                        $selcte_reward_list  = "SELECT * from ".$table_prefix."user_table where id='".$user_id."'";
                        $row_reward = $conn->query($selcte_reward_list);
                        $result_reward = mysqli_fetch_assoc($row_reward);
                        
                        $get_reward_spin_check = $result_reward['user_spin_type_login_method'];
                    
                        if($get_reward_spin_check == '1')
                        {
                            
                                $array_after_unset =array();
                                $array_after_unset1=array();
        
                                if($result_reward['save_array_after_unset_reward'] !='')
                                {
                                    $array_after_unset = json_decode($result_reward['save_array_after_unset_reward'],true);
    
                                }
                         
        
        
                                $all_data['data'] =array();
                                $array_1 =$all_data['data'];
                            
                                $rewrd_data_hwe['reward'] =array();
                                $array_2 =$rewrd_data_hwe['reward'];
                                
                                $select ="SELECT * from ".$table_prefix."wheel_data";
                                $row = $conn->query($select);
                                while($result = mysqli_fetch_assoc($row))
                                {
        
                                    $rewards_remain_spin_values = json_decode($result_reward['num_for_reward_reamin_spin'],true);
                                    
                                    
                                    $decode_data =json_decode($result['spin_data'],true);
                            
                                    $calculate_per_value =array();
                                    $data_hwe =array();
                                    for($i =0; $i < $decode_data['slice']; $i++)
                                    {
                                        $probability_value =  $rewards_remain_spin_values[$i];
                                        $probability_prize =  $i;
                                        if(empty($probability_value))
                                        {
                                            $probability_value =0;
                                        }
                                    
                                        $calculate_per_value['num'] = $probability_value;
                                        $calculate_per_value['value'] = $probability_prize;
                                        $calculate_per_value['reward'] = $decode_data['prize'.$i];
                                        if(isset($decode_data['no_matter_probability'.$i]))
                                        {
                                            $calculate_per_value['check_tick'] = $decode_data['no_matter_probability'.$i];
                                        }
                                        else
                                        {
                                            $calculate_per_value['check_tick'] = 0;
                                        }
                            
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
                                            $selcte_reward_list  = "SELECT * from ".$table_prefix."spin_result where created between '$date_get' and '$next_day' && reward_item='".$data_hwe_hwe['reward']."'";
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
                            
                                    if(count($array_after_unset) > 0)
                                    {
                    
                                            $random_number = array_rand($array_after_unset,1);
                                            
                                            $value_get_unset_array = $array_after_unset[$random_number];

                                            $status_check=0;
                                            foreach($array_1 as $key => $array_1_hwe)
                                            {
                                                
                                                if($array_1_hwe == $value_get_unset_array)
                                                {
                                                    $status_check=1;
                                                    $iv_length = openssl_cipher_iv_length(ciphering);
                                                    $options = 0;
                                    
                                                    $encryp_reward_id = openssl_encrypt('reward'.$array_1_hwe, ciphering,
                                                    encryption_key, $options, encryption_iv);
                                            
                                                    $all_data_send['probability']=$encryp_reward_id;
                                                    $all_data_send['reward']=$array_2[$key];
                                            
                                                    //echo json_encode($all_data_send);
                                        
                                                    unset($array_after_unset[$random_number]);
                                                    
                                                    $array_after_unset1 = json_encode($array_after_unset);
    
                                                    if(count($array_after_unset) > 0)
                                                    {
                                                        $update_array_after_unset ="UPDATE ".$table_prefix."user_table SET save_array_after_unset_reward='".$array_after_unset1."' where id='$user_id'";
                                                        mysqli_query($conn,$update_array_after_unset);
                                                    }
                                                    else
                                                    {
                                                        $update_array_after_unset ="UPDATE ".$table_prefix."user_table SET save_array_after_unset_reward='' where id='$user_id'";
                                                        mysqli_query($conn,$update_array_after_unset);
                                                    }
    
                                                    
                                
                                                }
                                            }

                                            if($status_check == 0)
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
                                                
                                                        //echo json_encode($all_data_send);
                                            
                                                        unset($array_1[$random_number]);
                                                        $array_after_unset = json_encode($array_1);
            
                                                        if(count($array_1) > 0)
                                                        {
                                                            $update_array_after_unset ="UPDATE ".$table_prefix."user_table SET save_array_after_unset_reward='".$array_after_unset."' where id='$user_id'";
                                                            mysqli_query($conn,$update_array_after_unset);
                                                        }
                                                        else
                                                        {
                                                            $update_array_after_unset ="UPDATE ".$table_prefix."user_table SET save_array_after_unset_reward='' where id='$user_id'";
                                                            mysqli_query($conn,$update_array_after_unset);
                                                        }
                                                        
                                    
                                                    }
                                                }
                                            }

                        
                                    }
                                    else
                                    {
    
                                    
                                    
                                        if(count($array_1) <=0 )
                                        {
                                            foreach($data_hwe as $count_num => $data_hwe_hwe1)
                                            {
                                                $value1 = $data_hwe_hwe1['value'];
                                                $reward1 = $data_hwe_hwe1['reward'];
        
                                                array_push($array_1,$value1);
                                                array_push($array_2,$reward1);
                                            }
                                            // print_r($data_hwe);
                                            // die("gfhfghdf");
                                            // shuffle($array_1);
                                            $random_number = array_rand($array_1,1);
                                
                                            foreach($array_1 as $key => $array_1_hwe)
                                            {
                                                if($key == $random_number)
                                                {
                                        
                                                        ///encryption keys
                                                    $iv_length = openssl_cipher_iv_length(ciphering);
                                                    $options = 0;
                                                    
                                                    $encryp_reward_id = openssl_encrypt('reward'.$array_1_hwe, ciphering,
                                                    encryption_key, $options, encryption_iv);
                                            
                                                    $all_data_send['probability']=$encryp_reward_id;
                                                    $all_data_send['reward']=$array_2[$key];
                                            
                                                    //echo json_encode($all_data_send);
                                        
                                                    unset($array_1[$random_number]);
                                                    $array_after_unset = json_encode($array_1);
        
                                                    if(count($array_1) > 0)
                                                    {
                                                        $update_array_after_unset ="UPDATE ".$table_prefix."user_table SET save_array_after_unset_reward='".$array_after_unset."' where id='$user_id'";
                                                        mysqli_query($conn,$update_array_after_unset);
                                                    }
                                                    else
                                                    {
                                                        $update_array_after_unset ="UPDATE ".$table_prefix."user_table SET save_array_after_unset_reward='' where id='$user_id'";
                                                        mysqli_query($conn,$update_array_after_unset);
                                                    }
                                                }
                                            }
                                        }
                                        else
                                        {
                                            // shuffle($array_1);
                                
                                            $random_number = array_rand($array_1,1);
                                            // if($_SESSION['user_id'] == '11')
                                            // {
                                            //     print_r($random_number);
                                            //     print_r($array_1);
                                            //     die("dfgf");
                                            // }
                            
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
                                            
                                                    //echo json_encode($all_data_send);
                                        
                                                    unset($array_1[$random_number]);
                                                    $array_after_unset = json_encode($array_1);
        
                                                    if(count($array_1) > 0)
                                                    {
                                                        $update_array_after_unset ="UPDATE ".$table_prefix."user_table SET save_array_after_unset_reward='".$array_after_unset."' where id='$user_id'";
                                                        mysqli_query($conn,$update_array_after_unset);
                                                    }
                                                    else
                                                    {
                                                        $update_array_after_unset ="UPDATE ".$table_prefix."user_table SET save_array_after_unset_reward='' where id='$user_id'";
                                                        mysqli_query($conn,$update_array_after_unset);
                                                    }
                                                    
                                
                                                }
                                            }
                                        }
                                    }
                                  
                                }
                           
                            
                        }
                        else
                        {
                            $all_data['data'] =array();
                            $array_1 =$all_data['data'];
                        
                            $rewrd_data_hwe['reward'] =array();
                            $array_2 =$rewrd_data_hwe['reward'];
    
                            $select ="SELECT * from ".$table_prefix."wheel_data";
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
                                    if(empty($probability_value))
                                    {
                                    $probability_value =0;
                                    }
                                    //$calculate_per_value['num'] = round(($probability_value * 10)/100);
                                    $calculate_per_value['num'] = $probability_value;
                                    $calculate_per_value['value'] = $probability_prize;
                                    $calculate_per_value['reward'] = $decode_data['prize'.$i];
                                    if(isset($decode_data['no_matter_probability'.$i]))
                                    {
                                        $calculate_per_value['check_tick'] = $decode_data['no_matter_probability'.$i];
                                    }
                                    else
                                    {
                                        $calculate_per_value['check_tick'] = 0;
                                    }
                                    
                        
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
                                            $selcte_reward_list  = "SELECT * from ".$table_prefix."spin_result where created between '$date_get' and '$next_day' && reward_item='".$data_hwe_hwe['reward']."'";
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
                                        foreach($data_hwe as $count_num => $data_hwe_hwe1)
                                        {
                                            $value1 = $data_hwe_hwe1['value'];
                                            $reward1 = $data_hwe_hwe1['reward'];
    
                                            array_push($array_1,$value1);
                                            array_push($array_2,$reward1);
                                        }
                                        // print_r($data_hwe);
                                        // die("gfhfghdf");
                                        // shuffle($array_1);
                                        $random_number = array_rand($array_1,1);
                            
                                        foreach($array_1 as $key => $array_1_hwe)
                                        {
                                            if($key == $random_number)
                                            {
                                    
                                                    ///encryption keys
                                                $iv_length = openssl_cipher_iv_length(ciphering);
                                                $options = 0;
                                                
                                                $encryp_reward_id = openssl_encrypt('reward'.$array_1_hwe, ciphering,
                                                encryption_key, $options, encryption_iv);
                                        
                                                $all_data_send['probability']=$encryp_reward_id;
                                                $all_data_send['reward']=$array_2[$key];
                                        
                                                //echo json_encode($all_data_send);
                                    
                                                unset($array_1[$random_number]);
                                            }
                                        }
                                    }
                                    else
                                    {
                                    // shuffle($array_1);
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
                                    
                                            //echo json_encode($all_data_send);
                                
                                            unset($array_1[$random_number]);
                            
                                            }
                                        }
                                    }
                            
                        
                            }
                        }
                        
            
                        
                }
    
                $spain_code = $_POST['spain_code'];
                $date = date("Y-m-d H:i:s");
    
                $decryption_hwe = openssl_decrypt($all_data_send['probability'], ciphering, 
                    encryption_key, $options, encryption_iv);
                $reward_id_hwe = str_replace('reward','',$decryption_hwe);
    
                 //lucky number data///
    
                 $select_reward ="SELECT * from ".$table_prefix."wheel_data";
                 $row_reward_wheel = $conn->query($select_reward);
                 $result_reward_wheel = mysqli_fetch_assoc($row_reward_wheel);
     
                 $spin_data =  json_decode($result_reward_wheel['spin_data'],true);
     
                 $total_slices = $spin_data['slice'];
     
                 $data_array =array();
                 for($i =0; $i <$total_slices; $i++ )
                 {
                     if(isset($spin_data['lucky_number_checkbox_'.$i]))
                     { 
                         if($spin_data['lucky_number_checkbox_'.$i] == '1')
                         {
                             $data_array[]=$i;
                         }
     
                     }
                 
                 
                     
                 }
                 $status=0;
                 $lucky_nuumber=0;
                 if(count($data_array)>0)
                 {
                     foreach($data_array as $data_array_hwe)
                     {
                         if($data_array_hwe == $reward_id_hwe)
                         {
                             $select_user = "SELECT * from domain_list_settings  where domain_name='$host_name'";
                             $row_user = $conn->query($select_user);
                             $result_user = mysqli_fetch_assoc($row_user);
     
                         
                             $lucky_number_data=1;
                             
                             $lucky_number_data = $result_user['lucky_number_data'];
                         
                             $lucky_nuumber = $lucky_number_data + 1;
     
                         
                             $lucky_nuumber_hwe = $lucky_nuumber;
     
                             
                             if($lucky_nuumber == 9999)
                             {
                                 $lucky_nuumber = 1;
                             }
                             $status=1;
     
                     
                                 $lucky_nuumber = str_pad($lucky_nuumber, 4, "0", STR_PAD_LEFT);
                         
     
     
                             $update ="UPDATE domain_list_settings SET lucky_number_data='$lucky_nuumber_hwe' where domain_name='$host_name'";
                             mysqli_query($conn,$update);
                         }
                     
                     }
                     
                 }
     
                 $lucky_nuumber_data =$all_data_send['reward'];
                 if($status == 1)
                 {
                     $lucky_nuumber_data = $all_data_send['reward'].'('.$lucky_nuumber.')';
                 }
     
                 //lucky number data///
    
                $update ="INSERT into ".$table_prefix."spin_result SET
                `user_id` = '".$user_id."',
                `reward_item` = '".$lucky_nuumber_data."',
                `reward_id` = '".$reward_id_hwe."',
                `created` ='".$date."',
                `datetime`='".$date."',
                `spin_code`='".$spain_code."'"; 
                
                mysqli_query($conn,$update);
    
                $last_insert_id = mysqli_insert_id($conn);
    
                if($spain_code != '')
                {
                    $selcte_reward_list_latest = "SELECT * from ".$table_prefix."spin_result where `spin_code`='".$spain_code."' order by id desc limit 1";
                }
                else
                {
                    $selcte_reward_list_latest  = "SELECT * from ".$table_prefix."spin_result where `user_id`='".$user_id."' && id='$last_insert_id' order by id desc limit 1";
                }
    
                $all_data_reward_latest='';
    
    
                $row_reward_latest = $conn->query($selcte_reward_list_latest);
                while($result_reward_latest = mysqli_fetch_assoc($row_reward_latest))
                {
                    //$reward_item_reward_latest = $result_reward_latest['reward_item'];
                    $reward_item_reward_latest = str_replace('<br />','',urldecode($result_reward_latest['reward_item']));
                    $user_email_reward_latest = $result_reward_latest['user_email'];
                    $reward_id_reward_latest = $result_reward_latest['id'];
                    $reward_id_hwe_reward_latest = $result_reward_latest['reward_id'];
                    $redeem_used_hwe_reward_latest = $result_reward_latest['redeem_used'];
                            
                    //get reward redeem details
                    $select_reward_latest="SELECT * from ".$table_prefix."wheel_data";
                    $row_reward_wheel_reward_latest = $conn->query($select_reward_latest);
                    $result_reward_wheel_reward_latest = mysqli_fetch_assoc($row_reward_wheel_reward_latest);
    
                    $spin_data_reward_latest =  json_decode($result_reward_wheel_reward_latest['spin_data'],true);
    
                    $redeem_button_hide_show = $spin_data_reward_latest['redeem_button_hide_show'];
                    $redeem_buttom_hide_show='style="display:block;"';
                    if($redeem_button_hide_show == '1' && $admin_redeem_button_enable == '1')
                    {
                        $redeem_buttom_hide_show = 'style="display:none;"';
                    }
    
                    $total_slices_reward_latest = $spin_data_reward_latest['slice'];
    
                    $img_url='';
                    $img_div='';
                    if(isset( $spin_data_reward_latest['no_matter_labal_image_hideshow'. $reward_id_hwe_reward_latest]))
                    {
                        $images_slice_data = $spin_data_reward_latest['no_matter_labal_image_hideshow'. $reward_id_hwe_reward_latest];
    
                        
                        if($images_slice_data == '1')
                        {
                                $img_url = 'admin_panel/pages/img/'. $host_name.$reward_id_hwe_reward_latest.'.png';
                                $img_div ='<div class="img_url_parent"><img src="'.$img_url.'" class="img_url_single_reward"/></div>';
                        }
                    }
               
    
                
    
                    $prize_reward_latest =array();
                    $redirect_onoff_reward_latest = 0;
                    $redirect_link_hwe_reward_latest = '';
                    for($i =0; $i <$total_slices_reward_latest; $i++ )
                    {
                        if($i==$reward_id_hwe_reward_latest) 
                        {
                            if($spin_data_reward_latest['reward_redirect_link_redeem'.$i])
                            {
                                $redirect_link_hwe_reward_latest = $spin_data_reward_latest['reward_redirect_link_redeem'.$i];
                            }
                            
                            if(isset($spin_data_reward_latest['no_matter_reward_redirect_link_redeem'.$i]))
                            {
                                $redirect_onoff_reward_latest = $spin_data_reward_latest['no_matter_reward_redirect_link_redeem'.$i];
                            }
                        
                        }
                    }
    
                    if($redeem_used_hwe_reward_latest == 1)
                    {
                        $all_data_reward_latest .= '
                        <div class="item disabled after_redeem_change_button_'.$reward_id_reward_latest.'">
                            '.$img_div.'
                            <div class="value" data-value="'.$reward_item_reward_latest.'">'.$reward_item_reward_latest.'</div>
                            <button class="btn-redeem disabled" '.$redeem_buttom_hide_show.'><span>USED</span></button>
                        </div>
                    ';
                    
                    }
                    else
                    {
    
                    if(isset($spin_data_reward_latest['redeem_button_text']) && $spin_data_reward_latest['redeem_button_text'] != '')
                    {
                        $redeem_button = $spin_data_reward_latest['redeem_button_text'];
                    }
                    else
                    {
                        $redeem_button = 'REDEEM';
                    }
                        
                    if($redirect_onoff_reward_latest==1)
                        {
                            $all_data_reward_latest .='
                                    <div class="item disabled after_redeem_change_button_'.$reward_id_reward_latest.'">
                                    '.$img_div.'
                                
                                    <div class="value" data-value="'.$reward_item_reward_latest.'">'.$reward_item_reward_latest.'</div>
                                    <a  onclick="spin_result_redeem_used_update('.$reward_id_reward_latest.')" target="_blank" '.$redeem_buttom_hide_show.' href="'.$redirect_link_hwe_reward_latest.'" ><button class="btn-redeem"><span>'.$redeem_button.'</span></button></a>
                                    </div>
                            ';
                        }
                        else
                        {
                            $all_data_reward_latest .='
                                    <div class="item disabled after_redeem_change_button_'.$reward_id_reward_latest.'">
                                        '.$img_div.'
                                        <div class="value" data-value="'.$reward_item_reward_latest.'">'.$reward_item_reward_latest.'</div>
                                        <button class="btn-redeem" '.$redeem_buttom_hide_show.' onclick="redeem('.$reward_id_reward_latest.')"><span>'.$redeem_button.'</span></button>
                                    </div>
                            ';
                        }
                    }
    
                   
                }
    
          
               
                $all_data_send['reward_list_latest_reward'] = $all_data_reward_latest;
                $all_data_send['lucky_nuumber'] = $lucky_nuumber;
    
    
                
    
                echo json_encode($all_data_send);
        
                   die();
    }
    else
    {

        date_default_timezone_set("Asia/Kuala_Lumpur");

        $user_id='';
        if(isset($_POST['user_id']) && $_POST['user_id'] !='')
        {
            $user_id = $_POST['user_id'];
        }

        $select_user ="SELECT * from ".$table_prefix."user_table where `id`='".$user_id."'";

        $row4= $conn->query($select_user);
        $result_spin =mysqli_fetch_assoc($row4);

        $user_total_spin = $result_spin['user_total_spin'];

        // if(!$user_total_spin < 0)
        // {
        
                $all_data['data'] =array();
                $array_1 =$all_data['data'];

                $rewrd_data_hwe['reward'] =array();
                $array_2 =$rewrd_data_hwe['reward'];
                
            
                
                
                // $check_for_mobile = '';
                // if($host_name == 'wgc33.vip')
                // {
                //     $check_for_mobile ='1';
                // }
                
                if(isset($_POST['user_spin_code']) && $_POST['user_spin_code'] !='')
                {
                    $get_generate_code = $_POST['user_spin_code'];

                    $selcte_reward_list  = "SELECT * from ".$table_prefix."codegenerate where generate_code='".$get_generate_code."' and status = '1'";
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
                        
                            
                            $select ="SELECT * from ".$table_prefix."wheel_data";
                        
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
                    
                            //echo json_encode($all_data_send);
            
                        }
                        else
                        {
                    
                            $all_data['data'] =array();
                            $array_1 =$all_data['data'];
                        
                            $rewrd_data_hwe['reward'] =array();
                            $array_2 =$rewrd_data_hwe['reward'];
                            
                            $select ="SELECT * from ".$table_prefix."wheel_data";
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
                                    if(empty($probability_value))
                                    {
                                    $probability_value =0;
                                    }
                                    //$calculate_per_value['num'] = round(($probability_value * 10)/100);
                                    $calculate_per_value['num'] = $probability_value;
                                    $calculate_per_value['value'] = $probability_prize;
                                    $calculate_per_value['reward'] = $decode_data['prize'.$i];
                                    if(isset($decode_data['no_matter_probability'.$i]))
                                    {
                                        $calculate_per_value['check_tick'] = $decode_data['no_matter_probability'.$i];
                                    }
                                    else
                                    {
                                        $calculate_per_value['check_tick'] = 0;
                                    }
                        
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
                                        $selcte_reward_list  = "SELECT * from ".$table_prefix."spin_result where created between '$date_get' and '$next_day' && reward_item='".$data_hwe_hwe['reward']."'";
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
                                    foreach($data_hwe as $count_num => $data_hwe_hwe1)
                                    {
                                        $value1 = $data_hwe_hwe1['value'];
                                        $reward1 = $data_hwe_hwe1['reward'];

                                        array_push($array_1,$value1);
                                        array_push($array_2,$reward1);
                                    }

                                    // shuffle($array_1);
                                    $random_number = array_rand($array_1,1);
                        
                                    foreach($array_1 as $key => $array_1_hwe)
                                    {
                                        if($key == $random_number)
                                        {
                                
                                                ///encryption keys
                                            $iv_length = openssl_cipher_iv_length(ciphering);
                                            $options = 0;
                                            
                                            $encryp_reward_id = openssl_encrypt('reward'.$array_1_hwe, ciphering,
                                            encryption_key, $options, encryption_iv);
                                
                                            $all_data_send['probability']=$encryp_reward_id;
                                            $all_data_send['reward']=$array_2[$key];
                                
                                            //echo json_encode($all_data_send);
                                
                                            unset($array_1[$random_number]);
                                        }
                                    }
                                }
                                else
                                {
                                    //shuffle($array_1);
                                    $random_number = array_rand($array_1,1);
                        
                                    foreach($array_1 as $key => $array_1_hwe)
                                    {
                                        if($key == $random_number)
                                        {
                                                                
                                        ///encryption keys
                                        $iv_length = openssl_cipher_iv_length(ciphering);
                                        $options = 0;
                                        
                                        $encryp_reward_id = openssl_encrypt('reward'.$array_1_hwe, ciphering,
                                        encryption_key, $options, encryption_iv);
                                
                                        $all_data_send['probability']=$encryp_reward_id;
                                        $all_data_send['reward']=$array_2[$key];
                                    
                                        //echo json_encode($all_data_send);
                            
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
                // $user_id=1;

                        $selcte_reward_list  = "SELECT * from ".$table_prefix."user_table where id='".$user_id."'";
                        $row_reward = $conn->query($selcte_reward_list);
                        $result_reward = mysqli_fetch_assoc($row_reward);
                        
                        $get_reward_spin_check = $result_reward['user_spin_type_login_method'];
                    
                        if($get_reward_spin_check == '1')
                        {
                            if($host_name == 'spin2win88.com')
                            {
                                $array_after_unset =array();
                                $array_after_unset1=array();
        
                                if($result_reward['save_array_after_unset_reward'] !='')
                                {
                                    $array_after_unset = json_decode($result_reward['save_array_after_unset_reward'],true);

                                }
                        
        
        
                                $all_data['data'] =array();
                                $array_1 =$all_data['data'];
                            
                                $rewrd_data_hwe['reward'] =array();
                                $array_2 =$rewrd_data_hwe['reward'];
                                
                                $select ="SELECT * from ".$table_prefix."wheel_data";
                                $row = $conn->query($select);
                                while($result = mysqli_fetch_assoc($row))
                                {
        
                                    $rewards_remain_spin_values = json_decode($result_reward['num_for_reward_reamin_spin'],true);
                                    
                                    
                                    $decode_data =json_decode($result['spin_data'],true);
                            
                                    $calculate_per_value =array();
                                    $data_hwe =array();
                                    for($i =0; $i < $decode_data['slice']; $i++)
                                    {
                                        $probability_value =  $rewards_remain_spin_values[$i];
                                        $probability_prize =  $i;
                                        if(empty($probability_value))
                                        {
                                        $probability_value =0;
                                        }
                                    
                                        $calculate_per_value['num'] = $probability_value;
                                        $calculate_per_value['value'] = $probability_prize;
                                        $calculate_per_value['reward'] = $decode_data['prize'.$i];
                                        if(isset($decode_data['no_matter_probability'.$i]))
                                        {
                                            $calculate_per_value['check_tick'] = $decode_data['no_matter_probability'.$i];
                                        }
                                        else
                                        {
                                            $calculate_per_value['check_tick'] = 0;
                                        }
                            
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
                                                $selcte_reward_list  = "SELECT * from ".$table_prefix."spin_result where created between '$date_get' and '$next_day' && reward_item='".$data_hwe_hwe['reward']."'";
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
                            
                                        
                            
                                        if(count($array_after_unset) > 0)
                                        {
                        
                                                $random_number = array_rand($array_after_unset,1);
                                                
                                                $value_get_unset_array = $array_after_unset[$random_number];
                                            $status_check=0;
                                                foreach($array_1 as $key => $array_1_hwe)
                                                {
                                                    
                                                    if($array_1_hwe == $value_get_unset_array)
                                                    {
                                                        $status_check=1;
                                                        $iv_length = openssl_cipher_iv_length(ciphering);
                                                        $options = 0;
                                        
                                                        $encryp_reward_id = openssl_encrypt('reward'.$array_1_hwe, ciphering,
                                                        encryption_key, $options, encryption_iv);
                                                
                                                        $all_data_send['probability']=$encryp_reward_id;
                                                        $all_data_send['reward']=$array_2[$key];
                                                
                                                        //echo json_encode($all_data_send);
                                            
                                                        unset($array_after_unset[$random_number]);
                                                        
                                                        $array_after_unset1 = json_encode($array_after_unset);
        
                                                        if(count($array_after_unset) > 0)
                                                        {
                                                            $update_array_after_unset ="UPDATE ".$table_prefix."user_table SET save_array_after_unset_reward='".$array_after_unset1."' where id='$user_id'";
                                                            mysqli_query($conn,$update_array_after_unset);
                                                        }
                                                        else
                                                        {
                                                            $update_array_after_unset ="UPDATE ".$table_prefix."user_table SET save_array_after_unset_reward='' where id='$user_id'";
                                                            mysqli_query($conn,$update_array_after_unset);
                                                        }
        
                                                        
                                    
                                                    }
                                                }

                                                if($status_check == 0)
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
                                                    
                                                            //echo json_encode($all_data_send);
                                                
                                                            unset($array_1[$random_number]);
                                                            $array_after_unset = json_encode($array_1);
                
                                                            if(count($array_1) > 0)
                                                            {
                                                                $update_array_after_unset ="UPDATE ".$table_prefix."user_table SET save_array_after_unset_reward='".$array_after_unset."' where id='$user_id'";
                                                                mysqli_query($conn,$update_array_after_unset);
                                                            }
                                                            else
                                                            {
                                                                $update_array_after_unset ="UPDATE ".$table_prefix."user_table SET save_array_after_unset_reward='' where id='$user_id'";
                                                                mysqli_query($conn,$update_array_after_unset);
                                                            }
                                                            
                                        
                                                        }
                                                    }
                                                }

                        
                                        }
                                        else
                                        {
        
                                        
                                        
                                        if(count($array_1) <=0 )
                                        {
                                            foreach($data_hwe as $count_num => $data_hwe_hwe1)
                                            {
                                                $value1 = $data_hwe_hwe1['value'];
                                                $reward1 = $data_hwe_hwe1['reward'];
        
                                                array_push($array_1,$value1);
                                                array_push($array_2,$reward1);
                                            }
                                            // print_r($data_hwe);
                                            // die("gfhfghdf");
                                            // shuffle($array_1);
                                            $random_number = array_rand($array_1,1);
                                
                                            foreach($array_1 as $key => $array_1_hwe)
                                            {
                                                if($key == $random_number)
                                                {
                                        
                                                        ///encryption keys
                                                    $iv_length = openssl_cipher_iv_length(ciphering);
                                                    $options = 0;
                                                    
                                                    $encryp_reward_id = openssl_encrypt('reward'.$array_1_hwe, ciphering,
                                                    encryption_key, $options, encryption_iv);
                                            
                                                    $all_data_send['probability']=$encryp_reward_id;
                                                    $all_data_send['reward']=$array_2[$key];
                                            
                                                    //echo json_encode($all_data_send);
                                        
                                                    unset($array_1[$random_number]);
                                                }
                                            }
                                        }
                                        else
                                        {
                                            // shuffle($array_1);
                                
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
                                            
                                                    //echo json_encode($all_data_send);
                                        
                                                    unset($array_1[$random_number]);
                                                    $array_after_unset = json_encode($array_1);
        
                                                    if(count($array_1) > 0)
                                                    {
                                                        $update_array_after_unset ="UPDATE ".$table_prefix."user_table SET save_array_after_unset_reward='".$array_after_unset."' where id='$user_id'";
                                                        mysqli_query($conn,$update_array_after_unset);
                                                    }
                                                    else
                                                    {
                                                        $update_array_after_unset ="UPDATE ".$table_prefix."user_table SET save_array_after_unset_reward='' where id='$user_id'";
                                                        mysqli_query($conn,$update_array_after_unset);
                                                    }
                                                    
                                
                                                }
                                            }
                                        }
                                    }
        
                                
                                }
                            }
                            else
                            {

                            
                            $array_after_unset =array();
                            $array_after_unset1=array();

                            if($result_reward['save_array_after_unset_reward'] !='')
                            {
                                $array_after_unset = json_decode($result_reward['save_array_after_unset_reward'],true);
                            }
                            


                            $all_data['data'] =array();
                            $array_1 =$all_data['data'];
                        
                            $rewrd_data_hwe['reward'] =array();
                            $array_2 =$rewrd_data_hwe['reward'];
                            
                            $select ="SELECT * from ".$table_prefix."wheel_data";
                            $row = $conn->query($select);
                            while($result = mysqli_fetch_assoc($row))
                            {

                                $rewards_remain_spin_values = json_decode($result_reward['num_for_reward_reamin_spin'],true);
                                
                                
                                $decode_data =json_decode($result['spin_data'],true);
                        
                                $calculate_per_value =array();
                                $data_hwe =array();
                                for($i =0; $i < $decode_data['slice']; $i++)
                                {
                                    $probability_value =  $rewards_remain_spin_values[$i];
                                    $probability_prize =  $i;
                                    if(empty($probability_value))
                                    {
                                    $probability_value =0;
                                    }
                                
                                    $calculate_per_value['num'] = $probability_value;
                                    $calculate_per_value['value'] = $probability_prize;
                                    $calculate_per_value['reward'] = $decode_data['prize'.$i];
                                    if(isset($decode_data['no_matter_probability'.$i]))
                                    {
                                        $calculate_per_value['check_tick'] = $decode_data['no_matter_probability'.$i];
                                    }
                                    else
                                    {
                                        $calculate_per_value['check_tick'] = 0;
                                    }
                        
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
                                            $selcte_reward_list  = "SELECT * from ".$table_prefix."spin_result where created between '$date_get' and '$next_day' && reward_item='".$data_hwe_hwe['reward']."'";
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
                        
                        
                                    if(count($array_after_unset) > 0)
                                    {
                    
                                            $random_number = array_rand($array_after_unset,1);
                                            
                                            $value_get_unset_array = $array_after_unset[$random_number];
                        
                                            foreach($array_1 as $key => $array_1_hwe)
                                            {
                                                
                                                if($array_1_hwe == $value_get_unset_array)
                                                {
                                            
                                                    $iv_length = openssl_cipher_iv_length(ciphering);
                                                    $options = 0;
                                    
                                                    $encryp_reward_id = openssl_encrypt('reward'.$array_1_hwe, ciphering,
                                                    encryption_key, $options, encryption_iv);
                                            
                                                    $all_data_send['probability']=$encryp_reward_id;
                                                    $all_data_send['reward']=$array_2[$key];
                                            
                                                    //echo json_encode($all_data_send);
                                        
                                                    unset($array_after_unset[$random_number]);
                                                    
                                                    $array_after_unset1 = json_encode($array_after_unset);

                                                    if(count($array_after_unset) > 0)
                                                    {
                                                        $update_array_after_unset ="UPDATE ".$table_prefix."user_table SET save_array_after_unset_reward='".$array_after_unset1."' where id='$user_id'";
                                                        mysqli_query($conn,$update_array_after_unset);
                                                    }
                                                    else
                                                    {
                                                        $update_array_after_unset ="UPDATE ".$table_prefix."user_table SET save_array_after_unset_reward='' where id='$user_id'";
                                                        mysqli_query($conn,$update_array_after_unset);
                                                    }

                                                    
                                
                                                }
                                            }
                                    }
                                    else
                                    {

                                    

                                    
                                    
                                    if(count($array_1) <=0 )
                                    {
                                        foreach($data_hwe as $count_num => $data_hwe_hwe1)
                                        {
                                            $value1 = $data_hwe_hwe1['value'];
                                            $reward1 = $data_hwe_hwe1['reward'];

                                            array_push($array_1,$value1);
                                            array_push($array_2,$reward1);
                                        }
                                        // print_r($data_hwe);
                                        // die("gfhfghdf");
                                        // shuffle($array_1);
                                        $random_number = array_rand($array_1,1);
                            
                                        foreach($array_1 as $key => $array_1_hwe)
                                        {
                                            if($key == $random_number)
                                            {
                                    
                                                    ///encryption keys
                                                $iv_length = openssl_cipher_iv_length(ciphering);
                                                $options = 0;
                                                
                                                $encryp_reward_id = openssl_encrypt('reward'.$array_1_hwe, ciphering,
                                                encryption_key, $options, encryption_iv);
                                        
                                                $all_data_send['probability']=$encryp_reward_id;
                                                $all_data_send['reward']=$array_2[$key];
                                        
                                                //echo json_encode($all_data_send);
                                    
                                                unset($array_1[$random_number]);
                                            }
                                        }
                                    }
                                    else
                                    {
                                        // shuffle($array_1);
                            
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
                                        
                                                //echo json_encode($all_data_send);
                                    
                                                unset($array_1[$random_number]);
                                                $array_after_unset = json_encode($array_1);

                                                if(count($array_1) > 0)
                                                {
                                                    $update_array_after_unset ="UPDATE ".$table_prefix."user_table SET save_array_after_unset_reward='".$array_after_unset."' where id='$user_id'";
                                                    mysqli_query($conn,$update_array_after_unset);
                                                }
                                                else
                                                {
                                                    $update_array_after_unset ="UPDATE ".$table_prefix."user_table SET save_array_after_unset_reward='' where id='$user_id'";
                                                    mysqli_query($conn,$update_array_after_unset);
                                                }
                                                
                            
                                            }
                                        }
                                    }
                                }

                            
                            }
                        }
                        }
                        else
                        {
                            $all_data['data'] =array();
                            $array_1 =$all_data['data'];
                        
                            $rewrd_data_hwe['reward'] =array();
                            $array_2 =$rewrd_data_hwe['reward'];

                            $select ="SELECT * from ".$table_prefix."wheel_data";
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
                                    if(empty($probability_value))
                                    {
                                    $probability_value =0;
                                    }
                                    //$calculate_per_value['num'] = round(($probability_value * 10)/100);
                                    $calculate_per_value['num'] = $probability_value;
                                    $calculate_per_value['value'] = $probability_prize;
                                    $calculate_per_value['reward'] = $decode_data['prize'.$i];
                                    if(isset($decode_data['no_matter_probability'.$i]))
                                    {
                                        $calculate_per_value['check_tick'] = $decode_data['no_matter_probability'.$i];
                                    }
                                    else
                                    {
                                        $calculate_per_value['check_tick'] = 0;
                                    }
                                    
                        
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
                                            $selcte_reward_list  = "SELECT * from ".$table_prefix."spin_result where created between '$date_get' and '$next_day' && reward_item='".$data_hwe_hwe['reward']."'";
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
                                        foreach($data_hwe as $count_num => $data_hwe_hwe1)
                                        {
                                            $value1 = $data_hwe_hwe1['value'];
                                            $reward1 = $data_hwe_hwe1['reward'];

                                            array_push($array_1,$value1);
                                            array_push($array_2,$reward1);
                                        }
                                        // print_r($data_hwe);
                                        // die("gfhfghdf");
                                        // shuffle($array_1);
                                        $random_number = array_rand($array_1,1);
                            
                                        foreach($array_1 as $key => $array_1_hwe)
                                        {
                                            if($key == $random_number)
                                            {
                                    
                                                    ///encryption keys
                                                $iv_length = openssl_cipher_iv_length(ciphering);
                                                $options = 0;
                                                
                                                $encryp_reward_id = openssl_encrypt('reward'.$array_1_hwe, ciphering,
                                                encryption_key, $options, encryption_iv);
                                        
                                                $all_data_send['probability']=$encryp_reward_id;
                                                $all_data_send['reward']=$array_2[$key];
                                        
                                                //echo json_encode($all_data_send);
                                    
                                                unset($array_1[$random_number]);
                                            }
                                        }
                                    }
                                    else
                                    {
                                    // shuffle($array_1);
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
                                    
                                            //echo json_encode($all_data_send);
                                
                                            unset($array_1[$random_number]);
                            
                                            }
                                        }
                                    }
                            
                        
                            }
                        }
                        
            
                        
                }

                $spain_code = $_POST['spain_code'];
                $date = date("Y-m-d H:i:s");

                $decryption_hwe = openssl_decrypt($all_data_send['probability'], ciphering, 
                    encryption_key, $options, encryption_iv);
                $reward_id_hwe = str_replace('reward','',$decryption_hwe);

                //lucky number data///

                $select_reward ="SELECT * from ".$table_prefix."wheel_data";
                $row_reward_wheel = $conn->query($select_reward);
                $result_reward_wheel = mysqli_fetch_assoc($row_reward_wheel);
    
                $spin_data =  json_decode($result_reward_wheel['spin_data'],true);
    
                $total_slices = $spin_data['slice'];
    
                $data_array =array();
                for($i =0; $i <$total_slices; $i++ )
                {
                    if(isset($spin_data['lucky_number_checkbox_'.$i]))
                    { 
                        if($spin_data['lucky_number_checkbox_'.$i] == '1')
                        {
                            $data_array[]=$i;
                        }
    
                    }
                
                
                    
                }
                $status=0;
                $lucky_nuumber=0;
                if(count($data_array)>0)
                {
                    foreach($data_array as $data_array_hwe)
                    {
                        if($data_array_hwe == $reward_id_hwe)
                        {
                            $select_user = "SELECT * from domain_list_settings  where domain_name='$host_name'";
                            $row_user = $conn->query($select_user);
                            $result_user = mysqli_fetch_assoc($row_user);
    
                        
                            $lucky_number_data=1;
                            
                            $lucky_number_data = $result_user['lucky_number_data'];
                        
                            $lucky_nuumber = $lucky_number_data + 1;
    
                        
                            $lucky_nuumber_hwe = $lucky_nuumber;
    
                            
                            if($lucky_nuumber == 9999)
                            {
                                $lucky_nuumber = 1;
                            }
                            $status=1;
    
                    
                                $lucky_nuumber = str_pad($lucky_nuumber, 4, "0", STR_PAD_LEFT);
                        
    
    
                            $update ="UPDATE domain_list_settings SET lucky_number_data='$lucky_nuumber_hwe' where domain_name='$host_name'";
                            mysqli_query($conn,$update);
                        }
                    
                    }
                    
                }
    
                $lucky_nuumber_data =$all_data_send['reward'];
                if($status == 1)
                {
                    $lucky_nuumber_data = $all_data_send['reward'].'('.$lucky_nuumber.')';
                }
    
                //lucky number data///

                $update ="INSERT into ".$table_prefix."spin_result SET
                `user_id` = '".$user_id."',
                `reward_item` = '".$lucky_nuumber_data."',
                `reward_id` = '".$reward_id_hwe."',
                `created` ='".$date."',
                `datetime`='".$date."',
                `spin_code`='".$spain_code."'"; 
                
                mysqli_query($conn,$update);

                $last_insert_id = mysqli_insert_id($conn);

                if($spain_code != '')
                {
                    $selcte_reward_list_latest = "SELECT * from ".$table_prefix."spin_result where `spin_code`='".$spain_code."' order by id desc limit 1";
                }
                else
                {
                    $selcte_reward_list_latest  = "SELECT * from ".$table_prefix."spin_result where `user_id`='".$user_id."' && id='$last_insert_id' order by id desc limit 1";
                }

                $all_data_reward_latest='';


                $row_reward_latest = $conn->query($selcte_reward_list_latest);
                while($result_reward_latest = mysqli_fetch_assoc($row_reward_latest))
                {
                    //$reward_item_reward_latest = $result_reward_latest['reward_item'];
                    $reward_item_reward_latest = str_replace('<br />','',urldecode($result_reward_latest['reward_item']));
                    $user_email_reward_latest = $result_reward_latest['user_email'];
                    $reward_id_reward_latest = $result_reward_latest['id'];
                    $reward_id_hwe_reward_latest = $result_reward_latest['reward_id'];
                    $redeem_used_hwe_reward_latest = $result_reward_latest['redeem_used'];
                            
                    //get reward redeem details
                    $select_reward_latest="SELECT * from ".$table_prefix."wheel_data";
                    $row_reward_wheel_reward_latest = $conn->query($select_reward_latest);
                    $result_reward_wheel_reward_latest = mysqli_fetch_assoc($row_reward_wheel_reward_latest);

                    $spin_data_reward_latest =  json_decode($result_reward_wheel_reward_latest['spin_data'],true);

                    $redeem_button_hide_show = $spin_data_reward_latest['redeem_button_hide_show'];
                    $redeem_buttom_hide_show='style="display:block;"';
                    if($redeem_button_hide_show == '1' && $admin_redeem_button_enable == '1')
                    {
                        $redeem_buttom_hide_show = 'style="display:none;"';
                    }

                    $total_slices_reward_latest = $spin_data_reward_latest['slice'];

                    $img_url='';
                    $img_div='';
                    if(isset( $spin_data_reward_latest['no_matter_labal_image_hideshow'. $reward_id_hwe_reward_latest]))
                    {
                        $images_slice_data = $spin_data_reward_latest['no_matter_labal_image_hideshow'. $reward_id_hwe_reward_latest];

                        
                        if($images_slice_data == '1')
                        {
                                $img_url = 'admin_panel/pages/img/'. $host_name.$reward_id_hwe_reward_latest.'.png';
                                $img_div ='<div class="img_url_parent"><img src="'.$img_url.'" class="img_url_single_reward"/></div>';
                        }
                    }
            

                

                    $prize_reward_latest =array();
                    $redirect_onoff_reward_latest = 0;
                    $redirect_link_hwe_reward_latest = '';
                    for($i =0; $i <$total_slices_reward_latest; $i++ )
                    {
                        if($i==$reward_id_hwe_reward_latest) 
                        {
                            if($spin_data_reward_latest['reward_redirect_link_redeem'.$i])
                            {
                                $redirect_link_hwe_reward_latest = $spin_data_reward_latest['reward_redirect_link_redeem'.$i];
                            }
                            
                            if(isset($spin_data_reward_latest['no_matter_reward_redirect_link_redeem'.$i]))
                            {
                                $redirect_onoff_reward_latest = $spin_data_reward_latest['no_matter_reward_redirect_link_redeem'.$i];
                            }
                        
                        }
                    }

                    if($redeem_used_hwe_reward_latest == 1)
                    {
                        $all_data_reward_latest .= '
                        <div class="item disabled after_redeem_change_button_'.$reward_id_reward_latest.'">
                            '.$img_div.'
                            <div class="value" data-value="'.$reward_item_reward_latest.'">'.$reward_item_reward_latest.'</div>
                            <button class="btn-redeem disabled" '.$redeem_buttom_hide_show.'><span>USED</span></button>
                        </div>
                    ';
                    
                    }
                    else
                    {

                    if(isset($spin_data_reward_latest['redeem_button_text']) && $spin_data_reward_latest['redeem_button_text'] != '')
                    {
                        $redeem_button = $spin_data_reward_latest['redeem_button_text'];
                    }
                    else
                    {
                        $redeem_button = 'REDEEM';
                    }
                        
                    if($redirect_onoff_reward_latest==1)
                        {
                            $all_data_reward_latest .='
                                    <div class="item disabled after_redeem_change_button_'.$reward_id_reward_latest.'">
                                    '.$img_div.'
                                
                                    <div class="value" data-value="'.$reward_item_reward_latest.'">'.$reward_item_reward_latest.'</div>
                                    <a  onclick="spin_result_redeem_used_update('.$reward_id_reward_latest.')" target="_blank" '.$redeem_buttom_hide_show.' href="'.$redirect_link_hwe_reward_latest.'" ><button class="btn-redeem"><span>'.$redeem_button.'</span></button></a>
                                    </div>
                            ';
                        }
                        else
                        {
                            $all_data_reward_latest .='
                                    <div class="item disabled after_redeem_change_button_'.$reward_id_reward_latest.'">
                                        '.$img_div.'
                                        <div class="value" data-value="'.$reward_item_reward_latest.'">'.$reward_item_reward_latest.'</div>
                                        <button class="btn-redeem" '.$redeem_buttom_hide_show.' onclick="redeem('.$reward_id_reward_latest.')"><span>'.$redeem_button.'</span></button>
                                    </div>
                            ';
                        }
                    }

                
                }

        
            
                $all_data_send['reward_list_latest_reward'] = $all_data_reward_latest;
                $all_data_send['lucky_nuumber'] = $lucky_nuumber;


                

                echo json_encode($all_data_send);
        
                die();
    }
   
}




if (isset($_POST['status_active'])) {

    $checked =$_POST['checked'];

 
    foreach($checked as $key => $value){

        // if($key == 0)
        // {
        //     continue;
        // }
        // if($value == 'undefined')
        // {
        //     continue;
        // }

        echo $query = "update ".$table_prefix."phonenogenerate set status ='0' where `id`='$value'";

        $result = $conn->query($query);

    }

    die();

}

if(isset($_POST['get_images_labels_show_on_wheel_value']))
{

    $select ="SELECT * from ".$table_prefix."wheel_data";
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
    $select ="SELECT * from ".$table_prefix."wheel_data";
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

    $select ="SELECT * from ".$table_prefix."wheel_data";
    $row = $conn->query($select);
    $result = mysqli_fetch_assoc($row);

    $spin_data =  json_decode($result['spin_data'],true);

    $total_slices = $spin_data['slice'];
   
    $prize =array();
    for($i =0; $i <$total_slices; $i++ )
    {
      
        if(isset($spin_data['probability'.$i]))
        {
            $probability = $spin_data['probability'.$i];
        }
        else
        {
            $probability=0;
        }
        $prize[]['probability'] = $probability;
       
    }

    echo json_encode($prize);

   die; 

}

if(isset($_POST['get_reward_data_list']))
{

    $select ="SELECT * from ".$table_prefix."wheel_data";
    $row = $conn->query($select);
    $result = mysqli_fetch_assoc($row);

    $spin_data =  json_decode($result['spin_data'],true);

    $total_slices = $spin_data['slice'];
   
    $prize =array();
    for($i =0; $i <$total_slices; $i++ )
    {
      
        // $prize[]['prize'] = $spin_data['prize'.$i];
        $prize[]['prize'] = str_replace('<br />','',urldecode($spin_data['prize'.$i]));
       
    }

    echo json_encode($prize);

   die; 

}

if(isset($_POST['get_set_prize_for_once_day']))
{

    $select ="SELECT * from ".$table_prefix."wheel_data";
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

if(isset($_POST['lucky_number_checkbox']))
{

    $select ="SELECT * from ".$table_prefix."wheel_data";
    $row = $conn->query($select);
    $result = mysqli_fetch_assoc($row);

    $spin_data =  json_decode($result['spin_data'],true);

    $total_slices = $spin_data['slice'];
   
    $prize =array();
    for($i =0; $i <$total_slices; $i++ )
    {
      
        $prize[]['lucky_number_checkbox'] = $spin_data['lucky_number_checkbox_'.$i];
       
    }

    echo json_encode($prize);

   die; 

}



if(isset($_POST['random_lucky_number']))
{

    $user_id = $_POST['user_id'];
    $reward_id_hwe = $_POST['reward_id_hwe'];

    $decryption_hwe = openssl_decrypt ($reward_id_hwe, ciphering, 
        encryption_key, $options, encryption_iv);
    $reward_id_hwe = str_replace('reward','',$decryption_hwe);
    
    $select_reward ="SELECT * from ".$table_prefix."wheel_data";
    $row_reward_wheel = $conn->query($select_reward);
    $result_reward_wheel = mysqli_fetch_assoc($row_reward_wheel);

    $spin_data =  json_decode($result_reward_wheel['spin_data'],true);

    $total_slices = $spin_data['slice'];

    

    
    $output=array();
   
    $data_array =array();
    for($i =0; $i <$total_slices; $i++ )
    {
        
        if($spin_data['lucky_number_checkbox_'.$i] == '1')
        {
            $data_array[]=$i;
        }
       
        
    }
    $status=0;
    if(count($data_array)>0)
    {
        foreach($data_array as $data_array_hwe)
        {
            if($data_array_hwe == $reward_id_hwe)
            {
                $select_user = "SELECT * from ".$table_prefix."user_table  where id='$user_id'";
                $row_user = $conn->query($select_user);
                $result_user = mysqli_fetch_assoc($row_user);

               
                    $lucky_number_data=1;
                    $lucky_number_data = $result_user['lucky_number_data'];
             
                 $lucky_nuumber = $lucky_number_data + 1;

              
                 $lucky_nuumber_hwe = $lucky_nuumber;

                
                 if($lucky_nuumber == 9999)
                 {
                    $lucky_nuumber = 1;
                 }
                 $status=1;

                //  if($lucky_nuumber < 10)
                //  {
                    $lucky_nuumber = str_pad($lucky_nuumber, 4, "0", STR_PAD_LEFT);
                //  }
                //  else if($lucky_nuumber > 9 && $lucky_nuumber < 100)
                //  {
                //     $lucky_nuumber = str_pad($lucky_nuumber, 4, "0", STR_PAD_LEFT);
                //  }
                //  else if($lucky_nuumber > 99 && $lucky_nuumber <1000)
                //  {
                //     $lucky_nuumber = str_pad($lucky_nuumber, 4, "0", STR_PAD_LEFT);
                //  }
                //  else if($lucky_nuumber > 999)
                //  {
                //     $lucky_nuumber = $lucky_nuumber;
                //  }


                 $update ="UPDATE ".$table_prefix."user_table SET lucky_number_data='$lucky_nuumber_hwe' where id='$user_id'";
                 mysqli_query($conn,$update);
            }
           
        }
         
    }
 
    $output["status"] = $status;
    $output["lucky_nuumber"] = $lucky_nuumber;

      
    echo json_encode($output);
   die; 

}


if(isset($_POST['reward_labal_image_checkbox']))
{

    $select ="SELECT * from ".$table_prefix."wheel_data";
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

if(isset($_POST['slice_color_hwe']))
{

    $select ="SELECT * from ".$table_prefix."wheel_data";
    $row = $conn->query($select);
    $result = mysqli_fetch_assoc($row);

    $spin_data =  json_decode($result['spin_data'],true);

    $total_slices = $spin_data['slice'];
   
    $prize =array();
    for($i =0; $i <$total_slices; $i++ )
    {
        $prize[]['slice_colorhwe'] = $spin_data['slice_color_'.$i];
    }

    echo json_encode($prize);
   die; 
}

if(isset($_POST['slice_color_checkbox']))
{

    $select ="SELECT * from ".$table_prefix."wheel_data";
    $row = $conn->query($select);
    $result = mysqli_fetch_assoc($row);

    $spin_data =  json_decode($result['spin_data'],true);

    $total_slices = $spin_data['slice'];
   
    $prize =array();
    for($i =0; $i <$total_slices; $i++ )
    {
        $prize[]['slice_color_checkbox'] = $spin_data['slice_color_checkbox_'.$i];
    }

    echo json_encode($prize);
   die; 
}

if(isset($_POST['slice_text_color_hwe']))
{

    $select ="SELECT * from ".$table_prefix."wheel_data";
    $row = $conn->query($select);
    $result = mysqli_fetch_assoc($row);

    $spin_data =  json_decode($result['spin_data'],true);

    $total_slices = $spin_data['slice'];
   
    $prize =array();
    for($i =0; $i <$total_slices; $i++ )
    {
        $prize[]['slice_text_colorhwe'] = $spin_data['slice_text_color_'.$i];
    }

    echo json_encode($prize);
   die; 
}

if(isset($_POST['slice_text_color_checkbox']))
{

    $select ="SELECT * from ".$table_prefix."wheel_data";
    $row = $conn->query($select);
    $result = mysqli_fetch_assoc($row);

    $spin_data =  json_decode($result['spin_data'],true);

    $total_slices = $spin_data['slice'];
   
    $prize =array();
    for($i =0; $i <$total_slices; $i++ )
    {
        $prize[]['slice_text_color_checkbox'] = $spin_data['slice_text_color_checkbox_'.$i];
    }

    echo json_encode($prize);
   die; 
}


if(isset($_POST['reward_redirect_link_redeem_div']))
{

    $select ="SELECT * from ".$table_prefix."wheel_data";
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

    $select ="SELECT * from ".$table_prefix."wheel_data";
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

if(isset($_POST['text_images_together']))
{

    $select ="SELECT * from ".$table_prefix."wheel_data";
    $row = $conn->query($select);
    $result = mysqli_fetch_assoc($row);

    $spin_data =  json_decode($result['spin_data'],true);

    $total_slices = $spin_data['slice'];
   
    $prize =array();
    for($i =0; $i <$total_slices; $i++ )
    {
        $prize[]['text_images_together'] = $spin_data['text_images_together'.$i];
    }

    echo json_encode($prize);
   die; 
}


if(isset($_POST['set_user_spin']))
{

    $user_id = $_POST['user_id'];
    $user_spin = $_POST['user_spin'];
    $admin_set_total_spin1 = $_POST['admin_set_total_spin'];



    $select ="SELECT * from ".$table_prefix."user_table where `id`='".$user_id."'";

    $row = $conn->query($select);
    $result_spin =mysqli_fetch_assoc($row);
    $count  = mysqli_num_rows($row);
    if($count > 0)
    {
      if(!empty($result_spin['user_total_spin']) && $result_spin['user_total_spin'] > 0 )
      {
        
         $admin_set_total_spin = $result_spin['user_total_spin'] - 1;

         $update ="UPDATE ".$table_prefix."user_table SET
        `user_spinned` = '".$user_spin."',
        `user_total_spin` = '".$admin_set_total_spin."'
            WHERE id='".$user_id."'"; 
            mysqli_query($conn,$update);
      }
      else
      {
        $admin_set_total_spin =$result_spin['user_total_spin'];
      }
      
      
    }

    echo $admin_set_total_spin;

   die(); 

}

if(isset($_POST['get_user_spin']))
{

    $user_id = $_POST['user_id'];
    $user_spin = $_POST['user_spin'];
    $admin_set_total_spin1 = $_POST['admin_set_total_spin'];

    $spin_array = array();

    $select ="SELECT * from ".$table_prefix."user_table where `id`='".$user_id."'";

    $row = $conn->query($select);
    $result_spin =mysqli_fetch_assoc($row);
    $count  = mysqli_num_rows($row);
    if($count > 0)
    {
      if(!empty($result_spin['user_total_spin']) && $result_spin['user_total_spin'] > 0 )
      {
        
         $admin_set_total_spin = $result_spin['user_total_spin'] - 1;

         $update ="UPDATE ".$table_prefix."user_table SET
        `user_spinned` = '".$user_spin."',
        `user_total_spin` = '".$admin_set_total_spin."'
            WHERE id='".$user_id."'"; 
            mysqli_query($conn,$update);
      }
      else
      {
        $admin_set_total_spin =$result_spin['user_total_spin'];
      }
      
      
    }

    $spin_array['user_remain_spin'] = $admin_set_total_spin;
    $spin_array['user_total_spin_hwe'] = (int)$result_spin['user_total_spin'];

    echo json_encode($spin_array);

   die(); 

}

if(isset($_POST['check_user_sessin_set_or_not']))
{

    $user_id_session='';
    if(isset($_SESSION['user_id']) && $_SESSION['user_id'] !='')
    {
        $user_id_session = $_SESSION['user_id'];
    }
    else
    {
        $user_id_session ='';
    }

    echo $user_id_session;

    die();

}

if(isset($_POST['update_spin_result_redeem_used']))
{
    $reward_id = $_POST['reward_id'];
    
    date_default_timezone_set("Asia/Kuala_Lumpur");
    $now_hwe = date('d-m-Y H:i:s');

   echo $update ="UPDATE ".$table_prefix."spin_result SET `redeem_used` = '1', `redeem_time` = '".$now_hwe."' WHERE `id`='".$reward_id."'"; 
    mysqli_query($conn,$update);
    die; 
}


if(isset($_POST['set_user_spin_result_remain_spin']))
{
    date_default_timezone_set("Asia/Kuala_Lumpur");
    $user_id = $_POST['user_id'];
    $user_spin = $_POST['user_spin'];

    $spain_code = $_POST['spain_code'];
  
    if(isset($_POST['get_reamin_spin_code']) && ($_POST['get_reamin_spin_code'] != ''))
    {      
        $get_reamin_spin_code = $_POST['get_reamin_spin_code'];
        $get_reamin_spin_code_hwe = $get_reamin_spin_code - 1;    
    }
    else
    {
        $get_reamin_spin_code_hwe = 0;
    }
    
    $update_reamin_spin_code ="UPDATE ".$table_prefix."codegenerate SET
   `remain_spin_for_code` = '".$get_reamin_spin_code_hwe."'
    where id='".$spain_code."'"; 
  
    mysqli_query($conn,$update_reamin_spin_code);
  
   die; 

}

if(isset($_POST['double_check_codephone_status']))
{

    $generate_mobilenum = $_POST['mobile_number'];
    $phone_id = $_POST['phone_number_id'];
    $enter_otp_sent = $_POST['otp_code'];
    
    $select="select * from ".$table_prefix."phonenogenerate where generate_code='$generate_mobilenum'";
    
    $query=mysqli_query($conn,$select);
    $result =mysqli_fetch_assoc($query);

    $response= 0;
    if(mysqli_num_rows($query) > 0)
    {
        if($result['status'] == 0)
        {
           
            if($mobile_num_otp == '1')
            {
                if(isset($_POST['otp_code']) && $_POST['otp_code'] != '')
                {
                    //ramkishan
                    $insert_hwe ="UPDATE ".$table_prefix."phonenogenerate SET mobile_otp = '".$enter_otp_sent."',
                    status ='1',
                    created=now() where id='".$phone_id."'"; 
                    mysqli_query($conn,$insert_hwe);

                }
                

            }
            else
            {
             

                //ramkishan
                if($host_name != 'dailyspin88.com')
                {
                    $insert_hwe ="UPDATE ".$table_prefix."phonenogenerate SET generate_code = '".$generate_mobilenum."',
                    status ='1',
                    created=now() where id='".$phone_id."'"; 
                    mysqli_query($conn,$insert_hwe);
                }
            

                
            }
                       
            $response = 1;
        }
    }


    echo $response;
    die();
}
if(isset($_POST['set_user_spin_result']))
{
    date_default_timezone_set("Asia/Kuala_Lumpur");
    $user_id = $_POST['user_id'];
    $user_spin = $_POST['user_spin'];
    $admin_set_total_spin = $_POST['admin_set_total_spin'];
    //$reward_item = $_POST['reward_item'];
    $reward_item = str_replace('<br />','',urldecode($_POST['reward_item']));
    $reward_id_hwe = $_POST['reward_id_hwe'];
    $spain_code = $_POST['spain_code'];

    
        
    if(empty($user_spin))
    {
    $user_spin=0;
    }
    if(isset($_POST['get_reamin_spin_code']) && ($_POST['get_reamin_spin_code'] != ''))
    {      
        $get_reamin_spin_code = $_POST['get_reamin_spin_code'];
        $get_reamin_spin_code_hwe = $get_reamin_spin_code - 1;    
    }
    else
    {
        $get_reamin_spin_code_hwe = 0;
    }
    
    $update_reamin_spin_code ="UPDATE ".$table_prefix."codegenerate SET
   `remain_spin_for_code` = '".$get_reamin_spin_code_hwe."'
    where id='".$spain_code."'"; 
  
    mysqli_query($conn,$update_reamin_spin_code);
    
    $iv_length = openssl_cipher_iv_length(ciphering);
    $options = 0;
    
    $decryption_hwe = openssl_decrypt ($reward_id_hwe, ciphering, 
        encryption_key, $options, encryption_iv);
    $reward_id_hwe = str_replace('reward','',$decryption_hwe);
    
  
    $win_rate = 0;
    $date = date("Y-m-d H:i:s");

    $time_stamp = strtotime($date);

    if($host_name == 'dailyspin88.com')
    {
     
        $select_double_check="select * from ".$table_prefix."phonenogenerate where id='$spain_code'";
    
        $query_double_check=mysqli_query($conn,$select_double_check);
        $result_double_check =mysqli_fetch_assoc($query_double_check);
        if(mysqli_num_rows($query_double_check) > 0)
        {
            if($result_double_check['status'] == 0)
            {
                $insert_hwe ="UPDATE ".$table_prefix."phonenogenerate SET id='$spain_code',
                status ='1',
                created=now() where id='".$spain_code."'"; 
                mysqli_query($conn,$insert_hwe);
             

                $update ="INSERT into ".$table_prefix."spin_result SET
                `user_id` = '".$user_id."',
                `reward_item` = '".$reward_item."',
                `reward_id` = '".$reward_id_hwe."',
                `win_rate` = '".round($win_rate)."',
                `created` ='".$date."',
                `datetime`='".$date."',
                `spin_code`='".$spain_code."'"; 
                
                mysqli_query($conn,$update);
        
                $last_insert_id = mysqli_insert_id($conn);
        
                if($spain_code != '')
                {
                    $selcte_reward_list  = "SELECT * from ".$table_prefix."spin_result where `id`='".$last_insert_id."' order by id desc";
                }
                else
                {
                    $selcte_reward_list  = "SELECT * from ".$table_prefix."spin_result where `id`='".$last_insert_id."' order by id desc";
                }
                
                
                $row_reward = $conn->query($selcte_reward_list);
                while($result_reward = mysqli_fetch_assoc($row_reward))
                {
                    //$reward_item = $result_reward['reward_item'];
                    $reward_item = str_replace('<br />','',urldecode($result_reward['reward_item']));
                    $user_email = $result_reward['user_email'];
                    $reward_id = $result_reward['id'];
                    $reward_id_hwe = $result_reward['reward_id'];
                    $redeem_used_hwe = $result_reward['redeem_used'];
                            
                    //get reward redeem details
                    $select_reward ="SELECT * from ".$table_prefix."wheel_data";
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
        
                    $all_data = '';
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
        
                    if(isset($spin_data['redeem_button_text']) && $spin_data['redeem_button_text'] != '')
                    {
                        $redeem_button = $spin_data['redeem_button_text'];
                    }
                    else
                    {
                        $redeem_button = 'REDEEM';
                    }
                        
                    if($redirect_onoff==1)
                        {
                                $all_data .='
                                    <div class="item disabled after_redeem_change_button_'.$reward_id.'">
                                        <a  onclick="spin_result_redeem_used_update('.$reward_id.')" target="_blank" href="'.$redirect_link_hwe.'" ><button class="btn-redeem"><span>'.$redeem_button.'</span></button></a>
                                        <div class="value" data-value="'.$reward_item.'">'.$reward_item.'</div>
                                    </div>
                                ';
                        }
                        else
                        {
                            $all_data .='
                                    <div class="item disabled after_redeem_change_button_'.$reward_id.'">
                                        <button class="btn-redeem" onclick="redeem('.$reward_id.')"><span>'.$redeem_button.'</span></button>
                                        <div class="value" data-value="'.$reward_item.'">'.$reward_item.'</div>
                                    </div>
                                ';
                        }
                    }
                }
            }
            else
            {
                $all_data = 'Please again Spin';
            }
        }
    }
    else
    {
        $update ="INSERT into ".$table_prefix."spin_result SET
        `user_id` = '".$user_id."',
        `reward_item` = '".$reward_item."',
        `reward_id` = '".$reward_id_hwe."',
        `win_rate` = '".round($win_rate)."',
        `created` ='".$date."',
        `datetime`='".$date."',
        `spin_code`='".$spain_code."'"; 
        
          mysqli_query($conn,$update);
  
          $last_insert_id = mysqli_insert_id($conn);
  
          if($spain_code != '')
          {
              $selcte_reward_list  = "SELECT * from ".$table_prefix."spin_result where `id`='".$last_insert_id."' order by id desc";
          }
          else
          {
              $selcte_reward_list  = "SELECT * from ".$table_prefix."spin_result where `id`='".$last_insert_id."' order by id desc";
          }
         
         
          $row_reward = $conn->query($selcte_reward_list);
          while($result_reward = mysqli_fetch_assoc($row_reward))
          {
              //$reward_item = $result_reward['reward_item'];
              $reward_item = str_replace('<br />','',urldecode($result_reward['reward_item']));
              $user_email = $result_reward['user_email'];
              $reward_id = $result_reward['id'];
              $reward_id_hwe = $result_reward['reward_id'];
              $redeem_used_hwe = $result_reward['redeem_used'];
                      
              //get reward redeem details
              $select_reward ="SELECT * from ".$table_prefix."wheel_data";
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
  
              $all_data = '';
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
  
              if(isset($spin_data['redeem_button_text']) && $spin_data['redeem_button_text'] != '')
              {
                  $redeem_button = $spin_data['redeem_button_text'];
              }
              else
              {
                  $redeem_button = 'REDEEM';
              }
                  
               if($redirect_onoff==1)
                  {
                        $all_data .='
                              <div class="item disabled after_redeem_change_button_'.$reward_id.'">
                                  <a  onclick="spin_result_redeem_used_update('.$reward_id.')" target="_blank" href="'.$redirect_link_hwe.'" ><button class="btn-redeem"><span>'.$redeem_button.'</span></button></a>
                                  <div class="value" data-value="'.$reward_item.'">'.$reward_item.'</div>
                              </div>
                        ';
                  }
                  else
                  {
                      $all_data .='
                              <div class="item disabled after_redeem_change_button_'.$reward_id.'">
                                  <button class="btn-redeem" onclick="redeem('.$reward_id.')"><span>'.$redeem_button.'</span></button>
                                  <div class="value" data-value="'.$reward_item.'">'.$reward_item.'</div>
                              </div>
                        ';
                  }
              }
          }
    }

       
 
    echo $all_data;
   // echo $user_spin;

   die; 

}

if(isset($_POST['set_user_spin_result_hwe_lucky_number']))
{
    // ini_set('display_errors', 1);
    // ini_set('display_startup_errors', 1);
    // error_reporting(E_ALL);

    date_default_timezone_set("Asia/Kuala_Lumpur");
    $user_id = $_POST['user_id'];
    $user_spin = $_POST['user_spin'];
    $admin_set_total_spin = $_POST['admin_set_total_spin'];
    //$reward_item = $_POST['reward_item'];
    $reward_item = str_replace('<br />','',urldecode($_POST['reward_item']));
    $reward_id_hwe = $_POST['reward_id_hwe'];
    $spain_code = $_POST['spain_code'];
    
        
    if(empty($user_spin))
    {
        $user_spin=0;
    }
    if(isset($_POST['get_reamin_spin_code']) && ($_POST['get_reamin_spin_code'] != ''))
    {      
        $get_reamin_spin_code = $_POST['get_reamin_spin_code'];
        $get_reamin_spin_code_hwe = $get_reamin_spin_code - 1;    
    }
    else
    {
        $get_reamin_spin_code_hwe = 0;
    }
    
    $update_reamin_spin_code ="UPDATE ".$table_prefix."codegenerate SET
   `remain_spin_for_code` = '".$get_reamin_spin_code_hwe."'
    where id='".$spain_code."'";
  
    mysqli_query($conn,$update_reamin_spin_code);
    
    $iv_length = openssl_cipher_iv_length(ciphering);
    $options = 0;
    
    $decryption_hwe = openssl_decrypt($reward_id_hwe, ciphering, 
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

 
    $select_reward ="SELECT * from ".$table_prefix."wheel_data";
    $row_reward_wheel = $conn->query($select_reward);
    $result_reward_wheel = mysqli_fetch_assoc($row_reward_wheel);

    $spin_data =  json_decode($result_reward_wheel['spin_data'],true);

    $total_slices = $spin_data['slice'];

    
    
    $output=array();
   
    $data_array =array();
    for($i =0; $i <$total_slices; $i++ )
    {
        if(isset($spin_data['lucky_number_checkbox_'.$i]))
        { 
            if($spin_data['lucky_number_checkbox_'.$i] == '1')
            {
                $data_array[]=$i;
            }

        }
       
       
        
    }
    $status=0;
    $lucky_nuumber=0;
    if(count($data_array)>0)
    {
        foreach($data_array as $data_array_hwe)
        {
            if($data_array_hwe == $reward_id_hwe)
            {
                $select_user = "SELECT * from domain_list_settings  where domain_name='$host_name'";
                $row_user = $conn->query($select_user);
                $result_user = mysqli_fetch_assoc($row_user);

               
                //$lucky_number_data=1;
                
                $lucky_number_data = $result_user['lucky_number_data'];
             
                 $lucky_nuumber = $lucky_number_data;
                 //$lucky_nuumber = $lucky_number_data + 1;

              
                //  $lucky_nuumber_hwe = $lucky_nuumber;

                
                //  if($lucky_nuumber == 9999)
                //  {
                //     $lucky_nuumber = 1;
                //  }
                 $status=1;

           
                    $lucky_nuumber = str_pad($lucky_nuumber, 4, "0", STR_PAD_LEFT);
              


                //  $update ="UPDATE domain_list_settings SET lucky_number_data='$lucky_nuumber_hwe' where domain_name='$host_name'";
                //  mysqli_query($conn,$update);
            }
           
        }
         
    }

    if($status == 1)
    {
        $reward_item = $reward_item.'('.$lucky_nuumber.')';
    }

    if($spain_code != '')
    {
        $selcte_reward_list_latest = "SELECT * from ".$table_prefix."spin_result where `spin_code`='".$spain_code."' order by id desc limit 1";
    }
    else
    {
        $selcte_reward_list_latest  = "SELECT * from ".$table_prefix."spin_result where `user_id`='".$user_id."' order by id desc limit 1";
    }

    $all_data_reward_latest='';


    $row_reward_latest = $conn->query($selcte_reward_list_latest);
    while($result_reward_latest = mysqli_fetch_assoc($row_reward_latest))
    {
       // $reward_item_reward_latest = $result_reward_latest['reward_item'];
        $reward_item_reward_latest = str_replace('<br />','',urldecode($result_reward_latest['reward_item']));
        $user_email_reward_latest = $result_reward_latest['user_email'];
        $reward_id_reward_latest = $result_reward_latest['id'];
        $reward_id_hwe_reward_latest = $result_reward_latest['reward_id'];
        $redeem_used_hwe_reward_latest = $result_reward_latest['redeem_used'];
                
        //get reward redeem details
        $select_reward_latest="SELECT * from ".$table_prefix."wheel_data";
        $row_reward_wheel_reward_latest = $conn->query($select_reward_latest);
        $result_reward_wheel_reward_latest = mysqli_fetch_assoc($row_reward_wheel_reward_latest);

        $spin_data_reward_latest =  json_decode($result_reward_wheel_reward_latest['spin_data'],true);

        $redeem_button_hide_show = $spin_data_reward_latest['redeem_button_hide_show'];
        $redeem_buttom_hide_show='style="display:block;"';
        if($redeem_button_hide_show == '1' && $admin_redeem_button_enable == '1')
        {
            $redeem_buttom_hide_show = 'style="display:none;"';
        }

        $total_slices_reward_latest = $spin_data_reward_latest['slice'];

        $images_slice_data = $spin_data_reward_latest['no_matter_labal_image_hideshow'. $reward_id_hwe_reward_latest];

        $img_url='';
    //     if($images_slice_data == '1')
    {
            $img_url = 'admin_panel/pages/img/'. $host_name.$reward_id_hwe_reward_latest.'.png';
    }
    
    

        $prize_reward_latest =array();
        $redirect_onoff_reward_latest = 0;
        $redirect_link_hwe_reward_latest = '';
        for($i =0; $i <$total_slices_reward_latest; $i++ )
        {
            if($i==$reward_id_hwe_reward_latest) 
            {
                if($spin_data_reward_latest['reward_redirect_link_redeem'.$i])
                {
                    $redirect_link_hwe_reward_latest = $spin_data_reward_latest['reward_redirect_link_redeem'.$i];
                }
                
                if(isset($spin_data_reward_latest['no_matter_reward_redirect_link_redeem'.$i]))
                {
                    $redirect_onoff_reward_latest = $spin_data_reward_latest['no_matter_reward_redirect_link_redeem'.$i];
                }
               
            }
        }

        if($redeem_used_hwe_reward_latest == 1)
        {
            $all_data_reward_latest .= '
            <div class="item disabled after_redeem_change_button_'.$reward_id_reward_latest.'">
                <div class="img_url_parent"><img src="'.$img_url.'" class="img_url_single_reward"/></div>
                <div class="value" data-value="'.$reward_item_reward_latest.'">'.$reward_item_reward_latest.'</div>
                <button class="btn-redeem disabled" '.$redeem_buttom_hide_show.'><span>USED</span></button>
            </div>
        ';
        
        }
        else
        {
            
        if(isset($spin_data_reward_latest['redeem_button_text']) && $spin_data_reward_latest['redeem_button_text'] != '')
        {
            $redeem_button = $spin_data_reward_latest['redeem_button_text'];
        }
        else
        {
            $redeem_button = 'REDEEM';
        }
        if($redirect_onoff_reward_latest==1)
            {
                $all_data_reward_latest .='
                        <div class="item disabled after_redeem_change_button_'.$reward_id_reward_latest.'">
                        <div class="img_url_parent"><img src="'.$img_url.'" class="img_url_single_reward"/></div>
                    
                        <div class="value" data-value="'.$reward_item_reward_latest.'">'.$reward_item_reward_latest.'</div>
                        <a  onclick="spin_result_redeem_used_update('.$reward_id_reward_latest.')" target="_blank" '.$redeem_buttom_hide_show.' href="'.$redirect_link_hwe_reward_latest.'" ><button class="btn-redeem"><span>'.$redeem_button.'</span></button></a>
                        </div>
                ';
            }
            else
            {
                $all_data_reward_latest .='
                        <div class="item disabled after_redeem_change_button_'.$reward_id_reward_latest.'">
                            <div class="img_url_parent"><img src="'.$img_url.'" class="img_url_single_reward"/></div>
                            <div class="value" data-value="'.$reward_item_reward_latest.'">'.$reward_item_reward_latest.'</div>
                            <button class="btn-redeem" '.$redeem_buttom_hide_show.' onclick="redeem('.$reward_id_reward_latest.')"><span>'.$redeem_button.'</span></button>
                        </div>
                ';
            }
        }
    }



    //    $update ="INSERT into ".$table_prefix."spin_result SET
    //   `user_id` = '".$user_id."',
    //   `reward_item` = '".$reward_item."',
    //   `reward_id` = '".$reward_id_hwe."',
    //   `win_rate` = '".round($win_rate)."',
    //   `created` ='".$date."',
    //   `datetime`='".$date."',
    //   `spin_code`='".$spain_code."'";
      
    //    if(mysqli_query($conn,$update))
    //    {


            if($spain_code != '')
            {
                $selcte_reward_list  = "SELECT * from ".$table_prefix."spin_result where `spin_code`='".$spain_code."' order by id desc";
            }
            else
            {
            $selcte_reward_list  = "SELECT * from ".$table_prefix."spin_result where `user_id`='".$user_id."' order by id desc";
            }
        
        
            $row_reward = $conn->query($selcte_reward_list);

            $all_data='';

            while($result_reward = mysqli_fetch_assoc($row_reward))
            {
            
              //  $reward_item = $result_reward['reward_item'];
                $reward_item = str_replace('<br />','',urldecode($result_reward['reward_item']));
                $user_email = $result_reward['user_email'];
                $reward_id = $result_reward['id'];
                $reward_id_hwe = $result_reward['reward_id'];
                $redeem_used_hwe = $result_reward['redeem_used'];
                        
                //get reward redeem details
                $select_reward ="SELECT * from ".$table_prefix."wheel_data";
                $row_reward_wheel = $conn->query($select_reward);
                $result_reward_wheel = mysqli_fetch_assoc($row_reward_wheel);
            
                $spin_data =  json_decode($result_reward_wheel['spin_data'],true);

                $redeem_button_hide_show = $spin_data['redeem_button_hide_show'];
                $redeem_buttom_hide_show='style="display:block;"';
                if($redeem_button_hide_show == '1')
                {
                    $redeem_buttom_hide_show = 'style="display:none;"';
                }
            
                $total_slices = $spin_data['slice'];
            
                $prize =array();
                $redirect_onoff = 0;
                $redirect_link_hwe = '';
                for($i =0; $i <$total_slices; $i++ )
                {
                    if($i==$reward_id_hwe) 
                    {
                        if(isset($spin_data['reward_redirect_link_redeem'.$i]))
                        {
                            $redirect_link_hwe = $spin_data['reward_redirect_link_redeem'.$i];
                        }
                        if(isset($spin_data['no_matter_reward_redirect_link_redeem'.$i]))
                        {
                            $redirect_onoff = $spin_data['no_matter_reward_redirect_link_redeem'.$i];
                        }
                        
                    }
                }

                

                if($redeem_used_hwe == 1)
                {
                    $all_data .= '
                    <div class="item disabled after_redeem_change_button_'.$reward_id.'">
                        <button class="btn-redeem disabled" '.$redeem_buttom_hide_show.'><span>USED</span></button>
                        <div class="value" data-value="'.$reward_item.'">'.$reward_item.'</div>
                    </div>
                ';
                
                }
                else
                {

                    if(isset($spin_data['redeem_button_text']) && $spin_data['redeem_button_text'] != '')
                    {
                        $redeem_button = $spin_data['redeem_button_text'];
                    }
                    else
                    {
                        $redeem_button = 'REDEEM';
                    }
                    
                if($redirect_onoff==1)
                    {
                        $all_data .='
                                <div class="item disabled after_redeem_change_button_'.$reward_id.'">
                                    <a  onclick="spin_result_redeem_used_update('.$reward_id.')" target="_blank" href="'.$redirect_link_hwe.'" ><button class="btn-redeem" '.$redeem_buttom_hide_show.'><span>'.$redeem_button.'</span></button></a>
                                    <div class="value" data-value="'.$reward_item.'">'.$reward_item.'</div>
                                </div>
                        ';
                    }
                    else
                    {
                        $all_data .='
                                <div class="item disabled after_redeem_change_button_'.$reward_id.'">
                                    <button class="btn-redeem" '.$redeem_buttom_hide_show.' onclick="redeem('.$reward_id.')"><span>'.$redeem_button.'</span></button>
                                    <div class="value" data-value="'.$reward_item.'">'.$reward_item.'</div>
                                </div>
                        ';
                    }
                }
            }

            $all_data .='<div class="item" style="margin-top: 10px;">
            <a href="'.Front_URL.'/all_latest_reward.php" target="_blank" style="color: #fff;font-size: 20px;">View latest Rewards</a>
        </div>';


            // echo $user_spin
            //ramkishan popup set the
           

            // if(isset($_SESSION['user_id']) && $_SESSION['user_id'] !='')
            // {
            //     $user_id_with_session  =$_SESSION['user_id'];
            // }
            // else
            // {
            //     $user_id_with_session  ='';
            // }

            // if($all_data_reward_latest == '')
            // {
            //    $total_spin = $admin_set_total_spin +1;
            //     $update_hwe3 ="UPDATE ".$table_prefix."user_table SET
            //     `user_spinned` = '".$user_spin."',
            //     `user_total_spin` = '".$total_spin."'
            //       WHERE id='".$user_id."'"; 
            //       mysqli_query($conn,$update_hwe3);

            // }
            
            $output["status"] = $status;
            $output["lucky_nuumber"] = $lucky_nuumber;
            $output["reward_list"] = $all_data;
            $output["reward_list_latest_reward"] = $all_data_reward_latest;
          //  $output["user_id"] = $user_id_with_session;
            
            echo json_encode($output);
            // echo $user_spin;
            die();


        //}
    

}
// end ramkishan

if(isset($_POST['update_email_in_result']))
{

    $user_id = $_POST['user_id'];
    $email = $_POST['user_email_reward'];
    $reward_id = $_POST['reward_id'];
    
    $now_hwe = date('d-m-Y H:i:s');
    if(isset($_POST['user_id']) && $_POST['user_id'] !='')
    {
        $update ="UPDATE ".$table_prefix."spin_result SET
      `user_id` = '".$user_id."',
      `user_email` = '".$email."',
      `redeem_used` = '1',
      `redeem_time` = '".$now_hwe."' where user_id ='".$user_id."' && id='".$reward_id."'"; 
        mysqli_query($conn,$update);
    }
    else
    {
        $update ="UPDATE ".$table_prefix."spin_result SET
        `user_email` = '".$email."',
        `redeem_used` = '1',
        `redeem_time` = '".$now_hwe."' where id='".$reward_id."'"; 
          mysqli_query($conn,$update);

    }
     
 

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

if(isset($_POST['randomresultshow']))
{

    // $user_id = $_POST['user_id'];
    // $email = $_POST['user_email_reward'];
    // $reward_id = $_POST['reward_id'];
    

    // $generate_code  =  $_POST['playerid'];
    // $rewards  =  $_POST['show_rewards'];
 
     $select="select player_id,reward from ".$table_prefix."top_winner order by rand() limit 5";
    $result=mysqli_query($conn,$select);
    if($result)
    { 
    $data='';
    while($row=mysqli_fetch_assoc($result))
     {
      $generate_code  =  $row['player_id'];
      $rewards  =  $row['reward'];

      if($second_layout_sp == '1')
      {
        $data .= '<li class="winners_list_scroll"> Congrat <span class="winners_list_player_id"> '.$generate_code.'</span> get <span class="winners_list_reward">'.$rewards.'</span></li>';
      }
      else
      {
      
        $data .= '<div class="item"><div class="icon c-col"></div><div class="player-name c-col">  	
      &#11088; 	
'.$generate_code.'</div><div class="reward-value c-col">'.$rewards.'</div></div>';
      
      }
      
     
     }
     
    }

    echo $data;


    //   echo $update ="UPDATE top_winn SET
    //   `user_id` = '".$user_id."',
    //   `user_email` = '".$email."' where user_id ='".$user_id."' && id='".$reward_id."'"; 
    //     mysqli_query($conn,$update);
 

   // echo $user_spin;

   die; 

}
if(isset($_POST['phone_number_save']))
{
    $generate_mobilenum =  $_POST['user_spin_code'];
  
    $enter_otp_sent='';
    if(isset($_POST['otp_number']) && $_POST['otp_number'] !='')
    {
        $enter_otp_sent = $_POST['otp_number'];
    }



    $select="select * from ".$table_prefix."phonenogenerate where generate_code='$generate_mobilenum' and status = '0'";
  
    
    $query=mysqli_query($conn,$select);
    $result =mysqli_fetch_assoc($query);
    if(mysqli_num_rows($query) > 0)
    {

       
        $phone_id = $result['id'];
        echo $insert ="UPDATE ".$table_prefix."phonenogenerate SET mobile_otp = '".$enter_otp_sent."',
        status ='0',
        created=now() where id='".$phone_id."'"; 
        mysqli_query($conn,$insert);
    }
    else
    {
        $insert ="INSERT into ".$table_prefix."phonenogenerate SET generate_code = '".$generate_mobilenum."',
        status ='0',
        created=now()"; 
        mysqli_query($conn,$insert);
    }
}
//check mobile number exists or not
if(isset($_POST['phone_number_save_check']))
{
    $generate_mobilenum =  $_POST['user_spin_code'];
  
    $select="select * from ".$table_prefix."phonenogenerate where generate_code='$generate_mobilenum' and status = '1'";
  
    
    $query=mysqli_query($conn,$select);
    $result =mysqli_fetch_assoc($query);
    if(mysqli_num_rows($query) > 0)
    {

        echo '1';
    }
    else
    {
        echo '0';
    }
    
}

//reduce remain spin 
if(isset($_POST['reset_timer_set']))
{

    $status=0;
    $select ="SELECT * from ".$table_prefix."reset_remain_spin";
    $row = $conn->query($select);
    if(mysqli_num_rows($row) > 0)
    {
        $result = mysqli_fetch_assoc($row);
        $reset_spin_hour    =   $result['reset_spin_hour'];
        $reset_remain_spin  =   $result['reset_remain_spin'];
        

        $reset_count = 24/$reset_spin_hour;
        //$reset_count = 144;

    
        $current_time = date("Y-m-d H:i");
        $current_time_seconds = strtotime($current_time);
        
        

        $today_midnight_y_m_d_into_seconds = date("Y-m-d");
        $today_midnight = strtotime($today_midnight_y_m_d_into_seconds." 00:00");

        for($i=0; $i < $reset_count; $i++)
        {
            $reset_time_array[] = $today_midnight;

            $reset_time_date_array[] = date("Y-m-d H:i",$today_midnight);

            $today_midnight = $today_midnight + ($reset_spin_hour * 3600);
        }

        foreach($reset_time_array as $reset_time_array_hwe)
        {
            if($current_time_seconds == $reset_time_array_hwe)
            {
                $select ="SELECT * from ".$table_prefix."user_table";

                $row = $conn->query($select);
                
                $count  = mysqli_num_rows($row);
                if($count > 0)
                {
                    while($result_spin =mysqli_fetch_assoc($row))
                    {
                        
                        
                            $user_id = $result_spin['id'];
                          
                            $update ="UPDATE ".$table_prefix."user_table SET
                                `user_total_spin` = '".$reset_remain_spin."'
                                    WHERE id='".$user_id."'"; 
                                mysqli_query($conn,$update);

                                $status=1;
                        
                    }
                
                }
            }
        }

                
    }

    echo $status;
    die();
    
}
//update_reward_point_user exists or not
if(isset($_POST['update_reward_point_user']))
{
    
    if($reward_point_login_method == '1')
    {

        $user_id =  $_POST['user_id'];
        $reward_id_hwe =  $_POST['reward_id'];

        $options = 0;
        $decryption=openssl_decrypt ($reward_id_hwe, ciphering, 
            encryption_key, $options, encryption_iv);
        $reward_id = str_replace('reward','',$decryption); 

        $select_user ="SELECT * from ".$table_prefix."user_redeem_spin_points";
        $row_user = $conn->query($select_user);
        if(mysqli_num_rows($row_user) > 0)
        {
            $data_rewards_set_points = mysqli_fetch_assoc($row_user);
            $user_reward_get_points = json_decode($data_rewards_set_points['user_reward_get_points'],true);


            $select ="SELECT * from ".$table_prefix."user_table where `id`='".$user_id."'";

            $row = $conn->query($select);
            $result_spin =mysqli_fetch_assoc($row);
            $count  = mysqli_num_rows($row);
            if($count > 0)
            {
            
                $reward_point = $user_reward_get_points[$reward_id];
                if(isset($result_spin['user_redeem_point']))
                {
                    $admin_set_total_rewardpoint = $result_spin['user_redeem_point'] + $reward_point;

                    $update ="UPDATE ".$table_prefix."user_table SET
                    `user_redeem_point` = '".$admin_set_total_rewardpoint."'
                        WHERE id='".$user_id."'"; 
                        mysqli_query($conn,$update);
                }
            
            
            }

            
        }
    }
    
}

//double check username and mobile number status 
if(isset($_POST['double_check_update_status']))
{
    $spain_code = $_POST['spin_code'];
    $check_spain_code_status=0;
    $status='';

    $select_username_mobile_method = "SELECT * from ".$table_prefix."codegenerate where id='".$spain_code."'";
    $row_username_mobile_method = $conn->query($select_username_mobile_method);
    
    if(mysqli_num_rows($row_username_mobile_method) > 0)
    {
        $result_username_mobile_method = mysqli_fetch_assoc($row_username_mobile_method);
        $check_spain_code_status = $result_username_mobile_method['status'];
    }
   

    if($check_spain_code_status > 0)
    {
        $status = 'again_spin';
    }
    else
    {
        $update_username_mobile_code ="UPDATE ".$table_prefix."codegenerate SET
            `status` = '1' where id='".$spain_code."'"; 
            mysqli_query($conn,$update_username_mobile_code);
    }
    echo $status;
}
//get used code results
if(isset($_POST['get_used_code_result']))
{

    $spain_code = $_POST['code'];
 
    
    $selcte_reward_list_latest = "SELECT * from ".$table_prefix."spin_result where `spin_code`='".$spain_code."' order by id desc limit 1";
   

    $all_data_reward_latest='';

    $row_reward_latest = $conn->query($selcte_reward_list_latest);
    while($result_reward_latest = mysqli_fetch_assoc($row_reward_latest))
    {
        //$reward_item_reward_latest = $result_reward_latest['reward_item'];
        $reward_item_reward_latest = str_replace('<br />','',urldecode($result_reward_latest['reward_item']));
        $user_email_reward_latest = $result_reward_latest['user_email'];
        $reward_id_reward_latest = $result_reward_latest['id'];
        $reward_id_hwe_reward_latest = $result_reward_latest['reward_id'];
        $redeem_used_hwe_reward_latest = $result_reward_latest['redeem_used'];
                
        //get reward redeem details
        $select_reward_latest="SELECT * from ".$table_prefix."wheel_data";
        $row_reward_wheel_reward_latest = $conn->query($select_reward_latest);
        $result_reward_wheel_reward_latest = mysqli_fetch_assoc($row_reward_wheel_reward_latest);

        $spin_data_reward_latest =  json_decode($result_reward_wheel_reward_latest['spin_data'],true);

        $redeem_button_hide_show = $spin_data_reward_latest['redeem_button_hide_show'];
        $redeem_buttom_hide_show='style="display:block;"';
        if($redeem_button_hide_show == '1' && $admin_redeem_button_enable == '1')
        {
            $redeem_buttom_hide_show = 'style="display:none;"';
        }

        $total_slices_reward_latest = $spin_data_reward_latest['slice'];

        $img_url='';
        $img_div='';
        if(isset( $spin_data_reward_latest['no_matter_labal_image_hideshow'. $reward_id_hwe_reward_latest]))
        {
            $images_slice_data = $spin_data_reward_latest['no_matter_labal_image_hideshow'. $reward_id_hwe_reward_latest];

            
            if($images_slice_data == '1')
            {
                    $img_url = 'admin_panel/pages/img/'. $host_name.$reward_id_hwe_reward_latest.'.png';
                    $img_div ='<div class="img_url_parent"><img src="'.$img_url.'" class="img_url_single_reward"/></div>';
            }
        }
   

    

        $prize_reward_latest =array();
        $redirect_onoff_reward_latest = 0;
        $redirect_link_hwe_reward_latest = '';
        for($i =0; $i <$total_slices_reward_latest; $i++ )
        {
            if($i==$reward_id_hwe_reward_latest) 
            {
                if($spin_data_reward_latest['reward_redirect_link_redeem'.$i])
                {
                    $redirect_link_hwe_reward_latest = $spin_data_reward_latest['reward_redirect_link_redeem'.$i];
                }
                
                if(isset($spin_data_reward_latest['no_matter_reward_redirect_link_redeem'.$i]))
                {
                    $redirect_onoff_reward_latest = $spin_data_reward_latest['no_matter_reward_redirect_link_redeem'.$i];
                }
            
            }
        }

        if($redeem_used_hwe_reward_latest == 1)
        {
            $all_data_reward_latest .= '
            <div class="item disabled after_redeem_change_button_'.$reward_id_reward_latest.'">
                '.$img_div.'
                <div class="value" data-value="'.$reward_item_reward_latest.'" style="width: 100%;text-align: center;float:unset;margin-top: 20px;">'.$reward_item_reward_latest.'</div>
                <div class="custon_set_look_result" style="justify-content: center;display: flex;float:unset;"><button class="btn-redeem disabled" '.$redeem_buttom_hide_show.'><span>USED</span></button></div>
            </div>
        ';
        
        }
        else
        {

        if(isset($spin_data_reward_latest['redeem_button_text']) && $spin_data_reward_latest['redeem_button_text'] != '')
        {
            $redeem_button = $spin_data_reward_latest['redeem_button_text'];
        }
        else
        {
            $redeem_button = 'REDEEM';
        }
            
        if($redirect_onoff_reward_latest==1)
            {
                $all_data_reward_latest .='
                        <div class="item disabled after_redeem_change_button_'.$reward_id_reward_latest.'">
                        '.$img_div.'
                    
                        <div class="value" data-value="'.$reward_item_reward_latest.'" style="width: 100%;text-align: center;float:unset;margin-top: 20px;">'.$reward_item_reward_latest.'</div>
                        <div class="custon_set_look_result" style="justify-content: center;display: flex;float:unset;"><a  onclick="spin_result_redeem_used_update('.$reward_id_reward_latest.')" target="_blank" '.$redeem_buttom_hide_show.' href="'.$redirect_link_hwe_reward_latest.'" ><button class="btn-redeem"><span>'.$redeem_button.'</span></button></a></div>
                        </div>
                ';
            }
            else
            {
                $all_data_reward_latest .='
                        <div class="item disabled after_redeem_change_button_'.$reward_id_reward_latest.'">
                            '.$img_div.'
                            <div class="value" data-value="'.$reward_item_reward_latest.'" style="width: 100%;text-align: center;float:unset;margin-top: 20px;">'.$reward_item_reward_latest.'</div>
                            <div class="custon_set_look_result" style="justify-content: center;display: flex;float:unset;"><button class="btn-redeem" '.$redeem_buttom_hide_show.' onclick="redeem('.$reward_id_reward_latest.')"><span>'.$redeem_button.'</span></button></div>
                        </div>
                ';
            }
        }

       
    }
   
    echo $all_data_reward_latest;
    
}
?>