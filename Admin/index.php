<!DOCTYPE html>
<html>
<head>
  <title>Admin Dashboard</title>
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <style>
    /* Global Styles */
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
      display: flex;
      min-height: 100vh;
      flex-direction: column;
    }

    .container {
      max-width: 1200px;
      margin: 0 auto;
      padding: 20px;
      flex: 1;
    }

    /* Header Styles */
    .header {
      background-color: yellow;
      color: black;
      padding: 20px;
    }

    .header h1 {
      margin: 0;
    }

    /* Sidebar Styles */
    .sidebar {
      background-color: yellow;
      color: black;
      float: left;
      width: 20%;
      padding: 20px;
    }

    .sidebar ul {
      list-style-type: none;
      padding: 0;
      margin: 0;
    }

    .sidebar li {
      margin-bottom: 10px;
    }

    .sidebar a {
      text-decoration: none;
      color: black;
      font-weight: bold;
    }

    /* Content Styles */
    .content {
      float: right;
      width: 80%;
      padding: 20px;
      background-color: #fff;
    }

    /* Footer Styles */
    .footer {
      background-color: yellow;
      color: black;
      text-align: center;
      padding: 20px;
    }
  </style>
</head>
<body>
  <div class="container">
    <div class="header">
      <h1>Admin Dashboard</h1>
    </div>
    <div class="sidebar">
      <ul>
        <li><a href="trainers.php">Trainers</a></li>
        <li><a href="clients.php">Clients</a></li>
        <li><a href="locations.php">Locations</a></li>
        <li><a href="sports.php">Sports</a></li>
      </ul>
    </div>
    <div class="content">
      <h2>Welcome to the Admin Dashboard</h2>
      <p>This is the main content area where you can display various information and manage your application.</p>
    </div>
  </div>
  <footer class="footer">
    &copy; <?php echo date("Y"); ?> Admin Dashboard. All rights reserved.
  </footer>

  <!-- Bootstrap JS -->
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>
