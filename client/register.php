<?php  
session_start();

?>
<!DOCTYPE html>
<html>
<head>
    <title>Registration</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- JQuery -->
    <script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
    <!-- Datepicker CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">
    <style>
        .hide-alert {
            display: none;
        }
    /* .alert-message {
    position: fixed;
    top: 10px;
    left: 50%;
    transform: translateX(-50%);
    z-index: 9999;
} */
    </style>
</head>
<body>
<?php include '../nav-bar.php' ?>
    <div class="container mt-5">
        <h1>Registration</h1>
       
<?php if (isset($_SESSION['success_message'])) { ?>
        <div class="alert alert-success alert-message" role="alert">
            <?php echo $_SESSION['success_message']; ?>
        </div>
    <?php } elseif (isset($_SESSION['error_message'])) { ?>
        <div class="alert alert-danger alert-message" role="alert">
            <?php echo $_SESSION['error_message']; ?>
        </div>
    <?php } ?>



        <form id="registrationForm" method="POST" action="registerController.php">
            <div class="form-group">
                <label for="firstName">First Name</label>
                <input type="text" class="form-control" id="firstName" name="firstName" required>
            </div>
            <div class="form-group">
                <label for="lastName">Last Name</label>
                <input type="text" class="form-control" id="lastName" name="lastName" required>
            </div>
            <div class="form-group">
                <label for="email">Email Address</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="telephone">Telephone Number</label>
                <input type="tel" class="form-control" id="telephone" name="telephone" minlength="10" maxlength="10" required>
            </div>
            <div class="form-group">
                <label for="dob">Date of Birth</label>
                <input type="text" class="form-control datepicker" id="dob" name="dob" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" name="password" minlength="6" maxlength="10" required>
            </div>
            <div class="form-group">
                <label for="confirmPassword">Confirm Password</label>
                <input type="password" class="form-control" id="confirmPassword" name="confirmPassword" minlength="6" maxlength="10" required>
            </div>
            <button type="submit" class="btn btn-primary">Register</button>
            <p>Do you have an account? <a href="login.php">Click here to login.</a></p>
        </form>
    </div>

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
            // Initialize the datepicker
           $('.datepicker').datepicker({
                format: 'yyyy-mm-dd',
                endDate: new Date(),
                maxViewMode: 2,
                todayBtn: 'linked',
                todayHighlight: true
            });
         
            setTimeout(function() {
            var alertMessages = document.querySelectorAll('.alert-message');
            alertMessages.forEach(function(alert) {
                alert.remove();
            });
        }, 5000);
            

            // Hide the message modal after 5 seconds
            setTimeout(function() {
                $('#errorMessage, #successMessage').fadeOut('slow');
            }, 5000);
        });
    </script>
 <?php session_destroy(); ?>
</body>
</html>