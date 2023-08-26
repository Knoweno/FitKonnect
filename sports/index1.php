<!DOCTYPE html>
<html>
<head>
    <title>Sports Shop</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
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
                <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
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

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.7/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        const sportsContainer = document.getElementById('sportsContainer');
        const cartList = document.getElementById('cartList');

        // Fetch data from the API
        fetch('http://fit.eastus.cloudapp.azure.com/FitKonnect/sports/getSports.php')
            .then(response => response.json())
            .then(data => {
                // Populate sports data
                data.forEach(sport => {
                    const sportBox = document.createElement('div');
                    sportBox.className = 'col-md-4';
                    sportBox.innerHTML = `
                        <div class="sport-box">
                            <h4>${sport.sportsName}</h4>
                            <p>${sport.sportDescription}</p>
                            <p>Price: $${sport.Price}</p>
                            <button class="btn btn-primary" onclick="addToCart('${sport.sportsName}', ${sport.Price})">Add to Cart</button>
                            <button class="btn btn-danger" onclick="removeFromCart('${sport.sportsName}')">Remove</button>
                        </div>
                    `;
                    sportsContainer.appendChild(sportBox);
                });
            })
            .catch(error => {
                console.error('Error fetching data:', error);
            });

        // Cart functionality
        const cartItems = [];

        function addToCart(sportsName, price) {
            cartItems.push({ sportsName, price });
            updateCartList();
        }

        function removeFromCart(sportsName) {
            const index = cartItems.findIndex(item => item.sportsName === sportsName);
            if (index !== -1) {
                cartItems.splice(index, 1);
                updateCartList();
            }
        }

        function updateCartList() {
            const cartList = document.getElementById('cartList');
            cartList.innerHTML = '';

            cartItems.forEach(item => {
                const listItem = document.createElement('li');
                listItem.textContent = `${item.sportsName} - $${item.price}`;
                cartList.appendChild(listItem);
            });
        }
    </script>
</body>
</html>
