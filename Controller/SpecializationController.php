<?php
   include "../Model/Specializationdb.php";
   session_start();
   $action = $_GET["action"]??"list";
   $post_action = "";
   $name = "";
   $error = "";
   $datafile = "../JSON/Specialization.json";
   $id = "";
   $edit_id = $_GET["id"]??"";
   if($_SERVER["REQUEST_METHOD"] == "POST")
    {
        $post_action = $_POST["action"] ?? "";
        $name = trim($_POST["name"]??"");
        if(empty($name) || strlen($name) < 3){
            $error = "Specialization name must be at least 3 characters.";
        }
        else{
            $formdata = array("Specialization" => $name);
            if(file_exists($datafile))
                {
                    $existdata = file_get_contents($datafile);
                    $tempdata = json_encode($existdata,true);
                }
                else{
                    $tempdata = array();
                }
            if(!is_array($tempdata))
                {
                    $tempdata = array();
                }
                $tempdata[] = $formdata;
                $jsondata = json_encode($tempdata,JSON_PRETTY_PRINT);
                file_put_contents($datafile,$jsondata);
                
            if($post_action == "create"){
                $result = createSpecialization($name);
                if ($result)
                    {
                        Header("Location: ../View/Specializations.php?success=created");
                        exit();
                    }
                    else
                    {
                        $error = "Could not create specialization. Name may already exist.";
                    }
            }
            if($post_action == "update"){
                $update_id = $_POST["id"];
                echo $update_id;
                $result = updateSpecialization($update_id,$name);
                if($result)
                    {
                        Header("Location: ../View/Specializations.php?success=updated");
                        exit();
                    }
                    else
                    {
                        $error = "Could not create updated. Name may already exist.";
                    }
            }
        }
    }
    if($action == "delete" && $edit_id)
        {
            $hasDoctor = specializationHasDoctors($edit_id);
            if($hasDoctor->num_rows > 0){
                $error = "Cannot Delete: doctors are assigned to this specialization.";
            }
            else{
                $result = deleteSpecialization($edit_id);
                if ($result)
                    {
                        Header("Location: ../View/Specializations.php?success=deleted");
                        exit();
                    }
                else
                    {
                        $error = "Could not delete specialization.";
                    }
            }
        }
?>