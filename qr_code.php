<?php
session_start();

include "./php/db_conn.php";

if (!isset($_SESSION['client'])) {
    header("Location: index.php");
    exit();
}

$client_id = $_SESSION['client'];

$sql = "SELECT FirstName, LastName FROM clients WHERE ClientID =?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "i", $client_id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$client = mysqli_fetch_assoc($result);
$first_name = $client['FirstName'];
$last_name = $client['LastName'];

$cart = $_SESSION['cart'];

$books_info = "";
foreach ($cart as $book) {
    $sql = "SELECT BookName FROM books WHERE BookID =?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "i", $book['id']);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $book_info = mysqli_fetch_assoc($result);
    $books_info.= $book_info['BookName']. ", ";
}
$books_info = rtrim($books_info, ', ');

$checkout_date = date("Y-m-d");

include './php/phpqrcode/qrlib.php';

$qr_text = "Client Name: $first_name $last_name\nBook Names: $books_info\nCheckout Date: $checkout_date";
foreach ($cart as $book) {
    $qr_text.= "\nCheckoutID: ".$book['checkout_id'];
}

$qr_path = "qr.png";
QRcode::png($qr_text, $qr_path);

$qr_code = file_get_contents($qr_path);

$qr_code_base64 = base64_encode($qr_code);

mysqli_close($conn);

echo '<h6>Checkout Successful!</h6>';
echo '<img src="data:image/png;base64,'.$qr_code_base64.'" alt="QR Code"><br>';
echo '<p>Scan the qr code and take a screenshot and proceed to the counter to get the books.</p>';
?>