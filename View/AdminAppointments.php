<?php
include "../Controller/AdminAppointmentsController.php";
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Appointments - MediBook Admin</title>
    <script src="../Controller/JS/AdminUpdateStatus.js"></script>
</head>
<body>

<nav class="navbar">
        <a href="AdminPanel.php" class = "navbar-logo">CareCraft</a>
        <ul>
            <li><a href="AdminPanel.php">Users</a></li>
            <li><a href="Specializations.php">Specialization</a></li>
            <li><a href="AdminDoctors.php">Doctors</a></li>
        </ul>
        <a href="../Controller/Logout.php" class = "logout-btn">Logout</a>
</nav>

<div class="main-area">

    <h2>Appointment Management</h2>
    <p class="page-desc">View and manage all appointments in the system</p>

    <form method="get" action="AdminAppointments.php">
        <div class="filter-bar">

            <label for="doctor_id">Doctor:</label>
            <select id="doctor_id" name="doctor_id">
                <option value="">All Doctors</option>
                <?php foreach ($doctors_list as $doc) {
                    $sel = ($doctor_filter == $doc["id"]) ? "selected" : "";
                    echo "<option value='{$doc['id']}' $sel>" . htmlspecialchars($doc["name"]) . "</option>";
                } ?>
            </select>

            <label for="appt_date">Date:</label>
            <input type="date" id="appt_date" name="appt_date"
                   value="<?php echo htmlspecialchars($date_filter); ?>">

            <label for="status">Status:</label>
            <select id="status" name="status">
                <option value="">All Statuses</option>
                <?php foreach ($all_statuses as $st) {
                    $sel = ($status_filter == $st) ? "selected" : "";
                    echo "<option value='$st' $sel>$st</option>";
                } ?>
            </select>

            <button type="submit" class="filter-btn">Filter</button>
            <a href="AdminAppointments.php" class="clear-link">Clear</a>

        </div>
    </form>

    <table class="data-table">
        <thead>
            <tr>
                <th>#</th>
                <th>Patient</th>
                <th>Doctor</th>
                <th>Date</th>
                <th>Time</th>
                <th>Reason</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $count = 0;
            while ($row = $appointments->fetch_assoc())
                {
                    $count++;
                    $status  = $row["status"];
                    $tag_css = "tag-" . strtolower(str_replace("-", "", $status));
                    $appt_id = $row["id"];
            ?>
                <tr>
                    <td>#<?php echo $appt_id; ?></td>
                    <td><?php echo htmlspecialchars($row["patient_name"]); ?></td>
                    <td><?php echo htmlspecialchars($row["doctor_name"]); ?></td>
                    <td><?php echo date("d M Y", strtotime($row["appointment_date"])); ?></td>
                    <td><?php echo substr($row["appointment_time"], 0, 5); ?></td>
                    <td><?php echo htmlspecialchars($row["reason"]); ?></td>
                    <td>
                        <span class="status-tag <?php echo $tag_css; ?>">
                            <?php echo $status; ?>
                        </span>
                    </td>
                    <td class="action-btns">
                        <?php if ($status == "Pending") { ?>
                            <button class="action-confirm"
                                onclick="AdminUpdateStatus(<?php echo $appt_id; ?>, 'Confirmed', this)">
                                Confirm
                            </button>
                            <button class="action-cancel"
                                onclick="AdminUpdateStatus(<?php echo $appt_id; ?>, 'Cancelled', this)">
                                Cancel
                            </button>
                        <?php } elseif ($status == "Confirmed") { ?>
                            <button class="action-cancel"
                                onclick="AdminUpdateStatus(<?php echo $appt_id; ?>, 'Cancelled', this)">
                                Cancel
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
                    echo "<tr><td colspan='8' class='no-data'>No appointments found.</td></tr>";
                }
            ?>
        </tbody>
    </table>

</div>

</body>
</html>
