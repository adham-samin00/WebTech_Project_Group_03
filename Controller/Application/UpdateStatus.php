<?php

include_once "../../Model/DoctorDashboardDb.php";
session_start();

$isLoggedIn = $_SESSION["loggedIn"] ?? false;

if (!$isLoggedIn || $_SESSION["role"] != "doctor")
    {
        echo json_encode(["ok" => false, "message" => "Unauthorized"]);
        exit();
    }

if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        $input          = json_decode(file_get_contents("php://input"), true);
        $appointment_id = intval($input["appointment_id"] ?? 0);
        $new_status     = trim($input["status"] ?? "");

        $allowed = ["Completed", "No-Show"];

        if (!$appointment_id)
            {
                echo json_encode(["ok" => false, "message" => "Invalid appointment"]);
                exit();
            }

        if (!in_array($new_status, $allowed))
            {
                echo json_encode(["ok" => false, "message" => "Doctors can only mark Completed or No-Show"]);
                exit();
            }

        $doctorResult = getDoctorByUserId($_SESSION["user_id"]);
        $doctorRow    = $doctorResult->fetch_assoc();

        if (!$doctorRow)
            {
                echo json_encode(["ok" => false, "message" => "Doctor not found"]);
                exit();
            }

        $doctor_id = $doctorRow["id"];
        $affected  = updateStatusByDoctor($appointment_id, $doctor_id, $new_status);

        if ($affected > 0)
            {
                echo json_encode(["ok" => true, "new_status" => $new_status]);
            }
        else
            {
                echo json_encode(["ok" => false, "message" => "Could not update. Appointment may not belong to you."]);
            }
    }
else
    {
        echo json_encode(["ok" => false, "message" => "Invalid request"]);
    }
?>
