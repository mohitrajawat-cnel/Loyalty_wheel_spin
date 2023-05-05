<?php
session_start();
include 'pages/config.php';
if(isset($_SESSION['admin_user_id']))
{
?>
<script>
window.location.href='<?php echo Site_URL; ?>/users.php';
</script>
<?php
}
else
{
?>
<script>
window.location.href='<?php echo Site_URL; ?>/login.php';
</script>
<?php
}
?>
