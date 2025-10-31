<?php
if (!isloggedin()) {
    $redirect = basename($_SERVER['PHP_SELF']);
    header("Location: login.php?redirect=$redirect");
    exit();
}
?>