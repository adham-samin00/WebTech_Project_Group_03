<?php

include "../Model/LoginDb.php";
session_start();


$error = "";

if($_SERVER["REQUEST_METHOD"] == "POST")
{
    $email = trim($_POST["email"] ?? "");
    $password = $_POST["password"] ?? "";

    if(empty($email) || ! preg_match("/^[a-zA-Z0-9._]+@[a-zA-Z0-9.]+\.[a-zA-Z]{2,}$/", $email))
        {
            $error = "Please enter a valid email address";
        }
    elseif(empty($password))
        {
            $error = "Password is required";
        }
    else
        {
            $result = getUserByEmail($email);

            if($result->num_rows == 1)
                {
                    $row = $result->fetch_assoc();

                    if($row["is_active"] == 0)
                        {
                            $error = "Your account has been deactivated. Contact admin";
                        }
                    elseif(password_verify($password, $row["password_hash"]))
                        {
                            $_SESSION["user_id"] = $row["id"];
                            $_SESSION["name"]     = $row["name"];
                            $_SESSION["role"]     = $row["role"];
                            $_SESSION["loggedIn"] = true;

                            setcookie("user_email", $row["email"], time()+3600, "/");

                            if ($row["role"] == "patient")
                                    {
                                        Header("Location: ../View/PatientHome.php");
                                        exit();
                                    }
                            // elseif ($row["role"] == "doctor")
                            //     {
                            //         Header("Location: ../View/DoctorDashboard.php");
                            //         exit();
                            //     }
                            // elseif ($row["role"] == "admin")
                            //     {
                            //         Header("Location: ../View/AdminPanel.php");
                            //         exit();
                            //     }
                        }
                    else
                        {
                            $error = "Invalid email or password";
                        }
                }
            else
                {
                    $error = "Invalid email or password";
                }

        }

}
?>