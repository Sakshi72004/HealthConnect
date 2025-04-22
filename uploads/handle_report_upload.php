<?php
session_start();
include 'db.php';

if ($_SESSION['role'] != 'doctor') {
    die("Unauthorized");
}

$doctor_id = $_SESSION['user_id'];
$patient_id = $_POST['patient_id'];
$next_date = $_POST['next_visit_date'];
$next_time = $_POST['next_visit_time'];
$instructions = $conn->real_escape_string($_POST['instructions']); // Escape special characters for security

if (isset($_FILES['report_file'])) {
    $filename = $_FILES['report_file']['name'];
    $tmp_name = $_FILES['report_file']['tmp_name'];

    // Ensure the uploads directory exists
    $upload_dir = "uploads/";
    if (!is_dir($upload_dir)) {
        mkdir($upload_dir, 0777, true); // Create the directory with write permissions
    }

    $filepath = $upload_dir . time() . "_" . basename($filename);

    if (move_uploaded_file($tmp_name, $filepath)) {
        $sql = "INSERT INTO reports (doctor_id, patient_id, file_path, next_visit_date, next_visit_time, instructions)
                VALUES ('$doctor_id', '$patient_id', '" . basename($filepath) . "', '$next_date', '$next_time', '$instructions')";

        if ($conn->query($sql)) {
            $message = "Report uploaded successfully!";
            $message_type = "success";
        } else {
            $message = "Failed to save report details in the database.";
            $message_type = "error";
        }
    } else {
        $message = "Failed to upload file.";
        $message_type = "error";
    }
} else {
    $message = "No file selected.";
    $message_type = "error";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Report Upload Status</title>
    <link rel="stylesheet" href="../css/style.css"> <!-- Link to the existing CSS file -->
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f4f8;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .status-container {
            background: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            width: 100%;
            text-align: center;
        }

        .status-container h2 {
            margin-bottom: 20px;
            color: #333;
        }

        .status-container p {
            margin-bottom: 20px;
            font-size: 16px;
        }

        .status-container a {
            display: inline-block;
            margin-top: 15px;
            padding: 10px 20px;
            background-color: #007BFF;
            color: white;
            text-decoration: none;
            border-radius: 4px;
            font-weight: bold;
        }

        .status-container a:hover {
            background-color: #0056b3;
        }

        .success {
            color: #28a745;
        }

        .error {
            color: #dc3545;
        }
    </style>
</head>
<body>
    <div class="status-container">
        <h2 class="<?= $message_type ?>"><?= $message ?></h2>
        <p>
            <?php if ($message_type == "success"): ?>
                You can now return to the dashboard.
            <?php else: ?>
                Please try again or contact support.
            <?php endif; ?>
        </p>
        <a href="doctor_dashboard.php">Back to Dashboard</a>
    </div>
</body>
</html>
