<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<?php
$select_menu ="SELECT * from ".$table_prefix."wheel_data";
$rowmenu = $conn->query($select_menu);
$resultmenu = mysqli_fetch_assoc($rowmenu);

$menu_data =  json_decode($resultmenu['spin_data'],true);

$home_menu_url= "";
if(isset($menu_data['home_menu_url']))
{
    $home_menu_url = $menu_data['home_menu_url'];
}
$share_menu_url= "";
if(isset($menu_data['share_menu_url']))
{
    $share_menu_url = $menu_data['share_menu_url'];
}
$account_menu_url= "";
if(isset($menu_data['account_menu_url']))
{
    $account_menu_url = $menu_data['account_menu_url'];
}

if($home_menu_url != '')
{
    $home_url = $home_menu_url;
    $open_in_new_window = 'target="_blank"';
}
else
{
    $home_url = Front_URL;
    $open_in_new_window = '';
}
if($share_menu_url != '')
{
    $share_url = $share_menu_url;
    $share_id = 'wheel-data-share-on-app_hwe';
    $open_in_new_window = 'target="_blank"';
}
else
{
    $share_url = 'javascript:void(0)';
    $share_id = 'wheel-data-share-on-app';
    $open_in_new_window = '';
}
if($account_menu_url != '')
{
    $account_url = $account_menu_url;
    $account_page_open = '';
    $open_in_new_window = 'target="_blank"';
}
else
{
    $account_url = 'javascript:void(0)';
    $account_page_open = 'onclick="openNav()"';
    $open_in_new_window = '';
}

$home_menu_text='Home';
if($menu_data['home_menu_text'] != '')
{
    $home_menu_text = str_replace('<br />','',urldecode($menu_data['home_menu_text']));
}

$home_menu ='<a href="'.$home_url.'" id="home_url" '.$open_in_new_window.'>
            <li >
                <div class="menu_site"><img class="img_set" src="img/home.png" style="width: 57px;"></div>
                <div class="set_size_menu">'.$home_menu_text.'</div>
            </li>
            </a>';

$share_menu_text='Share';
if($menu_data['share_menu_text'] != '')
{
    $share_menu_text = str_replace('<br />','',urldecode($menu_data['share_menu_text']));
}

$message_menu_text='Message';
if($menu_data['message_menu_text'] != '')
{
    $message_menu_text = str_replace('<br />','',urldecode($menu_data['message_menu_text']));
}

$account_menu_text='Account';
if($menu_data['account_menu_text'] != '')
{
    $account_menu_text = str_replace('<br />','',urldecode($menu_data['account_menu_text']));
}


$share_menu ='<a href="'.$share_url.'" id="'.$share_id.'" '.$open_in_new_window.'>
<li>
    <div class="menu_site"><img class="img_set" src="img/share.png"  style="width: 57px;"></div>
    <div class="set_size_menu">'.$share_menu_text.'</div>
</li>
</a>';

$message_menu ='<a href="'.$live_chat_menu_url.'" target="_blank">
<li>
    <div class="menu_site"><img class="img_set" src="img/live_chat.png"  style="width: 57px;"></div>
    <div class="set_size_menu">'.$message_menu_text.'</div>
</li>
</a>';

$account_menu ='<a href="'.$account_url.'" '.$account_page_open.' '.$open_in_new_window.'>
<li>
    <div class="menu_site"><img class="img_set" src="img/logout.png"  style="width: 57px;"></div>
    <div class="set_size_menu">'.$account_menu_text.'</div>
</li>
</a>';

$logout_side_menu='Logout';
if($menu_data['logout_side_menu'] != '')
{
    $logout_side_menu = str_replace('<br />','',urldecode($menu_data['logout_side_menu']));
}

$share_menu_sidebar_text='Spin History';
if($menu_data['share_menu_sidebar_text'] != '')
{
    $share_menu_sidebar_text = str_replace('<br />','',urldecode($menu_data['share_menu_sidebar_text']));
}

$message_menu_sidebar_text='Redeem Point';
if($menu_data['message_menu_sidebar_text'] != '')
{
    $message_menu_sidebar_text = str_replace('<br />','',urldecode($menu_data['message_menu_sidebar_text']));
}

$account_menu_sidebar_text='Contact Us';
if($menu_data['account_menu_sidebar_text'] != '')
{
    $account_menu_sidebar_text = str_replace('<br />','',urldecode($menu_data['account_menu_sidebar_text']));
}



$user_id_label='ID';
if($menu_data['user_id_label'] != '')
{
    $user_id_label = str_replace('<br />','',urldecode($menu_data['user_id_label']));
}

$remaining_spin_label='Remaining Spin';
if($menu_data['remaining_spin_label'] != '')
{
    $remaining_spin_label = str_replace('<br />','',urldecode($menu_data['remaining_spin_label']));
}

$earned_points_label='Earned Points';
if($menu_data['earned_points_label'] != '')
{
    $earned_points_label = str_replace('<br />','',urldecode($menu_data['earned_points_label']));
}

$uuid_label='UUID';
if($menu_data['uuid_label'] != '')
{
    $uuid_label = str_replace('<br />','',urldecode($menu_data['uuid_label']));
}


$bottom_bg_color='#2eb8ce';
if(isset($menu_data['select_bottom_bg_menu_option']) && $menu_data['select_bottom_bg_menu_option'] == '1')
{
    $bottom_bg_color = $menu_data['bottom_menu_bg_color'];

}

$side_menu_bg_color='rgba(237,195,47,255)';
if(isset($menu_data['select_side_bg_menu_option']) && $menu_data['select_side_bg_menu_option'] == '1')
{
    $side_menu_bg_color = $menu_data['side_menu_bg_color'];

}




if(isset($menu_data['home_menu_image_checkbox']) && $menu_data['home_menu_image_checkbox'] == '1')
{
   
    $home_menu_image = 'admin_panel/pages/'.$menu_data['home_menu_image'];

    $home_menu = '<a href="'.$home_url.'" id="home_url" '.$open_in_new_window.'>
    <li >
        <div class="menu_site" style="height:auto;"><img class="img_set" src="'.$home_menu_image.'" style="width: 40px !important;margin-top:12px;"></div>
        
    </li>
    </a>';
}

if(isset($menu_data['share_menu_image_checkbox']) && $menu_data['share_menu_image_checkbox'] == '1')
{
   
    $share_menu_image = 'admin_panel/pages/'.$menu_data['share_menu_image'];

    $share_menu = '<a href="'.$share_url.'" id="'.$share_id.'" '.$open_in_new_window.'>
    <li>
        <div class="menu_site" style="height:auto;"><img class="img_set" src="'.$share_menu_image.'"  style="width: 40px !important;margin-top:12px;"></div>
        
    </li>
    </a>';
}

if(isset($menu_data['message_menu_image_checkbox']) && $menu_data['message_menu_image_checkbox'] == '1')
{
   
    $message_menu_image = 'admin_panel/pages/'.$menu_data['message_menu_image'];

    $message_menu = '<a href="'.$live_chat_menu_url.'" target="_blank">
    <li>
        <div class="menu_site" style="height:auto;"><img class="img_set" src="'.$message_menu_image.'"  style="width: 40px !important;margin-top:12px;"></div>
        
    </li>
    </a>';
}

if(isset($menu_data['account_menu_image_checkbox']) && $menu_data['account_menu_image_checkbox'] == '1')
{
   
    $account_menu_image = 'admin_panel/pages/'.$menu_data['account_menu_image'];

    $account_menu = '<a href="'.$account_url.'" '.$account_page_open.' '.$open_in_new_window.'>
    <li>
        <div class="menu_site" style="height:auto;"><img class="img_set" src="'.$account_menu_image.'"  style="width: 40px !important;margin-top:12px;"></div>
        
    </li>
    </a>';
}
?>
<div class="footer" style="position:fixed;">
    <div class="footer-text">

            <ul class ="footer_ul">
     
                
                <?php echo $home_menu; ?>
                <?php echo $share_menu; ?>
                <?php echo $message_menu; ?>
                <?php echo $account_menu; ?>
               
              
              
            </ul>
              
           
        </div>
</div>
<div id="mySidenav" class="sidenav" style="z-index: 999999;">
		  <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
		  
		  <a href="<?php echo Front_URL; ?>"><i class="fa fa-home side_bar" aria-hidden="true"></i><?php echo $home_menu_text; ?></a>

          <?php
           if($user_login_sp == '1' || $user_login_register_method == 1)
            {

            ?>
		    <a href="all_latest_reward.php"><i class="fa fa-spinner side_bar" aria-hidden="true"></i></i><?php echo $share_menu_sidebar_text; ?></a>
            <?php
            }

            
         
            if($share_referrel == '1' || (($user_login_sp == '1' || $user_login_register_method == 1) && $reward_point_login_method == '1'))
            {
                ?>
                <a href="share_redeem_data_show.php"><i class="fa fa-spinner side_bar" aria-hidden="true"></i></i><?php echo $message_menu_sidebar_text; ?></a>
                <?php
            }
      
            ?>
		    <a href="user_contact_form.php"><i class="fa fa-map-marker side_bar" aria-hidden="true"></i><?php echo $account_menu_sidebar_text; ?></a>

            <?php
           if($user_id_session != '')
           {

            ?>
             
                <a href="user_logout.php"><i class="fa fa-sign-in side_bar" aria-hidden="true"></i><?php echo $logout_side_menu; ?></a>
             <?php
           }
          ?>

        <?php 
        if(isset($user_id_session) && $user_id_session != '')
        {

            $sql_hwe="select * from ".$table_prefix."user_table where id='".$user_id_session."'";
            $result_hwe=mysqli_query($conn,$sql_hwe);
            $user_redeem_point=0;
            if($result_hwe){
                while($row_hwe=mysqli_fetch_assoc($result_hwe))
                {
                    
                    $username_hwe1=$row_hwe['username'];
                    $userpassword_hwe1=$row_hwe['user_password'];
                    $remspin=$row_hwe['user_total_spin'];

                    $user_redeem_point=$row_hwe['user_redeem_point'];
                    $UUID='';
                    if(isset($row_hwe['UUID']))
                    {
                        $UUID=$row_hwe['UUID'];
                    }
                    
            
                }
            }
        ?>
        <div class="custom_reamin_spin_show">
            <div><?php echo $user_id_label; ?>: <?php echo $username_hwe1; ?></div>
            <!-- <div>Password: <?php echo $userpassword_hwe1; ?></div> -->
            <div><?php echo $remaining_spin_label; ?>: <?php echo $remspin; ?></div>
            <?php
            if($share_referrel == '1' || $reward_point_login_method == '1')
            {
                ?>
                <div><?php echo $earned_points_label; ?>: <?php echo $user_redeem_point; ?></div>
                <?php
            }
            ?>
            
            <div><?php echo $uuid_label; ?>: <?php echo $UUID; ?></div>
        </div>
        <?php
        }
        ?>
          
</div>


<style>
.pointer_events_hwe
{
    pointer-events: none;
}

.custom_reamin_spin_show
{
    position: absolute;
    bottom: 0px;
    font-size: 15px;
    padding: 41px;
    font-weight: bold;
}
.footer {
	position: absolute;
	width: 100%;
	max-width: 600px;
	/* background-image: -webkit-linear-gradient(50deg, #ffa000, #ffa000);
	background-image: -o-linear-gradient(50deg, #ffa000, #ffa000);
	background-image: linear-gradient(40deg, #ffa000, #ffa000); */
	bottom: 0;
	left: 50%;
	-webkit-transform: translateX(-50%);
	-ms-transform: translateX(-50%);
	transform: translateX(-50%);
	-webkit-box-shadow: 0 0 15px #222;
	box-shadow: 0 0 15px #222;
	text-align: center;
	color: #fff;
	border-top-left-radius: 5px;
	border-top-right-radius: 5px;
    z-index: 99;
    background-color: <?php echo $bottom_bg_color; ?>;
    
}
.footer .footer-text {
	/* padding: 7px; */
    padding: 0px;
    font-size:129%;
    /* padding-top: 13px; */
    padding-top: 0px;
}
.footer_ul
{
    display: flex;
    list-style: none;
    padding-left: 0px;
    margin-bottom: 0px !important;
}
.footer_ul li
{
   
    color: #fff;
    padding-bottom: 6px;
    
}

.footer_ul a
{
    width:33.33%;
}
.set_size_menu
{
    font-size:12px;
    font-weight: 600;
}

/* style for account page design */

.sidenav {
			    height: 100%; 
			    width: 0; 
			    position: fixed; 
			    z-index: 1; 
			    top: 0;
			    background-color: <?php echo $side_menu_bg_color; ?>;
			    overflow-x: hidden; 
			    padding-top: 60px; 
			    transition: 0.5s; 
			}

			
			.sidenav a {
			    padding: 8px 8px 8px 32px;
			    text-decoration: none;
			    font-size: 18px;
			    color: #fff;
			    display: block;
			    transition: 0.3s;
			    font-weight: bold;
			}

			
			.sidenav a:hover, .offcanvas a:focus{
			    background: white ;
			    color: black;
			}

			
			.sidenav .closebtn {
			    position: absolute;
			    top: 0;
			    right: 25px;
			    font-size: 36px;
			    margin-left: 50px;
			}

			
			#main {
			    transition: margin-left .5s;
			    padding: 20px;
			}
			.sidenav {
			    right: 0;
			}
		
			@media screen and (max-height: 450px) {
			    .sidenav {padding-top: 15px;}
			    .sidenav a {font-size: 18px;}
			}
			.sidenav {
			    right: 0;
			}

			.fa.fa {
  			margin-right: 16px;
  			font-size: 20px;
			}

			
	
/* end account page design */

</style>
<?php
    if($user_login_sp == '1' || $user_login_register_method == '1')
    {
        ?>
        <style>
        .footer_ul a
        {
            width:25% !important;
        }
        </style>
        <?php
    }
    ?>
    <?php 
    // pass web-site url
    $site_url  = "http://www.onlinecode.org/blog";
    // post title
    $site_title  = "onlinecode";

//ramkishan
    if($share_content_text != "")
    {
        $share_content_text_hwe = $share_content_text;
    }
    else
    {
        $share_content_text_hwe = "Win A Car | Win a Television";

    }

    if($share_content_title != "")
    {
        $share_content_title_hwe = $share_content_title;
    }
    else
     {
         $share_content_title_hwe = "Loyalty Wheel Spins";
         
     }
     
     if($share_referrel != "1" && $share_content_Url !='')
     {
        $share_referrel_hwe1 = $share_content_Url ;
     }

     elseif($share_referrel == "1")
     {
        $share_referrel_hwe1 = Front_URL.'?ref='.$user_id_session;
     }

     else
     {
        $share_referrel_hwe1 = Front_URL ;
     }
 
     
  

?>
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> -->
<script>

    function openNav() {
	    document.getElementById("mySidenav").style.width = "277px";
	}

	function closeNav() {
	    document.getElementById("mySidenav").style.width = "0";
	}

  jQuery(document).ready(function(){
   
    
    jQuery('#wheel-data-share-on-app').on('click', () => {
        var site_url = '<?php echo $share_referrel_hwe1;  ?>';
      if (navigator.share) {
        navigator.share({
            title: '<?php echo $share_content_title_hwe; ?>',
            text: '<?php echo $share_content_text_hwe; ?>',
            url: site_url,
          })
          .then(() => console.log('Successful share'))
          .catch((error) => console.log('Error sharing', error));
      } else {
        console.log('Share not supported on this browser, do it the old way.');
      }
    });

    
    
  });

</script>