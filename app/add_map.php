<?php

$username = "root";
$password = "vertrigo";
$hostname = "localhost"; 

//connection to the database
$connection = mysqli_connect($hostname, $username, $password, 'road');

if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
} 

$sql = "SELECT id FROM maps ORDER BY id DESC LIMIT 1";
$id = $connection->query($sql);
$row = mysqli_fetch_assoc($id);

if($row['id'] == null) {
    $mid = 1;
} else{
    $mid = $row['id'];
}

for($i = 0; $i<count ($_POST['data']); $i++) {

    $lat = $_POST['data'][$i][0];
    $lng = $_POST['data'][$i][1];
    $datetime = $_POST['data'][$i][2];
    $dt = explode(" ", $datetime);

    $date = $dt[0];
    $time = $dt[1];

    $date = str_replace(":","-", $date);

    $datetime = $date.' '.$time;



    $sql2 = "INSERT INTO maps (map_id, lat, lng, datetime) VALUES ('$mid','$lat','$lng','$datetime')";
    $add = $connection->query($sql2);

}

$connection->close();

?>