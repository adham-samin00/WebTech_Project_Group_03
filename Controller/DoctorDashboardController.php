<?php
include "../Model/DoctorDashboardDb.php";
session_start();
$today_appointments = array();
$error = "";

// if (!isset($_SESSION["doctor_id"]) || $_SESSION["role"] != "doctor") {
//     Header("Location: ../View/Login.php ");
//     exit();
// }

$doctor_id = $_SESSION["doctor_id"];
$today = date("Y-m-d");


$result = getTodayAppointments($connection, "appointments", $doctor_id, $today);

if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $today_appointments[] = $row;
    }
}

?>