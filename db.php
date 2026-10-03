<?php

$conn = mysqli_connect("localhost", "root", "", "pgbooking");

if (!$conn) {
    echo "connection failed", mysqli_connect_error();
}

?>