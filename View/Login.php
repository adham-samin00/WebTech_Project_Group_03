<?php
include "../Controller/LoginController.php";
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Login.css">
    <title>Login - MediBook</title>
</head>

<body>
    <div class="topnav">
        <a href="Login.php" class="sitename"><span>Medi</span>Book</a>
    </div>

    <div class="center-box">
        <div class="form-box">

            <h2>Welcome Back</h2>
            <p class="subtitle">Sign in to your account</p>

            <?php if (isset($_GET["registered"])) { ?>
                <div class="msg-success">Registration successful! Please log in.</div>
            <?php } ?>

            <?php if (!empty($error)) { ?>
                <div class="msg-error"><?php echo htmlspecialchars($error); ?></div>
            <?php } ?>


            <form method="post" action="Login.php">

                <div class="input-group">
                    <label for="email">Email Address</label>
                    <input type="email" id="email" name="email" placeholder="you@example.com" required>
                </div>

                <div class="input-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" placeholder="Enter your password" required>
                </div>

                <input type="submit" class="submit-btn" value="Log In">

            </form>

            <div class="bottom-link">
                Don't have an account? <a href="Registration.php">Create an account</a>
            </div>

        </div>
    </div>
</body>

</html>