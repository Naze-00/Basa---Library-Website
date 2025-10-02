<?php
include "./php/db_conn.php";

$sql = "SELECT * FROM `clients`";
$results = mysqli_query($conn, $sql);

$clients = [];
while ($row = mysqli_fetch_assoc($results)) {
  $clients[] = $row;
}

echo json_encode($clients);