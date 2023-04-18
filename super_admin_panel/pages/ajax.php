<?php
  function customFunc_hwe($dataArr = array()){
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
    echo $answer = curl_exec($curl);
    return $answer;
  }
  if(isset($_POST['domain_root_condition'])){
    $postvars_hwe = $_POST["dirData"];
    $docroot_result = customFunc_hwe($postvars_hwe);
    if($docroot_result === "0"){
      echo json_encode(array("result" => $docroot_result, "domain_name" => $postvars_hwe['arg2']));
      die();
    }
  }
  if(isset($_POST['create_database_tables'])){
   
    $conn = mysqli_connect('localhost', 'admin_plinko_jgdx_xyz', 'ZNdZz9QS4zlWT5yP', 'admin_plinko_jgdx_xyz');

    $domain_name = $_POST['domain_name'];
    $shortName = $_POST['shortName'];
    // $table_prefix = 'zgx_'.rand(10, 999)."_";
    $table_prefix = $_POST['table_prefix'];
    $domainInsertSql = "INSERT INTO `plinko_domain_table` (`domain_name`, `table_prefix`, `created_at`) VALUES ('".$domain_name."', '".$table_prefix."',  NOW())";
    
    
    
    $rowsContent = '';
    $count = 1;

    $admin_login_table = 'CREATE TABLE IF NOT EXISTS `'.$table_prefix.'plinko_users`(
      `id` INT(20) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
      `user_email` VARCHAR(256) NOT NULL,
      `password` VARCHAR(256) NOT NULL
    )';
    $first_result = mysqli_query($conn,$admin_login_table);
    $admin_login_table_data_insert = "INSERT INTO `".$table_prefix."plinko_users`
      SET `user_email` = 'admin@gmail.com',
      password= 'admin'
    ";
    $admin_insert_result = mysqli_query($conn,$admin_login_table_data_insert);
    $setprizeTable = "CREATE TABLE IF NOT EXISTS `".$table_prefix."plinkoSet_prize_table` (
      `id` INT(20) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
      `user_id` INT(20) NOT NULL,
      `prize_image` LONGTEXT NOT NULL,
      `prize_probability` VARCHAR(255) NOT NULL,
      `prize_value` TINYTEXT NOT NULL,
      `redeem_link` LONGTEXT NOT NULL,
      `label_img` MEDIUMTEXT NOT NULL,
      `win_prize_text` VARCHAR(500) NOT NULL,
      `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
    )";
    $second_result = mysqli_query($conn, $setprizeTable);
    $plinko_game_code_dataTable = "CREATE TABLE IF NOT EXISTS `".$table_prefix."plinko_game_code_data` (
      `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
      `code` VARCHAR(255) NOT NULL,
      `used_limit` INT(11) NOT NULL,
      `create` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
    )";
    $third_result = mysqli_query($conn, $plinko_game_code_dataTable);
    $spin_resultTable = "CREATE TABLE IF NOT EXISTS `".$table_prefix."spin_result` (
      `id` INT(20) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
      `code` VARCHAR(50) NOT NULL,
      `result` VARCHAR(255) NOT NULL,
      `play_time` DATETIME NOT NULL
    )";
    $fourth_result = mysqli_query($conn, $spin_resultTable);
    if($first_result && $second_result && $third_result && $fourth_result && $admin_insert_result){

      $insert_result = mysqli_query($conn, $domainInsertSql);
      $num_key = 11;
      $api_key = bin2hex(random_bytes($num_key));


      $domain_status =$_POST['domain_status'];
      $lucky_wheel_conn = mysqli_connect('localhost', 'admin_jgdx_xyz_db', 'Uw5nHmY1kzKfuZW', 'admin_jgdx_xyz_db');

      $insert2 = "INSERT into domain_list_settings SET domain_name = '".$domain_name."',
      status ='".$domain_status."',created=now(),table_prefix='".$table_prefix."',api_key='".$api_key."',game_type='2'"; 
      mysqli_query($lucky_wheel_conn,$insert2);


    
    }
    if( $insert_result ) {
      $domainData = mysqli_query($conn, "SELECT * FROM `plinko_domain_table`");
      while($dataRow = mysqli_fetch_assoc($domainData)){
        $rowsContent .= '<tr>
            <td>'.$count.'</td>
            <td>'.$dataRow['domain_name'].'</td>
            <td><a href="?delete_id='.$dataRow['id'].'"><img src="./trash.png" alt="" srcset="" style="width: 10%;"></a></td>
        </tr>';
        $count++;
      }
      echo json_encode(array("result1" => "success", "data" => $rowsContent));
      die;
    } else {
      echo json_encode(array("result1" => "Error Occured While Creating Domain!", "error" => error_reporting(E_ALL)));
      die;
    }
  }
?>