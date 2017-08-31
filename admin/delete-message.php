<?php
//this page is delete message

session_start();
require("../global.php");
require(INCLUDES.'/generalFunctions.php');
require(DATABASE.'/message.php');

$error = '';
$success = '';

$id = (isset($_GET['id']))?(int)$_GET['id'] : 0;

$messageObject = new message();

$deleteMessage = $messageObject->deleteMessage($id);

if ($deleteMessage) {
  header('LOCATION:all-messages.php');
}else {
  $error = 'message undeleted';
}
