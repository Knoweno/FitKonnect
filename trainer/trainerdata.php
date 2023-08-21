<!DOCTYPE html>
<html>
<head>
    <title>Trainers List</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2>Trainers List</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Phone Number</th>
                    <th>Education Level</th>
                    <th>Date of Birth</th>
                    <th>Gender</th>
                    <th>Profile Completion</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody id="trainersTableBody">
                <!-- Data from API will be populated here -->
            </tbody>
        </table>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        // Function to fetch trainers data and populate the table
        function fetchTrainersData() {
            fetch('http://fit.eastus.cloudapp.azure.com/FitKonnect/trainer/gettrainers.php', {
                method: 'GET',
            })
            .then(response => response.json())
            .then(data => {
                const trainersTableBody = document.getElementById('trainersTableBody');
                trainersTableBody.innerHTML = ''; // Clear previous data

                data.forEach(trainer => {
                    const row = document.createElement('tr');
                    row.innerHTML = `
                        <td>${trainer.firstName}</td>
                        <td>${trainer.lastName}</td>
                        <td>${trainer.phoneNumber}</td>
                        <td>${trainer.educationLevel}</td>
                        <td>${trainer.dateOfBirth}</td>
                        <td>${trainer.gender}</td>
                        <td>${trainer.isProfileComplete}</td>
                        <td>
                            <button class="btn btn-sm btn-info">Edit</button>
                            <button class="btn btn-sm btn-danger">Delete</button>
                        </td>
                    `;
                    trainersTableBody.appendChild(row);
                });
            })
            .catch(error => {
                console.error('Error fetching trainers data:', error);
            });
        }

        // Fetch trainers data every second and update the table
        setInterval(fetchTrainersData, 1000);
    </script>
</body>
</html>
