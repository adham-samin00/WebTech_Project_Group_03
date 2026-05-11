<?php

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
        

    </div>
<body>
    
</body>
</html>