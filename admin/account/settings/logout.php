<?php
//start_session
 @session_start();

// Unset all session variables
session_unset();

// Destroy the session
session_destroy();

echo '
<script>
window.location.href = "../login/";
</script>
';
exit();
?>
