<?php
include "../Model/BrowseDoctorsdb.php";
// session_start();

// $isLoggedIn = $_SESSION["loggedIn"] ?? false;

// if (!$isLoggedIn || $_SESSION["role"] != "patient")
//     {
//         Header("Location: Login.php");
//         exit();
//     }

$database   = new db();
$connection = $database->connection();

$specializationsResult = $database->getAllSpecializations($connection);
$specializations       = [];
while ($row = $specializationsResult->fetch_assoc())
    {
        $specializations[] = $row;
    }

$doctors = $database->getAllActiveDoctors($connection);


?>


