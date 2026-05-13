<?php

session_start();
session_destroy();
setcookie("user_email", "", time()-3600, "/"); 
Header("Location: ../View/Login.php");
exit();
?>