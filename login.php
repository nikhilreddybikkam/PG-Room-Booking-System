<?php
session_start();
include("db.php");

if (isset($_POST["login"])) {
    $email = $_POST["email"];
    $pass = $_POST["password"];

    $sql = "select * from users where email='$email' and password='$pass'";
    $res = mysqli_query($conn, $sql);
    if (mysqli_num_rows($res) > 0) {

        $re = mysqli_fetch_assoc($res);

        $_SESSION["user_id"] = $re["id"];
        $_SESSION["name"] = $re["name"];




        header("Location: index.php");
        exit();
    } else {
        echo "invalid";
    }


}


?>






<!DOCTYPE html>
<html>

<head>
    <title>Login</title>
</head>

<body>

    <h1>PG Login</h1>

    <form method="POST">

        Email:

        <input type="email" name="email" required>

        <br><br>

        Password:

        <input type="password" name="password" required>

        <br><br>

        <input type="submit" name="login" value="Login">

    </form>

    <br>

    <a href="register.php">Create new account</a>

</body>

</html>