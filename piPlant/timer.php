<?php
include "db.php";
$userId = $_POST['userId'];
$motorId = $_POST['motorId'];
$deviceToken = $_POST['deviceToken'];
$email = $_POST['email'];
$MotorOn = $_POST['MotorOn'];
$MotorOff = $_POST['MotorOff'];
$MotorOnTime = $_POST['MotorOnTime'];
$MotorOffTime = $_POST['MotorOffTime'];
$fixedTime = $_POST['fixedTime'];


$chk = "SELECT * from register where userId = $userId";
$insert = "INSERT into timer(userId,motorId,MotorOn,MotorOff,MotorOnTime,MotorOffTime,fixedTime)
VALUES ($userId,$motorId,'$MotorOn','$MotorOff','$MotorOnTime','$MotorOffTime','fixedTime')";
$result=mysqli_query($conn,$chk);
$checkuserId = $result->fetch_object();


if($checkuserId)
{
	if ($conn->query($insert) === TRUE) 
	{
		$res->message = "Record Inserted successfully";
		$res->data = "";
		$response = json_encode($res);

		echo $response;exit;

    	
	}
	else
	{
		echo "failed";
	}
	
}
else
{
	echo "not a valid user";
}