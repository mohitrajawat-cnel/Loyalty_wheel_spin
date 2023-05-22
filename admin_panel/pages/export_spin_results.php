<?php
session_start();
include 'config.php';

if(!isset($_SESSION['admin_user_id']))
{
?>
	<script>

    window.location.href='<?php echo Site_URL; ?>/login.php';
    </script>
<?php
}
?>
<script src="js/jquery.js"></script> 
<script>
  jQuery(document).ready(function(){

    var start = 0;

    send_export_result(start);

    function send_export_result(start)
    {
      
        
          jQuery.ajax({
                url: '<?php echo Site_URL; ?>/ajax_for_export_result.php',
                type: 'POST',
                data: {"export_results":"export_results","start":start},
                success:function(starthwe)
                {
                  if(starthwe == 0)
                  {
                      window.location.href = '<?php echo Site_URL; ?>/spin-results.csv';
                      jQuery.ajax({
                        url: '<?php echo Site_URL; ?>/ajax_for_export_result.php',
                        type: 'POST',
                        data: {"export_results_success":"export_results_success"},
                        success:function(value_hwe)
                        {
                        }
                    });
                    
                  }
                  else
                  {
               
                    var start = parseInt(starthwe);
                    send_export_result(start);
                  }
                  
                }
            });
    }

  });

</script>
<center><h2>Results Exporting, please Wait....</h2></center>