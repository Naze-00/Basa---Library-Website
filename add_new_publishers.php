<?php
include "./php/db_conn.php";

if (isset($_POST['submit'])) {
    $publisher_company = $_POST['publisher_company'];
    $contact = $_POST['contact'];
    $address = $_POST['address'];

    $sql = "INSERT INTO `publishers`(`PublisherID`, `PublisherCompany`, `Contact`, `Address`) VALUES (NULL,'$publisher_company','$contact','$address')";

    $result = mysqli_query($conn, $sql);

    if ($result) {
        header("Location:./publishers.php?msg=New Record created successfully!");
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
            <h3>Add New Publisher</h3>
            <p class="text-muted">Complete the form below to add a new publisher</p>
        </div>

        <div class="container d-flex justify-content-center">
            <form action="" method="post" style="width: 50w; min-width: 300px;">
                <div class="row mb-3">
                    <div class="col">
                        <input type="text" class="form-control" name="publisher_company" placeholder="Publisher Company" required>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col">
                        <input type="text" class="form-control" name="contact" placeholder="Contact" required>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col">
                        <input type="text" class="form-control" name="address" placeholder="Address" required>
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        <button type="submit" class="btn btn-block mb-4 w-100 text-white" style="background-color: #756AB6;" name="submit">Add</button>
                    </div>
                    <div class="col">
                        <a href="publishers.php" class="btn btn-block mb-4 w-100 text-white btn-dark">Cancel</a>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>