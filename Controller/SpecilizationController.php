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
                
            if($post_action == "create"){
                //$result = 
            }
        }
    }
?>