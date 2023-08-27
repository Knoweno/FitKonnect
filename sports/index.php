<!DOCTYPE html>
<html>
<head>
    <title>Sports Shop</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://unpkg.com/sweetalert/dist/sweetalert.css">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .sport-box {
            background-color: #08a0e9;
            color: white;
            padding: 20px;
            margin: 10px;
        }
        .cart-list {
            list-style-type: none;
            padding-left: 0;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand navbar-dark bg-dark">
        <a class="navbar-brand" href="#">Sports Shop</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="#">View Cart</a>
                </li>
            </ul>
            <form class="form-inline">
                <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" id="searchInput">
                <button class="btn btn-outline-success my-2 my-sm-0" type="button" onclick="searchSports()">Search</button>
            </form>
        </div>
    </nav>

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <h2 class="text-center">Available Sports</h2>
            </div>
        </div>
        <div class="row" id="sportsContainer">
            <!-- Sports data will be populated here -->
        </div>
    </div>
    <!-- <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <h2 class="text-center">Cart</h2>
                <ul class="cart-list" id="cartList">
                   
                </ul>
            </div>
        </div>
    </div> -->
    <div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            <h2 class="text-center">Cart</h2>
            <ul class="cart-list" id="cartList">
                <!-- Cart items will be populated here -->
            </ul>
            <p>Total: Ksh. <span id="totalCost">0</span></p>
            <button class="btn btn-primary" id="payButton" onclick="showPaymentConfirmation()" disabled>Pay</button>
        </div>
    </div>
</div>

    <!-- <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <button class="btn btn-primary" id="payButton" onclick="showPaymentConfirmation()" disabled>Pay</button>
            </div>
        </div>
    </div> -->

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.7/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script>
        const sportsContainer = document.getElementById('sportsContainer');
        const cartList = document.getElementById('cartList');
        const searchInput = document.getElementById('searchInput');
        const payButton = document.getElementById('payButton');
        let totalCost = 0;

        // Fetch data from the API
        fetch('http://fit.eastus.cloudapp.azure.com/FitKonnect/sports/getSports.php')
            .then(response => response.json())
            .then(data => {
                let sportsData = data;

                function renderSports(data) {
                    sportsContainer.innerHTML = '';
                    data.forEach(sport => {
                        const sportBox = document.createElement('div');
                        sportBox.className = 'col-md-4';
                        sportBox.innerHTML = `
                            <div class="sport-box">
                                <h4>${sport.sportsName}</h4>
                                <p>${sport.sportDescription}</p>
                                <p>Price: $${sport.Price}</p>
                                <button class="btn btn-primary" id="addBtn_${sport.sportsName}" onclick="addToCart('${sport.sportsName}', ${sport.Price})">Add to Cart</button>
                                <button class="btn btn-danger" id="removeBtn_${sport.sportsName}" onclick="removeFromCart('${sport.sportsName}')">Remove</button>
                            </div>
                        `;
                        sportsContainer.appendChild(sportBox);
                    });
                }

                // Initial rendering
                renderSports(sportsData);

                searchInput.addEventListener('input', searchSports);
            })
            .catch(error => {
                console.error('Error fetching data:', error);
            });

        const cartItems = [];

        function addToCart(sportsName, price) {
            const addBtn = document.getElementById(`addBtn_${sportsName}`);
            addBtn.disabled = true;
            const removeBtn = document.getElementById(`removeBtn_${sportsName}`);
            removeBtn.disabled = false;
            cartItems.push({ sportsName, price });
            updateCartList();
        }

        function removeFromCart(sportsName) {
            const index = cartItems.findIndex(item => item.sportsName === sportsName);
            if (index !== -1) {
                cartItems.splice(index, 1);
                const addBtn = document.getElementById(`addBtn_${sportsName}`);
                addBtn.disabled = false;
                const removeBtn = document.getElementById(`removeBtn_${sportsName}`);
                removeBtn.disabled = true;
                updateCartList();
            }
        }

        // function updateCartList() {
        //     cartList.innerHTML = '';

        //     totalCost = 0;
        //     cartItems.forEach(item => {
        //         const listItem = document.createElement('li');
        //         listItem.textContent = `${item.sportsName} - $${item.price}`;
        //         cartList.appendChild(listItem);
        //         totalCost += item.price;
        //     });

        //     payButton.disabled = totalCost === 0;
        // }
        function updateCartList() {
        cartList.innerHTML = '';

        totalCost = 0;
        cartItems.forEach(item => {
            const listItem = document.createElement('li');
            listItem.textContent = `${item.sportsName} - $${item.price}`;
            cartList.appendChild(listItem);
            totalCost += item.price;
        });

        const totalCostElement = document.getElementById('totalCost');
        totalCostElement.textContent = totalCost;
        payButton.disabled = totalCost === 0;
    }


//         function showPaymentConfirmation() {
//             const payload = {
//             "id": "TEST1515111110",
//             "currency": "KES",
//             "amount": totalCost,
//             "description": "Payment description goes here",
//             "callback_url": "https://www.myapplication.com/response-page",
//             "notification_id": "fe078e53-78da-4a83-aa89-e7ded5c456e6",
//             "billing_address": {
//                 "email_address": "john.doe@example.com",
//                 "phone_number": null,
//                 "country_code": "",
//                 "first_name": "John",
//                 "middle_name": "",
//                 "last_name": "Doe",
//                 "line_1": "",
//                 "line_2": "",
//                 "city": "",
//                 "state": "",
//                 "postal_code": null,
//                 "zip_code": null
//             }
//         };



//   // Make a POST request to the Pesapal API
//   fetch("https://pay.pesapal.com/v3/api/Transactions/SubmitOrderRequest", {
//                 method: "POST",
//                 headers: {
//                     "Content-Type": "application/json"
//                 },
//                 body: JSON.stringify(payload)
//             })
//             .then(response => response.json())
//             .then(data => {
//                 // Handle the API response as needed
//                 console.log("Pesapal API response:", data);
//             })
//             .catch(error => {
//                 console.error("Error calling Pesapal API:", error);
//             });













//             swal({
//                 title: `You are about to pay this amount Ksh. ${totalCost}`,
//                 text: "Do you want to proceed?",
//                 icon: "info",
//                 buttons: {
//                     cancel: "No",
//                     confirm: "Yes"
//                 },
//             })
//             // .then((willPay) => {
//             //     if (willPay) {
//             //         window.location.href = `sportsbooking.php?amount=${totalCost}`;
//             //     }
//             // });
//             .then((willProceed) => {
//             if (willProceed) {
//                 // Redirect to sportsbooking.php or perform necessary action
//                 window.location.href = "sportsbooking.php";
//             }
//         });
//         }
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


        function searchSports() {
            const searchTerm = searchInput.value.toLowerCase();
            if (searchTerm === '') {
                renderSports(sportsData);
            } else {
                const filteredData = sportsData.filter(sport => sport.sportsName.toLowerCase().includes(searchTerm));
                renderSports(filteredData);
            }
        }
    </script>
</body>
</html>
