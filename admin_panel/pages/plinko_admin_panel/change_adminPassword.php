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
    <script type="text/javascript" src="../../../js/jquery-3.2.1.min.js"></script>

    <style>
        .alert {
            padding: 10px;
            background-color: #2eb885;
            color: white;
            width: 40%;
            margin-left: 60%;
        }

        .closebtn {
            margin-left: 15px;
            color: white;
            font-weight: bold;
            float: right;
            font-size: 22px;
            line-height: 20px;
            cursor: pointer;
            transition: 0.3s;
        }

        .closebtn:hover {
            color: black;
        }
        .change_passwordDiv{
            display: flex;
            margin: 15px;
        }

        .change_passwordDiv label{
            font-size: 18px;
            font-weight: bold;
        }
        #chaged_passwdSbtBtn{
            left: 40%;
            position: relative;
            margin: 2%;
            width: 20%;
            background: #EC407A;
            border-radius: 10px;
            padding: 1%;
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
            <a href="/admin_panel/pages/plinko_admin_panel/change_adminPassword.php" style="text-decoration: none;">
            <h6 class="font-weight-bolder mb-0">Change Password</h6>
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
                                <h6 class="text-white text-capitalize ps-3">Change Password</h6>
                            </div>
                        </div>
                    </div>
                    </div>

                    <?php 
                        // if(isset($_POST['changedPaswdSbt'])){
                        //     $admin_old_password = $_POST['admin_old_password'];
                        //     $admin_new_password = $_POST['admin_new_password'];
                        //     $result = mysqli_query($conn, "SELECT `password` FROM `".$prefix."plinko_users` WHERE `password` = '$admin_old_password' AND `id` = $user_id");
                        //     $total_row = mysqli_num_rows($result);
                    
                        //     if($total_row > 0){
                        //         if(mysqli_query($conn, "UPDATE `".$prefix."plinko_users` SET `password` = '$admin_new_password' WHERE `id` = $user_id") == TRUE)
                        //         echo '<div class="alert"> <span class="closebtn" onclick="this.parentElement.style.display = \'none\';">&times;</span> <strong> Password Updated! </strong></div>';
                        //     } else{
                        //         echo '<div class="alert"> <span class="closebtn" onclick="this.parentElement.style.display = \'none\';">&times;</span> <strong> Old Password is not matched! </strong></div>';
                        //     }
                        // }

                        if(isset($_POST['changedPaswdSbt'])){
                            $admin_old_password = $_POST['admin_old_password'];
                            $admin_new_password = $_POST['admin_new_password'];

                            $dir = dirname(dirname(__FILE__));
                         
                            include $dir.'/config.php';

                            $result = mysqli_query($conn, "SELECT `password` FROM `".$prefix."admin_login` WHERE `password` = '$admin_old_password' AND `id` = $user_id");
                            $total_row = mysqli_num_rows($result);
                    
                            if($total_row > 0){
                                if(mysqli_query($conn, "UPDATE `".$prefix."admin_login` SET `password` = '$admin_new_password' WHERE `id` = $user_id") == TRUE)
                                echo '<div class="alert"> <span class="closebtn" onclick="this.parentElement.style.display = \'none\';">&times;</span> <strong> Password Updated! </strong></div>';
                            } else{
                                echo '<div class="alert"> <span class="closebtn" onclick="this.parentElement.style.display = \'none\';">&times;</span> <strong> Old Password is not matched! </strong></div>';
                            }
                        }
                    ?>
                    <div class="container" style="margin: 0; overflow:auto;">
                        <form class="form-horizontal" action="" method="post">
                            <div class="form-group change_passwordDiv">
                                <label class="control-label col-sm-2">Old Password: </label>
                                <div class="col-sm-4">
                                    <input type="text" name="admin_old_password" id="" required />
                                </div>
                            </div>
                            <div class="form-group change_passwordDiv">
                                <label class="control-label col-sm-2">New Password: </label>
                                <div class="col-sm-4">
                                    <input type="text" name="admin_new_password" id="" required />
                                </div>
                            </div>
                            <input type="submit" value="Submit" name="changedPaswdSbt" id="chaged_passwdSbtBtn">
                        </form>
                    </div>
                </div>
                </div>
            </div>
        </div>
    </main>
</body>