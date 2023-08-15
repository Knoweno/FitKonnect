<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
    <title>Add Sports Information</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2>Add Sports Information</h2>
        <button class="btn btn-primary" data-toggle="modal" data-target="#addSportsModal"><i class="fas fa-plus"></i> Add Sports</button>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="addSportsModal" tabindex="-1" role="dialog" aria-labelledby="addSportsModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addSportsModalLabel">Add Sports Information</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
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
                        <button type="submit" class="btn btn-primary"><i class="fas fa-plus"></i> Add Sport</button>
                    </form>
                </div>
            </div>
        </div>
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
            //const email = 'obiso@obysoft.com'; 
                 // Retrieve email from active session
        const email = "<?php echo isset($_SESSION['email']) ? $_SESSION['email'] : ''; ?>";

// Check if email is available in the session
if (!email) {
    Swal.fire({
        icon: 'error',
        title: 'Error',
        timer: 5000,
        showConfirmButton: true,
        text: 'Email is not available in the session.'
    });
    return;
}

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
                    // Clear form fields after successful submission
                    this.reset();
                    document.getElementById('charCount').textContent = '500';
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
