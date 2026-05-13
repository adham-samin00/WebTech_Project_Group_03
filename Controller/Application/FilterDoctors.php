<?php

include "../Model/BrowseDoctorsDb.php";
session_start();

$isLoggedIn = $_SESSION["loggedIn"] ?? false;

if (!$isLoggedIn || $_SESSION["role"] != "patient")
    {
        echo "<p>Unauthorized</p>";
        exit();
    }
     
    $specialization_id = intval($_GET["specialization_id"] ?? 0);

if ($specialization_id > 0)
    {
        $result = getDoctorsBySpecialization( $specialization_id);
    }
else
    {
        $result = getAllActiveDoctors();
    }

if ($result->num_rows == 0)
    {
        echo "<p class='no-doctors'>No doctors found for this specialization.</p>";
        exit();
    }