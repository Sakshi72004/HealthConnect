<!DOCTYPE html>
<html>
<head>
  <title>About Us - HealthConnect</title>
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
      justify-content: center;
      align-items: center;
    }

    .container {
      text-align: center;
      background: rgba(255, 255, 255, 0.9);
      padding: 40px;
      border-radius: 10px;
      box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1);
      max-width: 600px;
      width: 100%;
      position: relative;
    }

    h1 {
      font-size: 2.5rem;
      color: #333;
      margin-bottom: 20px;
    }

    p {
      font-size: 1rem;
      color: #555;
      line-height: 1.6;
    }

    .close-button {
      position: absolute;
      top: 10px;
      right: 10px;
      background-color: #ff4d4d;
      color: white;
      border: none;
      border-radius: 50%;
      width: 30px;
      height: 30px;
      font-size: 18px;
      font-weight: bold;
      text-align: center;
      line-height: 30px;
      cursor: pointer;
      transition: background-color 0.3s ease;
    }

    .close-button:hover {
      background-color: #cc0000;
    }
  </style>
</head>
<body>
  <div class="container">
    <button class="close-button" onclick="window.location.href='index.php'">&times;</button>
    <h1>About Us</h1>
    <p>
      HealthConnect is a comprehensive doctor appointment and health record management system designed to simplify healthcare access. 
      Our platform connects patients with healthcare providers, enabling seamless appointment scheduling and secure health record management.
    </p>
  </div>
</body>
</html>