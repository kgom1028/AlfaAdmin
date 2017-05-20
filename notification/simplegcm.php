<?php
require_once 'GCMPushMessage.php';
function sendGCM($devices, $message){
        $apiKey = "AIzaSyDm4n1wMaX-7GmU9-gdImpn6GwHkTQWXGs";
        $gcpm = new GCMPushMessage($apiKey);
	$gcpm->setDevices($devices);
	//$response = $gcpm->send($message, array('title' => 'my name is aaa','message'=>'hi every one','type'=>1));
        $response = $gcpm->send($message, false);
	//echo $response;
}
?>