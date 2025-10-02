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
                <a href="book_shop.php" class="btn btn-brand ms-lg-3">Shop</a>
            </div>
        </div>
    </nav>

    <?php

    if (isset($_SESSION['cart'])) {
        $cart = $_SESSION['cart'];
    } else {
        $cart = array();
    }

    if (isset($_GET['add'])) {
        $bookDetails = array(
            'id' => $_GET['id'],
            'name' => $_GET['add'],
            'author' => $_GET['author'],
            'genre' => $_GET['genre'],
            'year' => $_GET['year']
        );
        if (!in_array($bookDetails, $cart)) {
            $cart[] = $bookDetails;
        }
        $_SESSION['cart'] = $cart;
    }

    if (isset($_GET['remove'])) {
        $bookDetails = array(
            'name' => $_GET['remove'],
            'author' => $_GET['author'],
            'genre' => $_GET['genre'],
            'year' => $_GET['year']
        );
        foreach ($cart as $key => $value) {
            if ($value['name'] == $bookDetails['name'] && $value['author'] == $bookDetails['author'] && $value['genre'] == $bookDetails['genre'] && $value['year'] == $bookDetails['year']) {
                unset($cart[$key]);
                break;
            }
        }
        $_SESSION['cart'] = array_values($cart);
    }
    ?>

    <div class="container">
        <div class="row mt-5">
            <div class="col-12 text-center">
                <div class="section-title">
                    <h1 class="display-4 fw-semibold">Your Cart</h1>
                    <div class="li"></div>
                    <h6>Here are the items in your cart:</h6>
                </div>
            </div>
        </div>
        <button type="button" class="btn btn-dark mb-3" data-bs-toggle="modal" data-bs-target="#checkoutModal">Check Out</button>

        <div class="modal fade" id="checkoutModal" tabindex="-1" aria-labelledby="checkoutModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="checkoutModalLabel">Checkout</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Are you sure you want to checkout?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-brand" onclick="checkoutCart()"><a href="qr_page.php" class="text-white">Checkout</a></button>
                    </div>
                </div>
            </div>
        </div>

        <div class="row g-4 d-flex justify-content-center">
            <table class="table table-hover text-center mt-4">
                <thead class="table-dark">
                    <tr>
                        <th>Book Name</th>
                        <th>Author</th>
                        <th>Genre</th>
                        <th>Publication Year</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($cart as $key => $bookDetails) {
                        if (is_array($bookDetails) && isset($bookDetails['name']) && isset($bookDetails['author']) && isset($bookDetails['genre']) && isset($bookDetails['year'])) { ?>
                            <tr>
                                <td><?php echo $bookDetails['name']; ?></td>
                                <td><?php echo $bookDetails['author']; ?></td>
                                <td><?php echo $bookDetails['genre']; ?></td>
                                <td><?php echo $bookDetails['year']; ?></td>
                                <td><a href="book_cart.php?remove=<?php echo $bookDetails['name']; ?>&author=<?php echo $bookDetails['author']; ?>&genre=<?php echo $bookDetails['genre']; ?>&year=<?php echo $bookDetails['year']; ?>"><button type="button" class="btn btn-danger">Remove</button></a></td>
                            </tr>
                    <?php }
                    } ?>
                </tbody>
            </table>

        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script>
    function checkoutCart() {
        const checkoutBtn = document.querySelector('.btn-dark');
        checkoutBtn.innerHTML = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Checking Out...';
        checkoutBtn.disabled = true;

        const xhr = new XMLHttpRequest();
        xhr.open('POST', 'process_checkout.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onload = function() {
            if (xhr.status === 200) {
                window.location.href = 'qr_page.php';
            } else {
                checkoutBtn.innerHTML = 'Check Out';
                checkoutBtn.disabled = false;
            }
        };
        xhr.send('cart=' + JSON.stringify(<?php echo json_encode($_SESSION['cart']);?>));

        return false;
    }
</script>

</body>

</html>