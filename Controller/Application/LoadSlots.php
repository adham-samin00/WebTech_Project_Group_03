<?php

include "";
session_start();

$isLoggedIn = $_SESSION["loggedIn"] ?? false;

if (!$isLoggedIn || $_SESSION["role"] != "patient")
    {
        echo "<p>Unauthorized</p>";
        exit();
    }
    $doctor_id = intval($_GET["doctor_id"] ?? 0);
      $date      = trim($_GET["date"] ?? "");

if (!$doctor_id || empty($date))
    {
        echo "<p class='no-slots'>Invalid request.</p>";
        exit();
    }
    $database   = new db();
$connection = $database->connection();

// all time slots 09:00 to 17:00 every 30 minutes
$all_slots = [];
$start     = strtotime("09:00");
$end       = strtotime("17:00");

for ($t = $start; $t < $end; $t += 1800)
    {
        $all_slots[] = date("H:i", $t);
    }