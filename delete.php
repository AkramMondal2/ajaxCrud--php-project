<?php
    include "./connection.php";

    $id = $_POST["id"];
    $sql = "DELETE FROM `users` WHERE `sno` = $id";
    $result = mysqli_query($conn,$sql);
    if ($result) {
        echo 1;
    }else{
        echo 0;
    };
?>