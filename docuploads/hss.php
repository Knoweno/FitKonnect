<?php
session_start();
include '../config/config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validate and sanitize input data
    $trainerId = $_POST['trainer_id'];
    $trainerName = $_POST['trainer_name'];

    // Check if all required fields are filled
    if (empty($trainerId) || empty($trainerName)) {
        $_SESSION['error_message'] = "Please fill in all required fields.";
        header("Location: trainerdoc.php");
        exit;
    }

    // Check if the ID document file is uploaded
    if (!isset($_FILES['id']) || $_FILES['id']['error'] === UPLOAD_ERR_NO_FILE) {
        $_SESSION['error_message'] = "Please upload the ID document.";
        header("Location: trainerdoc.php");
        exit;
    }

    // Check if the License Certification file is uploaded
    if (!isset($_FILES['license_cert']) || $_FILES['license_cert']['error'] === UPLOAD_ERR_NO_FILE) {
        $_SESSION['error_message'] = "Please upload the License Certification document.";
        header("Location: trainerdoc.php");
        exit;
    }

    // Check if the Business Registration Certification file is uploaded
    if (!isset($_FILES['business_registration_cert']) || $_FILES['business_registration_cert']['error'] === UPLOAD_ERR_NO_FILE) {
        $_SESSION['error_message'] = "Please upload the Business Registration Certification document.";
        header("Location: trainerdoc.php");
        exit;
    }

    // Check if uploaded files are in PDF format
    $allowedExtensions = ['pdf'];
    $idFile = $_FILES['id'];
    $licenseCertFile = $_FILES['license_cert'];
    $businessRegistrationCertFile = $_FILES['business_registration_cert'];

    if (!in_array(pathinfo($idFile['name'], PATHINFO_EXTENSION), $allowedExtensions) ||
        !in_array(pathinfo($licenseCertFile['name'], PATHINFO_EXTENSION), $allowedExtensions) ||
        !in_array(pathinfo($businessRegistrationCertFile['name'], PATHINFO_EXTENSION), $allowedExtensions)) {
        $_SESSION['error_message'] = "Please upload PDF files only.";
        header("Location: trainerdoc.php");
        exit;
    }

    // Check file sizes
    $maxFileSize = 50 * 1024 * 1024; // 50MB
    if ($idFile['size'] > $maxFileSize ||
        $licenseCertFile['size'] > $maxFileSize ||
        $businessRegistrationCertFile['size'] > $maxFileSize) {
        $_SESSION['error_message'] = "File size should not exceed 50MB.";
        header("Location: trainerdoc.php");
        exit;
    }

    // Create a subfolder for the trainer's documents
    $yearCreated = date('Y');
    $folderName = "TRAINER_{$trainerId}_{$yearCreated}_{$trainerName}";
    $uploadPath = "trainer_docs/{$folderName}/";
    
    // Ensure the trainer_docs folder exists
    if (!is_dir("trainer_docs")) {
        mkdir("trainer_docs", 0755);
    }
    
    // Ensure the subfolder doesn't already exist
    if (!is_dir($uploadPath)) {
        if (!mkdir($uploadPath, 0755, true)) {
            $_SESSION['error_message'] = "Failed to create the trainer's document folder.";
            header("Location: trainerdoc.php");
            exit;
        }
    }

    // Move uploaded files to the trainer's folder
    $idFilePath = $uploadPath . basename($idFile['name']);
    $licenseCertFilePath = $uploadPath . basename($licenseCertFile['name']);
    $businessRegistrationCertFilePath = $uploadPath . basename($businessRegistrationCertFile['name']);

    if (!move_uploaded_file($idFile['tmp_name'], $idFilePath) ||
        !move_uploaded_file($licenseCertFile['tmp_name'], $licenseCertFilePath) ||
        !move_uploaded_file($businessRegistrationCertFile['tmp_name'], $businessRegistrationCertFilePath)) {
        $_SESSION['error_message'] = "Failed to upload the files.";
        header("Location: trainerdoc.php");
        exit;
    }





    
    // Insert uploaded file details into the database
    $query = "INSERT INTO tbltrainerdocs (trainer_id, id_path, license_cert_path, business_registration_cert_path) VALUES (?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, 'ssss', $trainerId, $idFilePath, $licenseCertFilePath, $businessRegistrationCertFilePath);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    // Redirect to a success page or display a success message
    $_SESSION['success_message'] = "Documents uploaded successfully.";
    header("Location: success.php");
    exit;
} else {
    $_SESSION['error_message'] = "Invalid request method.";
    header("Location: trainerdoc.php");
    exit;
}
