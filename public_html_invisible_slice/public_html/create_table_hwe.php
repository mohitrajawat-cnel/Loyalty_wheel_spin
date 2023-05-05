<?php
$host_name = $_SERVER['HTTP_HOST'];

$host_super = 'localhost';
$db_username_super = 'admin_jgdx_xyz_db';
$db_password_super = 'Uw5nHmY1kzKfuZW';
$db_name_super = 'admin_jgdx_xyz_db';

$conn  = mysqli_connect($host_super,$db_username_super,$db_password_super,$db_name_super);

$select_super ="SELECT * from domain_list_settings";
$row_super = $conn->query($select_super);

while($result_super = mysqli_fetch_assoc($row_super))
{
    $table_prefix  =   $result_super['table_prefix'];
    if($table_prefix != '')
    {
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
        if(mysqli_query($conn,$share_redeem_reward_results))
        {
            echo "created";
            echo "<br>";
        }
        else
        {
             echo "created";
            echo "<br>";
        }

        //  $reward_redeem_share = 'CREATE TABLE IF NOT EXISTS `'.$table_prefix.'reward_redeem_share`
        // (
        // `id` INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        // `number_of_points` INT(11) NOT NULL DEFAULT 0,
        // `title` VARCHAR(256) NULL,
        // `description` TEXT NULL,
        // `user_share_point` INT(11) NOT NULL DEFAULT 0,
        // `image` VARCHAR(256) NULL,
        // `created` datetime(6) NULL
        // )';  
        // if(mysqli_query($conn,$reward_redeem_share))
        // {
        //     echo "created";
        //     echo "<br>";
        // }
        // else
        // {
        //      echo "created";
        //     echo "<br>";
        // }

        // $user_redeem_share_points = 'CREATE TABLE IF NOT EXISTS `'.$table_prefix.'user_redeem_share_points`
        // (
        // `id` INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        // `user_share_point` INT(11) NOT NULL DEFAULT 0,
        // `created` TIMESTAMP(6) NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
        // ) 

        // ';  
        // if(mysqli_query($conn,$user_redeem_share_points))
        // {
        //     echo "created";
        //     echo "<br>";
        // }
        // else
        // {
        //      echo "created";
        //     echo "<br>";
        // }

        // $reset_remain_spin = 'CREATE TABLE IF NOT EXISTS `'.$table_prefix.'reset_remain_spin`
        // (
        // `id` INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        // `reset_spin_hour` INT(11) NOT NULL DEFAULT 0,
        // `reset_remain_spin` INT(11) NOT NULL DEFAULT 0,
        // `user_id` INT(11) NOT NULL DEFAULT 0
        // ) 

        // ';  
        // if(mysqli_query($conn,$reset_remain_spin))
        // {
        //     echo "created";
        //     echo "<br>";
        // }
        // else
        // {
        //      echo "created";
        //     echo "<br>";
        // }

        // $user_redeem_spin_points = 'CREATE TABLE IF NOT EXISTS `'.$table_prefix.'user_redeem_spin_points`
        // (
        // `id` INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        // `user_reward_get_points` TEXT NULL DEFAULT 0,
        // `created` TIMESTAMP(6) NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
        // ) 

        // ';  
        // if(mysqli_query($conn,$user_redeem_spin_points))
        // {
        //     echo "created";
        //     echo "<br>";
        // }
        // else
        // {
        //     echo "Not created";
        //     echo "<br>";
        // }
    }

    

}

?>