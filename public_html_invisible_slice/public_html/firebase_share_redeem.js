window.onload =function(){
	render();
}
function render(){

	window.recaptchaVerifier = new firebase.auth.RecaptchaVerifier('recaptcha-conatiner',{'size': 'invisible'
});
	recaptchaVerifier.render();
}

function sendOTP_hwe()
{


	var phone_number_withoutcn_code = document.getElementById('user_mobile_number_share').value;
  var show_number_code = "+"+document.getElementById('country_code_share').value;
  var show_number_code='+60';
  var phone_number = show_number_code+phone_number_withoutcn_code;



      var get_full_url = document.domain;

          jQuery.ajax({
            type: "POST",
            url: "https://"+get_full_url+"/admin_panel/pages/send_ajax_data.php",
            data: { 
              phone_number_save_check: 'phone_number_save_check',
                user_spin_code : phone_number
            
            },
            success:function(result)
            {

            
               if(result == '1')
               {
                  alert('Mobile Number Already Exists.');
                  
               }
               else
               {
                  firebase.auth().signInWithPhoneNumber(phone_number, window.recaptchaVerifier)
                  .then(function(confirmationResult){
                    // SMS sent. Prompt user to type the code from the message, then sign the
                    // user in with confirmationResult.confirm(code).
                    window.confirmationResult = confirmationResult;
                    coderesult=confirmationResult;
                    console.log(coderesult);
              
                    
                   
                 
                    jQuery("#save_otp_share_redeem").show();
                    jQuery("#save_otp_share_redeem").attr("style","display:block;");
              
                   
                    jQuery("#share_user_otp_check").hide();
                    jQuery("#share_user_otp_check").attr("style","display:none;");

                  
                    jQuery("#otp_enter_box").show();
                    jQuery("#otp_enter_box").attr("style","display:block;");

                    jQuery("#mobile_number_enter_box").hide();
                    jQuery("#mobile_number_enter_box").attr("style","display:none;");

                    


                        var get_full_url = document.domain;
              
                        jQuery.ajax({
                          type: "POST",
                          url: "https://"+get_full_url+"/admin_panel/pages/send_ajax_data.php",
                          data: { 
                              phone_number_save: 'phone_number_save',
                              user_spin_code : phone_number
                          
                          },
                          success:function(response)
                          {
                          
                          }
                      });
                
                  }).catch(function(error){
                    // Error; SMS not sent
                    // ...
                    alert(error.message);
                  });
               }

            }
        });

	
}

function varify_code()
{
 
	var code = document.getElementById('user_otp_number_share').value;
	
    coderesult.confirm(code).then(function(result){
        // User signed in successfully.
        var user = result.user;

                var get_full_url = document.domain;

                jQuery.ajax({
                  type: "POST",
                  url: "https://"+get_full_url+"/admin_panel/pages/send_ajax_data.php",
                  data: { 
                      phone_number_save: 'phone_number_save',
                      user_spin_code : user.phoneNumber,
                      otp_number : code,

                  
                  },
                  success:function(response)
                  {
                    alert("Verified Sucessfully");
                    document.getElementById('submit_form_redeem_user').click();
                  }
              });
        
       // window.location.reload();
        //   addEventListener('load', (event) => {
        //     console.log('The page is fully loaded.');
        // });
        // ...
        }).catch(function(error){
        // User couldn't sign in (bad verification code?)
        // ...
        alert("Otp doesn't match");
        });
}
