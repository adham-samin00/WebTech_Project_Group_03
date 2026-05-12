<?php
    include "db.php";
    function createDoctorUser($name, $email, $password_hash)
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
    function getAllSpecializations()
    {
        $database   = new db();
        $connection = $database->connection();
        $sql    = "SELECT * FROM specializations ORDER BY id ASC";
        $result = $connection->query($sql);
        return $result;
    }
    function createDoctor($user_id, $specialization_id, $bio, $consultation_fee, $photo_path, $available_days)
    {
        $database   = new db();
        $connection = $database->connection();
        $sql = "INSERT INTO doctors (user_id, specialization_id, bio, consultation_fee, photo_path, available_days, created_at)
                VALUES (?, ?, ?, ?, ?, ?, NOW())";
        $statement = $connection->prepare($sql);
        $statement->bind_param("iisdss", $user_id, $specialization_id, $bio, $consultation_fee, $photo_path, $available_days);
        $result = $statement->execute();
        return $result;
    }
    function checkEmailExists($email)
    {
        $database   = new db();
        $connection = $database->connection();
        $sql = "SELECT id FROM users WHERE email = ?";
        $statement = $connection->prepare($sql);
        $statement->bind_param("s", $email);
        $statement->execute();
        $result = $statement->get_result();
        return $result;
    }


?>