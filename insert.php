<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include "./connection.php";
    $email = $_POST["email"];
    $password = $_POST["password"];

    $sql = "INSERT INTO `users`(`email`,`password`) VALUES('$email','$password')";
    $result = mysqli_query($conn,$sql);
    if ($result) {
        echo 1;
    }else{
        echo 0;
    }
}
?>