<?php
if($code_sp == '1' || $code_with_remain_spin_sp == '1')
{

    include 'user_code_method.php';
    
    
}

if($email_method == '1')
{

    include 'user_email_method.php';
    
    
}

if($name_email_mobileno == '1')
{
   
    include 'user_name_email_mobileno.php';
   
    
}

if(($mobile_num_otp == '1' && $mobile_number_sp == '1') || ($mobile_number_sp == '1'))
{
   
    include 'use_mobile_num_otp_method.php';
    
}

if($user_username_mobile_method == '1')
{
    
    include 'user_username_mobile_method.php';
    
   
}


?>
<div class="modal" id="code_enter_Modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="popup-overlay"></div>
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form method="post">
                <div class="modal-header border-bottom-0">
                    <button id="close_code_methods_popup" type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-title text-center">
                    <h4></h4>
                    </div>
                    <div class="d-flex flex-column text-center">
                    
                    <?php
                    if($mobile_number_sp == '1')
                    {

             
                        if($set_text_for_code_method != '')
                        {
                            $label_mobile = $set_text_for_code_method;
                        }
                        else
                        {
                            $label_mobile = 'Enter Mobile Number';
                        }
                        
                        $type_set = 'number';
                    }
                    else if($email_method == '1')
                    {
                        if($set_text_for_code_method != '')
                        {
                            $label_mobile = $set_text_for_code_method;
                        }
                        else
                        {
                            $label_mobile = 'Enter Email'; 
                        }
                        $type_set = 'email';
                    }
                    else
                    {
                        if($set_text_for_code_method != '')
                        {
                            $label_mobile = $set_text_for_code_method;
                        }
                        else
                        {
                            $label_mobile = 'Enter Code';
                        }
                        $type_set = 'text';
                    }

                        if($name_email_mobileno == '1')
                        {
                        ?>
                            <div class="form-group">
                                <div class="row show_in_center_mobile">
                                    <div class="col-sm-4 login_form_style">
                                        <label>User Name</label>
                                    </div>
                                    <div class="col-sm-6 custom_add_margin_user" style="display:flex;">
                                        <input type="text" id="username" name="username" class="form-control design_password" id="user_spin_code" placeholder="Enter Name">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row show_in_center_mobile">
                                    <div class="col-sm-4 login_form_style">
                                        <label>User Email</label>
                                    </div>
                                    <div class="col-sm-6 custom_add_margin_user" style="display:flex;">
                                        <input type="email" id="username" name="useremail" class="form-control design_password" id="user_spin_code" placeholder="Enter Email">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row show_in_center_mobile">
                                    <div class="col-sm-4 login_form_style">
                                        <label>User Mobile Number</label>
                                    </div>
                                    <div class="col-sm-6 custom_add_margin_user" style="display:flex;">
                                        <?php
                                            if($number_patern_for_all_mob_method != '')
                                            {
                                            ?>
                                            <input type="text" id="username" name="usermobilenumber" pattern="<?php echo $number_patern_for_all_mob_method; ?>" class="form-control design_password" id="user_spin_code" placeholder="Enter Mobile Number">
                                            <?php
                                            }
                                            else
                                            {
                                            ?>
                                                <input type="number" id="username" name="usermobilenumber" class="form-control design_password" id="user_spin_code" placeholder="Enter Mobile Number">
                                            <?php
                                            }
                                        ?>                                        
                                    </div>
                                </div>
                            </div>
                        <?php
                        }
                        elseif($user_username_mobile_method == '1')
                        {
                        ?>
                            <div class="form-group">
                                <div class="row show_in_center_mobile">
                                    <div class="col-sm-4 login_form_style">
                                        <label><?php echo $user_usmob_method_username_label; ?></label>
                                    </div>
                                    <div class="col-sm-6 custom_add_margin_user" style="display:flex;">
                                        <input type="text" id="user_mob_num_usname_name" name="user_mob_num_usname_name" class="form-control design_password" placeholder="<?php echo $user_usmob_method_username_placeholder; ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row show_in_center_mobile">
                                    <div class="col-sm-4 login_form_style">
                                        <label><?php echo $user_usmob_method_mobile_number_label; ?></label>
                                    </div>
                                    <div class="col-sm-6 custom_add_margin_user" style="display:flex;">
                                        <?php
                                            if($number_patern_for_all_mob_method != '')
                                            {
                                            ?>
                                            <input type="text" id="user_mob_num_usname_number" pattern="<?php echo $number_patern_for_all_mob_method; ?>" name="user_mob_num_usname_number" class="form-control design_password" placeholder="<?php echo $user_usmob_method_mobile_number_placeholder; ?>">
                                            <?php
                                            }
                                            else
                                            {
                                            ?>
                                                <input type="number" id="user_mob_num_usname_number" name="user_mob_num_usname_number" class="form-control design_password" placeholder="<?php echo $user_usmob_method_mobile_number_placeholder; ?>">
                                            <?php
                                            }
                                        ?>
                                       
                                    </div>
                                </div>
                            </div>
                    
                        <?php
                        }
                        else
                        {

                       
                    ?>
                        
                        <div class="form-group">
                             <div class="row show_in_center_mobile">
                                <div class="col-sm-4 login_form_style">
                                    <label><?php echo $label_mobile; ?></label>
                                </div>
                                <div class="col-sm-6 custom_add_margin_user" style="display:flex;">
                                    <?php
                                    $output6 = '';
                                    if($mobile_num_otp == '1')
                                    {
                                        //include 'country_code_with_mob_num_code.php';
                                    
                                        // if($host_name == 'wheel006.jgdx.xyz')
                                        // {
                                        //     $countryArray = array(
                                            
                                        //         'IN'=>array('name'=>'INDIA','code'=>'91'),
                                                
                                                
                                        //     );
                                        // }
                                        // else
                                        // {
                                            $countryArray = array(
                                            
                                                // 'IN'=>array('name'=>'INDIA','code'=>'91'),
                                                
                                                'MY'=>array('name'=>'MALAYSIA','code'=>'60'),
                                                
                                            );
                                       // }
                                        

                                        $output6 = '<span><select id="show_number_code" name="country_code_num" class="form-control show_number_code" style="width:100%;">';
	
                                        foreach($countryArray as $code => $country){
                                        $mob_code = $country["code"];
                                            $output6 .= '<option value="'.$mob_code.'">+'.$mob_code.'</option>';
                                        }
                                        
                                        $output6 .= '</select></span>';
                                        
                                        echo $output6; 
                                    }
                                    if($mobile_num_otp == '1' || $mobile_number_sp == '1')
                                    {
                                        if($number_patern_for_all_mob_method != '')
                                        {
                                            ?>
                                            <!-- <input type="<?php echo $type_set; ?>" id="phone" name="user_spin_code" class="form-control design_password" id="user_spin_code" placeholder="<?php echo $label_mobile; ?>"> -->
                                            <input type="text" id="phone" name="user_spin_code" pattern="<?php echo $number_patern_for_all_mob_method; ?>" class="form-control design_password" id="user_spin_code" placeholder="<?php echo $label_mobile; ?>" required>
                                            <?php
                                        }
                                        else
                                        {
                                            ?>
                                            <!-- <input type="<?php echo $type_set; ?>" id="phone" name="user_spin_code" class="form-control design_password" id="user_spin_code" placeholder="<?php echo $label_mobile; ?>"> -->
                                            <input type="number" id="phone" name="user_spin_code" class="form-control design_password" id="user_spin_code" placeholder="<?php echo $label_mobile; ?>" required>
                                            <?php
                                        }
                                        
                                    }
                                    else
                                    {
                                        ?>
                                            <input type="<?php echo $type_set; ?>" id="phone" name="user_spin_code" class="form-control design_password" id="user_spin_code" placeholder="<?php echo $label_mobile; ?>">
                                        <?php
                                    }
                                    ?>
                                </div>
                            </div>
                            <?php
                            if($mobile_num_otp == '1' && $mobile_number_sp == '1')
                            {
                                ?>
                                    <div id="recaptcha-conatiner" style="visibility: hidden;"></div>
                                <?php
                            }
                            ?>
                            
                        </div>
                        <?php
                        }
                        ?>
                        
                        <div class="erroe_msg"><?php echo $error_code; ?></div>
                        
                    
                
                    </div>
                </div>
                <div class="modal-footer d-flex justify-content-center modal_footer">
                    <?php
                    if($mobile_number_sp == '1')
                    {
                        ?>
                        <button type="submit" style="display:none;" id="save_spin_code" name="save_spin_code_mobile" class="btn btn-info btn-block btn-round">Submit</button>
                        <button type="button" style="display:none;" id="save_spin_code_with_otp" onClick="sendOTP_hwe();" name="save_spin_code_mobile_hwe1" class="btn btn-info btn-block btn-round">Submit</button>
                        <?php
                    }
                    elseif($email_method == '1')
                    {
                        ?>
                        <button type="submit" id="email_save" name="email_save" class="btn btn-info btn-block btn-round">Submit</button>
                        <?php
                    }
                    elseif($name_email_mobileno == '1')
                    {
                        ?>
                        <button type="submit" id="usern_e_m_save" name="usern_e_m_save" class="btn btn-info btn-block btn-round">Submit</button>
                        <?php
                    }
                    elseif($user_username_mobile_method == '1')
                    {
                        ?>
                        <button type="submit" id="user_username_mobile_save" name="user_username_mobile_save" class="btn btn-info btn-block btn-round">Submit</button>
                        <?php
                    }
                    else
                    {
                        ?>
                        <button type="submit" id="save_spin_code" name="save_spin_code" class="btn btn-info btn-block btn-round">Submit</button>
                        <?php
                    }
                    ?>
                    
                </div>

            </form>
        </div>
    </div>
 </div>
<?php 
if($mobile_num_otp == '1')
{
    ?>
<div class="modal" id="otp_enter_Modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="popup-overlay"></div>
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form method="post">
                <div class="modal-header border-bottom-0">
                    <button id="close_otp_popup" type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-title text-center">
                    <h4></h4>
                    </div>
                    <div class="d-flex flex-column text-center">
                  
                    <div class="form-group">
                            <div class="row show_in_center_mobile">
                            <div class="col-sm-4 login_form_style">
                                <label>Enter OTP</label>
                            </div>
                            <div class="col-sm-6 custom_add_margin_user">
                                <input type="number" name="enter_otp_sent" class="form-control design_password" id="enter_otp_sent" placeholder="Enter OTP Number">
                            </div>
                        </div>
                    </div>
                        
                    <div class="erroe_msg"><?php echo $error_code; ?></div>
                    
                    </div>
                    </div>
                    <div class="modal-footer d-flex justify-content-center modal_footer">
                       
                     <button type="submit" style="display:none;" id="check_spin_code_mobile_otp" name="check_spin_code_mobile_otp" class="btn btn-info btn-block btn-round">Submit</button>
                     <button type="button" id="check_spin_code_mobile_otp_hwe" onClick="varify_code();" name="" class="btn btn-info btn-block btn-round">Submit</button>
                            
                    </div>

                </form>
            </div>
        </div>
    </div>
    <?php
}
if($mobile_num_otp == '1' && $mobile_number_sp == '1')
{
    ?>
      <style>
            #save_spin_code_with_otp
            {
                display:block !important;
            }
            #save_spin_code
            {
                display:none;
            }
      </style>
      <script src="firebase.js"></script>
      <script src="https://www.gstatic.com/firebasejs/8.3.2/firebase.js"></script>

        <script>
        var firebaseConfig = {
            apiKey: "AIzaSyCA3xs9B29_ShkcRKuHjsChjb1vaXohWKA",
            authDomain: "lucky-wheel-mini-game.firebaseapp.com",
            projectId: "lucky-wheel-mini-game",
            storageBucket: "lucky-wheel-mini-game.appspot.com",
            messagingSenderId: "150689764858",
            appId: "1:150689764858:web:a9e6908056186175ef8043",
            measurementId: "G-MCLDKTEQQX"
        };

        // Initialize Firebase
        firebase.initializeApp(firebaseConfig);
        firebase.analytics();
    </script>
    <?php

}
else if($mobile_number_sp == '1')
{
    ?>
    <style>
          #save_spin_code_with_otp
          {
              display:none;
          }
          #save_spin_code
          {
            display:block !important;
          }
    </style>
  <?php
}
?>
<script>
jQuery(document).ready(function(){

    jQuery("#close_code_methods_popup").click(function(){

        jQuery("#code_enter_Modal").removeClass("in");
        jQuery("#code_enter_Modal").attr("style","display:none;");

    });

    jQuery("#close_otp_popup").click(function(){

        jQuery("#otp_enter_Modal").removeClass("in");
        jQuery("#otp_enter_Modal").attr("style","display:none;");

    });

});
</script>