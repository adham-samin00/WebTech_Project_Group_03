<?php
include "db.php";

function getDoctorById( $doctor_id)
    {
        $database   =new db();
        $connection =$database->connection();
        $sql = "SELECT d.id, d.bio, d.consultation_fee, d.photo_path, d.available_days, u.name, s.name AS specialization FROM doctors d JOIN users u ON d.user_id = u.id LEFT JOIN specializations s ON d.specialization_id = s.id WHERE d.id = ? AND u.is_active = 1";
        $statement = $connection->prepare($sql);
        $statement->bind_param("i", $doctor_id);
        $statement->execute();
        $result = $statement->get_result();
        return $result;
    }
    function getBookedTimes($doctor_id, $date)
    {
        $database   =new db();
        $connection =$database->connection();
        $sql = "SELECT appointment_time FROM appointments WHERE doctor_id = ? AND appointment_date = ? AND status != 'Cancelled'";
        $statement = $connection->prepare($sql);
        $statement->bind_param("is", $doctor_id, $date);
        $statement->execute();
        $result = $statement->get_result();
        return $result;
    }
    ?>