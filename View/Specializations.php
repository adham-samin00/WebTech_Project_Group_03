<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doctor Specializations</title>
</head>
<body>
    <nav class="navbar">
        <a href="AdminPanel.php" class = "navbar-logo">CareCraft</a>
        <ul>
            <li><a href="AdminPanel.php">Users</a></li>
            <li><a href="Specializations.php">Specialization</a></li>
            <li><a href="AdminDoctorDashboard.php">Doctors</a></li>
        </ul>
        <a href="../Controller/Logout.php" class = "logout-btn">Logout</a>
    </nav>
    <div class ="page-toprow">
        <div>
            <h1 class="title">Specializations</h1>
            <p class="subtitle">Manage medical specializations for doctor profiles</p>
        </div>
        <?php if($action != "add" && $action != "edit"){ ?>
            <a href="Specializations.php?$action=add" class="btn-add">Add Specialization</a>
        <?php } ?>
    </div>
    <?php if($action == "add"){?>
        <div class = "add_form">
            <p class ="form-title">Add New Specilization</p>
            <form method = "post" action="">
                <input type="hidden" name = "action" value = "create">
                <div class="form-group">
                    <label for="name">Specilization Name</label>
                    <input type="text" id = "name" name = "name" placeholder = "e.g. Cardiology" required>
                </div>
                <div class = "form-actions">
                    <input type="submit" class="btn-add" value ="Save">
                    <a href="Specilizations.php" class="btn-cancel-link">Cancel</a>
                </div>
            </form>
        </div>
    <?php } ?>

</body>
</html>