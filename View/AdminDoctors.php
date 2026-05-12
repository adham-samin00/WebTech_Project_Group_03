<?php
    include "../AdminDoctorController.php"
    $action= $_GET["action"] ?? "";
    require_once("../Model/Specializationdb.php");
    $specializations = getAllSpecializations();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doctors</title>
</head>
    <nav class="navbar">
        <a href="AdminPanel.php" class = "navbar-logo">CareCraft</a>
        <ul>
            <li><a href="AdminPanel.php">Users</a></li>
            <li><a href="Specializations.php">Specialization</a></li>
            <li><a href="AdminDoctorDashboard.php">Doctors</a></li>
        </ul>
        <a href="../Controller/Logout.php" class = "logout-btn">Logout</a>
    </nav>
    <div class = "page-wrapper">
        <div class = "page-top">
            <h1 class = "title">Doctor Management</h1>
            <p class = "subtitle">Add, edit, and manage doctor profiles and weekly avilability</p>
            <?php if ($action != "add" && $action != "edit") { ?>
                <a href="AdminDoctors.php?action=add" class="btn-add">+ Add Doctor</a>
            <?php } ?>
        </div>
        <?php if (isset($_GET["success"])) {
            $msgs = [
                "created" => "Doctor added successfully.",
                "updated" => "Doctor profile updated.",
                "deleted" => "Doctor account deactivated."
            ];
            $msg = $msgs[$_GET["success"]] ?? "";
            if ($msg) echo "<div class='alert alert-success'>$msg</div>";
        } ?>
        <?php if (!empty($error)) { ?>
            <div class="alert alert-error"><?php echo $error; ?></div>
        <?php } ?>

        <?php
            $weekdays = ["Saturday","Sunday","Monday", "Tuesday", "Wednesday", "Thursday", "Friday"];
        ?>
        <?php if($action == "add"){ ?>
            <div class = "add_form">
                <form method="post" action="" ecntype="multipart/form-data">
                    <input type="hidden" name = "action" value = "create">
                    <div class="form-row">
                        <div class="form-group">
                            <label for="name">Full Name</label>
                            <input type="text" id="name" name="name" placeholder="Dr. Full Name" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email Address</label>
                            <input type="email" id="email" name="email" placeholder="doctor@gmail.com" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" id="password" name="password" placeholder="Minimum 6 characters" required>
                        </div>
                        <div class="form-group">
                            <label for="specialization_id">Specialization</label>
                            <select id="specialization_id" name="specialization_id" required>
                                <option value="">-- Select Specialization --</option>
                                <?php foreach ($specializations as $spec) { ?>
                                    <option value="<?php echo $spec["id"]; ?>">
                                        <?php echo htmlspecialchars($spec["name"]); ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="bio">Bio</label>
                        <textarea id="bio" name="bio" placeholder="Brief description of the doctor's background and expertise..."></textarea>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label for="consultation_fee">Consultation Fee (BDT)</label>
                            <input type="number" id="consultation_fee" name="consultation_fee"
                                placeholder="e.g. 800" min="1" step="0.01" required>
                        </div>
                        <div class="form-group">
                            <label for="photo">Profile Photo (JPEG/PNG, max 2MB)</label>
                            <input type="file" id="photo" name="photo" accept="image/jpeg, image/png">
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Available Days</label>
                        <div class="days-group">
                            <?php foreach ($weekdays as $day) { ?>
                                <input type="checkbox" class="day-checkbox"
                                    id="day_<?php echo $day; ?>"
                                    name="available_days"
                                    value="<?php echo $day; ?>">
                                <label class="day-label" for="day_<?php echo $day; ?>">
                                    <?php echo substr($day, 0, 3); ?>
                                </label>
                            <?php } ?>
                        </div>
                    </div>
                    <div class="form-actions">
                        <input type="submit" class="btn-add" value="Save Doctor">
                        <a href="AdminDoctors.php" class="btn-cancel-link">Cancel</a>
                    </div>
                </form>
            </div>
        <?php } ?>
        <?php if ($action == "" && $edit_data) {
            $saved_days = explode(",", $edit_data["available_days"] ?? "");
        ?>
            <div class = "form-panel">
                <div class="form-panel-title">Edit Doctor Profile</div>
                <form method = "post" action="" enctype = "multipart/form-data">
                    <input type="hidden" name="action" value="update">
                    <input type="hidden" name="doctor_id" value="<?php echo $edit_data["id"]; ?>">
                    <input type="hidden" name="user_id" value="<?php echo $edit_data["user_id"]; ?>">
                    <div class="form-row">
                        <div class="form-group">
                            <label for="name">Full Name</label>
                            <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($edit_data["name"]); ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email Address</label>
                            <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($edit_data["email"]); ?>" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="specialization_id">Specialization</label>
                        <select id="specialization_id" name="specialization_id" required>
                            <option value="">-- Select Specialization --</option>
                            <?php foreach ($specializations as $spec) {
                                $sel = ($spec["id"] == $edit_data["specialization_id"]) ? "selected" : "";
                                echo "<option value='{$spec['id']}' $sel>" . htmlspecialchars($spec["name"]) . "</option>";
                            } ?>
                        </select>
                    </div>
                        <div class="form-group">
                        <label for="bio">Bio</label>
                        <textarea id="bio" name="bio"><?php echo htmlspecialchars($edit_data["bio"]); ?></textarea>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label for="consultation_fee">Consultation Fee (BDT)</label>
                            <input type="number" id="consultation_fee" name="consultation_fee"
                                value="<?php echo $edit_data["consultation_fee"]; ?>" min="1" step="0.01" required>
                        </div>
                        <div class="form-group">
                            <label for="photo">Profile Photo (leave blank to keep current)</label>
                            <input type="file" id="photo" name="photo" accept="image/jpeg, image/png">
                            <?php if (!empty($edit_data["photo_path"])) { ?>
                                <div class="photo-preview">
                                    <img src="<?php echo htmlspecialchars($edit_data["photo_path"]); ?>" alt="Current photo">
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Available Days</label>
                        <div class="days-group">
                            <?php foreach ($weekdays as $day) {
                                $checked = in_array($day, $saved_days) ? "checked" : "";
                            ?>
                                <input type="checkbox" class="day-checkbox"
                                    id="edit_day_<?php echo $day; ?>"
                                    name="available_days[]"
                                    value="<?php echo $day; ?>" <?php echo $checked; ?>>
                                <label class="day-label" for="edit_day_<?php echo $day; ?>">
                                    <?php echo substr($day, 0, 3); ?>
                                </label>
                            <?php } ?>
                        </div>
                    </div>
                    <div class="form-actions">
                        <input type="submit" class="btn-add" value="Update Doctor">
                        <a href="AdminDoctors.php" class="btn-cancel-link">Cancel</a>
                    </div>
                </form>
            </div>
        <?php } ?>
        <div class="table-wrapper">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Doctor</th>
                        <th>Specialization</th>
                        <th>Fee (BDT)</th>
                        <th>Available Days</th>
                        <th>Status</th>
                        <th>Appointments</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 1;
                    while ($row = $doctors->fetch_assoc())
                        {
                            $is_active  = $row["is_active"];
                            $badge_text = $is_active ? "Active" : "Inactive";
                            $badge_cls  = $is_active ? "active" : "inactive";
                            $initial    = strtoupper(substr($row["name"], 0, 1));

                            // Build days pills
                            $days_str  = $row["available_days"] ?? "";
                            $days_arr  = $days_str ? explode(",", $days_str) : [];
                            $days_html = "";
                            foreach ($days_arr as $d)
                                {
                                    $days_html .= "<span class='day-pill'>" . substr(trim($d), 0, 3) . "</span>";
                                }
                            if (!$days_html) $days_html = "<span style='color:var(--gray-400);font-size:0.8rem;'>None set</span>";

                            // Photo or initial
                            if (!empty($row["photo_path"]))
                                {
                                    $photo_html = "<img src='" . htmlspecialchars($row["photo_path"]) . "' class='doctor-photo-sm' alt=''>";
                                }
                            else
                                {
                                    $photo_html = "<span class='doctor-photo-placeholder'>$initial</span>";
                                }

                            echo "<tr>
                                <td>$i</td>
                                <td>
                                    <div class='doctor-name-cell'>
                                        $photo_html
                                        <div>
                                            <strong>" . htmlspecialchars($row["name"]) . "</strong><br>
                                            <span style='font-size:0.78rem; color:var(--gray-400);'>" . htmlspecialchars($row["email"]) . "</span>
                                        </div>
                                    </div>
                                </td>
                                <td>" . htmlspecialchars($row["specialization"] ?? "—") . "</td>
                                <td>" . number_format($row["consultation_fee"], 0) . "</td>
                                <td><div class='days-pills'>$days_html</div></td>
                                <td><span class='status-badge $badge_cls'>$badge_text</span></td>
                                <td><span class='appt-count' id='appt-count-{$row['id']}'>...</span></td>
                                <td>
                                    <div class='actions-cell'>
                                        <a href='AdminDoctors.php?action=edit&id={$row['id']}' class='btn-edit'>Edit</a>
                                        <a href='../Controller/DoctorController.php?action=delete&id={$row['id']}'
                                        class='btn-delete'
                                        onclick=\"return confirm('Deactivate this doctor account?')\">Deactivate</a>
                                    </div>
                                </td>
                            </tr>";
                            $i++;
                        }

                    if ($i == 1)
                        {
                            echo "<tr><td>No doctors found. Add one above.</td></tr>";
                        }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

<body>
    
</body>
</html>