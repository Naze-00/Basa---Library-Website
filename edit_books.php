<?php

include "./php/db_conn.php";

$id = $_GET['id'];
$sql = "SELECT * FROM `books` WHERE BookID =?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();

if (isset($_POST['submit'])) {
    $id = $_GET['id'];
    $book_name = $_POST['book_name'];
    $isbn = $_POST['isbn'];
    $author_id = $_POST['author_id'];
    $publisher_id = $_POST['publisher_id'];
    $publication_year = $_POST['publication_year'];
    $genre = $_POST['genre'];

    if (isset($_FILES['picture'])) {
        $picture = $_FILES['picture'];
        $picture_name = $picture['name'];
        $picture_tmp = $picture['tmp_name'];
        $picture_size = $picture['size'];
        $picture_type = $picture['type'];

        if ($picture_size > 0 && ($picture_type == 'image/jpeg' || $picture_type == 'image/png')) {
            $picture_path = './img/BookImg/'. $picture_name;
            move_uploaded_file($picture_tmp, $picture_path);

            if (file_exists($row['Picture'])) {
                unlink($row['Picture']);
            }

            $sql = "UPDATE `books` SET `BookName`=?, `ISBN`=?, `AuthorID`=?, `PublisherID`=?, `PublicationYear`=?, `Genre`=?, `Picture`=? WHERE BookID =?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ssiiissi", $book_name, $isbn, $author_id, $publisher_id, $publication_year, $genre, $picture_path, $id);
            $stmt->execute();

            if ($stmt->affected_rows > 0) {
                header("Location:./books.php?msg=Record has been changed successfully!");
                exit;
            } else {
                echo "Failed: ". $conn->error;
            }
        } else {
            echo "Invalid image upload";
        }
    } else {
        $sql = "UPDATE `books` SET `BookName`=?, `ISBN`=?, `AuthorID`=?, `PublisherID`=?, `PublicationYear`=?, `Genre`=? WHERE BookID =?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssiiisi", $book_name, $isbn, $author_id, $publisher_id, $publication_year, $genre, $id);
        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            header("Location:./books.php?msg=Record has been changed successfully!");
            exit;
        } else {
            echo "Failed: ". $conn->error;
        }
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
            <h3>Edit Book Information</h3>
            <p class="text-muted">Update the information of the existing book!</p>
        </div>

        <div class="container d-flex justify-content-center">
            <form action="" method="post" enctype="multipart/form-data" style="width: 50w; min-width: 300px;">
                <div class="mb-3">
                    <input type="text" class="form-control" name="book_name" value="<?php echo $row['BookName'] ?>" required>
                </div>

                <div class="mb-3">
                    <input type="text" class="form-control" name="isbn" value="<?php echo $row['ISBN'] ?>" required>
                </div>

                <div class="row mb-3">
                    <div class="col">
                        <input type="text" class="form-control" name="author_id" value="<?php echo $row['AuthorID'] ?>" required>
                    </div>
                    <div class="col">
                        <input type="text" class="form-control" name="publisher_id" value="<?php echo $row['PublisherID'] ?>" required>
                    </div>
                </div>

                <div class="mb-3">
                    <input type="number" class="form-control" name="publication_year" value="<?php echo $row['PublicationYear'] ?>" required>
                </div>

                <div class="mb-3">
                    <input type="text" class="form-control" name="genre" value="<?php echo $row['Genre'] ?>" required>
                </div>

                <div class="mb-3">
                    <input type="file" class="form-control" name="picture" required>
                </div>

                <div class="row">
                    <div class="col">
                        <button type="submit" class="btn btn-block mb-4 w-100 text-white" style="background-color: #756AB6;" name="submit">Update</button>
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