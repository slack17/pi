<?php
/*
$tblName = $_POST['tblName'];
$dbName = $_POST['dbName'];
$userName = $_POST['userName'];
$password = $_POST['password'];
$type= $_POST['type'];
$ip = $_POST['tblName'];
*/
$servername = "localhost";
$username = "khaled";
$password = "test123";
$dbname = "phpauto";
$tblName = $_POST['tblName'];
$type= $_POST['type'];
$sensorType = $_POST['sensorType'];
$sensorCount = $_POST['sensorCount'];


// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 


$sql = "SELECT * FROM ".$tblName." order by id desc limit 1";

$result=mysqli_query($conn,$sql);

$data = $result->fetch_object();
 /* while($row = $result->fetch_object(MYSQL_ASSOC)) {
            $myArray[] = $row;
    } */
//$data['type'] = 0;

$obj2 = new stdClass;
$obj2->type = $type;
$obj2->sensorType = $sensorType;
$obj2->sensorCount = $sensorCount;

$data = (object) array_merge((array)$data, (array)$obj2);
echo json_encode($data);




$conn->close();

?>