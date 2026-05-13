<?php
    include "db.php";
    function getDoctorByUserId($user_id)
    {
        $database = new db();
        $connection =  $database->connection();

        $sql = "SELECT d.id, u.name FROM doctors d JOIN users u ON d.user_id = u.id WHERE d.user_id = ?";
        $statement = $connection->prepare($sql);
        $statement->bind_param("i", $user_id);
        $statement->execute();
        $result = $statement->get_result();
        return $result;
    }

    function getTodayAppointments($doctor_id)
    {
        $database = new db();
        $connection =  $database->connection();

        $today = date("Y-m-d");
        $sql   = "SELECT a.id, a.appointment_time, a.reason, a.status, u.name AS patient_name FROM appointments a JOIN users u ON a.patient_id = u.id WHERE a.doctor_id = ? AND a.appointment_date = ? ORDER BY a.appointment_time ASC";
        $statement = $connection->prepare($sql);
        $statement->bind_param("is", $doctor_id, $today);
        $statement->execute();
        $result = $statement->get_result();
        return $result;
    }

    function getWeekAppointments($doctor_id, $week_start, $week_end)
    {
        $database = new db();
        $connection =  $database->connection();

        $sql = "SELECT a.id, a.appointment_date, a.appointment_time, a.status, a.reason, u.name AS patient_name FROM appointments a JOIN users u ON a.patient_id = u.id WHERE a.doctor_id = ? AND a.appointment_date BETWEEN ? AND ? AND a.status != 'Cancelled' ORDER BY a.appointment_date ASC, a.appointment_time ASC";
        $statement = $connection->prepare($sql);
        $statement->bind_param("iss", $doctor_id, $week_start, $week_end);
        $statement->execute();
        $result = $statement->get_result();
        return $result;
    }
?>