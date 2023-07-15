<?php
session_start();
include '../config/config.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $trainerId = $_GET['trainer_id'];

    // Check if the trainer ID is provided
    if (empty($trainerId)) {
        $_SESSION['error_message'] = "Please enter the trainer ID.";
        //header("Location: index.php");
        exit;
    }

    // Fetch trainer documents from the database
    $query = "SELECT id_path, license_cert_path, business_registration_cert_path FROM tbltrainerdocs WHERE trainer_id = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, 's', $trainerId);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $trainerDocs = mysqli_fetch_assoc($result);
    mysqli_stmt_close($stmt);

    // Check if any documents are found
    if (!$trainerDocs) {
        $_SESSION['error_message'] = "No documents found for the given trainer ID.";
       // header("Location: index.php");
        exit;
    }

    // Display the trainer documents
    $idPath = $trainerDocs['id_path'];
    $licenseCertPath = $trainerDocs['license_cert_path'];
    $businessRegistrationCertPath = $trainerDocs['business_registration_cert_path'];

    // Redirect to the view page with the document paths as URL parameters
    header("Location: view.php?id_path=$idPath&license_cert_path=$licenseCertPath&business_registration_cert_path=$businessRegistrationCertPath");
    exit;
} else {
    $_SESSION['error_message'] = "Invalid request method.";
    //header("Location: index.php");
    exit;
}
?>
