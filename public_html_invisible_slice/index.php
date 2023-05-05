<?php
session_start();
include 'config.php';

if(!isset($_SESSION['admin_user_id']))
{

?>
<script>
window.location.href=' <?php echo Site_URL; ?>/login.php';
</script>
<?php
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" />
    <title><?php echo $site_title_hwe; ?></title>

    <meta name="description" content="" data-type="admin" />
    <meta name="keywords" content="html5 game, lucky wheek, wheel of fortune" data-type="admin" />
    <meta name="author" content="Gafami">
    <meta property="fb:app_id" content="1701132369920968" data-type="admin" />
    <meta property="og:url" content="" data-type="admin" />
    <meta property="og:type" content="Website" data-type="admin" />
    <meta property="og:title" content="<?php echo $site_title_hwe; ?>" data-type="admin" />
    <meta property="og:description" content="<?php echo $site_description; ?>" data-type="admin" />
    <meta property="og:image" content="https://www.iomgame.com/wheel_of_fortune/screenshot.png" data-type="admin" />
    <?php echo $header_script_tag; ?>
    
    <link rel="stylesheet" href="css/bootstrap4.css" data-type="admin" />
    <link rel='stylesheet' href='css/spectrum.min.css' data-type="admin" />
    <link rel="stylesheet" href="css/swiper.min.css" data-type="admin" id="swiper-style">
    <link rel="stylesheet" href="css/global.css" />
    <link rel="stylesheet" href="css/admin.css" data-type="admin" />
    <link rel="icon" href="img/brand.png" type="image/png">
   
    <link rel="stylesheet" type="text/css"
    href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700" />
  <!-- Nucleo Icons -->
  <link href=".../assets/css/nucleo-icons.css" rel="stylesheet" />
  <link href=".../assets/css/nucleo-svg.css" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <!-- Material Icons -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
  <!-- CSS Files -->
  <link id="pagestyle" href=".../assets/css/material-dashboard.css?v=3.0.0" rel="stylesheet" />

</head>

<?php
	

// Compress image////////////////////
class Image_converter{
    public function upload_image($files,$i,$target_dir){

        $get_host = $_SERVER['HTTP_HOST'];
      
        $target_dir = $target_dir;
        $imageTemp_name = $files['slice'.$i]['tmp_name'];
        $base_name = basename($files["slice".$i]["name"]);
        $imageFileType = $this->get_image_type($base_name);
        $new_name = $this->get_dynamic_name($base_name, $imageFileType);
        $target_file = $target_dir .$get_host.$i.'.png';;
        $validate = $this->validate_image($files["slice".$i]["tmp_name"]);
        
        if(!$validate){
            echo "Doesn't seem like an image file :(";
            return false;
        }
        
        $file_size = $this->check_file_size($files["slice".$i]["size"], 1000000);
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
        if($this->scale_image(10,$old_image, $width, $height, $target_file)){

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
        // $new_width = ($width - 10) * $scale/100;
        // $new_height = ($height - 10) * $scale/100;

        $new_width = $width;
        $new_height = $height;
 
        
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

///////////////////////
function compress($source, $destination, $quality) {

    $info = getimagesize($source);

    if ($info['mime'] == 'image/jpeg') 
        $image = imagecreatefromjpeg($source);

    elseif ($info['mime'] == 'image/gif') 
        $image = imagecreatefromgif($source);

    elseif ($info['mime'] == 'image/png') 
        $image = imagecreatefrompng($source);

    imagejpeg($image, $destination, $quality);

    return $destination;
}
$select_wheel_data_hwe ="SELECT * from ".$table_prefix."wheel_data";
$row_wheel_data_hwe = $conn->query($select_wheel_data_hwe);

while($result_wheel_data_hwe = mysqli_fetch_assoc($row_wheel_data_hwe))
{
    $wheel_data = json_decode($result_wheel_data_hwe['spin_data'],true);

}
if(isset($_POST['save_data']))
{

       // $total_slices_save = $_POST['slice'];
        $server_host_name = $_SERVER['HTTP_HOST'];
        

        $total_slices_save = $_POST['slice'];


        for($i =0; $i <$total_slices_save; $i++ )
        {
            $_POST['prize'.$i] = urlencode(nl2br($_POST['prize'.$i]));
        
        }

        $_POST['home_menu_text']= urlencode(nl2br($_POST['home_menu_text']));
        $_POST['share_menu_text']= urlencode(nl2br($_POST['share_menu_text']));
        $_POST['message_menu_text']= urlencode(nl2br($_POST['message_menu_text']));
        $_POST['account_menu_text']= urlencode(nl2br($_POST['account_menu_text']));
    
        $_POST['logout_side_menu']= urlencode(nl2br($_POST['logout_side_menu']));
        $_POST['share_menu_sidebar_text']= urlencode(nl2br($_POST['share_menu_sidebar_text']));
        $_POST['message_menu_sidebar_text']= urlencode(nl2br($_POST['message_menu_sidebar_text']));
        $_POST['account_menu_sidebar_text']= urlencode(nl2br($_POST['account_menu_sidebar_text']));

        $_POST['user_id_label']= urlencode(nl2br($_POST['user_id_label']));
        $_POST['remaining_spin_label']= urlencode(nl2br($_POST['remaining_spin_label']));
        $_POST['earned_points_label']= urlencode(nl2br($_POST['earned_points_label']));
        $_POST['uuid_label']= urlencode(nl2br($_POST['uuid_label']));

        $select_menu ="SELECT * from ".$table_prefix."wheel_data";
        $row_menu = $conn->query($select_menu);
        $result_menu = mysqli_fetch_assoc($row_menu);
        $result_data_menu = json_decode($result_menu['spin_data'],true);


        if(isset($_FILES['home_menu_image']['name']) && $_FILES['home_menu_image']['name'] !='')
        {
    
            $file_home_menu_image = $_FILES['home_menu_image']['name'];
            $file_home_menu_image_tmp_name = $_FILES['home_menu_image']['tmp_name'];
        
            move_uploaded_file($file_home_menu_image_tmp_name,'img/'.$host_name.$file_home_menu_image);
    
            $_POST['home_menu_image'] = 'img/'.$host_name.$file_home_menu_image;
        }
        else
        {
            $file_home_menu_image =$result_data_menu['home_menu_image'];
            $_POST['home_menu_image'] = $file_home_menu_image;
        }

        if(isset($_FILES['share_menu_image']['name']) && $_FILES['share_menu_image']['name'] !='')
        {
    
            $file_share_menu_image = $_FILES['share_menu_image']['name'];
            $file_share_menu_image_tmp_name = $_FILES['share_menu_image']['tmp_name'];
        
            move_uploaded_file($file_share_menu_image_tmp_name,'img/'.$host_name.$file_share_menu_image);
    
            $_POST['share_menu_image'] = 'img/'.$host_name.$file_share_menu_image;
        }
        else
        {
            $file_share_menu_image =$result_data_menu['share_menu_image'];
            $_POST['share_menu_image'] = $file_share_menu_image;
        }

        if(isset($_FILES['message_menu_image']['name']) && $_FILES['message_menu_image']['name'] !='')
        {
    
            $file_message_menu_image = $_FILES['message_menu_image']['name'];
            $file_message_menu_image_tmp_name = $_FILES['message_menu_image']['tmp_name'];
        
            move_uploaded_file($file_message_menu_image_tmp_name,'img/'.$host_name.$file_message_menu_image);
    
            $_POST['message_menu_image'] = 'img/'.$host_name.$file_message_menu_image;
        }
        else
        {
            $file_message_menu_image =$result_data_menu['message_menu_image'];
            $_POST['message_menu_image'] = $file_message_menu_image;
        }

        if(isset($_FILES['account_menu_image']['name']) && $_FILES['account_menu_image']['name'] !='')
        {
    
            $file_account_menu_image = $_FILES['account_menu_image']['name'];
            $file_account_menu_image_tmp_name = $_FILES['account_menu_image']['tmp_name'];
        
            move_uploaded_file($file_account_menu_image_tmp_name,'img/'.$host_name.$file_account_menu_image);
    
            $_POST['account_menu_image'] = 'img/'.$host_name.$file_account_menu_image;
        }
        else
        {
            $file_account_menu_image =$result_data_menu['account_menu_image'];
            $_POST['account_menu_image'] = $file_account_menu_image;
        }



         for($i =0; $i <$total_slices_save; $i++ )
        {
            if($_POST['probability'.$i] != '')
            {
                $probability_hwe = $_POST['probability'.$i];
            }
            else
            {
                $probability_hwe =0;
            }
            $_POST['probability'.$i] = $probability_hwe;
        
        }

        if($second_layout_sp == '1' || $fourth_layout_sp == '1')
        {

            if($_POST['wallpaper-config'] == '9')
            {
                
                if(isset($_FILES['live_wallpaper_img']['name']) && $_FILES['live_wallpaper_img']['name'] !='')
                {
            
                   

                    $get_host_hwe1 = $_SERVER['HTTP_HOST'];
                    $file_selector1 = $_FILES['live_wallpaper_img']['name'];
                    $file_selector_tmp_name1 = $_FILES['live_wallpaper_img']['tmp_name'];
                
                        // Compress Image
                 
                    //$compressed = compress($file_selector_tmp_name1, 'img/'.$get_host_hwe1.$file_selector1, 30);
                    move_uploaded_file($file_selector_tmp_name1,'img/'.$get_host_hwe1.$file_selector1);
                   
            
                    $_POST['live_wallpaper_img'] = 'img/'.$get_host_hwe1.$file_selector1;
                }
                else
                {

                    $select3 ="SELECT * from ".$table_prefix."wheel_data";
                    $row3 = $conn->query($select3);
                    
                    while($result3 = mysqli_fetch_assoc($row3))
                    {
                        $spin_data2 = json_decode($result3['spin_data'],true);

                        //$compressed = compress($spin_data2['live_wallpaper_img'], $spin_data2['live_wallpaper_img'], 90);
                        $_POST['live_wallpaper_img'] = $spin_data2['live_wallpaper_img'];
                    }
                }

                if(isset($_FILES['live_wallpaper_img_mobile_size']['name']) && $_FILES['live_wallpaper_img_mobile_size']['name'] !='')
                {
        
                   
                    $get_host_hwe1 = $_SERVER['HTTP_HOST'];
                    $file_selector2_hwe = $_FILES['live_wallpaper_img_mobile_size']['name'];
                    $file_selector_tmp_name2_hwe = $_FILES['live_wallpaper_img_mobile_size']['tmp_name'];
                
                        // Compress Image
                   
                   // $compressed2 = compress($file_selector_tmp_name2_hwe, 'img/'.$get_host_hwe1.$file_selector2_hwe, 30);
                    move_uploaded_file($file_selector_tmp_name2_hwe,'img/'.$get_host_hwe1.$file_selector2_hwe);
               
                    $_POST['live_wallpaper_img_mobile_size'] = 'img/'.$get_host_hwe1.$file_selector2_hwe;
                }
                else
                {

                    $select3 ="SELECT * from ".$table_prefix."wheel_data";
                    $row3 = $conn->query($select3);
                    
                    while($result3 = mysqli_fetch_assoc($row3))
                    {
                        $spin_data2 = json_decode($result3['spin_data'],true);
                        if(isset($spin_data2['live_wallpaper_img_mobile_size']))
                        {
                            //$compressed2 = compress($spin_data2['live_wallpaper_img_mobile_size'], $spin_data2['live_wallpaper_img_mobile_size'], 90);
                            $_POST['live_wallpaper_img_mobile_size'] = $spin_data2['live_wallpaper_img_mobile_size'];
                        }
                        
                    }
                }

            }

            if(isset($_FILES['site_logo_hwe']['name']) && $_FILES['site_logo_hwe']['name'] !='')
            {
        
                $get_host_hwe1 = $_SERVER['HTTP_HOST'];
                $site_logo_hwe1 = $_FILES['site_logo_hwe']['name'];
                $file_selector_tmp_name2 = $_FILES['site_logo_hwe']['tmp_name'];

            
                move_uploaded_file($file_selector_tmp_name2,'img/'.$get_host_hwe1.$site_logo_hwe1);
            
                $_POST['site_logo_hwe'] = 'img/'.$get_host_hwe1.$site_logo_hwe1;
            }
            else
            {

                $select3 ="SELECT * from ".$table_prefix."wheel_data";
                $row3 = $conn->query($select3);
                
                while($result3 = mysqli_fetch_assoc($row3))
                {
                    $spin_data2 = json_decode($result3['spin_data'],true);
                
                    $_POST['site_logo_hwe'] = $spin_data2['site_logo_hwe'];
                }
            }

            if(isset($_FILES['reward_icon_change']['name']) && $_FILES['reward_icon_change']['name'] !='')
            {
        
                $get_host_hwe1 = $_SERVER['HTTP_HOST'];
                $site_logo_hwe4 = $_FILES['reward_icon_change']['name'];
                $file_selector_tmp_name4 = $_FILES['reward_icon_change']['tmp_name'];

            
                move_uploaded_file($file_selector_tmp_name4,'img/'.$get_host_hwe1.$site_logo_hwe4);
            
                $_POST['reward_icon_change'] = 'img/'.$get_host_hwe1.$site_logo_hwe4;
            }
            else
            {

                $select3 ="SELECT * from ".$table_prefix."wheel_data";
                $row3 = $conn->query($select3);
                
                while($result3 = mysqli_fetch_assoc($row3))
                {
                    $spin_data2 = json_decode($result3['spin_data'],true);
                
                    $_POST['reward_icon_change'] = $spin_data2['reward_icon_change'];
                }
            }

            if(isset($_FILES['reward_list_bg_upload']['name']) && $_FILES['reward_list_bg_upload']['name'] !='')
            {
        
                $get_host_hwe1 = $_SERVER['HTTP_HOST'];
                $site_logo_hwe5 = $_FILES['reward_list_bg_upload']['name'];
                $file_selector_tmp_name5 = $_FILES['reward_list_bg_upload']['tmp_name'];

            
                move_uploaded_file($file_selector_tmp_name5,'img/'.$get_host_hwe1.$site_logo_hwe5);
            
                $_POST['reward_list_bg_upload'] = 'img/'.$get_host_hwe1.$site_logo_hwe5;
            }
            else
            {

                $select3 ="SELECT * from ".$table_prefix."wheel_data";
                $row3 = $conn->query($select3);
                
                while($result3 = mysqli_fetch_assoc($row3))
                {
                    $spin_data2 = json_decode($result3['spin_data'],true);
                
                    $_POST['reward_list_bg_upload'] = $spin_data2['reward_list_bg_upload'];
                }
            }

        }

        if(isset($_FILES['invisible_slice_image']['name']) && $_FILES['invisible_slice_image']['name'] !='')
        {
    
            $invisible_slice_image_name = $_FILES['invisible_slice_image']['name'];
            $invisible_slice_image_tmp_name = $_FILES['invisible_slice_image']['tmp_name'];
            $timestamp = time();

            move_uploaded_file($invisible_slice_image_tmp_name,'img/'.$server_host_name.$timestamp.$invisible_slice_image_name);
        
            $_POST['invisible_slice_image'] = 'img/'.$server_host_name.$timestamp.$invisible_slice_image_name;
        }
        else
        {
            $_POST['invisible_slice_image'] = $wheel_data['invisible_slice_image'];
            
        }

        $slice_hwe =array();

        $total_slices_count =$_POST['slice'];
        for($i=0; $i<$total_slices_count; $i++)
        {
            if(isset($_FILES['slice'.$i]['name']) && $_FILES['slice'.$i]['name'] !='')
            {
                
                $get_host = $_SERVER['HTTP_HOST'];
                $slice0 = $_FILES['slice'.$i]['name'];
                $slice0_tmpname = $_FILES['slice'.$i]['tmp_name'];
                $image_name = $get_host.$i.'.png';
                $slice_hwe[$get_host.$i] = 'img/'.$image_name;
                
              
                $objupload = new Image_converter();
                $objupload->upload_image($_FILES,$i,'img/');
              
            }
        }

        $count_key = 0;
        foreach($_FILES['banner_image']['name'] as $name_data)
        {            
            if(isset($_FILES['banner_image']['name'][$count_key]) && $_FILES['banner_image']['name'][$count_key] !='')
            {            
                $image = $_FILES["banner_image"]["name"][$count_key];
                $temp=$_FILES["banner_image"]["tmp_name"][$count_key];

                $get_host = $_SERVER['HTTP_HOST'];

                $folder="img/".$get_host.$image;
                move_uploaded_file($temp,$folder);
                
              
                $sql="insert into ".$table_prefix."banner_add SET banner_image='".$folder."'";
                
                    mysqli_query($conn,$sql);

                //}
            }

            $count_key++;
        }



        if(isset($_FILES['file-selector']['name']) && $_FILES['file-selector']['name'] !='')
        {
            $get_host_hwe = $_SERVER['HTTP_HOST'];
            $file_selector = $_FILES['file-selector']['name'];
            $file_selector_tmp_name = $_FILES['file-selector']['tmp_name'];
            
            move_uploaded_file($file_selector_tmp_name,'img/'.$get_host_hwe.'brand.png');

            $spin_logo = ",spin_logo_image='img/'.$get_host_hwe.'brand.png'";
        }

        $encode_slice_image = json_encode($slice_hwe);

        

        $encode_send_wheel_data  =json_encode($_POST);

        $select ="SELECT * from ".$table_prefix."wheel_data";
        $row = $conn->query($select);
        $count  = mysqli_num_rows($row);
        if($count > 0)
        {
            $update ="UPDATE ".$table_prefix."wheel_data SET
                spin_data = '".$encode_send_wheel_data."',spin_slice_data ='".$encode_slice_image.$spin_logo."' WHERE id='1'
                "; 

            mysqli_query($conn,$update);

        }
        else
        {
            $insert ="INSERT into ".$table_prefix."wheel_data SET
            spin_data = '".$encode_send_wheel_data."',spin_slice_data ='".$encode_slice_image.$spin_logo."'"; 
            mysqli_query($conn,$insert);
        }

    
}

?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
    jQuery(document).ready(function(){

            jQuery("body").delegate(".alert_box_negative_value_check","keyup",function(){

            var get_value_probe_neg = jQuery(this).val();

            if(get_value_probe_neg < 0)
            {
                alert("Can not set probability value negative.It will occurs error when save data.");
            }

            });

            setTimeout(function(){

                jQuery.ajax({
                type: "POST",
                url: "send_ajax_data.php",
              
                data: { 
                    get_probability_value : 'get_probability_value'
                     
                },
                success:function(data)
                {
                    //console.log(data);
                    var json_obj = jQuery.parseJSON(data);
                   
                    for($i=0; $i < json_obj.length; $i++)
                    {
                        jQuery(".probability"+$i).val("");
                        jQuery(".probability"+$i).val(json_obj[$i].probability);
                       // alert(json_obj[$i].probability);
                    }
                    //jQuery("#slices_probability").html("");
                    //jQuery("#slices_probability").html(data);

                    

                }
            });

            jQuery.ajax({
                type: "POST",
                url: "send_ajax_data.php",
              
                data: { 
                    get_reward_data_list : 'get_reward_data_list'
                     
                },
                success:function(data)
                {
                    //console.log(data);
                    var json_obj = jQuery.parseJSON(data);
                   
                    for($i=0; $i < json_obj.length; $i++)
                    {
                        jQuery("#prize"+$i).val("");
                        jQuery("#prize"+$i).val(json_obj[$i].prize);
                        // jQuery("#prize"+$i).attr("value",json_obj[$i].prize);
                        jQuery("#prize"+$i).html("");
                        jQuery("#prize"+$i).html(json_obj[$i].prize);
                      //  alert(json_obj[$i].prize);
                       // alert(json_obj[$i].probability);
                    }
                    //jQuery("#slices_probability").html("");
                    //jQuery("#slices_probability").html(data);

                    

                }
            });


            jQuery.ajax({
                type: "POST",
                url: "send_ajax_data.php",
              
                data: { 
                    get_set_prize_for_once_day : 'get_set_prize_for_once_day'
                     
                },
                success:function(data)
                {
                    //console.log(data);
                    var json_obj = jQuery.parseJSON(data);
                   
                    for($i=0; $i < json_obj.length; $i++)
                    {
                        jQuery("#no_matter_probability"+$i).removeAttr("checked");
                        if(json_obj[$i].no_matter_probability == 1)
                        {
                            jQuery("#no_matter_probability"+$i).attr("checked","checked");
                        }
                       
                       // alert(json_obj[$i].probability);
                    }
                    //jQuery("#slices_probability").html("");
                    //jQuery("#slices_probability").html(data);

                    

                }
            });


            jQuery.ajax({
                type: "POST",
                url: "send_ajax_data.php",
              
                data: { 
                    lucky_number_checkbox : 'lucky_number_checkbox'
                     
                },
                success:function(data)
                {
                  
                    //console.log(data);
                    var json_obj = jQuery.parseJSON(data);
                   
                    for($i=0; $i < json_obj.length; $i++)
                    {
                        jQuery("#lucky_number_checkbox_"+$i).removeAttr("checked");
                        if(json_obj[$i].lucky_number_checkbox == 1)
                        {
                            jQuery("#lucky_number_checkbox_"+$i).attr("checked","checked");
                        }
                       
                       // alert(json_obj[$i].probability);
                    }
                    //jQuery("#slices_probability").html("");
                    //jQuery("#slices_probability").html(data);

                    

                }
            });
            
            
            jQuery.ajax({
                type: "POST",
                url: "send_ajax_data.php",
              
                data: { 
                    reward_labal_image_checkbox : 'reward_labal_image_checkbox'
                     
                },
                success:function(data)
                {
                    //console.log(data);
                    var json_obj = jQuery.parseJSON(data);
                   
                    for($i=0; $i < json_obj.length; $i++)
                    {
                        jQuery("#no_matter_labal_image_hideshow"+$i).removeAttr("checked");
                        if(json_obj[$i].no_matter_labal_image_hideshow == 1)
                        {
                            jQuery("#no_matter_labal_image_hideshow"+$i).attr("checked","checked");
                        }
                       
                       // alert(json_obj[$i].probability);
                    }
                }
            });

            jQuery.ajax({
                type: "POST",
                url: "send_ajax_data.php",
              
                data: { 
                    slice_color_hwe : 'slice_color_hwe'
                     
                },
                success:function(data)
                {
                    //console.log(data);
                    var json_obj = jQuery.parseJSON(data);
                   
                    for($i=0; $i < json_obj.length; $i++)
                    {
                     //   jQuery("#slice_color_"+$i).removeAttr("checked");
                        // if(json_obj[$i].slice_colorhwe == 1)
                        // {
                            jQuery("#slice_color_"+$i).attr("value",json_obj[$i].slice_colorhwe);
                        //}
                       
                       // alert(json_obj[$i].probability);
                    }
                }
            });

            jQuery.ajax({
                type: "POST",
                url: "send_ajax_data.php",
              
                data: { 
                    slice_color_checkbox : 'slice_color_checkbox'
                     
                },
                success:function(data)
                {
                    //console.log(data);
                    var json_obj = jQuery.parseJSON(data);
                   
                    for($i=0; $i < json_obj.length; $i++)
                    {
                        jQuery("#slice_color_checkbox_"+$i).removeAttr("checked");
                        if(json_obj[$i].slice_color_checkbox == 1)
                        {
                            jQuery("#slice_color_checkbox_"+$i).attr("checked","checked");
                        }
                       
                       // alert(json_obj[$i].probability);
                    }
                }
            });

            //slice text color ajax
            jQuery.ajax({
                type: "POST",
                url: "send_ajax_data.php",
              
                data: { 
                    slice_text_color_hwe : 'slice_text_color_hwe'
                     
                },
                success:function(data)
                {
                   
                    var json_obj = jQuery.parseJSON(data);
                   
                    for($i=0; $i < json_obj.length; $i++)
                    {
                        jQuery("#slice_text_color_"+$i).attr("value",json_obj[$i].slice_text_colorhwe);
                       
                    }
                }
            });

             //end slice text color ajax

            //slice text color checkbox ajax
            jQuery.ajax({
                type: "POST",
                url: "send_ajax_data.php",
              
                data: { 
                    slice_text_color_checkbox : 'slice_text_color_checkbox'
                     
                },
                success:function(data)
                {
                    
                    var json_obj = jQuery.parseJSON(data);
                   
                    for($i=0; $i < json_obj.length; $i++)
                    {
                        jQuery("#slice_text_color_checkbox_"+$i).removeAttr("checked");
                        if(json_obj[$i].slice_text_color_checkbox == 1)
                        {
                            jQuery("#slice_text_color_checkbox_"+$i).attr("checked","checked");
                        }
                       
                    }
                }
            });

            //end slice text color checkbox ajax
            
            
            jQuery.ajax({
                type: "POST",
                url: "send_ajax_data.php",
              
                data: { 
                    reward_redirect_link_redeem_div : 'reward_redirect_link_redeem_div'
                },
                success:function(data)
                {
                    //console.log(data);
                    var json_obj = jQuery.parseJSON(data);
                    
                    for($i=0; $i < json_obj.length; $i++)
                    {
                        jQuery("#reward_redirect_link_redeem"+$i).val("");
                        jQuery("#reward_redirect_link_redeem"+$i).val(json_obj[$i].reward_redirect_link_redeem);
                    }
                }
            });
            
            
            jQuery.ajax({
                type: "POST",
                url: "send_ajax_data.php",
              
                data: { 
                    reward_redirect_link_redeem_set_onoff : 'reward_redirect_link_redeem_set_onoff'
                },
                success:function(data)
                {
                    //console.log(data);
                    var json_obj = jQuery.parseJSON(data);
                   
                    for($i=0; $i < json_obj.length; $i++)
                    {
                        jQuery("#no_matter_reward_redirect_link_redeem"+$i).removeAttr("checked");
                        if(json_obj[$i].no_matter_reward_redirect_link_redeem == 1)
                        {
                            jQuery("#no_matter_reward_redirect_link_redeem"+$i).attr("checked","checked");
                        }
                       
                       // alert(json_obj[$i].probability);
                    }
                }
            });

            // jQuery.ajax({
            //     type: "POST",
            //     url: "send_ajax_data.php",
              
            //     data: { 
            //         text_images_together : 'text_images_together'
            //     },
            //     success:function(data)
            //     {
            //         //console.log(data);
            //         var json_obj = jQuery.parseJSON(data);
                   
            //         for($i=0; $i < json_obj.length; $i++)
            //         {
            //             jQuery("#text_images_together"+$i).removeAttr("checked");
            //             if(json_obj[$i].text_images_together == 1)
            //             {
            //                 jQuery("#text_images_together"+$i).attr("checked","checked");
            //             }
                       
            //            // alert(json_obj[$i].probability);
            //         }
            //     }
            // });
            
            

            },2000);

          

        jQuery(".btn-save-email-config").on('click',function(event){

            event.preventDefault();

            var email_send =jQuery('#email-send').val(); 
            var password_email_send =jQuery('#password-email-send').val(); 
            var email_receive =jQuery('#email-receive').val(); 

            jQuery.ajax({
				type: "POST",
				url: "send_ajax_data.php",
				data: { 
                    save_email_config_popup : 'save_email_config_popup',
                    email_send : email_send,
                    password_email_send : password_email_send,
                    email_receive : email_receive
						
				},
                success:function(data)
                {
                   
                }
			});
            
        });

        jQuery(".btn-save-countdown-timer").on('click',function(event){

            event.preventDefault();

            var countdown_number =jQuery('#countdown_number').val(); 
            var countdown_remain_hour =jQuery('#countdown_remain_hour').val(); 


            jQuery.ajax({
                type: "POST",
                url: "send_ajax_data.php",
                data: { 
                    btn_save_countdown_time : 'btn-save-countdown-time',
                    countdown_number : countdown_number,
                    countdown_remain_hour : countdown_remain_hour
                
                        
                },
                success:function(data)
                {
                
                }
            });

        });

        jQuery(".customer_email_save").on('click',function(event){

        event.preventDefault();

        var customer_email =jQuery('#customer-email').val(); 
        


            jQuery.ajax({
                type: "POST",
                url: "send_ajax_data.php",
                data: { 
                    customer_email_save : 'customer_email_save',
                    customer_email : customer_email
                
                
                        
                },
                success:function(data)
                {
                
                }
            });

        });

        jQuery(".access_key_save").on('click',function(event){

        event.preventDefault();

        var access_key_save =jQuery('#access_key_save').val(); 



            jQuery.ajax({
                type: "POST",
                url: "send_ajax_data.php",
                data: { 
                    access_key_save : 'access_key_save',
                    access_key_save : access_key_save
                
                
                        
                },
                success:function(data)
                {
                
                }
            });

        });
        
    });


    jQuery(document).ready(function(){

        jQuery("#wallpaper-config").on("change",function(){
           
            var get_live_wallpaer = jQuery(this).val();

           
            if(get_live_wallpaer == 9)
            {
                jQuery("#live_wallpaper_img").parent().attr("style","display:block;");
                jQuery("#live_wallpaper_img_mobile_size").parent().attr("style","display:block;")
            }
            else
            {
                jQuery("#live_wallpaper_img").parent().attr("style","display:none;");
                jQuery("#live_wallpaper_img_mobile_size").parent().attr("style","display:none;");
            }
    
        });

        jQuery("#slider_banner").on("change",function(){
           
           var get_banner_confirm = jQuery(this).val();

          
           if(get_banner_confirm == 1)
           {
                 jQuery(".banner_image").attr("style","display:block;");
                
           }
           else
           {
               jQuery(".banner_image").attr("style","display:none;");
              
           }
   
       });

       jQuery("#check_banner_list").on("click",function(){
           
           var get_banner_confirm = jQuery(this).val();

                 jQuery("#popup_banner_images").attr("style","display:block;");
                 jQuery("#popup_banner_images").removeClass("hide");
          
           
   
       });

       jQuery("#hide_banner").on("click",function(){
           
           var get_banner_confirm = jQuery(this).val();

          
               jQuery("#popup_banner_images").attr("style","display:none;");
               jQuery("#popup_banner_images").addClass("hide");
           
   
       });


       
       jQuery("body").delegate(".add_alert_box_for_pro","keyup change",function(){
            var this_box_value_hwe = jQuery(this).val();
            var sum = 0;
            jQuery( ".add_alert_box_for_pro" ).each(function( index ) {                
                
                var pro_value = jQuery(this).val();
            
                if(pro_value == NaN || pro_value == '')
                {
                    pro_value =0;
                }        
                sum = parseInt(sum) + parseInt(pro_value);
            });

            if(parseInt(sum) > 100 )
            {
                var this_box_value_hwe_update = parseInt(this_box_value_hwe)-1;
                jQuery(this).val(this_box_value_hwe_update);
                jQuery(".set_box_alert_pro").val("");
                jQuery(".set_box_alert_pro").val(sum)
                alert("Probability Must be 100%");
                return false;
            }    
       });


        
    });

</script>

<?php

$select ="SELECT * from ".$table_prefix."wheel_data";
$row = $conn->query($select);

while($result = mysqli_fetch_assoc($row))
{
    $spin_result_hwe = $result['spin_data'];
    $access_key_save_hwe = $result['access_key_save'];
    $save_email_config_popup_hwe =$result['save_email_config_popup'];
    $save_countdown_hwe= $result['save_countdown'];
    $spin_data = json_decode($spin_result_hwe,true);

//    print_r($result['spin_data']);
//    die("mohit");
    $access_key_save = json_decode($access_key_save_hwe,true);
    $customer_email_save = json_decode($result['customer_email_save'],true);
    $save_email_config_popup = json_decode($save_email_config_popup_hwe,true);
    $save_countdown = json_decode($save_countdown_hwe,true);

    $total_slices_hwe = $spin_data['slice'];

    $reward_list_effect=0;
    $live_chat_menu_url="";
    if(isset($spin_data['reward_list_effect']))
    {
        $reward_list_effect = $spin_data['reward_list_effect'];
    }

    if(isset($spin_data['live_chat_menu_url']))
    {
        $live_chat_menu_url = $spin_data['live_chat_menu_url'];
    }

    $home_menu_url= "";
    if(isset($spin_data['home_menu_url']))
    {
        $home_menu_url = $spin_data['home_menu_url'];
    }
    $share_menu_url= "";
    if(isset($spin_data['share_menu_url']))
    {
        $share_menu_url = $spin_data['share_menu_url'];
    }
    $account_menu_url= "";
    if(isset($spin_data['account_menu_url']))
    {
        $account_menu_url = $spin_data['account_menu_url'];
    }
   


    $redeem_button_hide_show= $spin_data['redeem_button_hide_show'];

    $home_menu_text= str_replace('<br />','',urldecode($spin_data['home_menu_text']));
    $share_menu_text= str_replace('<br />','',urldecode($spin_data['share_menu_text']));
    $message_menu_text= str_replace('<br />','',urldecode($spin_data['message_menu_text']));
    $account_menu_text= str_replace('<br />','',urldecode($spin_data['account_menu_text']));

    $logout_side_menu=str_replace('<br />','',urldecode($spin_data['logout_side_menu']));
    $share_menu_sidebar_text= str_replace('<br />','',urldecode($spin_data['share_menu_sidebar_text']));
    $message_menu_sidebar_text= str_replace('<br />','',urldecode($spin_data['message_menu_sidebar_text']));
    $account_menu_sidebar_text= str_replace('<br />','',urldecode($spin_data['account_menu_sidebar_text']));

    $user_id_label=str_replace('<br />','',urldecode($spin_data['user_id_label']));
    $remaining_spin_label= str_replace('<br />','',urldecode($spin_data['remaining_spin_label']));
    $earned_points_label= str_replace('<br />','',urldecode($spin_data['earned_points_label']));
    $uuid_label= str_replace('<br />','',urldecode($spin_data['uuid_label']));

    $bottom_menu_bg_color='';
    $side_menu_bg_color='';
    if(isset($spin_data['bottom_menu_bg_color']))
    {
        $bottom_menu_bg_color= $spin_data['bottom_menu_bg_color'];
    }

    if(isset($spin_data['side_menu_bg_color']))
    {
        $side_menu_bg_color= $spin_data['side_menu_bg_color'];
    }

    $select_bottom_bg_menu_option=0;
    if(isset($spin_data['select_bottom_bg_menu_option']))
    {
        $select_bottom_bg_menu_option= $spin_data['select_bottom_bg_menu_option'];
    }

    $select_side_bg_menu_option=0;
    if(isset($spin_data['select_side_bg_menu_option']))
    {
        $select_side_bg_menu_option= $spin_data['select_side_bg_menu_option'];
    }

    
    

    $home_menu_image = $spin_data['home_menu_image'];
    $home_menu_image_checkbox = $spin_data['home_menu_image_checkbox'];

    $share_menu_image = $spin_data['share_menu_image'];
    $share_menu_image_checkbox = $spin_data['share_menu_image_checkbox'];

    $message_menu_image = $spin_data['message_menu_image'];
    $message_menu_image_checkbox = $spin_data['message_menu_image_checkbox'];

    $account_menu_image = $spin_data['account_menu_image'];
    $account_menu_image_checkbox = $spin_data['account_menu_image_checkbox'];


// if(isset($spin_data['reward_list_bg_upload']))
// {
//     $reward_list_bg_upload = $spin_data['reward_list_bg_upload'];
// }
    
//     $reward_icon_change = $spin_data['reward_icon_change'];
  
    $footer_style_second_layout=0;
     if(isset($spin_data['footer_style_second_layout']))
     {
        $footer_style_second_layout = $spin_data['footer_style_second_layout'];
     }


    $wheel_border_olor='';
    $wheel_border_color_set=0;
    if(isset($spin_data['wheel_border_color_set']) && $spin_data['wheel_border_color_set'] == '1')
    {
        $wheel_border_color_set = $spin_data['wheel_border_color_set'];
        $wheel_border_olor = $spin_data['wheel_border_olor'];
        
    }

    $wheel_button_border_olor='';
    $wheel_border_button_color_set=0;
    if(isset($spin_data['wheel_border_button_color_set']) && $spin_data['wheel_border_button_color_set'] == '1')
    {
        $wheel_border_button_color_set = $spin_data['wheel_border_button_color_set'];
        $wheel_button_border_olor = $spin_data['wheel_button_border_olor'];
        
    }

    
    $maintenance_mode=0;
    if(isset($spin_data['maintenance_mode']))
    {
        $maintenance_mode = $spin_data['maintenance_mode'];
    }

    $redeem_button_text="";
    if(isset($spin_data['redeem_button_text']))
    {
        $redeem_button_text = $spin_data['redeem_button_text'];
    }
    
    $register_now = $spin_data['register_now'];

    $register_now_link='';
    if(isset($spin_data['register_now_link']))
    {
        $register_now_link = $spin_data['register_now_link'];
    }

    $register_now_text='';
    if(isset($spin_data['register_now_link']))
    {
        $register_now_text = $spin_data['register_now_text'];
    }

    
    if(isset($spin_data['reamin_spin_text_color']))
    {
        $reamin_spin_text_color = $spin_data['reamin_spin_text_color'];
    }
    
  
    $email_popup_config = $spin_data['email-popup-config'];
    if($email_popup_config == '1')
    {
        $email_popup_config_selected = 'selected';
    }
    else
    {
         $email_popup_config_selected = '';
    }
//die("fgdf");
    $live_wallpaper_img='';
    $wallpaper_config = $spin_data['wallpaper-config'];
    if(isset($spin_data['live_wallpaper_img']))
    {
        $live_wallpaper_img = $spin_data['live_wallpaper_img'];
    }
    
    $slider_banner = $spin_data['slider_banner'];

    if(isset($spin_data['no_matter_probability']) && $spin_data['no_matter_probability'] == 1)
    {
        $checked_probability = 'checked';
    }
    else{
        $checked_probability = '';
    }
    
    
    if($wallpaper_config == 1)
    {
        $wallpaper_config_selected = 'selected';
    }
    else
    {
        $wallpaper_config_selected = '';
    }

    $slice = $spin_data['slice'];
    if($slice == 1)
    {
        $slice_selected = 'selected';
    }
    else
    {
        $slice_selected = '';
    }

    $wheel_ux_config = $spin_data['wheel-ux-config'];
    if($wheel_ux_config == 1)
    {
        $wheel_ux_config_selected = 'selected';
    }
    else
    {
        $wheel_ux_config_selected = '';
    }

    $coundown_popup_config = $spin_data['coundown-popup-config'];
    if($coundown_popup_config == 1)
    {
        $coundown_popup_config_selected = 'selected';
    }
    else
    {
        $coundown_popup_config_selected = '';
    }

    $sound_config = $spin_data['sound-config'];
    if($sound_config == 1)
    {
        $sound_config_selected = 'selected';
    }
    else
    {
        $sound_config_selected = '';
    }

    $reward_popup_config = $spin_data['reward-popup-config'];
    if($reward_popup_config == 1)
    {
        $reward_popup_config_selected = 'selected';
    }
    else
    {
        $reward_popup_config_selected = '';
    }

    $login_popup_config=0;
    if(isset($spin_data['login-popup-config']))
    {
        $login_popup_config = $spin_data['login-popup-config'];
    }
    


    if($login_popup_config == 1)
    {
        $login_popup_config_selected = 'selected';
    }
    else
    {
        $login_popup_config_selected = '';
    }

    $graphic = $spin_data['graphic'];
    if($graphic == 1)
    {
        $graphic_selected = 'selected';
    }
    else
    {
        $graphic_selected = '';
    }

    if(isset($spin_data['file-selector']))
    {
        $file_selector = $spin_data['file-selector'];
    }
    
    $bg_color = $spin_data['bg_color'];

    $total_spin_show = $spin_data['total_spin_show'];
    
    $sound_config =$spin_data['sound-config'];
    
    
    /////////////////////
    ////spin_data images label
    $total_slices = $spin_data['slice'];
       
    $images_slice_data =array();
    for($i =0; $i <$total_slices; $i++ )
    {
        $images_slice_data[$i] = $spin_data['no_matter_labal_image_hideshow'.$i];
    }
    
    $no_matter_labal_image_hideshow = json_encode($images_slice_data);
    
    ////spin_data images label
    $labels_slice_data =array();
    $slice_color_set=array();
    $slice_color_set_array_checkbox=array();
    $slice_color_set_hwe='';
    $slice_color_set_array_checkbox_hwe='';

    $slice_text_color_set=array();
    $slice_text_color_set_array_checkbox=array();

    $slice_text_color_set_hwe='';
    $slice_text_color_set_array_checkbox_hwe='';

    for($i =0; $i <$total_slices; $i++ )
    {
        $labels_slice_data[$i] = str_replace('<br />','',urldecode($spin_data['prize'.$i]));
        $slice_color_set[$i] = $spin_data['slice_color_'.$i];
        $slice_color_set_array_checkbox[$i] = $spin_data['slice_color_checkbox_'.$i];

        $slice_text_color_set[$i] = $spin_data['slice_text_color_'.$i];
        $slice_text_color_set_array_checkbox[$i] = $spin_data['slice_text_color_checkbox_'.$i];
    }
    $get_labels_value_wheel_hwe = json_encode($labels_slice_data);
    $slice_color_set_hwe = json_encode($slice_color_set);
    $slice_color_set_array_checkbox_hwe = json_encode($slice_color_set_array_checkbox);

    $slice_text_color_set_hwe = json_encode($slice_text_color_set);
    $slice_text_color_set_array_checkbox_hwe = json_encode($slice_text_color_set_array_checkbox);
  
}
?>
<script>

    
 jQuery(document).ready(function(){
        
           setTimeout(function(){
              
                var get_total_slice = '<?php echo $total_slices_hwe;  ?>';
                jQuery("#slice").val(get_total_slice).trigger('change');
         
        
                var get_walpaper = '<?php echo $wallpaper_config;  ?>';
                jQuery("#wallpaper-config").val(get_walpaper).trigger('change');
          
                var wheel_ux_config = '<?php echo $wheel_ux_config;  ?>';
                jQuery("#wheel-ux-config").val(wheel_ux_config).trigger('change');
      
      
                var check_sound = '<?php echo $sound_config;  ?>';
                jQuery("#sound-config").val(check_sound).trigger('change');
           },1000);

        //    setTimeout(function(){
            
        //     var get_total_slice_hwe = '<?php echo $total_slices_hwe;  ?>';
        //     if(get_total_slice_hwe == '12')
        //      {
        //         jQuery("#drawing g:nth-child(2) g:nth-child(3)").attr('transform','matrix(6.123234262925839e-17,1,-1,6.123234262925839e-17,765.6737060546875,-40.581390380859375)');
        //     }
        //     else if(get_total_slice_hwe == '5')
        //     {
        //         jQuery("#drawing g:nth-child(2) g:nth-child(3)").attr('transform','matrix(0.30901700258255005,0.9510565400123596,-0.9510565400123596,0.30901700258255005,597.2919921875,-114.30839538574219)');
        //     }
        //      else if(get_total_slice_hwe == '8')
        //     {
        //          jQuery("#drawing g:nth-child(2) g:nth-child(3)").attr('transform','matrix(0.12186934053897858,0.9925461411476135,-0.9925461411476135,0.12186934053897858,700.7461547851562,-50.4896469116211)');
                 
        //     }
        //     else if(get_total_slice_hwe == '10')
        //     {
        //         jQuery("#drawing g:nth-child(2) g:nth-child(3)").attr('transform','matrix(0.12186934053897858,0.9925461411476135,-0.9925461411476135,0.12186934053897858,714.7461547851562,-75.4896469116211)');
                 
        //     }
        //      else if(get_total_slice_hwe == '36')
        //      {
        //         jQuery("#drawing g:nth-child(2) g:nth-child(3)").attr('transform','matrix(6.123234262925839e-17,1,-1,6.123234262925839e-17,753.6567993164062,-02.85595703125)');
        //         jQuery("#drawing g:nth-child(2) g:nth-child(3) g:nth-child(1)").attr('title','mohit');
                 
        //     }
         
         
        // },1000);
           
 });

    function add_more_file_upload_filed()
    {
        $(".upload_banner_file_option_hwe").after('<br /><label class="btn btn-default btn-upload banner_image" for="banner_image" style="margin-top: 0px;"><input id="banner_image" type="file"  name="banner_image[]" style="margin: 0px 10px 0px 10px;" ></label>');
    }
</script>
<body>
    <input type="hidden" id="set_all_slice_images">
    <input type="hidden" id="set_random_spin_value">
    
    <input type="hidden" id="image_labal_hide_show_data" value='<?php echo $no_matter_labal_image_hideshow; ?>' />
    <input type="hidden" id="get_labels_value_wheel_hwe" value='<?php echo $get_labels_value_wheel_hwe; ?>' />
    
    <input type="hidden" id="total_wheel_slices" value='<?php echo $total_slices; ?>' />
    <input type="hidden" id="slice_color_set" value='<?php echo $slice_color_set_hwe; ?>' />
    <input type="hidden" id="slice_color_set_array_checkbox" value='<?php echo $slice_color_set_array_checkbox_hwe; ?>' />

    <input type="hidden" id="slice_text_color_set" value='<?php echo $slice_text_color_set_hwe; ?>' />
    <input type="hidden" id="slice_text_color_set_array_checkbox" value='<?php echo $slice_text_color_set_array_checkbox_hwe; ?>' />
    

    <input type="hidden" id="wheel_border_olor" value='<?php echo $wheel_border_olor; ?>' />

    <input type="hidden" id="wheel_button_border_olor" value='<?php echo $wheel_button_border_olor; ?>' />

    

    <input type="hidden" id="lucky_number_option" value='<?php echo $lucky_number_option; ?>' />
    
    <input type="hidden" id="website_main_url_hwe" value="<?php echo Front_URL; ?>">
    <!-- BACKGROUND ANIMATION RENDER HERE -->
    <?php
    if($wallpaper_config == 9)
    {
        ?>

    <style>
         #particles-js
         {
            background-image: url('<?php echo $live_wallpaper_img; ?>') !important;
            height:1020px;
          
         }
    </style>

          
        <?php

        $live_wallpaper_bg = 'background-image: url('.$live_wallpaper_img.') !important;';
    }
    ?>

    
    <div id="particles-js" class="happy-new-year" style="<?php echo $live_wallpaper_bg; ?>"></div>
    <!-- THIS ELEMENT TO BE USED TO DRAW LUCKY WHEEL -->
    <div id="drawing"></div>
    <!-- BURGER MENU -->
    <div class="burger-menu">
        <span class="active"></span>
        <span class="active"></span>
        <span class="active"></span>
        <div class="counter">...</div>
    </div>
    <!-- REWARD LIST OF PLAYER -->
    <div class="reward-list">
        <div class="items">
            <!-- REWARD ITEM WILL RENDER INTO HERE -->
        </div>
    </div>
    <!-- BANNERS -->
   
    <!-- POPUP AFFILIATE -->
    <div id="daily-lucky" class="success-popup hide" data-type="admin">
        <div class="popup-overlay"></div>
        <div class="popup-container">
            <div class="popup-inner text-center">
                <div class="pad-wapper">
                    <img class="img-popup" src="img/daily_lucky.png" alt="daily-lucky">
                    <div class="information">You have won <span class="number-coin" id="number-coin-luckydraw"><strong>...</strong></span></div>
                    <p class="des-popup"></p>
                </div>
                <div class="footer-popup">
                    <a class="affiliate-link" target="_blank">
                        <button class="btn btn-continue"><span>Continue</span></button>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <!-- POPUP ENTER ACCESS KEY -->

   

    <div id="access-key" class="common-popup hide" data-type="admin">
        <div class="inner-content">
          <form method="post"> 
            <input id="access_key_save" class="text-box" type="text" name="access-key" maxlength="80" placeholder="Enter Your Access Key">
            <button type="submit" name="access_key_save" class="btn btn-submit sameline access_key_save"><span>Enter</span></button>
          </form>  
        </div>
    </div>
    <!-- POPUP COUNTDOWN TIMER -->
    <div id="count-down-timer" class="hide" data-type="admin">
        <div class="remainTime">
            <div>
                <span class="hours"></span>
                <div class="smalltext">Hours</div>
            </div>
            <div>
                <span class="minutes"></span>
                <div class="smalltext">Minutes</div>
            </div>
            <div>
                <span class="seconds"></span>
                <div class="smalltext">Seconds</div>
            </div>
        </div>
    </div>
    <!-- POPUP CUSTOMER EMAIL RENDER HERE  -->
    <div id="popup-customer-email" class="common-popup hide" data-type="admin">
        <div class="inner-content">
           <form method="post"> 
            <input id="customer-email" class="text-box" type="text" name="customer-email" maxlength="80" placeholder="Please enter your email to recive the reward" oninput="validateEmail(this, value)" />
            <button type="submit" name="customer_email_save" class="btn btn-send-email sameline inactive customer_email_save"><span>Save</span></button>
           </form>
        </div>
    </div>
    <!-- OVERLAY MENU CONFIG ADMIN ONLY -->
    <div id="popup-config-customer-email" class="common-popup admin hide" data-type="admin">
        
        <div class="inner-content">
          <form method="post"> 
            <input id="email-send" name="email-send" class="text-box" type="text" maxlength="80" placeholder="Ex: send@gmail.com" />
            <input id="password-email-send" name="password-email-send" class="text-box" type="password" maxlength="80" placeholder="Pass will be encrypted" />
            <input id="email-receive" name="email-receive" class="text-box" type="text" maxlength="80" placeholder="Ex: receive@gmail.com" />
            <button type="submit" name="save_email_config_popup" class="btn btn-save-email-config"><span>Save</span></button>
          </form>
        </div>
    </div>
    <!-- add banner images slider popup-->
    <div id="popup_banner_images" class="common-popup admin hide" data-type="admin">

        <?php
            if(isset($_REQUEST['delete_id']) && $_REQUEST['delete_id'] !='')
            {
                $delete = "DELETE from ".$table_prefix."banner_add where id='".$_REQUEST['delete_id']."'";
                if(mysqli_query($conn,$delete))
                {
                    ?>
                    <script>
                        window.location.replace('users.php');
                    </script>
                    <?php
                }
            }
        ?>

<style>
    .hwe_banner_list_images .grab {
    cursor: grab;
    }

    .hwe_banner_list_images .grabbed {
    box-shadow: 0 0 13px #000;
    }

    .hwe_banner_list_images .grabCursor,
    .hwe_banner_list_images .grabCursor * {
    cursor: grabbing !important;
    }
</style>
        
        <div class="inner-content" style="opacity:1;">
          <form method="post" enctype="multipart/form-data"> 
            <!-- <label class="btn btn-default btn-upload" for="live_wallpaper_img" >
                        <input id="banner_image" type="file" name="banner_image[]" onchange="" style="display:none;">
                        Choose Image
            </label> -->
            <hr>
            <table class="table hwe_banner_list_images">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Image Name</th>
                        <th>Delete</th>
                    </tr>
                
                </thead>
                <tbody>
                    <?php
                        $select5 ="SELECT * from ".$table_prefix."banner_add";
                        $row5 = $conn->query($select5);

                        $count =1;
                        while($result5 = mysqli_fetch_assoc($row5))
                        {
                            $id = $result5['id'];
                            $banner_image_hwe1 = $result5['banner_image'];
                            ?>
                                <tr data-id="<?php echo $id; ?>" class="banner_list_images_table">
                                    <td class="grab">&#9776;</td>
                                    <td><?php echo $count; ?></td>
                                    <td><a href="<?php echo 'admin_panel/pages/'.$banner_image_hwe1; ?>"><?php echo $banner_image_hwe1; ?></a></td>
                                    <td><a class="btn btn-danger" href="?delete_id=<?php echo $id; ?>">Delete</a></td>
                                </tr>
                            <?php
                          $count++;
                    
                        }
                    ?>

                </tbody>
                </table>
              
            <button type="button" id="hide_banner" name="save_popup_banner_images" class="btn save_popup_banner_images"><span>Cancel</span></button>
          </form>
        </div>
    </div>
    <!--end popup  -->
    <div class="menu-config hide admin" data-type="admin">
        <div class="popup-overlay"></div>
        <div class="popup-container">
            <div class="configuration countdown">
                <form method="post">
                    <div class="form-group">
                        <label>Enter the play times you want to show count down timer.</label>
                        <input type="number" id="countdown_number" name="countdown_number" class="limit-play-times form-control full-width" placeholder="Enter number only" />
                    </div>
                    <div class="form-group">
                        <label>Enter remain hour for count down timer.</label>
                        <input type="number" id="countdown_remain_hour" name="countdown_remain_hour" class="remain-time form-control full-width" placeholder="Enter number only" />
                    </div>
                    <button type="submit" name="save_countdown" class="btn btn-primary btn-save-countdown-timer">Save</button>
                </form>
            </div>
        </div>
    </div>
    <!-- <div class="btn-group" data-type="admin" role="group">
        <button type="button" class="btn btn-secondary btn-lg btn-reset" onclick="reset()">Reset</button>
        <button type="button" class="btn btn-success btn-lg btn-quickstar" onclick="quickStar()"><span class="bounce">Quick Star</span></button>
        <button type="button" class="btn btn-primary btn-lg btn-switch"><span class="">Switch Banner Mode</span></button>
        <button type="button" class="btn btn-warning btn-lg btn-export" onclick="save()">Export</button>
        
    </div> -->

    <form method="post" enctype="multipart/form-data">
       
    <input type="hidden" class="set_box_alert_pro" name="set_box_alert_pro">
    

        <div id="edit-params" data-type="admin" class="l-first">

        <div class="form-group">
                <button type="submit" name="save_data" class="btn btn-danger btn-lg" onClick="return confirm('Are you sure you want to changes!');"><span class="">Save</span></button>
            </div>
            <!-- <div class="form-group">
                <h2 for="email-popup-config" class="remake">Total Spin Show</h2>
                <input id="total_spin_show" type="number" placeholder="Enter Total Spin For User" class="form-control input-detail" name="total_spin_show" value="<?php echo $total_spin_show; ?>">
            </div> -->
            <div class="form-group">
                    <h2 for="register_now" class="remake">Maintenance Mode</h2>
                    <select id="maintenance_mode" class="form-control" name="maintenance_mode">
                        <option value="1" <?php if($maintenance_mode == 1){ echo 'selected'; } ?> >On</option>
                        <option value="0" <?php if($maintenance_mode == 0){ echo 'selected'; } ?> >Off</option>
                    </select>
                    <span style="color: #484848;">Use link login : site_url?keyhwe=1</span>
            </div>
            <?php
            if($user_login_sp == '1')
            {

            ?>
                <div class="form-group">
                    <h2 for="register_now" class="remake">Register Now Show/Hide Option</h2>
                    <select id="register_now" class="form-control" name="register_now">
                        <option value="1" <?php if($register_now == 1){ echo 'selected'; } ?> >Yes</option>
                        <option value="0" <?php if($register_now == 0){ echo 'selected'; } ?> >No</option>
                    </select>
                </div>
                <?php
                if($register_now == '1')
                {
                ?>
                    <div class="form-group">
                        <h2 for="register_now_text" class="remake">Register Now Text </h2>
                    
                        <input id="register_now_text" type="text" class="form-control"  name="register_now_text" value="<?php echo $register_now_text; ?>">                        
                    </label>
                    
                    </div>
                    <div class="form-group">
                        <h2 for="register_now_link" class="remake">Register Now URL </h2>
                    
                        <input id="register_now_link" type="text" class="form-control"  name="register_now_link" value="<?php echo $register_now_link; ?>">                        
                    </label>
                    
                    </div>
                <?php
                }
            }
            if($second_layout_sp == '1' || $fourth_layout_sp == '1')
            {
            ?>
            <div class="form-group">
                <h2 for="reward_list_effect" class="remake">Reward List Effect</h2>
                <select id="reward_list_effect" class="form-control" name="reward_list_effect">
                    <option value="1" <?php if($reward_list_effect == 1){ echo 'selected'; } ?> >Yes</option>
                    <option value="0" <?php if($reward_list_effect == 0){ echo 'selected'; } ?> >No</option>
                </select>
            </div>
            <div class="form-group">
                <h2 for="reward_list_effect" class="remake">Footer Style</h2>
                <select id="footer_style_second_layout" class="form-control" name="footer_style_second_layout">
                    <option value="1" <?php if($footer_style_second_layout == 1){ echo 'selected'; } ?> >3D Layout</option>
                    <option value="0" <?php if($footer_style_second_layout == 0){ echo 'selected'; } ?> >Default Layout</option>
                </select>
            </div>
            <div class="form-group">
                <h2 for="live_chat_menu_url" class="remake">Live Chat URL </h2>
            
                <input id="live_chat_menu_url" type="text" class="form-control"  name="live_chat_menu_url" value="<?php echo $live_chat_menu_url; ?>">                        
               </label>
            
            </div>
            <div class="form-group">
                <h2 for="reward-popup-config">Change Bottom Menu Link</h2>
                <div>
                    <div>
                        <?php 
                        if($second_layout_sp == 1)
                        {
                        ?>
                            <label>Home Menu URL</label><input type="text" name="home_menu_url" class="form-control" value="<?php echo $home_menu_url; ?>"/>
                            <label>Share Menu URL</label><input type="text" name="share_menu_url" class="form-control" value="<?php echo $share_menu_url; ?>"/>
                        <?php
                        }
                        ?>
                        <label>Live Chat URL</label><input id="live_chat_menu_url" type="text" class="form-control"  name="live_chat_menu_url" value="<?php echo $live_chat_menu_url; ?>">
                        <?php 
                        if($second_layout_sp == 1)
                        {
                        ?>
                        <label>Account Menu URL</label><input type="text" name="account_menu_url" class="form-control" value="<?php echo $account_menu_url; ?>"/>
                        <?php
                        }
                        ?>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <h2 for="site_logo_hwe" class="remake">Upload Site Logo </h2>
                <label class="btn btn-default btn-upload banner_image upload_banner_file_option_hwe" for="banner_image" style="margin-top: 0px;">
                Choose Image
                <input id="site_logo_hwe" type="file"  name="site_logo_hwe" >                        
               </label>
            
            </div>
            
           <?php
                //if($fourth_layout_sp == '1')
               // {
                
            ?>
                <div class="form-group">
                    <h2 for="site_logo_hwe" class="remake">Reward List Background Upload</h2>
                    <label class="btn btn-default btn-upload" for="banner_image" style="margin-top: 0px;">
                    Choose Image
                    <input id="reward_list_bg_upload" type="file"  name="reward_list_bg_upload" >                        
                </label>
                
                </div>
                <div class="form-group">
                    <h2 for="site_logo_hwe" class="remake">Upload Reward Icon </h2>
                    <label class="btn btn-default btn-upload" for="banner_image" style="margin-top: 0px;">
                    Choose Image
                    <input id="reward_icon_change" type="file"  name="reward_icon_change" >                        
                </label>
                
                </div>
                <div class="form-group">
                    <h2 for="site_logo_hwe" class="remake">Remain Spin Text Color </h2>
                    <label class="btn btn-default btn-upload " for="banner_image" style="width:100%;margin: 0px;text-align: left;">
                        Choose Color<input id="reamin_spin_text_color" type="color"  name="reamin_spin_text_color" style="width:40px;" value="<?php echo $reamin_spin_text_color; ?>">                        
                    </label>
            
                </div>
                <?php
                //}
            }
            ?>
            <div class="form-group">
                <h2 for="email-popup-config" class="remake">Wheel Border Color Set</h2>
                <select id="wheel_border_color_set" class="form-control" name="wheel_border_color_set">
                    <option value="1" <?php if($wheel_border_color_set == 1){ echo 'selected'; } ?> >Yes</option>
                    <option value="0" <?php if($wheel_border_color_set == 0){ echo 'selected'; } ?> >No</option>
                </select>
            </div>
            <div class="form-group">
                    <h2 for="site_logo_hwe" class="remake">Wheel Border Color </h2>
                    <label class="btn btn-default btn-upload " for="banner_image" style="width:100%;margin: 0px;text-align: left;">
                        Choose Color<input id="wheel_border_olor" type="color"  name="wheel_border_olor" style="width:40px;" value="<?php echo $wheel_border_olor; ?>">                        
                    </label>
            
            </div>
            <div class="form-group">
                <h2 for="email-popup-config" class="remake">Wheel Border Button Color Set</h2>
                <select id="wheel_border_button_color_set" class="form-control" name="wheel_border_button_color_set">
                    <option value="1" <?php if($wheel_border_button_color_set == 1){ echo 'selected'; } ?> >Yes</option>
                    <option value="0" <?php if($wheel_border_button_color_set == 0){ echo 'selected'; } ?> >No</option>
                </select>
            </div>
            <div class="form-group">
                    <h2 for="site_logo_hwe" class="remake">Wheel Border Button Color </h2>
                    <label class="btn btn-default btn-upload " for="banner_image" style="width:100%;margin: 0px;text-align: left;">
                        Choose Color<input id="wheel_button_border_olor" type="color"  name="wheel_button_border_olor" style="width:40px;" value="<?php echo $wheel_button_border_olor; ?>">                        
                    </label>
            
            </div>
            <div class="form-group">
                <h2 for="redeem_button_hide_show" class="remake">Enable/Disable Redeem Button</h2>
                <select id="redeem_button_hide_show" class="form-control" name="redeem_button_hide_show">
                    <option value="1" <?php if($redeem_button_hide_show == 1){ echo 'selected'; } ?> >Yes</option>
                    <option value="0" <?php if($redeem_button_hide_show == 0){ echo 'selected'; } ?> >No</option>
                </select>
            </div>
            <?php
            if($second_layout_sp == 1)
            {
    
            ?>
            <div class="form-group">
                <h2 for="reward-popup-config">Change Redeem Button Text</h2>
                <div>
                    <div>
                       <input type="text" name="redeem_button_text" class="form-control" placeholder="Enter Redeem Button Text" value="<?php echo $redeem_button_text; ?>"/>
                       
                    </div>
                </div>
            </div>
            <?php
            }
            ?>
            <div class="form-group">
                <h2 for="email-popup-config" class="remake">Send Email Config</h2>
                <select id="email-popup-config" class="form-control" name="email-popup-config">
                    <option value="1" <?php if($email_popup_config == 1){ echo 'selected'; } ?> >Yes</option>
                    <option value="0" <?php if($email_popup_config == 0){ echo 'selected'; } ?> >No</option>
                </select>
            </div>
            <div class="form-group">
                <h2 for="slider_banner" class="remake">Banner</h2>
                <select id="slider_banner" class="form-control" name="slider_banner">
                    <option value="1" <?php if($slider_banner == 1){ echo 'selected'; } ?> >Yes</option>
                    <option value="0" <?php if($slider_banner == 0){ echo 'selected'; } ?> >No</option>
                </select>
                <div onclick="add_more_file_upload_filed()" style="width: 50%;text-align: center;margin-left: 25%;background-color: cadetblue;padding: 5px;border-radius: 5px;cursor: pointer;color: white;">Add More</div>
                <label class="btn btn-default btn-upload banner_image upload_banner_file_option_hwe" for="banner_image" style="margin-top: 0px;">
                Choose Image
                <input id="banner_image" type="file"  name="banner_image[]" >                        
               </label>
               
               
               <div>
                        <button class="btn btn-primary" id="check_banner_list" type="button">Check Image List</button>
               </div>

               
            </div>
            <div class="form-group">
                <h2 for="wallpaper-config" class="remake">Live Wallpapers</h2>
                <select id="wallpaper-config" class="form-control" name="wallpaper-config">
                    <option value="0" <?php if($wallpaper_config == 0){ echo 'selected'; } ?> >No</option>
                    <option value="3" <?php if($wallpaper_config == 3){ echo 'selected'; } ?> >Songkran</option>
                    <option value="1" <?php if($wallpaper_config == 1){ echo 'selected'; } ?> >Christmas</option>
                    <option value="2" <?php if($wallpaper_config == 2){ echo 'selected'; } ?> >Happy new year</option>
                    <option value="4" <?php if($wallpaper_config == 4){ echo 'selected'; } ?> >Flame</option>
                    <option value="5" <?php if($wallpaper_config == 5){ echo 'selected'; } ?> >Gift</option>
                    <option value="6" <?php if($wallpaper_config == 6){ echo 'selected'; } ?> >Zodiac</option>
                    <?php
                    if($second_layout_sp == '1' || $fourth_layout_sp == '1')
                    {
                    ?>
                       <option value="9" <?php if($wallpaper_config == 9){ echo 'selected'; } ?> >Your Background</option>
                    <?php
                    }
                    ?>
                </select>
            </div>
            <?php
            $display_live_wall='';
            if($wallpaper_config == 9)
            {
                $display_live_wall = 'display:block;';
            }
            else
            {
                $display_live_wall = 'display:none;';
            }
            ?>
            <label class="btn btn-default" for="live_wallpaper_img" style="background-color: #f0f2f5;<?php echo $display_live_wall;  ?>">
                    <input id="live_wallpaper_img" type="file" name="live_wallpaper_img" onchange="" style="display:none;">
                    Desktop Image Choose
            </label>
            
            <label class="btn btn-default" for="live_wallpaper_img_mobile_size" style="background-color: #f0f2f5;<?php echo $display_live_wall;  ?>">
                    <input id="live_wallpaper_img_mobile_size" type="file" name="live_wallpaper_img_mobile_size" onchange="" style="display:none;">
                    Mobile Image Choose
            </label>
            <div class="form-group">
                <h2 for="slice" class="remake">Total slices</h2>
                <select id="slice" class="form-control" onchange="setTotalSlices()" name="slice">
                    <option value="5" <?php if($slice == 5){ echo 'selected'; } ?> >5 Slices</option>
                    <option value="8" <?php if($slice == 8){ echo 'selected'; } ?> >8 Slices</option>
                    <option value="10" <?php if($slice == 10){ echo 'selected'; } ?> >10 Slices</option>
                    <option value="12" <?php if($slice == 12){ echo 'selected'; } ?> >12 Slices</option>
                    <option value="36" <?php if($slice == 36){ echo 'selected'; } ?> >36 Slices</option>
                </select>
            </div>

            <!-- <div class="form-group">
                <h2 for="slice" class="remake">Win Prices</h2>
                <input type="checkbox" value="1" name="no_matter_probability" <?php echo $checked_probability; ?>>
            </div> -->

            <div class="form-group layout-group">
                <h2 for="list-input" class="toogle-hidden-menu pointer remake">Slice data <span class="toggle-redirect-link">=></span></h2>
          
                <div id="list-input">
                    <!--<input type="text" class="form-control input-detail" placeholder="Enter Slice Value" />-->
                </div>
                <div id="list-redirect-Link" class="">
                    <!--<input type="text" class="form-control input-detail" placeholder="Enter Redirect Link" />-->
                    
                </div>
                
                <div id="reward_labal_image_checkbox" class="">
                    
                </div>

                <div id="text_images_together" class="">
                    
                </div>
                
                <div id="slices_probability" class="">
                    
                </div>
                
                <div id="reward_redirect_link_redeem_div" class="">
                    
                </div>
                
                <div id="reward_redirect_link_redeem_set_onoff" class="">
                    
                </div>
                
                
                <?php 
                $display_css = 'display:none !important;';
                $host_name = $_SERVER['HTTP_HOST'];
                if($host_name == 'wheel.jgdx.xyz' || $host_name == 'luckyspin888.com')
                {
                    $display_css = '';
                }
                ?>           
                <div id="set_prices_win_a_day" style="<?php echo $display_css; ?>" class="">
                </div>
                <div id="slice_color_hwe" class="">
                    
                </div>
                <div id="slice_color_checkbox" class="">
                    
                </div>

                <div id="slice_text_color_hwe" class="">
                    
                </div>
                <div id="slice_text_color_checkbox" class="">
                    
                </div>

                <div id="lucky_number_checkbox" class="">
                    
                </div>
            </div>
        </div>
        <div id="edit-params" data-type="admin" class="r-first">
            <div class="form-group">
                <h2 for="wheel-ux-config" class="remake">Wheel UX</h2>
                <select id="wheel-ux-config" class="form-control" name="wheel-ux-config">
                    <option value="0" <?php if($wheel_ux_config == 0){ echo 'selected'; } ?> >Original</option>
                    <option value="1" <?php if($wheel_ux_config == 1){ echo 'selected'; } ?> >Golden Style</option>
                    <option value="2" <?php if($wheel_ux_config == 2){ echo 'selected'; } ?> >Gift Style</option>
                    <option value="3" <?php if($wheel_ux_config == 3){ echo 'selected'; } ?> >Zodiac</option>
                    <option value="4" <?php if($wheel_ux_config == 4){ echo 'selected'; } ?> >Reward Image</option>
                </select>
            </div>
           
            <!-- <div class="form-group">
                <h2 for="coundown-popup-config" class="remake">Upload invisible Slice Image</h2>
                <select id="coundown-popup-config" class="form-control" name="coundown-popup-config">
                    <option value="1" <?php if($coundown_popup_config == 1){ echo 'selected'; } ?> >Yes</option>
                    <option value="0" <?php if($coundown_popup_config == 0){ echo 'selected'; } ?> >No</option>
                </select>
            </div> -->
            <div class="form-group">
                <h2 for="reward-popup-config">Upload invisible Slice Image</h2>
                <div>
                    <div>
                        <label>Upload Image:  &nbsp;&nbsp;</label>
                        <!-- <input type="checkbox" style="width:auto;" name="invisible_slice_image_checkbox" <?php if($invisible_slice_image_checkbox == 1){echo 'checked';} ?> value="1"/> -->
                        <input type="file" name="invisible_slice_image" class="form-control" placeholder="Bottom and Side menu" value="<?php echo $invisible_slice_image; ?>"/>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <h2 for="coundown-popup-config" class="remake">Count Down Timer</h2>
                <select id="coundown-popup-config" class="form-control" name="coundown-popup-config">
                    <option value="1" <?php if($coundown_popup_config == 1){ echo 'selected'; } ?> >Yes</option>
                    <option value="0" <?php if($coundown_popup_config == 0){ echo 'selected'; } ?> >No</option>
                </select>
            </div>
            <div class="form-group">
                <h2 for="sound-config" class="remake">Spin Sound</h2>
                <select id="sound-config" class="form-control" name="sound-config">
                    <option value="1" <?php if($sound_config == 1){ echo 'selected'; } ?> >Yes</option>
                    <option value="0" <?php if($sound_config == 0){ echo 'selected'; } ?> >No</option>
                </select>
            </div>
            <div class="form-group">
                <h2 for="reward-popup-config">Show Reward Popup</h2>
                <select id="reward-popup-config" class="form-control" name="reward-popup-config">
                    <option value="1" <?php if($reward_popup_config == 1){ echo 'selected'; } ?> >Yes</option>
                    <option value="0" <?php if($reward_popup_config == 0){ echo 'selected'; } ?> >No</option>
                </select>
            </div>
            <?php
            if($second_layout_sp == '1')
            {
            ?>
            <div class="form-group">
                <h2 for="sound-config" class="remake">Select Bottom Menu Bg Option</h2>
                <select id="sound-config" class="form-control" name="select_bottom_bg_menu_option">
                    <option value="1" <?php if($select_bottom_bg_menu_option == 1){ echo 'selected'; } ?> >Yes</option>
                    <option value="0" <?php if($select_bottom_bg_menu_option == 0){ echo 'selected'; } ?> >No</option>
                </select>
            </div>
            <div class="form-group">
                <h2 for="reward-popup-config">Change Bottom Menu Bg Color</h2>
                <div>
                    <div>
                        <label>Change Backgroud Color</label><input type="color" style="width: 35%;" name="bottom_menu_bg_color" class="form-control" placeholder="Change Backgroud Color" value="<?php echo $bottom_menu_bg_color; ?>"/>
                       
                    </div>
                </div>
            </div>
            <div class="form-group">
                <h2 for="sound-config" class="remake">Select Side Menu Bg Option</h2>
                <select id="sound-config" class="form-control" name="select_side_bg_menu_option">
                    <option value="1" <?php if($select_side_bg_menu_option == 1){ echo 'selected'; } ?> >Yes</option>
                    <option value="0" <?php if($select_side_bg_menu_option == 0){ echo 'selected'; } ?> >No</option>
                </select>
            </div>
            <div class="form-group">
                <h2 for="reward-popup-config">Change Side Menu Bg Color</h2>
                <div>
                    <div>
                        <label>Change Backgroud Color</label><input type="color" style="width: 35%;" name="side_menu_bg_color" class="form-control" placeholder="Change Side Menu Backgroud Color" value="<?php echo $side_menu_bg_color; ?>"/>
                       
                    </div>
                </div>
            </div>
            <div class="form-group">
                <h2 for="reward-popup-config">Change Bottom Menu Text</h2>
                <div>
                    <div>
                        <label>Home Menu</label><input type="text" name="home_menu_text" class="form-control" placeholder="Bottom and Side menu" value="<?php echo $home_menu_text; ?>"/>
                       
                        <label>Share Menu</label><input type="text" name="share_menu_text" class="form-control" value="<?php echo $share_menu_text; ?>"/>
                        <label>Message Menu</label><input type="text" name="message_menu_text" class="form-control" value="<?php echo $message_menu_text; ?>"/>
                        <label>Account Menu</label><input type="text" name="account_menu_text" class="form-control" value="<?php echo $account_menu_text; ?>"/>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <h2 for="reward-popup-config">Change Side Menu Text</h2>
                <div>
                    <div>
                        
                        <label>Spin History Menu</label><input type="text" name="share_menu_sidebar_text" class="form-control" value="<?php echo $share_menu_sidebar_text; ?>"/>
                        <label>Redeem Point Menu</label><input type="text" name="message_menu_sidebar_text" class="form-control" value="<?php echo $message_menu_sidebar_text; ?>"/>
                        <label>Contact Us Menu</label><input type="text" name="account_menu_sidebar_text" class="form-control" value="<?php echo $account_menu_sidebar_text; ?>"/>
                        <label>Logout Menu</label><input type="text" name="logout_side_menu" class="form-control" value="<?php echo $logout_side_menu; ?>"/>
                        <label>User Id Label</label><input type="text" name="user_id_label" class="form-control" value="<?php echo $user_id_label; ?>"/>
                        <label>Remaining Spin Label</label><input type="text" name="remaining_spin_label" class="form-control" value="<?php echo $remaining_spin_label; ?>"/>
                        <label>Earned Points Label</label><input type="text" name="earned_points_label" class="form-control" value="<?php echo $earned_points_label; ?>"/>
                        <label>UUID Label</label><input type="text" name="uuid_label" class="form-control" value="<?php echo $uuid_label; ?>"/>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <h2 for="reward-popup-config">Change Bottom Menu Image</h2>
                <div>
                    <div>
                        <label>Home Menu Image:  &nbsp;&nbsp;</label><input type="checkbox" style="width:auto;" name="home_menu_image_checkbox" <?php if($home_menu_image_checkbox == 1){echo 'checked';} ?> value="1"/>
                        <input type="file" name="home_menu_image" class="form-control" placeholder="Bottom and Side menu" value="<?php echo $home_menu_image; ?>"/>
                        
                        
                        <label>Share Menu Image:  &nbsp;&nbsp;</label><input type="checkbox" style="width:auto;" name="share_menu_image_checkbox" <?php if($share_menu_image_checkbox == 1){echo 'checked';} ?> value="1"/>
                        <input type="file" name="share_menu_image" class="form-control" value="<?php echo $share_menu_image; ?>"/>
                        
                       
                        <label>Message Menu Image:  &nbsp;&nbsp;</label><input type="checkbox" style="width:auto;" name="message_menu_image_checkbox" <?php if($message_menu_image_checkbox == 1){echo 'checked';} ?> value="1"/>
                        <input type="file" name="message_menu_image" class="form-control" value="<?php echo $message_menu_image; ?>"/>
                        
                       
                        <label>Account Menu Image:  &nbsp;&nbsp;</label><input type="checkbox" style="width:auto;" name="account_menu_image_checkbox" <?php if($account_menu_image_checkbox == 1){echo 'checked';} ?> value="1"/>
                        <input type="file" name="account_menu_image" class="form-control" value="<?php echo $account_menu_image; ?>"/>
                        
                    </div>
                </div>
            </div>
            <?php
            }
            ?>
            <!-- <div class="form-group">
                <h2 for="graphic">Show Login Form</h2>
                <select id="login-popup-config" class="form-control" name="login-popup-config">
                    <option value="1" <?php //if($login_popup_config == 1){ echo 'selected'; } ?> >Yes</option>
                    <option value="0" <?php //if($login_popup_config == 0){ echo 'selected'; } ?> >No</option>
                </select>
            </div> -->
            <div class="form-group">
                <h2 for="graphic">Graphic quality</h2>
                <select id="graphic" class="form-control" onchange="setGraphicQuality()" name="graphic">
                    <option value="0" <?php if($graphic == 0){ echo 'selected'; } ?> >Low</option>
                    <option value="1" <?php if($graphic == 1){ echo 'selected'; } ?> >Medium</option>
                    <option value="2" <?php if($graphic == 2){ echo 'selected'; } ?> >High</option>
                </select>
            </div>
            <div class="form-group">
                <h2 for="graphic">Upload spin icon</h2>
                <label class="btn btn-default btn-upload" for="file-selector">
                    <input id="file-selector" type="file" name="file-selector" onchange="setBrandLogo()" style="display:none;">
                    Choose Image
                </label>
            </div>
            <div class="form-group">
                <h2 for="bg">Background color</h2>
                <input id='colorpicker' name="bg_color" value=" <?php echo $bg_color; ?>" />
            </div>
        </div>
        <div class="context hide" data-type="admin">
            <div class="overlay">
                <iframe class="quick-star-video" src="https://www.youtube.com/embed/bKycXwn13_8" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
            </div>
        </div>

       

    </form>

    <!-- SOUND TRACK -->
    <?php
    if($host_name == 'edbet321spins.com')
    {
        $music_sound = 'edbet-background-music.mp3';
    }
    else
    {
        $music_sound = 'spinSound.mp3';
    }
    ?>
    <audio id="spinSound" controls style="display:none;">
        <source src="media/<?php echo $music_sound; ?>" type="audio/mp3">
        Your browser does not support the audio element.
    </audio>
    <?php

    $default_config_array =array();
       $default_reward_image_array =array();
      
       

       $sound_config =$spin_data['sound-config'];
       if($sound_config == 1)
       {
           $sound_check_hwe = true; 
       }
       else
       {
           $sound_check_hwe = false;
       }

       for($m=0; $m<$total_slices_hwe; $m++)
       {
           $default_reward_image_array[] = array(
                                               'value'=>  $spin_data['prize'.$m],
                                               'imageUrl' => 'img/reward'.$m.'.png',
                                           );
       }
    
       $default_config_array =array (
                                      'wheelUX' => $wheel_ux_config,
                                      'totalSlices' => $total_slices_hwe,
                                      'distanceDeg' => 45,
                                      'defaultStartDeg' => 270,
                                      'borderSlice' => 5,
                                      'sliceWidth' => 30,
                                      'graphicOption' => $graphic,
                                      'brandLogo' => 'admin_panel/pages/img/brand.png',
                                      'backgroundColor' => $bg_color,
                                      'allowSound' => $sound_check_hwe,
                                      'anims' => 
                                      array (
                                        'fallingSnow' => true,
                                        'flame' => false,
                                      ),
                                    );
                                    
      
    ?>
    <script>
        
        var send_defaultConfig_json_data = '<?php echo json_encode($default_config_array); ?>';
    </script>
        <script>
        
        var send_reward_image_json_data = '<?php echo json_encode($default_reward_image_array); ?>';
    </script>

    <!-- CONFIG NEEDED PARAMS GENEREATE FROMN ADMIN PAGE TO OPERATE THE WHEEL AS: TOTAL SLICE, GRAPHIC, REWARD VALUES -->
    <script id="config" defer></script>
    <script id="smtp" src="js/smtp.js" data-type="admin" defer></script>
    <script src="js/svg.min.js" defer></script>
    <script src="js/layout.js" defer></script>
    <script src="js/jquery-3.4.0.min.js" data-type="admin" defer></script>
    <script src="js/swiper.min.js" data-type="admin" id="swiper-js"></script>
    <script src='js/spectrum.min.js' data-type="admin" defer></script>
    <script src="js/jszip.min.js" data-type="admin" defer></script>
    <script src="js/jszip-utils.min.js" data-type="admin" defer></script>
    <script src="js/filesaver.js" data-type="admin" defer></script>
    <script src="js/params.js" data-type="admin" defer></script>
    <script id="particles-lib" src="js/particles.min.js" defer></script>
    <script id="anims" src="js/animations.js" defer></script>
    <script>
    /***************** CLICK AND RECEIVE REWARD EVENTS *****************/

    function loadEvents() {

        // Load reward
        loadRewardBag();

        // Check Game Rules
        if (document.querySelector('#count-down-timer')) {
            checkGameRules();
        }

        // Spin tap
        _globalVars.elms.spin.click(function() {

            if (!_globalVars.isProcessing) {



                // Play sound if have config
              var check_sound = '<?php echo $sound_config;  ?>';
               if(check_sound == 1)
               {
                   if(_dynamicParams.config.allowSound) {
                            var spinSound = document.getElementById('spinSound');
                                spinSound.play().catch(function() {
                            });
                    }
               }

                spin(function(data) {

                    // Spin complete animation and receive reward
                    console.log(data);

                    // Save reward into reward bag
                    saveReward(data);

                    // Your continue code if have

                    // Check if the reward popup component is ready or not. Priority is customer email popup first
                    if (document.querySelector('#popup-customer-email') && !document.querySelector('#email-popup-config')) {
                        showPopupEmail();
                    } else if (document.querySelector('#daily-lucky') && !document.querySelector('#reward-popup-config')) {
                        showPopup(data);
                    }

                    // Check condition to show count down timer
                    if (document.querySelector('#count-down-timer')) {

                        var playTimes = localStorage.getItem(cachedKey);

                        if (localStorage.getItem(cachedKey)) {
                            playTimes = JSON.parse(localStorage.getItem(cachedKey)).length;
                        } else {
                            playTimes = 0;
                        }

                        if (typeof(_dynamicParams.countdownConfig) !== 'undefined') {

                            if ((parseInt(playTimes) % parseInt(_dynamicParams.countdownConfig.timesToShowCountDown)) === 0) {

                                var currentDate = new Date();
                                var remainTime = currentDate.setHours(currentDate.getHours() + parseInt(_dynamicParams.countdownConfig.remainTime));
                                localStorage.setItem('remainTime', remainTime);

                                showCountDownTime();

                            }

                        }

                    }

                });

            }

        });

        // Redeem listener
        document.addEventListener('onRedeemCompleted', function(data) {

            // data.rewardValue => The reward value of user after finish spin the wheel.
            console.log(data.rewardValue);

        }, false);

        // Burger Menu tap
        var burgerMenu = document.querySelector('.burger-menu');
        burgerMenu.addEventListener('click', function(event) {
            burgerMenu.children[0].classList.toggle('active');
            burgerMenu.children[0].classList.toggle('cross');
            burgerMenu.children[1].classList.toggle('active');
            burgerMenu.children[1].classList.toggle('cross');
            burgerMenu.children[2].classList.toggle('hide');

            // Show or hide reward list
            document.querySelector('.reward-list').classList.toggle('show');
        });

        // Affiliate link click
        if (document.querySelector('.affiliate-link') !== null) {
            document.querySelector('.affiliate-link, .popup-container').addEventListener("click", function(e) {

                if (e.target.className.indexOf('popup-container') > -1 ||
                    e.target.className.indexOf('btn-continue') > -1 ||
                    e.target.className === '') {
                    document.querySelector('#daily-lucky').classList.add('hide');

                    // Call Redirect to the new pafe for each slide data config
                    redirectAffiliateLink();
                }

            }, false);
        }

        // Access button click
        if (document.querySelector('#access-key .btn-submit')) {

            setTimeout(function() { document.querySelector('#access-key .inner-content').classList.add('active'); }, 500);

            document.querySelector('#access-key .btn-submit').addEventListener('click', function(e) {

                // Call Verify Access Key
                verifyAccess();

            }, false);
        }
    }

    /*
        Function to show Popup reward 
    */
    function showPopup(data) {

        if (document.querySelector('.affiliate-link')) {
            try {

                var rewards = JSON.parse(localStorage.getItem(cachedKey));
                var totalPrice = 0;

                for (var i = 0; i < rewards.length; i++) {
                    if (rewards[i].redeem === false) {
                        totalPrice = totalPrice + parseInt(rewards[i].price.split('$')[0]);
                    }
                }

                if (data) {
                    document.querySelector('#number-coin-luckydraw strong').innerHTML = data;
                } else {
                    document.querySelector('#number-coin-luckydraw strong').innerHTML = totalPrice + '$';
                }


            } catch (ex) {}
            document.querySelector('#daily-lucky').classList.remove('hide');
        }
    }

    /*
        Function to handle click event for access button click
    */
    function verifyAccess() {

        if (document.querySelector('#access-key .text-box')) {
            try {

                // Get access key value from textbox
                var accessKey = document.querySelector('#access-key .text-box').value;

                // Continue your code to validate access key

                document.querySelector('#access-key').classList.add('hide');

            } catch (ex) {}
        }
    }

    /*
        Three Functions to manage count down timer
    */
    function remainTimeCalc() {

        // Get count down time
        var countDownTime = parseFloat(localStorage.getItem('remainTime'));

        // Get today's date and time
        var now = new Date().getTime();

        // Find the distance between now and the count down date
        var distance = countDownTime - now;

        // Time calculations for days, hours, minutes and seconds
        //var days = Math.floor(distance / (1000 * 60 * 60 * 24));
        var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        var seconds = Math.floor((distance % (1000 * 60)) / 1000);

        // Display the result in the element with id="demo"
        document.querySelector('.remainTime .hours').innerHTML = hours;

        document.querySelector('.remainTime .minutes').innerHTML = minutes;

        document.querySelector('.remainTime .seconds').innerHTML = seconds;

        // If the count down is finished, write some text
        if (distance < 0) {
            return 1;
        } else {
            return 0;
        }
    }

    function showCountDownTime() {

        document.querySelector('#count-down-timer').classList.remove('hide');

        var isCompleteCountDown = remainTimeCalc();

        // Update the count down every 1 second
        var interval = setInterval(function() {

            isCompleteCountDown = remainTimeCalc();

            // If the count down is finished allow to continue play lucky wheel
            if (isCompleteCountDown) {

                clearInterval(interval);

                document.querySelector('#count-down-timer').classList.add('hide');

                // Remove local localStorage Data
                localStorage.removeItem('remainTime');

            }
        }, 1000);
    }

    function checkGameRules() {

        // Check the reamin time of count down timer
        if (localStorage.getItem('remainTime')) {
            showCountDownTime();
        }
    }

    /*
        Function redirect to new page
    */
    function redirectAffiliateLink() {

        try {
            var currentReward = document.getElementById('drawing').getAttribute('value');
            var currentAffiliateLink = _dynamicParams.jsonData[currentReward].link;;

            if (typeof(currentAffiliateLink) !== 'undefined') {
                window.open(currentAffiliateLink, '_blank');
            }

        } catch (ex) {}
    }

    /*
        Function to validate email and send email
    */
    function validateEmail(elm, value) {
        var re = /^(([^<>()\[\]\.,;:\s@\"]+(\.[^<>()\[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()\.,;\s@\"]+\.{0,1})+[^<>()\.,;:\s@\"]{2,})$/;
        if (re.test(value)) {
            document.querySelector('.btn-send-email').classList.remove('inactive');
        } else {
            document.querySelector('.btn-send-email').classList.add('inactive');
        }
    }

    /*
        Function to handle email popup show / hide
    */
    function showPopupEmail() {
        document.querySelector('#popup-customer-email').classList.remove('hide');
        setTimeout(function() { document.querySelector('#popup-customer-email .inner-content').classList.add('active'); }, 500);
    }

    /*
        Event click of send email button
    */
    if (document.querySelector('#popup-customer-email')) {
        document.querySelector('.btn-send-email').addEventListener('click', function(e) {

            if (document.querySelector('.btn-send-email').className.indexOf('inactive') === -1) {
                sendEmail();
            }

        }, false);
    }
    /***************** //CLICK AND RECEIVE REWARD EVENTS *****************/
    </script>
    <script id="ad-script" data-type="admin">
    /* 
        Ads Banner
    */
    if (!document.querySelector('#edit-params')) {
        var swiper = new Swiper('.swiper-container', {
            effect: 'cube',
            grabCursor: true,
            cubeEffect: {
                shadow: true,
                slideShadows: true,
                shadowOffset: 20,
                shadowScale: 0.94,
            },
            speed: 1000,
            loop: true,
            autoplay: {
                delay: 5000,
            }
        });
    }
    </script>


    <script>
        $(".grab").mousedown(function(e) {
        var tr = $(e.target).closest("TR"),
            si = tr.index(),
            sy = e.pageY,
            b = $(document.body),
            drag;
        //if (si == 0) return;
        b.addClass("grabCursor").css("userSelect", "none");
        tr.addClass("grabbed");
        
        function move(e) {            
            if (!drag && Math.abs(e.pageY - sy) < 10) return;
            drag = true;
            tr.siblings().each(function() {               
            var s = $(this),
                i = s.index(),
                y = s.offset().top;
                i = parseInt(i)+1;
            if (i > 0 && e.pageY >= y && e.pageY < y + s.outerHeight()) {                              
                if (i < tr.index())
                tr.insertAfter(s);
                else
                tr.insertBefore(s);
                return false;
            }
            });
        }
        
        function up(e) {
            if (drag && si != tr.index()) {
            drag = false;
            
            var order_item_data = [];
            $(".banner_list_images_table").each(function() {
                var data_id = $(this).attr("data-id");
                order_item_data.push(data_id);
                });
            //alert(order_item_data);

            var saveData = $.ajax({
                type: 'POST',
                url: "update_baner_order.php",
                data: {'order_id_data':order_item_data},
                success: function(resultData) {
                     //alert(resultData) 
                    }
            });
                 
            }
            $(document).unbind("mousemove", move).unbind("mouseup", up);
            b.removeClass("grabCursor").css("userSelect", "none");
            tr.removeClass("grabbed");
        }
        $(document).mousemove(move).mouseup(up);
        });
    </script>
</body>

</html>