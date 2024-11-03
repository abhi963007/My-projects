<?php

    $servername="localhost";
    $uname="root";
    $pass="";
    $db="leavesystemphp";

    $conn=mysqli_connect($servername,$uname,$pass,$db);

    if(!$conn){
        die("Connection Failed");
    }

    $sql = "SELECT * FROM login WHERE user_type = 'PC'";
                    $query = $conn->query($sql);

                    echo "$query->num_rows";
?>