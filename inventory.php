<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Basa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous" />
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.2.0/fonts/remixicon.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    <link href="./css/nav.css" rel="stylesheet" />
</head>

<body>
    <nav class="navbar navbar-expand-lg bg-white sticky-top">
        <div class="container">
            <a class="navbar-brand" href="#">
                <img src="./img/dashboard.png" loading="lazy" style="max-width: 140px;
                height: auto;" />
            </a>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="users.php">Users</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="librarian.php">Librarian</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="books.php">Books</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="authors.php">Authors</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="publishers.php">Publishers</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="inventory.php">Inventory</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="orders.php">Orders</a>
                    </li>
                </ul>
                <div class="dropdown ms-lg-3">
                    <?php
                    session_start();

                    include "./php/db_conn.php";

                    if (!isset($_SESSION['librarian_id'])) {
                        header("Location: index.php");
                        exit();
                    }

                    $librarian_id = $_SESSION['librarian_id'];

                    $sql = "SELECT FirstName FROM librarian WHERE LibrarianId =?";
                    $stmt = mysqli_prepare($conn, $sql);
                    mysqli_stmt_bind_param($stmt, "i", $librarian_id);
                    mysqli_stmt_execute($stmt);
                    $result = mysqli_stmt_get_result($stmt);
                    $librarian = mysqli_fetch_assoc($result);
                    $first_name = $librarian['FirstName'];
                    ?>
                    <button class="btn btn-brand dropdown-toggle" data-bs-toggle="dropdown">
                        <?php echo $first_name; ?>
                    </button>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="logout.php">Logout</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>

    <div class="container mt-5">
        <div class="row">
            <div class="col-12 text-center">
                <div class="section-title">
                    <h1 class="display-4 fw-semibold">Inventory</h1>
                    <div class="li"></div>
                    <h6>List of all inventory</h6>
                </div>
            </div>
        </div>

        <a href="add_new_inventory.php" class="btn btn-dark mb-3">Add new</a>
        <div class="row justify-content-center ">
            <div class="col-md-6">
                <input type="text" id="search-input" class="form-control" placeholder="Search by BookID...">
            </div>
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
        <table class="table table-hover text-center mt-4">
            <thead class="table-dark">
                <tr>
                    <th scope="col">InventoryID</th>
                    <th scope="col">BookID</th>
                    <th scope="col">QuantityInStock</th>
                    <th scope="col">PublisherID</th>
                    <th scope="col">Status</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include "./php/db_conn.php";
                $sql = "SELECT * FROM `inventory`";
                $results = mysqli_query($conn, $sql);
                while ($row = mysqli_fetch_assoc($results)) {
                    $status = $row['Status'] == 1 ? 'Available' : 'Not Available';
                ?>
                    <tr>
                        <td><?php echo $row['InventoryID'] ?></td>
                        <td><?php echo $row['BookID'] ?></td>
                        <td><?php echo $row['QuantityInStock'] ?></td>
                        <td><?php echo $row['PublisherID'] ?></td>
                        <td><?php echo $status ?></td>

                        <td>
                            <a href="edit_inventory.php?id=<?php echo $row['InventoryID'] ?>" class="link-dark"><i class="ri-edit-fill"></i></a>
                            <a href="delete_inventory.php?id=<?php echo $row['InventoryID'] ?>" class="link-dark"><i class="ri-delete-bin-5-fill"></i></a>
                        </td>
                    </tr>
                <?php
                }
                ?>


            </tbody>
        </table>

    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script>
        const searchInput = document.getElementById('search-input');
        const tableBody = document.querySelector('table tbody');
        const originalRows = tableBody.querySelectorAll('tr');

        searchInput.addEventListener('input', function(e) {
            const searchText = e.target.value.toLowerCase();
            const filteredInventory = [];

            tableBody.querySelectorAll('tr').forEach(row => {
                const bookID = row.querySelector('td:nth-child(2)').textContent;
                if (bookID.toLowerCase().indexOf(searchText) !== -1) {
                    filteredInventory.push(row);
                }
            });

            tableBody.innerHTML = '';

            if (searchText) {
                filteredInventory.forEach(row => tableBody.appendChild(row.cloneNode(true)));
            } else {
                tableBody.append(...Array.from(originalRows));
            }
        });
    </script>

</body>

</html>