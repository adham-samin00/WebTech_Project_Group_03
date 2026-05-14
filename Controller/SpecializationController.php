<?php
   include "../Model/Specializationdb.php";
   session_start();

   $isLoggedIn = $_SESSION["loggedIn"] ?? false;
    if (!$isLoggedIn || $_SESSION["role"] != "admin")
        {
            Header("Location: ../View/Login.php");
            exit();
        }

   $action = $_GET["action"]??"list";
   $post_action = "";
   $name = "";
   $error = "";
   $datafile = "../JSON/Specialization.json";
   $id = "";
   $edit_id = $_GET["id"]??"";
   $edit_data = $_GET["data"]??"";
   if($_SERVER["REQUEST_METHOD"] == "POST")
    {
        $post_action = $_POST["action"] ?? "";
        $name = trim($_POST["name"]??"");
        if(empty($name) || strlen($name) < 3){
            $error = "Specialization name must be at least 3 characters.";
        }
        else{
                
            if($post_action == "create"){
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
                $formdata = array("Specialization" => $name);

                if(file_exists($datafile))
                    {
                        $existdata = file_get_contents($datafile);
                        $tempdata = json_decode($existdata, true);
                    }
                    else{
                        $tempdata = array();
                    }
                if(!is_array($tempdata))
                    {
                        $tempdata = array();
                    }
                    foreach($tempdata as $index => $record)
                    {
                        if($record["Specialization"] === $edit_data)
                            {
                                $tempdata[$index] = $formdata;
                                break;
                            }
                    }
                    $jsondata = json_encode($tempdata,JSON_PRETTY_PRINT);
                    file_put_contents($datafile,$jsondata);
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
            if(file_exists($datafile))
                {
                    $existdata = file_get_contents($datafile);
                    $tempdata = json_decode($existdata, true);
                }
                else{
                    $tempdata = array();
                }
            if(!is_array($tempdata))
                {
                    $tempdata = array();
                }
                foreach($tempdata as $index => $record)
                {
                    if($record["Specialization"] === $edit_data)
                        {
                            unset($tempdata[$index]);
                            $tempdata = array_values($tempdata);
                            break;
                        }
                }
                $jsondata = json_encode($tempdata,JSON_PRETTY_PRINT);
                file_put_contents($datafile,$jsondata);
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