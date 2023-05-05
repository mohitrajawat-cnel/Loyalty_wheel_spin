<?php
include 'admin_panel/pages/config.php';

$select_super ="SELECT * from domain_list_settings";
$row_super = $conn->query($select_super);

while($result_super = mysqli_fetch_assoc($row_super))
{

    $table_prefix = $result_super['table_prefix'];

    $form_table = 'CREATE TABLE IF NOT EXISTS `'.   $table_prefix.'contact_form`
    (
    `id` INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `name` VARCHAR(256) NULL,
    `description` text NULL,
    `email` VARCHAR(256) NULL,
    `mobile_number` VARCHAR(256) NULL,
    `created` datetime(6) NULL
    
    ) 
    
    ';  
    if(mysqli_query($conn,$form_table))
    {
        echo "created<br>";
    }
    else
    {
        echo "not created<br>";
    }
}

