<?php
include "./php/db_conn.php";
$id = $_GET['id'];
$sql = "DELETE FROM clients WHERE ClientID = $id";
$result = mysqli_query($conn, $sql);
if ($result) {
    header("Location:users.php?msg=Record has been deleted successfully!");
    } 
else {
    echo "Failed: " . mysqli_error($conn);
}
?>