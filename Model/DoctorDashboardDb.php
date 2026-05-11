<?php
    include "db.php";
    function getTodayAppointments($tablename, $doctor_id, $today) {
        $database = new db();
        $connection = $database->connection();
        $sql = "SELECT a.id, a.appointment_date, a.appointment_time, a.reason, a.status,
                       u.name AS patient_name
                FROM " . $tablename . " a
                JOIN users u ON a.patient_id = u.id
                WHERE a.doctor_id = '" . $doctor_id . "'
                AND a.appointment_date = '" . $today . "'
                ORDER BY a.appointment_time ASC";
        $result = $connection->query($sql);
        return $result;
    }

    function getDoctorIdByUserId($connection,$user_id) {
        
        $sql = "SELECT id FROM doctors WHERE user_id = '" . $user_id . "'";
        $result = $connection->query($sql);
        return $result;
    }
?>