    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="loginNav">
        <div class="container">
            <a class="navbar-brand" href="<?php include 'links.php' ?>">FitKonnect</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item ">
                        <a class="nav-link" href="<?php  include 'links.php'?>">Home</a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="<?php  include 'links.php'?>login.php">Book a Session</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Contact Us</a>
                    </li>
                </ul>
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="<?php  include 'links.php'?>logout.php"><button class="btn btn-danger">LogOut</button> </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>