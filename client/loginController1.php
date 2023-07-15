
    <?php
    session_start();
include '../config/config.php';
require_once '../links.php';
//require '../links.php';

/* 
$_SESSION['success_message'] = "Documents uploaded successfully.";

   
    $_SESSION['error_message'] = "Invalid request method.";
*/


function validateNotEmpty($variables)
{
  global $locallink;
    foreach ($variables as $variable) {
        if (empty($variable)) {
            $message ="No submit of blank details allowed";
            $_SESSION['error_message'] =$message;
            $message=htmlspecialchars($message, ENT_QUOTES, 'UTF-8');
            //throw new Exception($message);
            header("Location: $locallink/client/login.php?message=" . urlencode($message));
            exit;

            
        }
    }
}

    
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // $username = $_POST['username'];
        // $password = $_POST['password'];
    
        $username = sanitizeInput($_POST['username']);
        $password = sanitizeInput($_POST['password']);

        // Sanitize input
        $username = htmlspecialchars($username, ENT_QUOTES, 'UTF-8');
    
        // Prepare the SQL query
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
               $_SESSION['email'] = $row['email'];
                /*$_SESSION['firstName'] = $row['firstName'];
                $_SESSION['lastName'] = $row['lastName'];
                $_SESSION['phoneNumber'] = $row['phoneNumber'];*/
                //echo '<script>showLoginSuccessModal();</script>';
                $_SESSION['success_message'] = "Welcome back! You have logged in successfully.";
                header("Location: $locallink/client/selectionActivity.php");
                exit;
            } else {
                // Incorrect password
                //echo "Incorrect password. Please try again or register.";
                $message= "Incorrect username or password. Please try again.";
                $_SESSION['error_message'] = $message;
                //header("Location: $locallink/client/login.php?message=" .urlencode($message));
                header("Location: $locallink/client/login.php");
                exit;
            }
        } else {
            // User not found
           // echo "Incorrect details.Please try again or register";
           
            $message= "Incorrect username or password. Please try again.";
            $_SESSION['error_message']=$message;
            //header("Location: $locallink/client/login.php?message=" . urlencode($message));
            header("Location: $locallink/client/login.php");
            exit;
        }
        mysqli_close($conn);
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