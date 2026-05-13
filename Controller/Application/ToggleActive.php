<?php

include "../../Model/AdminPanelDb.php";
session_start();

$isLoggedIn = $_SESSION["loggedIn"] ?? false;

if (!$isLoggedIn || $_SESSION["role"] != "admin")
    {
        echo json_encode(["ok" => false, "message" => "Unauthorized"]);
        exit();
    }

if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        $input   = json_decode(file_get_contents("php://input"), true);
        $user_id = intval($input["user_id"] ?? 0);

        if (!$user_id)
            {
                echo json_encode(["ok" => false, "message" => "Invalid user ID"]);
                exit();
            }

        $result = toggleUserActive($user_id);

        if ($result)
            {
                $statusResult = getUserActiveStatus($user_id);
                $row          = $statusResult->fetch_assoc();
                $new_status   = $row["is_active"];

                echo json_encode(["ok" => true, "is_active" => (int)$new_status]);
            }
        else
            {
                echo json_encode(["ok" => false, "message" => "Update failed"]);
            }
    }
else
    {
        echo json_encode(["ok" => false, "message" => "Method not allowed"]);
    }
?>
