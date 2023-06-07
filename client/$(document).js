$(document).ready(function() {
    // Retrieve the message parameter from the URL
    const urlParams = new URLSearchParams(window.location.search);
    const message = urlParams.get('message');

    // Display the message on the page
    if (message) {
        $('#message').text(message);
    }
});
