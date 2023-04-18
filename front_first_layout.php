<?php

            if($slider_banner == 1)
            {

               include 'slider_banner.php';
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

    <?php 
    if($code_sp == '1' || $mobile_number_sp == '1' || $code_with_remain_spin_sp == '1' || $email_method== '1' || $name_email_mobileno == '1'  || $normal_spin_method == '1')
    {
        
    }
    else
    {
        ?>
            <div class="remaining-spin-times">
                <div class="block-header">Remaining Spin</div>
                <div class="l box"><span><?echo $rem1;?></span></div>
                <div class="r box"><span><?echo $rem2;?></span></div>
            </div>
        <?php
    }
        ?>
   

    <div class="reward-list-all">
        <div class="sum">
            <div class="name">Total reward winning</div>
            <div class="value"></div>
        </div>
        <div class="new">
            <div class="block-header">Top 5 Winners</div>


                <div class="items">
                    <?php
                    $select="select player_id,reward from ".$table_prefix."top_winner order by rand() limit 5";
                    $result=mysqli_query($conn,$select);
                    if($result)
                    { 
                    
                        while($row=mysqli_fetch_assoc($result))
                        {
                            $generate_code  =  $row['player_id'];
                            $rewards  =  $row['reward'];

                            echo '<div class="item">
                            <div class="icon c-col"></div>
                            <div class="player-name c-col">  	
                            &#11088;'.$generate_code.' </div>
                            <div class="reward-value c-col">'.$rewards.'</div>
                        </div>';
                        }

                    }
                    ?>
                    
                </div>
            </div>
        </div>

    </div>

    <div class="footer" style="position:fixed;">
        <div class="footer-text">
            <p>Welcome <strong class="player-id">
                <?php echo $usernew; ?></strong> </p>
                <?php 
           
           
                    if(isset($user_id_session) && ($user_id_session!='') ){
                    ?><a href="<?php echo Front_URL; ?>/user_logout.php" id="user_login_button" style="color: #fff;"> <div class="logout">Logout</div></a><?php } ?><p></p>
        </div>
    </div>
    <?php
    if($code_sp == '1' || $mobile_number_sp == '1' || $code_with_remain_spin_sp == '1' || $email_method== '1' || $name_email_mobileno == '1')
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
                top: 28px !important;
            }
        
        }
    </style>
    <div class="burger-menu">
        <span class="active"></span>
        <span class="active"></span>
        <span class="active"></span>
        <div class="counter">...</div>
    </div>
    <!-- REWARD LIST OF PLAYER -->
    <?php
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

    <style>
.sum {
	background: #222;
	color: #f5ce62;
	display: inline-block;
	padding: 10px;
	text-align: center;
	width: 100%;
	border-bottom-left-radius: 5px;
	border-bottom-right-radius: 5px;
	margin-bottom: 30px;
	-webkit-box-sizing: border-box;
	box-sizing: border-box;
	border: 5px solid;
	border-image-source: linear-gradient(45deg, #f5ce62, #45cafc);
	border-image-slice: 1;
	-webkit-box-shadow: 0 0 15px #f5ce62;
	box-shadow: 0 0 15px #f5ce62;
} 
 @media only screen and (max-width:767px) {
.sum {
	background: #222;
	color: #f5ce62;
	display: inline-block;
	padding: 10px;
	text-align: center;
	width: 99% !important;
	border-bottom-left-radius: 5px;
	border-bottom-right-radius: 5px;
	margin-bottom: 5px;
	-webkit-box-sizing: border-box;
	box-sizing: border-box;
	border: 5px solid;
	border-image-source: linear-gradient(45deg, #f5ce62, #45cafc);
	border-image-slice: 1;
	-webkit-box-shadow: 0 0 15px #f5ce62;
	box-shadow: 0 0 15px #f5ce62;
}
 }
.sum .name {
	font-size: 16px;
	display: inline-block;
	margin-bottom: 10px;
}

.sum .value {
	font-size: 24px;
	font-weight: 600;
}
.reward-list-all {
	position: absolute;
	right: 10px;
	top: 180px;
	-webkit-transform: translate(0%, 0%);
	-ms-transform: translate(0%, 0%);
	transform: translate(0%, 0%);
	width: 280px;
	color: #fff;
	-webkit-transition: all 0.5s;
	-o-transition: all 0.5s;
	transition: all 0.5s;
}

@media only screen and (max-width:767px){
    .reward-list-all {
	position: sticky;
    left: 6%;
    /* top: 577px; */
    top: 775px;
	-webkit-transform: translate(0%, 0%);
	-ms-transform: translate(0%, 0%);
	transform: translate(0%, 0%);
	width: 88% !important;
	color: #fff;
	-webkit-transition: all 0.5s;
	-o-transition: all 0.5s;
	transition: all 0.5s;
   
    padding-bottom: 73px;
}

    #viewBox
    {
        height: 100% !important;
    }
}

.reward-list-all .block-header {
	background-image: -webkit-linear-gradient(50deg, #ffa000, #ffa000);
	background-image: -o-linear-gradient(50deg, #ffa000, #ffa000);
	background-image: linear-gradient(40deg, #ffa000, #ffa000);
	padding: 20px;
	border-top-left-radius: 5px;
	border-top-right-radius: 5px;
    text-align: center;
    font-weight:bold;
    font-size: 20px;
}
.reward-list-all .items {
	background: rgba(0, 0, 0, 0.6);
	border-bottom-left-radius: 5px;
	border-bottom-right-radius: 5px;
	-webkit-box-shadow: 0 0 15px #222;
	box-shadow: 0 0 15px #222;
    text-align: left;
}
.reward-list-all .item {
	position: relative;
	border-bottom: 1px solid #ddd;
	-webkit-box-sizing: border-box;
	box-sizing: border-box;
	padding: 10px;
	margin: 0 8px;
}

.reward-list-all .item .icon {
	background-image: url(../img/icon.svg);
	background-size: cover;
	background-repeat: no-repeat;
	width: 15px;
	height: 15px;
}
.reward-list-all .item .player-name {
	white-space: nowrap;
	margin-left: 5px;
    font-size:18px;
    font-weight: bold;
}

.reward-list-all .item .reward-value {
	background: red;
	padding: 8px;
	border-radius: 5px;
	position: absolute;
	right: 5px;
	top: 50%;
	-webkit-transform: translateY(-50%);
	-ms-transform: translateY(-50%);
	transform: translateY(-50%);
	width: auto;
	min-width: 40px;
	text-align: right;
}
.footer {
	position: absolute;
	width: 100%;
	max-width: 600px;
	background-image: -webkit-linear-gradient(50deg, #ffa000, #ffa000);
	background-image: -o-linear-gradient(50deg, #ffa000, #ffa000);
	background-image: linear-gradient(40deg, #ffa000, #ffa000);
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
}

.footer .footer-text {
	padding: 10px;
    font-size:129%;
    padding-top: 23px;
}
.logout {
	position: absolute;
	right: 10px;
	top: 50%;
	-webkit-transform: translateY(-50%);
	-ms-transform: translateY(-50%);
	transform: translateY(-50%);
	text-decoration: underline;
	cursor: pointer;
}


.remaining-spin-times {
	position: absolute;
	left: 10px;
	
	background: rgba(0, 0, 0, 0.6);
	-webkit-transform: translateY(-50%);
	-ms-transform: translateY(-50%);
	transform: translateY(-50%);
	width: 160px;
	height: 160px;
	color: #fff;
	border-radius: 5px;
	padding: 5px;
	white-space: nowrap;
	-webkit-box-shadow: 0 0 15px #222;
	box-shadow: 0 0 15px #222;
}
@media only screen and (max-width:767px)
{
    .remaining-spin-times {
	position: sticky;
    left: 33%;
    background: rgba(0, 0, 0, 0.6);
	-webkit-transform: translateY(-50%);
	-ms-transform: translateY(-50%);
	transform: translateY(-50%);
	width: 139px;
	height: 125px;
	color: #fff;
	border-radius: 5px;
	padding: 5px;
	white-space: nowrap;
	-webkit-box-shadow: 0 0 15px #222;
	box-shadow: 0 0 15px #222;
    
}

}


.remaining-spin-times .block-header {
	background-image: -webkit-linear-gradient(50deg, #ffa000, #ffa000);
	background-image: -o-linear-gradient(50deg, #ffa000, #ffa000);
	background-image: linear-gradient(40deg, #ffa000, #ffa000);
	padding: 20px;
	border-top-left-radius: 5px;
	border-top-right-radius: 5px;
    font-size:90%;
}
.remaining-spin-times .box {
	width: calc(50% - 4px);
	display: inline-block;
	position: relative;
	height: calc(100% - 55px);
	text-align: center;
	border: 1px solid rgba(255, 255, 255, 0.3);
}

.remaining-spin-times .box span {
	position: absolute;
	left: 50%;
	top: 50%;
	-webkit-transform: translate(-50%, -50%);
	-ms-transform: translate(-50%, -50%);
	transform: translate(-50%, -50%);
	font-size: 30px;
	font-weight: 600;
}



.new {

    border-style:solid;
}

@media only view and (max-width:767px){

    .new {

        border-width:thick;
        border-style:inset;
    }
}
</style>
    