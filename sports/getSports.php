<?php
// Your database connection setup here
include '../config/config.php';

// Fetch data from availablesports with Trainer details
$sql = "SELECT a.sportsCode,a.sportsName, a.sportDescription, a.Price, CONCAT(t.firstName, ' ', t.lastName) AS trainerName
        FROM availablesports AS a
        INNER JOIN tbltrainers AS t ON a.TrainerID = t.id";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Fetch and output data
    $data = array();
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }

    header('Content-Type: application/json');
    echo json_encode($data);
} else {
    echo "No data found";
}

$conn->close();
?>
