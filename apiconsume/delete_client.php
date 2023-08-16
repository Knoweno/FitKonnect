<?php
include '../config/config.php';

if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    // Get the payload data
    $data = json_decode(file_get_contents("php://input"), true);

    // Validate and sanitize input data
    $clientId = isset($data['clientId']) ? $data['clientId'] : '';

    if (empty($clientId)) {
        http_response_code(400); // Bad Request
        echo json_encode(['error' => 'Client ID is required.']);
        exit;
    }

    // Delete the client record from the database
    $deleteQuery = "DELETE FROM tblusers WHERE id = ?";
    $stmt = mysqli_prepare($conn, $deleteQuery);
    mysqli_stmt_bind_param($stmt, 'i', $clientId);

    if (mysqli_stmt_execute($stmt)) {
        http_response_code(200); // OK
        echo json_encode(['success' => 'Client deleted successfully.']);
    } else {
        http_response_code(500); // Internal Server Error
        echo json_encode(['error' => 'Failed to delete client.']);
    }

    mysqli_stmt_close($stmt);
} else {
    http_response_code(405); // Method Not Allowed
    echo json_encode(['error' => 'Invalid request method.']);
}
?>
