<?php
ini_set('display_errors', 0);
ini_set('display_startup_errors', 0);
error_reporting(E_ALL);

$input_data = file_get_contents('php://input');
if($_GET){
    $input = $_GET;
} else {
    $input = json_decode($input_data, true);
}

$time = time();
$name = $input['name'];
$pass = $input['password'];
$event = $input['event'];
$ip = userIp();

require_once('db.php');
require_once('accounts.php');
require_once('groups.php');
require_once('messages.php');

function encode($arr)
{
    $encode = '';
    foreach($arr as $item => $content)
    {
        $encode .= '"'.$item.'":"'.$content.'";';
    }
    return $encode;
}

function userIp()
{
    $client  = @$_SERVER['HTTP_CLIENT_IP'];
    $forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
    $remote  = @$_SERVER['REMOTE_ADDR'];
     
    if(filter_var($client, FILTER_VALIDATE_IP)) $ip = $client;
    elseif(filter_var($forward, FILTER_VALIDATE_IP)) $ip = $forward;
    else $ip = $remote;
    
    return $ip;
}
?>
