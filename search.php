<?php
    include "./connection.php";

    $sValue = $_GET["sValue"];
    
    $sql = "SELECT * FROM `users` WHERE `email` LIKE '%$sValue%' OR `password` LIKE '%$sValue%'";
    $result = mysqli_query($conn,$sql);
    $nRow = mysqli_num_rows($result);
    if ($nRow > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            echo'   <tr>
                        <th>'.$row["email"].'</th>
                        <td>'.$row["password"].'</td>
                        <td>
                            <button type="button" class="btn btn-success" id="editbtn" data-id='.$row["sno"].' data-bs-toggle="modal" data-bs-target="#exampleModal">Edit</button>
                            <button type="button" class="btn btn-danger" id="deletebtn"  data-id='.$row["sno"].'>Delete</button>
                        </td>
                    </tr>';
        }
    }else{
        echo '<h1>No Result Found</h1>';
    }
?>