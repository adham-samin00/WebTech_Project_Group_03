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
        
    </div>
</div>

<div class="container">
    <h1>Good day, Dr. </h1>
    <p class="subtitle">Today's date: <?php echo date("l, d F Y") ?></p>

    <div class="section-title">Today's Appointments</div>

    <p id="msg"></p>

</div>
</body>
</html>