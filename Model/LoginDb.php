<?php
include "db.php";

function getUserByEmail($email)
{
    $database = new db();
    $connection = $database->connection();
    $sql = "SELECT * FROM users WHERE email = ?";
    $statement = $connection->prepare($sql);
    $statement->bind_param("s", $email);
    $statement->execute();
    $result = $statement->get_result();
    return $result;
}