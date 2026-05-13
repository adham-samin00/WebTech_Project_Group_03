<?php
    include "../Model/AdminDoctorDb.php";
    session_start();

    $error   = "";
    $success = "";
    $action  = $_GET["action"] ?? "list";
    $edit_id = intval($_GET["id"] ?? 0);

    $weekdays = ["Saturday","Sunday","Monday", "Tuesday", "Wednesday", "Thursday", "Friday"];
    if($_SERVER["REQUEST_METHOD"] == "POST")
        {
            $post_action      = $_POST["action"] ?? "";
            $name             = trim($_POST["name"] ?? "");
            $email            = trim($_POST["email"] ?? "");
            $password         = $_POST["password"] ?? "";
            $specialization_id = intval($_POST["specialization_id"] ?? 0);
            $bio              = trim($_POST["bio"] ?? "");
            $consultation_fee = floatval($_POST["consultation_fee"] ?? 0);
            $days_checked     = $_POST["available_days"] ?? [];
            $available_days   = implode(",", $days_checked);
            if (strlen($name) < 3)
                {
                    $error = "Doctor name must be at least 3 characters.";
                }
            elseif (!filter_var($email, FILTER_VALIDATE_EMAIL))
                {
                    $error = "Please enter a valid email address.";
                }
            elseif ($specialization_id <= 0)
                {
                    $error = "Please select a specialization.";
                }
            elseif ($consultation_fee <= 0)
                {
                    $error = "Consultation fee must be greater than 0.";
                }
            elseif (empty($days_checked))
                {
                    $error = "Please select at least one available day.";
                }
            else
                {
                    if($post_action == "create"){
                        $existing = checkEmailExists($email);
                        if(strlen($password) < 6)
                            {
                                $error = "Password must be at least 6 characters.";
                            }
                        if($existing->num_rows > 0)
                            {
                                $error = "This email is already registered.";
                            }
                        else
                            {
                                $photo_path = "";
                                if (!empty($_FILES["photo"]))
                                    {
                                        echo "file found";
                                        $file     = $_FILES["photo"];
                                        $allowed  = ["image/jpeg", "image/png"];
                                        $max_size = 2 * 1024 * 1024;

                                        if (!in_array($file["type"], $allowed))
                                            {
                                                $error = "Photo must be JPEG or PNG.";
                                            }
                                        elseif ($file["size"] > $max_size)
                                            {
                                                $error = "Photo must be under 2MB.";
                                            }
                                        else
                                            {
                                                $ext        = pathinfo($file["name"], PATHINFO_EXTENSION);
                                                $filename   = "doc_" . time() . "_" . uniqid() . "." . $ext;
                                                $upload_dir = "../public/uploads/doctors/";
                                                $photo_path = $upload_dir . $filename;
                                                $result = move_uploaded_file($file["tmp_name"], $photo_path);
                                            }
                                    }
                                    else{
                                        $error = "File Not Found";
                                    }
                                if (empty($error))
                                    {
                                        $password_hash = password_hash($password, PASSWORD_DEFAULT);
                                        $new_user_id   = createDoctorUser($name, $email, $password_hash);
                                        if ($new_user_id)
                                            {
                                                $result = createDoctor($new_user_id, $specialization_id, $bio, $consultation_fee, $photo_path, $available_days);
                                                if ($result)
                                                    {
                                                        Header("Location: ../View/AdminDoctors.php?success=created");
                                                        exit();
                                                    }
                                                else
                                                    {
                                                        $error = "Doctor profile could not be saved.";
                                                    }
                                            }
                                        else
                                            {
                                                $error = "Could not create doctor account.";
                                            }
                                    }
                            }
                    }
                    else if($post_action == "update")
                        {
                            $update_doctor_id = intval($_POST["doctor_id"] ?? 0);
                            $update_user_id   = intval($_POST["user_id"] ?? 0);

                            $currentResult = getDoctorById($update_doctor_id);
                            $currentDoctor = $currentResult->fetch_assoc();
                            $photo_path    = $currentDoctor["photo_path"];
                            if (!empty($_FILES["photo"]["name"]))
                            {
                                $file     = $_FILES["photo"];
                                $allowed  = ["image/jpeg", "image/png"];
                                $max_size = 2 * 1024 * 1024;

                                if (!in_array($file["type"], $allowed))
                                    {
                                        $error = "Photo must be JPEG or PNG.";
                                    }
                                elseif ($file["size"] > $max_size)
                                    {
                                        $error = "Photo must be under 2MB.";
                                    }
                                else
                                    {
                                        $ext        = pathinfo($file["name"], PATHINFO_EXTENSION);
                                        $filename   = "doc_" . time() . "_" . uniqid() . "." . $ext;
                                        $upload_dir = "../public/uploads/doctors/";
                                        $photo_path = $upload_dir . $filename;
                                        move_uploaded_file($file["tmp_name"], $photo_path);
                                    }
                            }
                            
                        }
                    if (empty($error))
                        {
                            updateDoctorUser($update_user_id, $name, $email);
                            $result = updateDoctor($update_doctor_id, $specialization_id, $bio, $consultation_fee, $photo_path, $available_days);

                            if ($result !== false)
                                {
                                    Header("Location: ../View/AdminDoctors.php?success=updated");
                                    exit();
                                }
                            else
                                {
                                    $error = "Could not update doctor profile.";
                                }
                        }
                    
                }
        }

$doctors = getAllDoctorsWithStats();
$specializationsResult = getAllSpecializations();
$specializations       = [];
while ($row = $specializationsResult->fetch_assoc())
    {
        $specializations[] = $row;
    }
$edit_data = null;
if ($action == "edit" && $edit_id)
    {
        $editResult = getDoctorById($edit_id);
        $edit_data  = $editResult->fetch_assoc();
    }
?>