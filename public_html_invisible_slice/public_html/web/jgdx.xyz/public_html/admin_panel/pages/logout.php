<?php
session_start();
session_unset();
session_destroy();

include 'config.php';
?>
<script>
window.location.href='<?php echo Site_URL; ?>/login.php';
</script>
<?php
?>