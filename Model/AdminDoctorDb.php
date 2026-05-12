<?php
    include "db.php";
    function createDoctorUser($connection, $name, $email, $password_hash)
    {
        $database = new db();
        $connection = $database->connection();
        $sql = "INSERT INTO users (name, email, password_hash, role, is_active, created_at)
                VALUES (?, ?, ?, 'doctor', 1, NOW())";
        $statement = $connection->prepare($sql);
        $statement->bind_param("sss", $name, $email, $password_hash);
        $result = $statement->execute();
        if ($result)
            {
                return $connection->insert_id;
            }
        return false;
    }
?>