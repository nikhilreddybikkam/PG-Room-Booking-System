<?php
include("db.php");
if (isset($_POST["register"])) {

    $name = $_POST["name"];
    $email = $_POST["email"];
    $password = $_POST["password"];

    $sql = "insert into users (name,email,password) values ('$name','$email','$password')";

    if (mysqli_query($conn, $sql)) {
        echo "register success";
        echo "<a href='login.php'>login</a>";
    } else {
        echo "failed";
    }



}


?>



<!DOCTYPE html>
<html>

<head>
    <title>Register</title>
</head>

<body>

    <h1>PG Registration</h1>

    <form method="POST">

        Name:
        <input type="text" name="name" required>

        <br><br>

        Email:
        <input type="email" name="email" required>

        <br><br>

        Password:
        <input type="password" name="password" required>

        <br><br>

        <input type="submit" name="register" value="Register">

    </form>

    <br>

    <a href="login.php">Already have account? Login</a>

</body>

</html>