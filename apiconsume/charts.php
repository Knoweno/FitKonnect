<!DOCTYPE html>
<html>
<head>
    <title>User Analytics</title>
    <!-- Include Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center">User Analytics</h1>
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">User Count by Date (Bar Chart)</h5>
                        <canvas id="barChart" class="chart"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">User Count by Date (Pie Chart)</h5>
                        <canvas id="pieChart" class="chart"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">User Count by Date (Line Chart)</h5>
                        <canvas id="lineChart" class="chart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Function to fetch user data
        function fetchUserData() {
            fetch("http://fit.eastus.cloudapp.azure.com/FitKonnect/api/client.php", {
                method: "GET"
            })
            .then(response => response.json())
            .then(data => {
                // Extract dates and counts for analytics
                const dates = data.map(user => user.dateOfBirth);
                const counts = dates.reduce((acc, date) => {
                    if (acc[date]) {
                        acc[date]++;
                    } else {
                        acc[date] = 1;
                    }
                    return acc;
                }, {});

                // Extract labels and data for charts
                const labels = Object.keys(counts);
                const dataPoints = Object.values(counts);

                // Bar Chart
                new Chart(document.getElementById("barChart"), {
                    type: 'bar',
                    data: {
                        labels: labels,
                        datasets: [{
                            label: 'User Count',
                            data: dataPoints,
                            backgroundColor: 'rgba(54, 162, 235, 0.7)'
                        }]
                    }
                });

                // Pie Chart
                new Chart(document.getElementById("pieChart"), {
                    type: 'pie',
                    data: {
                        labels: labels,
                        datasets: [{
                            data: dataPoints,
                            backgroundColor: [
                                'rgba(255, 99, 132, 0.7)',
                                'rgba(54, 162, 235, 0.7)',
                                'rgba(75, 192, 192, 0.7)',
                                'rgba(255, 206, 86, 0.7)',
                                'rgba(153, 102, 255, 0.7)',
                                'rgba(255, 159, 64, 0.7)'
                            ]
                        }]
                    }
                });

                // Line Chart
                new Chart(document.getElementById("lineChart"), {
                    type: 'line',
                    data: {
                        labels: labels,
                        datasets: [{
                            label: 'User Count',
                            data: dataPoints,
                            borderColor: 'rgba(75, 192, 192, 1)',
                            fill: false
                        }]
                    }
                });

            })
            .catch(error => {
                console.error("An error occurred:", error);
            });
        }
        
        // Fetch data every second
        fetchUserData();
        setInterval(fetchUserData, 1000); // Refresh every second
    </script>
</body>
</html>
