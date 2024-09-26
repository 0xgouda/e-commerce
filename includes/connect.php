<?php
    $conn = mysqli_connect('localhost', 'root', '', 'Mystore');
    if (!$conn) {
        die(mysqli_connect_error());
    }
?>