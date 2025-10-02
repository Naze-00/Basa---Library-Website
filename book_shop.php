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

    <div class="container">
        <div class="row mt-5">
            <div class="col-12 text-center">
                <div class="section-title">
                    <h1 class="display-4 fw-semibold">Our Books</h1>
                    <div class="li"></div>
                    <h6>What Can We Offer?</h6>
                </div>
            </div>
        </div>
        <div class="row g-4 d-flex justify-content-center">

            <?php
            include "./php/db_conn.php";

            $query = "SELECT books.BookID, books.BookName, books.PublicationYear, books.Genre, books.Picture, authors.FirstName, authors.LastName 
           FROM books 
           INNER JOIN authors ON books.AuthorID = authors.AuthorID
           INNER JOIN inventory ON books.BookID = inventory.BookID
           WHERE inventory.Status = 1";
            $result = mysqli_query($conn, $query);

            while ($row = mysqli_fetch_assoc($result)) {
            ?>
                <div class="col-md-4">
                    <div class="card h-100 border-0 shadow rounded-3 overflow-hidden d-flex justify-content-center align-items-center">
                        <div class="image-container" style=" height: 220px; width: 150px; overflow: hidden;">
                            <img src="<?php echo $row['Picture']; ?>" class="card-img-top mt-3" alt="<?php echo $row['BookName']; ?>" style="height: 200px; width: 150px; overflow: hidden;">
                        </div>
                        <div class="card-body text-center">
                            <h5 class="card-title mb-0"> <?php echo $row['BookName']; ?></h5>
                            <p class="card-text mb-2">Author: <?php echo $row['FirstName'] . ' ' . $row['LastName']; ?></p>
                            <p class="card-text mb-2">Genre: <?php echo $row['Genre']; ?></p>
                            <p class="card-text mb-4">Publication Year: <?php echo $row['PublicationYear']; ?></p>
                            <div class="d-flex justify-content-center mb-2">
                                <a href="book_cart.php?add=<?php echo $row['BookName']; ?>&id=<?php echo $row['BookID'];?>&author=<?php echo $row['FirstName'] . ' ' . $row['LastName']; ?>&genre=<?php echo $row['Genre']; ?>&year=<?php echo $row['PublicationYear']; ?>" class="btn btn-brand">Add to Cart</a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php
            }
            ?>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script>
        function addToCart(bookName) {
            if (typeof sessionStorage.cart === 'undefined') {
                sessionStorage.cart = JSON.stringify([]);
            }

            var cart = JSON.parse(sessionStorage.cart);

            cart.push(bookName);
            sessionStorage.cart = JSON.stringify(cart);

            alert('Book added to cart!');
        }
    </script>

</body>

</html>