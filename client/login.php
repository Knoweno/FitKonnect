<?php 
session_start();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<?php include '../nav-bar.php' ?>
<?php if(isset($_SESSION['email'])){
    header("Location: selectionActivity.php");
} ?>
    <div class="container" style="padding-top: 100px;;">
  <div class="row">
    <div class="col-md-8 offset-md-2 text-center">
      <p>
        Join us today to connect with like-minded individuals, discover new fitness challenges, and take your athletic performance to new heights. Get ready to elevate your fitness journey with FitKonnect!
      </p>
    </div>
  </div>
</div>
    <div class="container">
        <h1>Sign Up/ Login</h1>
        <?php
        if (isset($_GET['message'])) {
            $message = $_GET['message'];
            if ($message !== "Registration successful") {
                echo '<div id="errorMessage" class="alert alert-danger">' . $message . '</div>';
            } else {
                echo '<div id="successMessage" class="alert alert-success">' . $message . '</div>';
            }
        }
        ?>
        <form method="POST" action="loginn.php">
            <div class="form-group">
                <label for="username">Email or Phone Number:</label>
                <input type="text" class="form-control" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <div class="form-check">
                <input type="checkbox" class="form-check-input" id="remember" name="remember">
                <label class="form-check-label" for="remember">Remember Me</label>
            </div>
            <button type="submit" class="btn btn-primary" name="btnsubmit">Login</button>
        </form>
        <p>Don't have an account yet? <a href="register.php">Click here to register</a>.</p>
    </div>
    <!-- Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.min.js"></script>
</body>
</html>