<?php
include "../Model/AdminAppointmentDb.php";
session_start();

$all_appointments = array();
$all_doctors = array();
$error = "";

// if (!isset($_SESSION["user_id"]) || $_SESSION["role"] != "admin") {
//     Header("Location: ../View/Login.php ");
//     exit();
// }
$database   = new db();
        $connection = $database->connection();

$filter_doctor = $_GET["user_id"] ?? "";
$filter_date   = $_GET["date"]      ?? "";
$filter_status = $_GET["status"]    ?? "";


// Get all doctors for dropdown — no tablename needed, method handles join internally
$doc_result = getAllDoctors($connection);
if ($doc_result && $doc_result->num_rows > 0) {
    while ($row = $doc_result->fetch_assoc()) {
        $all_doctors[] = $row;
    }
}

// Get filtered appointments
$result = getAllAppointments($connection, "appointments", $filter_doctor, $filter_date, $filter_status);
if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $all_appointments[] = $row;
    }
}
?>