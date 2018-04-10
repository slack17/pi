
<?php 
echo phpinfo();

$con=mysql_connect('localhost','khaled','test123')or die(mysql_error());

$db = mysql_select_db('phpauto',$con)or die(mysql_error());
echo $db;exit;
if($db )
{
echo 'ins';
}
else
{
	echo 'not';
}



?>