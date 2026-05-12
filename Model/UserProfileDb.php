<?php
include "db.php";

function updateProfile($id, $name, $phone, $dob)
{
    $database   = new db();
    $connection = $database->connection();
    $sql = "UPDATE users SET name = ?, phone = ?, dob = ? WHERE id = ?";
    $statement = $connection->prepare($sql);
    $statement->bind_param("sssi", $name, $phone, $dob, $id);
    $result = $statement->execute();
    return $result;
}

function getUserById($id)
{
    $database   = new db();
    $connection = $database->connection();
    $sql = "SELECT * FROM users WHERE id = ?";
    $statement = $connection->prepare($sql);
    $statement->bind_param("i", $id);
    $statement->execute();
    $result = $statement->get_result();
    return $result;
}

function updatePassword($id, $new_password_hash)
{
    $database   = new db();
    $connection = $database->connection();
    $sql = "UPDATE users SET password_hash = ? WHERE id = ?";
    $statement = $connection->prepare($sql);
    $statement->bind_param("si", $new_password_hash, $id);
    $result = $statement->execute();
    return $result;
}

function getUpcomingAppointmentCount($patient_id)
{
    $database   = new db();
    $connection = $database->connection();
    $today = date('Y-m-d');
    $sql   = "SELECT COUNT(*) as count FROM appointments WHERE patient_id = ? AND status IN ('Pending','Confirmed') AND appointment_date >= ?";
    $statement = $connection->prepare($sql);
    $statement->bind_param("is", $patient_id, $today);
    $statement->execute();
    $result = $statement->get_result();
    return $result;
}

?>