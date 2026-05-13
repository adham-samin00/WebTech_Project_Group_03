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

if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        if (!$doctor_id)
            {
                $error = "Invalid doctor.";
            }
        elseif (empty($date))
            {
                $error = "Please select a date.";
            }
        elseif (empty($time))
            {
                $error = "Please select a time slot.";
            }
        elseif (empty($reason))
            {
                $error = "Please enter a reason for your visit.";
            }
        else
            {
                // re-check slot is still free before saving
                $check = $database->checkSlotTaken($connection, $doctor_id, $date, $time);
            }
    ?>