<?php
session_start();
include 'connect.php';
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET,POST,PATCH,PUT,DELETE,OPTINS');
header('Access-Control-Allow-Headers: Origin,Content-Type,X-Auth-Token');
$data = json_decode(file_get_contents("php://input"));

$phonex = $data->phone;

$sql = "select * from users where phone='" . $phonex . "'";
$result = mysqli_query($con, $sql) or die(mysqli_error($con));

$output = array();
$c = 0;

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $output[$c][] = $row;
        $c++;
    }
} else {
    $output = [0];
}


echo json_encode($output);

mysqli_close($con);
