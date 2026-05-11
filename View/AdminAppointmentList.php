<?php
include "../Controller/AdminAppointmentController.php";
?>
<!DOCTYPE html>
<html>
<head>
    <title>Admin - Appointment List</title>
</head>
<body>
<div class="topbar">
    <h2>Hospital Appointment System — Admin Panel</h2>
    <div style="display:flex; align-items:center; gap:12px;">
        <div class="nav-links">
            <a href="AdminAppointmentList.php">Appointments</a>
        </div>
        <!-- <a href="../Controller/Logout.php">Logout</a> -->
    </div>
</div>
<div class="container">
    <h1>All Appointments</h1>
    <p class="subtitle">Filter and manage all patient appointments</p>

    <form method="get" action="AdminAppointmentList.php">
        <div class="filter-bar">
            <div>
                <label for="doctor_id">Doctor</label>
                <select name="doctor_id" id="doctor_id">
                    <option value="">All Doctors</option>
                    <?php foreach ($all_doctors as $doc) { ?>
                        <option value="<?php echo $doc["id"] ?>"
                            <?php if ($filter_doctor == $doc["id"]) { echo "selected"; } ?>>
                            <?php echo $doc["name"] ?>
                        </option>
                    <?php } ?>

                </select>
            </div>
            <div>
                <label for="date">Date</label>
                <input type="date" name="date" id="date" value="<?php echo $filter_date ?>">
            </div>
            <div>
                <label for="status">Status</label>
                <select name="status" id="status">
                    <option value="">All Status</option>
                    <option value="Pending"   <?php if ($filter_status == "Pending")   { echo "selected"; } ?>>Pending</option>
                    <option value="Confirmed" <?php if ($filter_status == "Confirmed") { echo "selected"; } ?>>Confirmed</option>
                    <option value="Completed" <?php if ($filter_status == "Completed") { echo "selected"; } ?>>Completed</option>
                    <option value="Cancelled" <?php if ($filter_status == "Cancelled") { echo "selected"; } ?>>Cancelled</option>
                    <option value="No-Show"   <?php if ($filter_status == "No-Show")   { echo "selected"; } ?>>No-Show</option>
                </select>
            </div>
            <div>
                <input type="submit" value="Apply Filter">
            </div>
        </div>
    </form>

    <p id="msg"></p>

    <?php if (count($all_appointments) == 0) { ?>
        <div class="no-data">No appointments found for the selected filters.</div>
    <?php } else  ?>

    <table>
        <tr>
            <th>ID</th>
            <th>Patient</th>
            <th>Doctor</th>
            <th>Date</th>
            <th>Time</th>
            <th>Reason</th>
            <th>Status</th>
            <th>Actions</th>
        </tr>
        <?php foreach ($all_appointments as $appt) { ?>
        <tr>
            td><?php echo $appt["id"] ?></td>
            <td><?php echo $appt["patient_name"] ?></td>
            <td><?php echo $appt["doctor_name"] ?></td>
            <td><?php echo $appt["appointment_date"] ?></td>
            <td><?php echo $appt["appointment_time"] ?></td>
            <td><?php echo $appt["reason"] ?></td>
            <td>
                <span id="badge_<?php echo $appt["id"] ?>"
                      class="badge badge-<?php echo strtolower(str_replace("-", "", $appt["status"])) ?>">
                    <?php echo $appt["status"] ?>
                </span>
            </td>
            <td id="actions_<?php echo $appt["id"] ?>">
                <?php if ($appt["status"] == "Pending") { ?>
                    <!-- Admin can Confirm a Pending appointment -->
                    <button class="btn btn-confirm"
                            onclick="ConfirmAppointment(<?php echo $appt["id"] ?>)">
                        Confirm
                    </button>
                    <!-- Cancel with reason -->
                    <div class="cancel-box">
                        <textarea id="cancel_reason_<?php echo $appt["id"] ?>"
                                  placeholder="Cancel reason..."></textarea>
                        <button class="btn btn-cancel"
                                onclick="CancelAppointment(<?php echo $appt["id"] ?>)">
                            Cancel
                        </button>
                    </div>

                <?php } elseif ($appt["status"] == "Confirmed") { ?>
                <!-- Admin can still cancel a confirmed appointment -->
                    <div class="cancel-box">
                        <textarea id="cancel_reason_<?php echo $appt["id"] ?>"
                                  placeholder="Cancel reason..."></textarea>
                        <button class="btn btn-cancel"
                                onclick="CancelAppointment(<?php echo $appt["id"] ?>)">
                            Cancel
                        </button>
                    </div>

                <?php } else { ?>
                    <span class="done-text"><?php echo $appt["status"] ?></span>
                <?php } ?>
            </td>
        </tr>
    </table>



    <?php } ?>

</div>
</body>
</html>