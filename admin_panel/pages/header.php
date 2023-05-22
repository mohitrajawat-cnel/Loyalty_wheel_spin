<aside
    class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3   bg-gradient-dark"
    id="sidenav-main">
    <div class="sidenav-header text-center pt-4">
      
      <h4 style="color: #fff;">Loyality Wheel Spin</h4>
    </div>
    <hr class="horizontal light mt-0 mb-2">
    <div class="collapse navbar-collapse  w-auto  max-height-vh-100" id="sidenav-collapse-main">
      <ul class="navbar-nav">

        <li class="nav-item">
          <a class="nav-link text-white active bg-gradient-primary" href="../pages/users.php">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">table_view</i>
            </div>
            <span class="nav-link-text ms-1">Loyality Wheel</span>
          </a>
        </li>
        <?php if($code_sp == '1' || $mobile_number_sp == '1' || $code_with_remain_spin_sp == '1' || $email_method == '1' || $name_email_mobileno == '1'  || $normal_spin_method == '1' || $user_username_mobile_method == '1')
        {  
            
        }
        else
        {
            ?>
         <li class="nav-item">
          <a class="nav-link text-white active bg-gradient-primary" href="../pages/player_list.php">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">table_view</i>
            </div>
            <span class="nav-link-text ms-1">Player Managemant</span>
          </a>
        </li>

        <?php

        if($reset_time_login_method == '1')
        {

        ?>
        <li class="nav-item">
          <a class="nav-link text-white active bg-gradient-primary" href="../pages/reset_timer_set.php">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">table_view</i>
            </div>
            <span class="nav-link-text ms-1">Reset Timer Set</span>
          </a>
        </li>
        <?php

        }
        ?>
        <?php
        }
        if($host_name == 'sgluckydraw88.com' || $host_name == 'sgroyalwheel888.com' || $host_name == 'luckyspin888.com' || $host_name == 'luckywheel888.com' || $host_name == 'wheel006.jgdx.xyz')
        {
          ?>
          <li class="nav-item">
            <a class="nav-link text-white active bg-gradient-primary" href="../pages/optimize_spin_results.php">
              <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                <i class="material-icons opacity-10">table_view</i>
              </div>
              <span class="nav-link-text ms-1">Spin Results</span>
            </a>
          </li>
        <?php
        }
        else
        {
         
            ?>
            <li class="nav-item">
              <a class="nav-link text-white active bg-gradient-primary" href="../pages/spin_results.php">
                <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                  <i class="material-icons opacity-10">table_view</i>
                </div>
                <span class="nav-link-text ms-1">Spin Results</span>
              </a>
            </li>
            <?php
          
       }
        if($email_method == '1')
        {
            ?>
            <li class="nav-item">
              <a class="nav-link text-white active bg-gradient-primary" href="../pages/user_email_method.php">
                <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                  <i class="material-icons opacity-10">table_view</i>
                </div>
                <span class="nav-link-text ms-1">User Email List</span>
              </a>
            </li>
            <?php
        }
        if($name_email_mobileno == '1')
        {
          ?>
            <li class="nav-item">
              <a class="nav-link text-white active bg-gradient-primary" href="../pages/user_name_email_mobilenumber_method.php">
                <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                  <i class="material-icons opacity-10">table_view</i>
                </div>
                <span class="nav-link-text ms-1">User Name-Email-Mobile Number List</span>
              </a>
            </li>
          <?php
        }
        ?>
      
        <li class="nav-item">
          <a class="nav-link text-white active bg-gradient-primary" href="../pages/top_winner.php">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">table_view</i>
            </div>
            <span class="nav-link-text ms-1">Top Winner</span>
          </a>
        </li>

        <?php
        
         if($code_sp == '1' || $code_with_remain_spin_sp == '1')
        { ?>
        <li class="nav-item">
          <a class="nav-link text-white active bg-gradient-primary" href="../pages/generatecode.php">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">table_view</i>
            </div>
            <span class="nav-link-text ms-1">Generate Code</span>
          </a>
        </li>
        <?php 
        } 
        if($user_username_mobile_method == '1')
        { ?>
        <li class="nav-item">
          <a class="nav-link text-white active bg-gradient-primary" href="../pages/mobile_number_username_list.php">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">table_view</i>
            </div>
            <span class="nav-link-text ms-1">Username-Mobile Number List</span>
          </a>
        </li>
        <?php 
        }
        if($mobile_number_sp == '1')
        { ?>
        <li class="nav-item">
          <a class="nav-link text-white active bg-gradient-primary" href="../pages/generatephoneno.php">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">table_view</i>
            </div>
            <span class="nav-link-text ms-1">Show Mobile Result</span>
          </a>
        </li>
        <?php 
        
        } 
        if($share_referrel == '1' || (($user_login_sp == '1' || $user_login_register_method == '1') && $reward_point_login_method == '1'))
        {
          
        ?>
    
        <li class="nav-item">
          <a class="nav-link text-white active bg-gradient-primary" href="share_redeem_rewards.php">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">table_view</i>
            </div>
            <span class="nav-link-text ms-1">Redeem Rewards</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white active bg-gradient-primary" href="reward_redeem_results.php">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">table_view</i>
            </div>
            <span class="nav-link-text ms-1">Redeem Reward Results</span>
          </a>
        </li>
        <?php
        
        }
        if((($user_login_sp == '1' || $user_login_register_method == '1') && $reward_point_login_method == '1'))
        {
          
        ?>
    
        <li class="nav-item">
          <a class="nav-link text-white active bg-gradient-primary" href="../pages/set_user_revode_point.php">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">table_view</i>
            </div>
            <span class="nav-link-text ms-1">Set User Point By Reward</span>
          </a>
        </li>
        <?php
        
        }
        ?>
        <li class="nav-item">
          <a class="nav-link text-white active bg-gradient-primary" href="admin_change_pass.php">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">table_view</i>
            </div>
            <span class="nav-link-text ms-1">Change Password</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white active bg-gradient-primary" href="contact_form_results.php">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">table_view</i>
            </div>
            <span class="nav-link-text ms-1">Contact Form Data</span>
          </a>
        </li>
      </ul>

    </div>
   
    
  </aside>