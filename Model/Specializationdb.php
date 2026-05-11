<?php
    include "db.php";
    function getAllSpecializations()
    {
        $database   = new db();
        $connection = $database->connection();
        $sql    = "SELECT * FROM specializations ORDER BY id ASC";
        $result = $connection->query($sql);
        return $result;
    }
    function createSpecialization($name){
        $database   = new db();
        $connection = $database->connection();
        $sql = "INSERT INTO specializations (name) VALUES ('".$name."')";
        $result = $connection->query($sql);
        return $result;
    }
    function updateSpecialization($id, $name){
        $database   = new db();
        $connection = $database->connection();
        $sql = "UPDATE specializations SET name ='".$name."' WHERE id ='".$id."'";
        $result = $connection->query($sql);
        return $result;
    }
    function specializationHasDoctors($specialization_id)
    {
        $database   = new db();
        $connection = $database->connection();
        $sql = "SELECT id FROM doctors WHERE specialization_id = '".$specialization_id."'";
        $result = $connection->query($sql);
        return $result;
    }
    function deleteSpecialization($id)
    {
        $sql = "DELETE FROM specializations WHERE id = '".$id."'";
        $result = $connection->query($sql);
        return $result;
    }

?>