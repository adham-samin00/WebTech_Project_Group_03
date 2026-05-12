<?php
    include "../Model/AdminDoctorDb.php";
    session_start();

    $error   = "";
    $success = "";
    $action  = $_GET["action"] ?? "list";
    $edit_id = intval($_GET["id"] ?? 0);

    $weekdays = ["Saturday","Sunday","Monday", "Tuesday", "Wednesday", "Thursday", "Friday"];
    if($_SERVER["REQUEST_METHOD"] == "POST")
        {
            $post_action      = $_POST["action"] ?? "";
            $name             = trim($_POST["name"] ?? "");
            $email            = trim($_POST["email"] ?? "");
            $password         = $_POST["password"] ?? "";
            $specialization_id = intval($_POST["specialization_id"] ?? 0);
            $bio              = trim($_POST["bio"] ?? "");
            $consultation_fee = floatval($_POST["consultation_fee"] ?? 0);
            $days_checked     = $_POST["available_days"] ?? [];
            $available_days   = implode(",", $days_checked);
        }
    
?>