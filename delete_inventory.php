<?php
include "./php/db_conn.php";
$id = $_GET['id'];
$sql = "DELETE FROM inventory WHERE InventoryID = $id";
$result = mysqli_query($conn, $sql);
if ($result) {
    header("Location:inventory.php?msg=Record has been deleted successfully!");
} else {
    echo "Failed: " . mysqli_error($conn);
}
?>