<?php
include 'config.php';
function customFunc_hwe1($dataArr = array(),$hst_hostname,$hst_port){

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
if(isset($_POST['domain_root_set']))
{

    $hst_hostname = $_POST['hst_hostname'];
    $hst_port = $_POST['hst_port'];
    $hst_username = $_POST['hst_username'];
    $hst_password = $_POST['hst_password'];
    $hst_returncode = $_POST['hst_returncode'];
    $username = $_POST['username'];
    $domain = $_POST['domain_name'];

    $hst_command_change_rootdir = 'v-change-web-domain-docroot';

    if($domain_type == 2)
    {
        $dir__hwe = "jgdx.xyz";
    }
    else
    {
        $dir__hwe = 'jgdx.xyz';
    }

    $postvars_change_root_dir = array(
        'user' => $hst_username,
        'password' => $hst_password,
        'returncode' => $hst_returncode,
        'cmd' => $hst_command_change_rootdir,
        'arg1' => $username,
        'arg2' => $domain,
        'arg3'=>$dir__hwe

        );

       // $change_domain_rootdir_reponse = customFunc_hwe1($postvars_change_root_dir,$hst_hostname,$hst_port);
       //  echo $change_domain_rootdir_reponse;
      //   die();

    // function for change dopmain root
    // $change_domain_rootdir_reponse = customFunc_hwe1($postvars_change_root_dir,$hst_hostname,$hst_port);
    // echo $change_domain_rootdir_reponse;
    //die();
// }
// if(isset($_POST['create_database_tables']))
// {
  //admin table
    $host_name = $_POST['table_prefix'];

    
   $admin_login_table = 'CREATE TABLE IF NOT EXISTS `'.$host_name.'_admin_login`
    (
    `id` INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `username` VARCHAR(256) NOT NULL,
    `password` VARCHAR(256) NOT NULL
    ) 

    ';  
    mysqli_query($conn,$admin_login_table);

    //insert admin login details
    $admin_login_table_data_insert = "INSERT INTO `".$host_name."_admin_login` 
                                                    SET `username` = 'admin@gmail.com',
                                                    password= 'admin'
                                                ";  
    mysqli_query($conn,$admin_login_table_data_insert);

    // create banner table
    $banner_add_table = 'CREATE TABLE IF NOT EXISTS `'.$host_name.'_banner_add`
    (
    `id` INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `banner_image` text NOT NULL,
    `order_sort` INT(20) NOT NULL Default 0
    ) 

    ';  
    mysqli_query($conn,$banner_add_table);

    // create codegenerate table
    $codegenerate_table = 'CREATE TABLE IF NOT EXISTS `'.$host_name.'_codegenerate`
    (
    `id` INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `generate_code` VARCHAR(256) NULL,
    `status` INT(20) NULL,
    `check_normal_spin`INT(20) NULL Default 0,
    `show_reward_value` text NULL,
    `created` TIMESTAMP(6) DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    `remain_spin_for_code` VARCHAR(256) NULL,
    `user_spinned_by_code` VARCHAR(256) NULL,
    `user_email_method_email` VARCHAR(256) NULL,
    `user_n_e_mob_username` VARCHAR(256) NULL,
    `user_n_e_mob_email` VARCHAR(256) NULL,
    `user_n_e_mob_phnumber` VARCHAR(256) NULL,
    `user_username_mob_meth_username` TEXT NULL,
    `user_username_mob_meth_mobnumber` TEXT NULL,
    `method` VARCHAR(256) NULL,
    `mobile_num_for_sms` VARCHAR(256) NULL
    
    ) 

    ';  
    mysqli_query($conn,$codegenerate_table);

    // create phonenogenerate table
    $phonenogenerate_table = 'CREATE TABLE IF NOT EXISTS `'.$host_name.'_phonenogenerate`
    (
    `id` INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `generate_code` VARCHAR(256) NULL,
    `mobile_otp` VARCHAR(256) NULL,
    `status` INT(20) NULL Default 0,
    `created` TIMESTAMP(6) DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    `country_code_num` VARCHAR(256) NULL
    ) 

    ';  
    mysqli_query($conn,$phonenogenerate_table);

    // create spin_result table
    $spin_result_table = 'CREATE TABLE IF NOT EXISTS `'.$host_name.'_spin_result`
    (
    `id` INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `user_id` INT(11) NULL,
    `reward_item` text NULL,
    `reward_id` VARCHAR(50),
    `user_email` VARCHAR(256) NULL,
    `win_rate` INT(11) NULL,
    `created` VARCHAR(100) NULL,
    `datetime` VARCHAR(256) NULL,
    `redeem_time` VARCHAR(256) NULL,
    `redeem_used` INT(20) NULL Default 0,
    `spin_code` VARCHAR(255) NULL,
    `result_visible_status` INT(11) NOT NULL DEFAULT 1
    ) 

    ';  
    mysqli_query($conn,$spin_result_table);

    // create top_winner table
    $top_winner_table = 'CREATE TABLE IF NOT EXISTS `'.$host_name.'_top_winner`
    (
    `id` INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `player_id` VARCHAR(255),
    `reward` VARCHAR(255) NOT NULL,
    `status` INT(11) NOT NULL Default 0,
    `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
    
    ) 

    ';  
    mysqli_query($conn,$top_winner_table);

    // create user_table table
    $user_table_table = 'CREATE TABLE IF NOT EXISTS `'.$host_name.'_user_table`
    (
    `id` INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `username` VARCHAR(256) NULL,
    `password` VARCHAR(256) NULL,
    `user_total_spin` INT(11) NULL,
    `user_spinned` INT(11) NULL,
    `user_spin_type_login_method` INT(11) Default 0,
    `num_for_reward_reamin_spin` TEXT NULL,
    `save_array_after_unset_reward` TEXT NULL,
    `lucky_number_data` VARCHAR(256) NULL,
    `UUID` TEXT NULL,
    `created` TIMESTAMP(6) NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    `mobile_number_share` VARCHAR(256) NULL,
    `mobile_number_otp_share` VARCHAR(256) NULL,
    `user_country_code` VARCHAR(256) NULL,
    `user_redeem_point` INT(11) NOT NULL DEFAULT 0
    
    ) 

    ';  
    mysqli_query($conn,$user_table_table);

    // create user_total_spin table
    $user_total_spin_table = 'CREATE TABLE IF NOT EXISTS `'.$host_name.'_user_total_spin`
    (
    `id` INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `user_id` INT(11) NULL,
    `total_user_spin` INT(11) NULL,
    `total_spin` INT(11) NULL
    
    ) 

    ';  
    mysqli_query($conn,$user_total_spin_table);

    //contact form table
    $contactform_table = 'CREATE TABLE IF NOT EXISTS `'.$host_name.'_contact_form`
    (
    `id` INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `name` VARCHAR(256) NULL,
    `description` TEXT NULL,
    `email` VARCHAR(256) NULL,
    `mobile_number` VARCHAR(256) NULL,
    `created` datetime(6) NULL
    ) 

    ';  
    mysqli_query($conn,$contactform_table);

    $share_redeem_reward_results = 'CREATE TABLE IF NOT EXISTS `'.$table_prefix.'share_redeem_reward_results`
    (
    `id` INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `share_redeem_reward_id` INT(11) NOT NULL DEFAULT 0,
    `user_id` INT(11) NOT NULL DEFAULT 0,
    `number_of_redeem_points` INT(11) NOT NULL DEFAULT 0,
    `redeem_reward_email` VARCHAR(256) NULL,
    `share_reward_redeem_date` datetime(6) NULL,
    `admin_redeemed_status` INT(11) NOT NULL DEFAULT 0
    )';  
    mysqli_query($conn,$share_redeem_reward_results);


    $reward_redeem_share = 'CREATE TABLE IF NOT EXISTS `'.$table_prefix.'reward_redeem_share`
    (
    `id` INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `number_of_points` INT(11) NOT NULL DEFAULT 0,
    `title` VARCHAR(256) NULL,
    `description` TEXT NULL,
    `user_share_point` INT(11) NOT NULL DEFAULT 0,
    `image` VARCHAR(256) NULL,
    `created` datetime(6) NULL
    )';  
    mysqli_query($conn,$reward_redeem_share);

    $user_redeem_share_points = 'CREATE TABLE IF NOT EXISTS `'.$table_prefix.'user_redeem_share_points`
    (
    `id` INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `user_share_point` INT(11) NOT NULL DEFAULT 0,
    `created` TIMESTAMP(6) NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    ) 

    ';  
    mysqli_query($conn,$user_redeem_share_points);

    $reset_remain_spin = 'CREATE TABLE IF NOT EXISTS `'.$table_prefix.'reset_remain_spin`
    (
    `id` INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `reset_spin_hour` INT(11) NOT NULL DEFAULT 0,
    `reset_remain_spin` INT(11) NOT NULL DEFAULT 0,
    `user_id` INT(11) NOT NULL DEFAULT 0
    ) 

    ';  
    mysqli_query($conn,$reset_remain_spin);

     $user_redeem_spin_points = 'CREATE TABLE IF NOT EXISTS `'.$table_prefix.'user_redeem_spin_points`
    (
    `id` INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `user_reward_get_points` TEXT NULL DEFAULT 0,
    `created` TIMESTAMP(6) NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    ) 

    ';  
    mysqli_query($conn,$user_redeem_spin_points);



    // create wheel_data table
    $wheel_data_table = 'CREATE TABLE IF NOT EXISTS `'.$host_name.'_wheel_data`
    (
    `id` INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `spin_data` TEXT NULL,
    `spin_slice_data` TEXT NULL,
    `save_email_config_popup` TEXT NULL,
    `access_key_save` TEXT NULL,
    `customer_email_save` TEXT NULL,
    `save_countdown` TEXT NULL
    
    ) 

    ';  
    if(mysqli_query($conn,$wheel_data_table))
    {
        $wheel_default_data = '{"set_box_alert_pro":"","save_data":"","register_now":"0","email-popup-config":"0","slider_banner":"0","wallpaper-config":"0","slice":"5","prize0":"1$","prize1":"2$","prize2":"3$","prize3":"4$","prize4":"5$","reward_slice_hwe_0":"","reward_slice_hwe_1":"","reward_slice_hwe_2":"","reward_slice_hwe_3":"","reward_slice_hwe_4":"","probability0":"","probability1":"","probability2":"","probability3":"","probability4":"","reward_redirect_link_redeem0":"","reward_redirect_link_redeem1":"","reward_redirect_link_redeem2":"","reward_redirect_link_redeem3":"","reward_redirect_link_redeem4":"","wheel-ux-config":"0","coundown-popup-config":"0","sound-config":"0","reward-popup-config":"0","bg_color":"#000000"}';
       $insert_wheel_data = "INSERT into `".$host_name."_wheel_data` SET spin_data='$wheel_default_data'";
        mysqli_query($conn,$insert_wheel_data);

    }

    $change_domain_rootdir_reponse = customFunc_hwe1($postvars_change_root_dir,$hst_hostname,$hst_port);
   // echo $change_domain_rootdir_reponse;
    die();

}

?>