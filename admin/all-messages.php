<?php

session_start();
require("../global.php");
require(INCLUDES.'/generalFunctions.php');
require(DATABASE.'/message.php');

if (!checkLogin()) {
  header('LOCATION:login.php');
}

$messageObject = new message();

$messages = $messageObject->getAllMessages();

//adding design

$pageTitle = 'all messages';

include(VIEW.'/back/header.html');
include(VIEW.'/back/menu.html');
include(VIEW.'/back/all-messages.html');
include(VIEW.'/back/footer.html');
