<?php 
session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Forgot Password</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <!-- JQuery -->
    <script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
    <!-- Include SweetAlert CSS and JS from CDN -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.all.min.js"></script>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
        }
        .form-container {
            width: 400px;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <?php include '../nav-bar.php' ?>

    <div class="form-container">
        <h3 class="text-center">Password Reset</h3>
        
        <?php
        if (isset($_SESSION['reset_email'])) {
            echo '<p class="text-center">Reset email: ' . $_SESSION['reset_email'] . '</p>';
            unset($_SESSION['reset_email']); // Clear the reset email
        }
        ?>
        
        <form action="resetPasswordController.php" method="POST">
        <div class="form-group">
            <label for="email"> Email:</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                </div>
            <input type="email" class="form-control" id="email" name="email" required>
    </div>
        </div>
        
        <div class="form-group">
            <label for="new_password"> New Password:</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-lock"></i></span>
                </div>
            <input type="password" class="form-control" id="new_password" name="new_password" required>
    </div>
        </div>
        
        <div class="form-group">
            <label for="confirm_password"> Confirm Password:</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-lock"></i></span>
                </div>
            <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
    </div>
        </div>
        
        <div class="d-flex justify-content-between">
            <button type="submit" class="btn btn-primary" name="btnsubmit">
                <i class="fas fa-key"></i> Reset Password
            </button>
            
            <a href="./" class="btn btn-secondary">
                <i class="fas fa-times-circle"></i> Cancel
            </a>
        </div>
    </form>
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
                
                    window.location.href = './';
                
            });";
            unset($_SESSION['success_message']); // Clear the reset message
        }
        ?>
    </script>
</body>
</html>
