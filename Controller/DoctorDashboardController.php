<?php

include "../Model/DoctorDashboardDb.php";
session_start();

$isLoggedIn = $_SESSION["loggedIn"] ?? false;

if (!$isLoggedIn || $_SESSION["role"] != "doctor")
    {
        Header("Location: Login.php");
        exit();
    }


$doctorResult = getDoctorByUserId($_SESSION["user_id"]);
$doctorRow    = $doctorResult->fetch_assoc();

if (!$doctorRow)
    {
        Header("Location: Login.php");
        exit();
    }

$doctor_id = $doctorRow["id"];

$today_appointments = getTodayAppointments($doctor_id);

$today      = date("Y-m-d");
$day_of_week = date("N"); 
$week_start  = date("Y-m-d", strtotime("-" . ($day_of_week - 1) . " days"));
$week_end    = date("Y-m-d", strtotime("+" . (5 - $day_of_week) . " days"));

$week_appointments = getWeekAppointments($doctor_id, $week_start, $week_end);

$week_grid = [];
while ($row = $week_appointments->fetch_assoc())
    {
        $d = $row["appointment_date"];
        $t = substr($row["appointment_time"], 0, 5);
        $week_grid[$d][$t] = $row;
    }

$week_days = [];
for ($i = 0; $i < 5; $i++)
    {
        $week_days[] = date("Y-m-d", strtotime($week_start . " +$i days"));
    }

$grid_slots = [];
$start      = strtotime("09:00");
$end        = strtotime("17:00");
for ($t = $start; $t < $end; $t += 1800)
    {
        $grid_slots[] = date("H:i", $t);
    }
?>
