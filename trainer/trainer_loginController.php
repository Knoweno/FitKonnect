<?php
session_start();
include '../config/config.php';
$link = 'http://localhost/Projects/FitKonnect';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Sanitize input
    $username = htmlspecialchars($username, ENT_QUOTES, 'UTF-8');
    // Validate input
if (empty($username) || empty($password)) {
  echo "Please enter both username and password.";
  header("Location: index.php?message=Please enter both username and password.");
  exit;
}



    // Prepare the SQL query with placeholders
    $stmt = mysqli_prepare($conn, "SELECT * FROM tbltrainers WHERE email = ? OR phoneNumber = ?");
    mysqli_stmt_bind_param($stmt, 'ss', $username, $username);

    // Execute the SQL query
    mysqli_stmt_execute($stmt);

    // Get the result
    $result = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($result) === 1) {
        // Fetch the user data
        $row = mysqli_fetch_assoc($result);

        // Verify the password
        if (password_verify($password, $row['password'])) {
            // Successful login
            $_SESSION['email'] = $row['email'];

            // Redirect to the desired page
            header("Location: trainer_registration.php");
            exit;
        } else {
            // Incorrect password
            $message = 'Incorrect password. Please try again or register.'; // Get the URL parameter
            $decodedMessage = urldecode($message); 
            //header("Location: $link/register0.php?message=" . urlencode($decodedMessage));

            echo "Incorrect password. Please try again or register.";
            header("Location: index.php?message=" . urlencode($decodedMessage));
            exit;
        }
    } else {
        // User not found
        echo "User not found. Please register.";
        header("Location: $link/register0.php?message=User not found. Please register.");
        exit;
    }

    mysqli_stmt_close($stmt);
    mysqli_close($conn);
}
?>
