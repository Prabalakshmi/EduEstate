<?php
session_start();

// Unset all of the session variables
session_unset();

// Destroy the session
session_destroy();

// Redirect the user to the login page
header('Location: sign_in.html');
exit();
?>
