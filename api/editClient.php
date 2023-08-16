<?php
// Include the database configuration
include '../config/config.php';

// Handle HTTP GET request
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // Create a new MySQLi object
    $conn = new mysqli($host, $user, $hostpassword, $database, $socket);

    // Check the connection
    if ($conn->connect_error) {
        // Handle the database connection error
        http_response_code(500);
        echo json_encode(['error' => 'Database connection failed']);
        exit;
    }

    // Create the SQL query
    $query = 'SELECT * FROM tblusers ORDER BY id DESC';

    // Execute the query
    $result = $conn->query($query);

    // Check if any rows were returned
    if ($result->num_rows > 0) {
        // Create an empty array to store the results
        $data = [];

        // Fetch each row and add it to the data array
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }

        // Close the database connection
        $conn->close();

        // Return the data as JSON
        header('Content-Type: application/json');
        echo json_encode($data);
    } else {
        // Close the database connection
        $conn->close();

        // Return an empty response
        header('Content-Type: application/json');
        echo json_encode([]);
    }
} elseif ($_SERVER['REQUEST_METHOD'] === 'PUT') {
    // Get the payload data
    $data = json_decode(file_get_contents("php://input"), true);

    // Validate and sanitize input data
    $clientId = isset($data['clientId']) ? $data['clientId'] : '';
    $firstName = isset($data['firstName']) ? $data['firstName'] : '';
    $lastName = isset($data['lastName']) ? $data['lastName'] : '';
    $phoneNumber = isset($data['phoneNumber']) ? $data['phoneNumber'] : '';
    $email = isset($data['email']) ? $data['email'] : '';
    $dateOfBirth = isset($data['dateOfBirth']) ? $data['dateOfBirth'] : '';

    if (empty($clientId) || empty($firstName) || empty($lastName) || empty($phoneNumber) || empty($email) || empty($dateOfBirth)) {
        http_response_code(400); // Bad Request
        echo json_encode(['error' => 'Invalid input data']);
        exit;
    }

    // Create a new MySQLi object
    $conn = new mysqli($host, $user, $hostpassword, $database, $socket);

    // Check the connection
    if ($conn->connect_error) {
        // Handle the database connection error
        http_response_code(500);
        echo json_encode(['error' => 'Database connection failed']);
        exit;
    }

    // Create the SQL query
    $query = 'UPDATE tblusers SET firstName=?, lastName=?, phoneNumber=?, email=?, dateOfBirth=? WHERE id=?';
    
    // Prepare and bind the parameters
    $stmt = $conn->prepare($query);
    $stmt->bind_param('sssssi', $firstName, $lastName, $phoneNumber, $email, $dateOfBirth, $clientId);

    // Execute the query
    if ($stmt->execute()) {
        // Close the database connection
        $conn->close();

        // Return success response
        http_response_code(200);
        echo json_encode(['success' => 'Client data updated successfully']);
    } else {
        // Close the database connection
        $conn->close();

        // Return error response
        http_response_code(500);
        echo json_encode(['error' => 'Failed to update client data']);
    }
} else {
    // Handle unsupported HTTP methods
    http_response_code(405);
    echo json_encode(['error' => 'Method Not Allowed']);
}
?>
