<div class="reward-list">

        <div class="items">
            <?php
                $selcte_reward_list  = "SELECT * from ".$table_prefix."spin_result where `user_id`='".$user_id_session."' order by id desc";
                $row_reward = $conn->query($selcte_reward_list);
                while($result_reward = mysqli_fetch_assoc($row_reward))
                {
                    $reward_item = str_replace('<br />','',urldecode($result_reward['reward_item']));
                    $user_email = $result_reward['user_email'];
                    $reward_id = $result_reward['id'];
                    $reward_id_hwe = $result_reward['reward_id'];
                    $redeem_used_hwe = $result_reward['redeem_used'];
                    
                     //get reward redeem details
                    $select_reward ="SELECT * from ".$table_prefix."wheel_data";
                    $row_reward_wheel = $conn->query($select_reward);
                    $result_reward_wheel = mysqli_fetch_assoc($row_reward_wheel);
                
                    $spin_data =  json_decode($result_reward_wheel['spin_data'],true);

                    $redeem_button_hide_show = $spin_data['redeem_button_hide_show'];
                    $redeem_buttom_hide_show='style="display:block;"';
                    if($redeem_button_hide_show == '1')                 {
                        $redeem_buttom_hide_show = 'style="display:none;"';
                    }           
                
                    $total_slices = $spin_data['slice'];
                   
                    $prize =array();
                    $redirect_onoff = 0;
                    $redirect_link_hwe = '';
                    for($i =0; $i <$total_slices; $i++ )
                    {
                        if($i==$reward_id_hwe) 
                        {
                            $redirect_link_hwe = $spin_data['reward_redirect_link_redeem'.$i];
                            $redirect_onoff = $spin_data['no_matter_reward_redirect_link_redeem'.$i];
                        }
                    }

                    if($redeem_used_hwe == 1)
                    {
                        $all_data .= '
                        <div class="item disabled after_redeem_change_button_'.$reward_id.'">
                            <button class="btn-redeem disabled" '.$redeem_buttom_hide_show.'><span disabled="disabled">USED</span></button>
                            <div class="value" data-value="'.$reward_item.'">'.$reward_item.'</div>
                        </div>
                      ';
                       
                    }
                    else
                    {
                        if(isset($spin_data['redeem_button_text']) && $spin_data['redeem_button_text'] != '')
                        {
                            $redeem_button = $spin_data['redeem_button_text'];
                        }
                        else
                        {
                            $redeem_button = 'REDEEM';
                        }

                        if($redirect_onoff==1)
                        {
                              $all_data .='
                                    <div class="item disabled after_redeem_change_button_'.$reward_id.'">
                                        <a  onclick="spin_result_redeem_used_update('.$reward_id.')" target="_blank" '.$redeem_buttom_hide_show.' href="'.$redirect_link_hwe.'" ><button class="btn-redeem"><span>'.$redeem_button.'</span></button></a>
                                        <div class="value" data-value="'.$reward_item.'">'.$reward_item.'</div>
                                    </div>
                              ';
                        }
                        else
                        {
                            $all_data .='
                                    <div class="item disabled after_redeem_change_button_'.$reward_id.'">
                                        <button class="btn-redeem" '.$redeem_buttom_hide_show.' onclick="redeem('.$reward_id.')"><span>'.$redeem_button.'</span></button>
                                        <div class="value" data-value="'.$reward_item.'">'.$reward_item.'</div>
                                    </div>
                              ';
                        }
                    }
                }

                echo $all_data;
            ?>

            <div class="item">
                <a href="<?php echo Front_URL; ?>/all_latest_reward.php" target="_blank" style="color: #fff;font-size: 20px;">View latest Rewards</a>
            </div>
        </div>


        
       
     </div>

     <div class="lucky_number_popup">

        <div class="items">
        
        </div>

    </div>
     
     <div class="lucky_number_popup_latest">

        <div class="items">

            <div class="items_hwe_data">

            </div>
            <div class="item" style="margin-top: 10px;">
                <a href="<?php echo Front_URL; ?>/all_latest_reward.php" target="_blank" style="color: #fff;font-size: 20px;">View latest Rewards</a>
            </div>
            
        </div>

       
        

    </div>
     <style>



.btn-redeem
{
    display:block;
}
   .lucky_number_popup
{
    z-index: 1000;
    visibility: hidden;
    position: fixed;
    left: 0;
    top: 0;
    bottom: 0;
    right: 0;
    background: rgba(0, 0, 0, 0.3);
} 
.lucky_number_popup .items
{
    justify-content: center;
    background: url(../img/reward_bg.jpg) no-repeat;
    background-size: auto;
    background-size: auto;
    background-size: 100% 100%;
    position: absolute;
    left: 50%;
    top: 50%;
    width: 500px;
    height: 70vh;
    -ms-transform: translate(-50%, -50%);
    transform: translate(-50%, -50%);
    -webkit-transform: translate(-50%, -50%);
    -webkit-box-sizing: border-box;
    box-sizing: border-box;
    border-radius: 8px;
    overflow: auto;
    padding: 2rem;
    opacity: 0.9;
}
.lucky_number_popup .items .item
{
    width: 100%;
  float: left;
  padding: 1em;
  -webkit-box-sizing: border-box;
  box-sizing: border-box;
  margin: 0.25em 0;
  border-radius: 10px;
  background: rgba(0, 0, 0, 0.3);
  margin-top:90px;
}
.lucky_number_popup_latest
{
    display: block;
    visibility: hidden;
    z-index: 1000;
    position: fixed;
    left: 0;
    top: 0;
    bottom: 0;
    right: 0;
    background: rgba(0, 0, 0, 0.3);
} 
.lucky_number_popup_latest .items
{
    justify-content: center;
    background: url(../img/reward_bg.jpg) no-repeat;
    background-size: auto;
    background-size: auto;
    background-size: 100% 100%;
    position: absolute;
    left: 50%;
    top: 50%;
    width: 500px;
    height: 70vh;
    -ms-transform: translate(-50%, -50%);
    transform: translate(-50%, -50%);
    -webkit-transform: translate(-50%, -50%);
    -webkit-box-sizing: border-box;
    box-sizing: border-box;
    border-radius: 8px;
    overflow: auto;
    padding: 2rem;
    opacity: 0.9;
}
.lucky_number_popup_latest .items .item
{
    width: 100%;
  float: left;
  padding: 1em;
  -webkit-box-sizing: border-box;
  box-sizing: border-box;
  margin: 0.25em 0;
  border-radius: 10px;
  background: rgba(0, 0, 0, 0.3);
  margin-top:90px;
}
.lucky_number_popup_latest .btn-redeem, .popup-container .btn
{
    display: block;
  float: right;
  width: 120px;
  font-size: 16px;
  font-weight: 600;
  color: #fff;
  cursor: pointer;
  margin: 5px;
  height: 55px;
  text-align: center;
  margin-right: 160px;
  border: none;
  background-size: 300% 100%;
  border-radius: 50px;
  -webkit-transition: all .4s ease-in-out;
  -o-transition: all .4s ease-in-out;
  transition: all .4s ease-in-out;
  background-image: -webkit-gradient(linear, left top, right top, from(#f5ce62), color-stop(#e43603), color-stop(#fa7199), to(#e85a19));
  background-image: -webkit-linear-gradient(left, #f5ce62, #e43603, #fa7199, #e85a19);
  background-image: -o-linear-gradient(left, #f5ce62, #e43603, #fa7199, #e85a19);
  background-image: linear-gradient(to right, #f5ce62, #e43603, #fa7199, #e85a19);
  -webkit-box-shadow: 0 4px 15px 0 rgba(229, 66, 10, 0.75);
  box-shadow: 0 4px 15px 0 rgba(229, 66, 10, 0.75);
  text-transform: uppercase;
}
.lucky_number_popup_latest .value
{
    font-size: 50px;
    line-height: 65px;
    color: #fff;
    float: left;
    width: 100%;
text-align: center;
}
.img_url_parent
{
    justify-content: center;
    display: flex;
}

.img_url_single_reward
{
    width: 28%;
}
@media only screen and (max-width:600px)
{
    .lucky_number_popup .items
    {
        width:90% !important;
    }

    .lucky_number_popup_latest .items
    {
        width:90% !important;
    }
}



        </style>