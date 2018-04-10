<?php
include "db.php";
$userId = $_POST['userId'];
$deviceToken = $_POST['deviceToken'];
$motorId = $_POST['motorId'];#primaryKey
$status = $_POST['status'];
$name = $_POST['name'];


$chk = "SELECT * from register where userId = $userId";
$update = "UPDATE motorName set name = '$name',status = '$status' where id = $motorId";


$result=mysqli_query($conn,$chk);
$checkuserId = $result->fetch_object();
if($checkuserId)
{
	if ($conn->query($update) === TRUE) 
	{
    	echo "Record updated successfully";exit;
	}
	else
	{
		echo "Record updated Faild";exit;
	}
}
else
{

	echo "unAuthorized User";exit;

}