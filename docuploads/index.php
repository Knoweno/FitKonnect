<?php require_once 'search.php';   ?>

<!DOCTYPE html>
<html>
<head>
    <title>Trainer Document Search</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            padding-top: 60px;
        }

        .navbar {
            background-color: #08a0e9;
            color: white;
        }

        .sidebar {
            position: fixed;
            top: 60px;
            left: 0;
            height: 100%;
            width: 200px;
            background-color: #f8f9fa;
            padding-top: 20px;
        }

        .sidebar ul {
            list-style-type: none;
            padding: 0;
            margin: 0;
        }

        .sidebar li {
            margin-bottom: 10px;
        }

        .sidebar li a {
            color: #08a0e9;
        }

        .main-content {
            margin-left: 200px;
            padding: 20px;
        }

        .error {
            color: red;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-md navbar-dark fixed-top">
        <a class="navbar-brand" href="#">Trainer Document Search</a>
    </nav>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2 sidebar">
                <ul>
                    <?php foreach ($trainerIds as $trainer): ?>
                        <li>
                            <a href="search.php?trainer_id=<?php echo $trainer['trainer_id']; ?>">
                                <?php echo $trainer['trainer_id']; ?>
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <div class="col-md-10 main-content">
                <h2>Trainer Document Search</h2>

                <form method="GET" action="search.php">
                    <div class="form-group">
                        <label for="trainer_id">Trainer ID:</label>
                        <input type="text" id="trainer_id" name="trainer_id" class="form-control" value="">
                    </div>
                    <button type="submit" class="btn btn-primary">Search</button>
                </form>

                <?php if (!empty($error)): ?>
                    <p class="error"><?php echo $error; ?></p>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
