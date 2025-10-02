<?php
session_start();

unset($_SESSION['cart']);

header('Location: ../book_cart.php');
exit();
?>