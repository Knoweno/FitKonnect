<?php
include '../config/config.php';
function uploadTrainerDocuments($trainerId, $trainerName, $yearCreated) {
    global $conn ;
    // Destination folder for uploaded documents
    $uploadFolder = 'trainer_docs/';

    // Create a subfolder for the trainer's documents
    $subfolder = 'TRAINER_' . $trainerId . '_' . $yearCreated . '_' . $trainerName;
    $subfolderPath = $uploadFolder . $subfolder;

    if (!file_exists($subfolderPath)) {
        mkdir($subfolderPath, 0777, true);
    }

    // Process uploaded documents
    $documents = ['id', 'license_cert', 'business_registration_cert'];

    foreach ($documents as $document) {
        if ($_FILES[$document]['error'] === UPLOAD_ERR_OK) {
            $file = $_FILES[$document];
            
            // Validate file type (PDF) and size (not exceeding 50MB)
            $allowedTypes = ['application/pdf'];
            $maxSize = 50 * 1024 * 1024; // 50MB

            if (in_array($file['type'], $allowedTypes) && $file['size'] <= $maxSize) {
                $fileName = $file['name'];
                $filePath = $subfolderPath . '/' . $fileName;

                // Move the uploaded file to the destination folder
                if (move_uploaded_file($file['tmp_name'], $filePath)) {
                    // Insert the document details into the MySQL database
                    //$conn = mysqli_connect('localhost', 'username', 'password', 'database');

                    // Sanitize data to prevent SQL injection (use appropriate values for your database connection)
                    $trainerId = mysqli_real_escape_string($conn, $trainerId);
                    $documentType = mysqli_real_escape_string($conn, $document);
                    $documentPath = mysqli_real_escape_string($conn, $filePath);

                    // Insert the document details into the tbltrainerdocs table
                    $query = "INSERT INTO tbltrainerdocs (trainerId, documentType, documentPath) VALUES ('$trainerId', '$documentType', '$documentPath')";
                    //mysqli_query($conn, $query);
                    mysqli_query($conn, $query) or die(mysqli_error($conn));

                    mysqli_close($conn);
                }
            }
        }
    }
}

// Example usage: Process the uploaded documents for a new trainer
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $trainerId = $_POST['trainer_id'];
    $trainerName = $_POST['trainer_name'];
    $yearCreated = date('Y');

    uploadTrainerDocuments($trainerId, $trainerName, $yearCreated);
    // Redirect or display a success message
}
?>
