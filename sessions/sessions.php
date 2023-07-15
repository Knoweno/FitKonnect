<style>
     .alert-message {
            position: fixed;
            top: 10px;
            left: 50%;
            transform: translateX(-50%);
            z-index: 9999;
        }
       
</style>
<?php if (isset($_SESSION['success_message'])) { ?>
        <div class="alert alert-success alert-message" role="alert">
            <?php echo $_SESSION['success_message']; ?>
        </div>
    <?php } elseif (isset($_SESSION['error_message'])) { ?>
        <div class="alert alert-danger alert-message" role="alert">
            <?php echo $_SESSION['error_message']; ?>
        </div>
    <?php } ?>
    <script>
        function updateFileName(inputId) {
            var fileInput = document.getElementById(inputId);
            var label = document.getElementById(inputId + '-label');
            var fileName = fileInput.files[0].name;
            label.innerHTML = fileName;
        }

        // Auto-hide alert messages after 5 seconds
        setTimeout(function() {
            var alertMessages = document.querySelectorAll('.alert-message');
            alertMessages.forEach(function(alert) {
                alert.remove();
            });
        }, 5000);
    </script>