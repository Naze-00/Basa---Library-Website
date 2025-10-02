<?php

if (isset($_SESSION['librarian_id'])) {
    header("Location: users.php");
    exit();
}elseif (isset($_SESSION['client'])) {
    header("Location: home.php");
    exit();
}

?>