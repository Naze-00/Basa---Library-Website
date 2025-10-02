<?php
include "./php/db_conn.php";

if (isset($_POST['submit'])) {
    $order_id = $_POST['order_id'];
    $librarian_id = $_POST['librarian_id'];
    $checkout_id = $_POST['checkout_id'];
    $borrowed_date = $_POST['borrowed_date'];
    $authorize = isset($_POST['authorize'])? 1 : 0;

    $sql = "INSERT INTO `orders`(`OrderId`, `LibrarianId`, `CheckoutId`, `BorrowedDate`, `DueDate`, `Authorize`) VALUES ('$order_id','$librarian_id','$checkout_id','$borrowed_date', DATE_ADD('$borrowed_date', INTERVAL 1 MONTH), $authorize)";

    $result = mysqli_query($conn, $sql);

    if ($result) {
        header("Location:./orders.php?msg=New Record created successfully!");
    } else {
        echo "Failed: ". mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Orders</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous" />
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.2.0/fonts/remixicon.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    <link href="./css/style.css" rel="stylesheet" />
    <style>
        input {
            font-family: var(--font-base4);
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg bg-white sticky-top">
        <div class="container">
            <a class="navbar-brand" href="#">
                <img src="./img/basa.png" loading="lazy" style="max-width: 140px;
                height: auto;" />
            </a>
        </div>
    </nav>

    <div class="container">
        <div class="text-center mb-4 mt-5">
            <h3>Add New Order</h3>
            <p class="text-muted">Complete the form below to add a new order</p>
        </div>

        <div class="container d-flex justify-content-center">
            <form action="" method="post" style="width: 50w; min-width: 300px;">
                <div class="row mb-3">
                    <div class="col">
                        <input type="text" class="form-control" name="librarian_id" placeholder="Librarian ID" required>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col">
                        <input type="text" class="form-control" name="checkout_id" placeholder="Checkout ID" required>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col">
                        <input type="date" class="form-control" name="borrowed_date" placeholder="Borrowed Date" required>
                    </div>
                </div>
                <label for="authorize" class="form-label">Authorize</label>
                <div class="row mb-3">
                    <div class="col">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="authorize" id="authorizeYes" value="1">
                            <label class="form-check-label" for="authorizeYes">
                                Yes
                            </label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="authorize" id="authorizeNo" value="0">
                            <label class="form-check-label" for="authorizeNo">
                                No
                            </label>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        <button type="submit" class="btn btn-block mb-4 w-100 text-white" style="background-color: #756AB6;" name="submit">Add</button>
                    </div>
                    <div class="col">
                        <a href="orders.php" class="btn btn-block mb-4w-100 text-white btn-dark">Cancel</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>