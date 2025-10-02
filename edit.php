<?php
include "./php/db_conn.php";

if (isset($_POST['submit'])) {
    $id = $_GET['id'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $password = $_POST['pass'];

    $sql = "UPDATE `clients` SET `FirstName`=?, `LastName`=?, `Email`=?, `Pass`=? WHERE ClientID =?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "ssssi", $first_name, $last_name, $email, $password, $id);
    mysqli_stmt_execute($stmt);

    if (mysqli_stmt_affected_rows($stmt) > 0) {
        header("Location:./users.php?msg=Record has been changed successfully!");
    } else {
        echo "Failed: " . mysqli_error($conn);
    }
}

$id = $_GET['id'];
$sql = "SELECT * FROM `clients` WHERE ClientID = $id LIMIT 1";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
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
            <h3>Edit User Information</h3>
            <p class="text-muted">Update the information of the existing user!</p>
        </div>

        <div class="container d-flex justify-content-center">
            <form action="" method="post" style="width: 50w; min-width: 300px;">
                <div class="row mb-3">
                    <div class="col">
                        <input type="text" class="form-control" name="first_name" value="<?php echo $row['FirstName'] ?>" required>
                    </div>
                    <div class="col">
                        <input type="text" class="form-control" name="last_name" value="<?php echo $row['LastName'] ?>" required>
                    </div>
                </div>

                <div class="mb-3">
                    <input type="email" class="form-control" name="email" value="<?php echo $row['Email'] ?>" required>
                </div>

                <div class="mb-3">
                    <input type="password" class="form-control" name="pass" value="<?php echo $row['Pass'] ?>" required>
                </div>

                <div class="row">
                    <div class="col">
                        <button type="submit" class="btn btn-block mb-4 w-100 text-white" style="background-color: #756AB6;" name="submit">Update</button>
                    </div>
                    <div class="col">
                        <a href="users.php" class="btn btn-block mb-4 w-100 text-white btn-dark">Cancel</a>
                    </div>
                </div>
            </form>
        </div>
    </div>







    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>