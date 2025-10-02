<?php

include "./php/db_conn.php";

if (isset($_POST['submit'])) {
    $id = $_GET['id'];
    $librarian_id = $_POST['librarian_id'];
    $checkout_id = $_POST['checkout_id'];
    $due_date = $_POST['due_date'];
    $authorize = $_POST['authorize'] ? 1 : 0;
    $returned = $_POST['returned'] ? 1 : 0;

    $sql = "UPDATE `orders` SET `LibrarianId`=?, `CheckoutId`=?, `DueDate`=?, `Authorize`=?, `Returned`=? WHERE OrderID =?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssiii", $librarian_id, $checkout_id, $due_date, $authorize, $returned, $id);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        header("Location:./orders.php?msg=Record has been changed successfully!");
        exit;
    } else {
        echo "Failed: " . $conn->error;
    }
}

$id = $_GET['id'];
$sql = "SELECT * FROM `orders` WHERE OrderID =?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();
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
            <h3>Edit Order Information</h3>
            <p class="text-muted">Update the information of the existing order!</p>
        </div>

        <div class="container d-flex justify-content-center">
            <form action="" method="post" style="width: 50w; min-width: 300px;">
                <div class="mb-3">
                    <input type="text" class="form-control" name="librarian_id" value="<?php echo $row['LibrarianId'] ?>" required>
                </div>

                <div class="mb-3">
                    <input type="text" class="form-control" name="checkout_id" value="<?php echo $row['CheckoutId'] ?>" required>
                </div>

                <div class="mb-3">
                    <input type="date" class="form-control" name="due_date" value="<?php echo $row['DueDate'] ?>" required>
                </div>

                <label for="authorize" class="form-label">Authorize</label>
                <div class="mb-3">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="authorize" id="authorizeYes" value="1" <?php echo ($row['Authorize'] == 1) ? 'checked' : ''; ?>>
                        <label class="form-check-label" for="authorizeYes">Yes</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="authorize" id="authorizeNo" value="0" <?php echo ($row['Authorize'] == 0) ? 'checked' : ''; ?>>
                        <label class="form-check-label" for="authorizeNo">No</label>
                    </div>
                </div>

                <label for="authorize" class="form-label">Returned</label>
                <div class="mb-3">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="returned" id="returnedYes" value="1" <?php echo ($row['Returned'] == 1) ? 'checked' : ''; ?>>
                        <label class="form-check-label" for="returnedYes">Yes</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="returned" id="returnedNo" value="0" <?php echo ($row['Returned'] == 0) ? 'checked' : ''; ?>>
                        <label class="form-check-label" for="returnedNo">No</label>
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        <button type="submit" class="btn btn-block mb-4 w-100 text-white" style="background-color: #756AB6;" name="submit">Update</button>
                    </div>
                    <div class="col">
                        <a href="orders.php" class="btn btn-block mb-4 w-100 text-white btn-dark">Cancel</a>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous"></script>
</body>

</html>