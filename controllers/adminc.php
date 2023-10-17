<?php
session_start();
require_once(__DIR__ . '/connection.php');

if ($_SESSION['is_login'] !== true) {
    header("Location: login.php"); 
}

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (isset($_POST['edit_report'])) {

        $report_id = $_POST['report_id'];
      
    } elseif (isset($_POST['delete_report'])) {
        
        $report_id = $_POST['report_id'];
      
    }
}

// Redirect back to the admin page after performing the actions
header("Location: ../admin.php");
