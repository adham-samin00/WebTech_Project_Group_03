<?php

include "../Model/DoctorProfileDb.php";
session_start();

$isLoggedIn = $_SESSION["loggedIn"] ?? false;

if (!$isLoggedIn || $_SESSION["role"] != "patient")
    {
        Header("Location: Login.php");
        exit();
    }

$doctor_id = intval($_GET["id"] ?? 0);
$date = "";
$time = "";
$reason = "";
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $date = $_POST["date"];
    $time = $_POST["show-time"];
    $reason = $_POST["reason"];
    if(!empty($date) && !empty($time) && !empty($reason)){
        $result = saveAppointment($_SESSION["user_id"],$doctor_id,$date,$time,$reason);
        if($result){
            Header("Location: BookingConfirmation.php?id=".$result);
            exit();
        }
        else{
            Header("Location: BrowserDoctors.php");
            exit();
        }
    }
}
if (!$doctor_id)
    {
        Header("Location: BrowseDoctors.php");
        exit();
    }

$result = getDoctorById( $doctor_id);
$doctor = $result->fetch_assoc();

if (!$doctor)
    {
        Header("Location: BrowseDoctors.php");
        exit();
    }
$available_days = [];
if (!empty($doctor["available_days"]))
    {
        $available_days = explode(",", $doctor["available_days"]);
        $available_days = array_map("trim", $available_days);
    }
$next7days = [];
for ($i = 0; $i < 7; $i++)
    {
        $timestamp = strtotime("+$i days");
        $weekday   = date("l", $timestamp);
        $datestr   = date("Y-m-d", $timestamp);
        $display   = date("D d M", $timestamp);

        if (in_array($weekday, $available_days))
            {
                $next7days[] = [
                    "date"    => $datestr,
                    "display" => $display
                                            ];
            }
    }

?>
