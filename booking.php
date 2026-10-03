<?php

session_start();
include("db.php");

// Check whether user is logged in
if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit();
}

if (!isset($_GET["room_id"])) {
    echo "room is not found";
    exit();
}
$user_id = $_SESSION["user_id"];
$room_id = $_GET["room_id"];

$data = file_get_contents("room.json");
$rooms = json_decode($data, true);

$found = false;
foreach ($rooms as $room) {
    if ($room["id"] == $room_id) {
        $found = true;
        $booking_date = date("Y-m-d");
        $sql = "INSERT INTO bookings (user_id, room_id, booking_date)
                VALUES ('$user_id', '$room_id', '$booking_date')";

        if (mysqli_query($conn, $sql)) {

            echo "room booked";
        } else {
            echo "room failed";
        }
    }
}

if (!$found) {
    echo "room falied";
}
?>