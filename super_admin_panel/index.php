<?php
session_start();
include 'pages/config.php';
if(isset($_SESSION['admin_user_id']))
{
?>
<script>
window.location.href='<?php echo Super_Site_URL; ?>/domains.php';
</script>
<?php
}
else
{
?>
<script>
window.location.href='<?php echo Super_Site_URL; ?>/login.php';
</script>
<?php
}
?>
