<?php

    $servername="localhost";
    $uname="root";
    $pass="";
    $db="leavesystemphp";

    $conn=mysqli_connect($servername,$uname,$pass,$db);

    if(!$conn){
        die("Connection Failed");
    }

    $sql = "SELECT * FROM leave_requests WHERE leave_status = 'Pending'";
                    $query = $conn->query($sql);

                    echo "$query->num_rows";
?>