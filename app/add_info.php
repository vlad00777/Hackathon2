<?php

$username = "root";
$password = "vertrigo";
$hostname = "localhost"; 

//connection to the database
$connection = mysqli_connect($hostname, $username, $password, 'road');

if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
} 



for($i = 0; $i<count ($_POST['data']); $i++) {
    $mid = $_POST['data'][$i][2];
    $howlong = $_POST['data'][$i][1];
    $city = $_POST['data'][$i][0];
}

$sql = "SELECT * FROM info WHERE map_id = $mid";
$id = $connection->query($sql);
$row = mysqli_fetch_assoc($id);

if($row == null) {

    $sql2 = "INSERT INTO info (map_id, city, howlong) VALUES ('$mid','$city','$howlong')";
    $add = $connection->query($sql2);
    
}


$connection->close();

?>