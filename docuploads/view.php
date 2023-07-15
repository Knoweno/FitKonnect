<?php
session_start();

$idPath = $_GET['id_path'];
$licenseCertPath = $_GET['license_cert_path'];
$businessRegistrationCertPath = $_GET['business_registration_cert_path'];

// Check if the document paths are provided
if (empty($idPath) || empty($licenseCertPath) || empty($businessRegistrationCertPath)) {
    $_SESSION['error_message'] = "Document paths are missing.";
    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>View Documents</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            padding-top: 60px;
        }

        .navbar {
            background-color: #08a0e9;
            color: white;
        }

        .main-content {
            margin: 20px;
        }

        .document-frame {
            width: 100%;
            height: 600px;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-md navbar-dark fixed-top">
        <a class="navbar-brand" href="#">View Documents</a>
    </nav>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 main-content">
                <h2>Trainer Documents</h2>

                <div class="document-frame">
                    <embed src="<?php echo $idPath; ?>" type="application/pdf" width="100%" height="100%">
                </div>

                <div class="document-frame">
                    <embed src="<?php echo $licenseCertPath; ?>" type="application/pdf" width="100%" height="100%">
                </div>

                <div class="document-frame">
                    <embed src="<?php echo $businessRegistrationCertPath; ?>" type="application/pdf" width="100%" height="100%">
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
