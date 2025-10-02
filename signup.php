<?php
include "./php/db_conn.php";

if (isset($_POST['submit'])) {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $password = $_POST['pass'];


    $check_email_query = "SELECT * FROM clients WHERE Email = '$email'";
    $check_email_result = mysqli_query($conn, $check_email_query);
    $email_exists = mysqli_num_rows($check_email_result) > 0;

    if ($email_exists) {
        header("Location:./signup.php?msg=Email Already Exist!");
        exit;
    }

    $sql = "INSERT INTO `clients`(`ClientID`, `FirstName`, `LastName`, `Email`, `Pass`) VALUES (NULL,'$first_name','$last_name','$email','$password')";

    $result = mysqli_query($conn, $sql);

    if ($result) {
        header("Location:./index.php?msg=New Record created successfully!");
    } else {
        echo "Failed: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
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

    <section class="min-vh-100 d-flex justify-content-center  align-items-center">

        <div id="particles-js"></div>

        <div class="px-4 py-5 px-md-5 text-center text-lg-start" style="background-color: hsl(0, 0%, 96%)">
            <div class="container">
                <div class="row gx-lg-5 align-items-center">
                    <?php
                    if (isset($_GET['msg'])) {
                        $msg = $_GET['msg'];
                        echo '<div class="alert alert-warning alert-dismissible fade show mt-3" role="alert" style="background-color: #756AB6; color: white;">
                                    ' . $msg . '
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>';
                    }
                    ?>
                    <div class="col-lg-6 mb-5 mb-lg-0">
                        <h1 class="my-5 display-3 fw-bold ls-tight">
                            BASA:
                            <span style="color: #756AB6;">Wonderful World of Reading</span>
                        </h1>
                        <p style="color: hsl(217, 10%, 50.8%)">
                            Our team are passionate about making libraries even more convenient and accessible for
                            everyone. That's why we created this website, a one-stop shop for reserving library
                            materials
                            and managing your library experience.
                        </p>
                    </div>

                    <div class="col-lg-6 mb-5 mb-lg-0">
                        <div class="card">
                            <div class="card-body py-5 px-md-5">
                                <h2>Sign Up</h2>
                                <p>Please enter required information</p>
                                <form method="post">
                                    <div class="row">
                                        <div class="col-md-6 mb-4">
                                            <div data-mdb-input-init class="form-outline">
                                                <input type="text" id="fname" class="form-control" name="first_name" placeholder="FirstName" required />
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-4">
                                            <div data-mdb-input-init class="form-outline">
                                                <input type="text" id="lname" class="form-control" name="last_name" placeholder="LastName" required />
                                            </div>
                                        </div>
                                    </div>
                                    <div data-mdb-input-init class="form-outline mb-4">
                                        <input type="email" id="mail" class="form-control" name="email" placeholder="Email" required />
                                    </div>

                                    <div data-mdb-input-init class="form-outline mb-4">
                                        <input type="password" id="pass" class="form-control" name="pass" placeholder="Password" required />
                                    </div>

                                    <button type="submit" data-mdb-button-init data-mdb-ripple-init class="btn btn-block mb-4 w-100 text-white" name="submit" style="background-color: #756AB6;">
                                        Sign in
                                    </button>

                                    <div class="row">
                                        <small>Already have account? <a href="index.php">Sign in</a></small>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="./js/script.js"></script>
    <script src="./js/particles.js"></script>
    <script src="./js/app.js"></script>
</body>

</html>