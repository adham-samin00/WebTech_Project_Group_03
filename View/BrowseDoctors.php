<!DOCTYPE html>
<html>
    <head>
        <title>Browse Doctors</title>
    </head>
    <body>
        <div class="topbar">
            <a href="BrowseDoctors.php">Browse Doctors</a>
            <a href="MyAppointment.php">My Appointment</a>
</div> 
<div class="page-wrap">
    <h1>Find a Doctor</h1>

</div>
 <div class="filter-bar">
        <label for="specialization_id">Search Specialization: </label>
        <select id="specialization_id" name="specialization_id" onchange="FilterDoctors()">
            <option value="">All Specializations</option>
            <?php 
            foreach ($specializations as $spec) {
             ?>
                <option value="<?php echo $spec["id"] ?>">
                    <?php
                     echo $spec["name"]
                      ?>
                </option>
            <?php } 
            ?>
        </select>
    </div>
            <p><strong>Specialization:</strong></p>
            <p><strong>Fee:</strong> </p>
          
           <a href="DoctorProfile.php" class="book-btn">View &amp; Book</a>
    </div>

</body>
</html>