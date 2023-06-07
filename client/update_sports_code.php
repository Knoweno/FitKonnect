<?php
// Start the session
session_start();

if (isset($_POST['sportsCode'])) {
    // Update the session variable with the selected sports code
    $_SESSION['selectedSportsCode'] = $_POST['sportsCode'];
    
}
?>
