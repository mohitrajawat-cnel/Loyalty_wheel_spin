<script src="customn_library/maxcdnbootstrap.min.js"></script>
<div class="container add_banner">
            <h2></h2>  
            <div id="myCarousel" class="carousel slide" data-ride="carousel">
                <!-- Indicators -->
                <ol class="carousel-indicators" style="z-index: 0;">
                <?php
//ramkishan
                    $select_banner1 = "SELECT * from ".$table_prefix."banner_add";
                    $row_banner1 = $conn->query($select_banner1);
                    $row_count =0;
                    $show_caresol='';
                    while($result_banner1 = mysqli_fetch_assoc($row_banner1))
                    {
                        if(count($result_banner1) > 0)
                        {
                           if($row_count == 0)
                            {
                                $active_set = 'active';
                            }
                            else
                            {
                                $active_set = '';
                            }
                        
                            $show_caresol .= '<li data-target="#myCarousel" data-slide-to="'.$row_count.'" class="'.$active_set.'"></li>';

                            $row_count++;
                        }
                        
                    }
                    echo $show_caresol;
                ?>

                </ol>
                <style>

                    @media only screen and (max-width:767px)
                    {
                        .carousel-inner
                        {
                            height:auto !important;
                        }
                        .show_slider_one
                        {
                            height:auto !important;
                        }
                        
                        #drawing .container {
                            width: 100%;
                            padding-left: 0px;
                            padding-right: 0px;
                            margin-top:50px;
                        }
                        
                        
                    }
                    @media only screen and (min-width:768px)
                    {
                        #drawing .container {
                            width: 100%;
                            padding-left: 0px;
                            padding-right: 0px;
                        }

                        .remaining-spin-times
                        {
                            top:612px !important;
                        }

                        .reward-list-all 
                        {
                        top:448px !important;

                        }
                        #viewBox
                        {
                            height:800px !important;
                        }


                    }
                </style>
                <!-- Wrapper for slides -->
                <div class="carousel-inner" style="height:auto;">
            
                <?php
                //ramkishan
                    $select_banner = "SELECT * from ".$table_prefix."banner_add  ORDER BY order_sort ASC";
                    $row_banner = $conn->query($select_banner);
                    $count_check =0;
                    while($result_banner = mysqli_fetch_assoc($row_banner))
                    {
                        if(count($result_banner) > 0)
                        {
                            if(count($result_banner) > 0)
                            {
                                if($count_check == 0)
                                {
                                    $active_set = 'active';
                                }
                                else
                                {
                                    $active_set = '';
                                }
                                $image = $result_banner['banner_image'];
                                $show_banner .= ' <div class="item '.$active_set.'">
                                                    <img src="'.'admin_panel/pages/'.$image.'" alt="Los Angeles" class="show_slider_one" style="width:100%;height: auto;">
                                                </div>';

                                $count_check++;
                            }
                        }
                    }
                    echo $show_banner;

                ?>

                </div>

                <!-- Left and right controls -->
                <?php
                //ramkishan
                $select_banner = "SELECT * from ".$table_prefix."banner_add  ORDER BY order_sort ASC";
                $row_banner = $conn->query($select_banner);
                $count_check =0;
                while($result_banner = mysqli_fetch_assoc($row_banner))
                {
                    if(count($result_banner) > 0)
                    {
                    
                ?>
                    <a class="left carousel-control" href="#myCarousel" data-slide="prev">
                        
                            <i class="fa fa-arrow-left" aria-hidden="true" style="position: absolute;
top: 50%;font-size:36px;"></i>
                        
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="right carousel-control" href="#myCarousel" data-slide="next">
                        <i class="fa fa-arrow-right" aria-hidden="true" style="position: absolute;
top: 50%;font-size:36px;"></i>
                        
                        <span class="sr-only">Next</span>
                    </a>
                <?php
                    }
                    
                }
                ?>
    </div>
</div>