<?php
include "../Controller/BrowseDoctorsController.php";
?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Find a Doctor - MediBook</title>
    <link rel="stylesheet" href="style.css">
    <script src="../Controller/JS/FilterDoctors.js"></script>
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

    <h2>Find a Doctor</h2>
    <p class="page-desc">Browse available doctors and book an appointment</p>
    <div class="filter-bar">
        <label for="spec-filter">Filter by Specialization:</label>
        <select id="spec-filter" onchange="FilterDoctors(this)">
            <option value="0">All Specializations</option>
            <?php foreach ($specializations as $spec) { ?>
                <option value="<?php echo $spec["id"]; ?>">
                    <?php echo htmlspecialchars($spec["name"]); ?>
                </option>
            <?php } ?>
        </select>
    </div>
    
</body>
</html>