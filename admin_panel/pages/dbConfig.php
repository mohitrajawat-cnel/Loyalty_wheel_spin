<?php
// $dbHost = 'localhost';
// $dbUsername = 'admin_kuatwheel_com';
// $dbPassword = '14L8UglsV3TrcvJ7';
// $dbName = 'admin_kuatwheel_com_db';

$dbHost = 'localhost';
$dbUsername = 'admin_jgdx_xyz_db';
$dbPassword = 'Uw5nHmY1kzKfuZW';
$dbName = 'admin_jgdx_xyz_db';
// Create database connection
try{
    $db = new PDO("mysql:host=$dbHost;dbname=$dbName", $dbUsername, $dbPassword);



   $statements = [ 
    'CREATE TABLE IF NOT EXISTS `short_urls` (
        `id` int(11) NOT NULL AUTO_INCREMENT,
        `long_url` varchar(255) NULL,
        `short_code` varchar(25) NULL,
        `hits` int(11) NULL,
        `created` datetime NULL,
        PRIMARY KEY (`id`)
       )'
       ];

       // execute SQL statements
foreach ($statements as $statement) {
	$db->exec($statement);

}
//    mysqli_query($db,$table_create);
}catch(PDOException $e){
    echo "Connection failed: " . $e->getMessage();
}