<?php

include "db.php";


function getAllUsers()
{
    $database = new db();
    $connection = $database->connection();
    $sql    = "SELECT id, name, email, role, is_active, created_at FROM users ORDER BY created_at DESC";
    $result = $connection->query($sql);
    return $result;
}

function toggleUserActive($user_id)
{
    $database = new db();
    $connection = $database->connection();
    $sql = "UPDATE users SET is_active = NOT is_active WHERE id = ?";
    $statement = $connection->prepare($sql);
    $statement->bind_param("i", $user_id);
    $result = $statement->execute();
    return $result;
}


function getUserActiveStatus($user_id)
{
    $database = new db();
    $connection = $database->connection();
    $sql = "SELECT is_active FROM users WHERE id = ?";
    $statement = $connection->prepare($sql);
    $statement->bind_param("i", $user_id);
    $statement->execute();
    $result = $statement->get_result();
    return $result;
}

?>