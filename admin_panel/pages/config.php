<?php
// $host = 'localhost';
// $db_username = 'root';
// $db_password = 'vertrigo';
// $db_name = 'ccrdskmy_loyality_wheel_spin';
// $host = 'localhost';
// $db_username = 'luckyspin';
// $db_password = '[ZgyAlf{JqTT';
// $db_name = 'ccrdskmy_loyality_wheel_spin';

// Set timezone
date_default_timezone_set("Asia/Kuala_Lumpur");

// changing the upload limits
ini_set('upload_max_filesize', '50M');
ini_set('post_max_size', '50M');
ini_set('max_input_time', 300);
ini_set('max_execution_time', 300);

$host_name = $_SERVER['HTTP_HOST'];

///get domain list data start
$host_super = 'localhost';
$db_username_super = 'admin_jgdx_xyz_db';
$db_password_super = 'Uw5nHmY1kzKfuZW';
$db_name_super = 'admin_jgdx_xyz_db';

//if($host_name == 'latesttestingnew.jgdx.xyz' || $host_name == 'wgc33.vip' || $host_name == 'spin2win.bet'|| $host_name == 'skyworldsg-luckyspin.com' || $host_name == 'wheel.jgdx.xyz' || $host_name == 'wheel001.jgdx.xyz' || $host_name == 'wheel002.jgdx.xyz' || $host_name == 'wheel003.jgdx.xyz' || $host_name == 'wheel004.jgdx.xyz' ||$host_name == 'wheel005.jgdx.xyz' || $host_name == 'wheel006.jgdx.xyz' || $host_name == 'wheel007.jgdx.xyz' || $host_name == 'wheel008.jgdx.xyz' || $host_name == 'wheel009.jgdx.xyz' || $host_name == 'wheel010.jgdx.xyz' || $host_name == 'wheel011.jgdx.xyz' || $host_name == 'wheel012.jgdx.xyz' || $host_name == 'wheel013.jgdx.xyz' || $host_name == 'wheel014.jgdx.xyz' || $host_name == 'wheel015.jgdx.xyz' || $host_name == 'wheel016.jgdx.xyz' || $host_name == 'wheel017.jgdx.xyz' || $host_name == 'wheel018.jgdx.xyz' || $host_name == 'wheel019.jgdx.xyz' || $host_name == 'wheel020.jgdx.xyz' || $host_name == 'wheel021.jgdx.xyz' || $host_name == 'wheel022.jgdx.xyz' || $host_name == 'wheel023.jgdx.xyz' || $host_name == 'wheel024.jgdx.xyz' || $host_name == 'wheel025.jgdx.xyz' || $host_name == 'fbads996.com' || $host_name == 'sub.jgdx.xyz' || $host_name == 'edbet321spins.com' || $host_name == 'testing.jgdx.xyz' || $host_name == '29spin.com' || $host_name == 'king99luckyspin.com' || $host_name == 'smssenddomain.jgdx.xyz' || $host_name == 'testingwheel.jgdx.xyz' || $host_name == 'kuatwheel.com' || $host_name == 'm33spinwheel.com' || $host_name == 'bk8luckywin.com' || $host_name == 'spin2win88.com')
//{
$conn  = mysqli_connect($host_super,$db_username_super,$db_password_super,$db_name_super);

$select_super ="SELECT * from domain_list_settings where domain_name='".$host_name."'";
$row_super = $conn->query($select_super);

//}
// else
// {
//     $conn_super  = mysqli_connect($host_super,$db_username_super,$db_password_super,$db_name_super);

//     $select_super ="SELECT * from domain_list_settings where domain_name='".$host_name."'";
//     $row_super = $conn_super->query($select_super);
// }
while($result_super = mysqli_fetch_assoc($row_super))
{
    $domain_name_sp    =   $result_super['domain_name'];
    $status_sp         =   $result_super['status'];
    $db_name_sp        =   $result_super['db_name'];
    $db_user_sp        =   $result_super['db_user'];
    $db_password_sp    =   $result_super['db_password'];
    $code_sp           =   $result_super['code'];
    $code_with_remain_spin_sp        =   $result_super['code_with_remain_spin'];
    $mobile_number_sp  =   $result_super['mobile_number'];
    $user_login_sp     =   $result_super['user_login'];

    $email_method  =   $result_super['email_method'];
    $name_email_mobileno     =   $result_super['name_email_mobileno'];

    $phone_password_with_otp_method = $result_super['phone_password_with_otp_method'];
    $pnone_email_password_with_otp= $result_super['pnone_email_password_with_otp'];

    $normal_spin_method= $result_super['normal_spin_method'];

    $user_login_register_method  =   $result_super['user_login_register_method'];

    //////start user username and mobile number method//////////
    $user_username_mobile_method  =   $result_super['user_username_mobile_function'];

    $user_usmob_method_username_label  =   $result_super['user_usmob_method_username_label'];
    $user_usmob_method_mobile_number_label  =   $result_super['user_usmob_method_mobile_number_label'];
    $user_usmob_method_username_placeholder  =   $result_super['user_usmob_method_username_placeholder'];
    $user_usmob_method_mobile_number_placeholder  =   $result_super['user_usmob_method_mobile_number_placeholder'];

    ////////end user username and mobile number method///////////

    //reset time for login method
    $reset_time_login_method = $result_super['reset_time_login_method'];

    //reward reward point login method
    $reward_point_login_method= $result_super['reward_point_login_method'];
    
    $first_layout_sp   =   $result_super['first_layout'];
    $second_layout_sp  =   $result_super['second_layout'];
    $fourth_layout_sp  =   $result_super['fourth_layout'];

    $sms_function = $result_super['sms_function'];
    $firebase_key = $result_super['firebase_key'];
    $firebase_password = $result_super['firebase_password'];
    $share_content_text = $result_super['share_content_text'];
    $share_content_title = $result_super['share_content_title'];
    $share_content_Url =$result_super['share_content_Url'];


    $sms_function_text1 = $result_super['sms_function_text1'];
    $sms_function_text2 = $result_super['sms_function_text2'];

    $lucky_number_option = $result_super['lucky_number_option'];

    $sms_message_data = $result_super['sms_message_data'];

    $admin_redeem_button_enable = $result_super['admin_redeem_button_enable'];
  

    $mobile_num_otp = $result_super['mobile_num_otp'];

    ///////refferal method ///////////////
    $share_referrel = $result_super['share_referrel'];


    $bg_music    = $result_super['bg_music'];
    $bg_music_name = $result_super['bg_music_name'];
    $user_login_sms_function_hwe  =   $result_super['user_login_sms_function'];
    $user_login_hwe  =   $result_super['user_login'];

    $set_text_for_code_method = $result_super['set_text_for_code_method'];

    $combine_plinko_lucky_wheel = $result_super['combine_plinko_lucky_wheel'];

    $table_prefix  =   $result_super['table_prefix'];

    $game_type = $result_super['game_type'];

    $game_type = $result_super['game_type'];

    $domain_status = $result_super['status'];

    
    if(empty($result_super['site_title_hwe']) || $result_super['site_title_hwe'] == '')
    {
        $site_title_hwe  =   'Loyality Wheel Spin';
    }
    else
    {
        $site_title_hwe  =   $result_super['site_title_hwe'];
    }

    if(empty($result_super['site_description']) || $result_super['site_description'] == '')
    {
        $site_description  =   '';
    }
    else
    {
        $site_description  =   $result_super['site_description'];
    }

    if(isset($result_super['header_script_tag']) && $result_super['header_script_tag'] != '')
    {
        $header_script_tag  =   htmlspecialchars_decode($result_super['header_script_tag']);
    }
    else
    {
        $header_script_tag  = "";
    }

    if(isset($result_super['number_patern_for_all_mob_method']) && $result_super['number_patern_for_all_mob_method'] != '')
    {
        $number_patern_for_all_mob_method  =   $result_super['number_patern_for_all_mob_method'];
    }
    else
    {
        $number_patern_for_all_mob_method  =   "";
    }


    if($host_name == 'kudaking888.co')
    {
        echo "<center>You Can Not Access Site.</center>";
        die();
    }
    
    
}

///get domain list data end

if($host_name == 'luckyspin.fun')
{
    $host = 'localhost';
    $db_username = 'qmzsrnmy_luckyspin';
    $db_password = 'J]ZgIBo#h!ZJ';
    $db_name = 'qmzsrnmy_luckyspin';
    
}
else if($host_name == 'wgc33.vip')
{
    $host = 'localhost';
    $db_username = 'admin_wgc33_vip';
    $db_password = 'Uw5nHmY1kzKfuZW';
    $db_name = 'admin_wgc33_vip';
}
else if($host_name == 'spin2win.bet')
{
    $host = 'localhost';
    $db_username = 'admin_spin2win_bet';
    $db_password = 'Uw5nHmY1kzKfuZW';
    $db_name = 'admin_spin2win_bet';
}
else if($host_name == 'skyworldsg-luckyspin.com')
{
    $host = 'localhost';
    $db_username = 'admin_skyworldsg_luckyspin';
    $db_password = 'Uw5nHmY1kzKfuZW';
    $db_name = 'admin_skyworldsg_luckyspin';
}
else if($host_name == 'luckyspin.supremeworld88.com')
{
    $host = 'localhost';
    $db_username = 'qmzsrnmy_luckyspin';
    $db_password = 'Ih$06C&Cy~cS';
    $db_name = 'qmzsrnmy_luckyspin.supremeworld88.com';
}
else if($host_name == 'wheel.jgdx.xyz')
{
    $host = 'localhost';
    $db_username = 'admin_wheel_jgdx_xyz_db';
    $db_password = 'Uw5nHmY1kzKfuZW';
    $db_name = 'admin_wheel_jgdx_xyz_db';
}
else if($host_name == 'luckyspin888.com')
{
    $host = 'localhost';
    $db_username = 'admin_luckyspin888.com';
    $db_password = 'Uw5nHmY1kzKfuZW';
    $db_name = 'admin_luckyspin888.com';
}
else if($host_name == 'wheel001.jgdx.xyz')
{
    $host = 'localhost';
    $db_username = 'admin_wheel001_jgdx_xyz_db';
    $db_password = 'Uw5nHmY1kzKfuZW';
    $db_name = 'admin_wheel001_jgdx_xyz_db';
}
else if($host_name == 'wheel002.jgdx.xyz')
{
    $host = 'localhost';
    $db_username = 'admin_wheel002_jgdx_xyz_db';
    $db_password = 'Uw5nHmY1kzKfuZW';
    $db_name = 'admin_wheel002_jgdx_xyz_db';
}
else if($host_name == 'wheel003.jgdx.xyz')
{
    $host = 'localhost';
    $db_username = 'admin_wheel003_jgdx_xyz_db';
    $db_password = 'Uw5nHmY1kzKfuZW';
    $db_name = 'admin_wheel003_jgdx_xyz_db';
}
else if($host_name == 'wheel004.jgdx.xyz')
{
    $host = 'localhost';
    $db_username = 'admin_wheel004_jgdx_xyz_db';
    $db_password = 'Uw5nHmY1kzKfuZW';
    $db_name = 'admin_wheel004_jgdx_xyz_db';
}
else if($host_name == 'wheel005.jgdx.xyz')
{
    $host = 'localhost';
    $db_username = 'admin_wheel005_jgdx_xyz_db';
    $db_password = 'Uw5nHmY1kzKfuZW';
    $db_name = 'admin_wheel005_jgdx_xyz_db';
}
else if($host_name == 'wheel006.jgdx.xyz')
{
    $host = 'localhost';
    $db_username = 'admin_wheel006_jgdx_xyz_db';
    $db_password = 'Uw5nHmY1kzKfuZW';
    $db_name = 'admin_wheel006_jgdx_xyz_db';
}
else if($host_name == 'wheel007.jgdx.xyz')
{
    $host = 'localhost';
    $db_username = 'admin_wheel007_jgdx_xyz_db';
    $db_password = 'Uw5nHmY1kzKfuZW';
    $db_name = 'admin_wheel007_jgdx_xyz_db';
}
else if($host_name == 'wheel008.jgdx.xyz')
{
    $host = 'localhost';
    $db_username = 'admin_wheel008_jgdx_xyz_db';
    $db_password = 'Uw5nHmY1kzKfuZW';
    $db_name = 'admin_wheel008_jgdx_xyz_db';
}
else if($host_name == 'wheel009.jgdx.xyz')
{
    $host = 'localhost';
    $db_username = 'admin_wheel009_jgdx_xyz_db';
    $db_password = 'Uw5nHmY1kzKfuZW';
    $db_name = 'admin_wheel009_jgdx_xyz_db';
}
else if($host_name == 'wheel010.jgdx.xyz')
{
    $host = 'localhost';
    $db_username = 'admin_wheel010_jgdx_xyz_db';
    $db_password = 'Uw5nHmY1kzKfuZW';
    $db_name = 'admin_wheel010_jgdx_xyz_db';
}
else if($host_name == 'wheel011.jgdx.xyz')
{
    $host = 'localhost';
    $db_username = 'admin_wheel011_jgdx_xyz_db';
    $db_password = 'Uw5nHmY1kzKfuZW';
    $db_name = 'admin_wheel011_jgdx_xyz_db';
}

else if($host_name == 'wheel012.jgdx.xyz')
{
    $host = 'localhost';
    $db_username = 'admin_wheel012_jgdx_xyz_db';
    $db_password = 'Uw5nHmY1kzKfuZW';
    $db_name = 'admin_wheel012_jgdx_xyz_db';
}
else if($host_name == 'wheel013.jgdx.xyz')
{
    $host = 'localhost';
    $db_username = 'admin_wheel013_jgdx_xyz_db';
    $db_password = 'Uw5nHmY1kzKfuZW';
    $db_name = 'admin_wheel013_jgdx_xyz_db';
}

else if($host_name == 'wheel014.jgdx.xyz')
{
    $host = 'localhost';

    $db_username = 'admin_wheel014_jgdx_xyz_db';

    $db_password = 'Uw5nHmY1kzKfuZW';

    $db_name = 'admin_wheel014_jgdx_xyz_db';
}
else if($host_name == 'wheel015.jgdx.xyz')
{
    $host = 'localhost';

    $db_username = 'admin_wheel015_jgdx_xyz_db';

    $db_password = 'Uw5nHmY1kzKfuZW';

    $db_name = 'admin_wheel015_jgdx_xyz_db';
}
else if($host_name == 'wheel016.jgdx.xyz')
{
    $host = 'localhost';

    $db_username = 'admin_wheel016_jgdx_xyz_db';

    $db_password = 'Uw5nHmY1kzKfuZW';

    $db_name = 'admin_wheel016_jgdx_xyz_db';
}

else if($host_name == 'wheel017.jgdx.xyz')
{
    $host = 'localhost';

    $db_username = 'admin_wheel017_jgdx_xyz_db';

    $db_password = 'Uw5nHmY1kzKfuZW';

    $db_name = 'admin_wheel017_jgdx_xyz_db';
}

else if($host_name == 'wheel018.jgdx.xyz')
{
    $host = 'localhost';

    $db_username = 'admin_wheel018_jgdx_xyz_db';

    $db_password = 'Uw5nHmY1kzKfuZW';

    $db_name = 'admin_wheel018_jgdx_xyz_db';
}

else if($host_name == 'wheel019.jgdx.xyz')
{
    $host = 'localhost';

    $db_username = 'admin_wheel019_jgdx_xyz_db';

    $db_password = 'Uw5nHmY1kzKfuZW';

    $db_name = 'admin_wheel019_jgdx_xyz_db';
}
else if($host_name == 'wheel020.jgdx.xyz')
{
    $host = 'localhost';

    $db_username = 'admin_wheel020_jgdx_xyz_db';

    $db_password = 'Uw5nHmY1kzKfuZW';

    $db_name = 'admin_wheel020_jgdx_xyz_db';
}

else if($host_name == 'wheel021.jgdx.xyz')
{
    $host = 'localhost';

    $db_username = 'admin_wheel021_jgdx_xyz_db';

    $db_password = 'Uw5nHmY1kzKfuZW';

    $db_name = 'admin_wheel021_jgdx_xyz_db';
}

else if($host_name == 'wheel022.jgdx.xyz')
{
    $host = 'localhost';

    $db_username = 'admin_wheel022_jgdx_xyz_db';

    $db_password = 'Uw5nHmY1kzKfuZW';

    $db_name = 'admin_wheel022_jgdx_xyz_db';
}

else if($host_name == 'wheel023.jgdx.xyz')
{
    $host = 'localhost';

    $db_username = 'admin_wheel023_jgdx_xyz_db';

    $db_password = 'Uw5nHmY1kzKfuZW';

    $db_name = 'admin_wheel023_jgdx_xyz_db';
}
else if($host_name == 'wheel024.jgdx.xyz')
{
    $host = 'localhost';

    $db_username = 'admin_wheel024_jgdx_xyz_db';

    $db_password = 'Uw5nHmY1kzKfuZW';

    $db_name = 'admin_wheel024_jgdx_xyz_db';
}

else if($host_name == 'wheel025.jgdx.xyz')
{
    $host = 'localhost';

    $db_username = 'admin_wheel025_jgdx_xyz_db';

    $db_password = 'Uw5nHmY1kzKfuZW';

    $db_name = 'admin_wheel025_jgdx_xyz_db';
}
else if($host_name == 'supremeworld88.bonuus.io')
{  
    $host = 'localhost';

    $db_username = 'qmzsrnmy_supremeworld882';

    $db_password = '^TKtX&WPNzHD';

    $db_name = 'qmzsrnmy_supremeworld88.bonuus.io';
}
else if($host_name == 'fbads996.com')
{ 
    $host = 'localhost';
    $db_username = 'admin_fbads996_com';
    $db_password = 'Uw5nHmY1kzKfuZW';
    $db_name = 'admin_fbads996_com';
}
else if($host_name == 'readyforyourreview.com')
{
    $host = 'localhost';
    $db_username = 'ccrdskmy_wheel';
    $db_password = '[ZgyAlf{JqTT';
    $db_name = 'ccrdskmy_loyality_wheel_spin';
}
else if($host_name == 'jgdx.xyz')
{
    $host = 'localhost';
    $db_username = 'admin_jgdx_xyz_db';
    $db_password = 'Uw5nHmY1kzKfuZW';
    $db_name = 'admin_jgdx_xyz_db';
}
else if($host_name == 'sub.jgdx.xyz')
{
    $host = 'localhost';
    $db_username = 'admin_sub_jgdx_xyz_db';
    $db_password = 'Uw5nHmY1kzKfuZW';
    $db_name = 'admin_sub_jgdx_xyz_db';
}
else if($host_name == 'edbet321spins.com')
{
    $host = 'localhost';
    $db_username = 'admin_edbet321spins_com_database';
    $db_password = 'Uw5nHmY1kzKfuZW';
    $db_name = 'admin_edbet321spins_com_database';
}
else if($host_name == 'testing.jgdx.xyz')
{
    $host = 'localhost';
    $db_username = 'admin_testing_jgdx_xyz';
    $db_password = 'mKT9JmVaPk1bkyku';
    $db_name = 'admin_testing_jgdx_xyz_database';
}
else if($host_name == '29spin.com')
{
    $host = 'localhost';
    $db_username = 'admin_29spin_com';
    $db_password = 'lXcUTwoJ8SrN0xGw';
    $db_name = 'admin_29spin_com_databse';
}
else if($host_name == 'king99luckyspin.com')
{
    $host = 'localhost';
    $db_username = 'admin_king99luckyspin_com';
    $db_password = 'ED3o1w7z3a2yKZSq';
    $db_name = 'admin_king99luckyspin_com_db';
}
else if($host_name == 'smssenddomain.jgdx.xyz')
{
    // use for sms function
    $host = 'localhost';
    $db_username = 'admin_smssenddomain_jgdx_xyz';
    $db_password = 'SDMWQuPabFrox9FN';
    $db_name = 'admin_smssenddomain_jgdx_xyz_db';
}
else if($host_name == 'testingwheel.jgdx.xyz')
{
    // use for sms function
    $host = 'localhost';
    $db_username = 'admin_testingwheel_jgdx_xyz';
    $db_password = 'wVVCXfMgDehf7Qku';
    $db_name = 'admin_testingwheel_jgdx_xyz_db';
}
else if($host_name == 'kuatwheel.com')
{
    // use for sms function
    $host = 'localhost';
    $db_username = 'admin_kuatwheel_com';
    $db_password = '14L8UglsV3TrcvJ7';
    $db_name = 'admin_kuatwheel_com_db';
}
else if($host_name == 'm33spinwheel.com')
{
    // use for sms function
    $host = 'localhost';
    $db_username = 'admin_m33spinwheel_com';
    $db_password = 'RC48CXxaOHTK9gNy';
    $db_name = 'admin_m33spinwheel_com_db';
}
else if($host_name == 'bk8luckywin.com')
{
    // use for sms function
    $host = 'localhost';
    $db_username = 'admin_bk8luckywin_com';
    $db_password = 'cEQrV4oUwkXfye2z';
    $db_name = 'admin_bk8luckywin_com_db';
}
else if($host_name == 'spin2win88.com')
{
    // use for sms function
    $host = 'localhost';
    $db_username = 'admin_spin2win88_com';
    $db_password = 'twFS2Vbq2yn7luHk';
    $db_name = 'admin_spin2win88_com_db';
}



$http_or_http = $_SERVER['REQUEST_SCHEME'];
if($http_or_http == 'http')
{
    $http_or_http='https';
}


//if (empty($_SERVER['HTTPS']) || $_SERVER['HTTPS'] === "off") {
 //    $location = 'https://' . $host_name;
 //    header('HTTP/1.1 301 Moved Permanently');
  //   header('Location: ' . $location);
  //   exit;
 //}
// if($host_name == 'latesttestingnew.jgdx.xyz' || $host_name == 'wgc33.vip' || $host_name == 'spin2win.bet' || $host_name == 'skyworldsg-luckyspin.com' || $host_name == 'wheel.jgdx.xyz'  || $host_name == 'wheel001.jgdx.xyz' || $host_name == 'wheel002.jgdx.xyz' || $host_name == 'wheel003.jgdx.xyz' || $host_name == 'wheel004.jgdx.xyz' ||$host_name == 'wheel005.jgdx.xyz' || $host_name == 'wheel006.jgdx.xyz' || $host_name == 'wheel007.jgdx.xyz' || $host_name == 'wheel008.jgdx.xyz' || $host_name == 'wheel009.jgdx.xyz' || $host_name == 'wheel010.jgdx.xyz' || $host_name == 'wheel011.jgdx.xyz' || $host_name == 'wheel012.jgdx.xyz' || $host_name == 'wheel013.jgdx.xyz' || $host_name == 'wheel014.jgdx.xyz' || $host_name == 'wheel015.jgdx.xyz' || $host_name == 'wheel016.jgdx.xyz' || $host_name == 'wheel017.jgdx.xyz' || $host_name == 'wheel018.jgdx.xyz' || $host_name == 'wheel019.jgdx.xyz' || $host_name == 'wheel020.jgdx.xyz' || $host_name == 'wheel021.jgdx.xyz' || $host_name == 'wheel022.jgdx.xyz' || $host_name == 'wheel023.jgdx.xyz' || $host_name == 'wheel024.jgdx.xyz' || $host_name == 'wheel025.jgdx.xyz' || $host_name == 'fbads996.com' || $host_name == 'sub.jgdx.xyz' || $host_name == 'edbet321spins.com' || $host_name == 'testing.jgdx.xyz' || $host_name == '29spin.com' || $host_name == 'king99luckyspin.com' || $host_name == 'smssenddomain.jgdx.xyz' || $host_name == 'testingwheel.jgdx.xyz' || $host_name == 'kuatwheel.com' || $host_name == 'm33spinwheel.com' || $host_name == 'bk8luckywin.com' || $host_name == 'spin2win88.com')
// {

// }
// else
// {
// $conn  = mysqli_connect($host,$db_username,$db_password,$db_name);
// }

define('Site_URL',$http_or_http.'://'.$host_name.'/admin_panel/pages');
define('Front_URL',$http_or_http.'://'.$host_name);



//////
define('ciphering', 'AES-128-CTR');
define('encryption_iv', '1234567891011121');
define('encryption_key', 'loyalty_spin_wheel');
?>