<?php
include '../config/config.php';

// Initialize variables
$trainerId = "";
$error = "";
$documents = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validate and sanitize input data
    $trainerId = $_POST['trainer_id'];

    // Query the tbltrainerdocs table to fetch the document paths based on the trainer ID
    $query = "SELECT id_path, license_cert_path, business_registration_cert_path FROM tbltrainerdocs WHERE trainer_id = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, 's', $trainerId);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $idPath, $licenseCertPath, $businessRegistrationCertPath);
    mysqli_stmt_fetch($stmt);
    mysqli_stmt_close($stmt);

    // Store the document paths in the $documents array
    if ($idPath && $licenseCertPath && $businessRegistrationCertPath) {
        $documents = [
            'ID Document' => $idPath,
            'License Certification' => $licenseCertPath,
            'Business Registration Certification' => $businessRegistrationCertPath
        ];
    } else {
        $error = "The documents you are looking for are not found.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Trainer Document Search</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .error {
            color: red;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Trainer Document Search</h1>

        <form method="POST" action="">
            <div class="form-group">
                <label for="trainer_id">Trainer ID:</label>
                <input type="text" id="trainer_id" name="trainer_id" class="form-control" value="<?php echo $trainerId; ?>">
            </div>
            <button type="submit" class="btn btn-primary">Search</button>
        </form>

        <?php if (!empty($error)): ?>
            <p class="error"><?php echo $error; ?></p>
        <?php elseif (!empty($documents)): ?>
            <h2>Documents</h2>
            <ul class="list-group">
                <?php foreach ($documents as $documentName => $documentPath): ?>
                    <li class="list-group-item">
                        <h3><?php echo $documentName; ?></h3>
                        <embed src="<?php echo $documentPath; ?>" type="application/pdf" width="100%" height="600px">
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
