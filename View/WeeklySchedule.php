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

    <div class="section-title">Appointment Grid (Mon – Fri)</div>

    <div class="section-title">Appointment Grid (Mon – Fri)</div>

    <div class="week-grid">
        <div class="grid-header">Time</div>
        <?php foreach ($week_days as $day) { ?>
            <div class="grid-header">
                <?php echo date("D", strtotime($day)) ?><br>
                <span style="font-size:11px; font-weight:normal;">
                    <?php echo date("d M", strtotime($day)) ?>
                </span>
            </div>
        <?php } ?>

        <?php foreach ($time_slots as $slot) { ?>

        <div class="grid-time"><?php echo $slot ?></div>

        <?php foreach ($week_days as $day) { ?>
        <div class="grid-cell">
            <?php
                    foreach ($weekly_appointments as $appt) {
                        $appt_time = substr($appt["appointment_time"], 0, 5);
                        if ($appt["appointment_date"] == $day && $appt_time == $slot) {
                            $status_class = "status-" . strtolower(str_replace("-", "", $appt["status"]));
                    ?>
                    <div class="appt-block <?php echo $status_class ?>"
                         onclick="ToggleDetails(<?php echo $appt["id"] ?>)">
                        <?php echo $appt["patient_name"] ?>
                        <div class="appt-detail-box" id="detail_<?php echo $appt["id"] ?>">
                            <strong>Patient:</strong> <?php echo $appt["patient_name"] ?><br>
                            <strong>Time:</strong> <?php echo $appt["appointment_time"] ?><br>
                            <strong>Reason:</strong> <?php echo $appt["reason"] ?><br>
                            <strong>Status:</strong>
                            <span id="badge_<?php echo $appt["id"] ?>"
                                  class="badge badge-<?php echo strtolower(str_replace("-", "", $appt["status"])) ?>">
                                <?php echo $appt["status"] ?>
                            </span>
                            <br><br>
                            <div id="actions_<?php echo $appt["id"] ?>">
                            <?php if ($appt["status"] == "Pending" || $appt["status"] == "Confirmed") { ?>
                                <button class="btn btn-complete"
                                        onclick="UpdateStatus(<?php echo $appt["id"] ?>, 'Completed')">
                                    Completed
                                </button>
                                <button class="btn btn-noshow"
                                        onclick="UpdateStatus(<?php echo $appt["id"] ?>, 'No-Show')">
                                    No-Show
                                </button>
                            <?php } else { ?>
                                <span class="done-text"><?php echo $appt["status"] ?></span>
                            <?php } ?>
                            </div>
                        </div>
                    </div>
                    <?php
                        }
                    }
                    ?>
        </div>
        <?php } ?>

        <?php } ?>
    </div>
</div>
</body>
</html>