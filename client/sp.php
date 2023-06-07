<!DOCTYPE html>
<html>
<head>
    <title>Sports Selection</title>
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .active {
            background-color: #08a0e9 !important;
        }
    </style>
</head>
<body>
    <?php
    // Include the database connection file
    require_once 'config.php';

    // Query the availableSports table
    $query = "SELECT * FROM availableSports";
    $result = mysqli_query($conn, $query);

    // Check if there are any results
    if (mysqli_num_rows($result) > 0) {
        // Display the results as clickable boxes
        $count = 0;
        echo '<div class="container mt-3">';
        echo '<div class="row">';

        while ($row = mysqli_fetch_assoc($result)) {
            $sportsCode = $row['sportsCode'];
            $sportsName = $row['sportsName'];

            // Display the clickable box
            echo '<div class="col-sm-4">';
            echo '<div id="sportsBox-' . $count . '" class="card" style="border: 3px solid green; border-radius: 5px; cursor: pointer;" onclick="selectSports(' . $count . ', \'' . $sportsCode . '\')">';
            echo '<h4>' . $sportsName . '</h4>';
            echo '</div>';
            echo '</div>';

            $count++;
        }

        echo '</div>';
        echo '</div>';

        // JavaScript code to handle box selection
        echo '<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>';
        echo '<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>';
        echo '<script>
                function selectSports(boxId, sportsCode) {
                    var boxes = document.getElementsByClassName("card");
                    var selectedBox = document.getElementById("sportsBox-" + boxId);

                    // Remove active class from all boxes
                    for (var i = 0; i < boxes.length; i++) {
                        boxes[i].classList.remove("active");
                    }

                    // Add active class to the selected box
                    selectedBox.classList.add("active");

                    // Update the session variable with the selected sports code
                    updateSelectedSportsCode(sportsCode);
                }

                function updateSelectedSportsCode(sportsCode) {
                    // Send an AJAX request to update the session variable
                    $.ajax({
                        url: "update_sports_code.php",
                        type: "POST",
                        data: { sportsCode: sportsCode },
                        success: function(response) {
                            console.log("Selected sports code updated");
                        }
                    });
                }
              </script>';
    } else {
        echo 'No sports available';
    }

    // Close the database connection
    mysqli_close($conn);
    ?>

</body>
</html>
