<?php
session_start();
include '../config/config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the payload data
    $data = json_decode(file_get_contents("php://input"), true);

    // Get the email from the payload or session
    $email = isset($data['email']) ? $data['email'] : $_SESSION['email'];
    // Fetch TrainerID using the email from tbltrainers table
    $fetchTrainerIdQuery = "SELECT id FROM tbltrainers WHERE email = ?";
    $stmt = mysqli_prepare($conn, $fetchTrainerIdQuery);
    mysqli_stmt_bind_param($stmt, 's', $email);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $trainerId);
    mysqli_stmt_fetch($stmt);
    mysqli_stmt_close($stmt);

    // Validate and sanitize input data
    $sportsName = isset($data['sportsName']) ? $data['sportsName'] : '';
    $sportDescription = isset($data['sportDescription']) ? $data['sportDescription'] : '';
    $price = isset($data['price']) ? $data['price'] : '';

    if (empty($sportsName) || empty($sportDescription) || empty($price) || empty($email)) {
        http_response_code(400); // Bad Request
        echo json_encode(['error' => 'All fields are required.']);
        exit;
    }

    // Insert data into availablesports table
    $insertQuery = "INSERT INTO availablesports (sportsName, sportDescription, Price, TrainerID) VALUES (?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $insertQuery);
    mysqli_stmt_bind_param($stmt, 'ssdi', $sportsName, $sportDescription, $price, $trainerId);

    if (mysqli_stmt_execute($stmt)) {
        http_response_code(200); // OK
        echo json_encode(['success' => 'Sports information inserted successfully.']);
    } else {
        http_response_code(500); // Internal Server Error
        echo json_encode(['error' => 'Failed to insert sports information.']);
    }

    mysqli_stmt_close($stmt);
} else {
    http_response_code(405); // Method Not Allowed
    echo json_encode(['error' => 'Invalid request method.']);
}
?>
