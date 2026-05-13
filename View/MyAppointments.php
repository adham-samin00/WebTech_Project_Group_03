<?php
include "../Controller/MyAppointmentsController.php";
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Appointments - MediBook</title>
    <!-- <link rel="stylesheet" href="style.css">
    <script src="../Controller/JS/CancelAppointment.js"></script> -->
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

    <h2>My Appointments</h2>
    <p class="page-desc">All your appointments grouped by status</p>

    <?php
    $groups = [
        "Pending"   => ["label" => "Pending",   "title_css" => "title-pending",   "tag_css" => "tag-pending"],
        "Confirmed" => ["label" => "Confirmed",  "title_css" => "title-confirmed", "tag_css" => "tag-confirmed"],
        "Completed" => ["label" => "Completed",  "title_css" => "title-completed", "tag_css" => "tag-completed"],
        "Cancelled" => ["label" => "Cancelled",  "title_css" => "title-cancelled", "tag_css" => "tag-cancelled"],
        "No-Show"   => ["label" => "No-Show",    "title_css" => "title-noshow",    "tag_css" => "tag-noshow"]
    ];

    foreach ($grouped as $status => $appts)
        {
            $info = $groups[$status];
    ?>
  <div class="appt-section">
        <div class="group-title <?php echo $info['title_css']; ?>">
            <?php echo $info["label"]; ?> (<?php echo count($appts); ?>)
        </div>
 <?php if (empty($appts)) { ?>
            <p>
                No <?php echo strtolower($info["label"]); ?> appointments.
            </p>
        <?php } else { ?>
            <table class="appt-table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Doctor</th>
                        <th>Specialization</th>
                        <th>Date</th>
                        <th>Time</th>
                        <th>Reason</th>
                        <th>Status</th>
                        <?php if ($status == "Pending") { ?>
                            <th>Action</th>
                        <?php } ?>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($appts as $appt) { ?>
                    <tr>
                        <td>#<?php echo $appt["id"]; ?></td>
                        <td><?php echo htmlspecialchars($appt["doctor_name"]); ?></td>
                        <td><?php echo htmlspecialchars($appt["specialization"] ?? "General"); ?></td>
                        <td><?php echo date("d M Y", strtotime($appt["appointment_date"])); ?></td>
                        <td><?php echo substr($appt["appointment_time"], 0, 5); ?></td>
                        <td><?php echo htmlspecialchars($appt["reason"]); ?></td>
                        <td>
                            <span class="status-tag <?php echo $info['tag_css']; ?>">
                                <?php echo $appt["status"]; ?>
                            </span>
                        </td>
                        <?php if ($status == "Pending") { ?>
                            <td>
                                <button class="cancel-btn"
                                    onclick="CancelAppointment(<?php echo $appt['id']; ?>, this)">
                                    Cancel
                                </button>
                            </td>
                        <?php }
                         ?>
                    </tr>
                    <?php }
                     ?>
                </tbody>
            </table>
        <?php }
         ?>
    </div>

    <?php 
    } ?>
 <a href="BrowseDoctors.php" class="book-more-link">+ Book a New Appointment</a>

</div>

</body>
</html>