<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
    <title>Trainer Document Upload</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.0/dist/sweetalert2.min.css">
    <style>
        body {
            background-color: #ffffff;
            color: #000000;
        }

        .container {
            margin-top: 100px;
        }

        h2 {
            color: #08a0e9;
        }

        .btn-primary {
            background-color: #08a0e9;
            border-color: #08a0e9;
        }

        .custom-file-label::after {
            background-color: #08a0e9;
            color: #ffffff;
        }

        .alert-message {
            position: fixed;
            top: 10px;
            left: 50%;
            transform: translateX(-50%);
            z-index: 9999;
        }
    </style>
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
                    <input type="file" id="id" name="id" class="custom-file-input" accept="application/pdf" required onchange="updateFileName('id')">
                    <label class="custom-file-label" id="id-label" for="id">Choose file</label>
                </div>
            </div>
            <div class="form-group">
                <label for="license_cert">License Certification (PDF):</label>
                <div class="custom-file">
                    <input type="file" id="license_cert" name="license_cert" class="custom-file-input" accept="application/pdf" required onchange="updateFileName('license_cert')">
                    <label class="custom-file-label" id="license_cert-label" for="license_cert">Choose file</label>
                </div>
            </div>
            <div class="form-group">
                <label for="business_registration_cert">Business Registration Certification (PDF):</label>
                <div class="custom-file">
                    <input type="file" id="business_registration_cert" name="business_registration_cert" class="custom-file-input" accept="application/pdf" required onchange="updateFileName('business_registration_cert')">
                    <label class="custom-file-label" id="business_registration_cert-label" for="business_registration_cert">Choose file</label>
                </div>
            </div>
            <button type="submit" class="btn btn-primary"><i class="fas fa-upload"></i> Submit</button>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.0/dist/sweetalert2.min.js"></script>
    <script>
        function updateFileName(inputId) {
            var fileInput = document.getElementById(inputId);
            var label = document.getElementById(inputId + '-label');
            var fileName = fileInput.files[0].name;
            label.innerHTML = fileName;
        }

        <?php if (isset($_SESSION['success_message'])) { ?>
            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: '<?php echo $_SESSION['success_message']; ?>',
                onClose: function() {
                    hideAlertMessages();
                    <?php unset($_SESSION['success_message']); ?>
                }
            });
        <?php } elseif (isset($_SESSION['error_message'])) { ?>
            Swal.fire({
                icon: 'error',
                title: 'Error!',
                text: '<?php echo $_SESSION['error_message']; ?>',
                onClose: function() {
                    hideAlertMessages();
                    <?php unset($_SESSION['error_message']); ?>
                }
            });
        <?php } ?>

        function hideAlertMessages() {
            Swal.close();
        }

        // Auto-hide alert messages after 5 seconds
        setTimeout(hideAlertMessages, 5000);
    </script>
</body>
</html>
