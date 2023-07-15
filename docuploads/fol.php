<?php
require_once '../links.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['create'])) {
    // Generate a random number as the folder name
    // $folderName = mt_rand();

    // // Create the folder
    // $path = 'http://localhost/Projects/FitKonnect/knowen/' . $folderName;
   
  
    //mkdir("test");
    // $path='localhost/Projects/FitKonnect/knowen/';
    // $permissions =0777;
    // $rec =false;
    // $context=null;
    // //mkdir('/Applications/XAMPP/xamppfiles/htdocs/Projects/FitKonnect/knowen/', 0777, true);
    // mkdir($path,$permissions);
    $uploadPath = '../FitkonnectDocs/trainer_Documents101';
    

    if (!is_dir($uploadPath)) {
        mkdir($uploadPath, 0755, true);
    }
//  if (!is_dir($path)) {
//         if (!mkdir($path, 0777)) {
//             echo "Failed to create the folder.";
//         } else {
//             echo "Folder created successfully!";
//         }
//     } else {
//         echo "Folder already exists.";
//     }


}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Create Folder</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<body>
    <div class="container">
        <h2>Create Folder</h2>
        <form method="POST">
            <button type="submit" class="btn btn-primary" name="create"><i class="fas fa-folder"></i> Create</button>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
