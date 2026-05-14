<?php
    include "../../Model/AdminDoctorDb.php";

    $docid = $_GET['id'] ?? "";

    if (!$docid) {
        echo "doctor Id Required";
        exit();
    }
    $result = getDoctorCount($docid);
    $row = $result->fetch_assoc();
    $count = $row['TOTAL'];
    echo $count;
?>