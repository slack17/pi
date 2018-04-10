<?php
/*
$tblName = $_POST['tblName'];
$dbName = $_POST['dbName'];
$userName = $_POST['userName'];
$password = $_POST['password'];
$type= $_POST['type'];
$ip = $_POST['tblName'];
*/


/*

$servername = "localhost";
$username = "root";
$password = "qV2D5bfuuA/KYAswtR1wHw==";
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
} */



 include 'db.php';
 
$tblName = $_POST['tblName'];
$type= $_POST['type'];
$sensorType = $_POST['sensorType'];
$sensorCount = $_POST['sensorCount'];

try 
{
	if ($tblName == "soil")
	{

		 $sql = "SELECT * FROM ".$tblName." WHERE id IN (SELECT MAX(id) FROM soil GROUP BY device)";

		
		$result=mysqli_query($conn,$sql);
		$rows = array();
		while($r = mysqli_fetch_assoc($result)) 
		{
		    $rows[] = $r;
		}
		echo json_encode(["data"=>$rows,
			"sensorType"=>$sensorType,
			"sensorCount"=>$sensorCount
			]);exit;
	}

	else
	{
		$sql = "SELECT * FROM ".$tblName." order by id desc";
	}


	$result=mysqli_query($conn,$sql);
	$data = $result->fetch_object();
	echo json_encode(["data"=>$data,
			"sensorType"=>$sensorType,
			"sensorCount"=>$sensorCount
			]);exit;


 

}
catch(Exception $e) {
  echo 'Message: ' .$e->getMessage();
}



$conn->close();

?>