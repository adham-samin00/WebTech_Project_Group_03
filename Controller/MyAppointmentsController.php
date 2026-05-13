<?php

include "../Model/MyappointmentsDb.php";
session_start();

$isLoggedIn = $_SESSION["loggedIn"] ?? false;

if (!$isLoggedIn || $_SESSION["role"] != "patient")
    {
        Header("Location: Login.php");
        exit();
    }
     
$patient_id = $_SESSION["user_id"];

$result =getMyAppointments( $patient_id);
$grouped = [
    "Pending"   => [],
    "Confirmed" => [],
    "Completed" => [],
    "Cancelled" => [],
    "No-Show"   => []
];

while ($row = $result->fetch_assoc())
    {
        $status = $row["status"];
        if (isset($grouped[$status]))
            {
                $grouped[$status][] = $row;
            }
    }
?>
