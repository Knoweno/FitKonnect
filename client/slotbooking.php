<!DOCTYPE html>
<html>
<head>
    <title>Appointment Booking</title>
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Include jQuery UI CSS -->
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <!-- Include jQuery and jQuery UI JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
    <style>
        .slot {
            border: 1px solid #000000;
            border-radius: 5px;
            cursor: pointer;
            padding: 10px;
            margin-bottom: 20px;
        }

        .slot.active {
            background-color: #08a0e9;
            color: #ffffff;
        }
    </style>
</head>
<body>
    <div>
        <h2 class="text text-center">Select Appointment Slots</h2>
    </div>
    <div class="container mt-3">
        <div class="row">
            <div class="col-sm-12">
                <label for="datepicker">Pick a Date:</label>
                <input type="text" id="datepicker" name="datepicker" class="form-control">
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-sm-12">
                <h4>Select Slots:</h4>
                <?php
                // Display the available slots
                for ($i = 9; $i <= 14; $i++) {
                    $slot = $i . ':00:00';
                    echo '<div class="slot" onclick="toggleSlot(this)">';
                    echo '<h4>' . $slot . '</h4>';
                    echo '<input type="hidden" name="slots[]" value="' . $slot . '">';
                    echo '</div>';
                }
                ?>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-sm-12">
                <form method="POST">
                    <button class="btn btn-primary" type="submit">Book Appointment</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Initialize the Datepicker -->
    <script>
        $(document).ready(function() {
            // Initialize the datepicker
            $('#datepicker').datepicker({
                dateFormat: 'yy-mm-dd',
                onSelect: function(dateText) {
                    // Clear the active slots when a new date is selected
                    $('.slot').removeClass('active');
                }
            });
        });

        // Toggle the active class of the slot
        function toggleSlot(slot) {
            slot.classList.toggle('active');
        }
    </script>
</body>
</html>
