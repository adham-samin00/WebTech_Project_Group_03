<?php
include "MyAppointmentsController.php";


function getMyAppointments( $patient_id)
    {
        $database   =new db();
        $connection =$database->connection();
        $sql = "SELECT a.id, a.appointment_date, a.appointment_time, a.reason, a.status, u.name AS doctor_name, s.name AS specialization FROM appointments a JOIN doctors d ON a.doctor_id = d.id JOIN users u ON d.user_id = u.id LEFT JOIN specializations s ON d.specialization_id = s.id WHERE a.patient_id = ? ORDER BY a.appointment_date DESC, a.appointment_time DESC";
        $statement = $connection->prepare($sql);
        $statement->bind_param("i", $patient_id);
        $statement->execute();
        $result = $statement->get_result();
        return $result;
    }

?>