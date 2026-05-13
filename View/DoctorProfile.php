<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($doctor["name"]); ?> - MediBook</title>
    <!-- <link rel="stylesheet" href="style.css">
    <script src="../Controller/JS/LoadSlots.js"></script> -->
</head>
<body>
    <div class="topnav">
    <a href="BrowseDoctors.php" class="sitename"><span>Medi</span>Book</a>
    <ul class="nav-links">
        <li><a href="BrowseDoctors.php">Find a Doctor</a></li>
        <li><a href="MyAppointments.php">My Appointments</a></li>
    </ul>
     <div class="nav-right">
        <p><?php
        //  echo htmlspecialchars($_SESSION["name"]);
         ?></p>
        <a href="../Controller/Logout.php" class="logout-btn">Logout</a>
    </div>
</div>
   
</html>