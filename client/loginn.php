
    <?php
    session_start();
    require_once 'config.php';
    
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $username = $_POST['username'];
        $password = $_POST['password'];
    
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
                //echo '<script>showLoginSuccessModal();</script>';
                header("Location: selectionActivity.php");
                exit;
            } else {
                // Incorrect password
                echo "Incorrect password. Please try again or register.";
                header("Location: login.php?message=Incorrect password. Please try again or register.");
                exit;
            }
        } else {
            // User not found
            echo "User not found. Please register.";
            header("Location: register.php?message=User not found. Please register.");
            exit;
        }
        mysqli_close($conn);
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