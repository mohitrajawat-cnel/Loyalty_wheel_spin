<?php include "./config.php"; ?>
<aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3   bg-gradient-dark" id="sidenav-main">
    <div class="sidenav-header text-center pt-4" style="padding: 10px !important;">
      <h4 style="color: #fff; font-weight: bold;">Plinko Mini Game Admin Panel</h4>
    </div>
    <hr class="horizontal light mt-0 mb-2">
    <div class="collapse navbar-collapse  w-auto  max-height-vh-100" id="sidenav-collapse-main">
      <ul class="navbar-nav">

        <!-- <li class="nav-item">
          <a class="nav-link text-white active bg-gradient-primary" href="../pages/users.php">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">table_view</i>
            </div>
            <span class="nav-link-text ms-1">Users</span>
          </a>
        </li> -->

        <li class="nav-item">
          <a class="nav-link text-white active bg-gradient-primary" href="/admin_panel/pages/plinko_admin_panel/set_game_prizes.php">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center" style="margin-left: -10px;">
              <i class="fas fa-award fa-fw fa-2x fa-beat-fade opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Set Prize</span>
          </a>
        </li>

        <?php if($game_withCode_orNot === "0") { ?>
        <li class="nav-item">
          <a class="nav-link text-white active bg-gradient-primary" href="/admin_panel/pages/plinko_admin_panel/create_code.php">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center" style="margin-left: -10px;">
              <i class="fas fa-award fa-fw fa-2x fa-beat-fade opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Create Code</span>
          </a>
        </li>
        <?php } ?>

        <li class="nav-item">
          <a class="nav-link text-white active bg-gradient-primary" href="/admin_panel/pages/plinko_admin_panel/game_result.php">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center" style="margin-left: -10px;">
              <i class="fas fa-award fa-fw fa-2x fa-beat-fade opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Game Result</span>
          </a>
        </li>

        <li class="nav-item">
          <a class="nav-link text-white active bg-gradient-primary" href="/admin_panel/pages/plinko_admin_panel/change_adminPassword.php">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center" style="margin-left: -10px;">
              <i class="fas fa-award fa-fw fa-2x fa-beat-fade opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Change Password</span>
          </a>
        </li>

      </ul>
    </div>
   
    
  </aside>