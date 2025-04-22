<?php
session_start();
include 'db.php';

if ($_SESSION['role'] != 'patient') {
    die("Unauthorized");
}

$patient_id = $_SESSION['user_id'];
$doctor_id = $_POST['doctor_id'];
$date = $_POST['date'];
$time = $_POST['time'];
$symptoms = $conn->real_escape_string($_POST['symptoms']);

$sql = "INSERT INTO appointments (patient_id, doctor_id, date, time, symptoms)
        VALUES ('$patient_id', '$doctor_id', '$date', '$time', '$symptoms')";

if ($conn->query($sql)) {
    header("Location: patient_dashboard.php");
} else {
    echo "Error booking appointment: " . $conn->error;
}
?>
