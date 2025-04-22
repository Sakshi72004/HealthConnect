<!DOCTYPE html>
<html>
<head>
  <title>Doctor Appointment System</title>
  <link rel="stylesheet" href="css/style.css"> 
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
      flex-direction: column;
      justify-content: center;
      align-items: center;
    }

    .header {
      position: absolute;
      top: 20px;
      right: 20px;
    }

    .header a {
      text-decoration: none;
      color: #fff;
      background-color:rgb(9, 100, 255);
      padding: 10px 20px;
      border-radius: 5px;
      font-weight: bold;
      margin: 5px;
      display: inline-block;
      transition: background-color 0.3s ease;
    }

    .header a:hover {
      background-color: #0056b3;
    }

    h2 {
      font-size: 5rem;
      font-weight: bold;
      text-align: center;
      color: #fff;
      background: linear-gradient(90deg,rgb(9, 40, 238),rgb(255,0,0)); 
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      text-shadow: 0 4px 6px rgba(0, 0, 0, 0.3); 
      margin-bottom: 20px;
    }
  </style>
</head>
<body>
  <div class="header">
    <a href="login.php">Login</a>
    <a href="register.php">Register</a>
    <a href="about.php">About us</a>
    <a href="contact.php">Contact</a>
  </div>
  <div>
    <h2>Welcome to HealthConnect!</h2>
  </div>
</body>
</html>
