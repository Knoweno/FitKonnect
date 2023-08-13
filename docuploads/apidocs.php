<!DOCTYPE html>
<html>
<head>
    <title>Trainer Document Upload</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.min.css">
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
    </style>
</head>
<body>
    <div class="container">
        <h2>Trainer Document Upload</h2>
        <form id="uploadForm" enctype="multipart/form-data">
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
                    <label class="custom-file-label" id="id-label" for="id">Choose file</label>
                </div>
            </div>
            <div class="form-group">
                <label for="license_cert">License Certification (PDF):</label>
                <div class="custom-file">
                    <input type="file" id="license_cert" name="license_cert" class="custom-file-input" accept="application/pdf" required>
                    <label class="custom-file-label" id="license_cert-label" for="license_cert">Choose file</label>
                </div>
            </div>
            <div class="form-group">
                <label for="business_registration_cert">Business Registration Certification (PDF):</label>
                <div class="custom-file">
                    <input type="file" id="business_registration_cert" name="business_registration_cert" class="custom-file-input" accept="application/pdf" required>
                    <label class="custom-file-label" id="business_registration_cert-label" for="business_registration_cert">Choose file</label>
                </div>
            </div>
            <button type="submit" class="btn btn-primary"><i class="fas fa-upload"></i> Submit</button>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.all.min.js"></script>
    <script>
        function updateFileName(inputId, fileName) {
            var label = document.getElementById(inputId + '-label');
            label.innerHTML = fileName;
        }

        document.getElementById('id').addEventListener('change', function(event) {
            var fileInput = event.target;
            var fileName = fileInput.files[0].name;
            updateFileName('id', fileName);
        });

        document.getElementById('license_cert').addEventListener('change', function(event) {
            var fileInput = event.target;
            var fileName = fileInput.files[0].name;
            updateFileName('license_cert', fileName);
        });

        document.getElementById('business_registration_cert').addEventListener('change', function(event) {
            var fileInput = event.target;
            var fileName = fileInput.files[0].name;
            updateFileName('business_registration_cert', fileName);
        });

        document.getElementById("uploadForm").addEventListener("submit", function(event) {
            event.preventDefault();

            var formData = new FormData(this);

            fetch("http://localhost/Projects/FitKonnect/docuploads/apidocsController.php", {
                method: "POST",
                body: formData,
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    Swal.fire({
                        icon: "success",
                        title: "Success",
                        timer: 5000, 
                        showConfirmButton: true, 
                        text: data.success,
                    }).then(() => {
                    clearFormFields();
                });
                } else if (data.error) {
                    Swal.fire({
                        icon: "error",
                        title: "Error",
                        timer: 5000, 
                        showConfirmButton: true, 
                        text: data.error,
                    }).then(() => {
                    clearFormFields();
                });
                }
            })
            .catch(error => {
                Swal.fire({
                    icon: "error",
                    title: "Error",
                    timer: 5000, 
                    showConfirmButton: true, 
                    text: "An error occurred while processing your request. Please refresh the page.",
                }).then(() => {
                    clearFormFields();
                });
            });
        });
        function clearFormFields() {
        document.getElementById("trainer_id").value = "";
        document.getElementById("trainer_name").value = "";
        document.getElementById("id").value = "";
        document.getElementById("id-label").innerHTML = "Choose file";
        document.getElementById("license_cert").value = "";
        document.getElementById("license_cert-label").innerHTML = "Choose file";
        document.getElementById("business_registration_cert").value = "";
        document.getElementById("business_registration_cert-label").innerHTML = "Choose file";
    }
    </script>
    
</body>
</html>
