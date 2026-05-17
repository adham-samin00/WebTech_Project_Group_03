<?php
include "../Controller/DoctorDashboardController.php";
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doctor Dashboard - MediBook</title>
    <link rel="stylesheet" href="CSS/DoctorDashboard.css">
    <script src="../Controller/JS/UpdateStatus.js"></script>
</head>
<body>

<div class="topnav">
    <a href="DoctorDashboard.php" class="sitename"><span>Medi</span>Book</a>
    <div class="nav-right">
        <p>Dr. <?php echo htmlspecialchars($_SESSION["name"]); ?></p>
        <a href="../Controller/Logout.php" class="logout-btn">Logout</a>
    </div>
</div>

<div class="main-area">

    <h2>Doctor Dashboard</h2>
    <p class="page-desc">Today is <?php echo date("l, d M Y"); ?></p>

    
    <div class="section-head">Today's Appointments</div>

    <table class="data-table">
        <thead>
            <tr>
                <th>#</th>
                <th>Patient</th>
                <th>Time</th>
                <th>Reason</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $count = 0;
            while ($row = $today_appointments->fetch_assoc())
                {
                    $count++;
                    $status    = $row["status"];
                    $tag_css   = "tag-" . strtolower(str_replace("-", "", $status));
                    $appt_time = substr($row["appointment_time"], 0, 5);
                    $appt_id   = $row["id"];
            ?>
                <tr>
                    <td><?php echo $count; ?></td>
                    <td><?php echo htmlspecialchars($row["patient_name"]); ?></td>
                    <td><?php echo $appt_time; ?></td>
                    <td><?php echo htmlspecialchars($row["reason"]); ?></td>
                    <td><span class="status-tag <?php echo $tag_css; ?>"><?php echo $status; ?></span></td>
                    <td class="action-btns">
                        <?php if ($status == "Pending" || $status == "Confirmed") { ?>
                            <button class="btn-complete"
                                onclick="UpdateStatus(<?php echo $appt_id; ?>, 'Completed', this)">
                                Completed
                            </button>
                            <button class="btn-noshow"
                                onclick="UpdateStatus(<?php echo $appt_id; ?>, 'No-Show', this)">
                                No-Show
                            </button>
                        <?php } else { ?>
                            -
                        <?php } ?>
                    </td>
                </tr>
            <?php
                }

            if ($count == 0)
                {
                    echo "<tr><td colspan='6' class='no-data'>No appointments today.</td></tr>";
                }
            ?>
        </tbody>
    </table>

    
    <div class="section-head">This Week's Schedule</div>

    <table class="week-grid">
        <thead>
            <tr>
                <th>Time</th>
                <?php foreach ($week_days as $wd) { ?>
                    <th><?php echo date("D d M", strtotime($wd)); ?></th>
                <?php } ?>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($grid_slots as $slot) { ?>
                <tr>
                    <td class="time-col"><?php echo $slot; ?></td>
                    <?php foreach ($week_days as $wd) { ?>
                        <td>
                            <?php if (isset($week_grid[$wd][$slot])) {
                                $appt      = $week_grid[$wd][$slot];
                                $block_css = "grid-block";
                                if ($appt["status"] == "Completed") $block_css .= " block-completed";
                                if ($appt["status"] == "Cancelled") $block_css .= " block-cancelled";
                                if ($appt["status"] == "No-Show")   $block_css .= " block-noshow";
                            ?>
                                <span class="<?php echo $block_css; ?>"
                                    onclick="showDetail(
                                        '<?php echo htmlspecialchars($appt['patient_name']); ?>',
                                        '<?php echo $wd; ?>',
                                        '<?php echo $slot; ?>',
                                        '<?php echo htmlspecialchars($appt['reason']); ?>',
                                        '<?php echo $appt['status']; ?>'
                                    )">
                                    <?php echo htmlspecialchars($appt["patient_name"]); ?>
                                </span>
                            <?php } ?>
                        </td>
                    <?php } ?>
                </tr>
            <?php } ?>
        </tbody>
    </table>

</div>

<div class="detail-popup" id="detail-popup">
    <div class="popup-box">
        <h3>Appointment Details</h3>
        <div class="popup-row"><span>Patient</span><span id="pop-patient"></span></div>
        <div class="popup-row"><span>Date</span><span id="pop-date"></span></div>
        <div class="popup-row"><span>Time</span><span id="pop-time"></span></div>
        <div class="popup-row"><span>Reason</span><span id="pop-reason"></span></div>
        <div class="popup-row"><span>Status</span><span id="pop-status"></span></div>
        <button class="close-popup" onclick="closeDetail()">Close</button>
    </div>
</div>

<script>
function showDetail(patient, date, time, reason, status) {
    document.getElementById("pop-patient").textContent = patient;
    document.getElementById("pop-date").textContent    = date;
    document.getElementById("pop-time").textContent    = time;
    document.getElementById("pop-reason").textContent  = reason;
    document.getElementById("pop-status").textContent  = status;
    document.getElementById("detail-popup").classList.add("show");
}

function closeDetail() {
    document.getElementById("detail-popup").classList.remove("show");
}
</script>

</body>
</html>
