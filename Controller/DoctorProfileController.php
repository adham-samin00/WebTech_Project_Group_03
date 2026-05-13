<?php

include "../Model/DoctorProfileDb.php";
// session_start();

// $isLoggedIn = $_SESSION["loggedIn"] ?? false;

// if (!$isLoggedIn || $_SESSION["role"] != "patient")
//     {
//         Header("Location: Login.php");
//         exit();
//     }

// $doctor_id = intval($_GET["id"] ?? 0);

// if (!$doctor_id)
//     {
//         Header("Location: BrowseDoctors.php");
//         exit();
//     }
$database   =new db();
$connection =$database->connection();

$result = $database->getDoctorById($connection, $doctor_id);
$doctor = $result->fetch_assoc();

if (!$doctor)
    {
        Header("Location: BrowseDoctors.php");
        exit();
    }
$available_days = [];
if (!empty($doctor["available_days"]))
    {
        $available_days = explode(",", $doctor["available_days"]);
        $available_days = array_map("trim", $available_days);
    }

?>
