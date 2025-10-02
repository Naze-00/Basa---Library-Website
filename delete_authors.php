<?php
include "./php/db_conn.php";
$id = $_GET['id'];
$sql = "DELETE FROM authors WHERE AuthorID = $id";
$result = mysqli_query($conn, $sql);
if ($result) {
    header("Location:authors.php?msg=Record has been deleted successfully!");
    } 
else {
    echo "Failed: " . mysqli_error($conn);
}
?>