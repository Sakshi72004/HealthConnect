<?php
include 'db.php';

$name = $_POST['name'];
$email = $_POST['email'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);
$role = $_POST['role'];

$sql = "INSERT INTO users (name, email, password, role) VALUES ('$name', '$email', '$password', '$role')";
?>

<!DOCTYPE html>
<html>
<head>
  <title>Registration Status</title>
  <link rel="stylesheet" href="../css/style.css">
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
    <?php if ($conn->query($sql) === TRUE): ?>
      <h2 class="success">Registration Successful!</h2>
      <p>You can now log in to your account.</p>
      <a href="login.php">Go to Login</a>
    <?php else: ?>
      <h2 class="error">Registration Failed</h2>
      <p>Error: <?= $conn->error ?></p>
      <a href="register.php">Go Back to Register</a>
    <?php endif; ?>
  </div>
</body>
</html>
