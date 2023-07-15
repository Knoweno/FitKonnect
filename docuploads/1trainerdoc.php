<!DOCTYPE html>
<html>
<head>
    <title>Trainer Document Upload</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h2>Trainer Document Upload</h2>
        <form method="POST" enctype="multipart/form-data" action="trainerController.php">
            <div class="form-group">
                <label for="trainer_id">Trainer ID:</label>
                <input type="text" id="trainer_id" name="trainer_id" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="trainer_name">Trainer Name:</label>
                <input type="text" id="trainer_name" name="trainer_name" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="id">ID Document (PDF):</label>
                <div class="custom-file">
                    <input type="file" id="id" name="id" class="custom-file-input" accept="application/pdf" required>
                    <label class="custom-file-label" for="id">Choose file</label>
                </div>
            </div>
            <div class="form-group">
                <label for="license_cert">License Certification (PDF):</label>
                <div class="custom-file">
                    <input type="file" id="license_cert" name="license_cert" class="custom-file-input" accept="application/pdf" required>
                    <label class="custom-file-label" for="license_cert">Choose file</label>
                </div>
            </div>
            <div class="form-group">
                <label for="business_registration_cert">Business Registration Certification (PDF):</label>
                <div class="custom-file">
                    <input type="file" id="business_registration_cert" name="business_registration_cert" class="custom-file-input" accept="application/pdf" required>
                    <label class="custom-file-label" for="business_registration_cert">Choose file</label>
                </div>
            </div>
            <button type="submit" class="btn btn-primary"><i class="fas fa-upload"></i> Submit</button>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
