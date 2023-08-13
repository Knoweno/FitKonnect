<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
    <title>Update Trainer Information</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2>Update Trainer Information</h2>
        <button id="openFormBtn" class="btn btn-primary">Click Me</button>
    </div>

    <!-- Modal for the form -->
    <div class="modal fade" id="updateFormModal" tabindex="-1" role="dialog" aria-labelledby="updateFormModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="updateFormModalLabel">Update Trainer Information</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="updateForm">
                        <div class="form-group">
                            <label for="firstName">First Name:</label>
                            <input type="text" id="firstName" name="firstName" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="lastName">Last Name:</label>
                            <input type="text" id="lastName" name="lastName" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="gender">Gender:</label>
                            <select id="gender" name="gender" class="form-control" required>
                                <option value="">Select Your Gender</option>
                                <!-- Populate options from tbleducationlevel -->
                                <?php
                                include '../config/config.php';
                                $query = "SELECT * FROM tblgender";
                                $result = mysqli_query($conn, $query);

                                while ($row = mysqli_fetch_assoc($result)) {
                                    echo '<option value="' . $row['id'] . '">' . $row['genderName'] . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="phoneNumber">Phone Number:</label>
                            <input type="text" id="phoneNumber" name="phoneNumber" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="educationLevel">Education Level:</label>
                            <select id="educationLevel" name="educationLevel" class="form-control" required>
                                <option value="">Select Education Level</option>
                                <!-- Populate options from tbleducationlevel -->
                                <?php
                                include '../config/config.php';
                                $query = "SELECT * FROM tbleducationlevel";
                                $result = mysqli_query($conn, $query);

                                while ($row = mysqli_fetch_assoc($result)) {
                                    echo '<option value="' . $row['id'] . '">' . $row['educationLevel'] . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="dateOfBirth">Date of Birth:</label>
                            <input type="date" id="dateOfBirth" name="dateOfBirth" class="form-control" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.all.min.js"></script>
    <script>
        document.getElementById('openFormBtn').addEventListener('click', function() {
            $('#updateFormModal').modal('show');
        });

        document.getElementById('updateForm').addEventListener('submit', function(event) {
            event.preventDefault();

            const formData = new FormData(this);

            fetch('http://localhost/Projects/FitKonnect/trainer/registerme.php', {
                method: 'PUT',
                body: JSON.stringify(Object.fromEntries(formData.entries())),
                headers: {
                    'Content-Type': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        timer: 5000, // 5 seconds
                        showConfirmButton: true,
                        text: data.success
                    }).then(() => {
                        location.reload();
                    });
                } else if (data.error) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        timer: 5000, // 5 seconds
                        showConfirmButton: true,
                        text: data.error
                    });
                }
            })
            .catch(error => {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    timer: 5000, // 5 seconds
                    showConfirmButton: true,
                    text: 'An error occurred while processing your request.'
                });
            });
        });
    </script>
</body>
</html>
