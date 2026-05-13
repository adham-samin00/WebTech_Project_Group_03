<?php
include "db.php"

function getAllSpecializations($connection)
    {
        $sql    = "SELECT * FROM specializations ORDER BY name ASC";
        $result = $connection->query($sql);
        return $result;
    }


?>