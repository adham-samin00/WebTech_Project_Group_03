<?php
include "../../Model/DoctorProfileDb.php";
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
   

$all_slots = [];
$start     = strtotime("09:00");
$end       = strtotime("17:00");

for ($t = $start; $t < $end; $t += 1800)
    {
        $all_slots[] = date("H:i", $t);
    }

$booked_result = getBookedTimes($doctor_id, $date);
$booked        = [];
while ($row = $booked_result->fetch_assoc())
    {
        $booked[] = substr($row["appointment_time"], 0, 5);
    }
$available = [];
foreach ($all_slots as $slot)
    {
        if (!in_array($slot, $booked))
            {
                $available[] = $slot;
            }
    }
    if (empty($available))
    {
        echo "<p class='no-slots'>No slots available for this date.</p>";
    }
else
    {
        foreach ($available as $slot)
            {
                echo "<button type='button' class='slot-btn' onclick='PickSlot(\"$slot\", this)'>$slot</button>";
            }
    }
?>
