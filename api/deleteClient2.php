<?php


// Check if the request method is DELETE
if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    // Get the JSON payload from the request body
    $input = file_get_contents('php://input');
    $data = json_decode($input, true);

    // Check if the email field exists in the payload
    if (!isset($data['email'])) {
        $response = array(
            'message' => 'Validation error',
            'errors' => ['Email field is required']
        );
        http_response_code(400);
        echo json_encode($response);
        exit;
    }

    // Get the email from the payload
    $email = $data['email'];

    // Create a response array
    $response = array();

    // Perform the deletion in the database
    $query = "DELETE FROM tblusers WHERE email = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, 's', $email);
    mysqli_stmt_execute($stmt);

    // Check if any rows were affected
    $rowsAffected = mysqli_stmt_affected_rows($stmt);
    if ($rowsAffected > 0) {
        $response['message'] = 'User deleted successfully';
        http_response_code(200);
    } else {
        $response['message'] = 'User not found or already deleted';
        http_response_code(404);
    }

    // Close the statement and database connection
    mysqli_stmt_close($stmt);
    mysqli_close($conn);

    // Return the response as JSON
    header('Content-Type: application/json');
    echo json_encode($response);
    exit;
}

// Handle unsupported HTTP methods
$response = array(
    'message' => 'Method Not Allowed'
);
http_response_code(405);
header('Content-Type: application/json');
echo json_encode($response);
exit;
?>
