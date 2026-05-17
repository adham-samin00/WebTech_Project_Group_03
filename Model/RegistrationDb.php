<?php
include "db.php";

function registerPatient($name, $email, $password_hash, $dob, $blood_group, $phone)
{
    $database   = new db();
    $connection = $database->connection();
    $sql       = "INSERT INTO users (name, email, password_hash, role, dob, blood_group, phone, is_active, created_at) VALUES (?, ?, ?, 'patient', ?, ?, ?, 1, NOW())";
    $statement = $connection->prepare($sql);
    $statement->bind_param("ssssss", $name, $email, $password_hash, $dob, $blood_group, $phone);
    $result = $statement->execute();
    return $result;
}

function checkEmailExists($email)
{
    $database   = new db();
    $connection = $database->connection();
    $sql       = "SELECT id FROM users WHERE email = ?";
    $statement = $connection->prepare($sql);
    $statement->bind_param("s", $email);
    $statement->execute();
    $result = $statement->get_result();
    return $result;
}
?>
