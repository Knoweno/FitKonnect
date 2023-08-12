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
    <!-- Bootstrap CSS from CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- SweetAlert CSS and JS from CDN -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.all.min.js"></script>
    <style>
        .center-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 90vh;
        }
        .login-form {
            max-width: 400px;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .login-title {
            text-align: center;
            margin-bottom: 20px;
        }
        .hide-alert {
            display: none;
        }
        </style>
</head>
<body>
<?php include '../nav-bar.php' ?>
<?php
    if (isset($_SESSION['error_message'])) {
        echo "<script>
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: '{$_SESSION['error_message']}',
                showConfirmButton: true,
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'OK',
                timer: 5000
            });
        </script>";
        unset($_SESSION['error_message']); // Clear the error message
    }
    ?>
<?php if(isset($_SESSION['trainer_email'])){
    // header("Location: $locallinks/trainer/trainer_registration.php");
    header("Location:trainer_registration.php");
} ?>



    <div class="center-container">
        <div class="login-form">
        <h2 class="login-title">Register. Train. EARN</h2>
            <h3 class="login-title">Sign Up / Login</h3>
            
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
            
            <form id="registrationForm" method="POST" action="trainer_loginController.php">
            <div class="form-group">
                <label for="username"> Email or Phone Number:</label>
                <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-user"></i></span>
                </div>
                <input type="text" class="form-control" id="username" name="username" required>
</div>
            </div>
            <div class="form-group">
                <label for="password"> Password:</label>
                <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-lock"></i></span>
                </div>
                <input type="password" class="form-control" id="password" name="password" required>
</div>
            </div>
            <div class="form-check">
                <input type="checkbox" class="form-check-input" id="remember" name="remember">
                <label class="form-check-label" for="remember"> Remember Me</label> 
                <a href="resetPassword.php"><p style="text-decoration: none;"><i class="fas fa-key"></i> Forgot Password </p></a>
            </div>
            <button type="submit" class="btn btn-primary" name="btnsubmit"><i class="fas fa-sign-in-alt"></i> Login</button>
                <p>Don't have a TRAINER account yet? <a href="trainer.php">Click here to register</a>.</p>
            </form>
        </div>
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
