<?php
include "./php/db_conn.php";

if (isset($_POST['submit'])) {
    $book_name = $_POST['book_name'];
    $isbn = $_POST['isbn'];
    $author_id = $_POST['author_id'];
    $publisher_id = $_POST['publisher_id'];
    $publication_year = $_POST['publication_year'];
    $genre = $_POST['genre'];

    $sql = "SELECT * FROM `authors` WHERE `AuthorID` = '$author_id'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) == 0) {
        header("Location:add_new_books.php?msg=Author ID Doesn't Exist! Please Add Author First.");
        return;
    }

    $sql = "SELECT * FROM `publishers` WHERE `PublisherID` = '$publisher_id'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) == 0) {
        header("Location:add_new_books.php?msg=Publisher ID Doesn't Exist! Please Add Publisher First.");
        return;
    }

    if (isset($_FILES["picture"])) {
        $target_dir = "./img/BookImg/";
        $target_file = $target_dir. basename($_FILES["picture"]["name"]);
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        if (move_uploaded_file($_FILES["picture"]["tmp_name"], $target_file)) {
            echo "The file ". basename( $_FILES["picture"]["name"]). " has been uploaded.";
            $sql = "INSERT INTO `books`(`BookID`, `BookName`, `ISBN`, `AuthorID`, `PublisherID`, `PublicationYear`, `Genre`, `Picture`) VALUES (NULL,'$book_name','$isbn','$author_id','$publisher_id','$publication_year','$genre', '$target_file')";
            $result = mysqli_query($conn, $sql);
            if ($result) {
                header("Location:./books.php?msg=New Record created successfully!");
            } else {
                echo "Failed: ". mysqli_error($conn);
            }
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    } else {
        echo "Please select an image file to upload.";
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
            <h3>Add New Book</h3>
            <p class="text-muted">Complete the form below to add a new book</p>
        </div>
        <?php
        if (isset($_GET['msg'])) {
            $msg = $_GET['msg'];
            echo '<div class="alert alert-warning alert-dismissible fade show mt-3" role="alert" style="background-color: #756AB6; color: white;">
                ' . $msg . '
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>';
        }
        ?>

        <div class="container d-flex justify-content-center">
            <form action="" method="post" style="width: 50w; min-width: 300px;" enctype="multipart/form-data">
                <div class="row mb-3">
                    <div class="col">
                        <input type="text" class="form-control" name="book_name" placeholder="Book Name" required>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col">
                        <input type="text" class="form-control" name="isbn" placeholder="ISBN" required>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col">
                        <input type="text" class="form-control" name="author_id" placeholder="Author ID" required>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col">
                        <input type="text" class="form-control" name="publisher_id" placeholder="Publisher ID" required>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col">
                        <input type="text" class="form-control" name="publication_year" placeholder="Publication Year" required>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col">
                        <input type="text" class="form-control" name="genre" placeholder="Genre" required>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col">
                        <input type="file" class="form-control" name="picture" accept="image/*" required>
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        <button type="submit" class="btn btn-block mb-4 w-100 text-white" style="background-color: #756AB6;" name="submit">Add</button>
                    </div>
                    <div class="col">
                        <a href="books.php" class="btn btn-block mb-4 w-100 text-white btn-dark">Cancel</a>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>