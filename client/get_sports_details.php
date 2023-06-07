<?php
// Include the database connection file
require_once 'config.php';

// Check if the sportsCode parameter is set
if (isset($_GET['sportsCode'])) {
    // Retrieve the sports code from the request
    $sportsCode = $_GET['sportsCode'];

    // Prepare the query to retrieve the sports details
    $query = "SELECT * FROM availableSports WHERE sportsCode = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "s", $sportsCode);

    // Execute the query
    mysqli_stmt_execute($stmt);

    // Get the result
    $result = mysqli_stmt_get_result($stmt);

    // Check if there is a matching row
    if (mysqli_num_rows($result) > 0) {
        // Fetch the row as an associative array
        $row = mysqli_fetch_assoc($result);

        // Create an array with the sports details
        $sportsDetails = array(
            'sportsCode' => $row['sportsCode'],
            'sportsName' => $row['sportsName']
        );

        // Convert the array to JSON
        $jsonResponse = json_encode($sportsDetails);

        // Send the JSON response
        echo $jsonResponse;
    } else {
        // No matching row found
        echo 'No sports found';
    }
} else {
    // No sports code provided
    echo 'Invalid request';
}

// Close the statement
mysqli_stmt_close($stmt);

// Close the database connection
mysqli_close($conn);
?>