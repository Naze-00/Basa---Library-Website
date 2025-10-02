<?php
include "./php/db_conn.php";

if (isset($_POST['submit'])) {
    $book_id = $_POST['book_id'];
    $quantity_in_stock = $_POST['quantity_in_stock'];
    $publisher_id = $_POST['publisher_id'];
    $status = ($_POST['status'] == 'Available')? true : false;

    $sql = "INSERT INTO `inventory`(`InventoryID`, `BookID`, `QuantityInStock`, `PublisherID`, `Status`) VALUES (NULL,'$book_id','$quantity_in_stock','$publisher_id','$status')";

    $result = mysqli_query($conn, $sql);

    if ($result) {
        header("Location:./inventory.php?msg=New Record created successfully!");
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
    <title>Basa</title>
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
            <h3>Add New Inventory</h3>
            <p class="text-muted">Complete the form below to add a new inventory</p>
        </div>

        <div class="container d-flex justify-content-center">
            <form action="" method="post" style="width: 50w; min-width: 300px;">
                <div class="row mb-3">
                    <div class="col">
                        <input type="text" class="form-control" name="book_id" placeholder="Book ID" required>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col">
                        <input type="text" class="form-control" name="quantity_in_stock" placeholder="Quantity in Stock" required>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col">
                        <input type="text" class="form-control" name="publisher_id" placeholder="Publisher ID" required>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" value="Available" id="status" name="status">
                            <label class="form-check-label" for="status">
                                Available
                            </label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" value="Not available" id="status" name="status">
                            <label class="form-check-label" for="status">
                                Not available
                            </label>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        <button type="submit" class="btn btn-block mb-4 w-100 text-white" style="background-color: #756AB6;" name="submit">Add</button>
                    </div>
                    <div class="col">
                        <a href="inventory.php" class="btn btn-block mb-4 w-100 text-white btn-dark">Cancel</a>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDz