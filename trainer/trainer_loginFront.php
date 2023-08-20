<!DOCTYPE html>
<html>
<head>
    <title>Login Page</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <h1 class="text-center">Login</h1>
                <form id="loginForm">
                    <div class="form-group">
                        <label for="username">Username:</label>
                        <input type="text" class="form-control" id="username" name="username" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password:</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Login</button>
                </form>
            </div>
        </div>
    </div>

    <script>
        const loginForm = document.getElementById('loginForm');

        loginForm.addEventListener('submit', async (e) => {
            e.preventDefault();

            const username = document.getElementById('username').value;
            const password = document.getElementById('password').value;

            const requestData = {
            username: username,
            password: password
        };

            try {
                const response = await fetch('http://localhost/Projects/FitKonnect/trainer/trainer_loginAPI.php', {
                    method: 'POST',
                    body: JSON.stringify(requestData)
                });

                const responseData = await response.json();
                if (response.ok) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Login Successful',
                        showConfirmButton: true,
                        timer: 1000
                    }).then(() => {
                        window.location.href = 'regis.php';
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Login Failed',
                        showConfirmButton: true,
                        timer: 3000,
                        text: responseData.error
                    });
                }
            } catch (error) {
                Swal.fire({
                    icon: 'error',
                    title: 'An Error Occurred',
                    showConfirmButton: true,
                     timer: 3000,
                    text: 'Please try again later.'
                });
                console.error(error);
            }
        });
    </script>
</body>
</html>
