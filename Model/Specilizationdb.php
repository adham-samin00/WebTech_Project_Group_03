<?php
    include "db.php";
    function getAllSpecializations()
    {
        $database   = new db();
        $connection = $database->connection();
        $sql    = "SELECT * FROM specializations ORDER BY name ASC";
        $result = $connection->query($sql);
        return $result;
    }
?>