<?php  session_start(); ?>
<!DOCTYPE html>
<html>
<head>
    <title>Add Sports Information</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2>Add Sports Information</h2>
        <form id="addSportsForm">
            <div class="form-group">
                <label for="sportsName">Sports Name:</label>
                <input type="text" id="sportsName" name="sportsName" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="sportDescription">Sport Description:</label>
                <textarea id="sportDescription" name="sportDescription" class="form-control" rows="5" maxlength="500" required></textarea>
                <small class="form-text text-muted">
                    Characters remaining: <span id="charCount">500</span>
                </small>
            </div>
            <div class="form-group">
                <label for="price">Price:</label>
                <input type="number" id="price" name="price" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Add Sports</button>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.all.min.js"></script>
    <script>
        document.getElementById('sportDescription').addEventListener('input', function() {
            const charCountElement = document.getElementById('charCount');
            const remainingChars = 500 - this.value.length;
            charCountElement.textContent = remainingChars;
        });

        document.getElementById('addSportsForm').addEventListener('submit', function(event) {
            event.preventDefault();

            const formData = new FormData(this);
            const email = 'obiso@obysoft.com'; // Replace with the user's email or retrieve from session
              
            fetch('http://localhost/Projects/FitKonnect/sports/addsports.php', {
                method: 'POST',
                body: JSON.stringify({ ...Object.fromEntries(formData.entries()), email }),
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
                        timer: 5000,
                        showConfirmButton: true,
                        text: data.success
                    });
                } else if (data.error) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        timer: 5000,
                        showConfirmButton: true,
                        text: data.error
                    });
                }
            })
            .catch(error => {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    timer: 5000,
                    showConfirmButton: true,
                    text: 'An error occurred while processing your request.'
                });
            });
        });
    </script>
</body>
</html>
