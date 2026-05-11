<?php
include "../Model/DoctorDashboardDb.php";
session_start();

$today_appointments = array();
$error = "";

if (!isset($_SESSION["doctor_id"]) || $_SESSION["role"] != "doctor") {
    // Header("Location: ../View/Login.php ");
    exit();
}

$database = new db();
$connection = $database->connection();

$doc_result = getDoctorIdByUserId($connection, $_SESSION["user_id"]);
if (!$doc_result || $doc_result->num_rows == 0) {
    die("Doctor record not found.");
}
$doc_row   = $doc_result->fetch_assoc();
$doctor_id = $doc_row["id"]; // this is doctors.id

$today  = date("Y-m-d");
$result = getTodayAppointments($connection, "appointments", $doctor_id, $today);

if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $today_appointments[] = $row;
    }
}
?>