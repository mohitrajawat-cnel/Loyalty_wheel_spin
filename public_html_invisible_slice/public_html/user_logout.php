<?php
session_start();
session_unset();
session_destroy();
include 'admin_panel/pages/config.php';
?>
<script>
window.location.href='<?php echo Front_URL; ?>';
</script>
<?php
?>