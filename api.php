<?php
    require_once('helper.php');

    $secret = 'fufu';
    $user_secret = data_post('secret');
    if(empty($user_secret))
        output('error','Secret not found');
    if($secret != $user_secret)
        output('error','Wrong secret');

    $device_id = data_post('device');
    $sensor1 = data_post('sensor1');
    $sensor2 = data_post('sensor2');
    $last_update = date('Y-m-d H:i:s');

    $conn = new mysqli('localhost', 'root', '','tesv3');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$sql = "UPDATE device SET lastupdate='$last_update',sensor1 = $sensor1,sensor2 = $sensor2 WHERE id=$device_id";

echo $sql;
if($conn->query($sql) === TRUE) {
    output();
}
$conn->close();
output('error','DB Error');
?>
