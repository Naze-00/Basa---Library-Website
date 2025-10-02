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

                        $sql = "SELECT FirstName FROM clients WHERE ClientID =?";
                        $stmt = mysqli_prepare($conn, $sql);
                        mysqli_stmt_bind_param($stmt, "i", $client_id);
                        mysqli_stmt_execute($stmt);
                        $result = mysqli_stmt_get_result($stmt);
                        $client = mysqli_fetch_assoc($result);
                        $first_name = $client['FirstName'];
                        ?>
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="ri-account-box-fill me-2"></i><?php echo $first_name; ?>
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="account_page.php">Account</a></li>
                            <li><a class="dropdown-item" href="logout.php">Logout</a></li>
                        </ul>
                    </li>
                </ul>
                <a href="book_cart.php" class="btn btn-brand ms-lg-3">Cart</a>
            </div>
        </div>
    </nav>

    <div class="container d-flex justify-content-center align-items-center">
        <div class="row mt-5 justify-content-center align-items-center">
            <div class="col-12 text-center">
                <div class="section-title">
                    <h1 class="display-4 fw-semibold">Checkout</h1>
                    <div class="li"></div>
                    <h6>Scan the qr code and take a screenshot and proceed to the counter to get the books.</h6>
                </div>
            </div>
            <div class="d-flex justify-content-center align-items-center col-12 text-center">
                <div class="card text-center col-6">
                    <div class="card-header">
                        Your Qr Code
                    </div>
                    <div class="card-body">
                        <?php

                        $client_id = $_SESSION['client'];

                        $sql = "SELECT FirstName, LastName FROM clients WHERE ClientID =?";
                        $stmt = mysqli_prepare($conn, $sql);
                        mysqli_stmt_bind_param($stmt, "i", $client_id);
                        mysqli_stmt_execute($stmt);
                        $result = mysqli_stmt_get_result($stmt);
                        $client = mysqli_fetch_assoc($result);
                        $first_name = $client['FirstName'];
                        $last_name = $client['LastName'];

                        $cart = $_SESSION['cart'];

                        $books_info = "";
                        foreach ($cart as $book) {
                            $sql = "SELECT BookName FROM books WHERE BookID =?";
                            $stmt = mysqli_prepare($conn, $sql);
                            mysqli_stmt_bind_param($stmt, "i", $book['id']);
                            mysqli_stmt_execute($stmt);
                            $result = mysqli_stmt_get_result($stmt);
                            $book_info = mysqli_fetch_assoc($result);
                            $books_info .= $book_info['BookName'] . ", ";
                        }
                        $books_info = rtrim($books_info, ', ');

                        $checkout_date = date("Y-m-d");

                        include './php/phpqrcode/qrlib.php';

                        $qr_text = "Client Name: $first_name $last_name\nBook Names: $books_info\nCheckout Date: $checkout_date";
                        foreach ($cart as $book) {
                            $qr_text .= "\nCheckoutID: " . $book['checkout_id'];
                        }

                        $qr_path = "qr.png";
                        QRcode::png($qr_text, $qr_path);

                        $qr_code = file_get_contents($qr_path);

                        $qr_code_base64 = base64_encode($qr_code);

                        mysqli_close($conn);

                        echo '<h6>Checkout Successful!</h6>';
                        echo '<img src="data:image/png;base64,' . $qr_code_base64 . '" alt="QR Code"><br>';


                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>

</html>