<?php
include '../config/config.php';

// Initialize variables
$trainerId = "";
$selectedTrainerId = "";
$error = "";
$documents = [];

// Query all trainer IDs
$query = "SELECT trainer_id FROM tbltrainerdocs";
$result = mysqli_query($conn, $query);
$trainerIds = mysqli_fetch_all($result, MYSQLI_ASSOC);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validate and sanitize input data
    $trainerId = $_POST['trainer_id'];

    // Query the tbltrainerdocs table to fetch the document paths based on the selected trainer ID
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
        $selectedTrainerId = $trainerId;
    } else {
        $error = "The documents for the selected trainer ID are not found.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Trainer Document Search</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            padding-top: 60px;
        }

        .navbar {
            background-color: #08a0e9;
            color: white;
        }

        .sidebar {
            position: fixed;
            top: 60px;
            left: 0;
            height: 100%;
            width: 200px;
            background-color: #f8f9fa;
            padding-top: 20px;
        }

        .sidebar ul {
            list-style-type: none;
            padding: 0;
            margin: 0;
        }

        .sidebar li {
            margin-bottom: 10px;
        }

        .sidebar li a {
            color: #08a0e9;
        }

        .main-content {
            margin-left: 200px;
            padding: 20px;
        }

        .error {
            color: red;
        }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-md navbar-dark fixed-top">
        <a class="navbar-brand" href="#">Trainer Document Search</a>
    </nav>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2 sidebar">
            <h2>Trainer IDs</h2>
                <ul class="list-group">
                    <?php foreach ($trainerIds as $trainer): ?>
                        <li class="list-group-item">
                            <form method="POST" action="">
                                <input type="hidden" name="trainer_id" value="<?php echo $trainer['trainer_id']; ?>">
                                <button type="submit" class="btn btn-link"><?php echo $trainer['trainer_id']; ?></button>
                            </form>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
           
            <div class="col-md-10 main-content">
                <h2>Trainer Document Search</h2>

                <form method="POST" action="">
                    <div class="form-group">
                        <label for="trainer_id">Trainer ID:</label>
                        <input type="text" id="trainer_id" name="trainer_id" class="form-control" value="<?php echo $trainerId; ?>">
                    </div>
                    <div class="form-group">
        <button type="submit" class="btn btn-primary mr-2">Search</button>
        <button type="button" class="btn btn-success mr-2">Approve</button>
        <button type="button" class="btn btn-danger">Decline</button>
    </div>
                </form>

                <?php if (!empty($error)): ?>
                    <p class="error"><?php echo $error; ?></p>
                <?php elseif (!empty($documents)): ?>
                    <h2>Trainer Documents - ID: <?php echo $selectedTrainerId; ?></h2>
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

        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
