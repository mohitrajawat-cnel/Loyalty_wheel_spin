<?php
date_default_timezone_set("Asia/Kuala_Lumpur");

global $prefix;
global $game_withCode_orNot;
$host_name = $_SERVER['HTTP_HOST'];
$http_or_http = $_SERVER['REQUEST_SCHEME'];
define('Site_URL',$http_or_http.'://'.$host_name);

// if($host_name == 'plinko.jgdx.xyz')
// {
//     $hostname = 'localhost';
//     $username = 'admin_plinko_jgdx_xyz';
//     $password = 'ZNdZz9QS4zlWT5yP';
//     $database = 'admin_plinko_jgdx_xyz';
// }
// else if($host_name == 'plinko001.jgdx.xyz')
// {
//     $hostname = 'localhost';
//     $username = 'admin_plinko001_jgdx_xyz';
//     $password = 'hYRY;=9(khd]mNng';
//     $database = 'admin_plinko001_jgdx_xyz';
// }
// else if($host_name == 'plinko002.jgdx.xyz')
// {
//     $hostname = 'localhost';
//     $username = 'admin_plinko002_jgdx_xyz';
//     $password = 'OLOims8HVnzGBMU0';
//     $database = 'admin_plinko002_jgdx_xyz';
// }
// else if($host_name == 'plinko003.jgdx.xyz')
// {
//     $hostname = 'localhost';
//     $username = 'admin_plinko003_jgdx_xyz';
//     $password = 'gIKD4nA58SSM0x9k';
//     $database = 'admin_plinko003_jgdx_xyz';
// }
// else if($host_name == 'plinko004.jgdx.xyz')
// {
//     $hostname = 'localhost';
//     $username = 'admin_plinko004_jgdx_xyz';
//     $password = 'kPfIH5gFoONtixWq';
//     $database = 'admin_plinko004_jgdx_xyz';
// }
// else if($host_name == 'plinko005.jgdx.xyz')
// {
//     $hostname = 'localhost';
//     $username = 'admin_plinko005_jgdx_xyz';
//     $password = 'dhv4dCKXmyWAiuJX';
//     $database = 'admin_plinko005_jgdx_xyz';
// }

// else if($host_name == 'vc78game.com')
// {
//     $hostname = 'localhost';
//     $username = 'admin_vc78game_jgdx_xyz';
//     $password = 'FbDylMPmz3fPhV76';
//     $database = 'admin_vc78game_jgdx_xyz';
// } else{
    $hostname = 'localhost';
    $username = 'admin_plinko_jgdx_xyz';
    $password = 'ZNdZz9QS4zlWT5yP';
    $database = 'admin_plinko_jgdx_xyz';
//}

$conn = mysqli_connect($hostname, $username, $password, $database) or die(mysqli_connect_error());

$customConn = mysqli_connect("localhost", "admin_plinko_jgdx_xyz", "ZNdZz9QS4zlWT5yP", "admin_plinko_jgdx_xyz") or die(mysqli_connect_error());
$dataSql = "SELECT `game_popup`, `table_prefix` FROM `plinko_domain_table` WHERE 1=1";

if(isset($_GET['domain_setting_id'])) {
    $dataSql .= " AND `id` = '".$_GET['domain_setting_id']."'";
} else {
    $dataSql .= " AND `domain_name` = '".$host_name."'";
}

$prefixSql = mysqli_query($customConn, $dataSql);
if( $prefixSql ) {
    $rowData = mysqli_fetch_assoc($prefixSql);
    $prefix =  $rowData['table_prefix'];
    $game_withCode_orNot = $rowData['game_popup'];
}
?>