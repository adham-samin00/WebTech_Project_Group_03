<?php
session_start();
include "../../Model/UpdateStatusByAdminDb.php";

$isLoggedIn = $_SESSION["loggedIn"] ?? false;

if (!$isLoggedIn || $_SESSION["role"] != "admin")
    {
        echo json_encode(["ok" => false, "message" => "Unauthorized"]);
        exit();
    }

if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        $input          = json_decode(file_get_contents("php://input"), true);
        $appointment_id = intval($input["appointment_id"] ?? 0);
        $new_status     = trim($input["status"] ?? "");

        $allowed = ["Pending", "Confirmed", "Completed", "Cancelled", "No-Show"];

        if (!$appointment_id)
            {
                echo json_encode(["ok" => false, "message" => "Invalid appointment"]);
                exit();
            }

        if (!in_array($new_status, $allowed))
            {
                echo json_encode(["ok" => false, "message" => "Invalid status"]);
                exit();
            }

        $affected = updateStatusByAdmin($appointment_id, $new_status);

        if ($affected > 0)
            {
                echo json_encode(["ok" => true, "new_status" => $new_status]);
            }
        else
            {
                echo json_encode(["ok" => false, "message" => "Could not update status"]);
            }
    }
else
    {
        echo json_encode(["ok" => false, "message" => "Invalid request"]);
    }
?>
