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

   