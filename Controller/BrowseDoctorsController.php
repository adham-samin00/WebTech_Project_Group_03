<?php
include "../Model/BrowseDoctorsDb.php";
session_start();

$isLoggedIn = $_SESSION["loggedIn"] ?? false;

if (!$isLoggedIn || $_SESSION["role"] != "patient")
    {
        Header("Location: Login.php");
        exit();
    }


$specializationsResult = getAllSpecializations();
$specializations       = [];
while ($row = $specializationsResult->fetch_assoc())
    {
        $specializations[] = $row;
    }

$doctors = getAllActiveDoctors();


?>


