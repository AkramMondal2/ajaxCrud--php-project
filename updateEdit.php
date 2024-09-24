<?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include "./connection.php";
    $id = $_POST["id"];
    $email = $_POST["email"];
    $password = $_POST["password"];

    $sql = "UPDATE `users` SET `sno`='$id', `email`='$email', `password`='$password 'WHERE `sno`=$id";
    $result = mysqli_query($conn,$sql);
    if ($result) {
        echo 1;
    }else{
        echo 0;
    };
}
?>