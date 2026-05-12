<?php
    include "../Model/AdminDoctorDb.php";
    session_start();

    $error   = "";
    $success = "";
    $action  = $_GET["action"] ?? "list";
    $edit_id = intval($_GET["id"] ?? 0);

    $weekdays = ["Saturday","Sunday","Monday", "Tuesday", "Wednesday", "Thursday", "Friday"];
    
    
?>