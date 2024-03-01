<?php
//start_session
 @session_start();

// Unset all session variables
session_unset();

// Destroy the session
session_destroy();

// redirect user
echo '
<script>
window.location.href = "../../";
</script>
';
?>
