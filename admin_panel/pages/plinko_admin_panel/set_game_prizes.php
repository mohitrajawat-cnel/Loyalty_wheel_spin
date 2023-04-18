<?php
session_start();
include 'config.php';
$user_id = $_SESSION['admin_user_id'];
    if(!isset($_SESSION['admin_user_id']))
    {
    
    ?>
        <script>
            window.location.href='<?php echo Site_URL; ?>/admin_panel/pages/login.php';
        </script>
    <?php
    }

    class Image_converter{
        public function upload_image($files, $target_dir, $input_name){
            $target_dir = "$target_dir/";
            $imageTemp_name = $files['prize']['tmp_name'][$input_name];
            $base_name = basename($files["prize"]["name"][$input_name]);
            $imageFileType = $this->get_image_type($base_name);
            $new_name = $this->get_dynamic_name($base_name, $imageFileType);
            $target_file = $target_dir . $new_name;
            $validate = $this->validate_image($files["prize"]["tmp_name"][$input_name]);

            if(!$validate){
                echo "Doesn't seem like an image file :(";
                return false;
            }
            
            $file_size = $this->check_file_size($files["prize"]["size"][$input_name], 1000000);
            if(!$file_size){
                echo "You cannot upload more than 1MB file";
                return false;
            }
            
            $file_type = $this->check_only_allowed_image_types($imageFileType);
            if(!$file_type){
                echo "You cannot upload other than JPG, JPEG, GIF and PNG";
                return false;
            }

            list($width, $height, $type) = getimagesize($imageTemp_name);

            $old_image = $this->load_image($imageTemp_name, $type);
            if($this->scale_image(60, $old_image, $width, $height, $target_file)){
                return $new_name;
            }
        }

        protected function load_image($filename, $type) {

            if( $type == IMAGETYPE_JPEG ) {
                $image = imagecreatefromjpeg($filename);
            }
            elseif( $type == IMAGETYPE_PNG ) {
                $image = imagecreatefrompng($filename);
            }
            elseif( $type == IMAGETYPE_GIF ) {
                $image = imagecreatefromgif($filename);
            } else{
                imagecreatefromjpeg($filename);
            }
            return $image;
        }

        protected function scale_image($scale, $image, $width, $height, $target_file) {
            $ratio = $width/$height;
            if(($ratio) >= 1){
                $new_width = 100;
                $new_height = 120;
            } else if($ratio < 1 ) {
                $new_width = 100;
                $new_height = 120;
            }
            else {
                $new_width = ($width - 10) * $scale/100;
                $new_height = ($height - 10) * $scale/100;
            }
            
            return $this->resize_image($new_width, $new_height, $image, $width, $height, $target_file);
        }

        protected function resize_image($new_width, $new_height, $image, $width, $height, $target_file) {

            // header('content-type: image/png');
            $new_imag = imagecreatetruecolor($new_width, $new_height);
            imagecopyresampled($new_imag, $image, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
            $remove = imagecolorat($new_imag, (int)$new_width, (int)$new_height);
            imagecolortransparent($new_imag, $remove);
            $bg = $this->hexColorAllocate($new_imag, 'ADD8E6');
            imagefill($new_imag, 400, 300, $bg);
            // imagepng($new_imag);die;
            return imagepng($new_imag, $target_file);

        }

        protected function hexColorAllocate($im,$hex){
            $hex = ltrim($hex,'#');
            $r = hexdec(substr($hex,0,2));
            $g = hexdec(substr($hex,2,2));
            $b = hexdec(substr($hex,4,2));

            return imagecolorallocate($im, $r, $g, $b);
        }

        protected function get_image_type($target_file){
            $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
            return $imageFileType;
        }

        protected function validate_image($file){
            $check = getimagesize($file);
            if($check !== false) {
                return true;
            }
            return false;
        }
        
        protected function check_file_size($file, $size_limit){
            if ($file > $size_limit) {
                return false;
            }
            return true;
        }
        
        protected function check_only_allowed_image_types($imagetype){
            if($imagetype != "jpg" && $imagetype != "png" && $imagetype != "jpeg" && $imagetype != "gif" ) {
                return false;
            }
            return true;
        }
        
        protected function get_dynamic_name($basename, $imagetype){
            $only_name = basename($basename, '.'.$imagetype); // remove extension
            $combine_time = $only_name.'_'.rand();
            $new_name = $combine_time.'.'.$imagetype;
            return $new_name;
        }
        
        protected function remove_extension_from_image($image){
            $extension = $this->get_image_type($image); //get extension
            $only_name = basename($image, '.'.$extension); // remove extension
            return $only_name;
        }
    }
    
    if(isset($_POST['prize_porbltySubmit'])){
        /* print_r($_FILES); */
        $prize_probalty = json_encode($_POST['prize_probalty']);
        $prize_value = json_encode($_POST['prize_value']);
        $created_at = date("Y-m-d H:i:s", strtotime("Now"));
        $redeem_link = json_encode($_POST['prizelink']);
        $prizeLabel = json_encode($_POST['prize_label']);
        $wining_prize_text = $_POST['wining_prize_text'];

        $prize_imgArr = array();

        $uploadObj = new Image_converter();
        $target_dir = '../../../sprites/prize/';
        $countRowsql = "SELECT * FROM `".$prefix."plinkoSet_prize_table` WHERE `user_id` = $user_id";
        $result1 = mysqli_query($conn, $countRowsql);
        $prizeRows = mysqli_fetch_assoc($result1);
        $prize_imgArr = json_decode($prizeRows['prize_image'], true);

        foreach($_FILES['prize']['name'] as $key => $val){

            if($val !== ''){
                $image_name = $uploadObj->upload_image($_FILES, $target_dir, $key);
                if($key == 'first_prize'){
                    $prize_imgArr[$key] = $image_name;
                } else if($key == 'second_prize'){
                    $prize_imgArr[$key] = $image_name;
                } else if($key == 'third_prize'){
                    $prize_imgArr[$key] = $image_name;
                } else if($key == 'fourth_prize'){
                    $prize_imgArr[$key] = $image_name;
                } else if($key == 'fifth_prize'){
                    $prize_imgArr[$key] = $image_name;
                } else if($key == 'sixth_prize'){
                    $prize_imgArr[$key] = $image_name;
                }
            }

        }

        $prize_img = json_encode($prize_imgArr);
        $label_img = json_encode($label_imgArr);

        if(mysqli_num_rows($result1) > 0){
            mysqli_query($conn, "UPDATE `".$prefix."plinkoSet_prize_table` SET `prize_image` = '$prize_img', `prize_probability` = '$prize_probalty', `prize_value` = '$prize_value', `redeem_link` = '$redeem_link', `label_img` = '$prizeLabel', `win_prize_text` = '$wining_prize_text', `created_at` = '$created_at' WHERE `user_id` = $user_id");
        }
        else{
            $prize_problty_sql = "INSERT INTO `".$prefix."plinkoSet_prize_table` (`user_id`, `prize_image`, `prize_probability`, `prize_value`, `redeem_link`, `label_img`, `win_prize_text`, `created_at`) VALUES ($user_id, '$prize_img', '$prize_probalty', '$prize_value', '$redeem_link', '$prizeLabel', '$wining_prize_text', '$created_at')";
            $result = mysqli_query($conn, $prize_problty_sql);
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!--     Fonts and icons     -->
    <link rel="stylesheet" type="text/css"
    href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700" />
    <!-- Nucleo Icons -->
    <link href="../../assets/css/nucleo-icons.css" rel="stylesheet" />
    <link href="../../assets/css/nucleo-svg.css" rel="stylesheet" />
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <!-- Material Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
    <!-- CSS Files -->
    <link id="pagestyle" href="../../assets/css/material-dashboard.css?v=3.0.0" rel="stylesheet" />
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script type="text/javascript" src="jquery-3.2.1.min.js"></script>

    <style>
        .prizeCheckbox_hwe{
            height: 30px;
            transform: scale(2);
        }
        .setPrize_class{
            display: flex;
            margin: 15px;
        }

        .setPrize_class label{
            font-size: 18px;
            font-weight: bold;
        }
        #prize_porbltySubmit{
            left: 40%;
            position: relative;
            margin: 2%;
            width: 20%;
            background: #EC407A;
            border-radius: 10px;
            padding: 1%;
        }
        .setPrize_class button.browseBtn_hwe{
            background-color: #fff;
            border: none;
        }
    </style>
</head>

<body class="g-sidenav-show  bg-gray-200">
    <?php
    include 'header.php';
    ?>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
    <!-- Navbar -->
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur"
      navbar-scroll="true">
      <div class="container-fluid py-1 px-3" style="overflow: hidden;">
        <nav aria-label="breadcrumb">
         <a href="/admin_panel/pages/plinko_admin_panel/set_game_prizes.php" style="text-decoration: none;">
          <h6 class="font-weight-bolder mb-0">Set Prize And Probability</h6>
         </a>
        </nav>
        <nav aria-label="breadcrumb" style="position: absolute;right: 18px;">
         <a href="/admin_panel/pages/plinko_admin_panel/logout.php" style="text-decoration: none;">
          <h6 class="font-weight-bolder mb-0">Logout</h6>
         </a>
        </nav>
        <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">

          <ul class="navbar-nav  justify-content-end">

            </li>
          </ul>
          </li> 
          </ul>
        </div>
      </div>
    </nav>
    <!-- End Navbar -->
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
            <div class="card my-4 content-hwe">
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                <div class="bg-gradient-primary shadow-primary border-radius-lg pt-2 pb-1">
                    <div class="row">
                        <div class="col-md-10 col-6 pt-2">
                            <h6 class="text-white text-capitalize ps-3">Set Prize And Probability</h6>
                        </div>
                        <!-- <div class="col-md-2 col-4 text-center">
                            <a href="../pages/set_game_prizes.php"><button type="button" class="btn btn-dark">Set Prize</button></a>
                        </div> -->
                    </div>
                </div>
                </div>
                <?php
                    $selectSql = "SELECT * FROM `".$prefix."plinkoSet_prize_table` ORDER BY `created_at` DESC";
                    $result = mysqli_query($conn, $selectSql);
                    $resultRow = mysqli_fetch_assoc($result);
                    // print_r($resultRow);
                    $num_row = mysqli_num_rows($result);
                ?>
                <div class="container" style="margin: 0; overflow:auto;">
                    <form class="form-horizontal" action="" method="post" enctype="multipart/form-data">
                        <?php
                            $prizeImg = json_decode($resultRow['prize_image'], true);
                            $prize_problty = json_decode($resultRow['prize_probability'], true);
                            $prize_winning = json_decode($resultRow['prize_value'], true);
                            $prizeLink = json_decode($resultRow['redeem_link'], true);
                            $prize_checkbox_check = json_decode($resultRow['label_check'], true);
                            $label_prize = json_decode($resultRow['label_img'], true);
                        ?>
                        <div class="form-group setPrize_class">
                            <label class="control-label col-sm-2">First Prize</label>
                            <!-- <input type="checkbox" name="prize_checkbox[first_checkbox]" value="" <?php /* if($_POST['prize_checkbox']['first_checkbox'] == 1) { echo "checked='checked'"; } else if( $prize_checkbox_check['first_checkbox'] == 1 ) { echo "checked='checked'"; } */ ?> class="prizeCheckbox_hwe" onchange="showlabelPrize(this, 'firstPrizeLabel_id', 'firstPrizeImage_id');">&nbsp;&nbsp;&nbsp;&nbsp; -->
                            <div class="col-sm-4" id="firstPrizeLabel_id">
                                <label for="">Prize Label</label>
                                <input type="text" name="prize_label[first_prize]" value="<?php if(isset($_POST['prize_label']['first_prize'])) echo $_POST['prize_label']['first_prize']; else { echo $label_prize['first_prize']; } ?>">
                            </div>
                            <div class="col-sm-4" id="firstPrizeImage_id">
                                <label for="first_prize_name">Browse...</label>
                                <button type="button" id="first_prize_name" class="browseBtn_hwe"><?php if(isset($_POST['prize']['first_prize'])) { echo $_POST['prize']['first_prize']; } else if($num_row > 0) { echo $prizeImg['first_prize']; } else{ echo "No Files Selected."; } ?></button>
                                <input type="file" name="prize[first_prize]" id="first_prizeImage" onchange="set_Prizeimage(this, 'first_prize_name');" class="form-control" style="display: none;">
                            </div>
                            <div class="col-sm-3">
                                <label for="first_prize_name">First Prize Link</label>
                                <input type="text" name="prizelink[frstPrize_link]" id="" value="<?php if( isset($_POST['prizelink']['frstPrize_link']) ) { echo $_POST['prizelink']['frstPrize_link']; } else { echo $prizeLink['frstPrize_link']; } ?>" />
                            </div>
                            <div style="display: flex;margin-left: 2%;" class="col-sm-3">
                                <label for="" style="margin-right: 10%;">Probability</label>
                                <input type="number" name="prize_probalty[first_prizeProblty]" value="<?php if(isset($_POST['prize_probalty']['first_prizeProblty'])) { echo $_POST['prize_probalty']['first_prizeProblty']; } else if($num_row > 0) { echo $prize_problty['first_prizeProblty']; } ?>" class="form-control">
                            </div>
                            <div style="display: flex;margin-left: 2%;" class="col-sm-3">
                                <label for="" style="margin-right: 10%;">Select Prize</label>
                                <select name="prize_value[first_prize_value]" id="">
                                    <option value="no win" <?php if($_POST['prize_value']['first_prize_value'] == 'no win' || $prize_winning['first_prize_value'] == 'no win') { echo 'selected'; } ?>>No Win</option>
                                    <option value="prize" <?php if($_POST['prize_value']['first_prize_value'] == 'prize' || $prize_winning['first_prize_value'] == 'prize') { echo 'selected'; } ?>>Prize</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group setPrize_class">
                            <label class="control-label col-sm-2">Second Prize</label>
                            <!-- <input type="checkbox" name="prize_checkbox[second_checkbox]" value="" <?php /* if($_POST['prize_checkbox']['second_checkbox'] == 1) { echo "checked='checked'"; } else if( $prize_checkbox_check['second_checkbox'] == 1 ) { echo "checked='checked'"; } */ ?> class="prizeCheckbox_hwe" onchange="showlabelPrize(this, 'secondPrizeLabel_id', 'secondPrizeImage_id');">&nbsp;&nbsp;&nbsp;&nbsp; -->
                            <div class="col-sm-4" id="secondPrizeLabel_id">
                                <label for="">Prize Label</label>
                                <input type="text" name="prize_label[second_prize]" value="<?php if(isset($_POST['prize_label']['second_prize'])) echo $_POST['prize_label']['second_prize']; else { echo $label_prize['second_prize']; } ?>">
                            </div>
                            <div class="col-sm-4" id="secondPrizeImage_id">
                                <label for="second_prize_name">Browse...</label>
                                <button type="button" id="second_prize_name" class="browseBtn_hwe"><?php if($num_row > 0) { echo $prizeImg['second_prize']; } else{ echo "No Files Selected."; } ?></button>
                                <input type="file" name="prize[second_prize]" id="second_prizeImage" onchange="set_Prizeimage(this, 'second_prize_name');" class="form-control" style="display: none;">
                            </div>
                            <div class="col-sm-3">
                                <label for="">Second Prize Link</label>
                                <input type="text" name="prizelink[secndPrize_link]" id="" value="<?php if( isset($_POST['prizelink']['secndPrize_link']) ) { echo $_POST['prizelink']['secndPrize_link']; } else { echo $prizeLink['secndPrize_link']; } ?>" />
                            </div>
                            <div style="display: flex;margin-left: 2%;" class="col-sm-3">
                                <label for="" style="margin-right: 10%;">Probability</label>
                                <input type="number" name="prize_probalty[second_prizeProblty]" value="<?php if(isset($_POST['prize_probalty']['second_prizeProblty'])) { echo $_POST['prize_probalty']['second_prizeProblty']; } else if($num_row > 0) { echo $prize_problty['second_prizeProblty']; } ?>" class="form-control">
                            </div>
                            <div style="display: flex;margin-left: 2%;" class="col-sm-3">
                                <label for="" style="margin-right: 10%;">Select Prize</label>
                                <select name="prize_value[second_prize_value]" id="">
                                    <option value="no win" <?php if($_POST['prize']['second_prize_value'] == 'no win' || $prize_winning['second_prize_value'] == 'no win') { echo 'selected'; } ?>>No Win</option>
                                    <option value="prize" <?php if($_POST['prize']['second_prize_value'] == 'prize' || $prize_winning['second_prize_value'] == 'prize') { echo 'selected'; } ?>>Prize</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group setPrize_class">
                            <label class="control-label col-sm-2" for="email">Third Prize</label>
                            <!-- <input type="checkbox" name="prize_checkbox[third_checkbox]" value="" <?php /* if($_POST['prize_checkbox']['third_checkbox'] == 1) { echo "checked='checked'"; } else if( $prize_checkbox_check['third_checkbox'] == 1 ) { echo "checked='checked'"; } */ ?> class="prizeCheckbox_hwe" onchange="showlabelPrize(this, 'thrdPrizeLabel_id', 'thrdPrizeImage_id');">&nbsp;&nbsp;&nbsp;&nbsp; -->
                            <div class="col-sm-4" id="thrdPrizeLabel_id">
                                <label for="">Prize Label</label>
                                <input type="text" name="prize_label[third_prize]" value="<?php if(isset($_POST['prize_label']['third_prize'])) echo $_POST['prize_label']['third_prize']; else { echo $label_prize['third_prize']; } ?>">
                            </div>
                            <div class="col-sm-4" id="thrdPrizeImage_id">
                                <label for="third_prize_name">Browse...</label>
                                <button type="button" id="third_prize_name" class="browseBtn_hwe"><?php if($num_row > 0) { echo $prizeImg['third_prize']; } else{ echo "No Files Selected."; } ?></button>
                                <input type="file" name="prize[third_prize]" id="third_prizeImage" onchange="set_Prizeimage(this, 'third_prize_name');" class="form-control" style="display: none;">
                            </div>
                            <div class="col-sm-3">
                                <label for="">Third Prize Link</label>
                                <input type="text" name="prizelink[thrdPrize_link]" id="" value="<?php if( isset($_POST['prizelink']['thrdPrize_link']) ) { echo $_POST['prizelink']['thrdPrize_link']; } else { echo $prizeLink['thrdPrize_link']; } ?>" />
                            </div>
                            <div style="display: flex;margin-left: 2%;" class="col-sm-3">
                                <label for="" style="margin-right: 10%;">Probability</label>
                                <input type="number" name="prize_probalty[third_prizeProblty]" value="<?php if(isset($_POST['prize_probalty']['third_prizeProblty'])) { echo $_POST['prize_probalty']['third_prizeProblty']; } else if($num_row > 0) { echo $prize_problty['third_prizeProblty']; } ?>" class="form-control">
                            </div>
                            <div style="display: flex;margin-left: 2%;" class="col-sm-3">
                                <label for="" style="margin-right: 10%;">Select Prize</label>
                                <select name="prize_value[third_prize_value]" id="">
                                    <option value="no win" <?php if($_POST['prize_value']['third_prize_value'] == 'no win' || $prize_winning['third_prize_value'] == 'no win') { echo 'selected'; } ?>>No Win</option>
                                    <option value="prize" <?php if($_POST['prize_value']['third_prize_value'] == 'prize' || $prize_winning['third_prize_value'] == 'prize') { echo 'selected'; } ?>>Prize</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group setPrize_class">
                            <label class="control-label col-sm-2" for="email">Fourth Prize</label>
                            <!-- <input type="checkbox" name="prize_checkbox[fourth_checkbox]" value="" <?php /* if($_POST['prize_checkbox']['fourth_checkbox'] == 1) { echo "checked='checked'"; } else if( $prize_checkbox_check['fourth_checkbox'] == 1 ) { echo "checked='checked'";  } */ ?> class="prizeCheckbox_hwe" onchange="showlabelPrize(this, 'fourthPrizeLabel_id', 'fourthPrizeImage_id');">&nbsp;&nbsp;&nbsp;&nbsp; -->
                            <div class="col-sm-4" id="fourthPrizeLabel_id">
                                <label for="">Prize Label</label>
                                <input type="text" name="prize_label[fourth_prize]" value="<?php if(isset($_POST['prize_label']['fourth_prize'])) echo $_POST['prize_label']['fourth_prize']; else { echo $label_prize['fourth_prize']; } ?>">
                            </div>
                            <div class="col-sm-4" id="fourthPrizeImage_id">
                                <label for="fourth_prize_name">Browse...</label>
                                <button type="button" id="fourth_prize_name" class="browseBtn_hwe"><?php if($num_row > 0) { echo $prizeImg['fourth_prize']; } else{ echo "No Files Selected."; } ?></button>
                                <input type="file" name="prize[fourth_prize]" id="fourth_prizeImage" onchange="set_Prizeimage(this, 'fourth_prize_name');" class="form-control" style="display: none;">
                            </div>
                            <div class="col-sm-3">
                                <label for="">Fourth Prize Link</label>
                                <input type="text" name="prizelink[frthPrize_link]" id="" value="<?php if( isset($_POST['prizelink']['frthPrize_link']) ) { echo $_POST['prizelink']['frthPrize_link']; } else { echo $prizeLink['frthPrize_link']; } ?>" />
                            </div>
                            <div style="display: flex;margin-left: 2%;" class="col-sm-3">
                                <label for="" style="margin-right: 10%;">Probability</label>
                                <input type="number" name="prize_probalty[fourth_prizeProblty]" value="<?php if(isset($_POST['prize_probalty']['fourth_prizeProblty'])) { echo $_POST['prize_probalty']['fourth_prizeProblty']; } else if($num_row > 0) { echo $prize_problty['fourth_prizeProblty']; } ?>" class="form-control">
                            </div>
                            <div style="display: flex;margin-left: 2%;" class="col-sm-3">
                                <label for="" style="margin-right: 10%;">Select Prize</label>
                                <select name="prize_value[fourth_prize_value]" id="">
                                    <option value="no win" <?php if($_POST['prize_value']['fourth_prize_value'] == 'no win' || $prize_winning['fourth_prize_value'] == 'no win') echo 'selected'; ?>>No Win</option>
                                    <option value="prize" <?php if($_POST['prize_value']['fourth_prize_value'] == 'prize' || $prize_winning['fourth_prize_value'] == 'prize') echo 'selected'; ?>>Prize</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group setPrize_class">
                            <label class="control-label col-sm-2" for="email">Fifth Prize</label>
                            <!-- <input type="checkbox" name="prize_checkbox[fifth_checkbox]" value="" <?php /* if($_POST['prize_checkbox']['fifth_checkbox'] == 1) { echo "checked='checked'"; } else if( $prize_checkbox_check['fifth_checkbox'] == 1 ) { echo "checked='checked'"; } */ ?> class="prizeCheckbox_hwe" onchange="showlabelPrize(this, 'fifthPrizeLabel_id', 'fifthPrizeImage_id');">&nbsp;&nbsp;&nbsp;&nbsp; -->
                            <div class="col-sm-4" id="fifthPrizeLabel_id">
                                <label for="">Prize Label</label>
                                <input type="text" name="prize_label[fifth_prize]" value="<?php if(isset($_POST['prize_label']['fifth_prize'])) echo $_POST['prize_label']['fifth_prize']; else { echo $label_prize['fifth_prize']; } ?>">
                            </div>
                            <div class="col-sm-4" id="fifthPrizeImage_id">
                                <label for="fifth_prize_name">Browse...</label>
                                <button type="button" id="fifth_prize_name" class="browseBtn_hwe"><?php  if($num_row > 0) { echo $prizeImg['fifth_prize']; } else{ echo "No Files Selected."; } ?></button>                                
                                <input type="file" name="prize[fifth_prize]" id="fifth_prizeImage" onchange="set_Prizeimage(this, 'fifth_prize_name');" class="form-control" style="display: none;">
                            </div>
                            <div class="col-sm-3">
                                <label for="">Fifth Prize Link</label>
                                <input type="text" name="prizelink[fifthPrize_link]" id="" value="<?php if( isset($_POST['prizelink']['fifthPrize_link']) ) { echo $_POST['prizelink']['fifthPrize_link']; } else { echo $prizeLink['fifthPrize_link']; } ?>" />
                            </div>
                            <div style="display: flex;margin-left: 2%;" class="col-sm-3">
                                <label for="" style="margin-right: 10%;">Probability</label>
                                <input type="number" name="prize_probalty[fifth_prizeProblty]" value="<?php if(isset($_POST['prize_probalty']['fifth_prizeProblty'])) { echo $_POST['prize_probalty']['fifth_prizeProblty']; } else if($num_row > 0) { echo $prize_problty['fifth_prizeProblty']; } ?>" class="form-control">
                            </div>
                            <div style="display: flex;margin-left: 2%;" class="col-sm-3">
                                <label for="" style="margin-right: 10%;">Select Prize</label>
                                <select name="prize_value[fifth_prize_value]" id="">
                                    <option value="no win" <?php if($_POST['prize_value']['fifth_prize_value'] == 'no win' || $prize_winning['fifth_prize_value'] == 'no win') { echo 'selected'; } ?>>No Win</option>
                                    <option value="prize" <?php if($_POST['prize_value']['fifth_prize_value'] == 'prize' || $prize_winning['fifth_prize_value'] == 'prize') { echo 'selected'; } ?>>Prize</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group setPrize_class">
                            <label class="control-label col-sm-2" for="email">Sixth Prize</label>
                            <!-- <input type="checkbox" name="prize_checkbox[sixth_checkbox]" value="" <?php /* if($_POST['prize_checkbox']['sixth_checkbox'] == 1) { echo "checked='checked'"; } else if( $prize_checkbox_check['sixth_checkbox'] == 1 ) { echo "checked='checked'"; } */ ?> class="prizeCheckbox_hwe" onchange="showlabelPrize(this, 'sixthPrizeLabel_id', 'sixthPrizeImage_id');">&nbsp;&nbsp;&nbsp;&nbsp; -->
                            <div class="col-sm-4" id="sixthPrizeLabel_id">
                                <label for="">Prize Label</label>
                                <input type="text" name="prize_label[sixth_prize]" value="<?php if(isset($_POST['prize_label']['sixth_prize'])) echo $_POST['prize_label']['sixth_prize']; else { echo $label_prize['sixth_prize']; } ?>">
                            </div>
                            <div class="col-sm-4" id="sixthPrizeImage_id">
                                <label for="sixth_prize_name">Browse...</label>
                                <button type="button" id="sixth_prize_name" class="browseBtn_hwe"><?php if($num_row > 0) { echo $prizeImg['sixth_prize']; } else{ echo "No Files Selected."; } ?></button>
                                <input type="file" name="prize[sixth_prize]" id="sixth_prizeImage" onchange="set_Prizeimage(this, 'sixth_prize_name');" class="form-control" style="display: none;">
                            </div>
                            <div class="col-sm-3">
                                <label for="">Sixth Prize Link</label>
                                <input type="text" name="prizelink[sxthPrize_link]" id="" value="<?php if( isset($_POST['prizelink']['sxthPrize_link']) ) { echo $_POST['prizelink']['sxthPrize_link']; } else { echo $prizeLink['sxthPrize_link']; } ?>" />
                            </div>
                            <div style="display: flex;margin-left: 2%;" class="col-sm-3">
                                <label for="" style="margin-right: 10%;">Probability</label>
                                <input type="number" name="prize_probalty[sixth_prizeProblty]" value="<?php if(isset($_POST['prize_probalty']['sixth_prizeProblty'])) { echo $_POST['prize_probalty']['sixth_prizeProblty']; } else if($num_row > 0) { echo $prize_problty['sixth_prizeProblty']; } ?>" class="form-control">
                            </div>
                            <div style="display: flex;margin-left: 2%;" class="col-sm-3">
                                <label for="" style="margin-right: 10%;">Select Prize</label>
                                <select name="prize_value[sixth_prize_value]" id="">
                                    <option value="no win" <?php if($_POST['prize_value']['sixth_prize_value'] == 'no win' || $prize_winning['sixth_prize_value'] == 'no win') echo 'selected'; ?>>No Win</option>
                                    <option value="prize" <?php if($_POST['prize_value']['sixth_prize_value'] == 'prize' || $prize_winning['sixth_prize_value'] == 'prize') echo 'selected'; ?>>Prize</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group setPrize_class" style="margin-top: 20px;">
                            <label for="" class="col-sm-3">Wining Prize Text</label>
                            <div class="col-sm-8">
                                <input type="text" name="wining_prize_text" id="" value="<?php if(isset($_POST['wining_prize_text'])) echo $_POST['wining_prize_text']; else echo $resultRow['win_prize_text']; ?>" style="width: 100%;">
                            </div>
                        </div>
                        <input type="submit" value="Submit" name="prize_porbltySubmit" id="prize_porbltySubmit">
                    </form>
                </div>
            </div>
            </div>
        </div>
    </div>
    </main>
</body>

<script>
var $ = jQuery;
    function showlabelPrize(telem, labelElement, fileElement){

        var $ = jQuery;
        if($(telem).is(":checked")){
            $(telem).val(1);
            $("#"+fileElement).hide();
            $("#"+labelElement).show();
        } else{
            $(telem).val(0);
            $("#"+labelElement).hide();
            $("#"+fileElement).show();
        }
    }
    function set_Prizeimage(t, buttonText){
        var $ = jQuery;
        $("#"+buttonText).text(t.files[0].name);
    }

    $(document).ready(function(){
        var $ = jQuery;
        $("#first_prize_name").on('click', function(){
            $("#first_prizeImage").trigger('click');
        });
        $("#second_prize_name").on('click', function(){
            $("#second_prizeImage").trigger('click');
        });
        $("#third_prize_name").on('click', function(){
            $("#third_prizeImage").trigger('click');
        });
        $("#fourth_prize_name").on('click', function(){
            $("#fourth_prizeImage").trigger('click');
        });
        $("#fifth_prize_name").on('click', function(){
            $("#fifth_prizeImage").trigger('click');
        });
        $("#sixth_prize_name").on('click', function(){
            $("#sixth_prizeImage").trigger('click');
        });
    });
    
</script>