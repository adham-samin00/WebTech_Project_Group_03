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
    function getAllDoctorsWithStats()
        {
            $database   = new db();
            $connection = $database->connection();
            $sql = "SELECT d.id, u.name, u.email, u.is_active, s.name AS specialization,
                        d.consultation_fee, d.photo_path, d.available_days, d.created_at,
                        COUNT(a.id) AS appointment_count
                    FROM doctors d
                    JOIN users u ON d.user_id = u.id
                    LEFT JOIN specializations s ON d.specialization_id = s.id
                    LEFT JOIN appointments a ON d.id = a.doctor_id
                    GROUP BY d.id
                    ORDER BY d.created_at DESC";
            $result = $connection->query($sql);
            return $result;
        }
    function getDoctorById($doctor_id)
        {
            $database   = new db();
            $connection = $database->connection();
            $sql = "SELECT d.*, u.name, u.email, u.is_active, u.id AS user_id,
                        s.name AS specialization_name
                    FROM doctors d
                    JOIN users u ON d.user_id = u.id
                    LEFT JOIN specializations s ON d.specialization_id = s.id
                    WHERE d.id = ?";
            $statement = $connection->prepare($sql);
            $statement->bind_param("i", $doctor_id);
            $statement->execute();
            $result = $statement->get_result();
            return $result;
        }
    function updateDoctor($doctor_id, $specialization_id, $bio, $consultation_fee, $photo_path, $available_days)
        {
            $database   = new db();
            $connection = $database->connection();
            $sql = "UPDATE doctors SET specialization_id = ?, bio = ?, consultation_fee = ?,
                    photo_path = ?, available_days = ? WHERE id = ?";
            $statement = $connection->prepare($sql);
            $statement->bind_param("isdssi", $specialization_id, $bio, $consultation_fee, $photo_path, $available_days, $doctor_id);
            $result = $statement->execute();
            return $result;
        }
    function updateDoctorUser($user_id, $name, $email)
        {
            $database   = new db();
            $connection = $database->connection();
            $sql = "UPDATE users SET name = ?, email = ? WHERE id = ?";
            $statement = $connection->prepare($sql);
            $statement->bind_param("ssi", $name, $email, $user_id);
            $result = $statement->execute();
            return $result;
        }
    function deactivateDoctorUser($user_id)
        {
            $database   = new db();
            $connection = $database->connection();
            $sql = "UPDATE users SET is_active = 0 WHERE id = ?";
            $statement = $connection->prepare($sql);
            $statement->bind_param("i", $user_id);
            $result = $statement->execute();
            return $result;
        }
    function getDoctorCount($id)
        {
            $database = new db();
            $connection = $database->connection();
            $sql = "SELECT COUNT(*) AS TOTAL 
                    FROM appointments 
                    WHERE doctor_id = '".$id."'";
            $result = $connection->query($sql);
            return $result;
        }


?>