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
?>