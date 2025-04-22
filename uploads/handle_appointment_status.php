<?php
session_start();
include 'db.php';

if ($_SESSION['role'] != 'doctor') {
    die("Unauthorized");
}

$appointment_id = $_POST['appointment_id'];
$status = $_POST['status'];

$conn->query("UPDATE appointments SET status = '$status' WHERE id = $appointment_id");
header("Location: doctor_dashboard.php");
