<?php
session_start();

require("../global.php");
require(INCLUDES.'/generalFunctions.php');
require(DATABASE.'/message.php');

if(!checkLogin())
    header('LOCATION:login.php');

$gbObject = new message();

$idFromUrl = (isset($_GET['id']))? (int)$_GET['id'] : 0;
$error = '';
$success = '';

include(VIEW.'/back/header.html');
include(VIEW.'/back/menu.html');
if(count($_POST)>0)
{
    $idFromForm = $_POST['id'];
    $title = $_POST['title'];
    $content = $_POST['content'];

    if($gbObject->updateMessage($idFromForm,$title,$content))
    {
        $success = 'Message Updated Successfully';
    }
    else
    {
        $error = 'Message Not Updated';
    }

    include(VIEW.'/back/resultMessage.html');
    include(VIEW.'/back/footer.html');
    exit;

}
else
{
    $message = $gbObject->getMessageById($idFromUrl);

    if(!$message || count($message) ==0)
    {
        $error = 'Message not found';
        include(VIEW.'/back/resultMessage.html');
        include(VIEW.'/back/footer.html');
        exit;
    }

    $pageTitle = 'update message';

    include(VIEW.'/back/update-message.html');

}

include(VIEW.'/back/footer.html');
