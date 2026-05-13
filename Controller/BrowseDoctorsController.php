
<?php
include "../Model/BrowseDoctorsDb.php";

$doctors = [];
$specializations = [];
$error = "";

// run only when form is submitted via POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // example: if you send specialization_id from a form
    $specialization_id = $_POST["specialization_id"] ?? null;

    // get specializations
    $spec_result = getDoctorsBySpecialization($specialization_id);

    if ($spec_result) {
        foreach ($spec_result as $row) {
            $specializations[] = $row;
        }
    }

    // get doctors (optionally filtered by POST data)
    $doc_result = getAllDoctors($specialization_id);

    if ($doc_result) {
        foreach ($doc_result as $row) {
            $doctors[] = $row;
        }
    }
}
?>