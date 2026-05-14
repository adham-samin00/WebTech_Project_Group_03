<?php
include "db.php";

function checkSlotTaken( $doctor_id, $date, $time)
    {   
        $database   = new db();
         $connection = $database->connection();
        $sql = "SELECT id FROM appointments WHERE doctor_id = ? AND appointment_date = ? AND appointment_time = ? AND status != 'Cancelled'";
        $statement = $connection->prepare($sql);
        $statement->bind_param("iss", $doctor_id, $date, $time);
        $statement->execute();
        $result = $statement->get_result();
        return $result;
    }
function saveAppointment( $patient_id, $doctor_id, $date, $time, $reason)
    {   $database   = new db();
         $connection = $database->connection();
        $sql = "INSERT INTO appointments (patient_id, doctor_id, appointment_date, appointment_time, reason, status, created_at) VALUES (?, ?, ?, ?, ?, 'Pending', NOW())";
        $statement = $connection->prepare($sql);
        $statement->bind_param("iisss", $patient_id, $doctor_id, $date, $time, $reason);
        $result = $statement->execute();
        if ($result)
            {
                return $connection->insert_id;
            }
        return false;
    }
function getDoctorById($connection, $doctor_id)
    {      
        $database   = new db();
         $connection = $database->connection();
        $sql = "SELECT d.id, d.bio, d.consultation_fee, d.photo_path, d.available_days, u.name, s.name AS specialization FROM doctors d JOIN users u ON d.user_id = u.id LEFT JOIN specializations s ON d.specialization_id = s.id  WHERE d.id = ? AND u.is_active = 1";
        $statement = $connection->prepare($sql);
        $statement->bind_param("i", $doctor_id);
        $statement->execute();
        $result = $statement->get_result();
        return $result;
    }

?>