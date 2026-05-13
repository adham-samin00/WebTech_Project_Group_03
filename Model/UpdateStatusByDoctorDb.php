<?php
include "db.php";

function updateStatusByDoctor($appointment_id, $doctor_id, $status)
    {
        $database =  new db();
        $connection = $database->connection();

        $sql = "UPDATE appointments SET status = ? WHERE id = ? AND doctor_id = ?";
        $statement = $connection->prepare($sql);
        $statement->bind_param("sii", $status, $appointment_id, $doctor_id);
        $statement->execute();
        return $connection->affected_rows;
    }
?>