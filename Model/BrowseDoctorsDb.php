<?php
include "db.php"

function getAllSpecializations($connection)
    {
        $sql    = "SELECT * FROM specializations ORDER BY name ASC";
        $result = $connection->query($sql);
        return $result;
    }

 function getAllActiveDoctors($connection)
    {
        $sql    = "SELECT d.id, u.name, s.name AS specialization, d.consultation_fee, d.photo_path, d.specialization_id  FROM doctors d JOIN users u ON d.user_id = u.id LEFT JOIN specializations s ON d.specialization_id = s.id WHERE u.is_active = 1 ORDER BY u.name ASC";
        $result = $connection->query($sql);
        return $result;
    }
?>