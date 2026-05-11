<?php
include "../Model/db.php";

function getAllDoctors($connection) {

        
        $sql = "SELECT d.id, u.name
                FROM doctors d
                JOIN users u ON d.user_id = u.id
                WHERE u.is_active = 1
                ORDER BY u.name ASC";
        $result = $connection->query($sql);
        return $result;
    }

    function getAllAppointments($connection,$tablename, $filter_doctor_id, $filter_date, $filter_status) {
        
        $sql = "SELECT a.id, a.appointment_date, a.appointment_time, a.reason, a.status,
                       pu.name AS patient_name,
                       du.name AS doctor_name
                FROM " . $tablename . " a
                JOIN users pu ON a.patient_id = pu.id
                JOIN doctors d ON a.doctor_id = d.id
                JOIN users du ON d.user_id = du.id
                WHERE 1=1";
        if ($filter_doctor_id != "") {
            $sql .= " AND a.doctor_id = '" . $filter_doctor_id . "'";
        }
        if ($filter_date != "") {
            $sql .= " AND a.appointment_date = '" . $filter_date . "'";
        }
        if ($filter_status != "") {
            $sql .= " AND a.status = '" . $filter_status . "'";
        }
        $sql .= " ORDER BY a.appointment_date DESC, a.appointment_time ASC";
        $result = $connection->query($sql);
        return $result;
    }
?>