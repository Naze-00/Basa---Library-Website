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
                                <h2>Sign In</h2>
                                <p>Please enter your login and password!</p>
                                <?php
                                session_start();
                                include "./php/db_conn.php";
                                include "./php/check-login.php";

                                $email = '';
                                $password = '';

                                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                                    $email = $_POST['email'];
                                    $password = $_POST['pass'];

                                    $stmt = $conn->prepare("SELECT * FROM clients WHERE Email=? AND Pass=?");
                                    $stmt->bind_param("ss", $email, $password);
                                    $stmt->execute();
                                    $result = $stmt->get_result();

                                    if ($result->num_rows > 0) {
                                        $row = $result->fetch_assoc();


                                        session_start();
                                        $_SESSION['email'] = $email;
                                        $_SESSION['client'] = $row['ClientID'];
                                        header('Location: home.php');
                                    } else {
                                        $stmt = $conn->prepare("SELECT * FROM librarian WHERE Email=? AND Pass=?");
                                        $stmt->bind_param("ss", $email, $password);
                                        $stmt->execute();
                                        $result = $stmt->get_result();

                                        if ($result->num_rows > 0) {
                                            $row = $result->fetch_assoc();

                                            session_start();
                                            $_SESSION['email'] = $email;
                                            $_SESSION['librarian_id'] = $row['LibrarianId'];
                                            header('Location: users.php');
                                        } else {
                                            echo "Invalid email or password";
                                        }
                                    }
                                }
                                ?>
                                <?php
                                if (isset($_GET['msg'])) {
                                    $msg = $_GET['msg'];
                                    echo '<div class="alert alert-warning alert-dismissible fade show mt-3" role="alert" style="background-color: #756AB6; color: white;">
                                    ' . $msg . '
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>';
                                }
                                ?>

                                <form action="" method="post">
                                    <div data-mdb-input-init class="form-outline mb-4">
                                        <input type="email" id="mail" name="email" class="form-control" placeholder="Email" required />
                                    </div>

                                    <div data-mdb-input-init class="form-outline mb-4">
                                        <input type="password" id="pass" name="pass" class="form-control" placeholder="Password" required />
                                    </div>

                                    <button type="submit" data-mdb-button-init data-mdb-ripple-init class="btn btn-block mb-4 w-100 text-white" style="background-color: #756AB6;">
                                        Sign in
                                    </button>

                                    <div class="row">
                                        <small>Don't have account? <a href="signup.php">Sign up</a></small>
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