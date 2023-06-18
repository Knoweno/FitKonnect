<?php
// reset.php
include 'config.php';
// Check if the user is already logged in, if so, redirect to home page
// Assuming you have a session management system in place
session_start();

if (isset($_SESSION['user_id'])) {
    header("Location: http://localhost/fitkonnect/");
    exit();
}

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $emailOrPhone = $_POST['email_or_phone'];

    // Perform input validation here (e.g., check if the email/phone format is valid)


    // Check if the user exists in the database
    $query = "SELECT * FROM tblusers WHERE email = ? OR phoneNumber = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ss", $emailOrPhone, $emailOrPhone);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    // Redirect to registration page if user doesn't exist
    if (!$user) {
        header("Location: register.php?error=UserNotFound");
        exit();
    }

    // Store the user's email/phone in a session variable to be used in resetProcess.php
    $_SESSION['reset_email_or_phone'] = $emailOrPhone;

    // Redirect to password reset page
    header("Location: resetProcess.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Password Reset</title>
</head>
<body>
<?php include '../nav-bar.php' ?>
    <h1>Password Reset</h1>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <?php
    // Check if there is an error message from the registration page
    if (isset($_GET['error']) && $_GET['error'] === 'UserNotFound') {
        echo '<div id="errorMessage" class="alert alert-danger"> User not found.</div>';
    }
    ?>
    <form method="POST" action="passreset.php">
        <label for="email_or_phone">Email or Phone Number:</label>
        <input type="text" id="email_or_phone" name="email_or_phone" required>
        <button type="submit" class="btn btn-primary">Reset Password</button>
    </form>


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
