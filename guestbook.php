<?php

//this page is add & show messages

require("global.php");

require(DATABASE.'/message.php');

$success = '';
$error   = '';

$messageObject = new message();

if (count($_POST) > 0) {

    $title   = filter_var($_POST['title'],FILTER_SANITIZE_STRING);
    $content = filter_var($_POST['content'],FILTER_SANITIZE_STRING);
    $name    = filter_var($_POST['name'],FILTER_SANITIZE_STRING);
    $email   = filter_var($_POST['email'],FILTER_SANITIZE_EMAIL);

    //  add error validate start

    $errorMessage = array();

    if(strlen($title) < 5){

        $userError = $errorMessage[] = 'title must be 5 character';

    }elseif(empty($title)){

        $userError = $errorMessage[] = 'you must add title';
    }

    if(strlen($content) < 0 || empty($content) ) {

        $messageError = $errorMessage[] = 'you must add message';

    }

    if(strlen($name) < 3 ){

        $nameError = $errorMessage[] = 'name must be 3 character or more';

    }elseif(empty($name)){
        $nameError = $errorMessage[] = 'you must add name';
    }

    if(!(filter_var($email,FILTER_VALIDATE_EMAIL)) || empty($email)){

        $emailError = $errorMessage[] = 'you must add email';
        $emailError = $errorMessage[] = $email;
    }

    if(count($errorMessage)>0){
        $error = 'message not added';
    }else{
        $messageObject->addMessage($title, $content, $name, $email);

        $success = 'Message added successfully...';
    }

}

$messages = $messageObject->getAllMessages('ORDER BY `id` DESC');

$selected = 'guestbook';

$pageTitle = 'guest book';

include(VIEW.'/front/navbar.html');
include(VIEW.'/front/guestbook.html');
include(VIEW.'/front/footer.html');
