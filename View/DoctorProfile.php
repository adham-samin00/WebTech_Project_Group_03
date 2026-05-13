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
           echo htmlspecialchars($_SESSION["name"]);
         ?></p>
        <a href="../Controller/Logout.php" class="logout-btn">Logout</a>
    </div>
</div>
   
<div class="main-area">

    <!-- doctor info -->
    <div class="doctor-info-box">
        <?php
         if (!empty($doctor["photo_path"])) 
         { ?>
            <img src="<?php echo htmlspecialchars($doctor["photo_path"]); ?>" class="doc-big-photo" alt="">
        <?php }
         else 
        { ?>
            <div class="doc-big-initial">
                <?php
                 echo strtoupper(substr($doctor["name"], 0, 1)); 
                 ?>
            </div>
        <?php } 
         ?>
            <div>
            <h2><?php
             echo htmlspecialchars($doctor["name"]); 
             ?>
             </h2>
            <p class="doc-spec"><?php echo htmlspecialchars($doctor["specialization"] ?? "General Medicine"); ?></p>
            <p class="doc-fee">Consultation Fee: BDT <?php echo number_format($doctor["consultation_fee"], 0); ?></p>
            <?php
             if (!empty($doctor["bio"])) { 
                ?>
                <p class="doc-bio"><?php echo htmlspecialchars($doctor["bio"]); ?></p>
            <?php 
            } ?>
        </div>
    </div>
    <div class="booking-box">

        <h3>Select Date</h3>
        <div class="date-row">
            <?php
             if (empty($next7days)) 
             { ?>
                <p class="no-slots">This doctor has no available days in the next 7 days.</p>
            <?php 
            } else { 
                ?>
                <?php
                 foreach ($next7days as $day) 
                 { ?>
                    <button type="button" class="date-btn"
                        onclick="LoadSlots('<?php echo $day['date']; ?>', this)">
                        <?php
                         echo htmlspecialchars($day["display"]);
                          ?>
                    </button>
                <?php 
                } ?>
            <?php
             } ?>
        </div>

        <h3>Select Time</h3>
</html>