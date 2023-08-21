<!DOCTYPE html>
<html>
<head>
    <title>User Data</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Font Awesome CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.min.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.all.min.js"></script>

    <script>
    function fetchUserData() {
        fetch("http://fit.eastus.cloudapp.azure.com/FitKonnect/api/client.php", {
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
                            <a href="#" class="btn btn-sm btn-info" onclick="editClient(${user.id});"><i class="fas fa-edit"></i> Edit</a>
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

    // Function to edit a client record
    function editClient() {
        //fetch(`http://localhost/Projects/FitKonnect/api/client.php?id=${clientId}`
        fetch(`http://fit.eastus.cloudapp.azure.com/FitKonnect/api/client.php`, {
            method: "PUT"
        })
        .then(response => response.json())
        .then(data => {
            if (data.length > 0) {
                const client = data[0];
                document.getElementById("editId").value = client.id;
                document.getElementById("editFirstName").value = client.firstName;
                document.getElementById("editLastName").value = client.lastName;
                document.getElementById("editPhoneNumber").value = client.phoneNumber;
                document.getElementById("editEmail").value = client.email;
                document.getElementById("editDateOfBirth").value = client.dateOfBirth;
                // Show the edit modal
                $('#editModal').modal('show');
            }
        })
        .catch(error => {
            console.error("An error occurred:", error);
        });
    }
    </script>

    <!-- Edit Modal -->
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit Client</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Edit form fields -->
                    <input type="hidden" id="editId">
                    <div class="form-group">
                        <label for="editFirstName">First Name</label>
                        <input type="text" class="form-control" id="editFirstName">
                    </div>
                    <div class="form-group">
                        <label for="editLastName">Last Name</label>
                        <input type="text" class="form-control" id="editLastName">
                    </div>
                    <div class="form-group">
                        <label for="editPhoneNumber">Phone Number</label>
                        <input type="text" class="form-control" id="editPhoneNumber">
                    </div>
                    <div class="form-group">
                        <label for="editEmail">Email</label>
                        <input type="email" class="form-control" id="editEmail">
                    </div>
                    <div class="form-group">
                        <label for="editDateOfBirth">Date of Birth</label>
                        <input type="date" class="form-control" id="editDateOfBirth">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="saveEditedClient()">Save changes</button>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
