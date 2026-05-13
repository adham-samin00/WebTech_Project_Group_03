<?php
include "../Model/RegistrationDb.php";
session_start();

$name        = "";
$email       = "";
$dob         = "";
$blood_group = "";
$phone       = "";
$error       = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name        = trim($_POST["name"] ?? "");
    $email       = trim($_POST["email"] ?? "");
    $password    = $_POST["password"] ?? "";
    $dob         = $_POST["dob"] ?? "";
    $blood_group = $_POST["blood_group"] ?? "";
    $phone       = trim($_POST["phone"] ?? "");

    if (empty($name) || strlen($name) < 3) {
        $error = "Name must be at least 3 characters";
    } 
    else if (empty($email) || ! preg_match("/^[a-zA-Z0-9._]+@[a-zA-Z0-9.]+\.[a-zA-Z]{2,}$/", $email)) {
        $error = "Please enter a valid emaail";
    } 
    else if (strlen($password) < 6) {
        $error = "Password must be at least 6 characters";
    } 
    else if (empty($dob)) {
        $error = "Date of Birth is required";
    } 
    else if (empty($blood_group)) {
        $error = "Blood group is required";
    } 
    else if (! preg_match("/^01[0-9]{9}$/", $phone)) {
        $error = "Phone number must be 11 digits and start with 01";
    } 
    else {
        $existing = checkEmailExists($email);

        if ($existing->num_rows > 0) {
            $error = "This email is already registered. Please login";
        } 
        else {
            $password_hash = password_hash($password, PASSWORD_DEFAULT);

            $result = registerPatient($name, $email, $password_hash, $dob, $blood_group, $phone);

            if($result)
                {
                    $json_file = "../JSON/Registration.json"; 

                    $new_entry = [
                        "name" => $name,
                        "email" => $email,
                        "dob" => $dob,
                        "blood-group" => $blood_group,
                        "phone" => $phone,
                        "role" => "patient",
                    ];

                    if(file_exists($json_file))
                        {
                            $file_content = file_get_contents($json_file);
                            $existing_data = json_decode($file_content, true);
                        }
                        else{
                            $existing_data = array();
                        }

                        if(!is_array($existing_data))
                            {
                                $existing_data = array();
                            }
                        
                        $existing_data[] = $new_entry;
                        $json_data = json_encode($existing_data, JSON_PRETTY_PRINT);

                    file_put_contents($json_file, $json_data);
        

                    Header("Location: Login.php?registered=1");
                    exit();
                }
            else{
                $error = "Registration failed. Please try again";
            }

        }
    }

}
?>
