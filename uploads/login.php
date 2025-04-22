<!DOCTYPE html>
<html>
<head>
  <title>Login</title>
  <link rel="stylesheet" href="../css/style.css"> 
  <style>
    body {
      font-family: Arial, sans-serif;
      background-image: url('../uploads/image.jpg'); 
      background-size: cover;
      background-position: center;
      background-repeat: no-repeat;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      margin: 0;
    }

    .login-container {
      background: rgba(255, 255, 255, 0.9);
      padding: 30px;
      border-radius: 8px;
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
      max-width: 400px;
      width: 100%;
      text-align: center;
    }

    .login-container h2 {
      margin-bottom: 20px;
      color: #333;
    }

    .login-container input[type="email"],
    .login-container input[type="password"] {
      width: 100%;
      padding: 10px;
      margin: 10px 0;
      border: 1px solid #ccc;
      border-radius: 4px;
    }

    .login-container input[type="submit"] {
      width: 100%;
      padding: 10px;
      background-color: #007BFF;
      border: none;
      color: white;
      font-weight: bold;
      border-radius: 4px;
      cursor: pointer;
    }

    .login-container input[type="submit"]:hover {
      background-color: #0056b3;
    }

    .register-link {
      margin-top: 15px;
      display: block;
      color: #007BFF;
      text-decoration: none;
      font-size: 14px;
    }

    .register-link:hover {
      color: #0056b3;
    }

    .home-button {
      margin-top: 15px;
      padding: 10px 20px;
      background-color: #28a745;
      color: white;
      text-decoration: none;
      font-size: 14px;
      font-weight: bold;
      border-radius: 4px;
      display: inline-block;
      transition: background-color 0.3s ease;
    }

    .home-button:hover {
      background-color: #218838;
    }
  </style>
</head>
<body>
  <div class="login-container">
    <h2>Login</h2>
    <form action="handle_login.php" method="POST">
      <input type="email" name="email" placeholder="Enter your email" value="" required><br>
      <input type="password" name="password" placeholder="Enter your password" value="" required><br>
      <input type="submit" value="Login">
    </form>
    <a href="register.php" class="register-link">Don't have an account? Register here</a>
    <a href="index.php" class="home-button">Go to Home</a>
  </div>
</body>
</html>
