<?php include 'trainer_registrationController.php'; 
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Trainer Registration</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function() {
            // Enable/disable buttons based on form validation
            $('form').on('input', function() {
                var form = $(this);
                var submitBtn = form.find('button[type="submit"]');
                var inputs = form.find('input, textarea, select');
                var isFormValid = true;

                inputs.each(function() {
                    if ($(this).val() === '') {
                        isFormValid = false;
                        return false;  // Exit the loop early
                    }
                });

                submitBtn.prop('disabled', !isFormValid);
            });
        });
    </script>
     <style>
        .pagination-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <?php if ($current_page == 1) { ?>
            <h2>Trainer Registration - Page 1</h2>
            <form method="POST" enctype="multipart/form-data">

          


                <div class="form-group">
                    <label>First Name:</label>
                    <input type="text" name="first_name" class="form-control" value="<?php echo isset($firstPageData['first_name']) ? $firstPageData['first_name'] : ''; ?>" required>
                    <?php if (isset($errors['first_name'])) { ?>
                        <div class="invalid-feedback"><?php echo $errors['first_name']; ?></div>
                    <?php } ?>
                </div>

                <div class="form-group">
                    <label>Last Name:</label>
                    <input type="text" name="last_name" class="form-control" value="<?php echo isset($firstPageData['last_name']) ? $firstPageData['last_name'] : ''; ?>" required>
                    <?php if (isset($errors['last_name'])) { ?>
                        <div class="invalid-feedback"><?php echo $errors['last_name']; ?></div>
                    <?php } ?>
                </div>

                <div class="form-group">
                    <label>Gender:</label>
                    <select name="gender" class="form-control" required>
                        <option value="">Select Gender</option>
                        <option value="male" <?php echo (isset($firstPageData['gender']) && $firstPageData['gender'] === 'male') ? 'selected' : ''; ?>>Male</option>
                        <option value="female" <?php echo (isset($firstPageData['gender']) && $firstPageData['gender'] === 'female') ? 'selected' : ''; ?>>Female</option>
                        <option value="transgender" <?php echo (isset($firstPageData['gender']) && $firstPageData['gender'] === 'transgender') ? 'selected' : ''; ?>>Transgender</option>
                    </select>
                    <?php if (isset($errors['gender'])) { ?>
                        <div class="invalid-feedback"><?php echo $errors['gender']; ?></div>
                    <?php } ?>
                </div>

                <div class="form-group">
                    <label>Phone Number:</label>
                    <input type="tel" name="phone" class="form-control" value="<?php echo isset($firstPageData['phone']) ? $firstPageData['phone'] : ''; ?>" required>
                    <?php if (isset($errors['phone'])) { ?>
                        <div class="invalid-feedback"><?php echo $errors['phone']; ?></div>
                    <?php } ?>
                </div>

                <div class="form-group">
                    <label>Date of Birth:</label>
                    <input type="date" name="date_of_birth" class="form-control" value="<?php echo isset($firstPageData['date_of_birth']) ? $firstPageData['date_of_birth'] : ''; ?>" required>
                    <?php if (isset($errors['date_of_birth'])) { ?>
                        <div class="invalid-feedback"><?php echo $errors['date_of_birth']; ?></div>
                    <?php } ?>
                </div>

                <div class="form-group">
                    <label>What is your highest level of education?</label>
                    <select name="education_level" class="form-control" required>
                        <option value="">Select Education Level</option>
                        <option value="Primary school" <?php echo (isset($firstPageData['education_level']) && $firstPageData['education_level'] === 'Primary school') ? 'selected' : ''; ?>>Primary school</option>
                        <option value="Secondary school" <?php echo (isset($firstPageData['education_level']) && $firstPageData['education_level'] === 'Secondary school') ? 'selected' : ''; ?>>Secondary school</option>
                        <option value="Artisan" <?php echo (isset($firstPageData['education_level']) && $firstPageData['education_level'] === 'Artisan') ? 'selected' : ''; ?>>Artisan</option>
                        <option value="College Certificate" <?php echo (isset($firstPageData['education_level']) && $firstPageData['education_level'] === 'College Certificate') ? 'selected' : ''; ?>>College Certificate</option>
                        <option value="College Diploma" <?php echo (isset($firstPageData['education_level']) && $firstPageData['education_level'] === 'College Diploma') ? 'selected' : ''; ?>>College Diploma</option>
                        <option value="University Student" <?php echo (isset($firstPageData['education_level']) && $firstPageData['education_level'] === 'University Student') ? 'selected' : ''; ?>>University Student</option>
                        <option value="Bachelor's Degree" <?php echo (isset($firstPageData['education_level']) && $firstPageData['education_level'] === "Bachelor's Degree") ? 'selected' : ''; ?>>Bachelor's Degree</option>
                        <option value="Master" <?php echo (isset($firstPageData['education_level']) && $firstPageData['education_level'] === 'Master') ? 'selected' : ''; ?>>Master</option>
                        <option value="Ph.D." <?php echo (isset($firstPageData['education_level']) && $firstPageData['education_level'] === 'Ph.D.') ? 'selected' : ''; ?>>Ph.D.</option>
                    </select>
                    <?php if (isset($errors['education_level'])) { ?>
                        <div class="invalid-feedback"><?php echo $errors['education_level']; ?></div>
                    <?php } ?>
                </div>

                <button type="submit" name="page1_submit" class="btn btn-primary" <?php echo !empty($errors) ? 'disabled' : ''; ?>>Next</button>
            </form>
        <?php } elseif ($current_page == 2) { ?>
            <h2>Trainer Registration - Page 2</h2>
            <form method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label>Career Summary as a Trainer:</label>
                    <textarea name="career_summary" class="form-control" required><?php echo isset($_POST['career_summary']) ? $_POST['career_summary'] : ''; ?></textarea>
                </div>

                <div class="form-group">
                    <label>ID Number:</label>
                    <input type="text" name="id_number" class="form-control" value="<?php echo isset($_POST['id_number']) ? $_POST['id_number'] : ''; ?>" required>
                </div>

                <div class="form-group">
                    <label>License Certification (PDF):</label>
                    <input type="file" name="license_cert" class="form-control-file" accept=".pdf" required>
                </div>

                <div class="form-group">
                    <label>ID Proof (PDF):</label>
                    <input type="file" name="id_proof" class="form-control-file" accept=".pdf" required>
                </div>

                <button type="submit" name="page2_submit" class="btn btn-primary" <?php echo !empty($errors) ? 'disabled' : ''; ?>>Submit</button>
            </form>
        <?php } ?>
        
        <!-- Pagination buttons -->
        <div class="pagination-container">
            <?php if ($current_page > 1) { ?>
                <a href="index.php?page=<?php echo $current_page - 1; ?>" class="btn btn-secondary">Previous</a>
            <?php } ?>

            <span class="mx-3">Page <?php echo $current_page; ?> of 2</span>

            
        </div>
    </div>
    <script>
        $(document).ready(function() {
          

            // Hide the message modal after 5 seconds
            setTimeout(function() {
                $('#errorMessage').fadeOut('slow');
            }, 5000);
        });
    </script>
</body>
</html>
