<?php
   include "../Model/db.php";
   session_start();
   $action = $_GET["action"]??"list";
   $post_acion = "";
   $name = "";
   $error = "";
   $datafile = "../JSON/Specialization.json";
   if($_SERVER["REQUEST_METHOD"] == "POST")
    {
        $post_acion = $_POST["action"] ?? "";
        $name = trim($_POST["name"]??"");
        if(empty($name) || strlen($name) < 3){
            $error = "Specialization name must be at least 3 characters.";
        }
        else{
            $formdata = array("Specialization" => name);
            if(file_exist($datafile))
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
                $result = $database->createSpecialization($name);
            }
        }
    }
?>