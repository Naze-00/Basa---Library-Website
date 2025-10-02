<?php
include "./php/db_conn.php";
$id = $_GET['id'];
$sql = "DELETE FROM publishers WHERE PublishersID = $id";
$result = mysqli_query($conn, $sql);
if ($result) {
    header("Location:publishers.php?msg=Record has been deleted successfully!");
    } 
else {
    echo "Failed: " . mysqli_error($conn);
}
?>