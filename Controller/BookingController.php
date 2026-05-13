<?php

include "../Model/BookingControllerDb.php";
// session_start();

// $isLoggedIn = $_SESSION["loggedIn"] ?? false;

// if (!$isLoggedIn || $_SESSION["role"] != "patient")
//     {
//         Header("Location: Login.php");
//         exit();
//     }

$database   = new db();
$connection = $database->connection();

$doctor_id  = intval($_POST["doctor_id"] ?? 0);
$date       = trim($_POST["date"] ?? "");
$time       = trim($_POST["time"] ?? "");
$reason     = trim($_POST["reason"] ?? "");
$patient_id = $_SESSION["user_id"];
$error      = "";

if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        if (!$doctor_id)
            {
                $error = "Invalid doctor.";
            }
        elseif (empty($date))
            {
                $error = "Please select a date.";
            }
        elseif (empty($time))
            {
                $error = "Please select a time slot.";
            }
        elseif (empty($reason))
            {
                $error = "Please enter a reason for your visit.";
            }
        else
            {     $check = $database->checkSlotTaken($connection, $doctor_id, $date, $time);
                 if ($check->num_rows > 0)
                    {
                        $error = "This slot was just taken. Please go back and choose another time.";
                    }
                else
                    {
                        $appointment_id = $database->saveAppointment($connection, $patient_id, $doctor_id, $date, $time, $reason);

                        if ($appointment_id)
                            {
                                Header("Location: BookingConfirmation.php?id=" . $appointment_id);
                                exit();
                            }
                        else
                            {
                                $error = "Booking failed. Please try again.";
                            }
                    }
            }
    }