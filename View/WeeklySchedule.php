<?php
include "../Controller/WeeklyScheduleController.php";
?>
<!DOCTYPE html>
<html>
<head>
    <title>Weekly Schedule</title>
</head>
<body>
<div class="topbar">
    <h2>Hospital Appointment System — Doctor Panel</h2>
    <div style="display:flex; align-items:center; gap:12px;">
        <div class="nav-links">
            <a href="DoctorDashboard.php">Today</a>
            <a href="WeeklySchedule.php">Weekly Schedule</a>
        </div>
        <!-- <a href="../Controller/Logout.php">Logout</a> -->
    </div>

</div>
<div class="container">

    <h1>Weekly Schedule</h1>
    <p class="subtitle">
        Week: <?php echo date("d M", strtotime($week_start)) ?>
        &nbsp;–&nbsp;
        <?php echo date("d M Y", strtotime($week_end)) ?>
    </p>
</div>
</body>
</html>