<?php
  session_start();
  include("./admin_panel/pages/plinko_admin_panel/config.php");
  $getcode = 0;
  if( isset($_SESSION['code_id']) )
  {
    $getcode = 1;
  } else
  {
    $getcode = 0;
  }
  ?>

  <?php
  $csshwe = '';
  if($getcode==0)
  {
    $csshwe = 'display:none;';
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="css/reset.css" type="text/css">
  <link rel="stylesheet" href="css/main.css" type="text/css">
  <link rel="stylesheet" href="css/orientation_utils.css" type="text/css">
  <link rel='shortcut icon' type='image/x-icon' href='./favicon.ico' />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">

  <script type="text/javascript" src="plinko_js/jquery-3.2.1.min.js"></script>
  <script type="text/javascript" src="plinko_js/createjs.min.js"></script>
  <script type="text/javascript" src="plinko_js/howler.min.js"></script>
  <script type="text/javascript" src="plinko_js/screenfull.js"></script>
  <script type="text/javascript" src="plinko_js/platform.js"></script>
  <script type="text/javascript" src="plinko_js/ctl_utils.js"></script>
  <script type="text/javascript" src="plinko_js/sprite_lib.js"></script>
  <script type="text/javascript" src="plinko_js/settings.js"></script>
  <script type="text/javascript" src="plinko_js/CLang.js"></script>
  <script type="text/javascript" src="plinko_js/CPreloader.js"></script>
  <script type="text/javascript" src="plinko_js/CMain.js"></script>
  <script type="text/javascript" src="plinko_js/CTextButton.js"></script>
  <script type="text/javascript" src="plinko_js/CToggle.js"></script>
  <script type="text/javascript" src="plinko_js/CGfxButton.js"></script>
  <script type="text/javascript" src="plinko_js/CMenu.js"></script>
  <script type="text/javascript" src="plinko_js/CGame.js"></script>
  <script type="text/javascript" src="plinko_js/CInterface.js"></script>
  <script type="text/javascript" src="plinko_js/CCreditsPanel.js"></script>
  <script type="text/javascript" src="plinko_js/CAreYouSurePanel.js"></script>
  <script type="text/javascript" src="plinko_js/CEndPanel.js"></script>
  <script type="text/javascript" src="plinko_js/CGridMapping.js"></script>
  <script type="text/javascript" src="plinko_js/CCell.js"></script>
  <script type="text/javascript" src="plinko_js/CBall.js"></script>
  <script type="text/javascript" src="plinko_js/CBallGenerator.js"></script>
  <script type="text/javascript" src="plinko_js/CInsertTubeController.js"></script>
  <script type="text/javascript" src="plinko_js/CSlot.js"></script>
  <script type="text/javascript" src="plinko_js/CScoreBasketController.js"></script>
  <script type="text/javascript" src="plinko_js/CBasket.js"></script>
  <script type="text/javascript" src="plinko_js/CGUIExpandible.js"></script>
  <script type="text/javascript" src="plinko_js/CCTLText.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.9.2/umd/popper.min.js"></script>
  <style>
      @media only screen and (max-width:590px)
      {
        .show_in_center_mobile
        {
          justify-content: center;
        }
        .custom_add_margin_user
        {
          margin-left: 16px;
        }
      }
  </style>
</head>
<body>
  <input type="hidden" name="get_data_session" value="<?php echo $_SESSION['code'];?>" id="data_of_code">
  <div id="selectHidden_field_val" style="<?php echo $csshwe; ?>">
    <?php
      $selectSql = "SELECT * FROM `".$prefix."plinkoSet_prize_table` ORDER BY `created_at` DESC";
      $result = mysqli_query($conn, $selectSql);
      $resultRow = mysqli_fetch_assoc($result);

      $prize_winning = json_decode($resultRow['prize_value'], true);
      $prizeImg = json_decode($resultRow['prize_image'], true);
      $prize_label = $resultRow['label_img'];

      foreach($prizeImg as $key => $value){
        echo '<input type="hidden" name="'.$key.'" value="'.basename($value).'" class="prizeImg_class_hwe">';
      }

      $prize_problty = json_decode($resultRow['prize_probability'], true);
      foreach($prize_problty as $key => $value){
        echo '<input type="hidden" name="'.$key.'" value="'.$value.'">';
      }

      foreach($prize_winning as $key => $value){
        echo '<input type="hidden" name="'.$key.'" value="'.$value.'" class="prizeValue_hwe">';
      }

      $prizeLink = json_decode($resultRow['redeem_link'], true);
      foreach($prizeLink as $key => $value){
        echo '<input type="hidden" name="'.$key.'" value="'.$value.'">';
      }
    ?>
    <input type="hidden" name="prizeLabel_val" value='<?php echo "[".$prize_label."]"; ?>'>
    <input type="hidden" name="afterWinning_text" value="<?php echo $resultRow['win_prize_text'];?>" />
  </div>
  <div class="container">
    <canvas id="canvas" class='ani_hack' width="1280" height="1920"> </canvas>
    <div data-orientation="portrait" class="orientation-msg-container">
      <p class="orientation-msg-text">Please rotate your device</p>
    </div>
  </div>
  <div class="modal" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" >
    <div class="modal-dialog modal-dialog-centered" role="document" style="z-index: 10000; position:relative;">
      <div class="modal-content">
        <form method="post" action="index.php">
          <div class="modal-header">
          </div>
          <div class="modal-body">
            <div class="d-flex flex-column text-center">
              <div class="form-group">
                <div class="row show_in_center_mobile" style="display: flex;">
                  <div class="col-sm-4" style="text-align: right;padding: 9px;color: #ef8318;">
                    <label>Code</label>
                  </div>
                  <div class="col-sm-6 custom_add_margin_user">
                    <input type="text" name="code" class="form-control design_password" id="code" placeholder="Enter your code">
                  </div>
                </div>
              </div>
              <div class="erroe_msg"><?php echo $_SESSION['error']; ?></div>
            </div>
          </div>
          <div class="modal-footer d-flex justify-content-center modal_footer">
            <button type="submit" id="login_with_code" name="login_with_code" class="btn btn-info btn-block btn-round">Submit</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <div class="check-fonts">
    <p class="check-font-1">impact</p>
  </div>
</div>
</body>
<script>
  <?php if($getcode==0) { ?>
    jQuery("#loginModal").show();
  <?php } ?>
  jQuery(document).ready(function(){

    var first_prizeProblty = $("input[name='first_prizeProblty']").val();
    var second_prizeProblty = $("input[name='second_prizeProblty']").val();
    var third_prizeProblty = $("input[name='third_prizeProblty']").val();
    var fourth_prizeProblty = $("input[name='fourth_prizeProblty']").val();
    var fifth_prizeProblty = $("input[name='fifth_prizeProblty']").val();
    var sixth_prizeProblty = $("input[name='sixth_prizeProblty']").val();

    var first_prize_value = $("input[name='first_prize_value']").val() == 'prize' ? true : false;
    var second_prize_value = $("input[name='second_prize_value']").val() == 'prize' ? true : false;
    var third_prize_value = $("input[name='third_prize_value']").val() == 'prize' ? true : false;
    var fourth_prize_value = $("input[name='fourth_prize_value']").val() == 'prize' ? true : false;
    var fifth_prize_value = $("input[name='fifth_prize_value']").val() == 'prize' ? true : false;
    var sixth_prize_value = $("input[name='sixth_prize_value']").val() == 'prize' ? true : false;

    var firstPrizeLink = $("input[name='frstPrize_link']").val();
    var secndPrizeLink = $("input[name='secndPrize_link']").val();
    var thrdPrizeLink = $("input[name='thrdPrize_link']").val();
    var frthPrizeLink = $("input[name='frthPrize_link']").val();
    var fifthPrizeLink = $("input[name='fifthPrize_link']").val();
    var sxthPrizeLink = $("input[name='sxthPrize_link']").val();

    var redeemLink = $("input[name='redeemLink_hwe']").val();

    
    var oMain = new CMain({
      num_ball: 1,
      //INSTANT_WIN_WHEEL_SETTINGS sets the win occurrence of each prize in the wheel.
      //      -background: THE BACKGROUND IMAGE NAME IN sprites/prize FOLDER (the images name MUST ALWAYS BE image_#)
      //      -win_occurrence: THE WIN OCCURRENCE OF THAT PRIZE. THE RATIO IS CALCULATED WITH THE FORMULA: (single win occurrence/sum of all occurrences). For instance, in this case, prize of image_2 have 7/42 chance.
      //      -prizewinning: STATES WHETHER THE PRIZE IS WINNING OR NOT. 
      //              IF "false", THE PRIZE HAS NO VALUE AND WILL BE CONSIDERED AS A LOSE. THE GAME WILL CONTINUES UNTIL THE NUM. BALL ENDS OR PLAYER WINS. 
      //              IF "true", THE PRIZE IS CONSIDERED AS A WIN, THE GAME ENDS AND THE PLAYER WILL BE REDIRECTED TO A REDEEM LINK
      //      -redeemlink: INSERT A REDEEM LINK FOR THE OBJECT. IF YOU DON'T WANT TO ADD ANY LINK, LEAVE THE FIELD AS IT IS: (redeemlink: "").
      prize_settings: [
        {background: "image_0", win_occurrence:first_prizeProblty, prizewinning: first_prize_value, redeemlink: firstPrizeLink},
        {background: "image_1", win_occurrence:second_prizeProblty, prizewinning: second_prize_value, redeemlink: secndPrizeLink},
        {background: "image_2", win_occurrence:third_prizeProblty, prizewinning: third_prize_value, redeemlink: thrdPrizeLink},
        {background: "image_3", win_occurrence:fourth_prizeProblty, prizewinning: fourth_prize_value, redeemlink: frthPrizeLink},
        {background: "image_4", win_occurrence:fifth_prizeProblty, prizewinning: fifth_prize_value, redeemlink: fifthPrizeLink},
        {background: "image_5", win_occurrence:sixth_prizeProblty, prizewinning: sixth_prize_value, redeemlink: sxthPrizeLink}
        ///// YOU CAN'T ADD MORE PRIZE SLOT
      ],
      
      total_images_backgrounds_in_folder: 6, 	////SET HERE THE EXACT NUMBER OF BACKGROUND IMAGES IN GAME FOLDER IF YOU WANT TO ADD MORE DIFFERENT IMAGES
      
      audio_enable_on_startup:false, //ENABLE/DISABLE AUDIO WHEN GAME STARTS 
      fullscreen:true,            //SET THIS TO FALSE IF YOU DON'T WANT TO SHOW FULLSCREEN BUTTON
      check_orientation:true,     //SET TO FALSE IF YOU DON'T WANT TO SHOW ORIENTATION ALERT ON MOBILE DEVICES   
      
      //////////////////////////////////////////////////////////////////////////////////////////
      ad_show_counter: 5     //NUMBER OF BALL PLAYED BEFORE AD SHOWN
      //
      //// THIS FUNCTIONALITY IS ACTIVATED ONLY WITH CTL ARCADE PLUGIN.///////////////////////////
      /////////////////// YOU CAN GET IT AT: /////////////////////////////////////////////////////////
      // http://codecanyon.net/item/ctl-arcade-wordpress-plugin/13856421?s_phrase=&s_rank=27 ///////////
      
    });
                              

    $(oMain).on("start_session", function(evt) {
      if(getParamValue('ctl-arcade') === "true"){
        parent.__ctlArcadeStartSession();
      }
      //...ADD YOUR CODE HERE EVENTUALLY
    });
        
    $(oMain).on("end_session", function(evt) {
      if(getParamValue('ctl-arcade') === "true"){
        parent.__ctlArcadeEndSession();
      }
      //...ADD YOUR CODE HERE EVENTUALLY
    });

    $(oMain).on("restart_level", function(evt, iLevel) {
      if(getParamValue('ctl-arcade') === "true"){
        parent.__ctlArcadeRestartLevel({level:iLevel});
      }
      //...ADD YOUR CODE HERE EVENTUALLY
    });

    $(oMain).on("save_score", function(evt,iScore, szMode) {
      if(getParamValue('ctl-arcade') === "true"){
        parent.__ctlArcadeSaveScore({score:iScore, mode: szMode});
      }
      //...ADD YOUR CODE HERE EVENTUALLY
    });

    $(oMain).on("start_level", function(evt, iLevel) {
      if(getParamValue('ctl-arcade') === "true"){
        parent.__ctlArcadeStartLevel({level:iLevel});
      }
      //...ADD YOUR CODE HERE EVENTUALLY
    });

    $(oMain).on("end_level", function(evt,iLevel) {
      if(getParamValue('ctl-arcade') === "true"){
        parent.__ctlArcadeEndLevel({level:iLevel});
      }
      //...ADD YOUR CODE HERE EVENTUALLY
    });

    $(oMain).on("show_interlevel_ad", function(evt) {
      if(getParamValue('ctl-arcade') === "true"){
        parent.__ctlArcadeShowInterlevelAD();
      }
      //...ADD YOUR CODE HERE EVENTUALLY
    });
    
    $(oMain).on("share_event", function(evt, iScore) {
      if(getParamValue('ctl-arcade') === "true"){
        parent.__ctlArcadeShareEvent({
          img: TEXT_SHARE_IMAGE,
          title: TEXT_SHARE_TITLE,
          msg: TEXT_SHARE_MSG1 + iScore + TEXT_SHARE_MSG2,
          msg_share: TEXT_SHARE_SHARE1 + iScore + TEXT_SHARE_SHARE1
        });
      }
      //...ADD YOUR CODE HERE EVENTUALLY
    });
        
    if(isIOS()){
      setTimeout(function(){sizeHandler();},200);
    }else{ sizeHandler(); }
    // console.log(getParamValue('ctl-arcade'));
  });
</script>
</html>