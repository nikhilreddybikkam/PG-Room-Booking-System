<?php

session_start();
include("db.php");

// Check whether user is logged in
if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit();
}

// Check whether room_id is received
if (!isset($_GET["room_id"])) {
    echo "Room ID not found";
    exit();
}

$user_id = $_SESSION["user_id"];
$room_id = $_GET["room_id"];

// Read JSON file
$data = file_get_contents("room.json");
$rooms = json_decode($data, true);

$found = false;

// Find selected room
foreach ($rooms as $room) {

    if ($room["id"] == $room_id) {

        $found = true;

        echo "<h2>Book PG Room</h2>";

        echo "PG Name: " . $room["name"] . "<br>";
        echo "Location: " . $room["location"] . "<br>";
        echo "Room Type: " . $room["type"] . "<br>";
        echo "Rent: " . $room["rent"] . "<br><br>";

        // Booking date
        $booking_date = date("Y-m-d");

        // Insert booking
        $sql = "INSERT INTO bookings (user_id, room_id, booking_date)
                VALUES ('$user_id', '$room_id', '$booking_date')";

        if (mysqli_query($conn, $sql)) {
            echo "Room booked successfully!<br><br>";
        } else {
            echo "Booking failed: " . mysqli_error($conn);
        }

        echo '<a href="index.php">Back</a>';

        break;
    }
}

// If room does not exist
if (!$found) {
    echo "Room not found";
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php
    $a = "SELECT users.name, users.email, bookings.booking_date
          FROM bookings
          JOIN users
          ON bookings.user_id = users.id";

    $res = mysqli_query($conn, $a);

    while ($booking = mysqli_fetch_assoc($res)) {
        ?>
        <table>
            <tr>
                <td>
                    <?php echo $booking["name"]; ?>
                </td>
                <td>
                    <?php echo $booking["email"]; ?>
                </td>
                <td>
                    <?php echo $booking["booking_date"]; ?>
                </td>

            </tr>
        </table>
        <?php
    }
    ?>



</body>

</html>