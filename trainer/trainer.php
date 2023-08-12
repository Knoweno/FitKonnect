<?php  session_start();  ?>
<!DOCTYPE html>
<html>
<head>
    <title>Registration</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- JQuery -->
    <script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
    <!-- Datepicker CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">
    <!-- Include SweetAlert CSS and JS from CDN -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.all.min.js"></script>
    <style>
        .center-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }
        .registration-form {
            max-width: 400px;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .registration-title {
            text-align: center;
            margin-bottom: 20px;
        }
        .message {
            display: none;
        }
    </style>
</head>
<body>
    <?php include '../nav-bar.php' ?>

    <div class="center-container">
        <div class="registration-form">
            <h2 class="registration-title">Trainer Registration</h2>
            
            <?php
            // if (isset($_GET['message'])) {
            //     $message = $_GET['message'];
            //     $alertClass = ($message !== "Registration successful") ? 'alert-danger' : 'alert-success';
            //     echo '<div class="alert ' . $alertClass . ' message">' . $message . '</div>';
            // }
            ?>
            
            <form id="registrationForm" method="POST" action="trainerController.php">
                <div class="form-group">
                    <label for="email">Email Address</label>
                    <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                </div>
                    <input type="email" class="form-control" id="email" name="email" required>
        </div>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <div class="input-group">
                    <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-lock"></i></span>
                </div>
                    <input type="password" class="form-control" id="password" name="password" minlength="6" maxlength="10" required>
        </div>
                </div>
                <div class="form-group">
                    <label for="confirmPassword">Confirm Password</label>
                    <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-lock"></i></span>
                </div>
                    <input type="password" class="form-control" id="confirmPassword" name="confirmPassword" minlength="6" maxlength="10" required>
        </div>
                </div>
                <button type="submit" class="btn btn-primary"><i class="fas fa-user-plus"></i> Register</button>
                <p>Do you have a TRAINER account? <a href="index.php">Click here to login.</a></p>
            </form>
        </div>
    </div>

    <script>
        <?php
        
        if (isset($_SESSION['error_message'])) {
            echo "Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: '{$_SESSION['error_message']}',
                showConfirmButton: true,
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'OK',
                timer: 5000
            });";
            unset($_SESSION['error_message']); // Clear the reset message
        }
        if (isset($_SESSION['success_message'])) {
            echo "Swal.fire({
                icon: 'success',
                title: 'Success...',
                text: '{$_SESSION['success_message']}',
                showConfirmButton: true,
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'OK',
                timer: 5000
            }).then(() => {
                
                    window.location.href = 'https://www.jetbrains.com/';
                
            });";
            unset($_SESSION['success_message']); // Clear the reset message
        }
        
        ?>
    </script>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <!-- Datepicker JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
    <!-- Custom script -->
    <script src="script.js"></script>
    
    <script>
        $(document).ready(function() {
            $('.message').fadeIn();

            // Hide the message after 5 seconds
            setTimeout(function() {
                $('.message').fadeOut('slow');
            }, 5000);
        });
    </script>
</body>
</html>
