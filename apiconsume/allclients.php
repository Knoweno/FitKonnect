<!DOCTYPE html>
<html>
<head>
    <title>User Data</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.min.css">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center">Clients</h1>
        <table class="table mt-4">
            <thead>
                <tr>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Phone Number</th>
                    <th>Email</th>
                    <th>Date of Birth</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody id="userData">
            </tbody>
        </table>
    </div>
    
    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <!-- SweetAlert2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.all.min.js"></script>
    <script>
    function fetchUserData() {
        fetch("http://localhost/Projects/FitKonnect/api/client.php", {
            method: "GET"
        })
        .then(response => response.json())
        .then(data => {
            const userData = document.getElementById("userData");
            userData.innerHTML = ""; // Clear previous data
            if (data.length > 0) {
                data.forEach(user => {
                    const row = document.createElement("tr");
                    row.innerHTML = `
                        <td>${user.firstName}</td>
                        <td>${user.lastName}</td>
                        <td>${user.phoneNumber}</td>
                        <td>${user.email}</td>
                        <td>${user.dateOfBirth}</td>
                        <td>
                            <a href="#" class="btn btn-sm btn-info"><i class="fas fa-edit"></i> Edit</a>
                            <a href="#" class="btn btn-sm btn-danger" onclick="deleteClient(${user.id});"><i class="fas fa-trash"></i> Delete</a>
                        </td>
                    `;
                    userData.appendChild(row);
                });
            } else {
                const row = document.createElement("tr");
                row.innerHTML = '<td colspan="6">No user data available</td>';
                userData.appendChild(row);
            }
        })
        .catch(error => {
            console.error("An error occurred:", error);
        });
    }
    
    // Fetch data every 1 second
    fetchUserData();
    setInterval(fetchUserData, 1000); // Refresh every 1 second


    // Function to delete a client record
    function deleteClient(clientId) {
        Swal.fire({
            title: 'Confirmation',
            text: 'You want to delete this client from the records. Do you want to proceed?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'No, cancel',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                fetch('http://localhost/Projects/FitKonnect/api/client.php', {
                    method: 'DELETE',
                    body: JSON.stringify({ clientId }),
                    headers: {
                        'Content-Type': 'application/json'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        Swal.fire({
                            title: 'Success',
                            text: data.success,
                            icon: 'success',
                            timer: 3000,
                            showConfirmButton: false
                        });
                        fetchUserData(); // Refresh user data after deletion
                    } else if (data.error) {
                        Swal.fire({
                            title: 'Error',
                            text: data.error,
                            icon: 'error',
                            timer: 3000,
                            showConfirmButton: false
                        });
                    }
                })
                .catch(error => {
                    console.error('An error occurred:', error);
                });
            }
        });
    }
    </script>
</body>
</html>
