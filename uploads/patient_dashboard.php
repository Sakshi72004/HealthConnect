<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'patient') {
    header("Location: login.php");
    exit();
}

$patient_id = $_SESSION['user_id'];

// Get doctors for dropdown
$doctors = $conn->query("SELECT id, name FROM users WHERE role = 'doctor'");

// Get appointments
$appointments = $conn->query("SELECT a.*, u.name AS doctor_name 
    FROM appointments a 
    JOIN users u ON a.doctor_id = u.id 
    WHERE a.patient_id = $patient_id");

// Get reports
$reports = $conn->query("SELECT r.*, u.name AS doctor_name 
    FROM reports r 
    JOIN users u ON r.doctor_id = u.id 
    WHERE r.patient_id = $patient_id");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Patient Dashboard</title>
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
            max-width: 50%;
            height: 90vh;
            padding: 70px;
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
            width: 70%;
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
        <h2>Welcome Patient!</h2>

        <div class="section book-appointment">
            <h3>Book Appointment</h3>
            <form action="handle_appointment.php" method="POST">
                <label for="doctor_id">Select Doctor:</label>
                <select name="doctor_id" id="doctor_id" required>
                    <?php while ($doc = $doctors->fetch_assoc()): ?>
                        <option value="<?= $doc['id'] ?>"><?= $doc['name'] ?></option>
                    <?php endwhile; ?>
                </select><br>
                <label for="date">Date:</label>
                <input type="date" name="date" id="date" required><br>
                <label for="time">Time:</label>
                <input type="time" name="time" id="time" required><br>
                <label for="symptoms">Symptoms:</label><br>
                <textarea name="symptoms" id="symptoms" rows="4" cols="40" placeholder="Describe your symptoms" required></textarea><br>
                <input type="submit" value="Book Appointment">
            </form>
        </div>

        <div class="section">
            <h3>Your Appointments</h3>
            <table>
                <tr>
                    <th>Doctor</th>
                    <th>Date</th>
                    <th>Time</th>
                    <th>Status</th>
                </tr>
                <?php while ($app = $appointments->fetch_assoc()): ?>
                    <tr>
                        <td><?= $app['doctor_name'] ?></td>
                        <td><?= $app['date'] ?></td>
                        <td><?= $app['time'] ?></td>
                        <td><?= ucfirst($app['status']) ?></td>
                    </tr>
                <?php endwhile; ?>
            </table>
        </div>

        <div class="section">
            <h3>Your Reports</h3>
            <table>
                <tr>
                    <th>Doctor</th>
                    <th>File</th>
                    <th>Next Visit</th>
                    <th>Instructions</th>
                </tr>
                <?php while ($rep = $reports->fetch_assoc()): ?>
                    <tr>
                        <td><?= $rep['doctor_name'] ?></td>
                        <td><a href="uploads/<?= $rep['file_path'] ?>" target="_blank">View Report</a></td>
                        <td><?= $rep['next_visit_date'] ?> <?= $rep['next_visit_time'] ?></td>
                        <td><?= nl2br($rep['instructions']) ?></td>
                    </tr>
                <?php endwhile; ?>
            </table>
        </div>
    </div>
</body>
</html>
