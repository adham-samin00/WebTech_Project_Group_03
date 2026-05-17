<?php

include "../Model/AdminAppointmentDb.php";
session_start();

$isLoggedIn = $_SESSION["loggedIn"] ?? false;

if (!$isLoggedIn || $_SESSION["role"] != "admin")
    {
        Header("Location: Login.php");
        exit();
    }

$doctor_filter = $_GET["doctor_id"] ?? "";
$date_filter   = $_GET["appt_date"] ?? "";
$status_filter = $_GET["status"] ?? "";

$appointments = getAllAppointments($doctor_filter, $date_filter, $status_filter);

$doctors_result = getAllDoctors();
$doctors_list   = [];
while ($row = $doctors_result->fetch_assoc())
    {
        $doctors_list[] = $row;
    }

$all_statuses = ["Pending", "Confirmed", "Completed", "Cancelled", "No-Show"];
?>
