<?php
include '../config/config.php';

// Check if the request method is DELETE
if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    // Get the JSON payload from the request body
    $input = file_get_contents('php://input');
    $data = json_decode($input, true);

    // Check if the email or clientId field exists in the payload
    if (!isset($data['email']) && !isset($data['clientId'])) {
        $response = array(
            'message' => 'Validation error',
            'error' => ['Email or Client ID field is required']
        );
        http_response_code(400);
        echo json_encode($response);
        exit;
    }

    // Get the email and clientId from the payload
    $email = isset($data['email']) ? $data['email'] : '';
    $clientId = isset($data['clientId']) ? $data['clientId'] : '';

    // Create a response array
    $response = array();

    // Perform the deletion in the database based on email or clientId
    if (!empty($email)) {
        $query = "DELETE FROM tblusers WHERE email = ?";
        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, 's', $email);
    } elseif (!empty($clientId)) {
        $query = "DELETE FROM tblusers WHERE id = ?";
        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, 'i', $clientId);
    } else {
        $response['error'] = 'Invalid data provided';
        http_response_code(400);
        echo json_encode($response);
        exit;
    }

    mysqli_stmt_execute($stmt);

    // Check if any rows were affected
    $rowsAffected = mysqli_stmt_affected_rows($stmt);
    if ($rowsAffected > 0) {
        $response['success'] = 'User deleted successfully';
        http_response_code(200);
    } else {
        $response['error'] = 'User not found or already deleted';
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
    'error' => 'Method Not Allowed'
);
http_response_code(405);
header('Content-Type: application/json');
echo json_encode($response);
exit;
?>
