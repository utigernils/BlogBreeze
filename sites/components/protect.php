<?php
if (!isloggedin()) {
    $redirect = $_SERVER['REQUEST_URI'];
    header("Location: login.php?redirect=$redirect");
    exit();
}
?>