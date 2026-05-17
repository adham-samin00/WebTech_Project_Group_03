<?php
include "../Controller/ProfileController.php";
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Profile - MediBook</title>
    <link rel="stylesheet" href="CSS/PatientHome.css">  
</head>

<body>

    <div class="topnav">
        <a href="PatientHome.php" class="sitename"><span>Medi</span>Book</a>
    <ul class="nav-links">
        <li><a href="BrowseDoctors.php">Find a Doctor</a></li>
        <li><a href="MyAppointments.php">My Appointments</a></li>
        <li><a href="PatientHome.php">Home</a></li>
    </ul>
        <div class="nav-right">
            <p>Hello, <?php echo htmlspecialchars($_SESSION["name"]); ?></p>
            <a href="../Controller/Logout.php" class="logout-btn">Logout</a>
        </div>
    </div>

    <div class="main-area">

        <h2>My Profile</h2>
        <p class="page-desc">Update your personal information and password</p>


        <div class="count-box">
            <div class="big-number"><?php echo $upcoming_count?> </div>
            <div class="count-label">Upcoming Appointments</div>
        </div>

        <?php if (!empty($success)) { ?>
            <div class="msg-success"><?php echo htmlspecialchars($success); ?></div>
        <?php } ?>
        <?php if (!empty($error)) { ?>
            <div class="msg-error"><?php echo htmlspecialchars($error); ?></div>
        <?php } ?>

        <div class="two-panel">

            
            <div class="panel-box">
                <h3>Update Profile</h3>

                <form method="post" action="PatientHome.php">
                    <input type="hidden" name="action" value="update_profile">

                    <div class="input-group">
                        <label for="name">Full Name</label>
                        <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($user["name"] ?? ""); ?>" required>
                    </div>

                    <div class="input-group">
                        <label for="phone">Phone Number</label>
                        <input type="text" id="phone" name="phone" value="<?php echo htmlspecialchars($user["phone"] ?? ""); ?>" required>
                    </div>

                    <div class="input-group">
                        <label for="dob">Date of Birth</label>
                        <input type="date" id="dob" name="dob" value="<?php echo htmlspecialchars($user["dob"] ?? ""); ?>" required>
                    </div>

                    <div class="input-group">
                        <label>Email</label>
                        <input type="email" value="<?php echo htmlspecialchars($user["email"] ?? ""); ?>" disabled>
                    </div>

                    <div class="input-group">
                        <label>Blood Group</label>
                        <input type="text" value="<?php echo htmlspecialchars($user["blood_group"] ?? ""); ?>" disabled>
                    </div>

                    <input type="submit" class="submit-btn" value="Save Changes">
                </form>
            </div>

            
            <div class="panel-box">
                <h3>Change Password</h3>

                <form method="post" action="PatientHome.php">
                    <input type="hidden" name="action" value="change_password">

                    <div class="input-group">
                        <label for="current_password">Current Password</label>
                        <input type="password" id="current_password" name="current_password" placeholder="Enter current password" required>
                    </div>

                    <div class="input-group">
                        <label for="new_password">New Password</label>
                        <input type="password" id="new_password" name="new_password" placeholder="Minimum 6 characters" required>
                    </div>

                    <div class="input-group">
                        <label for="confirm_password">Confirm New Password</label>
                        <input type="password" id="confirm_password" name="confirm_password" placeholder="Repeat new password" required>
                    </div>

                    <input type="submit" class="submit-btn" value="Update Password">
                </form>
            </div>

        </div>
    </div>

</body>

</html>