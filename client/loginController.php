<?php
session_start();
include '../config/config.php';
require_once '../links.php';

function validateNotEmpty($variables)
{
    global $locallink;
    foreach ($variables as $variable) {
        if (empty($variable)) {
            $message = "No submission of blank details allowed";
            $_SESSION['error_message'] = $message;
            $message = htmlspecialchars($message, ENT_QUOTES, 'UTF-8');
            header("Location: $locallink/client/login.php?message=" . urlencode($message));
            exit;
        }
    }
}

function login($conn, $username, $password)
{
    // Prepare the SQL query using a prepared statement
    $stmt = mysqli_prepare($conn, "SELECT * FROM tblusers WHERE email = ? OR phoneNumber = ?");
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
            return true;
        }
    }

    return false;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = sanitizeInput($_POST['username']);
    $password = sanitizeInput($_POST['password']);

    // Validate input
    validateNotEmpty([$username, $password]);

    // Attempt login
    if (login($conn, $username, $password)) {
        // Successful login
        $_SESSION['email'] = $username;
        $_SESSION['success_message'] = "Welcome back! You have logged in successfully.";
        header("Location: $locallink/sports/");
        exit;
    } else {
        // Incorrect credentials
        $message = "Incorrect username or password. Please try again.";
        $_SESSION['error_message'] = $message;
        header("Location: $locallink/client/login.php");
        exit;
    }
}
?>
 
 <!-- Login Success Modal -->
<div class="modal fade" id="loginSuccessModal" tabindex="-1" aria-labelledby="loginSuccessModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="loginSuccessModalLabel">Login Successful</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p>Welcome back! You have logged in successfully.</p>
      </div>
    </div>
  </div>
</div>
<script>
  // Show the login success modal
  function showLoginSuccessModal() {
    var modal = new bootstrap.Modal(document.getElementById('loginSuccessModal'));
    modal.show();
  }
</script>
<?php
function sanitizeInput($input)
{
    $input = trim($input);
    $input = stripslashes($input);
    $input = htmlspecialchars($input);
    return $input;
}
?>
