<?php 
  // Include the database connection file
 require_once 'config.php';

  // Start the session
  session_start();


?>

<!DOCTYPE html>
<html>
<head>
    <title>Sports Selection</title>
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href=" http://localhost/fitkonnect/css/style.css">
    <style>
        .box {
            border: 1px solid #000000;
            border-radius: 5px;
            cursor: pointer;
            padding:10px;
            margin-bottom: 20px;

        }

        .box.active {
            background-color: #08a0e9;
        }
        body{
            background-color: aliceblue;
        }
        .navbar{
            padding: 10px;
        }
        .selection_activity{
            margin-top: 10%;
        }
    </style>
</head>
<body>

<?php include 'login-nav-bar.php' ?>

    <?php 

    if(isset($_SESSION['email'])){
        echo '<div class="selection_activity">';
        echo '<h5 class="text text-center"> Hello: '.$_SESSION['email'].', we are happy to have you. Enjoy! </h5>';
        echo '</div>';

        //echo "We are happy to have you ".$_SESSION['email']. ". Enjoy!";
    }
    else{
        echo '<div>';
        echo '<h4 class="text text-center"> You must be logged in </h4>';
        echo '</div>';
        header("Location: login.php");
        exit;
    }
    ?>
    <div>
        <h2 class="text text-center">Please select a sport you want to be trained</h2>
    </div>
    <?php
  

    // Query the availableSports table
    $query = "SELECT * FROM availableSports";
    $result = mysqli_query($conn, $query);

    // Check if there are any results
    if (mysqli_num_rows($result) > 0) {
        // Display the results as clickable boxes
        echo '<div class="container mt-3">';
        echo '<div class="row">';

        while ($row = mysqli_fetch_assoc($result)) {
            $sportsCode = $row['sportsCode'];
            $sportsName = $row['sportsName'];

            // Check if the current box is selected
            $isSelected = isset($_SESSION['selectedSportsCode']) && $_SESSION['selectedSportsCode'] === $sportsCode;

            // Set the box class based on the selection
            $boxClass = 'box';
            if ($isSelected) {
                $boxClass .= ' active';
            }

            // Display the clickable box
            echo '<div class="col-sm-4">';
            echo '<div class="' . $boxClass . '" onclick="selectSports(\'' . $sportsCode . '\')">';
            echo '<h4>' . $sportsName . '</h4>';
            echo '</div>';
            echo '</div>';
        }

        echo '</div>';
        echo '</div>';

        // Display the "Submit" button
        echo '<div class="container mt-3">';
        echo '<button class="btn btn-primary" onclick="showResults()">Submit</button>';
        echo '</div>';

        // JavaScript code to handle box selection and show results
        echo '<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>';
        echo '<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>';
        echo '<script>
                function selectSports(sportsCode) {
                    // Remove active class from all boxes
                    var boxes = document.getElementsByClassName("box");
                    for (var i = 0; i < boxes.length; i++) {
                        boxes[i].classList.remove("active");
                    }

                    // Add active class to the selected box
                    event.target.classList.add("active");

                    // Store the selected sports code in the session
                    sessionStorage.setItem("selectedSportsCode", sportsCode);
                }

                function showResults() {
                    // Retrieve the selected sports code from the session
                    var selectedSportsCode = sessionStorage.getItem("selectedSportsCode");

                    if (selectedSportsCode) {
                        // Send an AJAX request to get the sports details
                        var xhttp = new XMLHttpRequest();
                        xhttp.onreadystatechange = function() {
                            if (this.readyState == 4 && this.status == 200) {
                                var result = JSON.parse(this.responseText);
                                displayResults(result);
                            }
                        };
                        xhttp.open("GET", "get_sports_details.php?sportsCode=" + selectedSportsCode, true);
                        xhttp.send();
                    }
                }

                function displayResults(result) {
                    // Check if there is an active selection
                    var selectedSportsCode = sessionStorage.getItem("selectedSportsCode");
                    if (!selectedSportsCode) {
                        // Create the modal content for no active selection
                        var modalContent = "<div class=\'modal-dialog\' role=\'document\'>";
                        modalContent += "<div class=\'modal-content\'>";
                        modalContent += "<div class=\'modal-header\'>";
                        modalContent += "<h5 class=\'modal-title\'>No Active Selection</h5>";
                        modalContent += "<button type=\'button\' class=\'close\' data-dismiss=\'modal\' aria-label=\'Close\'>";
                        modalContent += "<span aria-hidden=\'true\'>&times;</span>";
                        modalContent += "</button>";
                        modalContent += "</div>";
                        modalContent += "<div class=\'modal-body\'>";
                        modalContent += "<p>No active selected box. Please make a selection.</p>";
                        modalContent += "</div>";
                        modalContent += "</div>";
                        modalContent += "</div>";
                
                        // Create the modal and add it to the document
                        var modal = document.createElement("div");
                        modal.className = "modal";
                        modal.tabIndex = "-1";
                        modal.role = "dialog";
                        modal.innerHTML = modalContent;
                        document.body.appendChild(modal);
                
                        var boxes = document.getElementsByClassName("box");
                        for (var i = 0; i < boxes.length; i++) {
                          if (boxes[i].classList.contains("active")) {
                            boxes[i].classList.remove("active");
                            boxes[i].style.backgroundColor = "red";
                          }
                        }
                        
                        // Show the modal
                        $(".modal").modal("show");
                    } else {

                    var modalContent = "<div class=\'modal-dialog\' role=\'document\'>";

                    var modalContent = "<div class=\'modal-dialog\' role=\'document\'>";
                    modalContent += "<div class=\'modal-content\'>";
                    modalContent += "<div class=\'modal-header\'>";
                    modalContent += "<h5 class=\'modal-title\'>Selected Sports</h5>";
                    modalContent += "<button type=\'button\' class=\'close\' data-dismiss=\'modal\' aria-label=\'Close\'>";
                    modalContent += "<span aria-hidden=\'true\'>&times;</span>";
                    modalContent += "</button>";
                    modalContent += "</div>";
                    modalContent += "<div class=\'modal-body\'>";
                    modalContent += "<p><strong>Sports Code:</strong> " + result.sportsCode + "</p>";
                    modalContent += "<p><strong>Sports Name:</strong> " + result.sportsName + "</p>";
                    modalContent += "</div>";
                    modalContent += "</div>";
                    modalContent += "</div>";

                    // Create the modal
                    var modal = document.createElement("div");
                    modal.className = "modal";
                    modal.tabIndex = "-1";
                    modal.role = "dialog";
                    modal.innerHTML = modalContent;

                    // Add the modal to the document
                    document.body.appendChild(modal);

                    // Show the modal
                    $(".modal").modal("show");




                    // Create the modal
    var modal = document.createElement("div");
    modal.className = "modal";
    modal.tabIndex = "-1";
    modal.role = "dialog";
    modal.innerHTML = modalContent;

    // Add the modal to the document
    document.body.appendChild(modal);

  

    $(".modal").modal("show");

    // Hide the modal after 5 seconds
    setTimeout(function() {
        $(".modal").modal("hide");
        $(".modal").remove();

        // Destroy the active session
        sessionStorage.removeItem("selectedSportsCode");
    }, 5000);

    }

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
