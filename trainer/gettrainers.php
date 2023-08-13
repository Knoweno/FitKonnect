<?php
include '../config/config.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $query = "SELECT * FROM tbltrainers";
    $result = mysqli_query($conn, $query);

    if ($result) {
        $trainers = array();

        while ($row = mysqli_fetch_assoc($result)) {
            $trainers[] = $row;
        }

        http_response_code(200); // OK
        echo json_encode($trainers);
    } else {
        http_response_code(500); // Internal Server Error
        echo json_encode(['error' => 'Failed to fetch trainer data.']);
    }
} else {
    http_response_code(405); // Method Not Allowed
    echo json_encode(['error' => 'Invalid request method.']);
}
?>
