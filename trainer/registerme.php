<?php 
session_start();
include '../config/config.php';

if ($_SERVER['REQUEST_METHOD'] === 'PUT') {
    // Get the payload data
    $data = json_decode(file_get_contents("php://input"), true);

    // Get the email from the payload or session
    $email = isset($data['email']) ? $data['email'] : $_SESSION['email'];

    // Validate and sanitize input data
    $firstName = $data['firstName'];
    $lastName = $data['lastName'];
    $phoneNumber = $data['phoneNumber'];
    $educationLevel = $data['educationLevel'];
    $dateOfBirth = $data['dateOfBirth'];
    $gender =$data['gender'];

    // Validate phone number
    if (!preg_match('/^0[0-9]{9}$/', $phoneNumber)) {
        http_response_code(400); // Bad Request
        echo json_encode(['error' => 'Invalid phone number format. Phone number must start with 0 and have 10 digits.']);
        exit;
    }

    // Validate date of birth
    if (!DateTime::createFromFormat('Y-m-d', $dateOfBirth)) {
        http_response_code(400); // Bad Request
        echo json_encode(['error' => 'Invalid date format for date of birth.']);
        exit;
    }

    // Check if the phone number exists in the tbltrainers table
    $checkPhoneQuery = "SELECT COUNT(*) FROM tbltrainers WHERE phoneNumber = ? AND email != ?";
    // $checkPhoneQuery = "SELECT COUNT(*) FROM tbltrainers WHERE phoneNumber = ?";
    $stmt = mysqli_prepare($conn, $checkPhoneQuery);
    mysqli_stmt_bind_param($stmt, 'ss', $phoneNumber, $email);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $phoneCount);
    mysqli_stmt_fetch($stmt);
    mysqli_stmt_close($stmt);

    if ($phoneCount > 0) {
        http_response_code(409); // Conflict
        echo json_encode(['error' => 'Phone number already exists in the database.']);
        exit;
    }

    // Update the tbltrainers table based on the email
    $updateQuery = "UPDATE tbltrainers SET firstName = ?, lastName = ?, phoneNumber = ?, educationLevel = ?, gender=?, dateOfBirth = ? WHERE email = ?";
    $stmt = mysqli_prepare($conn, $updateQuery);
    mysqli_stmt_bind_param($stmt, 'sssssss', $firstName, $lastName, $phoneNumber, $educationLevel, $gender,$dateOfBirth, $email);

    if (mysqli_stmt_execute($stmt)) {
        http_response_code(200); // OK
        echo json_encode(['success' => 'Trainer information updated successfully.']);
    } else {
        http_response_code(500); // Internal Server Error
        echo json_encode(['error' => 'Failed to update trainer information.']);
    }

    mysqli_stmt_close($stmt);
} else {
    http_response_code(405); // Method Not Allowed
    echo json_encode(['error' => 'Invalid request method.']);
}
?>
