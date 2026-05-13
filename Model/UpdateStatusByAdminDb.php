<?php
include "db.php";

function updateStatusByAdmin($appointment_id, $status)
    {
        $database = new db();
        $connection = $database->connection();

        $sql = "UPDATE appointments SET status = ? WHERE id = ?";
        $statement = $connection->prepare($sql);
        $statement->bind_param("si", $status, $appointment_id);
        $statement->execute();
        return $connection->affected_rows;
    }

?>