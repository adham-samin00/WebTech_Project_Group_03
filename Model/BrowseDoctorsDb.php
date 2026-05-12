 <?php
 include "db.php";
 
 function getAllDoctors() {
        $database = new db();
        $connection = $database->connection();
        $sql        = "SELECT d.id, u.name, u.email, s.name AS specialization,
                              d.bio, d.consultation_fee, d.photo_path, d.available_days
                       FROM doctors d
                       INNER JOIN users u ON d.user_id = u.id
                       INNER JOIN specializations s ON d.specialization_id = s.id
                       WHERE u.is_active = 1";
        $result     = $connection->query($sql);
        return $result;
    }

    function getDoctorsBySpecialization($specialization_id) {
        $database = new db();
        $connection = $database->connection();
        $sql        = "SELECT d.id, u.name, u.email, s.name AS specialization,
                              d.bio, d.consultation_fee, d.photo_path, d.available_days
                       FROM doctors d
                       INNER JOIN users u ON d.user_id = u.id
                       INNER JOIN specializations s ON d.specialization_id = s.id
                       WHERE u.is_active = 1 AND d.specialization_id = '" . $specialization_id . "'";
        $result     = $connection->query($sql);
        return $result;
    }
    ?>