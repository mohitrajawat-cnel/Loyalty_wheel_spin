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

    if(isset($_POST['searchGameCode'])){
        $sql = "SELECT * FROM `".$prefix."spin_result` WHERE 1=1";
        if(isset($_POST['searchedCodes'])){
            $sql .= " AND `code` LIKE '%".$_POST['searchedCodes']."%'";
        }

        if(isset($_POST['searchedResult'])){
            $sql .= "AND `result` LIKE '%".$_POST['searchedResult']."%'";
        }
    } else{
        $sql = "SELECT * FROM `".$prefix."spin_result`";
    }
    /* if(isset($_POST['create_code_btn'])){

        $code = $_POST['code'];
        $used_limit = $_POST['used_limit'];
        $game_code_date_sql = "INSERT INTO `plinko_game_code_data` (`code`, `used_limit`) VALUES ('$code', '$used_limit')";

       // $result = mysqli_query($conn, $game_code_date_sql);

        if (mysqli_query($conn, $game_code_date_sql)) {
            ?> <script> alert("Data Added Successfully"); </script> <?php 

         } else {
            //echo "Error: " . $game_code_date_sql . ":-" . mysqli_error($conn);
         }

         mysqli_close($conn);
    } */
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Code</title>
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
        .setPrize_class{
            display: flex;
            margin: 15px;
        }

        .setPrize_class label{
            font-size: 18px;
            font-weight: bold;
        }

        #create_code_btn{
            left: 40%;
            position: relative;
            margin: 2%;
            width: 20%;
            background: #EC407A;
            border-radius: 10px;
            padding: 1%;
        }
        .setPrize_class button.browseBtn_hwe{
            background-color: #fff;
            border: none;
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
      <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
         <a href="/admin_panel/pages/plinko_admin_panel/game_result.php" style="text-decoration: none;">
          <h6 class="font-weight-bolder mb-0">Game Result</h6>
         </a>
        </nav>
        <!--piyush-->
        
        
        <!--piyush-->
        <nav aria-label="breadcrumb" style="position: absolute;right: 18px;">
         <a href="/admin_panel/pages/plinko_admin_panel/logout.php" style="text-decoration: none;">
          <h6 class="font-weight-bolder mb-0">Logout</h6>
         </a>
        </nav>
        <!--by piyush-->
        
          
        
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
            <div class="card my-4">
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                <div class="bg-gradient-primary shadow-primary border-radius-lg pt-2 pb-1">

                    <div class="row">
                        <div class="col-md-10 col-6 pt-2">
                            <h6 class="text-white text-capitalize ps-3">Game Result</h6>
                        </div>
                    </div>
                </div>
                </div>
                
                <form action="" method="post" class="form-control" style="margin: 29px auto 35px auto; padding: 15px; width: 90%;">
                    <div class="input-group" style="margin-bottom: 15px;">
                        <div>
                            <label for="" style="font-size: 20px; font-weight: bold;">Result</label>
                            <input type="text" name="searchedResult" id="" value="<?php if(isset($_POST['searchedResult'])) { echo $_POST['searchedResult']; }?>" style="height: 55px; border-radius: 5px; border: 2px solid #ccc;">
                        </div>&nbsp;
                        <input type="search" name="searchedCodes" value="<?if(isset($_POST['searchedCodes'])) { echo $_POST['searchedCodes']; } ?>" class="form-control rounded" placeholder="Search Code" aria-label="Search" aria-describedby="search-addon" style="outline: none; height:55px; border: 2px solid #ccc;" />&nbsp;
                        <button type="submit" name="searchGameCode" value="searched_result" class="btn btn-outline-primary">
                            <i class="fa fa-search" aria-hidden="true" style="font-size: 25px; padding: 7px;"></i>
                        </button>
                    </div>
                    </form>
             
                <div class="container" style="margin: 0;">
                    <?php 
                        if ($res = mysqli_query($conn, $sql)) {
                            if (mysqli_num_rows($res) > 0) {
                                echo "<table class='table'>";
                                echo "<tr>";
                                echo "<th>S.N</th>";
                                echo "<th>Code</th>";
                                echo "<th>Result</th>";
                                echo "<th>Play Time</th>";
                                echo "</tr>";
                                $count=1;
                                while ($row = mysqli_fetch_array($res)) {
                                    if($row['result'] == 7777)
                                    {
                                        $result = 'No Win';
                                    } else{
                                        $result = $row['result'];
                                    }
                                    
                                    echo "<tr>";
                                    echo "<td>".$count."</td>";
                                    echo "<td>".$row['code']."</td>";
                                    
                                    echo "<td>".$result."</td>";
                                    echo "<td>".$row['play_time']."</td>";
                                    echo "</tr>";
                                    $count++;
                                }
                                echo "</table>";
                            }
                        }
                    ?>
                </div>
            </div>
            </div>
        </div>
    </div>
    </main>
</body>

