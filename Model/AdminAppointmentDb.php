<?php
include "db.php";

function getAllAppointments($doctor_filter, $date_filter, $status_filter)
    {
        $database = new db();
        $connection=$database->connection();

        $sql    = "SELECT a.id, a.appointment_date, a.appointment_time, a.reason, a.status,p.name AS patient_name, doc.name AS doctor_name, s.name AS specialization FROM appointments a JOIN users p ON a.patient_id = p.id JOIN doctors d ON a.doctor_id = d.id JOIN users doc ON d.user_id = doc.id LEFT JOIN specializations s ON d.specialization_id = s.id WHERE 1=1";
        $params = [];
        $types  = "";

        if (!empty($doctor_filter))
            {
                $sql     .= " AND a.doctor_id = ?";
                $params[] = intval($doctor_filter);
                $types   .= "i";
            }

        if (!empty($date_filter))
            {
                $sql     .= " AND a.appointment_date = ?";
                $params[] = $date_filter;
                $types   .= "s";
            }

        if (!empty($status_filter))
            {
                $sql     .= " AND a.status = ?";
                $params[] = $status_filter;
                $types   .= "s";
            }

        $sql .= " ORDER BY a.appointment_date DESC, a.appointment_time DESC";

        $statement = $connection->prepare($sql);

        if (!empty($params))
            {
                $statement->bind_param($types, ...$params);
            }

        $statement->execute();
        $result = $statement->get_result();
        return $result;
    }

    function getAllDoctors()
    {
         $database = new db();
        $connection=$database->connection();
        $sql    = "SELECT d.id, u.name FROM doctors d JOIN users u ON d.user_id = u.id ORDER BY u.name ASC";
        $result = $connection->query($sql);
        return $result;
    }
?>