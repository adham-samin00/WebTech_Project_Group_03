<?php
include "db.php"

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



?>