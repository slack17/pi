<?php
date_default_timezone_set('America/New_York');
require_once('PHPMailer_5.2.0/class.phpmailer.php');
$con=mysql_connect('localhost','root','qV2D5bfuuA/KYAswtR1wHw==') or ('error');
mysql_select_db('phpauto',$con);
require 'Slim/Slim.php';

$app = new Slim();
$app->config('debug', true);
//$app->error('custom_error_handler');

//PHP 5 >= 5.3
$app->error(function ( Exception $e ) use ($app) {
    $app->render('error.php');
});

/*function custom_error_handler( Exception $e ){
$app = Slim::getInstance();
$app->render('error.php');
}*/
$app->POST('/register','register');
$app->post('/sendmail','sendmail');


//parking_lot_search($userId,$searchValue)



$app->run();


function register()






function getConnection() {
    $dbhost="localhost";
    $dbuser="root";
    $dbpass="<qr~6M?@m+mN";
    $dbname="agilehealth";

    $dbh = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass,array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $dbh;
}
