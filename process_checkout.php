<?php
session_start();
include "./php/db_conn.php";


if (!isset($_SESSION['client'])) {
    header("Location: index.php");
    exit();
}

if (isset($_POST['cart']) &&!empty($_POST['cart'])) {
    $cart = json_decode(htmlspecialchars_decode($_POST['cart']), true);
} else {
    if (isset($_SESSION['cart'])) {
        $cart = $_SESSION['cart'];
    } else {
        $cart = array();
    }
}

$client_id = $_SESSION['client'];

foreach ($cart as &$book) {
    if (isset($book['id'])) {
        $sql = "INSERT INTO checkout (ClientID, BookID, CheckoutDate, Status) VALUES (?,?,?,?)";
        $stmt = mysqli_prepare($conn, $sql);
        if (!$stmt) {
            echo "SQL error: ". mysqli_error($conn);
            exit();
        }
        $checkout_date = date('Y-m-d');
        $status = '1';
        mysqli_stmt_bind_param($stmt, "iiss", $client_id, $book['id'], $checkout_date, $status);
        if (!mysqli_stmt_execute($stmt)) {
            echo "Error executing query: ". mysqli_error($conn);
            exit();
        }
        $checkout_id = mysqli_insert_id($conn);
        $book['checkout_id'] = $checkout_id;
    }
}

$_SESSION['cart'] = $cart;
exit();
?>