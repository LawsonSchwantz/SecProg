<?php

    session_start();
    require_once(__DIR__ . '/connection.php');
    $report_typelist = array(
        "1" => "Kritik dan Saran",
        "2" => "Pengajuan Keluhan",
        "3" => "Lainnya"
    );
    if($_SERVER['REQUEST_METHOD'] == "POST"){
        if(isset($_POST['send_data'])){
            $report_type = $_POST['report_type'];
            $description = $_POST['description'];

            $description = htmlentities($description);

            $error = false;

            if(!in_array($report_type,array_keys($report_typelist))){
                $_SESSION['error_report'] = "Please enter a valid report type!";
                $error = true;
            }else if(strlen($description) >= 150){
                $_SESSION['error_report'] = "Too Long, description length must be below 150 characters!";
                $error = true;
            }
            if($error){
                header("Location: ../report.php");
                die;
            }

            $user_id = $_SESSION['user_id'];
            $report_type = $report_typelist[$report_type];
            $query = "INSERT INTO report VALUES (NULL, $user_id, '$report_type', '$feedback', NOW());";

            $connection->query($query);

            $_SESSION['report_success'] = "Report has been successfully sent!";

            header("Location: ../report.php");
        }
    }
    
