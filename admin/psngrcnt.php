<?php

require '../helpers/conn.php';

if(!$conn){
    die("Connection Failed");
}

$sql = "SELECT * FROM users";
                $query = $conn->query($sql);

                echo "$query->num_rows";
?>