<?php
include "../Controller/RegistrationController.php";
?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - MediBook</title>
    <link rel="stylesheet" href="style.css">
    <script src="../Controller/JS/CheckUserName.js"></script>
</head>
<body>

<div class="topnav">
    <a href="Login.php" class="sitename">+<span>Medi</span>Book</a>
</div>

<div class="center-box">
    <div class="form-box">

        <h2>Create Account</h2>
        <p class="subtitle">Register as a patient</p>

        <?php if (!empty($error)) { ?>
            <div class="msg-error"><?php echo htmlspecialchars($error); ?></div>
        <?php } ?>

        <form method="post" action="../Controller/RegistrationController.php">

            <div class="input-group">
                <label for="name">Full Name</label>
                <input type="text" id="name" name="name"
                       placeholder="e.g. Rahim Uddin"
                       value="<?php echo htmlspecialchars($name); ?>" required>
            </div>

            <div class="input-group">
                <label for="email">Email Address</label>
                <input type="email" id="email" name="email"
                       placeholder="you@example.com"
                       value="<?php echo htmlspecialchars($email); ?>"
                       onkeyup="CheckUserName()" required>
                <div class="email-check" id="email-msg"></div>
            </div>

            <div class="input-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password"
                       placeholder="Minimum 6 characters" required>
            </div>

            <div class="two-col">
                <div class="input-group">
                    <label for="dob">Date of Birth</label>
                    <input type="date" id="dob" name="dob"
                           value="<?php echo htmlspecialchars($dob); ?>" required>
                </div>

                <div class="input-group">
                    <label for="blood_group">Blood Group</label>
                    <select id="blood_group" name="blood_group" required>
                        <option value="">-- Select --</option>
                        <?php
                        $groups = ["A+", "A-", "B+", "B-", "AB+", "AB-", "O+", "O-"];
                        foreach ($groups as $g)
                            {
                                $selected = ($blood_group == $g) ? "selected" : "";
                                echo "<option value=\"$g\" $selected>$g</option>";
                            }
                        ?>
                    </select>
                </div>
            </div>

            <div class="input-group">
                <label for="phone">Phone Number</label>
                <input type="text" id="phone" name="phone"
                       placeholder="01XXXXXXXXX"
                       value="<?php echo htmlspecialchars($phone); ?>" required>
            </div>

            <input type="submit" class="submit-btn" value="Create Account">

        </form>

        <div class="bottom-link">
            Already have an account? <a href="Login.php">Log In</a>
        </div>

    </div>
</div>

</body>
</html>
