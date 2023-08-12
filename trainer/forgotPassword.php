<!DOCTYPE html>
<html>
<head>
    <title>Forgot Password</title>
    <!-- Include SweetAlert CSS and JS from CDN -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.all.min.js"></script>
</head>
<body>
    <form action="forgotPasswordController.php" method="POST">
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br><br>
        
        <button type="submit" name="btnsubmit">Reset Password</button>
    </form>
    
    <?php
    if (isset($_SESSION['reset_message'])) {
        echo "<script>
            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: '{$_SESSION['reset_message']}',
                showConfirmButton: false,
                timer: 5000
            });
        </script>";
        unset($_SESSION['reset_message']); // Clear the reset message
    }
    ?>
</body>
</html>
