<?php
session_start();
require_once(__DIR__ . '/connection.php');

if ($_SESSION['is_login'] !== true) {
    header("Location: login.php"); // Redirect non-admin users
}

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (isset($_POST['edit_report'])) {
        // Handle edit report action
        $report_id = $_POST['report_id'];
        // Perform the necessary update actions here
    } elseif (isset($_POST['delete_report'])) {
        // Handle delete report action
        $report_id = $_POST['report_id'];
        // Perform the necessary delete actions here
    }
}

// Redirect back to the admin page after performing the actions
header("Location: ../admin.php");
