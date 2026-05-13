<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Booking Confirmed - MediBook</title> 
    <!-- <link rel="stylesheet" href="style.css">  -->
</head>
<body>
    <div class="topnav">
    <a href="BrowseDoctors.php" class="sitename"><span>Medi</span>Book</a>
    <ul class="nav-links">
        <li><a href="BrowseDoctors.php">Find a Doctor</a></li>
        <li><a href="MyAppointments.php">My Appointments</a></li>
    </ul>
    <div class="nav-right">
        <p><?php echo htmlspecialchars($_SESSION["name"]); ?></p>
        <a href="../Controller/Logout.php" class="logout-btn">Logout</a>
    </div>
</div>
<div class="main-area">
    <div class="confirm-box">

        <h2>Appointment Booked!</h2>
        <p>
            Your appointment has been submitted successfully.
        </p>

        <div class="appt-id">Appointment ID: #<?php echo $appointment["id"]; ?></div>

        <div class="confirm-details">
            <div class="confirm-row">
                <span>Doctor</span>
                <span><?php echo htmlspecialchars($appointment["doctor_name"]); ?></span>
            </div>
            <div class="confirm-row">
                <span>Specialization</span>
                <span><?php echo htmlspecialchars($appointment["specialization"] ?? "General"); ?></span>
            </div>
            <div class="confirm-row">
                <span>Date</span>
                <span><?php echo date("d M Y", strtotime($appointment["appointment_date"])); ?></span>
            </div>
            <div class="confirm-row">
                <span>Time</span>
                <span><?php echo substr($appointment["appointment_time"], 0, 5); ?></span>
            </div>
            <div class="confirm-row">
                <span>Reason</span>
                <span><?php echo htmlspecialchars($appointment["reason"]); ?></span>
            </div>
            <div class="confirm-row">
                <span>Status</span>
                <span><span class="status-tag tag-pending">Pending</span></span>
            </div>
        </div>
        <div class="confirm-btns">
            <a href="MyAppointments.php" class="green-btn">My Appointments</a>
            <a href="BrowseDoctors.php" class="grey-btn">Find Another Doctor</a>
        </div>

    </div>
</div>

</body>
</html>