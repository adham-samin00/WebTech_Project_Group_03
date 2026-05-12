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
                </form>
            </div>

        <?php } ?>


    </div>
<body>
    
</body>
</html>