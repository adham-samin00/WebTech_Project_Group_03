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
            if (strlen($name) < 3)
                {
                    $error = "Doctor name must be at least 3 characters.";
                }
            elseif (!filter_var($email, FILTER_VALIDATE_EMAIL))
                {
                    $error = "Please enter a valid email address.";
                }
            elseif ($specialization_id <= 0)
                {
                    $error = "Please select a specialization.";
                }
            elseif ($consultation_fee <= 0)
                {
                    $error = "Consultation fee must be greater than 0.";
                }
            elseif (empty($days_checked))
                {
                    $error = "Please select at least one available day.";
                }
            else{
                
            }
        }
    
?>