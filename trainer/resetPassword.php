<?php 
session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Forgot Password</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
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
                <label for="email">Email:</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            
            <div class="form-group">
                <label for="new_password">New Password:</label>
                <input type="password" class="form-control" id="new_password" name="new_password" required>
            </div>
            
            <div class="form-group">
                <label for="confirm_password">Confirm Password:</label>
                <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
            </div>
            
            <button type="submit" class="btn btn-primary" name="btnsubmit">Reset Password</button>
        </form>
    </div>
    
    <script>
        <?php
        if (isset($_SESSION['reset_message'])) {
            $icon = $_SESSION['reset_message_type'] === 'success' ? 'success' : 'error';
            echo "Swal.fire({
                icon: '$icon',
                title: '{$_SESSION['reset_message_type'] === 'success' ? 'Success' : 'Oops...'}',
                text: '{$_SESSION['reset_message']}',
                showConfirmButton: true,
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'OK',
                timer: 5000
            });";
            unset($_SESSION['reset_message']); // Clear the reset message
            unset($_SESSION['reset_message_type']); // Clear the reset message type
        }
        ?>
    </script>
</body>
</html>
