<?php

include "../Model/BookingConfirmationDb.php";
session_start();

$isLoggedIn = $_SESSION["loggedIn"] ?? false;

if (!$isLoggedIn || $_SESSION["role"] != "patient")
    {
        Header("Location: Login.php");
        exit();
    }

$appointment_id = intval($_GET["id"] ?? 0);

if (!$appointment_id)
    {
        Header("Location: BrowseDoctors.php");
        exit();
    }
$result      = $database->getAppointmentDetails( $appointment_id);
$appointment = $result->fetch_assoc();
if (!$appointment || $appointment["patient_id"] != $_SESSION["user_id"])
    {
        Header("Location: BrowseDoctors.php");
        exit();
    }
?>