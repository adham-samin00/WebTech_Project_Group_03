<?php

session_start();

$name        = "";
$email       = "";
$dob         = "";
$blood_group = "";
$phone       = "";
$error       = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name        = trim($_POST["name"] ?? "");
    $email       = trim($_POST["email"] ?? "");
    $password    = $_POST["password"] ?? "";
    $dob         = $_POST["dob"] ?? "";
    $blood_group = $_POST["blood_group"] ?? "";
    $phone       = trim($_POST["phone"] ?? "");
}
