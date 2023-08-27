function showPaymentConfirmation() {
    swal({
        title: `You are about to pay this amount Ksh. ${totalCost}`,
        text: "Do you want to proceed?",
        icon: "info",
        buttons: {
            cancel: "No",
            confirm: "Yes"
        },
    })
    .then((willProceed) => {
        if (willProceed) {
            const payload = {
                "id": "TEST1515111110",
                "currency": "KES",
                "amount": totalCost,
                "description": "Payment description goes here",
                "callback_url": "https://www.myapplication.com/response-page",
                "notification_id": "fe078e53-78da-4a83-aa89-e7ded5c456e6",
                "billing_address": {
                    "email_address": "john.doe@example.com",
                    "phone_number": null,
                    "country_code": "",
                    "first_name": "John",
                    "middle_name": "",
                    "last_name": "Doe",
                    "line_1": "",
                    "line_2": "",
                    "city": "",
                    "state": "",
                    "postal_code": null,
                    "zip_code": null
                }
            };

            // Make a POST request to the Pesapal API
            fetch("https://pay.pesapal.com/v3/api/Transactions/SubmitOrderRequest", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json"
                },
                body: JSON.stringify(payload)
            })
            .then(response => response.json())
            .then(data => {
                // Handle the API response as needed
                console.log("Pesapal API response:", data);

                // Redirect to sportsbooking.php or perform necessary action
                window.location.href = "sportsbooking.php";
            })
            .catch(error => {
                console.error("Error calling Pesapal API:", error);
            });
        }
    });
}
