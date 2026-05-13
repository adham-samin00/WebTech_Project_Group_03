<?php

include "../Model/BookingControllerDb.php";

// session_start();

// $isLoggedIn = $_SESSION["loggedIn"] ?? false;

// if (!$isLoggedIn || $_SESSION["role"] != "patient")
//     {
//         Header("Location: Login.php");
//         exit();
//     }

$database   = new db();
$connection = $database->connection();

$doctor_id  = intval($_POST["doctor_id"] ?? 0);
$date       = trim($_POST["date"] ?? "");
$time       = trim($_POST["time"] ?? "");
$reason     = trim($_POST["reason"] ?? "");
$patient_id = $_SESSION["user_id"];
$error      = "";
?>