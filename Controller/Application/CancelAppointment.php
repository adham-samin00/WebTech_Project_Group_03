<?php

include "../Model/MyappointmentsDb.php";
session_start();

$isLoggedIn = $_SESSION["loggedIn"] ?? false;

if (!$isLoggedIn || $_SESSION["role"] != "patient")
    {
        echo json_encode(["ok" => false, "message" => "Unauthorized"]);
        exit();
    }

if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        $input          = json_decode(file_get_contents("php://input"), true);
        $appointment_id = intval($input["appointment_id"] ?? 0);
        $patient_id     = $_SESSION["user_id"];

        if (!$appointment_id)
            {
                echo json_encode(["ok" => false, "message" => "Invalid appointment"]);
                exit();
            }
