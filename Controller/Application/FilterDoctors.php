<?php

include "../../Model/DoctorProfileDb.php";
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
    while ($row = $result->fetch_assoc())
    {
        $initial = strtoupper(substr($row["name"], 0, 1));
        $fee     = number_format($row["consultation_fee"], 0);
        $spec    = htmlspecialchars($row["specialization"] ?? "General");
        $name    = htmlspecialchars($row["name"]);
        $id      = $row["id"];

        if (!empty($row["photo_path"]))
            {
                $photo = "<img src='" . htmlspecialchars($row["photo_path"]) . "' class='doc-photo' alt=''>";
            }
        else
            {
                $photo = "<div class='doc-initial'>$initial</div>";
            }

        echo "
        <div class='doc-card'>
            <div class='doc-card-top'>$photo</div>
            <div class='doc-card-info'>
                <h3>$name</h3>
                <p class='doc-spec'>$spec</p>
                <p class='doc-fee'>BDT $fee</p>
                <a href='DoctorProfile.php?id=$id' class='view-btn'>View &amp; Book</a>
            </div>
        </div>";
    }
?>