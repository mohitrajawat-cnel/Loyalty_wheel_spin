<?php
session_start();
include 'config.php';

$order_id_data = $_REQUEST['order_id_data'];
$count_hwe = 1;
foreach($order_id_data as $order_id_datas)
{//ramkishan
    $update_baner_order = "UPDATE ".$table_prefix."banner_add SET order_sort = $count_hwe WHERE id='".$order_id_datas."'"; 
    mysqli_query($conn,$update_baner_order);

    $count_hwe++;
}

die();