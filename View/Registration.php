<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register — MediBook</title>
</head>

</html>

<body>
    <nav class="navbar">
        <span>Medi</span> Book
    </nav>
    <div class="auth-wrapper">
        <div class="card card-sm">
            <div class="card-header">
                <div class="logo-mark"></div>
                <h1>Create Account</h1>
                <p>Register your account here</p>
            </div>

            <form method="post" action="Registration.php">
                <div class="form-group">
                    <label for="name">Full Name</label>
                    <input type="text" id="name" name="name" placeholder="e.g. Rahim Uddin" value="" required>
                </div>

                <div class="form-group">
                    <label for="email">Email Address</label>
                    <input type="email" id="email" name="email" placeholder="you@example.com" value="" required>
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" placeholder="Minimum 6 characters" required>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="dob">Date of Birth</label>
                        <input type="date" id="dob" name="dob"
                            value="" required>
                    </div>

                    <div class="form-group">
                        <label for="blood_group">Blood Group</label>
                        <select id="blood_group" name="blood_group" required>
                            <option value="">-- Select --</option>
                            <?php
                                $groups = ["A+", "A-", "B+", "B-", "AB+", "AB-", "O+", "O-"];
                                foreach ($groups as $g) {
                                    $selected = ($blood_group == $g) ? "selected" : "";
                                    echo "<option value=\"$g\" $selected>$g</option>";
                                }
                            ?>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label for="phone">Phone Number</label>
                    <input type="text" id="phone" name="phone" placeholder="01XXXXXXXXX (11 digits)"
                        value="" required>
                </div>

                <input type="submit" class="btn btn-primary" value="Create Account">

            </form>

            <div>

            </div>

        </div>

    </div>
</body>