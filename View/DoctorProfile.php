<?php
include "../Controller/DoctorProfileController.php";
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($doctor["name"]); ?> - MediBook</title>
    <script src="../Controller/JS/LoadSlots.js"></script>
</head>
<body>
    <div class="topnav">
    <a href="BrowseDoctors.php" class="sitename"><span>Medi</span>Book</a>
    <ul class="nav-links">
        <li><a href="BrowseDoctors.php">Find a Doctor</a></li>
        <li><a href="MyAppointments.php">My Appointments</a></li>
        <li><a href="PatientHome.php">Home</a></li>
    </ul>
     <div class="nav-right">
        <p><?php
           echo htmlspecialchars($_SESSION["name"]);
         ?></p>
        <a href="../Controller/Logout.php" class="logout-btn">Logout</a>
    </div>
</div>
   
<div class="main-area">
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
        <div class="slots-row" id="slots-area">
            <p class="no-slots">Select a date above to see available times.</p>
        </div>
        <?php
         if (!empty($next7days)) 
            { ?>
        <h3>Your Details</h3>

        <form method="post" action="BookingConfirmation.php">
            <input type="hidden" name="doctor_id" id="doctor_id" value="<?php echo $doctor["id"]; ?>">
            <input type="hidden" name="date" id="selected_date" value="">
            <input type="hidden" name="time" id="selected_time" value="">

            <div class="two-col">
                <div class="input-group">
                    <label>Selected Date</label>
                    <input type="text" id="show-date" placeholder="Choose a date above" readonly>
                </div>
                <div class="input-group">
                    <label>Selected Time</label>
                    <input type="text" id="show-time" placeholder="Choose a slot above" readonly>
                </div>
            </div>
    
<div class="input-group">
                <label for="reason">Reason for Visit</label>
                <textarea id="reason" name="reason"
                          placeholder="Describe your symptoms or reason for the visit..." required></textarea>
            </div>

            <input type="submit" class="submit-btn" value="Book Appointment"
                   onclick="return checkBeforeBook()">

        </form>
        <?php } 
        ?>

    </div>

</div>

<script>
const origLoadSlots = LoadSlots;
LoadSlots = function(dateStr, btn)
{
    origLoadSlots(dateStr, btn);
    document.getElementById("show-date").value = btn.textContent.trim();
};

function checkBeforeBook() 
{
    let date = document.getElementById("selected_date").value;
    let time = document.getElementById("selected_time").value;
    if (!date) { alert("Please select a date first."); return false; }
    if (!time) { alert("Please select a time slot."); return false; }
    return true;
}
</script>

</body>
</html>