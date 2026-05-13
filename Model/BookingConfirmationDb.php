<?php
include "db.php";
function getAppointmentDetails( $appointment_id)
    {   
         $database   = new db();
         $connection = $database->connection();
        $sql = "SELECT a.*, u.name AS doctor_name, s.name AS specialization FROM appointments a  JOIN doctors d ON a.doctor_id = d.id  JOIN users u ON d.user_id = u.id  LEFT JOIN specializations s ON d.specialization_id = s.id  WHERE a.id = ?";
        $statement = $connection->prepare($sql);
        $statement->bind_param("i", $appointment_id);
        $statement->execute();
        $result = $statement->get_result();
        return $result;
    }
?>