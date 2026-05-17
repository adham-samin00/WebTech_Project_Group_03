<?php
include "db.php";

function getAllSpecializations()
    {
        $database   = new db();
        $connection = $database->connection();
        $sql    = "SELECT * FROM specializations ORDER BY name ASC";
        $result = $connection->query($sql);
        return $result;
    }

 function getAllActiveDoctors()
    {
        $database   = new db();
        $connection = $database->connection();
        $sql    = "SELECT d.id, u.name, s.name AS specialization, d.consultation_fee, d.photo_path, d.specialization_id  FROM doctors d JOIN users u ON d.user_id = u.id LEFT JOIN specializations s ON d.specialization_id = s.id WHERE u.is_active = 1 ORDER BY u.name ASC";
        $result = $connection->query($sql);
        return $result;
    }
    function getDoctorsBySpecialization( $specialization_id)
    {
        $database   = new db();
        $connection = $database->connection();
        $sql = "SELECT d.id, u.name, s.name AS specialization, d.consultation_fee, d.photo_path, d.specialization_id FROM doctors d JOIN users u ON d.user_id = u.id  LEFT JOIN specializations s ON d.specialization_id = s.id  WHERE u.is_active = 1 AND d.specialization_id = ? ORDER BY u.name ASC";
        $statement = $connection->prepare($sql);
        $statement->bind_param("i", $specialization_id);
        $statement->execute();
        $result = $statement->get_result();
        return $result;
    }
?>