<?php
if (session_status() !== PHP_SESSION_ACTIVE) session_start();
session_destroy();
$_SESSION['loggedin'] = false;
header("Location:articles.php");
exit();
