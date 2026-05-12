<?php
    $action= $_GET["action"] ?? "add";
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
                        <input type="submit" class="btn-add" value="Update Doctor">
                        <a href="AdminDoctors.php" class="btn-cancel-link">Cancel</a>
                    </div>
                </form>
            </div>

        <?php } ?>


    </div>
<body>
    
</body>
</html>