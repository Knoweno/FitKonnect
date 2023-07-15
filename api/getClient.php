<?php


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
    $query = 'SELECT * FROM tblusers';

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
} else {
    // Handle unsupported HTTP methods
    http_response_code(405);
    echo json_encode(['error' => 'Method Not Allowed']);
}
?>
