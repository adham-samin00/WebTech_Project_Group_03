<?php

include "../../Model/RegistrationDb.php";

$email = trim($_GET["email"] ?? "");

if (empty($email))
    {
        echo "";
        exit();
    }

$result = checkEmailExists($email);

if ($result->num_rows > 0)
    {
        echo "<span style='color:red; font-size:0.85rem;'>&#10007; This email is already registered.</span>";
    }
else
    {
        echo "<span style='color:green; font-size:0.85rem;'>&#10003; Email is available.</span>";
    }
?>
