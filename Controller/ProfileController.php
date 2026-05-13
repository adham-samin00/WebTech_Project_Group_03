<?php

include "../Model/UserProfileDb.php";
session_start();

$isLoggedIn = $_SESSION["loggedIn"] ?? false;

if (!$isLoggedIn || $_SESSION["role"] != "patient")
    {
        Header("Location: ../View/Login.php");
        exit();
    }



$user_id = $_SESSION["user_id"];
$success = "";
$error   = "";
$upcoming_count = 0;

if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        $action = $_POST["action"] ?? "";

        if ($action == "update_profile")
            {
                $name  = trim($_POST["name"] ?? "");
                $phone = trim($_POST["phone"] ?? "");
                $dob   = $_POST["dob"] ?? "";

                if (strlen($name) < 3)
                    {
                        $error = "Name must be at least 3 characters.";
                    }
                elseif (!preg_match('/^[0-9]{11}$/', $phone))
                    {
                        $error = "Phone must be exactly 11 digits.";
                    }
                elseif (empty($dob))
                    {
                        $error = "Date of birth is required.";
                    }
                else
                    {
                        $result = updateProfile($user_id, $name, $phone, $dob);
                        if ($result)
                            {
                                $_SESSION["name"] = $name;
                                $success = "Profile updated successfully.";
                            }
                        else
                            {
                                $error = "Update failed. Please try again.";
                            }
                    }
            }
        elseif ($action == "change_password")
            {
                $current_password = $_POST["current_password"] ?? "";
                $new_password     = $_POST["new_password"] ?? "";
                $confirm_password = $_POST["confirm_password"] ?? "";

                $userResult = getUserById($user_id);
                $user       = $userResult->fetch_assoc();

                if (!password_verify($current_password, $user["password_hash"]))
                    {
                        $error = "Current password is incorrect.";
                    }
                elseif (strlen($new_password) < 6)
                    {
                        $error = "New password must be at least 6 characters.";
                    }
                elseif ($new_password !== $confirm_password)
                    {
                        $error = "New passwords do not match.";
                    }
                else
                    {
                        $new_hash = password_hash($new_password, PASSWORD_DEFAULT);
                        $result   = updatePassword($user_id, $new_hash);
                        if ($result)
                            {
                                $success = "Password changed successfully.";
                            }
                        else
                            {
                                $error = "Password change failed. Please try again.";
                            }
                    }

            }


    }


    $userResult      = getUserById($user_id);
    $user            = $userResult->fetch_assoc();

    $countResult     = getUpcomingAppointmentCount($user_id);
    $countRow        = $countResult->fetch_assoc();
    $upcoming_count  = $countRow["count"] ?? 0;


?>
