<?php
session_start();
include 'admin_panel/pages/config.php';
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" />
    <title>Loyalty Wheel Spin</title>
    <meta name="description" content="" data-type="admin" />
    <meta name="keywords" content="" data-type="admin" />
    <meta name="author" content="Gafami">
    <meta property="fb:app_id" content="1701132369920968" data-type="admin" />
    <meta property="og:url" content="" data-type="admin" />
    <meta property="og:type" content="Website" data-type="admin" />
    <meta property="og:title" content="Loyalty Wheel Spin" data-type="admin" />
    <meta property="og:description" content="" data-type="admin" />
    <meta property="og:image" content="" data-type="admin" />

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
</head>


<!-- style for winners list  -->


<!-- end style for winners list -->

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
        width :90px !important;
    }
    

    .burger-menu
    {
        right: 20px !important;
        top: 20px !important;
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
            right: 6px;
            cursor:pointer;
            
            
        }
        .custom_login_button_user img
        {
            width :74px !important;
        }
  
    }
    
</style>
<body style="background: #000;">
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />
<script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
<div class="container bootdey flex-grow-1 container-p-y">

            <div class="media align-items-center py-3 mb-3">
              <img src="img/5036557-middle.png" alt="" class="d-block ui-w-100 rounded-circle">
              <div class="media-body ml-4">
                <h4 class="font-weight-bold mb-0">John Doe</h4>
                <div class="text-muted mb-2">Edit Profile <i class='fa fa-angle-right' style='margin-left: 6px;'></i></div>
            
              </div>
            </div>

            <div class="card mb-4">
              <div class="card-body">
                <table class="table user-view-table m-0">
                  <tbody>
                    <tr>
                      <td>Registered:</td>
                      <td>01/23/2017</td>
                    </tr>
                    <tr>
                      <td>Registered:</td>
                      <td>01/23/2017</td>
                    </tr>
                  </tbody>
                </table>
              </div>
             
            </div>

        
            </div>

          </div>

 <style>

.container
{
    background: #fff;
    height: 100vh;
}
.align-items-center
{
    display: flex;
}

.ui-w-100 {
    width: 100px !important;
    height: auto;
}

.card {
    background-clip: padding-box;
    box-shadow: 0 1px 4px rgba(24,28,33,0.012);
}

.user-view-table td:first-child {
    width: 9rem;
}
.user-view-table td {
    padding-right: 0;
    padding-left: 0;
    border: 0;
}

.text-light {
    color: #babbbc !important;
}

.card .row-bordered>[class*=" col-"]::after {
    border-color: rgba(24,28,33,0.075);
}    

.text-xlarge {
    font-size: 170% !important;
}
@media only screen and (min-width:768px)
{
   
    .burger-menu
    {
        right: 50px !important;
        top: 28px !important;
    }
}
.custon_banner_show
{
    position:fixed;
    bottom: 61px;
    background-image: none !important;
}
.menu_site
{
    height: 38px;
    
}
.img_set
{
    margin-top: -12px;
}
</style>

<?php
    include 'site_front_menu.php';
?>

<style>
    .add_banner
    {
        width:100%;
    }
</style>

    <!-- BANNERS -->
    <div id="ads" data-type="admin">
        <div class="swiper-container">
          

    <!-- Popup login form -->



    <!-- CONFIG NEEDED PARAMS GENEREATE FROMN ADMIN PAGE TO OPERATE THE WHEEL AS: TOTAL SLICE, GRAPHIC, REWARD VALUES -->
    <script id="config" defer></script>
    <script id="smtp" src="js/smtp.js" data-type="admin" defer></script>
    <script src="js/svg.min.js" defer></script>
    <script src="js/layout.js" defer></script>
    <script src="js/jquery-3.4.0.min.js" data-type="admin" defer></script>
    <script src='js/spectrum.min.js' data-type="admin" defer></script>
    <script src="js/jszip.min.js" data-type="admin" defer></script>
    <script src="js/jszip-utils.min.js" data-type="admin" defer></script>
    <script src="js/filesaver.js" data-type="admin" defer></script>
    <script src="js/params.js" data-type="admin" defer></script>
    <script id="particles-lib" src="js/particles.min.js" defer></script>
    <script id="anims" src="js/animations.js" defer></script>

</body>

</html>