<?php
session_start();
session_destroy();
unset($_SESSION['regnum']);
header("location:studentlog.php");
?>
