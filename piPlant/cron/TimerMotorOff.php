<?php
	date_default_timezone_set('Asia/Kuwait');
    $str = file_get_contents('/var/www/html/api/piPlant/data.json');
    $json = json_decode($str, true);
   
    
    $host = $json['host'];
    $userName = $json['userName'];
    $password = $json['password'];
    $db = $json['db'];
    $soil = $json['soil'];
    $room = $json['room'];
    $water = $json['water'];

    $dbhost="localhost";
    $dbuser=$userName;
    $dbpass=$password;
    $dbname=$db;
    
sleep(55);
	$conn = new mysqli($dbhost, $dbuser, $dbpass, $dbname);
	$allUser = "SELECT * from MotorTimer where cronStatus = 0";
	$userSql = "SELECT * from register where genNoti = 1";

	
	$result = mysqli_query($conn,$allUser);

	while($data = mysqli_fetch_assoc($result))
	{
	
	    $userId = $data['userId'];
	    $startTime = $data['startTime'];
	    $endTime = $data['endTime'];	
	    $cmd = $data['cmd'];
	    $motorId = $data['motorId'];

	    $time = date('Y-m-d h:i');
        $end_time = date('Y-m-d h:i', strtotime($endTime));
echo $time;echo "hai";echo $end_time;

	    if($time == $end_time)
	    {
$sleepTime = date('s', strtotime($endTime));


			$updateMotor = "UPDATE motorName set motorStatus = 0 where motorId = '$motorId'";
			$resultMotor = mysqli_query($conn,$updateMotor);

			$updateMotor = "UPDATE MotorTimer set cronStatus = 1 where motorId = '$motorId'";
			$resultMotor = mysqli_query($conn,$updateMotor);
			
			$motorName = "SELECT * from motorName where motorId = '$motorId' ";
			$resultMotorName = mysqli_query($conn,$motorName);
			$dataName = mysqli_fetch_assoc($resultMotorName);
	
			$message = $dataName['name']." Switched Off";
			$title = "Motor Alarm";

			$resultOff = mysqli_query($conn,$userSql);
	
	exec("".$cmd."");
            while($user = mysqli_fetch_assoc($resultOff))
            {
		echo $user['userId'];
               send_gcm_notify($user['deviceToken'],$message,$title,$dbhost);

            }

	    }	
	
	}

	function send_gcm_notify($devicetoken,$message,$title,$ip = 0)
	{


	    if (!defined('FIREBASE_API_KEY')) define("FIREBASE_API_KEY", "AAAAyWReL-M:APA91bGEYqULDMblKQg40gmz6n6uqTJG7rsKVi1E37Rm1Qal682L7pRrfa8B1nbb--6JtxLqDaerUpqF02MRXmNDLfQwpRV2YrySiOB9UiCWekVa20piiX1hzFVYiKH4qpPv3CEV18sw");
	        if (!defined('FIREBASE_FCM_URL')) define("FIREBASE_FCM_URL", "https://fcm.googleapis.com/fcm/send");

			#$me = html_entity_decode($message,ENT_HTML5);
	            $fields = array(
	                'to' => $devicetoken ,
	                'priority' => "high",
	                'notification' => array( "tag"=>"chat", "title"=>$title,"body" =>$message,"ip"=>$ip,"priority"=>"high"),
	            );


	            $headers = array(
	                'Authorization: key=' . FIREBASE_API_KEY,
	                'Content-Type: application/json'
	            );
	            $ch = curl_init();
	            curl_setopt($ch, CURLOPT_URL, FIREBASE_FCM_URL);
	            curl_setopt($ch, CURLOPT_POST, true);
	            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
	            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));

	            

	           echo	 $result = curl_exec($ch);

	            if ($result === FALSE)
	            {
	                die('Problem occurred: ' . curl_error($ch));
	            }
	            curl_close($ch);

	}


?>