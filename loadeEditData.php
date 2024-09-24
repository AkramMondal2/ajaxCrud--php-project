<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST' ) {
    include "./connection.php";
    $id = $_POST["id"];

    $sql = "SELECT * FROM `users` WHERE `sno` = $id";
    $result = mysqli_query($conn,$sql);
    $nRow = mysqli_num_rows($result);
    if ($nRow == 1) {
        $row = mysqli_fetch_assoc($result);
        echo'
                <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Email address</label>
                            <input type="email" class="form-control" id="editEmail" name="email" aria-describedby="emailHelp" value='.$row["email"].'>
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Password</label>
                            <input type="password" class="form-control" id="editPassword" name="password" value='.$row["password"].'>
                        </div>
                        <button type="submit" class="btn btn-primary" id="updateBtn" data-id='.$row["sno"].'>Save</button>
        
        ';
    }
}
?>