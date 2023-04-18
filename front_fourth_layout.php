<?php
if($reward_list_effect == '1')
{
        $select="select player_id,reward from ".$table_prefix."top_winner order by rand()";
        $result=mysqli_query($conn,$select);
        $winners_list_show='';
        if($result)
        { 
        
            while($row=mysqli_fetch_assoc($result))
            {
                $generate_code  =  $row['player_id'];
                $rewards  =  $row['reward'];
                 
                //$winners_list_show .='<div class="winners_list_scroll"> Player <span class="winners_list_player_id"> '.$generate_code.'</span> Reward <span class="winners_list_reward">'.$rewards.'</span></div>';
                $winners_list_show .='<li class="winners_list_scroll"> Congrat <span class="winners_list_player_id"> '.$generate_code.'</span> get <span class="winners_list_reward">'.$rewards.'</span></li>';
            }

        }
}
$id1=$_SESSION['user_id'];


$sql="select * from ".$table_prefix."user_table where id='$id1'";
$result=mysqli_query($conn,$sql);
if($result){
while($row=mysqli_fetch_assoc($result))
{
    
$usernew=$row['username'];
$remspin=$row['user_total_spin'];
}
}
?>

</div>
   <!-- <div id="scroll-container">
        <div id="scroll-text">
            <?php
            //echo $winners_list_show;
            ?>
        <div>
    </div>
</div>
</div> -->
<!-- <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet"> -->

<?php
if(isset($_SESSION['user_id']))
{
?>
    <div class="reamin_spin_show">
        <b>
            <p class="remaining_spin_hwe" style="position: absolute;z-index: 100000;color: <?php echo $reamin_spin_text_color; ?>;text-align: center;left: 0;right: 0;font-size: 20px;">You have <span class="remain_spin_value_hwe"><?php echo $remspin; ?></span> chances left today.</p>
        </b>
    </div>
<?php
}
?>
<link href="customn_library/font_awasom.css" rel="stylesheet">
<?php
if($reward_list_effect == '1')
{
    ?>
        <div class="content">
        <div class="content__container">
            <ul class="content__container__list">
                <?php
                    echo $winners_list_show;
                ?>
            </ul>
        </div>
        </div>
        <style>
                /* @media only screen and (min-width:768px)
                {
                
                    #viewBox
                    {
                    right:20%;
                    }
                
                } */
        </style>
    <?php
}


?>
<style>
@media only screen and (max-width:767px)
{
    .remaining_spin_hwe {


         margin-top: 5%;
        font-size: 16px!important;
        position: sticky !important;
    }


    .custon_banner_show 
    {

        bottom: 0!important;
    }


    .custon_banner_show .footer-text

    {
         
	padding: 0px!important;
	font-size: 129%;
	padding-top: 23px;


    }
}
</style>

<div class="custon_banner_show">
        <div class="footer-text">
            <?php

                if($slider_banner == 1)
                {
                   include 'slider_banner_second_layout.php';
                }
                else
                {
                ?>
                    <style>
                        .remaining-spin-times
                            {
                                /* top:182px !important; */
                                top:498px !important;
                            }
                            .reward-list-all 
                            {
                                /* top:-31px !important; */
                                top:577px !important;
                                

                            }
                                                                            


                    </style>



                <?php 
                }
                ?>
    </div>
</div>
   

    <?php

   
    if($second_layout_sp == '1' || $fourth_layout_sp == '1')
    {
        ?>
            <div class="custom_login_button_user" style="width:95%;">
                <img src="<?php echo 'admin_panel/pages/'.$site_logo_hwe; ?>" style="width: 50px;">
            </div>
            <style>
                    .custom_login_button_user
                    {
                        position: absolute;
                        top: 6px;
                        font-size: 32px;
                        color: #fff;
                        cursor:pointer;
                        text-align: left;
                    }
                    .custom_login_button_user img
                    {
                        width :240px !important;
                    }
                    @media only screen and (max-width:767px)
                    {
                        .custom_login_button_user
                        {
                        
                            text-align: left !important;
                            position: absolute;
                            top: 18px;
                            font-size: 32px;
                            color: #fff;
                            right: 0px;
                            cursor:pointer;
                            
                            
                        }
                        .custom_login_button_user img
                        {
                            width :120px !important;
                        }
                
                    }
                    @media only screen and (min-width: 768px)
                    {
                        .custom_login_button_user
                        {
                            left: 42px;
                            top: 0px !important;
                        }
                    }
            </style>
        <?php
    }
    
    if($code_sp == '1' || $mobile_number_sp == '1' || $code_with_remain_spin_sp == '1' || $email_method== '1' || $name_email_mobileno == '1'  || $normal_spin_method == '1')
    {
    }
    else
    {
    ?>
 
   <!-- BURGER MENU -->
    <style>
        .burger-menu
        {
            right: 20px !important;
            top: 20px !important;
        }

        @media only screen and (min-width: 768px)
        {

            .burger-menu
            {
                right: 50px !important;
                top: 50px !important;
            }
            .custom_login_button_user
            {
                left: 42px;
                top: 0px !important;
            }
        }
    </style>
    <?php
    if($reward_icon_change == '')
    {
        ?>
        <div class="burger-menu">
            <span class="active"></span>
            <span class="active"></span>
            <span class="active"></span>
            <div class="counter">...</div>
        </div>
        <?php
    }
    else
    {
        ?>
        <div class="burger-menu">
        <span class="active"></span>
        <span class="active"></span>
        <span class="active"></span>
        <div class="counter">...</div>
          
        </div>
        <img src="<?php echo 'admin_panel/pages/'.$reward_icon_change; ?>" class="reward_icon_list">
<style>
@media only screen and (min-width:768px)
{
    .reward_icon_list
    {
        position: absolute;
        right: 50px !important;
        top: 34px !important;
        width: 55px;
        height: 55px;
    }
    .burger-menu
    {
        opacity:0 !important;
    }
}
@media only screen and (max-width:767px)
{
    .reward_icon_list
    {
        position: absolute;
        right: 20px !important;
        top: 16px !important;
        width: 40px;
        height: 40px;
    }
    .burger-menu
    {
        opacity:0 !important;
    }
}

</style>
        <?php
    }

}
    ?>
    <span class="close custom_hide_icon">&times;</span>

    <script>
    jQuery(document).ready(function(){

        jQuery(".custom_hide_icon").on("click",function(){
     
            var check_icon_upload_or_not ='<?php echo $reward_icon_change; ?>';

            jQuery(this).css("z-index","0");
            jQuery(this).css("opacity","0");
            if(check_icon_upload_or_not == '')
            {
                jQuery('.burger-menu').css("opacity","1");
                jQuery('.reward_icon_list').css("opacity","0");
             }
            else
            {
                jQuery('.burger-menu').css("opacity","0");
                jQuery('.reward_icon_list').css("opacity","1");
            }
            
            

            jQuery('.reward-list').removeClass("show");
            jQuery('.reward-list').css('transform', 'scale(0)');
            jQuery('.reward-list').css('visibility', 'hidden');

            jQuery('.lucky_number_popup_latest').css('transform', 'scale(0)');
            jQuery('.lucky_number_popup_latest').css('visibility', 'hidden');

            jQuery('.lucky_number_popup').css('transform', 'scale(0)');
            jQuery('.lucky_number_popup').css('visibility', 'hidden');
        });
    });
 </script>
   <style>
    @media only screen and (min-width:768px)
    {
        .custom_hide_icon
        {
            position: absolute;
            right: 50px !important;
            top: 34px !important;
            width: 55px;
            height: 55px;
            color:red;
            opacity:0;
            font-size: 64px;
            
        }
        
    }
    @media only screen and (max-width:767px)
    {
        .custom_hide_icon
        {
            position: absolute;
            right: 20px !important;
            top: 16px !important;
            width: 40px;
            height: 40px;
            color:red;
            opacity:0;
            font-size: 64px;
           
        }
        
    }
    </style>
    
    
    <!-- REWARD LIST OF PLAYER -->
    
    <style>
.menu_site
{
    height: 30px;
    
}
.img_set
{
    margin-top: -6px;
    width:52px !important;
}
@media only screen and (max-width:767px)
{

    
    .winners_list_scroll
    {
        font-size :17px !important;
    }
    .content__container__list
    {
        padding-left: 0px !important;
    }
    .custon_banner_show
    {
        position: absolute;
        width: 100%;
        max-width: 600px;
        background-image: -webkit-linear-gradient(50deg, #ffa000, #ffa000);
        background-image: -o-linear-gradient(50deg, #ffa000, #ffa000);
        background-image: linear-gradient(40deg, #ffa000, #ffa000);
       
        left: 50%;
        -webkit-transform: translateX(-50%);
        -ms-transform: translateX(-50%);
        transform: translateX(-50%);
        text-align: center;
        color: #fff;
        border-top-left-radius: 5px;
        border-top-right-radius: 5px;
        z-index: 99;
        
    
    }
    #viewBox
    {
        height: 488px !important;
    }

    .content__container {
        padding-left: 0px !important;
        width: 86%;
        height: 175px!important;
    }

}
@media only screen and (min-width:768px)
{
   
    .add_banner
    {
        padding:0px !important;
    }
    .custon_banner_show
    {
        bottom: 0px !important;
        /* position:absolute !important; */
        position: inherit !important;
        top:100%;
        margin-bottom: 52px;
        /* margin-top: 20px; */
        
    }
    #scroll-container
    {
        margin-top: 43px;
    }

    .custon_banner_show .footer-text {
        padding: 0px !important;
        padding-top: 23px !important;
 
    }
    .content
    {
        position: absolute;
        top: 55%;
        right: 0;
    }

    #viewBox
    {
        height : 800px !important;
   
    }
    
    
    
}

.add_banner
{
    width:100%;
}
.custon_banner_show
{
    position:fixed;
    bottom: 43px;
    background-image: none !important;
}

.custon_banner_show .footer-text {
	padding: 10px;
    font-size:129%;
    padding-top: 23px;
}
.footer .footer-text {
	/* padding: 7px; */
    padding: 0px;
    font-size:129%;
    /* padding-top: 13px; */
    padding-top: 0px;
}
#drawing
{
    margin-top:95px;
}

.winners_list_scroll
{
    font-size: 20px;
    color:yellow;
    font-weight: bold;
}
.winners_list_player_id
{
    color: #2eb8ce;
}
.winners_list_reward
{
    font-weight: bold;
    color: red;
}
</style>
<script>
    // Twitter @YoannHELIN
</script>
<style>
    /* css for current code */
.content {
  margin-top: 10px; 
  justify-content: center;
  display: flex;
  /* height: 130px; */
  overflow: hidden;
  font-family: "Lato", sans-serif;
  font-size: 35px;
  line-height: 40px;
  color: #ecf0f1;
}
.content__container {
  font-weight: 600;
  overflow: hidden;
  height: 92px;
  padding: 0 40px;
}

.content__container__text {
  display: inline;
  float: left;
  margin: 0;
}
.content__container__list {
  margin-top: 70px;
  padding-left: 110px;
  text-align: left;
  list-style: none;
  -webkit-animation-name: change;
  -webkit-animation-duration: 10s;
  -webkit-animation-iteration-count: infinite;
  animation-name: change;
  animation-duration: 5s;
  animation-iteration-count: infinite;
}
.content__container__list__item {
  line-height: 55px;
  margin: 0;
  font-size: 30px;

}

@keyframes change {
  0%   {transform: translateY(-10%)}
  25%  {transform: translateY(-25%)}
  50%  {transform: translateY(-50%)}
  75%  {transform: translateY(-75%)}
  100% {transform: translateY(-100%)}

}

.custon_banner_show
{
    margin-bottom: 0px !important;
}
</style>