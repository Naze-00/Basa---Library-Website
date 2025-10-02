<?php

include "./php/db_conn.php";

if (isset($_POST['submit'])) {
    $id = $_GET['id'];
    $book_id = $_POST['book_id'];
    $quantity_in_stock = $_POST['quantity_in_stock'];
    $publisher_id = $_POST['publisher_id'];
    $status = $_POST['status'] == 'Available'? 1 : 0;

    $sql = "UPDATE `inventory` SET `BookID`=?, `QuantityInStock`=?, `PublisherID`=?, `Status`=? WHERE InventoryID =?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iisii", $book_id, $quantity_in_stock, $publisher_id, $status, $id);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        header("Location:./inventory.php?msg=Record has been changed successfully!");
        exit;
    } else {
        echo "Failed: ". $conn->error;
    }
}

$id = $_GET['id'];
$sql = "SELECT * FROM `inventory` WHERE InventoryID =?";
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
            <h3>Edit Inventory Information</h3>
            <p class="text-muted">Update the information of the existing inventory!</p>
        </div>

        <div class="container d-flex justify-content-center">
            <form action="" method="post" style="width: 50w; min-width: 300px;">
                <div class="mb-3">
                    <input type="text" class="form-control" name="book_id" value="<?php echo $row['BookID']?>" required>
                </div>

                <div class="mb-3">
                    <input type="text" class="form-control" name="quantity_in_stock" value="<?php echo $row['QuantityInStock']?>" required>
                </div>

                <div class="mb-3">
                    <input type="text" class="form-control" name="publisher_id" value="<?php echo $row['PublisherID']?>" required>
                </div>

                <div class="mb-3">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="status" id="available" value="Available" <?php echo $row['Status'] == 1? 'checked' : ''?>>
                        <label class="form-check-label" for="available">Available</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="status" id="not-available" value="Not Available" <?php echo $row['Status'] == 0? 'checked' : ''?>>
                        <label class="form-check-label" for="not-available">Not Available</label>
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        <button type="submit" class="btn btn-block mb-4 w-100 text-white" style="background-color: #756AB6;" name="submit">Update</button>
                    </div>
                    <div class="col">
                        <a href="inventory.php" class="btn btn-block mb-4 w-100 text-white btn-dark">Cancel</a>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous"></script>
</body>

</html>