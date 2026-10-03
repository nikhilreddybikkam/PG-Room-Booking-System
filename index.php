<?php

session_start();
include("db.php");

if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit();
}

$data = file_get_contents("room.json");
$a = json_decode($data, true);



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <table>
        <tr>
            <th>id</th>
            <th>pg name</th>
            <th>location</th>
            <th>room type</th>
            <th>rent</th>
            <th>action</th>
        </tr>
        <?php
        foreach ($a as $room) {
            ?>
            <tr>
                <td>
                    <?php echo $room["id"]; ?>
                </td>
                <td>
                    <?php echo $room["name"]; ?>
                </td>
                <td>
                    <?php echo $room["location"]; ?>
                </td>
                <td>
                    <?php echo $room["type"]; ?>
                </td>
                <td>
                    <?php echo $room["rent"]; ?>
                </td>
                <td>
                    <a href="book.php?room_id=<?php echo $room["id"]; ?>">Book</a>
                </td>
            </tr>
            <?php
        }
        ?>

    </table>
</body>

</html>