<?php
session_start();

// Function to check if a file has a PDF extension
function isPDF($file)
{
    $extension = pathinfo($file['name'], PATHINFO_EXTENSION);
    return strtolower($extension) == 'pdf';
}

// Function to move uploaded files to a designated folder
function moveUploadedFile($file, $destination)
{
    $filename = $file['name'];
    $targetPath = $destination . $filename;
    move_uploaded_file($file['tmp_name'], $targetPath);
    return $filename;
}

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if it's the first page or the second page
    if (isset($_POST['page1_submit'])) {
        // Retrieve form data from the first page
        $firstName = $_POST['first_name'];
        $lastName = $_POST['last_name'];
        $gender = $_POST['gender'];
        $phone = $_POST['phone'];
        $dateOfBirth = $_POST['date_of_birth'];
        $educationLevel = $_POST['education_level'];

        // Perform form validation
        $errors = [];
        if (empty($firstName)) {
            $errors['first_name'] = 'First Name is required.';
        }
        if (empty($lastName)) {
            $errors['last_name'] = 'Last Name is required.';
        }
        if (empty($gender)) {
            $errors['gender'] = 'Gender is required.';
        }
        if (empty($email)) {
            $errors['email'] = 'Email Address is required.';
        }
        if (empty($phone)) {
            $errors['phone'] = 'Phone Number is required.';
        }
        if (empty($dateOfBirth)) {
            $errors['date_of_birth'] = 'Date of Birth is required.';
        } else {
            $minAge = 16;
            $now = new DateTime();
            $dob = new DateTime($dateOfBirth);
            $age = $dob->diff($now)->y;
            if ($age < $minAge) {
                $errors['date_of_birth'] = 'You must be 16 years or older to register as a trainer.';
            }
        }
        if (empty($educationLevel)) {
            $errors['education_level'] = 'Education Level is required.';
        }

        // Store the first-page data in the session if there are no errors
        if (empty($errors)) {
            $_SESSION['first_page_data'] = [
                'first_name' => $firstName,
                'last_name' => $lastName,
                'gender' => $gender,
                'phone' => $phone,
                'date_of_birth' => $dateOfBirth,
                'education_level' => $educationLevel,
            ];
            // Redirect to the second page of the form
            header('Location: trainer_registration.php?page=2');
            exit();
        }
    } elseif (isset($_POST['page2_submit'])) {
        // Retrieve form data from the second page
        $careerSummary = $_POST['career_summary'];
        $idNumber = $_POST['id_number'];

        // Process uploaded documents from the second page
        $licenseCert = $_FILES['license_cert'];
        $idProof = $_FILES['id_proof'];

        // Set the destination folder for document uploads
        $uploadDir = 'uploads/';

        // Validate and move the license certification file
        if (isPDF($licenseCert)) {
            $licenseCertFilename = moveUploadedFile($licenseCert, $uploadDir);
            // TODO: Save the license certification filename to the database or perform further processing
        }

        
        // Validate and move the ID proof file
        if (isPDF($idProof)) {
            $idProofFilename = moveUploadedFile($idProof, $uploadDir);
            // TODO: Save the ID proof filename to the database or perform further processing
        }

        // TODO: Perform additional processing or save the second-page data as needed

        // Clear the stored first-page data from the session
        unset($_SESSION['first_page_data']);

        // Redirect to a success page or display a success message
        header('Location: success.php');
        exit();
    }
}

// Calculate the current page number
$current_page = isset($_GET['page']) ? (int)$_GET['page'] : 1;

// Retrieve the first-page data from the session (if available)
$firstPageData = $_SESSION['first_page_data'] ?? [];

?>