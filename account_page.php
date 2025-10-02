<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Basa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous" />
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.2.0/fonts/remixicon.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    <link href="./css/style.css" rel="stylesheet" />
</head>

<body>

    <nav class="navbar navbar-expand-lg bg-white sticky-top">
        <div class="container">
            <a class="navbar-brand" href="home.php">
                <img src="./img/basa.png" alt="logo">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#"></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#"></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#"></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#"></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#"></a>
                    </li>
                    <li class="nav-item dropdown">
                        <?php
                        session_start();

                        include "./php/db_conn.php";

                        if (!isset($_SESSION['client'])) {
                            header("Location: index.php");
                            exit();
                        }

                        $client_id = $_SESSION['client'];

                        $sql = "SELECT FirstName, LastName, Email, Pass FROM clients WHERE ClientID =?";
                        $stmt = mysqli_prepare($conn, $sql);
                        mysqli_stmt_bind_param($stmt, "i", $client_id);
                        mysqli_stmt_execute($stmt);
                        $result = mysqli_stmt_get_result($stmt);
                        $client = mysqli_fetch_assoc($result);
                        $first_name = $client['FirstName'];
                        $last_name = $client['LastName'];
                        $email = $client['Email'];
                        $pass = $client['Pass'];
                        ?>
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="ri-account-box-fill me-2"></i><?php echo $first_name; ?>
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="#">Account</a></li>
                            <li><a class="dropdown-item" href="logout.php">Logout</a></li>
                        </ul>
                    </li>
                </ul>
                <a href="book_shop.php" class="btn btn-brand ms-lg-3">Shop</a>
            </div>
        </div>
    </nav>

    <div class="container">
        <div class="row mt-5">
            <div class="col-12 text-center">
                <div class="section-title">
                    <h1 class="display-4 fw-semibold">Account Information</h1>
                    <div class="li"></div>
                </div>
            </div>
        </div>
        <div class="row g-4 d-flex justify-content-center align-items-center ">
            <div class="col-md-4">
                <div class="card h-100 border-0 shadow rounded-3 overflow-hidden d-flex justify-content-center align-items-center">
                    <div class="card-body">
                        <div class="text-center">
                            <i class="ri-account-circle-fill" style="font-size: 50px"></i>
                        </div>
                        <h5 class="card-title mb-0">Name: <?php echo $first_name . ' ' . $last_name; ?></h5>
                        <br>
                        <p class="card-text mb-2">Email: <?php echo $email; ?></p>
                        <p class="card-text mb-4">Password: <?php echo $pass; ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row mt-5">
            <div class="col-12 text-center">
                <div class="section-title">
                    <h1 class="display-4 fw-semibold">Orders</h1>
                    <div class="li"></div>
                </div>
            </div>
        </div>
        <div class="row g-4 d-flex justify-content-center">
            <div class="col-md-12">
                <table class="table table-hover table-striped text-center">
                    <thead class="table-dark">
                        <tr>
                            <th>Order ID</th>
                            <th>Book Name</th>
                            <th>Borrowed Date</th>
                            <th>Due Date</th>
                            <th>Returned</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        include "./php/db_conn.php";
                        if (!isset($_SESSION['client'])) {
                            header("Location: index.php");
                            exit();
                        }
                        $client_id = $_SESSION['client'];
                        $sql = "SELECT o.CheckoutId, o.BorrowedDate, o.DueDate, o.Authorize, o.Returned, b.BookName FROM orders o JOIN checkout c ON o.CheckoutId = c.CheckoutId JOIN books b ON c.BookID = b.BookID WHERE c.ClientID =? AND o.Authorize = 1";
                        $stmt = mysqli_prepare($conn, $sql);
                        mysqli_stmt_bind_param($stmt, "i", $client_id);
                        mysqli_stmt_execute($stmt);
                        $result = mysqli_stmt_get_result($stmt);
                        while ($order = mysqli_fetch_assoc($result)) {
                            echo '<tr>';
                            echo '<td>'. $order['CheckoutId']. '</td>';
                            echo '<td>'. $order['BookName']. '</td>';
                            echo '<td>'. $order['BorrowedDate']. '</td>';
                            echo '<td>'. $order['DueDate']. '</td>';
                            echo '<td>'. ($order['Returned'] == 1? 'Yes' : 'No'). '</td>';
                            echo '</tr>';
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>

</html>

//test