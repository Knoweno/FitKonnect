<?php 
//include 'trainer_loginProcess.php' 
session_start();
require_once '../links.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .hide-alert {
            display: none;
        }
        </style>
</head>
<body>
<?php include '../nav-bar.php' ?>
<?php if(isset($_SESSION['trainer_email'])){
    header("Location: $locallinks/trainer/trainer_registration.php");
} ?>
    <div class="container" style="padding-top: 100px;;">
  <div class="row">
    <div class="col-md-8 offset-md-2 text-center">
      <p>
Register, Train, EARN
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
        <form method="POST" action="trainer_loginController.php">
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
                <a href="passreset.php"><p style="text-decoration: none;">Forgot Pasword? </p></a>
            </div>
            <div><button type="submit" class="btn btn-primary" name="btnsubmit">Login</button> <!-- Or <button type="submit" class="btn btn-primary" name="btnsubmit"><a href="passreset.php" style="color:aliceblue;text-decoration: none;"> Reset my Password</a>.</button> --></div>
        </form>
        <p>Don't have a TRAINER account yet? <a href="trainer.php">Click here to register</a>.</p>

    </div>
    <?php include '../footer.php'; ?>
    <!-- Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function() {
    

            // Hide the message modal after 5 seconds
            setTimeout(function() {
                $('#errorMessage, #successMessage').fadeOut('slow');
            }, 5000);
        });
    </script>
</body>
</html>
