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
        <?php if($host_name == 'wheel006.bonuus.io' || $host_name == 'spin2win.bet' || $host_name == 'skyworldsg-luckyspin.com' || $host_name == 'wheel001.bonuus.io' || $host_name == 'wgc33.vip' || $host_name == 'fbads996.com')
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
        }
        ?>
        <li class="nav-item">
          <a class="nav-link text-white active bg-gradient-primary" href="../pages/spin_results.php">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">table_view</i>
            </div>
            <span class="nav-link-text ms-1">Spin Results</span>
          </a>
        </li>
       <?php if($host_name == 'edbet321spins.com')
        { ?>
        <li class="nav-item">
          <a class="nav-link text-white active bg-gradient-primary" href="../pages/top_winner.php">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">table_view</i>
            </div>
            <span class="nav-link-text ms-1">Top Winner</span>
          </a>
        </li>

        <?php
        }
         if($host_name == 'wheel006.bonuus.io' || $host_name == 'spin2win.bet' || $host_name == 'skyworldsg-luckyspin.com' || $host_name == 'wheel001.bonuus.io' || $host_name == 'fbads996.com')
        { ?>
        <li class="nav-item">
          <a class="nav-link text-white active bg-gradient-primary" href="../pages/generatecode.php">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">table_view</i>
            </div>
            <span class="nav-link-text ms-1">Generate Code</span>
          </a>
        </li>
        <?php } ?>
        <?php if($host_name == 'wgc33.vip')
        { ?>
        <li class="nav-item">
          <a class="nav-link text-white active bg-gradient-primary" href="../pages/generatephoneno.php">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">table_view</i>
            </div>
            <span class="nav-link-text ms-1">Show Mobile Result</span>
          </a>
        </li>
        <?php } ?>
        <li class="nav-item">
          <a class="nav-link text-white active bg-gradient-primary" href="admin_change_pass.php">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">table_view</i>
            </div>
            <span class="nav-link-text ms-1">Change Password</span>
          </a>
        </li>
      </ul>
    </div>
   
    
  </aside>