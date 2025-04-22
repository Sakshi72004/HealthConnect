<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'doctor') {
    header("Location: login.php");
    exit();
}

$doctor_id = $_SESSION['user_id'];

$appointments = $conn->query("SELECT a.*, u.name AS patient_name 
    FROM appointments a 
    JOIN users u ON a.patient_id = u.id 
    WHERE a.doctor_id = $doctor_id");

$patients = $conn->query("SELECT DISTINCT u.id, u.name 
    FROM appointments a 
    JOIN users u ON a.patient_id = u.id 
    WHERE a.doctor_id = $doctor_id AND a.status = 'accepted'");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Doctor Dashboard</title>
    <link rel="stylesheet" href="../css/style.css">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-image: url('../uploads/image.jpg');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            margin: 0;
            padding: 0;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .container {
            max-width: 900px;
            height: 90vh;
            padding: 20px;
            border-radius: 10px;
            background: rgba(255, 255, 255, 0.8);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
            overflow-y: auto;
        }

        h2 {
            color: #007BFF;
            margin-bottom: 20px;
            text-align: center;
            font-size: 2.5rem;
            text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.2);
        }

        h3 {
            color: #333;
            margin-bottom: 15px;
            font-size: 1.8rem;
            border-bottom: 2px solid #007BFF;
            display: inline-block;
            padding-bottom: 5px;
        }

        a {
            text-decoration: none;
            color: #007BFF;
            font-weight: bold;
            float: right;
            transition: color 0.3s ease;
        }

        a:hover {
            color: #0056b3;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
            border-radius: 5px;
            overflow: hidden;
            background: rgba(255, 255, 255, 0.9);
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th, td {
            padding: 12px;
            text-align: left;
        }

        th {
            background-color: #007BFF;
            color: white;
            font-weight: bold;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        tr:hover {
            background-color: #f1f1f1;
        }

        form {
            width: 50%;
            margin: 0 auto;
            padding: 20px;
            background: rgba(255, 255, 255, 0.9);
            border-radius: 10px;
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.2);
        }

        textarea, input[type="date"], input[type="time"], select, input[type="file"] {
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
            width: 100%;
            resize: vertical;
            font-size: 1rem;
        }

        input[type="submit"] {
            padding: 10px 20px;
            background-color: #007BFF;
            border: none;
            color: white;
            font-weight: bold;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }

        .action-buttons {
            display: flex;
            gap: 10px;
        }

        .action-buttons input[type="submit"] {
            padding: 5px 10px;
            font-size: 0.9rem;
        }

        .logout {
            margin-bottom: 20px;
            text-align: right;
        }

        .logout a {
            color: #dc3545;
            font-weight: bold;
            transition: color 0.3s ease;
        }

        .logout a:hover {
            color: #a71d2a;
        }

        label {
            font-weight: bold;
            color: #333;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="logout">
            <a href="logout.php">Logout</a>
        </div>
        <h2>Welcome Doctor!</h2>

        <h3>Appointment Requests</h3>
        <table>
            <tr>
                <th>Patient</th>
                <th>Symptoms</th>
                <th>Date</th>
                <th>Time</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
            <?php while ($app = $appointments->fetch_assoc()): ?>
                <tr>
                    <td><?= $app['patient_name'] ?></td>
                    <td><?= $app['symptoms'] ?></td>
                    <td><?= $app['date'] ?></td>
                    <td><?= $app['time'] ?></td>
                    <td><?= ucfirst($app['status']) ?></td>
                    <td>
                        <?php if ($app['status'] == 'pending'): ?>
                            <div class="action-buttons">
                                <form action="handle_appointment_status.php" method="POST" style="display:inline;">
                                    <input type="hidden" name="appointment_id" value="<?= $app['id'] ?>">
                                    <input type="hidden" name="status" value="accepted">
                                    <input type="submit" value="Accept">
                                </form>
                                <form action="handle_appointment_status.php" method="POST" style="display:inline;">
                                    <input type="hidden" name="appointment_id" value="<?= $app['id'] ?>">
                                    <input type="hidden" name="status" value="rejected">
                                    <input type="submit" value="Reject">
                                </form>
                            </div>
                        <?php else: ?>
                            -
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endwhile; ?>
        </table>

        <h3>Upload Report</h3>
        <form action="handle_report_upload.php" method="POST" enctype="multipart/form-data">
            <label for="patient_id">Upload Report of Patient:</label>
            <select name="patient_id" id="patient_id" required>
                <?php while ($pat = $patients->fetch_assoc()): ?>
                    <option value="<?= $pat['id'] ?>"><?= $pat['name'] ?></option>
                <?php endwhile; ?>
            </select><br>

            <label for="report_file" >Upload File:</label>
            <input type="file" name="report_file" id="report_file" required><br>

            <label for="next_visit_date">Next Visit Date:</label>
            <input type="date" name="next_visit_date" id="next_visit_date"><br>

            <label for="next_visit_time">Next Visit Time:</label>
            <input type="time" name="next_visit_time" id="next_visit_time"><br>

            <label for="instructions">Instructions:</label><br>
            <textarea name="instructions" id="instructions" rows="4" cols="40" placeholder="Any advice or steps?"></textarea><br>

            <input type="submit" value="Upload Report">
        </form>
    </div>
</body>
</html>
