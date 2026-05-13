<?php

include "../Model/AdminPanelDb.php";
session_start();

$isLoggedIn = $_SESSION["loggedIn"] ?? false;

if (!$isLoggedIn || $_SESSION["role"] != "admin")
    {
        Header("Location: ../View/Login.php");
        exit();
    }

$users = getAllUsers();
?>
