<?php
    // clear session
    session_start();
    session_unset();
    session_destroy();
    // clear cookies
    setcookie("email", "", time() - 3600, '/');
    setcookie("name", "", time() - 3600, '/');
    // redirect to login page
    header("Location: ../../login.php");

?>