<?php
include "../Controller/DoctorDashboardController.php";
?>
<!DOCTYPE html>
<html>
<head>
    <title>Doctor Dashboard</title>
</head>
<body>

<div class="topbar">
    <h2>Hospital Appointment System-Doctor Panel</h2>
    <div style="display:flex; align-items:center; gap:12px;">
        <div class="nav-links">
            <a href="DoctorDashboard.php">Today</a>
            <a href="WeeklySchedule.php">Weekly Schedule</a>
        </div>
        <a href="../Controller/Logout.php">Logout</a>
    </div>
</div>

<div class="container">
    <h1>Good day, Dr. </h1>
    <p class="subtitle">Today's date: <?php echo date("l, d F Y") ?></p>

    <div class="section-title">Today's Appointments</div>

    <p id="msg"></p>

    <?php if (count($today_appointments) == 0) { ?>
        <div class="no-data">No appointments scheduled for today.</div>
    <?php } else { ?>

    <table>
        <tr>
            <th>Time</th>
            <th>Patient Name</th>
            <th>Reason</th>
            <th>Status</th>
            <th>Actions</th>
        </tr>
        <?php foreach ($today_appointments as $appt) { ?>
        <tr>
            <td><?php echo $appt["appointment_time"] ?></td>
            <td><?php echo $appt["patient_name"] ?></td>
            <td><?php echo $appt["reason"] ?></td>
            <td>
                <span id="badge_<?php echo $appt["id"] ?>"
                      class="badge badge-<?php echo strtolower(str_replace("-", "", $appt["status"])) ?>">
                    <?php echo $appt["status"] ?>
                </span>
            </td>
            <td id="actions_<?php echo $appt["id"] ?>">
                <?php if ($appt["status"] == "Pending" || $appt["status"] == "Confirmed") { ?>
                    <button class="btn btn-complete"
                            onclick="UpdateStatus(<?php echo $appt["id"] ?>, 'Completed')">
                        Mark Completed
                    </button>
                    <button class="btn btn-noshow"
                            onclick="UpdateStatus(<?php echo $appt["id"] ?>, 'No-Show')">
                        Mark No-Show
                    </button>
                <?php } else { ?>
                    <span class="done-text"><?php echo $appt["status"] ?></span>
                <?php } ?>
            </td>
        </tr>
        <?php } ?>
    </table>
    <?php } ?>

</div>
</body>
</html>