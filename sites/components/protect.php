<?php
if (!isloggedin()) {
    $redirect = $_SERVER['REQUEST_URI'];
    header("Location: sites/login.php?redirect=$redirect");
}
exit();
?>