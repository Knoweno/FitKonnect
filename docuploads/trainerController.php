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
    } elseif (!isset($_FILES['id']) || $_FILES['id']['error'] === UPLOAD_ERR_NO_FILE) {
        $_SESSION['error_message'] = "Please upload the ID document.";
    } elseif (!isset($_FILES['license_cert']) || $_FILES['license_cert']['error'] === UPLOAD_ERR_NO_FILE) {
        $_SESSION['error_message'] = "Please upload the License Certification document.";
    } elseif (!isset($_FILES['business_registration_cert']) || $_FILES['business_registration_cert']['error'] === UPLOAD_ERR_NO_FILE) {
        $_SESSION['error_message'] = "Please upload the Business Registration Certification document.";
    } else {
        // Check if the trainer ID exists in the database
        $checkQuery = "SELECT COUNT(*) FROM tbltrainerdocs WHERE trainer_id = ?";
        $stmt = mysqli_prepare($conn, $checkQuery);
        mysqli_stmt_bind_param($stmt, 's', $trainerId);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $count);
        mysqli_stmt_fetch($stmt);
        mysqli_stmt_close($stmt);

        if ($count > 0) {
            $_SESSION['error_message'] = "Trainer ID already exists.";
            header("Location: trainerdoc.php");
    exit;
        } else {
            // Check if uploaded files are in PDF format
            $allowedExtensions = ['pdf'];
            $idFile = $_FILES['id'];
            $licenseCertFile = $_FILES['license_cert'];
            $businessRegistrationCertFile = $_FILES['business_registration_cert'];

            if (!in_array(pathinfo($idFile['name'], PATHINFO_EXTENSION), $allowedExtensions) ||
                !in_array(pathinfo($licenseCertFile['name'], PATHINFO_EXTENSION), $allowedExtensions) ||
                !in_array(pathinfo($businessRegistrationCertFile['name'], PATHINFO_EXTENSION), $allowedExtensions)) {
                $_SESSION['error_message'] = "Please upload PDF files only.";
            } elseif ($idFile['size'] > 50 * 1024 * 1024 || $licenseCertFile['size'] > 50 * 1024 * 1024 || $businessRegistrationCertFile['size'] > 50 * 1024 * 1024) {
                $_SESSION['error_message'] = "File size should not exceed 50MB.";
            } else {
                // Create the subfolder based on user ID, username, and current year
                $year = date("Y");
                $subfolder = $trainerId . "_" . $trainerName . "_" . $year;
                $uploadPath = '../trainer_docs/' . $subfolder . '/';
                if (!is_dir($uploadPath)) {
                    mkdir($uploadPath, 0755, true);
                }

                // Generate unique filenames for the uploaded files
                $idFileName = uniqid('id_', true) . '.pdf';
                $licenseCertFileName = uniqid('license_', true) . '.pdf';
                $businessRegistrationCertFileName = uniqid('business_', true) . '.pdf';

                // Move uploaded files to the subfolder
                $idFilePath = $uploadPath . $idFileName;
                $licenseCertFilePath = $uploadPath . $licenseCertFileName;
                $businessRegistrationCertFilePath = $uploadPath . $businessRegistrationCertFileName;

                if (!move_uploaded_file($idFile['tmp_name'], $idFilePath) ||
                    !move_uploaded_file($licenseCertFile['tmp_name'], $licenseCertFilePath) ||
                    !move_uploaded_file($businessRegistrationCertFile['tmp_name'], $businessRegistrationCertFilePath)) {
                    $_SESSION['error_message'] = "Failed to upload the files.";
                } else {
                    // Insert uploaded file details into the database
                    $query = "INSERT INTO tbltrainerdocs (trainer_id, id_path, license_cert_path, business_registration_cert_path) VALUES (?, ?, ?, ?)";
                    $stmt = mysqli_prepare($conn, $query);
                    mysqli_stmt_bind_param($stmt, 'ssss', $trainerId, $idFilePath, $licenseCertFilePath, $businessRegistrationCertFilePath);
                    mysqli_stmt_execute($stmt);
                    mysqli_stmt_close($stmt);

                    $_SESSION['success_message'] = "Documents uploaded successfully.";
                    header("Location: trainerdoc.php");
                    exit;
                }
            }
        }
    }
} else {
    $_SESSION['error_message'] = "Invalid request method.";
    header("Location: trainerdoc.php");
    exit;
}
?>
