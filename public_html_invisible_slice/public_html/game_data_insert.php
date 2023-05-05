<?php
session_start();
include 'admin_panel/pages/plinko_admin_panel/config.php';

$output = array();
if(isset($_POST['gameWin_code_data'])){
    $PrizeIndex=$_REQUEST['PrizeIndex'];
    $code_data=$_REQUEST['gameWin_code_data'];
    $current_time=date('Y-m-d H:i:s', strtotime("NOW"));
    $prizeLabel = json_decode($_REQUEST['prizeLabel'], true);

    if($PrizeIndex==0)
    {
        $result = $prizeLabel[0]['first_prize'];
    }
    elseif($PrizeIndex==1)
    {
        $result = $prizeLabel[0]['second_prize'];
    }
    elseif($PrizeIndex==2)
    {
        $result = $prizeLabel[0]['third_prize'];
    }
    elseif($PrizeIndex==3)
    {
        $result = $prizeLabel[0]['fourth_prize'];
    }
    elseif($PrizeIndex==4)
    {
        $result = $prizeLabel[0]['fifth_prize'];
    }
    elseif($PrizeIndex==5)
    {
        $result = $prizeLabel[0]['sixth_prize'];
    }

    $query_save_data="INSERT INTO `".$prefix."spin_result` (`code`, `result`, `play_time`) VALUES ('$code_data', '$result', '$current_time')";
    $query_insert_data=mysqli_query($conn,$query_save_data);
    
    $select="select * from `".$prefix."plinko_game_code_data` where code='$code_data'";
    $query=mysqli_query($conn,$select);
    $row=mysqli_fetch_array($query);
    $used_limit = $row['used_limit'];
    $id = $row['id'];
    
    if( $used_limit >= 1 ) {
        $_SESSION['code_id'] = null;
        /* $used_limit_new = $used_limit-1;
        $update_limit="UPDATE `".$prefix."plinko_game_code_data` SET used_limit=$used_limit_new WHERE id=$id";
        $query_update_limit=mysqli_query($conn,$update_limit); */
    }
    else {
        $_SESSION['code_id'] = null;
    }
    $output['data'] = $used_limit;
    echo json_encode($output);
    die();
}

if(isset($_POST['noWin_code_data'])){
    $code_data = $_POST['noWin_code_data'];
    $current_time = date('Y-m-d H:i:s', strtotime("NOW"));

    $query_save_data="INSERT INTO `".$prefix."spin_result` (`code`, `result`, `play_time`) VALUES ('$code_data', 7777, '$current_time')";
    $query_insert_data=mysqli_query($conn,$query_save_data);

    $select="select * from `".$prefix."plinko_game_code_data` where code='$code_data'";
    $query=mysqli_query($conn,$select);
    $row=mysqli_fetch_array($query);
    $used_limit = $row['used_limit'];
    $id = $row['id'];
    
    if( $used_limit >= 1 ) {
        $_SESSION['code_id'] = null;
        /* $used_limit_new = $used_limit-1;
        $update_limit="UPDATE `".$prefix."plinko_game_code_data` SET used_limit=$used_limit_new WHERE id=$id";
        $query_update_limit=mysqli_query($conn,$update_limit); */
    }
    else {
        $_SESSION['code_id'] = null;
    }
    $output['data'] = $used_limit;
    echo json_encode($output);
    die();
}
?>