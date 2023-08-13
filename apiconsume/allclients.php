<!DOCTYPE html>
<html>
<head>
    <title>User Data</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center">User Data</h1>
        <table class="table mt-4">
            <thead>
                <tr>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Phone Number</th>
                    <th>Email</th>
                    <th>Date of Birth</th>
                </tr>
            </thead>
            <tbody id="userData">
            </tbody>
        </table>
    </div>
    
    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
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
                        `;
                        userData.appendChild(row);
                    });
                } else {
                    const row = document.createElement("tr");
                    row.innerHTML = '<td colspan="5">No user data available</td>';
                    userData.appendChild(row);
                }
            })
            .catch(error => {
                console.error("An error occurred:", error);
            });
        }
        
        // Fetch data every 5 seconds
        fetchUserData();
        setInterval(fetchUserData, 1000); // Refresh every 5 seconds
    </script>
</body>
</html>
