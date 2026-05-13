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