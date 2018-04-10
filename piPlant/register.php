<?php
include "db.php";
$userId = $_POST['userId'];
$deviceToken = $_POST['deviceToken'];
$email = $_POST['email'];

$chk = "SELECT * from register where userId = $userId";
$update = "UPDATE register set email = '$email',deviceToken = '$deviceToken' where userId = $userId";
$insert = "INSERT INTO  register (userId,email,deviceToken) VALUES ($userId,'$email','$deviceToken')";




$insertButtin = "INSERT INTO motorName (motorId, userId, name,status)VALUES (1, '$userId', 'MOTOR 1',0);";
$insertButtin .= "INSERT INTO motorName (motorId, userId, name,status)VALUES (2, '$userId','MOTOR 2',0);";
$insertButtin .= "INSERT INTO motorName (motorId, userId, name,status)VALUES (3, '$userId', 'MOTOR 3',0);";
$insertButtin .= "INSERT INTO motorName (motorId, userId, name,status)VALUES (4, '$userId', 'MOTOR 4',0);";
$insertButtin .= "INSERT INTO motorName (motorId, userId, name,status)VALUES (5, '$userId', 'MOTOR 5',0)";

/*$insertSensor = "INSERT INTO sensorName (motorId, userId, name,status)VALUES (5, '$userId', 'MOTOR 5',0)";*/


/*$msql = "SELECT distinct device  FROM soil group by  device";
		$res = mysqli_query($conn,$msql);
		echo $msql;
		$data = $res->fetch_object();
		echo json_encode(["data"=>$data]);exit;*/
		






$result=mysqli_query($conn,$chk);
$checkuserId = $result->fetch_object();
if($checkuserId)
{
	if ($conn->query($update) === TRUE) 
	{
    	
    	$res->message = "Record updated successfully";
		$res->data = "";
		$response = json_encode($res);exit;
	}
	else
	{
		echo "Record updated Faild";exit;
	}
}
else
{

	if ($conn->query($insert) === TRUE) 
	{
    	echo "Record Inserted successfully";
    	if ($conn->multi_query($insertButtin) === TRUE) 
    	{
    		
			$msg = "";
			$rows = "";
		}
		else
		{
			echo $insertButtin;exit;

		} 

	}
	else
	{
		echo $insert;
		$msg = "Record insert Failed";
		$rows = "";
		echo "Record insert Failed";exit;
	}

}

$info = "SELECT * from motorName where userId = $userId";
$res=mysqli_query($conn,$info);
$rows = array();
while($r = mysqli_fetch_assoc($result)) 
{
    $rows[] = $r;
}
$res->message = "New records created successfully";
$res->data = $rows;
$response = json_encode($res);
echo $response;exit;